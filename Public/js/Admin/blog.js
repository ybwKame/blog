$(function(){
	$(".nav li").click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});

	$("#addcate").change(function(){
		if($(this).is(':checked')){ // 代表选中
			$("#choosecate").attr('disabled',true);
			$("#newcate").removeAttr('disabled');
		}else{
			$("#choosecate").removeAttr('disabled');
			$("#newcate").attr('disabled',true);
		}
	});

});