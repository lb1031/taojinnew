<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link rel="stylesheet" href="/Public/Home/css/index.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
<div class="header-wrap">
    <div class="container header">
        <div class="logo-wrap">logo</div>
        <div class="menu-wrap">
            <ul>
                <li><a href="<?php echo U('Index/index');?>">首页</a></li>
                <li><a href="<?php echo U('Debtdunning/index');?>">债务大厅</a></li>
                <li><a href="<?php echo U('Company/about');?>">关于我们</a></li>
            </ul>
        </div>
        <div class="login-wrap">
            <a href="<?php echo U('User/login');?>">注册/登录</a>
        </div>
    </div>
</div>


<div class="body-content">
    <div class="login-content-wrap container ">
        <div class="login-content-banner"></div>
        <form action="/index.php/Home/User/regist.html" METHOD="post" class="login-form-content register-content-wrap">
            <p class="login-title">账号注册</p>
            <div class="login-input-wrap">
                <i class="fa fa-mobile"></i>
                <input type="text" placeholder="请输入手机号" name='phone' class="login-input ">
            </div>
            <div class="login-input-wrap">
                <i class="fa fa-lock"></i>
                <input type="text" placeholder="请输入验证码" name="code" class="verify-btn verify-code">
                <input type="button" name="send_code" value="获取验证码" class="verify-btn verify-code-button ">
            </div>
            <div class="login-input-wrap">
                <i class="fa fa-lock"></i>
                <input type="password" placeholder="密码" name='password' class="login-input">
            </div>
            <div class="login-input-wrap">
                <i class="fa fa-lock"></i>
                <input type="text" placeholder="确认密码" name='cpassword' class="login-input">
            </div>
            <button type="submit" class="login-botton">立即注册</button>
            <div class="login-tip">
					<span class="register-agreement">
						<input type="checkbox" checked class="register-radio">我已阅读并同意<span href="" class="register-book target-button" data-target="#agreement-modal" data-toggle="modal">《注册协议》</span>
					</span>
                <a href="<?php echo U('login');?>" class="forget-password">去登录</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script>
    $("input[name='send_code']").click(function () {
        var phone = $("input[name='phone']").val();
        var code = $("input[name='code']").val();
        if(phone.length ==0 ){
            alert('手机号不能为空');
            return false;
        }else {
            var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
            if (!myreg.test(phone)) {
                alert('请输入正确的手机号');
                return false;
            }
        }
        $.ajax({
            url:"<?php echo U('/Home/User/send');?>",
            type:"post",
            data:{"phone":phone,"code":code},
            dataType:"json",
            success:function (msg) {
                if(msg['error']=='false'){
//                console.log(msg['error']);
                }else {
//                console.log(msg['error']);;
                }
            }
        })

    })
</script>
<div class="footer-wrap">
    <div class="footer-menu container">
        <ul>
            <li>首页</li>
            <li>债务大厅</li>
            <li>关于我们</li>
        </ul>
    </div>
    <div class="footer-copyright container">
        <div>客服热线：1234454</div>
        <div>粤ICP备12088801号-1</div>
    </div>
</div>
<div class="agreement-modal modal" id='agreement-modal'>
    <div class="agreement-head">注册协议</div>
    <div class="agreement-content">
        这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容这是协议内容
    </div>
    <div class="agreement-footer">
        <span class="dialog-close agreement-agree">我同意</span>
    </div>
</div>
</body>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="/Public/Home/js/app.js"></script>
</html>