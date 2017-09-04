<?php
namespace app\layui\controller;
use think\Controller;
use think\Validate;
use think\Db;
use think\Cache;
use think\Session;
class Login extends Controller
{
    public function __construct(){
        parent::__construct();

    }

    /**
     * 用户登陆
     * @return mixed
     */
    public function index(){
        if($this->request->isPost()){
            $data = $this->request->only(['username', 'password', 'code']);

            $validate_result = $this->validate($data, 'User.login');
            if($validate_result !== true){
                $this->error($validate_result);
            }else{
                $where=array();
                $where['user_name'] = $data['username'];
                $user = Db::name('user')->field('id,user_name,user_password,user_status,user_salt')->where($where)->find();

                if (!empty($user)) {
                    if(md5($user['user_salt'].md5($data['password']))!=$user['user_password']){
                        $this->error('密码错误');
                    }

                    if ($user['user_status'] != 1) {
                        $this->error('当前用户已禁用');
                    } else {
                        Session::set('user_id', $user['id']);
                        Session::set('user_name', $user['user_name']);
//                        $group = Db::name('auth_group_access')->where(['uid' => $user['id']])->find();
//                        Session::set('group_id', $group['group_id']);
                        Db::name('user')->update(
                            [
                                'user_lasttime' =>  time(),
                                'user_lastip' => $this->request->ip(),
                                'id' => $user['id']
                            ]
                        );
                        $this->success('登录成功', 'index/index');
                    }
                } else {
                    $this->error('用户名或密码错误');
                }
            }

        }else{
            return $this->fetch();
        }

    }

    /**
     * 用户注册
     * @return mixed
     */
    public function register(){
        if($this->request->isPost()){
            $data = input('post.');
            // 获取表单上传文件
            $data['user_pir'] = $this->request->file('user_pir');
            $res=model('User')->add($data);
            if($res){
                $this->success(model('User')->getError(),url('Login/register'));
            }else{
                $this->error(model('User')->getError());
            }

        }else{
            return $this->fetch('register');
        }

    }

    /**
     * 编辑用户信息
     * @return mixed
     */
    public function edit(){
        if($this->request->isPost()){
            $data = input('post.');
            // 获取表单上传文件
            $data['user_pir'] = $this->request->file('user_pir');
            $res=model('User')->edit($data);
            if($res){
                $this->success(model('User')->getError(),url('Login/userlist'));
            }else{
                $this->error(model('User')->getError());
            }

        }else{
            $where['id']=input('id');
            $list=model('User')->info($where);
            var_dump($list);
            return $this->fetch('edit');
        }
    }
    /**
     *
     */
    public function delete(){
        $list=model('User')->del(input('id/d'));
        $this->error($list);
    }
    /**
     * 用户列表
     * @return mixed
     */
    public function userlist(){
        $pgaetotal=5;
        $list=model('User')->pageQuery($pgaetotal);
        $page=$list->toArray();
        $this->assign('list',$list);
        $this->assign('page',paging(input('page/d')?input('page/d'):1,$page['total'],$pgaetotal));

        return $this->fetch('page');
    }
    /**
     * 用户个人信息
     * @return mixed
     */
    public function info(){
        $where=[];
        $where['user_name']=input('user_name');
        $list=model('User')->info($where);
        if($list==(-1)){
            $this->error(model('User')->getError());
        }else{
            var_dump($list);exit;
        }
        $this->assign('list',$list);
        return $this->fetch('page');
    }
    /**
     * 导出数据
     */
    public function create(){
        $list=db::name('user_app_log')->select();
        foreach($list as $k=>$v){
            $list[$k]['remark']='<span style="color:red">'.$v['remark'].'</span>';
        }
        getXLSFromList($list,['对方','士大夫'],'测试');
        exit;
    }

}
