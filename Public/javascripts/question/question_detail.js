var answerEditor;
var changeEditor;
var changeQuesEditor;

KindEditor.ready(function(K) {
	answerEditor = K.create("#editor_id", {
		items: ["bold", "italic", "underline", "preview", "code", "image", "link", "quickformat", "removeformat", "insertorderedlist", "insertunorderedlist"]
	});
	changeEditor = K.create("#changearea", {
		items: ["bold", "italic", "underline", "preview", "code", "image", "link", "quickformat", "removeformat", "insertorderedlist", "insertunorderedlist"]
	});
	changeQuesEditor = K.create("#changequesarea", {
		items: ["bold", "italic", "underline", "preview", "code", "image", "link", "quickformat", "removeformat", "insertorderedlist", "insertunorderedlist"]
	});

    window.editor = answerEditor;

	$("a.modify").click(function(){
    	window.editor = changeEditor;
    });
    $("a.modifyques").click(function(){
    	window.editor = changeQuesEditor;
    });
	$("#closechange").click(function(){
		window.editor.html("");
		window.editor = answerEditor;
		window.editor.html("");
	});
	$("#closequeschange").click(function(){
		window.editor.html("");
		window.editor = answerEditor;
		window.editor.html("");
	});

$(function(){
	var targetaid = $("#question").attr("aid");
	if(targetaid){
		$('li[aid='+targetaid+']').find("div.reply-content").slideDown();
		$('li[aid='+targetaid+']').find('a.reply').text("收起评论");
		var href = $('li[aid='+targetaid+']').find('a.reply').attr("href");
        var pos = $(href).offset().top;
        var adjustPos = pos-100;
        $("html,body").animate({scrollTop: adjustPos}, 1000);
	}
});

$(function(){
	var newMask = document.createElement("div");
	newMask.className = "mask";
	newMask.style.width = document.body.scrollWidth + "px";
	newMask.style.height = document.body.scrollHeight + "px";
	document.body.appendChild(newMask);

	//作用顺序的关系，绑定.mask的函数必须要在.mask的dom对象创建完之后才能有，不然就跪了，相当于给空对象加回调
	$(".mask").click(function(){
		if(window.editor){
			window.editor.html("");
		}
		window.editor = answerEditor;
		window.editor.html("");
	});

	$('#changedialog').css('left', (parseInt(document.body.scrollWidth) - 544)/2); 
	$('#changequesdialog').css('left', (parseInt(document.body.scrollWidth) - 544)/2); 

	$('.mask').hide();
	$("#changedialog").hide();
	$("#changequesdialog").hide();

	$("a.modify").click(function(){
		var answerContent = $(this).parents("div.words").find("div.answercontent").html();
		var answerId = $(this).parents("li").attr("aid");
		window.editor = changeEditor;
		$(".mask").show();
		$("#changedialog").show();
        window.editor.focus();
        window.editor.appendHtml(answerContent);
        $("#changeanswerid").text(answerId);
	});

	$("a.modifyques").click(function(){
		var questiontitle = $(this).parents("div.left").find("span.questiontitle").text();
		var questiontype = $(this).parents("div.left").find("a.tag").text();
		var questionContent = $(this).parents("div.left").find("div.intro").html();
		var questionId = $("#question").attr("qid");
		$(".mask").show();
		$("#changequesdialog").show();
		window.editor = changeQuesEditor;
        window.editor.focus();
        window.editor.appendHtml(questionContent);
        $("#changequesid").text(questionId);
        $("#changequestitle").val(questiontitle);
        if(questiontype == "生活娱乐"){
			$("#changequestype").find("option[value='0']").attr("selected", true);
		}else if(questiontype == "学习考试"){
			$("#changequestype").find("option[value='1']").attr("selected", true);
		}else if(questiontype == "规章制度"){
			$("#changequestype").find("option[value='2']").attr("selected", true);
		}else if(questiontype == "技术专业"){
			$("#changequestype").find("option[value='3']").attr("selected", true);
		}else{
			$("#changequestype").find("option[value='4']").attr("selected", true);
		}
	});
	
	$("#closechange").click(function(){
		$(".win").css("display","none");
		$(".mask").css("display","none");
	});

	$("#closequeschange").click(function(){
		$(".win").css("display","none");
		$(".mask").css("display","none");
	});
	
	$(".mask").click(function(){
		$(".win").css("display","none");
		$(".mask").css("display","none");
	});

	$("#changequestitle").blur(function(){
		checkChangeQuesTitle();
	});
	
	$("#applychange").click(function(){
		var content = window.editor.html();
		content = content.replace(/\s(style|class).[^<=]*"\B/g,"");
		// var pwd = $("#changepwd").val();
		var aid = $("#changeanswerid").text();
		/*if(pwd.replace(/[ ]/g, "")){
			$("#changepwdalert").text("");
			$.post('/answer/change_content', {
				'a_id': aid,
				'pwd': pwd,
				'content': content 
			}, function(data){
				if(data.status == 1){
					window.editor = answerEditor;
					window.location.reload();
				}
				if(data.status == 0){
					$("#changepwdalert").text("回答更新失败，请稍后再试");
				}
				if(data.status == -1){
					$("#changepwdalert").text("密码不正确");
				}
			}, 'json');
		}else{
			$("#changepwdalert").text("请输入密码");
		}*/
		$("#changepwdalert").text("");
		$.post('/answer/change_content', {
			'a_id': aid,
			'content': content 
		}, function(data){
			if(data.status == 1){
				window.editor = answerEditor;
				window.location.reload();
			}
			if(data.status == 0){
				$("#changepwdalert").text("回答更新失败，请稍后再试");
			}
		}, 'json');
	});

	$("#applychangeques").click(function(){
		var content = window.editor.html();
		var title = $("#changequestitle").val().replace(/[ ]/g,"");
		var type = $("#changequestype").find("option:selected").text().replace(/[ ]/g,"")
		var qid = $("#changequesid").text();
		$("#changequespwdalert").text("");
		content = content.replace(/\s(style|class).[^<=]*"\B/g,"");
		$.post('/question/change_content', {
			'q_id': qid,
			'title': title,
			'type': type,
			'content': content 
		}, function(data){
			if(data.status == 1){
				window.editor = answerEditor;
				window.location.reload();
			}
			if(data.status == 0){
				$("#changequespwdalert").text("回答更新失败，请稍后再试");
			}
		}, 'json');
	});

	var sessionUserid = $("#question").attr("uid");
	$("a[uid='"+sessionUserid+"']").show();
});

$(function(){
    var atUserId = 0;
    $(".reply").click(function(){
    	var flag = $(this).text().split("(")[0];
    	var replycount = $(this).parents("li").attr("replycount");
    	if(flag == "评论"){
    		var href = $(this).attr("href");
	        var pos = $(href).offset().top;
	        var adjustPos = pos-100;
	        $("html,body").animate({scrollTop: adjustPos}, 1000);
	        
	        var replyContent = $(this).parents("li").find("div.reply-content");
	        replyContent.slideDown();
	        var content = replyContent.find("input.write");
	        content.focus();
	        $(this).text("收起评论("+replycount+")");
    	}else{
    		var href = $(this).attr("href");
	        var pos = $(href).offset().top;
	        var adjustPos = pos-100;
	        $("html,body").animate({scrollTop: adjustPos}, 1000);

    		var replyContent = $(this).parents("li").find("div.reply-content");
	    	replyContent.find('input.write').val("");
	    	replyContent.slideUp();
	    	$(this).text("评论("+replycount+")");
    	}
        
    });

    $(".replytoreply").click(function(){
    	var href = $(this).attr("href");
        var pos = $(href).offset().top;
        var adjustPos = pos-100;
        $("html,body").animate({scrollTop: adjustPos}, 1000);

        var atUserName = $(this).parents("div.row").find("a.name").text().replace(/[ ]/g,"");
        var content = $(this).parents("div.reply-content").find("input.write");
        content.val("");
        content.val('@'+atUserName+'\t');
        content.focus();
	    /*atUserId = $(this).parents("li").attr("uid");
        window.editor.focus();
        window.editor.appendHtml('<strong>@'+atUserName+'\t'+'</strong>');*/
    });

    $(".sendreply").click(function(){
    	var replyMsg = $(this).parents("div.reply-content").find("input.write").val();
    	replyMsg = replyMsg.replace(/@.*?\t/, "");
    	if(replyMsg.replace(/[ ]/g, "")){
    		// showReplyVerify($(this));
    		submitReply($(this));
    	}else{
    		$($(this).parents("div.reply-content").find("div.alert")[0]).slideDown();
    	}
    });
});

function checkChangeQuesTitle(){
	var title = $("#changequestitle").val().replace(/[ ]/g,"");
	if(title){
		$("#changequestitlealert").text("");
	}else{
		$("#changequestitlealert").text("问题标题不能为空");
	}
}

$(function(){
	//虽然动态改变了agree的class，但是貌似因为jquery的初始化问题，仍然需要作判断才可以
	//$(".addagree")和$(".cancelagree")是初始化的时候决定的，很奇怪
	$(".addagree").click(function(){
		var agree = $(this);
		var object = $(this).next();
		if(agree.attr("class") == "addagree"){
			$.post('/answer/add_agree', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1) {
					agree.text(parseInt(agree.text())+1);
					agree.attr("class", "cancelagree");
					agree.attr("title", "取消赞同");
					if(object.attr("class") == "cancelobject"){
						object.attr("class", "addobject");
						object.attr("title", "反对");
					}
				}else if(data.status == -1){
					console.log('error');
				}else{
					window.location.href="/login";
				}
			}, "json");
		}else{
			$.post('/answer/cancel_agree', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1){
					agree.text(parseInt(agree.text())-1);
					agree.attr("class", "addagree");
					agree.attr("title", "赞同");
				}else if(data.status == -1){
					console.log('error');
				}else{
					window.location.href="/login";
				}
			}, "json");
		}
	});

	$(".cancelagree").click(function(){
		var agree = $(this);
		var object = $(this).next();
		if(agree.attr("class") == "cancelagree"){
			$.post('/answer/cancel_agree', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1){
					agree.text(parseInt(agree.text())-1);
					agree.attr("class", "addagree");
					agree.attr("title", "赞同");
				}else if(data.status == -1){
					console.log('error');
				}else{
					window.location.href="/login";
				}
		}, "json");
		}else{
			$.post('/answer/add_agree', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1) {
					agree.text(parseInt(agree.text())+1);
					agree.attr("class", "cancelagree");
					agree.attr("title", "取消赞同");
					if(object.attr("class") == "cancelobject"){
						object.attr("class", "addobject");
						object.attr("title", "反对");
					}
				}else if(data.status == -1){
					console.log("error");
				}else{
					window.location.href="/login";
				}
			}, "json");
		}
	});
	
	$(".addobject").click(function(){
		var object = $(this);
		var agree = $(this).prev();
		if(object.attr("class") == "addobject"){
			$.post('/answer/add_object', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1) {
					// object.text(parseInt(object.text())+1);
					object.attr("class", "cancelobject");
					object.attr("title", "取消反对");
					if(agree.attr("class") == "cancelagree"){
						agree.attr("class", "addagree");
						agree.attr("title", "赞同");
						agree.text(parseInt(agree.text())-1);
					}
				}else if(data.status == -1){
					console.log("error");
				}else{
					window.location.href="/login";
				}
			}, "json");
		}else{
			$.post('/answer/cancel_object', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1) {
					// object.text(parseInt(object.text())-1);
					object.attr("class", "addobject");
					object.attr("title", "反对");
				}else if(data.status == -1){
					console.log("error");
				}else{
					window.location.href="/login";
				}
			}, "json");
		}
		
	});

	$(".cancelobject").click(function(){
		var object = $(this);
		var agree = $(this).prev();
		if(object.attr("class") == "cancelobject"){
			$.post('/answer/cancel_object', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1) {
					// object.text(parseInt(object.text())-1);
					object.attr("class", "addobject");
					object.attr("title", "反对");
				}else if(data.status == -1){
					console.log("error");
				}else{
					window.location.href="/login";
				}
			}, "json");
		}else{
			$.post('/answer/add_object', {'id': $(this).parents("li").attr("aid")}, function(data){
				if(data.status == 1) {
					// object.text(parseInt(object.text())+1);
					object.attr("class", "cancelobject");
					object.attr("title", "取消反对");
					if(agree.attr("class") == "cancelagree"){
						agree.attr("class", "addagree");
						agree.attr("title", "赞同");
						agree.text(parseInt(agree.text())-1);
					}
				}else if(data.status == -1){
					console.log("error");
				}else{
					window.location.href="/login";
				}
			}, "json");
		}
	});

	$("#submit").click(function(){
		$("div.alert").hide();
		var content = window.editor.html();
		var invited = parseInt($("#question").attr("invited"));
		content = content.replace(/<strong>@.*?<\/strong>/, "");
		content = content.replace(/\s(style|class).[^<=]*"\B/g,"");
		if(content.replace(/[ ]/g, "")){
			// showVerify(false);
			/*if(invited){
				if($("#anonymous_check").is(":checked")){
					submitCommentAnonymous();	
				}else{
					submitComment();
				}
			}else{
				showInvite(false);				
			}*/
			if($("#anonymous_check").is(":checked")){
				submitCommentAnonymous();	
			}else{
				submitComment();
			}
		}else{
			$("#answermsg").show();
		}
    });

    $('#anonymous_submit').click(function(){
    	$("div.alert").hide();
		var content = window.editor.html();
		var invited = parseInt($("#question").attr("invited"));
		content = content.replace(/<strong>@.*?<\/strong>/, "");
		content = content.replace(/\s(style|class).[^<=]*"\B/g,"");
		if(content.replace(/[ ]/g, "")){
			// showVerify(true);
			if(invited){
				submitCommentAnonymous();
			}else{
				showInvite(true);
			}
		}else{
			$("#answermsg").show();
		}
    });

    $("a.close").click(function(){
    	var href = $(this).attr("href");
        var pos = $(href).offset().top;
        var adjustPos = pos-100;
        $("html,body").animate({scrollTop: adjustPos}, 1000);
        	
        if($(this).attr("id") == "successcancle"){
        	$("#successmsg").hide();
        }else if($(this).attr("id") == "failcancle"){
        	$("#failmsg").hide();
        }else if($(this).attr("id") == "answercancle"){
        	$("#answermsg").hide();
        }else if($(this).attr("id") == "limitcancle"){
        	$("#limitmsg").hide();
        }else{
        	$(this).parents(".alert").slideUp();
        }

    });
});
});

function submitReply($object){
	var replyMsg = $object.parents("div.reply-content").find("input.write").val();
	replyMsg = String(String(replyMsg).replace(/<script>/, "")).replace(/<\/script>/, "");
	var at = replyMsg.match(/@.*?\t/);
	var current = $object;

	if(at){
		replyMsg = replyMsg.replace(/@.*?\t/, "");
		var atUserName = String(String(at).replace(/@/, "")).replace(/\t/, "");
		atUserName = String(atUserName).replace(/[ ]/g, "");
		// var atUserId = $("li[uname='"+atUserName+"']").attr("uid");
		// var finalMsg = "<a href='/user/"+atUserId+"' target='_blank'>"+at+"</a>" + content;
		var atUserId = $("div[uname='"+atUserName+"']").attr("uid");
		var finalMsg = "<strong><a href='/user/"+atUserId+"' target='_blank'>"+at+"</a></strong>" + replyMsg;
	}else{
		var finalMsg = replyMsg;
	}

	var aid = $object.parents("li").attr("aid");
	var qid = $("#question").attr("qid");

	if(replyMsg.replace(/[ ]/g, "")){
		$.post('/answer/add_reply',{
			q_id: qid,
			a_id: aid,
			at_id: atUserId,
			msg: finalMsg
		}, function(data){
			if(data.status == 1){
				window.location.reload();	
			}
			if(data.status == 0){
				$(current.parents("div.reply-content").find("div.alert")[1]).slideDown();
			}
		}, 'json');
	}else{
		$($object.parents("div.reply-content").find("div.alert")[0]).slideDown();
	}
}

function submitComment(){
	$("div.alert").hide();
	var content = window.editor.html();
	var at = content.match(/<strong>@.*?<\/strong>/);
	content = content.replace(/\s(style|class).[^<=]*"\B/g,"");

	if(at){
		content = content.replace(/<strong>@.*?<\/strong>/, "");
		var atUserName = String(String(at).replace(/<strong>@/, "")).replace(/<\/strong>/, "");
		atUserName = String(atUserName).replace(/[ ]/g, "");
		var atUserId = $("li[uname='"+atUserName+"']").attr("uid");
		var finalContent = "<a href='/user/"+atUserId+"' target='_blank'>"+at+"</a>" + content;
	}else{
		var finalContent = content;
	}

	var qid = $("#question").attr("qid");
	if(content.replace(/[ ]/g, "")){
		$.post('/answer/add_answer',{
			q_id: qid,
			content: finalContent,
			anonymous: 0
		}, function(data){
			if(data.status == 1){
				window.location.reload();	
			}
			if(data.status == 0){
				$("#failmsg").show();
			}
			if(data.status == 3){
				$("#limitmsg").show();
			}
			if(data.status == -1){
				window.location.href = "/login";
			}
		},'json');
	}
	else{
		$('#answermsg').show();
	}
}

function submitCommentAnonymous(){
	$("div.alert").hide();
	var content = window.editor.html();
	content = content.replace(/\s(style|class).[^<=]*"\B/g,"");
	var at = content.match(/<strong>@.*?<\/strong>/);
	if(at){
		content = content.replace(/<strong>@.*?<\/strong>/, "");
		var atUserName = String(String(at).replace(/<strong>@/, "")).replace(/<\/strong>/, "");
		atUserName = String(atUserName).replace(/[ ]/g, "");
		var atUserId = $("li[uname='"+atUserName+"']").attr("uid");
		var finalContent = "<a href='/user/"+atUserId+"' target='_blank'>"+at+"</a>" + content;
	}else{
		var finalContent = content;
	}

	var qid = $("#question").attr("qid");
	if(content.replace(/[ ]/g, "")){
		$.post('/answer/add_answer', {
			"q_id": qid,
			"content": finalContent, 
			"anonymous": 1
		}, function(data){
			if(data.status == 1){
				window.location.reload();	
			}
			if(data.status == 0){
				$("#failmsg").show();
			}
			if(data.status == 3){
				$("#limitmsg").show();
			}
			if(data.status == -1){
				window.location.href = "/login";
			}
			
		}, 'json');
	}
	else{
		$('#answermsg').show();
	}
}

//for verify dialog
function showVerify(isanonymous){
	var verifytop = $(".speak").offset().top;
	if($(".verifywin").length > 0) {
		removeVerifyCode();
	}
	else{
		newVerifyCode(isanonymous);
		$(".verifywin").css('top', verifytop);
	}
}

function newVerifyCode(isanonymous){
	initVerifyCode();

	$(".verifyclose").click(function(){
		removeVerifyCode();
	});
	
	$(".verifymask").click(function(){
		removeVerifyCode();
	});

	$(".verifysubmit").click(function(){
		var verifycode = $(".verifycode").val();
		if(verifycode.replace(/[ ]/g, "")){
			$.post('/account/check_verify', {
	            verify: verifycode
	        }, function(data) {
	            if (!data.status){
					$('.verifycodealert').text("验证码不正确");
				}
				else {
					removeVerifyCode();
					$('.verifycodealert').text("");
					if(isanonymous){
						submitCommentAnonymous();
					}else{
						submitComment();
					}
				}
	        }, 'json');
		}else{
			$(".verifycodealert").text("请填写验证码");
		}
		
	});

}

function initVerifyCode(){
	var newMask = document.createElement("div");
	newMask.id = 'verifymask';  
	newMask.className = "verifymask";
	newMask.style.width = document.body.scrollWidth + "px";
	newMask.style.height = document.body.scrollHeight + "px";
		
	var newWin = document.createElement("div");
	newWin.id = 'verifywin';
	newWin.className = "verifywin";
	newWin.style.left = (parseInt(document.body.scrollWidth) - 544)/2 + "px";
	var html = '<div class="title-bar"><span>请输入验证码</span><div class="verifyclose"></div></div><div class="content"><div class="verifycodealert" style="color:red;"></div><img src="/account/verifycode"><input type="text" class="verifycode"><input type="button" value="确认" class="verifysubmit"></div>';
	newWin.innerHTML = html;

	document.body.appendChild(newMask);
	document.body.appendChild(newWin);
}

function removeVerifyCode(){
	document.body.removeChild(document.getElementById('verifymask'));
	document.body.removeChild(document.getElementById('verifywin'));
}

//for verify dialog for reply to answer
function showReplyVerify($object){
	var verifytop = $object.offset().top;
	if($(".replyverifywin").length > 0) {
		removeReplyVerifyCode();
	}
	else{
		newReplyVerifyCode($object);
		$(".replyverifywin").css('top', verifytop);
	}
}

function newReplyVerifyCode($object){
	initReplyVerifyCode();

	$(".replyverifyclose").click(function(){
		removeReplyVerifyCode();
	});
	
	$(".replyverifymask").click(function(){
		removeReplyVerifyCode();
	});

	$(".replyverifysubmit").click(function(){
		var verifycode = $(".replyverifycode").val();
		if(verifycode.replace(/[ ]/g, "")){
			$.post('/account/check_verify', {
	            verify: verifycode
	        }, function(data) {
	            if (!data.status){
					$('.replyverifycodealert').text("验证码不正确");
				}
				else {
					removeReplyVerifyCode();
					$('.replyverifycodealert').text("");
					submitReply($object);
				}
	        }, 'json');
		}else{
			$(".replyverifycodealert").text("请填写验证码");
		}
		
	});

}

function initReplyVerifyCode(){
	var newMask = document.createElement("div");
	newMask.id = 'replyverifymask';  
	newMask.className = "replyverifymask";
	newMask.style.width = document.body.scrollWidth + "px";
	newMask.style.height = document.body.scrollHeight + "px";
		
	var newWin = document.createElement("div");
	newWin.id = 'replyverifywin';
	newWin.className = "replyverifywin";
	newWin.style.left = (parseInt(document.body.scrollWidth) - 544)/2 + "px";
	var html = '<div class="title-bar"><span>请输入验证码</span><div class="replyverifyclose"></div></div><div class="content"><div class="replyverifycodealert" style="color:red;"></div><img src="/account/verifycode"><input type="text" class="replyverifycode"><input type="button" value="确认" class="replyverifysubmit"></div>';
	newWin.innerHTML = html;

	document.body.appendChild(newMask);
	document.body.appendChild(newWin);
}

function removeReplyVerifyCode(){
	document.body.removeChild(document.getElementById('replyverifymask'));
	document.body.removeChild(document.getElementById('replyverifywin'));
}

//for invite code
function showInvite(isanonymous){
	var invitetop = $(".speak").offset().top;
	if($(".invitewin").length > 0) {
		removeInviteCode();
	}
	else{
		newInviteCode(isanonymous);
		$(".invitewin").css('top', invitetop);
	}
}

function newInviteCode(isanonymous){
	initInviteCode();

	$(".inviteclose").click(function(){
		removeInviteCode();
	});
	
	$(".invitemask").click(function(){
		removeInviteCode();
	});

	$(".invitesubmit").click(function(){
		var invitecode = $(".invitecode").val();
		if(invitecode.replace(/[ ]/g, "")){
			$.post('/account/check_invite', {
	            'invitecode': invitecode
	        }, function(data) {
	            if(data.status == 0){
					$('.invitecodealert').text("邀请码不正确");
				}
				if(data.status == -1){
					$('.invitecodealert').text("邀请失败，请重新申请邀请码");
				}
				if(data.status == 1){
					removeInviteCode();
					$('.invitecodealert').text("");
					if(isanonymous){
						submitCommentAnonymous();
					}else{
						submitComment();
					}
				}
	        }, 'json');
		}else{
			$(".invitecodealert").text("请填写邀请码");
		}
		
	});
}

function initInviteCode(){
	var newMask = document.createElement("div");
	newMask.id = 'invitemask';  
	newMask.className = "invitemask";
	newMask.style.width = document.body.scrollWidth + "px";
	newMask.style.height = document.body.scrollHeight + "px";
		
	var newWin = document.createElement("div");
	newWin.id = 'invitewin';
	newWin.className = "invitewin";
	newWin.style.left = (parseInt(document.body.scrollWidth) - 544)/2 + "px";
	var html = '<div class="title-bar"><span>请输入邀请码</span><div class="inviteclose"></div></div><div class="content"><div><a style="color:green;" href="http://www.seuknower.com/question/257" target="_blank">为什么需要邀请码？</a></div><div class="invitecodealert" style="color:red;"></div><input type="text" class="invitecode"><input type="button" value="确认" class="invitesubmit"></div>';
	newWin.innerHTML = html;

	document.body.appendChild(newMask);
	document.body.appendChild(newWin);
}

function removeInviteCode(){
	document.body.removeChild(document.getElementById('invitemask'));
	document.body.removeChild(document.getElementById('invitewin'));
}