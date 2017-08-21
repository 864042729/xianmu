<?php
namespace app\Home\validate;
use think\Validate;
class User extends Validate
{
    protected $rule = [
//        require、number 或者 integer、float、boolean、email、array、accepted、date、alpha、alphaNum、alphaDash、chs、chsAlpha、chsAlphaNum、chsDash、activeUrl、url、ip、dateFormat:format、in、notIn、between、notBetween、length:num1,num2、max:number、min:number、after:日期、before:日期、expire:开始时间,结束时间、allowIp:allow1,allow2,…、denyIp:allow1,allow2,…、confirm、different、eq 或者 = 或者 same、egt 或者 >=、gt 或者 >、elt 或者 <=、lt 或者 <、
        'loginName'  =>  'require|max:25|number|float',
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
    // 自定义验证规则
    public function isName($value,$rule,$data){
        var_dump($data['value']['']);exit;
        if($value!=1){
            return false;
        }else{
            return '';
        }
    }
}
