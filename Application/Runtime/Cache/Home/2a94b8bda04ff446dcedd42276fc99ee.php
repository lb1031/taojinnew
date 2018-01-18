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
        <div class="banner-wrap"></div>
        <div class="explain-wrap container">
            <div class="title">什么是淘金者</div>
            <div class="explain-content">
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">注册并通过认证</div>
                </div>
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">分配债务</div>
                </div>
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">通过电话进行催收</div>
                </div>
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">收获佣金</div>
                </div>
            </div>
        </div>
        <div class="adv-wrap container">
            <div class="title">我们的优势</div>
            <div class="explain-content">
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">债务信息量大</div>
                </div>
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">佣金高</div>
                </div>
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">打款快</div>
                </div>
                <div class="explain-content-item">
                	<img src="/Public/Home/images/pic.jpg" alt="">
                	<div class="explain-content-item-intro">平台靠谱</div>
                </div>
            </div>
        </div>
        <div class="coop-wrap container">
            <div class="title">我们的合作伙伴</div>
            <div class="coop-content-wrap">
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            	<div class="coop-content-item">
            		<img src="/Public/Home/images/coop_pic.jpg" alt="">
            	</div>
            </div>
        </div>
    </div>

<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="js/app.js"></script>


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