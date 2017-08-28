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
    public function modelindex(){
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
}
