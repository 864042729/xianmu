<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/8/9
 * Time: 下午6:37
 */


namespace app\admin\validate;

use think\Validate;

/**
 * 后台登录验证
 * Class Login
 * @package app\admin\validate
 */
class Login extends Validate
{
    protected $rule = [
        'username' => 'require|isName:111',
        'password' => 'require',
        'verify'   => 'require|captcha'
    ];

    protected $message = [
        'username.require' => '请输入用户名',
        'username.isName' => '用户名或密码错误',
        'password.require' => '请输入密码',
        'verify.require'   => '请输入验证码',
        'verify.captcha'   => '验证码不正确',

    ];
    public function isName($value,$rule,$data){
        var_dump($data['value']['']);exit;
        if($value!=1){
            return false;
        }else{
            return '';
        }
    }
}