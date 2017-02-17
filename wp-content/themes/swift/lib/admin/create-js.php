<?php
function swift_nonblocking_js(){
	global $swift_options;

	$js = ' function loadSocial() {';
	foreach($swift_options['sm_order'] as $value):

		switch ($value) {
			case "facebook":
				$js .= '/*Facebook*/
	    if (typeof(FB) != "undefined") {
	        FB.init({
	            status: true,
	            cookie: true,
	            xfbml: true
	        });
	    } else {
	        jQuery.getScript("//connect.facebook.net/en_US/all.js#xfbml=1&appId="+swift.fb_app_id, function() {
	            FB.init({
	                status: true,
	                cookie: true,
	                xfbml: true
	            });
	        });
	    }';
				break;
			case "twitter":
				$js .= ' if (typeof(twttr) != "undefined") {
	        twttr.widgets.load();
	    } else {
	        jQuery.getScript("//platform.twitter.com/widgets.js");
	    }';
				break;
			case "google_plus":
				$js .= '/*Google - Note that the google button will not show if you are opening the page from disk - it needs to be http(s)*/
	    if (typeof(gapi) != "undefined") {
	        jQuery(".g-plusone").each(function() {
	            gapi.plusone.render(jQuery(this).get(0));
	        });
	    } else {
	        jQuery.getScript("https://apis.google.com/js/plusone.js");
		}';
				break;
			case "linkedin":
				$js .= ' /*Linked-in*/
	    if (typeof(IN) != "undefined") {
	        IN.parse();
	    } else {
	        jQuery.getScript("//platform.linkedin.com/in.js");
	    }';

				break;
			case "pinterest":
				$js .= '/* Should check if its already loaded*/
	    jQuery.getScript("//assets.pinterest.com/js/pinit.js");';
				break;

		}
	endforeach;
	$js .= '}';
	$js .= 'if(typeof(loadSocialProxy ) == "function"){
    loadSocialProxy()
}';
	return $js;
}
function swift_generate_js()
{
    global $wp_filesystem;
    global $swift_options;
    global $swift_design_options;
    $sticky = 0;

    $js = '';

    if ((isset($swift_design_options['disable_slider']) && !$swift_design_options['disable_slider']) || isset($swift_options['slider_enable']) && $swift_options['slider_enable']) {
        $filename = THEME_DIR . '/js/jquery.flexslider-min.js';
        $js .= $wp_filesystem->get_contents($filename);

        if ($swift_options['disable_sliding']) {
            $slideshow = 'false';
        } else {
            $slideshow = 'true';

        }
        $js .= "/* Activating slider */ \n";
        $js .= "jQuery(function() {
				jQuery('.flexslider').flexslider({
				slideshow:" . $slideshow . ",
				//pausePlay:true,
				slideshowSpeed:" . $swift_options['slider_speed'] . ",animationDuration: 600,prevText: '&#xf137;',nextText: '&#xf138;'});
	});\n";
    }
    if (!$swift_design_options['disable_masonry'] && !$swift_design_options['enable_fixed_height_mag']) {
        $filename = THEME_DIR . '/js/masonry-trigger-magazine.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";
    }

    if (!$swift_design_options['disable_masonry']) {
        $filename = THEME_DIR . '/js/masonry-trigger-widgets.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";
    }

	$filename = THEME_DIR . '/js/unslider.min.js';
	$js .= $wp_filesystem->get_contents($filename) . "\n";

    if (file_exists(CHILD_THEME_DIR . '/js/jquery.visible.min.js'))
        $filename = CHILD_THEME_DIR . '/js/jquery.visible.min.js';
    else
        $filename = THEME_DIR . '/js/jquery.visible.min.js';
    $js .= $wp_filesystem->get_contents($filename) . "\n";

    if (isset($swift_design_options['enable_responsive']) && $swift_design_options['enable_responsive']) {
        /*
         *
         *if (file_exists(CHILD_THEME_DIR . '/js/jquery.touchwipe.min.js'))
            $filename = CHILD_THEME_DIR . '/js/jquery.touchwipe.min.js';
        else
            $filename = THEME_DIR . '/js/jquery.touchwipe.min.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";
		*/
        if (file_exists(CHILD_THEME_DIR . '/js/jquery.sidr.min.js'))
            $filename = CHILD_THEME_DIR . '/js/jquery.sidr.min.js';
        else
            $filename = THEME_DIR . '/js/jquery.sidr.min.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";

        if (isset($swift_design_options['enable_accordion_widgets']) && $swift_design_options['enable_accordion_widgets']) {

            if (file_exists(CHILD_THEME_DIR . '/js/widgets-accordion.js'))
                $filename = CHILD_THEME_DIR . '/js/widgets-accordion.js';
            else
                $filename = THEME_DIR . '/js/widgets-accordion.js';
            $js .= $wp_filesystem->get_contents($filename) . "\n";
        }

        if (file_exists(CHILD_THEME_DIR . '/js/responsive.js'))
            $filename = CHILD_THEME_DIR . '/js/responsive.js';
        else
            $filename = THEME_DIR . '/js/responsive.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";
    }

    $sticky_nav = 0;
    $sticky_js = 'jQuery(window).load(function(){';
	$sticky_js .= 'jQuery(".stick-it").sticky();';

	if (isset($swift_design_options['sticky_nav']) && $swift_design_options['sticky_nav']) {

	    $sticky_js .= '	jQuery("#below-logo-container").sticky({topSpacing:0,bottomSpacing:0,getWidthFrom:"#wrapper"});';

        $sticky_js .= '		jQuery(window).resize(function(){
				jQuery("#below-logo-container").sticky("update");

	});';
        $sticky = 1;
        $sticky_nav = 1;
    }

	$sticky_js .= 'if( window.outerWidth>580 ){';
    if (isset($swift_design_options['sticky_nav_ad']) && $swift_design_options['sticky_nav_ad']) {
        if ($sticky_nav) {
            $sticky_js .= 'var nav_height = jQuery("#below-logo-container").outerHeight();';
        } else {
            $sticky_js .= 'var nav_height = 0;';
        }
        $sticky_js .= 'jQuery("#nav-ad-container").sticky({topSpacing:nav_height,bottomSpacing:0,getWidthFrom:"#wrapper"});';

        $sticky = 1;
        $sticky_nav_ad = 1;
    }

    if (isset($swift_design_options['sticky_sb']) && $swift_design_options['sticky_sb']) {
        $sticky_js .= 'var footer_height = 40+jQuery("#footer-container").height()+jQuery("#copyright-container").outerHeight();';
        $sticky_js .= 'var top_spacing = 20;';
        if ($sticky_nav) {
            $sticky_js .= 'top_spacing  = top_spacing+jQuery("#below-logo-container").outerHeight();';
        }
        if (isset($sticky_nav_ad) && $sticky_nav_ad) {
            $sticky_js .= 'top_spacing  = top_spacing+jQuery("#nav-ad-container").outerHeight();';
        }
	    $sticky_js .= 'jQuery("#sticky").sticky({topSpacing:top_spacing,bottomSpacing:footer_height});';
        $sticky = 1;
    }

    $sticky_js .= '}});';

    //Loading it in all cases as its needed for mobiles. 13-10-2014
    if (1 || $sticky) {
        $filename = THEME_DIR . '/js/jquery.sticky.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";
        $js .= $sticky_js . "\n";
    }

    if (file_exists(CHILD_THEME_DIR . '/js/swift-scripts.js'))
        $filename = CHILD_THEME_DIR . '/js/swift-scripts.js';
    else
        $filename = THEME_DIR . '/js/swift-scripts.js';
    $js .= $wp_filesystem->get_contents($filename) . "\n";

    if (isset($swift_design_options['disable_powertip']) && !$swift_design_options['disable_powertip']) {
        $filename = THEME_DIR . '/js/jquery.powertip.min.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";
    }

    if ((isset($swift_options['enable_np']) && $swift_options['enable_np']) ||
        (isset($swift_options['social_share']) && $swift_options['social_share']) ||
        in_array($swift_design_options['blog_or_mag'],array('magazine-grid','magazine-grid-full')) ||
        in_array($swift_design_options['blog_or_mag_archives'],array('magazine-grid','magazine-grid-full'))
        ) {
	    $js .= swift_nonblocking_js();
    }

	if (isset($swift_options['enable_np']) && $swift_options['enable_np']){
        $filename = THEME_DIR . '/js/newspaper-ajax.js';
        $js .= $wp_filesystem->get_contents($filename) . "\n";
    }

    return $js;

}

?>