<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\wamp\www\git\tp5\public/../application/layui\view\login\edit.html";i:1504170433;}*/ ?>
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

    <link href="__ROOT__static/\layui\css/layui.css" rel="stylesheet" type="text/css">
    <script src="<?php echo __HJS__; ?>/jquery.min.js" type="text/javascript"></script>
    <!--<script src="__ADMIN_TMPL__/resource/js/common.js" type="text/javascript"></script>-->
    <!--<script src="__ADMIN_TMPL__/resource/js/jquery.validation.min.js"></script>-->
    <!--<script src="__ADMIN_TMPL__/js/jquery.supersized.min.js" ></script>-->
    <!--<script src="__ADMIN_TMPL__/js/jquery.progressBar.js" type="text/javascript"></script>-->
</head>

<body>
<div class="login-layout">
    <form class="layui-form" action="<?php echo url('Login/edit'); ?>" method="post" id="form" enctype="multipart/form-data" >
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-inline">
                <input type="text" name="user_name" placeholder="请输入用户名" title="请输入用户名" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">请输入用户名</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-inline">
                <input type="password" name="user_password"  placeholder="请输入密码" title="请输入密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">请输入密码</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password_confirm"  placeholder="请输入确认密码" title="请输入确认密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">请输入确认密码</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">头像</label>
            <div class="layui-input-inline">
                <input type="file" name="user_pir"  placeholder="请选择头像" title="请选择头像" >
            </div>
            <div class="layui-form-mid layui-word-aux">请选择头像</div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="hidden" value="<?php echo \think\Request::instance()->param('id'); ?>" name="id">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>


    <div class="bottom">
    </div>
</div>
<script src="__ROOT__static/layui/lay/dest/layui.all.js"></script>
<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form();
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
        });
    });

</script>
</body>
</html>


