
/* Masonry trigger */
jQuery(document).ready(function($) {
	if( Modernizr.mq('(min-width: 580px)') && Modernizr.mq('(max-width: 840px)')){
        $(function(){
            $('#sidebar').masonry({
			    // options
			    itemSelector : '.widget-mas',
			    gutterWidth:0
			  });
		});
        $(function(){
            $('#footer').masonry({
			    // options
			    itemSelector : '.footer-widgets',
			    gutterWidth:0
			  });
		});
	}
    $(window).resize(function() {
        $('#sidebar,#footer').masonry().masonry('reloadItems');
		if( Modernizr.mq('(min-width: 840px)')){
            $('.widget-mas,.footer-widgets').removeAttr('style');
			
		}
	});
});