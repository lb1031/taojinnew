$(function() {

    $(".body-content").css({
        'min-height': $(window).height() - $(".header-wrap").height() - $(".footer-wrap").height() + 'px'
    });
    $('.target-button').click(function(){
    	if($(this).data("toggle")=="modal"){
    		var $targetID = $(this).data("target");
    		$($targetID).fadeIn();
    	}
    });

    $('.dialog-close').click(function(){
    	$(this).parent().parent().fadeOut();
    });
    $('.table-menu>div').each(function(index){
    	$(this).click(function(){
    		$(this).addClass('active').siblings().removeClass('active');
    		$('.table-content>div').eq(index).show().siblings().hide();
    	})
    })

})