<?php
namespace app\Home\model;
use think\Model;
class User extends Model
{
    //添加数据
  function user_add($data){
      var_dump($data);exit;
      $User = new User;
      // 调用当前模型对应的User验证器类进行数据验证
      $result = $User->validate('user.add')->save($data);
      if(false === $result){
          // 验证失败 输出错误信息
          dump($User->getError());
      }
  }

    //修改数据
    function user_save($data){
        $User = new User;
        $where['user_name'] = $data['loginName'];
        $data['value']= $this->where($where)->find();
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $User->validate('user.edit')->save($data,['id' => $data['userId']]);
        if(false === $result){
            // 验证失败 输出错误信息
            dump($User->getError());
        }
    }

}
