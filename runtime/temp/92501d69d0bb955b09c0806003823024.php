<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\wamp\www\thinkphp5.0.7\public/../application/admin\view\login\login.html";i:1502443126;s:83:"D:\wamp\www\thinkphp5.0.7\public/../application/admin\view\layout\login_layout.html";i:1502272174;}*/ ?>
<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title>后台管理系统 - 您需要登录后才可以使用本功能</title>

    <link href="__ADMIN_TMPL__/css/login.css" rel="stylesheet" type="text/css">
    <link href="__ADMIN_TMPL__/font/css/font-awesome.min.css" rel="stylesheet">

    <script src="__JS__/jquery.js" type="text/javascript"></script>
    <script src="__ADMIN_TMPL__/resource/js/common.js" type="text/javascript"></script>
    <script src="__ADMIN_TMPL__/resource/js/jquery.validation.min.js"></script>
    <script src="__ADMIN_TMPL__/js/jquery.supersized.min.js" ></script>
    <script src="__ADMIN_TMPL__/js/jquery.progressBar.js" type="text/javascript"></script>
</head>

<body>
<!--主体-->

<div class="login-layout">
    <div class="top">
        <h5>【Kevin】 管理平台<em></em></h5>
        <h2>系统管理中心</h2>
        <h6>Though my wings are broken,my heart can still fly. </h6>
    </div>
    <form method="post"  action="<?php echo url('admin/login/login'); ?>">
        <div class="lock-holder">
            <div class="form-group pull-left input-username">
                <label>账号</label>
                <input name="username" id="user_name" autocomplete="off" type="text" class="input-text" lay-verify="required" value="" required>
            </div>
            <i class="fa fa-ellipsis-h dot-left"></i> <i class="fa fa-ellipsis-h dot-right"></i>
            <div class="form-group pull-right input-password-box">
                <label>密码</label>
                <input name="password" id="password" class="input-text" autocomplete="off" type="password" required lay-verify="required" pattern="[\S]{6}[\S]*" title="密码不少于6个字符">
            </div>
        </div>
        <div class="avatar"><img src="__ADMIN_TMPL__/images/login/admin.png" alt=""></div>
        <div class="submit">
            <span>
            <div class="code">
                <div class="arrow"></div>
                <div class="code-img">
                    <img  src="<?php echo captcha_src(); ?>" alt="点击更换" title="点击更换" onclick="this.src='<?php echo captcha_src(); ?>'" class="captcha" name="codeimage" id="codeimage" border="0"/>
                </div>
                <a href="JavaScript:void(0);" id="hide" class="close" title="关闭"><i></i></a><a href="JavaScript:void(0);" onclick="javascript:document.getElementById('codeimage').src='<?php echo captcha_src(); ?>';" class="change" title="看不清,点击更换验证码"><i></i>点击更换验证码</a>
            </div>
            <input name="verify" required lay-verify="required" type="text" class="input-code" id="captcha" placeholder="输入验证" pattern="[A-z0-9]{4}" title="验证码为4个字符" autocomplete="off" value="" >
            </span>
            <span>
              <input name="" class="input-button " type="submit" value="登录">
            </span>
        </div>
        <div class="submit2"></div>
    </form>
    <div class="bottom">
    </div>
</div>


<script>
    // 定义全局JS变量
    var GV = {
        current_controller: "admin/<?php echo (isset($controller) && ($controller !== '')?$controller:''); ?>/",
        base_url: "__STATIC__"
    };
</script>

    <script src="__JS__/layui/lay/dest/layui.all.js"></script>

<!--页面JS脚本-->

    <script>
        $(function(){
            $.supersized({
                // 功能
                slide_interval     : 4000,
                transition         : 1,
                transition_speed   : 1000,
                performance        : 1,
                // 大小和位置
                min_width          : 0,
                min_height         : 0,
                vertical_center    : 1,
                horizontal_center  : 1,
                fit_always         : 0,
                fit_portrait       : 1,
                fit_landscape      : 0,
                // 组件
                slide_links        : 'blank',
                slides             : [
                    {image : '__ADMIN_TMPL__/images/login/1.jpg'},
                    {image : '__ADMIN_TMPL__/images/login/2.jpg'},
                    {image : '__ADMIN_TMPL__/images/login/3.jpg'},
                    {image : '__ADMIN_TMPL__/images/login/4.jpg'},
                    {image : '__ADMIN_TMPL__/images/login/5.jpg'}
                ]
            });
            //显示隐藏验证码
            $("#hide").click(function(){
                $(".code").fadeOut("slow");
            });
            $("#captcha").focus(function(){
                $(".code").fadeIn("fast");
            });
            //跳出框架在主窗口登录
            if(top.location!=this.location)	top.location=this.location;
            $('#user_name').focus();
            if ($.browser.msie && ($.browser.version=="6.0" || $.browser.version=="7.0")){
                window.location.href='/resources/data/html/ie6update.html';
            }
            $("#captcha").nc_placeholder();
            //动画登录
            $('.btn-submit').click(function(data){
                $('.input-username,dot-left').addClass('animated fadeOutRight');
                $('.input-password-box,dot-right').addClass('animated fadeOutLeft');
                $('.btn-submit').addClass('animated fadeOutUp');
                setTimeout(function () {
                        $('.avatar').addClass('avatar-top');
                        $('.submit').hide();
                        $('.submit2').html('<div class="progress"><div class="progress-bar progress-bar-success" aria-valuetransitiongoal="100"></div></div>');
                        $('.progress .progress-bar').progressbar({
                            done : function() {
                                $.ajax({
                                    url: $("#form_login").attr("action"),
                                    type: $("#form_login").attr("method"),
                                    data:$("#form_login").serialize(),
                                    success: function (info) {
                                        setTimeout(function () {
                                            location.href = info.url;
                                        }, 1000);
                                        layer.msg(info.msg);
                                    }
                                });
                            }
                        });
                    },
                    300);

            });
            // 回车提交表单
            $('#form_login').keydown(function(event){
                if (event.keyCode == 13) {
                    $('.btn-submit').click();
                }
            });
            // 定义全局JS变量
            var GV = {
                current_controller: "admin/<?php echo (isset($controller) && ($controller !== '')?$controller:''); ?>/"
            };
        });
    </script>

<script>
    //固定层移动
    $(function(){
        //管理显示与隐藏
        $("#admin-manager-btn").click(function () {
            if ($(".manager-menu").css("display") == "none") {
                $(".manager-menu").css('display', 'block');
                $("#admin-manager-btn").attr("title","关闭快捷管理");
                $("#admin-manager-btn").removeClass().addClass("arrow-close");
            }
            else {
                $(".manager-menu").css('display', 'none');
                $("#admin-manager-btn").attr("title","显示快捷管理");
                $("#admin-manager-btn").removeClass().addClass("arrow");
            }
        });
    });
</script>
</body>
</html>