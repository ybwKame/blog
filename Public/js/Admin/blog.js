$(function(){
	$(".nav li").click(function(){
		// alert('111');
		$(this).addClass('active').siblings().removeClass('active');
	});
});