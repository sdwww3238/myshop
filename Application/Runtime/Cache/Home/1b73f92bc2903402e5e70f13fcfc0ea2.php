<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>登录商城</title>
    <link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/login.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">
    <script src="/Public/Home/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        $(function(){
            //给form表单设置提交事件
            $('form').submit(function(evt){
                //判断验证码是否正确，再进行提交(否则阻止form表单提交)
                if(code_flag===false){
                    evt.preventDefault(); //阻止form表单提交
                }
            });
        });
    </script>
</head>
<body>


<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="<?php echo U('User/login');?>"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h2>
    </div>
</div>
<!-- 页面头部 end -->

</body>
</html>
<div style="clear:both;"></div>




<!-- 登录主体部分start -->
<div class="login w990 bc mt10 regist">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>
    <div class="login_bd">
        <div class="login_form fl">
            <form action="/index.php/Home/User/regist.html" method="post">
                <ul>
                    <li>
                        <label>用户名：</label>
                        <input type="text" class="txt" name="name" />
                        <p>3-20位字符，可由中文、字母、数字和下划线组成</p>
                    </li>
                    <li>
                        <label >邮箱：</label>
                        <input type="email" class="txt" name="email" />
                        <p>例如abc@163.com</p>
                    </li>
                    <li>
                        <label >密码：</label>
                        <input type="password" class="txt" name="password" />
                        <p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
                    </li>
                    <li>
                        <label>确认密码：</label>
                        <input type="password" class="txt" name="password2" />
                        <p> <span>请再次输入密码</span></p>
                    </li>
                    <li class="checkcode">
                        <label>验证码：</label>
                        <input type="text"  name="verify_code" onkeyup="check_code()" id="captcha" maxlength="4"/>
                        <img src="<?php echo U('verifyImg');?>"  alt="" onclick="this.src='/index.php/Home/User/verifyImg/y/'+Math.random()"/>
                        <span id="check_code_result"></span>
                    </li>
                    <script type="text/javascript">
                        var code_flag = false; //验证码是否通过验证
                        function check_code() {
                            var code= $('#captcha').val();
                            if(code.length==4){
                                $.ajax({
                                    url:"<?php echo U('checkCode');?>",
                                    data:{'code':code},
                                    dataType:'json',
                                    type:'get',
                                    success:function(msg){
                                        if(msg.status==1){
                                            $('#check_code_result').html('<span style="color:green">验证码正确</span>');
                                            code_flag = true;
                                        }else{
                                            $('#check_code_result').html('<span style="color:red">验证码错误</span>');
                                            code_flag = false;
                                        }
                                    }
                                })
                            }
                        }
                    </script>
                    <li>
                        <label>&nbsp;</label>
                        <input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
                    </li>
                    <li>
                        <label>&nbsp;</label>
                        <input type="submit" value="" class="login_btn" />
                    </li>
                </ul>
                <input type="hidden" name="act" value="regist">
            </form>


        </div>

        <div class="mobile fl">
            <h3>手机快速注册</h3>			
            <p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
            <p><strong>1069099988</strong></p>
        </div>

    </div>
</div>
<!-- 登录主体部分end -->


<html>
<body>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
        <a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
        <a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
        <a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->

</body>
</html>