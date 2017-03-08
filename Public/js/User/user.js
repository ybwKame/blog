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
});
