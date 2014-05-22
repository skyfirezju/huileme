var isa = false;
var isp = false;

$(function(){
	$('#username').blur(function(){
		var username = $(this).val();
		if(!username.replace(/[ ]/g,"")){
			$("#usernamealert").text('请填写账号');
			isa = false;
		}
		else{
			isa = true;
		}
	});
	$('#password').blur(function(){
		var password = $(this).val();
		if(!password.replace(/[ ]/g,"")){
			$("#passwordalert").text('请填写密码');
			isp = false;
		}
		else{
			$("#passwordalert").text("");
			isp = true;
		}
	});
	
	//ajax
	$('#submit').click(function(){
		if(isa && isp){
			$.post('account/check_login', {
				account: $('#username').val(), 
				password: $('#password').val(), 
				rememberme: document.getElementById('rememberme').checked
			}, function(data){
					if(data.status){
						window.location.href = 'index';
					}else{
						// alert(data.info);	
						$("#title").text(data.info);
					} 
			}, 'json');
		}
	});
});