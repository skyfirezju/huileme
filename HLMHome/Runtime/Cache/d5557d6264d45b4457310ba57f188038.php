<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>东大通首页</title>
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
	<div class="slide">
	<div class="flexslider">
		<ul class="slides">
			<li><a href="/market" target="_blank"><img src="__IMAGE__/slider/new/banner_3.jpg" /></a></li>
 			<li><a href="/event" target="_blank"><img src="__IMAGE__/slider/new/banner_1.jpg" /></a></li>
 			<li><a href="/question" target="_blank"><img src="__IMAGE__/slider/new/banner_2.jpg" /></a></li>
		</ul>
	</div>
</div>	
	<div class="container">
		<!--<div class="index-hot">
			<div class="index-title">
				<span>热门 / Hot</span>
			</div>
			<div class="tag">
				<ul>
					<li><a href="#">摄影</a></li>
					<li><a href="#">宝洁招聘</a></li>
					<li><a href="#">二手车</a></li>
					<li><a href="#">光棍脱单</a></li>
					<li class="active"><a href="#">租房</a></li>
					<li><a href="#">摄影</a></li>
					<li><a href="#">支教</a></li>
					<li><a href="#">华为招聘</a></li>
				</ul>
			</div>
		</div>-->
		
		<div class="index-activity">
			<div class="index-title">
				<span>活动 / Activity</span>
				<span style="margin-left:303px;font-size:12px;font-weight:bold;color:#000000;">| 推荐活动</span>
			</div>
			<div class="left">
				<img src="__IMAGE__/index/activity.png"/>
			</div>
			<div class="right">
				<ul>
					<?php if(is_array($hotevents)): $i = 0; $__LIST__ = $hotevents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$event): $mod = ($i % 2 );++$i;?><li>
							<div class="act">
								<a href="/event/<?php echo ($event["id"]); ?>" target="_blank"><img src="<?php echo ($event["poster"]); ?>" style="width:70px;height:90px;"></a>
								<div class="info">
									<dl>
										<dt><a href="/event/<?php echo ($event["id"]); ?>" target="_blank"><?php echo ($event["title"]); ?></a></dt>
										<dd>时间：<?php echo ($event["time"]); ?></dd>
										<dd>地点：<?php echo ($event["location"]); ?></dd>
										<!--<dd>费用：<?php echo ($event["cost"]); ?></dd>
										<dd>发起人：<?php echo ($event["organizer"]); ?></dd>-->
									</dl>
								</div>
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<!--<li>
						<div class="act">
							<img src="__IMAGE__/index/act1.jpg"/>
							<div class="info">
								<dl>
									<dt><a href="#">“光阴的故事”东南大学 土木工程学科创立暨...</a></dt>
									<dd>时间：10月20日 09:00-11:00</dd>
									<dd>地点：四牌楼校区大礼堂</dd>
									<dd>费用：免费</dd>
									<dd>发起人：官方账号</dd>
								</dl>
							</div>
						</div>
					</li>
					<li>
						<div class="act">
							<img src="__IMAGE__/index/act2.jpg"/>
							<div class="info">
								<dl>
									<dt><a href="#">“光阴的故事”东南大学 土木工程学科创立暨...</a></dt>
									<dd>时间：10月20日 09:00-11:00</dd>
									<dd>地点：四牌楼校区大礼堂</dd>
									<dd>费用：免费</dd>
									<dd>发起人：官方账号</dd>
								</dl>
							</div>
						</div>
					</li>
					<li>
						<div class="act">
							<img src="__IMAGE__/index/act3.jpg"/>
							<div class="info">
								<dl>
									<dt><a href="#">“光阴的故事”东南大学 土木工程学科创立暨...</a></dt>
									<dd>时间：10月20日 09:00-11:00</dd>
									<dd>地点：四牌楼校区大礼堂</dd>
									<dd>费用：免费</dd>
									<dd>发起人：官方账号</dd>
								</dl>
							</div>
						</div>
					</li>
					<li>
						<div class="act">
							<img src="__IMAGE__/index/act4.jpg"/>
							<div class="info">
								<dl>
									<dt><a href="#">“光阴的故事”东南大学 土木工程学科创立暨...</a></dt>
									<dd>时间：10月20日 09:00-11:00</dd>
									<dd>地点：四牌楼校区大礼堂</dd>
									<dd>费用：免费</dd>
									<dd>发起人：官方账号</dd>
								</dl>
							</div>
						</div>
					</li>-->
				</ul>
			</div>
			<div class="go">
				<a href="__APP__/event" target="_blank"><img src="__IMAGE__/index/go_normal.png"/></a>
			</div>
			<div class="divide">
			</div>
		</div>
		
		<div class="index-question">
			<div class="index-title">
				<span>问答 / Q&A </span>
			</div>
			<div class="left">
				<p class="slogan">外事问百度，内事问“东大通”</p>
				<p style="font-size:12px;font-weight:bold;color:#000000;">| 推荐问答</p>
				<ul>
					<?php if(is_array($hotquestions)): $i = 0; $__LIST__ = $hotquestions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$question): $mod = ($i % 2 );++$i;?><li>
							<a href="/question/<?php echo ($question["id"]); ?>" target="_blank" class="title"><?php echo ($question["title"]); ?></a>
							<span class="answer-count"><?php echo ($question["click_count"]); ?>次浏览</span>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="go">
					<a href="/question" target="_blank"><img src="__IMAGE__/index/go_normal.png"/></a>
				</div>
				
			</div>
			
			<div class="right">
				<div class="icon2"><div class="intro"><!--<a href="#">juhua</a>--><p style="color:#7a6c59;">juhua</p><p>留学、日语</p></div><img src="__IMAGE__/index/icon1.png"/></div>
				<div class="icon3"><div class="intro"><!--<a href="#">LFF</a>--><p style="color:#7a6c59;">LFF</p><p>摄影、旅行、背包客</p></div><img src="__IMAGE__/index/icon3.png"/></div>
				<div class="icon4"><div class="intro"><!--<a href="#">Peny</a>--><p style="color:#7a6c59;">Peny</p><p>淘宝、美妆</p></div><img src="__IMAGE__/index/icon4.png"/></div>
				<div class="icon5"><div class="intro"><!--<a href="#">Kitty</a>--><p style="color:#7a6c59;">Kitty</p><p>平面设计</p></div><img src="__IMAGE__/index/icon5.png"/></div>
			</div>
			<div class="divide">
			</div>
		</div>
		
		<div class="index-market">
			<div class="index-title">
				<span>跳蚤市场 / Flea Market</span>
			</div>
			<div class="meau">
				<ul>
					<li><a href="/market/衣物鞋帽" target="_blank"><div class="go"><img src="__IMAGE__/index/clothes_normal.png"/></div></a><br /><br /><span><a class="markettitle" href="/market/衣物鞋帽" target="_blank">衣物鞋帽</a></span></li>
					<li style="margin-left:99px;"><a href="/market/数码电子" target="_blank"><div class="go"><img src="__IMAGE__/index/computer_normal.png"/></div></a><br /><br /><span><a class="markettitle" href="/market/数码电子" target="_blank">数码电子</a></span></li>
					<li style="margin-left:99px;"><a href="/market/生活日用" target="_blank"><div class="go"><img src="__IMAGE__/index/bike_normal.png"/></div></a><br /><br /><span><a class="markettitle" href="/market/生活日用" target="_blank">生活日用</a></span></li>
					<li style="margin-left:99px;"><a href="/market/书籍杂志" target="_blank"><div class="go"><img src="__IMAGE__/index/book_normal.png"/></div></a><br /><br /><span><a class="markettitle" href="/market/书籍杂志" target="_blank">书籍杂志</a></span></li>
					<li style="margin-left:99px;"><a href="/market/0元转让" target="_blank"><div class="go"><img src="__IMAGE__/index/love_normal.png"/></div></a><br /><br /><span><a class="markettitle" href="/market/0元转让" target="_blank">0元转让</a></span></li>
				</ul>
			</div>
			<div class="divide">
			</div>
			<!--<div class="star">
				<span>★ 板块人气之星 ★</span>
			</div>-->
		</div>
		<div class="index-hot">
			<div class="index-title">
				<span>快捷入口 / Link</span>
			</div>
			<div class="tag">
				<ul>
					<li><a href="http://www.seuknower.com/question/212" target="blank">校车时刻表</a></li>
					<li><a href="http://map.seu.edu.cn/ugis/" target="blank">校园地图</a></li>
					<li><a href="http://202.119.4.150/nstudent/ggxx/DSggXXsearch.ASPx" target="blank">导师信息查询</a></li>
					<li><a href="http://xk.urp.seu.edu.cn/studentService/system/showLogin.action" target="blank">绩点查询</a></li>
					<li><a href="http://www.cnki.net/" target="blank">免费论文下载</a></li>
					<li><a href="https://nic.seu.edu.cn/selfservice/index.php" target="blank">bras充值</a></li>
					<li><a href="http://www.seu.edu.cn/s/3/t/123/p/1/c/19/d/78/list.htm" target="blank">办公电话</a></li>
					<li><a href="http://jy.seu.edu.cn/" target="blank">招聘信息</a></li>
				</ul>
			</div>
		</div>
	</div>		
	<!--<div class="index-popular">
		<div class="container">
			<ul>
				<li > <img class="icon" src="__IMAGE__/index/touxiang1.png"/> <img class="hat" src="__IMAGE__/index/xueba.png"/> <div class="intro"><a href="#">Lemon</a> <p>“学霸，学霸，我们去哪里呀 有你在就天不怕地不怕。”</p></div></li>
				<li > <img class="icon" src="__IMAGE__/index/touxiang2.png"/> <img class="hat" src="__IMAGE__/index/leifeng.png"/><div class="intro"><a href="#">Lemon</a> <p>”好人一生平安“</p></div></li>
				<li > <img class="icon" src="__IMAGE__/index/touxiang3.png"/> <img class="hat" src="__IMAGE__/index/tuhao.png"/><div class="intro"><a href="#">Lemon</a> <p>”土豪 我们做朋友吧！“</p></div></li>
			</ul>
		</div>
	</div>-->
	<script src="__JS__/index/index.js?t=1398089905"></script>
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