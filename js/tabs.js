(function( $ ){
	$('.page-help .content-area').velocity("transition.slideDownBigIn", 1000);
	//$('.content-area').velocity("callout.bounce", 1000);
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('form-data');
		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current').hide();
		$(this).addClass('current').velocity("callout.pulse",300);
		//$('#borderTop').velocity("transition.slideLeftIn", 1500);
		$('#borderTop').velocity("transition.slideLeftIn", 1200);
		//$("#"+tab_id).addClass('current').velocity({opacity:1,top:"0%"}).velocity("slideDown", 1300);
		//$("#"+tab_id).addClass('current').velocity("transition.bounceLeftIn", 1500);
		$("#"+tab_id).velocity("transition.slideLeftBigIn", 1000).addClass('current');
})
}) (jQuery);

