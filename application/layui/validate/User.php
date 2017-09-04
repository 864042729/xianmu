<?php
namespace app\layui\validate;

use think\Validate;

class User extends Validate
{
//    protected $rule =   [
//        'username'  => 'require|email',
//        'password'   => 'require',
//        'code' => 'require|captcha',
//    ];
//
//    protected $message  =   [
//        'username.require' => '请输入用户名',
//        'username.email' => '错误',
//        'password.require'     => '请输入密码',
//        'code.require'     => '请输入验证码',
//        'code.captcha'     => '验证码错误',
//        'age.number'   => '年龄必须是数字',
//    ];

    protected $rule =   [
        [ 'user_name','require|email|unique:user','请输入用户名|用户名错误|用户名已经存在'],
        ['user_password','require|confirm:password_confirm|length:6,12','请输入密码|确认密码错误|密码长度为6-12位'],
        ['code','require|captcha','请输入验证码|验证码错误'],
        ['user_pir','require','请上传图片'],
    ];



    protected $scene = [
        'login'  =>  ['user_name'=>'require','user_password','code'],
        'add'  =>  ['user_name','user_password','user_pir'],
        'edit'  =>  ['user_name'=>'email|unique:user','user_password'=>'confirm:password_confirm|length:6,12'],
    ];


}