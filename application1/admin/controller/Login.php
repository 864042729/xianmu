<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;

/**
 * Class login
 * @package app\admin\controller
 */
class login extends Controller
{
    /**
     * 登录验证
     * @return string
     */
//        public function Login()
//        {
//            if ($this->request->isPost()) {
//                $data = $this->request->only(['username', 'password', 'verify']);
//                $validate_result = $this->validate($data, 'Login');
//                if ($validate_result !== true) {
//                    $this->error($validate_result);
//                } else {
//                    $where['username'] = $data['username'];
//                    $admin_user = Db::name('admin')->field('id,admin_username,admin_pwd,admin_open,admin_hits')->where($where)->find();
//                    if (!empty($admin_user)) {
//                        if(md5($admin_user['salt'] . $data['password'])!=$admin_user['password']){
//                            $this->error('密码错误');
//                        }
//
//                        if ($admin_user['status'] != 1) {
//                            $this->error('当前用户已禁用');
//                        } else {
//                            Session::set('admin_id', $admin_user['id']);
//                            Session::set('admin_name', $admin_user['username']);
//                            $group = Db::name('auth_group_access')->where(['uid' => $admin_user['id']])->find();
//                            Session::set('group_id', $group['group_id']);
//                            Db::name('admin_user')->update(
//                                [
//                                    'last_login_time' =>  time(),
//                                    'last_login_ip' => $this->request->ip(),
//                                    'id' => $admin_user['id']
//                                ]
//                            );
//                            $this->success('登录成功', 'index/index');
//                        }
//                    } else {
//                        $this->error('用户名或密码错误');
//                    }
//                }
//            }
//            else{
//                return $this->fetch();
//            }
//        }


    public function logout(){
        Session::delete('admin_id');
        $this->success('退出成功', 'index/index');

    }
    public function Login()
    {
        if ($this->request->isPost()) {
            $data = $this->request->only(['username', 'password', 'verify']);
            $validate_result=model('Admin')->login($data);
            var_dump($validate_result['admin_username']);exit;
            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $where['username'] = $data['username'];
                $admin_user = Db::name('admin')->field('id,admin_username,admin_pwd,admin_open,admin_hits')->where($where)->find();
                if (!empty($admin_user)) {
                    if(md5($admin_user['salt'] . $data['password'])!=$admin_user['password']){
                        $this->error('密码错误');
                    }

                    if ($admin_user['status'] != 1) {
                        $this->error('当前用户已禁用');
                    } else {
                        Session::set('admin_id', $admin_user['id']);
                        Session::set('admin_name', $admin_user['username']);
                        $group = Db::name('auth_group_access')->where(['uid' => $admin_user['id']])->find();
                        Session::set('group_id', $group['group_id']);
                        Db::name('admin_user')->update(
                            [
                                'last_login_time' =>  time(),
                                'last_login_ip' => $this->request->ip(),
                                'id' => $admin_user['id']
                            ]
                        );
                        $this->success('登录成功', 'index/index');
                    }
                } else {
                    $this->error('用户名或密码错误');
                }
            }
        }
        else{
            return $this->fetch();
        }
    }

}
