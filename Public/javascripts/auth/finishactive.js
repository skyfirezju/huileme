$(function(){
	var wait = document.getElementById('wait');
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			window.location.href = '__APP__/index';
			clearInterval(interval);
		};
	}, 1000);
});