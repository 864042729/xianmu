<?php
namespace app\layui\validate;

use think\Validate;

class User extends Validate
{
    protected $rule =   [
        'username'  => 'require|email',
        'password'   => 'require',
        'code' => 'require|captcha',
    ];

    protected $message  =   [
        'username.require' => '请输入用户名',
        'username.email' => '错误',
        'password.require'     => '请输入密码',
        'code.require'     => '请输入验证码',
        'code.captcha'     => '验证码错误',
        'age.number'   => '年龄必须是数字',
    ];

    protected $scene = [
        'login'  =>  ['username'=>'require','password','code'],
    ];

}