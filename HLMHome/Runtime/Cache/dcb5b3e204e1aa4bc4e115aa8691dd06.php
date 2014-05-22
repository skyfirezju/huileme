<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>登录</title>
	<link rel="icon" href="__IMAGE__/index/favicon.ico" type="image/x-icon" charset="utf-8">
	<link rel="shortcut icon" href="__IMAGE__/index/favicon.ico" type="image/x-icon">
	<link href="__CSS__/style.css?t=1398089905" rel="stylesheet" type="text/css" />
	<link href="__CSS__/flexslider.css?t=1398089905" rel="stylesheet" type="text/css"/>

	<script src="__JS__/jquery-1.9.1.js?t=1398089905"></script>
	<script src="__JS__/style.js?t=1398089905"></script>
	<script src="__JS__/jquery.flexslider-min.js?t=1398089905"></script>
	<link rel="stylesheet" href="__EDITOR__/themes/default/default.css?t=1398089905" />
	<script charset="utf-8" src="__EDITOR__/kindeditor-all-min.js?t=1398089905"></script>
	<script charset="utf-8" src="__EDITOR__/lang/zh_CN.js?t=1398089905"></script>
	<script src="__JS__/question/question_new.js?t=1398089905"></script>
	<!--  <script src="__JS__/message.js?t=1398089905" type="text/javascript"></script> -->
	<script type="text/javascript">
	
	var IMAGE = "__IMAGE__";
	var APP = "__APP__";
	var URL = "__URL__";
	var PUBLIC = "__PUBLIC__";
	var ROOT = "__ROOT__";

	jQuery(document).ready(function() {
	    /*$(window).scroll(function() {
	        var f1 = $(window).scrollTop();
	        var f2 = $("#nav").offset().top;
	        console.log("f1: %d, f2: %d", f1, f2);

	        if(f1 > 0){
	        	$("#nav").addClass("fixed", 1000);
	        }else{
	        	$("#nav").removeClass("fixed", 1000);
	        }
	    });*/
		  
	});

	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			directionNav: false, 
		});
		$('.searchbtn').click(function(){
			var current = $("#current").attr("curr");
			if(current == "question"){
				window.location.href = "__APP__/question/search/" + $('#search_content').val().replace(/[ ]/g,"") + "/1";
			}else if(current == "event"){
				window.location.href = "__APP__/event/search/" + $('#search_content').val().replace(/[ ]/g,"");
			}else if(current == "market"){
				window.location.href = "__APP__/market/search/" + $('#search_content').val().replace(/[ ]/g,"") + "/1";
			}else{
				window.location.href = "__APP__/question/search/" + $('#search_content').val().replace(/[ ]/g,"") + "/1";
			}
			
		});
		$("#search_content").keypress(function(event){
			if(event.keyCode == 13) {
				var current = $("#current").attr("curr");
				if(current == "question"){
					window.location.href = "__APP__/question/search/" + $('#search_content').val().replace(/[ ]/g,"") + "/1";
				}else if(current == "event"){
					window.location.href = "__APP__/event/search/" + $('#search_content').val().replace(/[ ]/g,"");
				}else if(current == "market"){
					window.location.href = "__APP__/market/search/" + $('#search_content').val().replace(/[ ]/g,"") + "/1";
				}else{
					window.location.href = "__APP__/question/search/" + $('#search_content').val().replace(/[ ]/g,"") + "/1";
				}
			}
		});
    });
	</script>
</head>

<body>
	<div class="navbar" id="nav">
		<div class="container">
			<div id="current" curr="<?php echo ($current); ?>" style="display:none;"></div>
			<div class="logo"> <a href="__APP__/index"><img src="__IMAGE__/header/logo.png"/></a></div>
			<div class="line"> <img src="__IMAGE__/header/line.png"/></div>
			<div class="meau">
				<ul>
					<?php if(($current) == "coach"): ?><li><a class="active" href="__APP__/coach">辅导</a></li>
					<?php else: ?>
						<li><a href="__APP__/coach">辅导</a></li><?php endif; ?>
					<?php if(($current) == "question"): ?><li><a class="active" href="__APP__/question">支教</a></li>
					<?php else: ?>
						<li><a href="__APP__/question">支教</a></li><?php endif; ?>
					<?php if(($current) == "market"): ?><li><a class="active" href="__APP__/opencourse">公开课</a></li>
					<?php else: ?>
						<li><a href="__APP__/opencourse">公开课</a></li><?php endif; ?>
				</ul>
			</div>

			<div class="search">
				<input id="search_content" type="text" name="query" placeholder="老师，课程" x-webkit-speech>
			</div>
			<div type="button" class="searchbtn">
			</div>
			
			<?php if(empty($_SESSION['userId'])): ?><div class="user">
					<a href="__APP__/login" class="login">登陆</a>
					<a href="__APP__/register" class="submit">注册</a>
				</div>
			<?php else: ?>
				<!--<div class="user">
					<div class="message active">
						<img src="__IMAGE__/index/message.png"/>
						<img class="dot" src="__IMAGE__/index/dot.png"/>
					</div>
					<a href="/user/<?php echo (session('userId')); ?>" class="name"><?php echo (session('userName')); ?></a>
					<a href="/logout" class="logout">登出</a>
				</div>-->
				<nav>
				<ul>
					<li>
						<!-- <a href="#">
							<span id="messagecount">
								<?php if(!empty($_SESSION['messagecount'])): if(($_SESSION['messagecount']) == "0"): ?>消息
									<?php else: ?>
										<?php echo (session('messagecount')); endif; ?>
								<?php else: ?>
									消息<?php endif; ?>
							</span>
						</a> -->
						<a href="#" class="mes">
							<span id="redPoint" class="red"></span>
							<span id="messagecount" class="mb">
								<?php if(!empty($_SESSION['messagecount'])): if(($_SESSION['messagecount']) == "0"): else: endif; ?>
								<?php else: endif; ?>
							</span>
						</a>
						<ul id="messagelist">
							<?php if(empty($_SESSION['messagecount'])): ?><li><a href="#">暂时没有消息</a></li>
							<?php else: ?>
								<?php if(($_SESSION['messagecount']) == "0"): ?><li><a href="#">暂时没有消息</a></li>
								<?php else: ?>
									<?php if(is_array($_SESSION['messages'])): $i = 0; $__LIST__ = $_SESSION['messages'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><li>
											<?php if(($message["type"]) == "question"): ?><a style="width:180px;" href="/question/<?php echo ($message["q_id"]); ?>"><?php echo ($message["title"]); ?></a><?php endif; ?>
											<?php if(($message["type"]) == "event"): ?><a style="width:180px;" href="/event/<?php echo ($message["e_id"]); ?>"><?php echo ($message["title"]); ?></a><?php endif; ?>
											<?php if(($message["type"]) == "commodity"): ?><a style="width:180px;" href="/market/commodity/<?php echo ($message["c_id"]); ?>"><?php echo ($message["title"]); ?></a><?php endif; ?>
										</li><?php endforeach; endif; else: echo "" ;endif; endif; endif; ?>
						</ul>
					</li>
					<li>
						<a href="#">发布</a>
						<ul>
							<li class="newquestion"><a href="#">发布问题</a></li>
							<li><a href="/market/new">发布商品</a></li>
							<li><a href="/event/new">发布活动</a></li>
						</ul>
					</li>
					<li>
						<a href="#">个人</a>
						<ul>
							<li><a href="/user/<?php echo (session('userId')); ?>" class="name">个人中心</a></li>
							<li><a href="/user/profile/<?php echo (session('userId')); ?>">个人设置</a></li>
							<li><a href="/logout">登出</a></li>
						</ul>
					</li>
				</ul>
				</nav><?php endif; ?>
		</div>
		<div class="color-line">
			<img src="__IMAGE__/index/color_line.png"/>
		</div>
	</div>
	<div class="nav-bottom">
	</div>

<div class="register">
	<div class="blank">
    <div class="white">
		<div class="title"><span id="title">登录</span></div>
		<div class="info"> 
			<div class="row">
				<span class="key">账号</span>
				<input class="value" type="text" id="username" placeholder="请输入注册邮箱/手机号/用户名"/>
				<span class="tip" id="usernamealert"></span>
			</div>
			<div class="row">
				<span class="key">密码</span>
				<input class="value" type="password" id="password" placeholder="请输入注册时的密码"/>
				<span class="tip" id="passwordalert"></span>
			</div>
			<div class="row">
				<input type="checkbox" class="check" id="rememberme"/><span>记住密码</span><a href="/account/start_change" class="forget">忘了密码？</a>
			</div>
		</div>
		<input type="button" value="确定" class="btn" id="submit"/>
	</div>
	</div>
</div>
<script src="__JS__/auth/login.js?t=1398089905"></script>
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
				<span> Copyright &copy 会了么 版权所有 All Right Reserevd</span>
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