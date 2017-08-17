<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: SuperMan <superman@itkee.cn>
// +----------------------------------------------------------------------
/**
 * @param $data
 * @return bool
 * 是否为序列化数据
 */
function is_serialized( $data ) {
    $data = trim( $data );
    if ( 'N;' == $data )
        return true;
    if ( !preg_match( '/^([adObis]):/', $data, $badions ) )
        return false;
    switch ( $badions[1] ) {
        case 'a' :
        case 'O' :
        case 's' :
            if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
                return true;
            break;
        case 'b' :
        case 'i' :
        case 'd' :
            if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
                return true;
            break;
    }
    return false;
}

/**
 * 发送邮件
 * @param string $address
 * @param string $subject
 * @param string $message
 * @return array<br>
 * 返回格式：<br>
 * array(<br>
 * 	"error"=>0|1,//0代表出错<br>
 * 	"message"=> "出错信息"<br>
 * );
 */
function send_email($address,$subject,$message){
    vendor('phpmailer');
    if (\think\Cache::has('email_config')) {
        $email_config = \think\Cache::get('email_config');
    } else {
        $email_config = Think\Db::name('system')->field('value')->where('name', 'email_config')->find();
        $email_config = unserialize($email_config['value']);
        \think\Cache::set('email_config', $email_config);
    }
    $mail=new \PHPMailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $mail->IsSMTP();
    $mail->IsHTML(true);
    // 设置邮件的字符编码，若不指定，则为'UTF-8'
    $mail->CharSet='UTF-8';
    // 添加收件人地址，可以多次使用来添加多个收件人
    $mail->AddAddress($address);
    // 设置邮件正文
    $mail->Body=$message;
    // 设置邮件头的From字段。
    $mail->From = $email_config['address'];
    // 设置发件人名字
    $mail->FromName =   $email_config['sender'];
    // 设置邮件标题
    $mail->Subject=$subject;
    // 设置SMTP服务器。
    $mail->Host=$email_config['smtp'];
    //by Rainfer
    // 设置SMTPSecure。 链接方式
    $Secure=@$email_config['smtpsecure'];
    $mail->SMTPSecure=empty($Secure)?'':$Secure;
    // 设置SMTP服务器端口。
    $port=$email_config['smtp_port'];
    $mail->Port=empty($port)?"25":$port;
    // 设置为"需要验证"
    $mail->SMTPAuth=true;
    // 设置用户名和密码。
    $mail->Username=$email_config['loginname'];
    $mail->Password=$email_config['password'];
    // 发送邮件。
    if(!$mail->Send()) {
        $mailerror=$mail->ErrorInfo;
        return array("status"=>1,"message"=>$mailerror);
    }else{
        return array("status"=>0,"message"=>"success");
    }
}