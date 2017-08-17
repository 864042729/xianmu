<?php
namespace app\Home\validate;
use think\Validate;
class Users extends Validate
{
    protected $rule = [
        'loginName'  =>  'require|max:25',
        'userEmail' =>  'email',
    ];

    protected $message = [
        'loginName.require'  =>  '用户名必须',
        'userEmail' =>  '邮箱格式错误',
    ];

    protected $scene = [
        'add'   =>  ['loginName','userEmail'],
        'edit'  =>  ['userEmail'],
    ];
}
