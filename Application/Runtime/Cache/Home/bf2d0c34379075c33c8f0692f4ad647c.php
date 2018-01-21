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


    <div class="body-content container">
    	<div class="auth-step-wrap">
    		<div class="auth-step">
    			<img src="/Public/Home/images/card.png" alt="">
    			<div class="auth-step-title">实名认证</div>
    		</div>
    		<div class="auth-step">
    			<img src="/Public/Home/images/arrow.png" alt="">
    		</div>
    		<div class="auth-step">
    			<img src="/Public/Home/images/card.png" alt="">
    			<div class="auth-step-title">个人征信</div>
    		</div>
    		<div class="auth-step">
    			<img src="/Public/Home/images/arrow.png" alt="">
    		</div>
    		<div class="auth-step">
    			<img src="/Public/Home/images/card.png" alt="">
    			<div class="auth-step-title">绑定银行卡</div>
    		</div>
    	</div>
    	<div class="auth-content-wrap">
    		<p class="auth-content-title login-title">实名认证</p>
    		<form action="<?php echo U('authentication');?>" METHOD="post" class="auth-content-table " enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $info['id']?>" />
    			<div class="auth-content-input">
    				<i class="fa fa-user"></i>
    				<input type="text" name="user_name" placeholder="请输入真实姓名" class="auth-intro-input">
    			</div>
    			<div class="auth-content-input">
    				<i class="fa fa-credit-card"></i>
    				<input type="text" name="card_number" placeholder="请输入身份证号" class="auth-intro-input">
    			</div>
    			<div class="auth-content-input" id='card-positive-wrap' >
    				<i class=""></i>
    				<div class="auth-content-card-positive auth-content-card" id='card-positive-btn'>
    					<input type="file" name="card_photo_positive" class="auth-content-card-file" id="card-positive" />
    				</div>
    				<div class="auth-content-intro">
    					<p>1.必须看清证件信息，且证件信息不能被遮挡(正面);</p>
    					<p>2.仅支持.jpg .bmp .png .gif 的图片格式，图片大小不超过3M;</p>
    					<p>3.您提供的照片信息将予以保护，不会用于其他用途。</p>
    				</div>
    			</div>
    			<div class="auth-content-input">
    				<i class=""></i>
    				<div class="auth-content-card-reverse auth-content-card">
    					<input type="file" name="card_photo_back" class="auth-content-card-file" />
    				</div>
    				<div class="auth-content-intro">
    					<p>1.必须看清证件信息，且证件信息不能被遮挡(反面);</p>
    					<p>2.仅支持.jpg .bmp .png .gif 的图片格式，图片大小不超过3M;</p>
    					<p>3.您提供的照片信息将予以保护，不会用于其他用途。</p>
    				</div>
    			</div>
    			<div class="auth-content-input">
    				<i class=""></i>
    				<div class="auth-content-card-personal auth-content-card">
    					<input type="file" name="verification_photo" class="auth-content-card-file"/>
    				</div>
    				<div class="auth-content-intro">
    					<p>1.清上传本人手持身份证正面头部照片和上半身照片;</p>
    					<p>2.照片为免冠、未化妆的数码照片原始图片，请勿编辑修改;</p>
    					<p>3.必须看清证件信息，且证件信息不能被遮挡，持证人五官清晰可见;</p>
    					<p>4.仅支持.jpg .bmp .png .gif 的图片格式，图片大小不超过3M;</p>
    					<p>5.您提供的照片信息将予以保护，不会用于其他用途。</p>
    				</div>
    			</div>
                <!--<button class="auth-submit">立即申请</button>-->
				<input type="submit" class="auth-submit" value="立即申请">
    		</form>
            <div class="auth-success-wrap hide">
                <div>
                    <h3>审核通过</h3>
                </div>
                <div>姓名：李白</div>
                <div>身份证：1234343</div>
                <a class="auth-success-btn" href="personal_credit.html">下一步</a>
            </div>
    	</div>
    </div>
    <div class="submit-success-wrap hide">
        <p>申请成功</p>
        <div class="submit-success-btn"><span class="dialog-close submit-success-btn">好的</span></div>
    </div>
   <layout neme="layout" />
</body>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="../js/upload.js"></script>
<script src="../js/app.js"></script>
<script>
    var replaceSpan = document.querySelector("#card-positive-btn"),
        fileInput = document.querySelector("#card-positive"),
        // add_image = document.querySelector("#card-positive-wrap");
    test = new Upload({
            maxSize: 51200,
            exts: ["png", "jpeg"],
        },
        fileInput, replaceSpan, replaceSpan, null, "");
</script>
</html>
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