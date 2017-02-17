
/* Masonry trigger */
jQuery(document).ready(function() {
	jQuery('.mag1').removeClass('temp');
	//jQuery('#mas-wrapper').css({padding:'0 5px'})
	jQuery(function(){
		  jQuery('#mas-wrapper').masonry({
		    // options
		    itemSelector : '.mag1',
		    gutter: ".gutter-sizer"
 		  });
	});
	jQuery(window).resize(function() {
		jQuery('#mas-wrapper').masonry().masonry('reloadItems');
	});
});