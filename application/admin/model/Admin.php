<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
    //登陆
    function login($data){
        $where['admin_username'] = $data['username'];
        $data['value']= $this->field('admin_username,admin_pwd,admin_open,admin_hits')->where($where)->find();
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->validate('Login')->save($data);
        if(false === $result){
            // 验证失败 输出错误信息
            dump($result->getError());
        }
      return $data;
    }
    //添加数据
    function add($data){
        $User = new Users;
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $User->validate('Login')->save($data);
        if(false === $result){
            // 验证失败 输出错误信息
            dump($User->getError());
        }
    }

//    //修改数据
//    function save($data){
//        $User = new Users;
//        // 调用当前模型对应的User验证器类进行数据验证
//        $result = $User->validate('Login')->save($data,['admin_id' => $data['userId']]);
//        if(false === $result){
//            // 验证失败 输出错误信息
//            dump($User->getError());
//        }
//    }


}