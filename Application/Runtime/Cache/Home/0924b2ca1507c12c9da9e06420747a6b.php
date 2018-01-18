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


    <div class="about-content body-content container">
    	<div class="about-menu table-menu">
    		<div class="about-item active">公司简介</div>
    		<div class="about-item">官方公告</div>
    		<div class="about-item">联系我们</div>
    	</div>
    	<div class="about-content-wrap table-content">
    		<div class="about-content-intro">
    			<p>催收家致力于中国不良资产的急救中心。是一家互联网+不良资产处置平台处置专业服务平台，为不良资产发布方(银行、P2P公司、小额信贷公司、消费金融公司、其他有不良资产的企业和个人)和处置方(专业的催收服务公司、专业催收服务的律师事务所、从事不良资产处置的律师)提供优质的服务。处理的不良资产涵盖银行信贷不良资产、银行信用卡不良资产、非银行不良资产（P2P、小额信贷、消费金融）以及个人借贷不良资产。</p>
    			<p>对传统不良资产处置进行智能化匹配<br/>以“互联网+不良资产”的模式，建立不良资产发布方和处置方合作联盟，构建中国不良资产的发布方和中国不良资产处置方信息资源库，以大数据方式整合有关不良资产的各类资源，服务范围覆盖全中国。</p>
    			<p>拥有专业的平台管理团队<br/>以专业的不良资产处置为核心，拥有资深的平台管理团队，管理团队成员具有多年的金融风险管控经验</p>
    		</div>
    		<div class="about-content-notice hide">
    			官方公告
    		</div>
    		<div class="about-content-notice hide">
    			联系我们
    		</div>
    	</div>
    </div>

<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="/Public/Home/js/app.js"></script>
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