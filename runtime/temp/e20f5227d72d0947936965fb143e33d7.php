<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\wamp\www\git\tp5\public/../application/layui\view\login\page.html";i:1504504249;}*/ ?>
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

    <style>
        .laypageskin_molv a,.laypageskin_molv span {
            padding:0 12px;
            border-radius:2px
        }
        .laypageskin_molv a {
            background-color:#f1eff0
        }
        .laypageskin_molv .laypage_curr {
            background-color:#e23e3d;
            color:#fff
        }
        .laypageskin_molv input {
            height:24px;
            line-height:24px
        }
        .laypageskin_molv button {
            height:26px;
            line-height:26px
        }
    </style>
</head>

<body>
<ul>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
    <li> <?php echo $user['id']; ?></li>
    <li> <?php echo $user['user_name']; ?></li>
    <li> <?php echo $user['userInfo']['mid']; ?></li>
    <li> <a href="<?php echo url('Login/edit',array('id'=>$user['id'])); ?>">编辑</a></li>
    <li> <a href="<?php echo url('Login/delete',array('id'=>$user['id'])); ?>">删除</a></li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php echo $page; ?>
</body>
</html>


