<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>修改密码</title>
	<link href="__BOOTSTRAP__/css/bootstrap-theme.min.css?t=1398089905" rel="stylesheet" type="text/css"/>
	<link href="__BOOTSTRAP__/css/bootstrap.min.css?t=1398089905" rel="stylesheet" type="text/css"/>
	<script src="__JS__/jquery-1.9.1.js?t=1398089905"></script>
	<script src="__BOOTSTRAP__/js/bootstrap.min.js?t=1398089905"></script>
	<script src="__JS__/message.js?t=1398089905" type="text/javascript"></script>
	<script type="text/javascript">

	</script>
</head>
<body>

</body>

<div class="register">
	<div class="blank">
    <div class="white">
		<div class="title"><span id="title">填写你注册时的一卡通号</span></div>
		<div class="info"> 
			<div class="row">
				<span class="key">一卡通</span>
				<input class="value num" type="text" id="username"/>
				<span class="text">@seu.edu.cn</span>
				<span class="tip" id="usernamealert"></span>
			</div>
			<div class="row">
				<span class="key">验证码</span>
				<input class="value num" type="text" id="verify"/>
				<img id="verifykey" src="/account/verifycode"/>
				<a id="refreshVerify" href="#">看不清?</a>
				<span class="tip" id="verifyalert"></span>
			</div>
		</div>
		<input type="button" value="确定" class="btn" id="register_submit" style="display:block;"/>
	</div>
	</div>
</div>

<script src="__JS__/auth/startchangepassword.js?t=1398089905"></script>
<div class="newwin" id="newquesdialog" style="display:none;">
	<div class="title-bar">
		<span>提问</span>
		<div class="close" id="closenewques"></div>
	</div>
	<div class="content">
		<div class="question-new">
			<p>问题</p>
			<div id="newquestitlealert" style="color:red;display:none;">标题不能为空</div>
			<input type="text" class="value" id="questiontitle"/>
			<ul id="preview_ask"></ul>
			<p>问题描述</p>
			<div id="newquesintroalert" style="color:red;display:none;">
				问题描述不能为空
			</div>
			<textarea id="questionintro" style="width:100%;height:300px;"></textarea>
			<p>问题类型</p>
			<select id="questiontype">
				<option value="0">生活娱乐</option>
				<option value="1">学习考试</option>
				<option value="2">规章制度</option>
				<option value="3">技术专业</option>
				<option value="4">其他</option>
			</select>
			<div>
				<!-- <input type="checkbox" class="check" id="anonymous"/> -->
				<!-- <span>匿名提问</span> -->
				<input type="button" value="确定" class="btn" onclick="submitQuestion()"/>
			</div>
		</div>
	</div>
</div>
<div class="newwin greenwin" id="wantBuydialog" style="display:none;">
	<div class="title-bar">
		<span>求购</span>
		<div class="close" id="closecommoditywant"></div>
	</div>
	<div class="content">
		<div class="question-new">
			<p>求购标题</p>
			<div id="commoditywanttitlealert" style="color:red;display:none;">标题不能为空</div>
			<input type="text" class="value" id="commoditywanttitle"/>
			<p>求购描述</p>
			<div id="commoditywantintroalert" style="color:red;display:none;">
				问题描述不能为空
			</div>
			<textarea id="commoditywantintro" style="width:100%;height:300px;"></textarea>
			<p>求购类型</p>
			<select class="short" id="commoditytype" name="tag_cate"></select>
			<!-- <select class="short" id="secondtype" style="width:49%;margin-left:8px;display:none;"></select> -->
			<div>
				<input type="button" value="确定" class="btn" onclick="submitCommodityWant()"/>
			</div>
		</div>
	</div>
</div>
	<div class="footer">
		<div class="container">
			<div class="divide" style="display:none;"></div>
			<!--<div class="contact">
				<a href="#">意见反馈</a><span>|</span> 
				<a href="#">社团注册</a><span>|</span>
				<a href="#">加入我们</a>
			</div>-->
			<div class="copyright">
				<span> Copyright &copy 火星蚁工作室 版权所有 All Right Reserevd</span>
			</div>
		</div>
	</div>
	<div style="display:none">
	<script type="text/javascript">
		var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : " http://");
		document.write(unescape("%3Cspan id='cnzz_stat_icon_1000032604'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000032604%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
	</script>
	</div>
</body>
</html>