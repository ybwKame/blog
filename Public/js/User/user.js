/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-03-08 23:14:09
 * @version $Id$
 */
$(function(){
	$('.nav li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});

	// $('#login').click(function(){
	// 	alert('111');
	// 	var A = window.open("oauth/index.php","TencentLogin", "width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
	// });
});
