<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\wamp\www\thinkphp5.0.7\public/../application/home\view\index\reggg.html";i:1502430935;}*/ ?>
<html>
<head>

</head>
<boy>
    <div>

        <!--<form class="demoform" id="from1">-->
            <!--<div>-->
                <!--<input type="text" value="" name="name" datatype="s5-16" errormsg="昵称至少5个字符,最多16个字符！" />-->
                <!--<span></span>-->
            <!--</div>-->

        <!--</form>-->
        <!--<form class="demoform" action='' medivod="" >-->
            <!--<div class="inp">-->
            <!--<input type="text" value="" name="11name" datatype="s5-16"  sucmsg="用户名验证通过！" nullmsg="请输入用户名！" errormsg="请用邮箱或手机号码注册！"  />-->
                <!--<span class='Validform_info'></span>-->
            <!--</div>-->
            <!--&lt;!&ndash;<input type="file" name="img" id="file"/>&ndash;&gt;-->
            <!--&lt;!&ndash;<input class="" type="text" name="emil">&ndash;&gt;-->
            <!--<div class="inp">-->
            <!--<input class="text" datatype="*2-16" type="text" name="username"  nullmsg="请填写用户名">-->
                <!--<span class='Validform_info'></span>-->
                <!--</div>-->
            <!--&lt;!&ndash;<img arc="" height="150" widdiv="150" id="bb_img"/>&ndash;&gt;-->
            <!--&lt;!&ndash;<input type="hidden" name="url" value="<?php echo url('Index/aa'); ?>"/>&ndash;&gt;-->
            <!--<button type="submit">提交</button>-->
        <!--</form>-->



        <form action="" method="post" class="" id="form">
            <!-- 注册 -->
            <div class="login">
                <!-- 头部提示 -->
                <!--<div class="hd">-->
                    <!--<strong>用户注册</strong><span>已有帐号？点击<a href="/member/login.html">登录</a></span>            </div>-->
                <!-- 头部提示 -->

                <!-- 表单项 -->

                        <div>用户名</div>
                        <div>
                            <input class="text" type="text" name="user_name" value="" datatype="*2-16" nullmsg="请填写用户名">
                            <span class="Validform_checktip"></span>
                        </div>
                        <div>密码</div>
                        <div>
                            <input class="text" type="password" name="user_password" datatype="*6-20" nullmsg="请填写密码" errormsg="密码为6-20位">
                            <span class="Validform_checktip"></span>
                        </div>
                        <div>确认密码</div>
                        <div>
                            <input class="text" type="password" name="repassword" datatype="*" nullmsg="请填确认密码" errormsg="您两次输入的密码不一致" recheck="user_password">
                            <span class="Validform_checktip"></span>
                        </div>

                        <!--<div>邮箱</div>-->
                        <!--<div>-->
                            <!--<input class="text" type="text" name="email" value="" datatype="e" nullmsg="请填写邮箱" errormsg="请填写正确格式的邮箱" ajaxurl="<?php echo url('Index/index'); ?>">-->
                            <!--<span class="Validform_checktip"></span>-->
                        <!--</div>-->

                <!--<div>qq</div>-->
                <!--<div>-->
                    <!--<input class="text" type="checkbox" name="qq" value="" datatype="*6-20" nullmsg="请填写邮箱qq" errormsg="qq密码为6-20位" ajaxurl="<?php echo url('Index/index'); ?>">-->
                    <!--<span class="Validform_checktip"></span>-->
                <!--</div>-->

                        <div>验证码</div>
                        <div>
                            <input class="verify Validform_error" type="text" name="seccodeverify" datatype="*5-5" nullmsg="请填写验证码" errormsg="请填写5位验证码" autocomplete="off">
                            <a href="javascript:void(0)" class="reloadverify" title="换一张">换一张？</a><span class="Validform_checktip"></span><br>
                            <img class="verifyimg reloadverify" src="<?php echo captcha_src(); ?>" alt="点击切换">
                        </div>



                    <!-- <tr>
                        <div>&nbsp;</div>
                        <div>
                            <label><input class="checkbox" type="checkbox" name="test" />保持登录状态</label>
                        </div>
                    </tr> -->
                <!--&lt;!--ajax实时验证用户名--&gt;-->
                <!--&lt;input type="text" value="" name="name" datatype="e" ajaxurl="valid.php?myparam1=value1&amp;myparam2=value2" sucmsg="用户名验证通过！" nullmsg="请输入用户名！" errormsg="请用邮箱或手机号码注册！"  /&gt;-->
                <!--&nbsp;-->
                <!--&lt;!--密码--&gt;-->
                <!--&lt;input type="password" value="" name="userpassword" datatype="*6-15" errormsg="密码范围在6~15位之间！" /&gt;-->
                <!--&lt;!--确认密码--&gt;-->
                <!--&lt;input type="password" value="" name="userpassword2" datatype="*" recheck="userpassword" errormsg="您两次输入的账号密码不一致！" /&gt;-->
                <!--&nbsp;-->
                <!--&lt;!--默认提示文字--&gt;-->
                <!--&lt;textarea tip="请在这里输入您的意见。" errormsg="很感谢您花费宝贵时间给我们提供反馈，请填写有效内容！"  datatype="s" altercss="gray" class="gray" name="msg" value=""&gt;请在这里输入您的意见。&lt;/textarea&gt;-->
                <!--&nbsp;-->
                <!--&lt;!--使用swfupload插件--&gt;-->
                <!--&lt;input type="text" plugin="swfupload" class="inputxt" disabled="disabled" value=""&gt;-->
                <!--&lt;input type="hidden" value="" pluginhidden="swfupload"&gt;-->
                <!--&nbsp;-->
                <!--&lt;!--使用passwordStrength插件--&gt;-->
                <!--&lt;input type="password" errormsg="密码至少6个字符,最多18个字符！" datatype="*6-18" plugin="passwordStrength" class="inputxt" name="password" value=""&gt;-->
                <!--&lt;div class="passwordStrength" style="display:none;"&gt;&lt;b&gt;密码强度：&lt;/b&gt; &lt;span&gt;弱&lt;/span&gt;&lt;span&gt;中&lt;/span&gt;&lt;span class="last"&gt;强&lt;/span&gt;&lt;/div&gt;-->
                <!--&nbsp;-->
                <!--&lt;!--使用DatePicker插件--&gt;-->
                <!--&lt;input type="text" plugin="datepicker" class="inputxt" name="birthday" value=""&gt;-->




                        <div>&nbsp;</div>
                        <div>
                            <input type="submit" value="完成" >
                            <!--<input type="hidden" name="url" value="<?php echo url('Index/reg'); ?>"/>-->
                        </div>
                
            </div>
            <!-- /注册 -->
            <!-- /其他登陆 -->
        </form>
    </div>
    <div id="show"></div>
</boy>
<script type="text/javascript" charset="utf-8" src="<?php echo __HJS__; ?>/jquery.min.js"></script>
<!--<script type="text/javascript" src="http://validform.rjboy.cn/Validform/v5.1/Validform_v5.1_min.js"></script>-->
<!--<script type="text/javascript" src="http://validform.rjboy.cn/Validform/v5.1/Validform_v5.1_min.js"></script>-->
<script type="text/javascript" charset="utf-8" src="<?php echo __HJS__; ?>/ajax.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo __HJS__; ?>/version 5.3.2.js"></script>
<script>



//$(function(){
//    $('.reloadverify').click(function(){
//        $('.verifyimg').attr('src', "/member/verify.html?" + Madiv.random());
//    });
//})


$(function(){
    //全局的form验证
    $('#form').Validform({
        postonce : true,
        tiptype : function(msg,o,cssctl){
            //msg：提示信息;
            //o:{obj:*,type:*,curform:*}, obj指向的是当前验证的表单元素（或表单对象），type指示提示的状态，值为1、2、3、4， 1：正在检测/提交数据，2：通过验证，3：验证失败，4：提示ignore状态, curform为当前form对象;
            //cssctl:内置的提示信息样式控制函数，该函数需传入两个参数：显示提示信息的对象 和 当前提示的状态（既形参o中的type）;
            if(!o.obj.is("form")){
            //验证表单元素时o.obj为该表单元素，全部验证通过提交表单时o.obj为该表单对象;
                var objtip=o.obj.siblings(".Validform_checktip");
                objtip = $(objtip).get(0) == undefined ? o.obj.parent().next().find('.Validform_checktip') : objtip;
                objtip = $(objtip).get(0) == undefined ? o.obj.parents('div').find('.Validform_checktip') : objtip;
                objtip = $(objtip).get(0) == undefined ? o.obj.parents('div').next().find('.Validform_checktip') : objtip;
                if($(o.obj).attr('datatype') != 'verify'){
                    cssctl(objtip,o.type);
                    objtip.text(msg);
                }else{
                    if($(o.obj).val().lengdiv != 5){
                        cssctl(objtip,o.type);
                        objtip.text(msg);
                    }else{
                        objtip.removeClass('Validform_wrong').text('');
                    }
                }
            }
        },
        datatype:{
            'mix':function(gets,obj,curform,regxp){
                var lens = $(obj).attr('data-lengdiv');
                var str = $(obj).val();
                var realLengdiv = 0, len = str.lengdiv, charCode = -1;
                for (var i = 0; i < len; i++) {
                    charCode = str.charCodeAt(i);
                    if (charCode >= 0 && charCode <= 128) realLengdiv += 1;
                    else realLengdiv += 2;
                }

                if(realLengdiv == 0){
                    return false;
                }
                if(realLengdiv > lens){
                    return false;
                }
                return true;
            },
            'verify':function(gets,obj,curform,regxp){
                var str = $(obj).val();
                if(str.lengdiv < 5){
                    return false;
                }else{
                    return;
                }
            }
        }
    });

})
</script>
</html>