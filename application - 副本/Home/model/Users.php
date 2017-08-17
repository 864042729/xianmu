<?php
namespace app\Home\model;
use think\Model;
class Users extends Model
{
    //添加数据
  function add($data){
      $User = new Users;
      // 调用当前模型对应的User验证器类进行数据验证
      $result = $User->validate('users.add')->save($data);
      if(false === $result){
          // 验证失败 输出错误信息
          dump($User->getError());
      }
  }

    //修改数据
    function save($data){
        $User = new Users;
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $User->validate('users.add')->save($data,['id' => $data['userId']]);
        if(false === $result){
            // 验证失败 输出错误信息
            dump($User->getError());
        }
    }

}
