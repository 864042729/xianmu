<?php
/**
 * 关联（一对一关联操作  【增删改查】）
 */
namespace app\layui\model;
use think\Model;
use think\db;
use think\Loader;
use think\model\Merge;
class User extends Model
{
    //关联
    public function userInfo()
    {
        return $this->hasOne('UserInfo','mid','id')->bind('mid,user_regtime');
    }
    //获取器  自动进行处理
    public function getUserStatusAttr($value)
    {
        $status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        return $status[$value];
    }

    //修改器   保存的数据库的时候自动处理
    public function setUserPasswordAttr($value)
    {
        return md5($value);
    }

    /**
     * 关联分页
     */
    public function pageQuery($pgaetotal){
        $where = [];
        input('user_name')?$where['user_name'] = input('user_name'):'';
        $list=$this->where($where)->relation('userInfo')->paginate($pgaetotal);
        return $list;
    }
    /**
     * 关联新增用户
     * @param  array $data 用户注册信息
     * @return integer|bool  注册成功返回主键，注册失败-返回false
     */
    public function add($data)
    {
        $user           = new User;
        $user->user_name    = $data['user_name'];
        $user->user_password =$data['user_password'];
        $User_validate =  Loader::validate('User');
        $result = $User_validate->scene('add')->check($data);
        if(false === $result){
            $this->error=$User_validate->getError();
            return false;
        }
        Db::startTrans();
        //头像上传
        $user_pir=upload($data['user_pir'],'头像');
        if($user_pir['code']!=200){
            $this->error=$user_pir['msg'];
            return false;
        }
        $user->user_pir=$user_pir['url'];
        if ($user->save()) {
            // 写入关联数据
            $profile           = new  UserInfo;
            $profile->user_real_name = '刘晨';
            $profile->user_regip=request()->ip();
            $profile->user_regtime=time();
            $user->userInfo()->save($profile);
            Db::commit();
            return '用户新增成功';
        } else {
            Db::rollback();
            return $user->getError();
        }
    }

    /**
     * 关联编辑用户
     * @param  array $data 用户注册信息
     * @return integer|bool  注册成功返回主键，注册失败-返回false
     */
    public function edit($data = [])
    {
        $user = User::get($data['id']);
        $user->user_name = $data['user_name'];
        $user->user_password = $data['user_password'];
        if ($user->save()) {
            // 更新关联数据
            $user->userInfo->user_real_name = 'lllldfdfd';
            $user->userInfo->save();
            return '用户[ ' . $user->name . ' ]更新成功';
        } else {
            return $user->getError();
        }
    }
    /**
     * 关联删除用户
     * @param  array $data 用户注册信息
     * @return integer|bool  注册成功返回主键，注册失败-返回false
     */
    public function del($id)
    {
        $user = User::get($id);
        Db::startTrans();
        if ($user->delete()) {
            // 删除关联数据
            $user->userInfo->delete();
            Db::commit();
            return '用户[ ' . $user->user_name . ' ]删除成功';
        } else {
            Db::rollback();
            return $user->getError();
        }
    }


    /**
     * 关联获取个人用户信息
     * @param  integer  $uid 用户主键
     * @return array|integer 成功返回数组，失败-返回-1
     */
    public function info($where=array(),$field='*')
    {
        $user = $this->where($where)->relation('userInfo')->field($field)->find();
//       $user = User::get($where);
// 通过获取器获取字段
//        echo $user->status;
// 获取原始字段数据
//        echo $user->getData('status');
// 获取全部原始数据
//        dump($user->getData('user_status'));
        if ($user && 1 == $user->getData('user_status')) {

            // 返回用户数据
            return $user->hidden(['user_status'])->toArray();
//            return $user->toArray();
        } else {
            $this->error = '用户不存在或被禁用';
            return -1;
        }
    }
}
