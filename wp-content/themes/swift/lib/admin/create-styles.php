<?php
/**
 * This file generates the stylesheet whenever the theme options are updated.
 */


function swift_minify_css($buffer)
{
	if(WP_DEBUG)
	     return $buffer;

    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

    // Remove space after colons
    $buffer = str_replace(': ', ':', $buffer);

    // Remove whitespace
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}
function swift_read_file($file){
	global $wp_filesystem;

	if (file_exists(CHILD_THEME_DIR . '/'.$file))
		$filename = CHILD_THEME_DIR . '/'.$file;
	else
		$filename = THEME_DIR . '/'.$file;

	return $wp_filesystem->get_contents($filename);
}
function swift_generate_stylesheet(){
    global $wp_filesystem;
    global $swift_font_stack;
    global $swift_options;
    global $swift_design_options;
    global $swift_typography_stack;


    $temp = get_option('SwiftOptions');
    $d_o = $temp['design_options'];

    if (isset($d_o['airy'])) {
        $padding = $d_o['airy'];
    } else {
        $padding = 10;
    }
    $wrapper = $d_o['wrapper_width'];

    if (isset($d_o['cn_ws']) && $d_o['cn_ws'] != 0) {
        $columns = $d_o['cn_ws'];
    } else {
        $columns = 3;
    }

    if (isset($d_o['content_width']) && $d_o['content_width']) {
        $content = (int)(($wrapper - 2 * $padding) * $d_o['content_width'] / 100);
    }


    if ($d_o['blog_or_mag'] == 'magazine-full') {
        $mag_wrapper_width = $wrapper - 2 * $padding;
    } else {
        $mag_wrapper_width = $content;
    }
    /* As different browsers interpret fractions differently, we make sure that magboxes width
	 * is always a integer.
	*
	* $temp_content - 20px padding - padding of mag boxes
	*/

    $rogue_pixels = ($mag_wrapper_width - 2 * $padding - 2 * $padding * ($columns - 1)) % $columns;

    //echo "rogue pixels are $rogue_pixels <br>";
    //echo "mag wrapper width is $mag_wrapper_width <br>";
    if ($rogue_pixels != 0) {

        // For full width magazing layout we change the wrapper width.
        // Content width for the other magazne layout.

        if ($d_o['blog_or_mag'] == 'magazine-full') {
            $wrapper = $wrapper + ($columns - $rogue_pixels);
            $mag_wrapper_width = $wrapper - 2 * $padding;
        } else {
            $mag_wrapper_width = $content = $content + ($columns - $rogue_pixels);
        }
    }

    //echo "mag wrapper width is $mag_wrapper_width <br>";


    // Corrected content width is adjusted to sb2
    if (isset($d_o['sb1_width']) && $d_o['sb1_width']) {
        $sb1 = (int)(($wrapper - 2 * $padding) * $d_o['sb1_width'] / 100);
        $sb2 = $wrapper - 2 * $padding - $content - $sb1;
        $sidebar = $sb1 + $sb2;
    }

    //$sb1 = $sb1 - 20;
    //$sb2 = $sb2 - 20;
    //$sidebar = $sidebar - 40;
    //$content = $content - 40;
    //$css .= '#content,#sidebar-container{padding-left:20px;padding-right:20px}';


    // Finally calculate the width of thumbnail and mag box


    $mag1 = ($mag_wrapper_width - $columns * 2 * $padding) / $columns;
    //echo "mag 1 width is $mag1";

    // Add the width of magazine box to the options table, so that we can use it in
    // the_post_thumbnail()

    $dimensions = get_option('swift_dimensions');
    if (isset($d_o['blog_thumb_width']) && $d_o['blog_thumb_width'] != 0 && isset($d_o['blog_thumb_height']) && $d_o['blog_thumb_height'] != 0)
        $dimensions['blog-thumb'] = array($d_o['blog_thumb_width'], $d_o['blog_thumb_height']);
    else
        $dimensions['blog-thumb'] = array(100, 100);

    if ($d_o['enable_fixed_height_mag']) {
        $dimensions['mag1'] = array($mag1, (int)(($mag1) / 1.62));
        $dimensions['mag1_mobile'] = array(200, (int)((240) / 1.62));
    } else {
        $dimensions['mag1'] = array($mag1, 0);
        $dimensions['mag1_mobile'] = array(200, NULL);
    }


    if (isset($d_o['content_slider_height']) && $d_o['content_slider_height'] != '')
        $dimensions['content_width_slider'] = array($content - 2 * $padding, $d_o['content_slider_height']);//20+2*8+2*1
    else
        $dimensions['content_width_slider'] = array($content - 2 * $padding, ( int )(($content) / 1.62));//20+2*8+2*1

    if (isset($d_o['full_slider_height']) && $d_o['full_slider_height'] != '')
        $dimensions['full_width_slider'] = array($wrapper, $d_o['full_slider_height']);//20+2*8+2*1
    else
        $dimensions['full_width_slider'] = array($wrapper, (int)(($wrapper) / 2));


    if (in_array($d_o['blog_or_mag'],array('magazine-full', 'magazine-grid-full'))) {
        $temp_content = $wrapper - 2 * $padding;
    } else {
        $temp_content = $content;
    }

	if (in_array($d_o['blog_or_mag_archives'],array('magazine-full', 'magazine-grid-full'))) {
		$temp_content_archives = $wrapper - 2 * $padding;
	} else {
		$temp_content_archives = $content;
	}

    /* Load FontAwesome */
    $css = "@font-face {
  				font-family: 'FontAwesome';
  				src: url('" . THEME_URI . "/css/fontawesome-{$d_o['fa_set']}/fontawesome-webfont.eot');
  				src: url('" . THEME_URI . "/css/fontawesome-{$d_o['fa_set']}/fontawesome-webfont.eot?#iefix') format('embedded-opentype'),
  				url('" . THEME_URI . "/css/fontawesome-{$d_o['fa_set']}/fontawesome-webfont.woff') format('woff'),
  				url('" . THEME_URI . "/css/fontawesome-{$d_o['fa_set']}/fontawesome-webfont.ttf') format('truetype'),
  				url('" . THEME_URI . "/css/fontawesome-{$d_o['fa_set']}/fontawesome-webfont.svg#fontawesomeregular') format('svg');
  				font-weight: normal;
  				font-style: normal;
	}";




	$css .= "#main,#footer,#copyright{padding:0 {$padding}px;}";
    $css .= '.div-content{padding:0 ' . ($padding) . 'px}';
    $css .= '.gutter-sizer{width:' . (2 * $padding) . 'px}';
    $css .= '.mag1.temp{margin-right:' . (2 * $padding) . 'px}';
    $css .= '#content,#sidebar,#woo-sidebar,#right-sidebar,#left-sidebar{padding-top:' . (2 * $padding) . 'px}';
    $css .= '#full-width-slider{margin:0 -' . ($padding) . 'px}';
    $css .= '#mas-wrapper{padding:0 ' . ($padding) . 'px}';
    $css .= 'li.comment,
            li.pingback,
            li.trackback,
            #content-width-slider,
            .mag1,
            .widget,
            .flexslider{margin-bottom:' . (2 * $padding) . 'px}';


    if ($d_o['layout'] == 'fluid') {
        $css .= "#wrapper{width:100%}\n";
        $css .= ".hybrid,#content.full-width{width:100%}\n";
        //$css .= "#content.full-width img{max-width:96%;height:auto}\n";
        $css .= ".footer-widgets{width:" . (100 / $d_o['footer_columns']) . "%;}";
	    $css .= "#full-width-slider{margin:0}";
        $content = 1162;
    } elseif ($d_o['layout'] == 'hybrid') {
        $css .= "#wrapper{width:100%}\n";
        $css .= ".hybrid{width:{$wrapper}px; margin:auto}\n";
        $css .= "#content.full-width{width:" . ($wrapper - 2 * $padding) . "px; margin:auto;max-width:100%}\n";
        //$css .= "#content.full-width img{max-width:".($wrapper-42)."px;height:auto}\n";
        $css .= "#content.full-width img{max-width:100%;height:auto}\n";
        $css .= ".footer-widgets{width:" . (int)(($wrapper - 2 * $padding) / $d_o['footer_columns']) . "px;}";


    } else {
        $css .= "#wrapper,.hybrid{width:{$wrapper}px}\n";
        $css .= "#content.full-width{width:" . ($wrapper - 2 * $padding) . "px; margin:auto}\n";
        //$css .= "#content.full-width img{max-width:".($wrapper-42)."px;height:auto}\n";
        $css .= "#content.full-width img{max-width:100%;height:auto}\n";
        if (isset($d_o['footer_columns']) && $d_o['footer_columns'])
            $css .= ".footer-widgets{width:" . (int)(($wrapper - 2 * $padding) / $d_o['footer_columns']) . "px;}";
    }

    if ($d_o['sb_position'] == 'centered') {
        $css .= '	#left{float:right}
				#sb1,#sb2{padding-top:' . (2 * $padding) . 'px}';
    } elseif ($d_o['sb_position'] == 'left') {
        $css .= "#content{float:right}\n";
    }


	$css .= "\n".'@media screen and (min-width:'.$wrapper.'px) {';
	$css .= "#content.full-width{margin:0 -".($padding)."px;padding-left: ".($padding)."px;padding-right: ".($padding)."px;}";
	$css .='}';
    if ($d_o['layout'] == 'fluid' && $d_o['sb_position'] == 'centered') {
        $css .= '#left{width:84.3%}
				#content{width:73.5%}
				#sb1{width:26.5%}
				#sb2{width:15.7%}
				#content .div-content{padding:0 10px}
				#sb1 .div-content{padding:0 10px!important;margin-top:20px}
				#sb2 .div-content{padding:0 10px!important;margin-top:20px}
				';
    }

    if (in_array($d_o['blog_or_mag'],array('magazine-full', 'magazine-grid-full')) && $d_o['layout'] != 'fluid') {
        $css .= 'body.blog.mag-full #content{width:' . ($temp_content) . 'px}';
    }

    if (in_array($d_o['blog_or_mag_archives'],array('magazine-full', 'magazine-grid-full')) && $d_o['layout'] != 'fluid') {
        $css .= 'body.archive.mag-full #content,body.search #content{width:' . ($temp_content_archives) . 'px}';
    }


    if (isset($swift_options['custom_slider_enable']) && $swift_options['custom_slider_enable']) {
        $img = $swift_options['slides'][0]['img'];
        if($img && $img !=''){
            $size = getimagesize($img);

            if ($swift_options['slider_style'] == 'content-width') {
                $dimensions['content_width_slider'][1] = $size[1];
            } else {
                $dimensions['full_width_slider'][1] = $size[1];
            }
        }
    }

	/* Handy classes for business sites */
	$double_padding = $padding;
	$css .= ".pull_t{margin-top:-{$double_padding}px}";
	$css .= ".pull_r{margin-right:-{$double_padding}px}";
	$css .= ".pull_b{margin-bottom:-{$double_padding}px}";
	$css .= ".pull_l{margin-left:-{$double_padding}px}";
	$css .= ".pull_rl{margin-right:-{$double_padding}px;margin-left:-{$double_padding}px}";
	$css .= ".pull_tb{margin-top:-{$double_padding}px;margin-bottom:-{$double_padding}px}";
	$css .= ".pull_trl{margin-top:-{$double_padding}px;margin-right:-{$double_padding}px;margin-left:-{$double_padding}px}";
	$css .= ".pull_rlb{margin-bottom:-{$double_padding}px;margin-right:-{$double_padding}px;margin-left:-{$double_padding}px}";
	$css .= ".pull_all{margin:-{$double_padding}px}";

	$css .= ".pad_t{padding-top:{$double_padding}px}";
	$css .= ".pad_r{padding-right:{$double_padding}px}";
	$css .= ".pad_l{padding-left:{$double_padding}px}";
	$css .= ".pad_b{padding-bottom:{$double_padding}px}";
	$css .= ".pad_rl{padding-right:{$double_padding}px;padding-left:{$double_padding}px;}";
	$css .= ".pad_tb{padding-top:{$double_padding}px;padding-bottom:{$double_padding}px;}";
	$css .= ".pad_trl{padding-top:{$double_padding}px;padding-right:{$double_padding}px;padding-left:{$double_padding}px;}";
	$css .= ".pad_rlb{padding-right:{$double_padding}px;padding-left:{$double_padding}px;padding-bottom:{$double_padding}px;}";
	$css .= ".pad_all{padding:{$double_padding}px}";


	$double_padding = 2*$padding;
	$css .= ".pull_t_2x{margin-top:-{$double_padding}px}";
	$css .= ".pull_r_2x{margin-right:-{$double_padding}px}";
	$css .= ".pull_b_2x{margin-bottom:-{$double_padding}px}";
	$css .= ".pull_l_2x{margin-left:-{$double_padding}px}";
	$css .= ".pull_rl_2x{margin-right:-{$double_padding}px;margin-left:-{$double_padding}px}";
	$css .= ".pull_tb_2x{margin-top:-{$double_padding}px;margin-bottom:-{$double_padding}px}";
	$css .= ".pull_trl_2x{margin-top:-{$double_padding}px;margin-right:-{$double_padding}px;margin-left:-{$double_padding}px}";
	$css .= ".pull_rlb_2x{margin-bottom:-{$double_padding}px;margin-right:-{$double_padding}px;margin-left:-{$double_padding}px}";
	$css .= ".pull_all_2x{margin:-{$double_padding}px}";

	$css .= ".pad_t_2x{padding-top:{$double_padding}px}";
	$css .= ".pad_r_2x{padding-right:{$double_padding}px}";
	$css .= ".pad_l_2x{padding-left:{$double_padding}px}";
	$css .= ".pad_b_2x{padding-bottom:{$double_padding}px}";
	$css .= ".pad_rl_2x{padding-right:{$double_padding}px;padding-left:{$double_padding}px;}";
	$css .= ".pad_tb_2x{padding-top:{$double_padding}px;padding-bottom:{$double_padding}px;}";
	$css .= ".pad_trl_2x{padding-top:{$double_padding}px;padding-right:{$double_padding}px;padding-left:{$double_padding}px;}";
	$css .= ".pad_rlb_2x{padding-right:{$double_padding}px;padding-left:{$double_padding}px;padding-bottom:{$double_padding}px;}";
	$css .= ".pad_all_2x{padding:{$double_padding}px}";

	if(!in_array($d_o['layout'], array('fixed','boxed'))){
        $css .= '.is-sticky{width:100%}';
    }
	if($d_o['layout']=='boxed'){
		$css .= "#wrapper{border:solid 1px rgba(60,60,60,.5);margin:{$d_o['boxed_margin']}px auto;padding-top:{$d_o['boxed_radius']}px;";

		if($d_o['boxed_radius'] !=0)
		$css .= "-webkit-border-radius: {$d_o['boxed_radius']}px;git
			-moz-border-radius: {$d_o['boxed_radius']}px;
			border-radius: {$d_o['boxed_radius']}px;";

		if($d_o['boxed_shadow'])
			$css .= "-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow:    0 6px 12px rgba(0,0,0,.175);
  box-shadow:         0 6px 12px rgba(0,0,0,.175);
";

		$css .= "}";
	}

    if ($d_o['layout'] != 'fluid') {
        $css .= "#content{width:{$content}px}\n";
        $css .= "#sidebar-container,#about-us,#sticky{width:{$sidebar}px}\n";
        $css .= "#main,#footer{width:{$wrapper}px}";
	    /*
	    $css .= "
body.page-template-page-full-width-hybrid #main,
body.page-template-page-full-width #main{width:{$wrapper}px}";*/
        $css .= "#sb1{width:{$sb1}px}\n";
        $css .= '#sb2{width:' . $sb2 . 'px}';
        $css .= '.mag1{width:' . $mag1 . 'px}';
        $css .= "#mas-wrapper .mag1.temp:nth-child({$columns}n+1){margin-right:0}";
        $css .= '.mag1 img.thumb{width:' . ($mag1) . 'px;height:' . (int)($mag1 / 1.62) . 'px}';

        $dimensions['content'] = $content - $padding;
        $dimensions['ws_nonsticky'] = $dimensions['wsb'] = $dimensions['wst'] = $sidebar - 2 * $padding;
        $dimensions['ns1'] = $sb1 - 2 * $padding;
        $dimensions['ns2'] = $sb2 - 2 * $padding;
        if (isset($d_o['footer_columns']) && $d_o['footer_columns'])
            $dimensions['footer'] = $dimensions['footer-1'] = $dimensions['footer-2'] = $dimensions['footer-3'] = $dimensions['footer-4'] = (int)(($wrapper - 2 * $padding) / $d_o['footer_columns'] - 2 * $padding);
        $dimensions['page_temp_l'] = $dimensions['page_temp_r'] = (int)($wrapper * .25 - 2 * $padding);
        $css .= 'body.bbpress #content,body.buddyPress #content{width:' . (int)(($wrapper - 2 * $padding) * (.7)) . 'px}';
        $css .= 'body.bbpress #sidebar-container,body.buddyPress #sidebar-container{width:' . (($wrapper - 2 * $padding) - (int)(($wrapper - 2 * $padding) * (.7))) . 'px}';

        $css .= "#full-width-slider {width:{$dimensions['full_width_slider'][0]}px;height:{$dimensions['full_width_slider'][1]}px}";
        $css .= "#content-width-slider {width:" . ($dimensions['content_width_slider'][0]) . "px;height:{$dimensions['content_width_slider'][1]}px}";

        if ($swift_options['slider_style'] == 'full-width') {
            $css .= '#custom-slider{margin:0 -' . ($padding) . 'px}';

        }
    } else {
        if ($d_o['blog_or_mag'] == 'magazine-full')
            $css .= 'body.mag-full #content, body.mag-full #content{width:100%}';

        $css .= 'article.mag1{width:' . ((100 - 2 * $columns) / $columns) . '%;padding:0;overflow:hidden}';
        $css .= 'article.temp.mag1{margin-right:1%;margin-left:1%}';
        $css .= '.mag1 .mag-thumbnail{width:100%;height:auto}';
        $css .= '.temp.mag1.omega{margin-right:0!important}';
    }

    if ($d_o['copyright_style'] == '2') {
        $css .= '#copyright{text-align:center;}';
        $css .= '#copyright li{margin:0 5px!important}';

    }
    $css .= '.temp.mag1 .entry-summary{height:' . $d_o['mag_content_height'] . 'px;overflow:hidden}';
    if (isset($swift_options['logo']) && $swift_options['logo'] != '' && (strlen($swift_options['logo']) > 10)) {
        $size = getimagesize($swift_options['logo']);
        $css .= '#social-media{line-height:' . $size[1] . 'px}';
    }

    if (isset($swift_options['logo_position']) && $swift_options['logo_position'] == 'center') {
        if (isset($swift_options['logo']) && $swift_options['logo'] != '') {
            $css .= 'img#logo{margin:auto;display:block;width:' . $size[0] . 'px;height:' . $size[1] . 'px}';
        }
        $css .= '#branding hgroup{text-align:center;width:100%}';
    } elseif ($swift_options['logo_position'] == 'left') {
        $css .= 'img#logo{float:left;}';
        $css .= '#header-ad,#social-media{float:right}';
    } else {
        $css .= 'img#logo{float:right;}';
        $css .= '#header-ad,#social-media{float:left;}';
    }


	$dimensions['np-sb'] = 300;
    update_option('swift_dimensions', $dimensions);

    /* nagative margin will overlap with isdebars in centered and left sidebars layout
	 * This is a fix for it.
	*/
    if ($d_o['sb_position'] != 'right') {
        $css .= 'li.comment .avatar{padding:5px;float:left;margin:0 10px 0 0;}';
    }

    /*
	 * Adding the navigation CSS
	*/



    if (isset($d_o['enable_responsive']) && $d_o['enable_responsive'])
        $css .= '@media screen and (min-width:580px){';

    if ($d_o['nav_style'] == 'bordered')
	    $css .= swift_read_file('css/bordered-nav.css');
    elseif ($d_o['nav_style'] == 'solid')
	    $css .= swift_read_file('css/solid-nav.css');
    else
	    $css .= swift_read_file('css/modern-nav.css');

    if (isset($d_o['enable_responsive']) && $d_o['enable_responsive'])
        $css .= '}';



    if ($d_o['nav_style'] == 'bordered')
	    $css .= swift_read_file('css/nav-search-bordered.css');
    elseif ($d_o['nav_style'] == 'solid')
	    $css .= swift_read_file('css/nav-search-solid.css');
	else
		$css .= swift_read_file('css/nav-search-modern.css');

	if ($d_o['nav_style'] == 'modern'){
		$css .= '#full-width-slider,#custom-slider{margin-top:' . (2 * $padding) . 'px}';
		if(in_array($d_o['layout'],array('fixed','boxed')))
			$css .= '#nav-ad-container{width:' . ($wrapper - 2 * $padding) . 'px;}';
	}

    if(in_array($d_o['blog_or_mag'],array('magazine-grid', 'magazine-grid-full')) || in_array($d_o['blog_or_mag_archives'],array('magazine-grid', 'magazine-grid-full'))){
        $css .= swift_read_file('/css/mag2.css');
    }

    if($d_o['blog_or_mag'] == 'magazine-grid-full'){
        $css .= '.blog .mag2{width:31.33%;margin-right:3%;}';
        $css .= '.blog .mag2:nth-child(3n+1){margin-right: 0!important;}';
    }elseif($d_o['blog_or_mag'] == 'magazine-grid') {
        $css .= '.blog .mag2{width:48%;margin-right: 4%;}';
        $css .= '.blog .mag2:nth-child(2n+1){margin-right: 0;}';
    }

    if($d_o['blog_or_mag_archives'] == 'magazine-grid-full'){
        $css .= '.archive .mag2{width:31.33%;margin-right:3%;}';
        $css .= '.archive .mag2:nth-child(3n+1){margin-right: 0;}';
    }elseif($d_o['blog_or_mag_archives'] == 'magazine-grid') {
        $css .= '.archive .mag2{width:48%;margin-right: 4%;}';
        $css .= '.archive .mag2:nth-child(2n+1){margin-right: 0;}';
    }

    if (isset($d_o['disable_form_styling']) && !$d_o['disable_form_styling']) {

        if (file_exists(CHILD_THEME_DIR . '/css/form-styling.css'))
            $filename = CHILD_THEME_DIR . '/css/form-styling.css';
        else
            $filename = THEME_DIR . '/css/form-styling.css';

        $css .= $wp_filesystem->get_contents(THEME_DIR . '/css/form-styling.css') . "\n";
    }


    if (isset($d_o['disable_table_styling']) && !$d_o['disable_table_styling']) {
        if (file_exists(CHILD_THEME_DIR . '/css/table-styling.css'))
            $filename = CHILD_THEME_DIR . '/css/table-styling.css';
        else
            $filename = THEME_DIR . '/css/table-nav.css';

        $css .= $wp_filesystem->get_contents(THEME_DIR . '/css/table-styling.css') . "\n";

    }


    $filename = THEME_DIR . '/css/fa-common.css';
    $css .= $wp_filesystem->get_contents($filename);

    $yarpp = get_option('yarpp');
    if ($yarpp && isset($yarpp['template']) && ($yarpp['template'] == 'yarpp-template-swift-images.php')) {
        $filename = THEME_DIR . '/css/gradients.css';
        $css .= $wp_filesystem->get_contents($filename);

        $filename = THEME_DIR . '/css/rp-large.css';
        $css .= $wp_filesystem->get_contents($filename);
    } elseif ($yarpp) {
        $filename = THEME_DIR . '/css/rp-regular.css';
        $css .= $wp_filesystem->get_contents($filename);
    }


    /*
	 * Adding shortcodes CSS
	*/
    if (!$d_o['disable_shortcode_css']) {
        $filename = THEME_DIR . '/css/shortcodes.css';
        $css .= $wp_filesystem->get_contents($filename);
        $filename = THEME_DIR . '/css/fontawesome-' . $d_o['fa_set'] . '/font-awesome.min.css';
        $css .= $wp_filesystem->get_contents($filename);
    } else {
        $filename = THEME_DIR . '/css/fontawesome-lite/font-awesome.min.css';
        $css .= $wp_filesystem->get_contents($filename);
    }
    if (!$d_o['disable_feedback_template']) {
        $filename = THEME_DIR . '/css/feedback-page-template.css';
        $css .= $wp_filesystem->get_contents($filename);
    }
    if (!$d_o['disable_feedback_mosaic_template']) {
        $filename = THEME_DIR . '/css/feedback-mosaic-page-template.css';
        $css .= $wp_filesystem->get_contents($filename);
    }
    if (!$d_o['disable_powertip']) {
        $filename = THEME_DIR . '/css/power-tip.css';
        $css .= $wp_filesystem->get_contents($filename);
    }
    if (!$d_o['disable_contact_form7']) {
        $filename = THEME_DIR . '/css/contact-form-7.css';
        $css .= $wp_filesystem->get_contents($filename);
    }
    if (isset($swift_options['enable_np']) && $swift_options['enable_np']) {
        $filename = THEME_DIR . '/css/newspaper.css';
        $css .= $wp_filesystem->get_contents($filename);

        $css .= ".np-mags{height:{$swift_options['np_mag_col_height']}px}";
    }

    $filename = THEME_DIR . '/css/bootstrap-flat-buttons.css';
    $css .= $wp_filesystem->get_contents($filename);


    if (isset($d_o['enable_custom_colors']) && $d_o['enable_custom_colors']):

        if (isset($d_o['default_colors']) && $d_o['default_colors']):
            $css .= "/* Layout and default colors */ \n";
            $css .= "body{background:" . swift_rgb2hex($d_o['body_bg']) . ";background:{$d_o['body_bg']};color:" . swift_rgb2hex($d_o['body']) . ";color:{$d_o['body']};}";
            $css .= "body a{color:" . swift_rgb2hex($d_o['body_a']) . ";color:{$d_o['body_a']};}\n";
            $css .= "body a:hover{color:" . swift_rgb2hex($d_o['body_a_h']) . ";color:{$d_o['body_a_h']};}\n";
            //$css .= "body a:visited{color:{$d_o['body_a_v']};}\n";
            $css .= "#wrapper{background:" . swift_rgb2hex($d_o['wrapper_bg']) . ";background:{$d_o['wrapper_bg']};}\n";
            $css .= "#main{background:" . swift_rgb2hex($d_o['main_bg']) . ";background:{$d_o['main_bg']};}\n";
            $css .= "#sidebar-container{background:" . swift_rgb2hex($d_o['sb_bg']) . ";background:{$d_o['sb_bg']};}\n";
            $css .= "#footer-container{background:{$d_o['fo_bg']};}\n";
            $css .= "#copyright-container{background:" . swift_rgb2hex($d_o['copy_bg']) . ";background:{$d_o['copy_bg']};}\n";
            $css .= "#above-header-ad-container{background:" . swift_rgb2hex($d_o['above_header_ad_bg']) . ";background:{$d_o['above_header_ad_bg']};}\n";
            $css .= "#nav-ad-container{background:" . swift_rgb2hex($d_o['nav_ad_bg']) . ";background:{$d_o['nav_ad_bg']};}\n";
            $css .= "#footer-ad-container{background:" . swift_rgb2hex($d_o['fo_ad_bg']) . ";background:{$d_o['fo_ad_bg']};}\n";
        endif;

        if (isset($d_o['header_colors']) && $d_o['header_colors']):
            $css .= "/* Header and nav menu colors */\n";
            $css .= "#header-container{background:" . swift_rgb2hex($d_o['header_bg']) . ";background:{$d_o['header_bg']};}\n";
            $css .= "#site-title a{color:" . swift_rgb2hex($d_o['blog_name']) . ";color:{$d_o['blog_name']};}\n";
            $css .= "#site-description {color:" . swift_rgb2hex($d_o['blog_tagline']) . ";color:{$d_o['blog_tagline']};}\n";
            $css .= "#social-media a{color:" . swift_rgb2hex($d_o['sm_icons']) . ";color:{$d_o['sm_icons']};}\n";
            $css .= "#social-media a:hover{color:" . swift_rgb2hex($d_o['sm_icons_h']) . ";color:{$d_o['sm_icons_h']};}\n";
        endif;

        /* Bordered nav styling */
        if ($d_o['nav_style'] == 'bordered') {
            if (isset($d_o['b_nav_above_logo']) && $d_o['b_nav_above_logo']):
                $css .= "/*above logo*/\n";
                $css .= "#above-logo-container{background:" . swift_rgb2hex($d_o['nav_a_bg']) . ";background:{$d_o['nav_a_bg']};}\n";
                $css .= "#above-logo-container{border-color:" . swift_rgb2hex($d_o['nav_a_thick_border']) . ";border-color:{$d_o['nav_a_thick_border']};}\n";
                $css .= "#above-logo-container .sw_nav li a{
                                color:" . swift_rgb2hex($d_o['nav_a_menu_a']) . ";color:{$d_o['nav_a_menu_a']};
                                background-color:" . swift_rgb2hex($d_o['nav_a_menu_a_bg']) . ";
                                background-color:{$d_o['nav_a_menu_a_bg']};
                                border-color:" . swift_rgb2hex($d_o['nav_a_menu_a_bg']) . ";
                                border-color:{$d_o['nav_a_menu_a_bg']}}\n";
                $css .= "#above-logo-container .sw_nav li a:hover,
                	#above-logo-container .sw_nav li:hover a,
                	#above-logo-container .sw_nav li.current-menu-item a{
                	           color:" . swift_rgb2hex($d_o['nav_a_menu_a_h']) . ";
                	           color:{$d_o['nav_a_menu_a_h']};
                	           background:" . swift_rgb2hex($d_o['nav_a_menu_a_h_bg']) . ";
                	           background:{$d_o['nav_a_menu_a_h_bg']};
                	           border-color:" . swift_rgb2hex($d_o['nav_a_menu_a_sep']) . ";
                	           border-color:{$d_o['nav_a_menu_a_sep']}!important}\n";
                $css .= "#above-logo-container .sw_nav li ul {
                                border-color:" . swift_rgb2hex($d_o['nav_a_menu_a_sep']) . ";
                                border-color:{$d_o['nav_a_menu_a_sep']}!important}\n";
                $css .= "#above-logo-container .sw_nav li:hover a,.sw_nav ul{
                                border-color:" . swift_rgb2hex($d_o['nav_a_thick_border']) . ";
                                border-color:{$d_o['nav_a_thick_border']};}\n";
                $css .= "#above-logo-container .sw_nav li:hover ul a{
                                color:" . swift_rgb2hex($d_o['nav_a_menu_a_h']) . ";
                                color:{$d_o['nav_a_menu_a_h']};
                                background-color:" . swift_rgb2hex($d_o['nav_a_menu_a_h_bg']) . ";
                                background-color:{$d_o['nav_a_menu_a_h_bg']}}\n";
                $css .= "#above-logo-container .sw_nav li:hover ul a:hover{
                                color:" . swift_rgb2hex($d_o['nav_a_menu_dropdown_a_h']) . ";
                                color:{$d_o['nav_a_menu_dropdown_a_h']};
                                background-color:" . swift_rgb2hex($d_o['nav_a_menu_dropdown_a_h_bg']) . ";
                                background-color:{$d_o['nav_a_menu_dropdown_a_h_bg']}}\n";

                $css .= "#above-logo-container .sw_nav li ul,
                         #above-logo-container .sw_nav li ul li ul{background-color:{$d_o['nav_a_menu_a_h_bg']}}\n";
            endif;

            if (isset($d_o['b_nav_below_logo']) && $d_o['b_nav_below_logo']):
                $css .= "/*Below logo*/\n";
                $css .= "#below-logo-container{
                                background:" . swift_rgb2hex($d_o['nav_b_bg']) . ";
                                background:{$d_o['nav_b_bg']};}\n";
                $css .= "#below-logo-container{
                                border-bottom-color:" . swift_rgb2hex($d_o['nav_b_thin_border']) . ";
                                border-bottom:solid 1px {$d_o['nav_b_thin_border']};
                                border-top:color:" . swift_rgb2hex($d_o['nav_b_thick_border']) . ";
                                border-top:solid 5px {$d_o['nav_b_thick_border']}}\n";
                $css .= "#below-logo-container .sw_nav li a{
                                color:" . swift_rgb2hex($d_o['nav_b_menu_a']) . ";
                                color:{$d_o['nav_b_menu_a']};
                                background-color:" . swift_rgb2hex($d_o['nav_b_menu_a_bg']) . ";
                                background-color:{$d_o['nav_b_menu_a_bg']};
                                border-color:" . swift_rgb2hex($d_o['nav_b_menu_a_bg']) . ";
                                border-color:{$d_o['nav_b_menu_a_bg']}}\n";
                $css .= "#below-logo-container .sw_nav li a:hover,
                	#below-logo-container .sw_nav li:hover a,
                	#below-logo-container .sw_nav li.current-menu-item a{
                	            color:" . swift_rgb2hex($d_o['nav_b_menu_a_h']) . ";
                	            color:{$d_o['nav_b_menu_a_h']};
                	            background-color:" . swift_rgb2hex($d_o['nav_b_menu_a_h_bg']) . ";
                	            background-color:{$d_o['nav_b_menu_a_h_bg']};
                	            border-color:" . swift_rgb2hex($d_o['nav_b_menu_a_sep']) . ";
                	            border-color:{$d_o['nav_b_menu_a_sep']}!important}\n";
                $css .= "#below-logo-container .sw_nav li ul {
                                border-color:" . swift_rgb2hex($d_o['nav_b_menu_a_sep']) . ";
                                border-color:{$d_o['nav_b_menu_a_sep']}!important}\n";
                $css .= "#below-logo-container .sw_nav li:hover a,.sw_nav ul{
                                border-color:" . swift_rgb2hex($d_o['nav_b_thick_border']) . ";
                                border-color:{$d_o['nav_b_thick_border']};}\n";
                $css .= "#below-logo-container .sw_nav li:hover ul a{
                                color:" . swift_rgb2hex($d_o['nav_b_menu_a_h']) . ";
                                color:{$d_o['nav_b_menu_a_h']};
                                background-color:" . swift_rgb2hex($d_o['nav_b_menu_a_h_bg']) . ";
                                background-color:{$d_o['nav_b_menu_a_h_bg']}}\n";
                $css .= "#below-logo-container .sw_nav li:hover ul a:hover{
                                color:" . swift_rgb2hex($d_o['nav_b_menu_dropdown_a_h']) . ";
                                color:{$d_o['nav_b_menu_dropdown_a_h']};
                                background-color:" . swift_rgb2hex($d_o['nav_b_menu_dropdown_a_h_bg']) . ";
                                background-color:{$d_o['nav_b_menu_dropdown_a_h_bg']}}\n";
                $css .= "#below-logo-container .sw_nav li ul,
                         #below-logo-container .sw_nav li ul li ul{background-color:{$d_o['nav_b_menu_a_h_bg']}}\n";

            endif;

        } elseif ($d_o['nav_style'] == 'solid') {
            //Solid nav colors
            if (isset($d_o['s_nav_above_logo']) && $d_o['s_nav_above_logo']):
                $css .= "/* Above logo*/\n";
                $css .= "#above-logo-container{
                            background:" . swift_rgb2hex($d_o['nav1_a_bg']) . ";
                            background:{$d_o['nav1_a_bg']};}\n";
                $css .= "#above-logo-container .sw_nav li a{
                            color:" . swift_rgb2hex($d_o['nav1_a_menu_a']) . ";
                            color:{$d_o['nav1_a_menu_a']};
                            background-color:" . swift_rgb2hex($d_o['nav1_a_menu_a_bg']) . ";
                            background-color:{$d_o['nav1_a_menu_a_bg']};}\n";
                $css .= "#above-logo-container .sw_nav li a:hover{
                            color:" . swift_rgb2hex($d_o['nav1_a_menu_a_h']) . ";
                            color:{$d_o['nav1_a_menu_a_h']};}\n";
                $css .= "#above-logo-container .sw_nav li a:hover,
        	           #above-logo-container .sw_nav li:hover a,
        	           #above-logo-container .sw_nav li.current-menu-item a {
        	               background-color:" . swift_rgb2hex($d_o['nav1_a_menu_a_h_bg']) . ";
        	               background-color:{$d_o['nav1_a_menu_a_h_bg']}}\n";
                $css .= "#above-logo-container .sw_nav li:hover ul,#above-logo-container .sw_nav li:hover a {
                            background:" . swift_rgb2hex($d_o['nav1_a_menu_a_h_bg']) . ";
                            background:{$d_o['nav1_a_menu_a_h_bg']}}\n";

                $css .= "#above-logo-container .sw_nav li:hover a{
                            color:" . swift_rgb2hex($d_o['nav1_a_menu_a_h']) . ";
                            color:{$d_o['nav1_a_menu_a_h']} }\n";


                $css .= "#above-logo-container .sw_nav li:hover ul a:hover{
                            background-color:" . swift_rgb2hex($d_o['nav1_a_menu_dropdown_a_h_bg']) . ";
                            background-color:{$d_o['nav1_a_menu_dropdown_a_h_bg']};
                            
                            
                            
                            }\n";
                $css .= "#above-logo-container .sw_nav li:hover ul a:hover{
                            color:" . swift_rgb2hex($d_o['nav1_a_menu_dropdown_a_h']) . ";
                            color:{$d_o['nav1_a_menu_dropdown_a_h']};
                            background-color:" . swift_rgb2hex($d_o['nav1_a_menu_dropdown_a_h_bg']) . ";
                            background-color:{$d_o['nav1_a_menu_dropdown_a_h_bg']}}\n";
            endif;

            if (isset($d_o['s_nav_below_logo']) && $d_o['s_nav_below_logo']):
                $css .= "/* Below logo */\n";
                $css .= "#below-logo-container{
                            background:" . swift_rgb2hex($d_o['nav1_b_bg']) . ";
                            background:{$d_o['nav1_b_bg']};}\n";
                $css .= "#below-logo-container .sw_nav li a{
                            color:" . swift_rgb2hex($d_o['nav1_b_menu_a']) . ";
                            color:{$d_o['nav1_b_menu_a']};
                            background-color:" . swift_rgb2hex($d_o['nav1_b_menu_a_bg']) . ";
                            background-color:{$d_o['nav1_b_menu_a_bg']};}\n";
                $css .= "#below-logo-container .sw_nav li a:hover{
                            color:" . swift_rgb2hex($d_o['nav1_b_menu_a_h']) . ";
                            color:{$d_o['nav1_b_menu_a_h']};}\n";
                $css .= "#below-logo-container .sw_nav li a:hover,
        	#below-logo-container .sw_nav li:hover a,
        	#below-logo-container .sw_nav li.current-menu-item a {
        	               background-color:" . swift_rgb2hex($d_o['nav1_b_menu_a_h_bg']) . ";
        	               background-color:{$d_o['nav1_b_menu_a_h_bg']}}\n";
                $css .= "#below-logo-container .sw_nav li:hover ul,#below-logo-container .sw_nav li:hover a {
                            background-color:" . swift_rgb2hex($d_o['nav1_b_menu_a_h_bg']) . ";
                            background-color:{$d_o['nav1_b_menu_a_h_bg']}}\n";

                $css .= "#below-logo-container .sw_nav li:hover a{
                            color:" . swift_rgb2hex($d_o['nav1_b_menu_a_h']) . ";
                            color:{$d_o['nav1_b_menu_a_h']} }\n";

                $css .= "#below-logo-container .sw_nav li:hover ul a:hover{
                            background-color:" . swift_rgb2hex($d_o['nav1_b_menu_dropdown_a_h_bg']) . ";
                            background-color:{$d_o['nav1_b_menu_dropdown_a_h_bg']};
                           
                            
                            }\n";
                $css .= "#below-logo-container .sw_nav li:hover ul a:hover{
                            color:" . swift_rgb2hex($d_o['nav1_b_menu_dropdown_a_h']) . ";
                            color:{$d_o['nav1_b_menu_dropdown_a_h']};
                            background-color:" . swift_rgb2hex($d_o['nav1_b_menu_dropdown_a_h_bg']) . ";
                            background-color:{$d_o['nav1_b_menu_dropdown_a_h_bg']}}\n";
            endif;

        } else {
            if (isset($d_o['m_nav_above_logo']) && $d_o['m_nav_above_logo']):
                $css .= "#above-logo-container{background-color:{$d_o['nav2_a_bg']};border-color:{$d_o['nav2_a_border']};}";
                $css .= "#above-logo-container .sw_nav li a{color:{$d_o['nav2_a_menu_a']};border-color:{$d_o['nav2_a_border']};}";
                $css .= "#above-logo-container .sw_nav li a:hover,#above-logo-container .sw_nav li.current-menu-item a{color:{$d_o['nav2_a_menu_a_h']};background-color:{$d_o['nav2_a_menu_a_h_bg']};}";
                $css .= "#above-logo-container .sw_nav ul{border-color:{$d_o['nav2_a_border']};}";
                $css .= "#above-logo-container .sw_nav ul,
                         #above-logo-container .sw_nav li:hover a,
                         #above-logo-container .sw_nav ul li a{background:{$d_o['nav2_a_menu_a_h_bg']};color:{$d_o['nav2_a_menu_a_h']}}";
                $css .= "#above-logo-container .sw_nav ul li a:hover{background:{$d_o['nav2_a_menu_dropdown_a_h_bg']};color:{$d_o['nav2_a_menu_dropdown_a_h']}}";

            endif;

            if (isset($d_o['m_nav_below_logo']) && $d_o['m_nav_below_logo']):
                $css .= "#below-logo-container{background-color:{$d_o['nav2_b_bg']};border-color:{$d_o['nav2_b_border']};}";
                $css .= "#below-logo-container .sw_nav li a{color:{$d_o['nav2_b_menu_a']};border-color:{$d_o['nav2_b_border']};}";
                $css .= "#below-logo-container .sw_nav li a:hover,#below-logo-container .sw_nav li.current-menu-item a{color:{$d_o['nav2_b_menu_a_h']};background-color:{$d_o['nav2_b_menu_a_h_bg']};}";
                $css .= "#below-logo-container .sw_nav ul{border-color:{$d_o['nav2_b_border']};}";
                $css .= "#below-logo-container .sw_nav ul,
                         #below-logo-container .sw_nav li:hover a,
                         #below-logo-container .sw_nav ul li a{background:{$d_o['nav2_b_menu_a_h_bg']};color:{$d_o['nav2_b_menu_a_h']}}";
                $css .= "#below-logo-container .sw_nav ul li a:hover{background:{$d_o['nav2_b_menu_dropdown_a_h_bg']};color:{$d_o['nav2_b_menu_dropdown_a_h']}}";

            endif;
        };

        if (isset($d_o['post_colors']) && $d_o['post_colors']):
            /* Post title colors */
            $css .= "h2.entry-title a,h1.entry-title{color:" . swift_rgb2hex($d_o['post_title']) . ";color:{$d_o['post_title']};}\n";
            $css .= ".entry-meta{color:" . swift_rgb2hex($d_o['post_meta']) . ";color:{$d_o['post_meta']};}\n";
            $css .= ".entry-meta{color:" . swift_rgb2hex($d_o['post_meta']) . ";color:{$d_o['post_meta']};}\n";
            $css .= ".entry-content blockquote{border-color:" . swift_rgb2hex($d_o['post_blockquote_border']) . ";border-color:{$d_o['post_blockquote_border']}}\n";
            $css .= ".wp-caption{background:" . swift_rgb2hex($d_o['img_caption_bg']) . ";background:{$d_o['img_caption_bg']};
                border-color:" . swift_rgb2hex($d_o['img_caption_border']) . ";border-color:{$d_o['img_caption_border']}}\n";
            $css .= ".tags a{background:" . swift_rgb2hex($d_o['post_tag_bg']) . ";background:{$d_o['post_tag_bg']};color:" . swift_rgb2hex($d_o['post_tag']) . ";color:{$d_o['post_tag']}}";
            $css .= ".tags a:hover{background:" . swift_rgb2hex($d_o['post_tag_bg_h']) . ";background:{$d_o['post_tag_bg_h']};color:" . swift_rgb2hex($d_o['post_tag']) . ";color:{$d_o['post_tag']}}";
        endif;

        if (isset($d_o['newspaper_colors']) && $d_o['newspaper_colors']):
            $css .= "#np-slider,#np-slider .flex-control-nav{background:{$d_o['np_slider_bg']}}";
            $css .= "#np-slider,#np-slider a{color:{$d_o['np_slider']}}";
            $css .= "#np-tiles .title{background:{$d_o['np_tiles_title_bg']}}";
            $css .= "#np-tiles .title a{color:{$d_o['np_tiles_title']}}";
        endif;


        if (isset($d_o['sidebar_colors']) && $d_o['sidebar_colors']):
            /* Sidebar widget colors */
            $css .= ".widget{background:" . swift_rgb2hex($d_o['sb_w_bg']) . ";background:{$d_o['sb_w_bg']};border-color:" . swift_rgb2hex($d_o['sb_w_border']) . ";border-color:{$d_o['sb_w_border']};color:" . swift_rgb2hex($d_o['sb_w']) . ";color:{$d_o['sb_w']};}\n";
            $css .= ".widget a{color:" . swift_rgb2hex($d_o['sb_w_a']) . ";color:{$d_o['sb_w_a']};}\n";
            $css .= ".widget a:hover{color:" . swift_rgb2hex($d_o['sb_w_a_h']) . ";color:{$d_o['sb_w_a_h']};}\n";
            $css .= "p.widget-title,p.np-section-title{background:" . swift_rgb2hex($d_o['sb_w_title_bg']) . ";background:{$d_o['sb_w_title_bg']};color:" . swift_rgb2hex($d_o['sb_w_title']) . ";color:{$d_o['sb_w_title']};border-color:" . swift_rgb2hex($d_o['sb_w_title_border']) . ";border-color:{$d_o['sb_w_title_border']}}\n";
            $css .= ".widget li{border-color:" . swift_rgb2hex($d_o['sb_w_li_border']) . ";border-color:{$d_o['sb_w_li_border']};}\n";
            $css .= ".widget li:hover{background:" . swift_rgb2hex($d_o['sb_w_li_hover_bg']) . ";background:{$d_o['sb_w_li_hover_bg']};}\n";
            $css .= ".widget .thumb,.widget .avatar{background:" . swift_rgb2hex($d_o['sb_w_thumb_bg']) . ";background:{$d_o['sb_w_thumb_bg']};border-color:" . swift_rgb2hex($d_o['sb_w_thumb_border']) . ";border-color:{$d_o['sb_w_thumb_border']}}\n";

            $css .= ".widget .nopadding{background:" . swift_rgb2hex($d_o['sb_w_bg']) . ";background:{$d_o['sb_w_bg']}}\n";
            $css .= ".widget .meta a{color:" . swift_rgb2hex($d_o['sb_date']) . ";color:{$d_o['sb_date']}}\n";
        endif;


        if (isset($d_o['footer_colors']) && $d_o['footer_colors']):
            /* Footer widget colors */
            $css .= ".footer .widget{background:" . swift_rgb2hex($d_o['fo_w_bg']) . ";background:{$d_o['fo_w_bg']};border-color:" . swift_rgb2hex($d_o['fo_w_border']) . ";border-color:{$d_o['fo_w_border']};color:" . swift_rgb2hex($d_o['fo_w']) . ";color:{$d_o['fo_w']};}\n";
            $css .= ".footer .widget a{color:" . swift_rgb2hex($d_o['fo_w_a']) . ";color:{$d_o['fo_w_a']};}\n";
            $css .= ".footer .widget a:hover{color:" . swift_rgb2hex($d_o['fo_w_a_h']) . ";color:{$d_o['fo_w_a_h']};}\n";
            $css .= ".footer p.widget-title{background:" . swift_rgb2hex($d_o['fo_w_title_bg']) . ";background:{$d_o['fo_w_title_bg']};color:" . swift_rgb2hex($d_o['fo_w_title']) . ";color:{$d_o['fo_w_title']};border-color:" . swift_rgb2hex($d_o['fo_w_title_border']) . ";border-color:{$d_o['fo_w_title_border']}}\n";
            $css .= ".footer .widget li{border-color:" . swift_rgb2hex($d_o['fo_w_li_border']) . ";border-color:{$d_o['fo_w_li_border']};}\n";
            $css .= ".footer .widget li:hover{background:" . swift_rgb2hex($d_o['fo_w_li_hover_bg']) . ";background:{$d_o['fo_w_li_hover_bg']};}\n";
            $css .= ".footer .widget .thumb,.footer .widget .avatar{background:" . swift_rgb2hex($d_o['fo_w_thumb_bg']) . ";background:{$d_o['fo_w_thumb_bg']};border-color:" . swift_rgb2hex($d_o['fo_w_thumb_border']) . ";border-color:{$d_o['fo_w_thumb_border']}}\n";

            $css .= ".footer .widget .nopadding{background:" . swift_rgb2hex($d_o['fo_w_bg']) . ";background:{$d_o['fo_w_bg']}}\n";
            $css .= ".footer .widget .meta a{color:" . swift_rgb2hex($d_o['fo_date']) . ";color:{$d_o['fo_date']}}\n";
        endif;


        if (isset($d_o['subscribe_widget_colors']) && $d_o['subscribe_widget_colors']):
            /* Widget styling */
            $css .= ".widget_subscribe_box{color:" . swift_rgb2hex($d_o['sub_widget']) . ";color:{$d_o['sub_widget']};background-color:" . swift_rgb2hex($d_o['sub_widget_bg']) . ";background-color:{$d_o['sub_widget_bg']};border-color:" . swift_rgb2hex($d_o['sub_widget_ribbon_bg']) . ";border-color:{$d_o['sub_widget_ribbon_bg']};}\n";
            $css .= ".sm-love{background:" . swift_rgb2hex($d_o['sub_widget_ribbon_bg']) . ";background:{$d_o['sub_widget_ribbon_bg']};}\n";
        endif;

        if (isset($d_o['comemnt_colors']) && $d_o['comemnt_colors']):
            /* Comments colors */
            $css .= "li.comment,
                li.pingback,
                li.trackback{background:" . swift_rgb2hex($d_o['comment_bg']) . ";background:{$d_o['comment_bg']};border-color:" . swift_rgb2hex($d_o['comment_border']) . ";border-color:{$d_o['comment_border']};color:" . swift_rgb2hex($d_o['comment']) . ";color:{$d_o['comment']};}\n";
            $css .= "li.comment a,
	li.pingback a,
	li.trackback a{color:" . swift_rgb2hex($d_o['comment_a']) . ";color:{$d_o['comment_a']};}\n";


            $css .= "li.comment a:hover,
	li.pingback a:hover,
	li.trackback a:hover{color:" . swift_rgb2hex($d_o['comment_a_h']) . ";color:{$d_o['comment_a_h']};}\n";

            $css .= "li.comment .avatar{background:" . swift_rgb2hex($d_o['comment_border']) . ";background:{$d_o['comment_border']};}\n"; //Avatar background is same as comemnt border


            $css .= "li.comment.bypostauthor,
	ul.children li.comment.bypostauthor{border-left-color:" . swift_rgb2hex($d_o['author_comment_bg']) . ";border-left-color:{$d_o['author_comment_bg']};}\n";
            $css .= "li.comment.bypostauthor .postauthor-avatar .avatar{background:" . swift_rgb2hex($d_o['author_comment_bg']) . ";background:{$d_o['author_comment_bg']}!important;}\n";
            /*
             $css .= ".reply{background:{$d_o['comment_reply_bg']};}\n";
            $css .= ".reply a{color:{$d_o['comment_reply']};}\n";
            $css .= ".reply:hover{background:{$d_o['comment_reply_h_bg']};}\n";
            */
            $css .= "#respond{background:" . swift_rgb2hex($d_o['comment_form_bg']) . ";background:{$d_o['comment_form_bg']};}\n";
            $css .= "#commentform input,
	#commentform textarea{background:" . swift_rgb2hex($d_o['comment_form_field_bg']) . ";background:{$d_o['comment_form_field_bg']};border-color:" . swift_rgb2hex($d_o['comment_form_field_border']) . ";border-color:{$d_o['comment_form_field_border']}}\n";

            $css .= "li.comment,li.pingback,li.trackback,li.comment .avatar{-moz-box-shadow: inset 0 2px 50px {$d_o['comment_shadow']};-webkit-box-shadow: inset 0 2px 50px {$d_o['comment_shadow']};box-shadow: inset 0 2px 50px {$d_o['comment_shadow']};}\n";
        endif;

        /* Copyright colors */
        if (isset($d_o['copyright_colors']) && $d_o['copyright_colors']):
            $css .= "#copyright-container{border-color:" . swift_rgb2hex($d_o['copyright_border']) . ";border-color:{$d_o['copyright_border']};color:" . swift_rgb2hex($d_o['copyright']) . ";color:{$d_o['copyright']}}\n";
            $css .= "#copyright-container a{color:" . swift_rgb2hex($d_o['copyright_a']) . ";color:{$d_o['copyright_a']}}\n";
            $css .= "#copyright-container a:hover{color:" . swift_rgb2hex($d_o['copyright_a_h']) . ";color:{$d_o['copyright_a_h']}}\n";
        endif;

        /* Magazine boxes */
        if (isset($d_o['mag_colors']) && $d_o['mag_colors']):
            $css .= "article.mag1 {background-color:" . swift_rgb2hex($d_o['mag1_bg']) . ";background:{$d_o['mag1_bg']};border-color:" . swift_rgb2hex($d_o['mag1_border']) . ";border-color:{$d_o['mag1_border']};}";
            $css .= "article.mag1 img{background:" . swift_rgb2hex($d_o['mag1_thumb_bg']) . ";background:{$d_o['mag1_thumb_bg']};}";
            $css .= "article.mag1 footer{background:" . swift_rgb2hex($d_o['mag1_footer_bg']) . ";background:{$d_o['mag1_footer_bg']};color:" . swift_rgb2hex($d_o['mag1_footer']) . ";color:{$d_o['mag1_footer']}}";
            $css .= "article.mag1 footer a{color:" . swift_rgb2hex($d_o['mag1_footer']) . ";color:{$d_o['mag1_footer']}}";

            $css .= "#rp-sm{background:" . swift_rgb2hex($d_o['rp_bg']) . ";background:{$d_o['rp_bg']};border-color:" . swift_rgb2hex($d_o['post_nav_bg']) . ";border-color:{$d_o['post_nav_bg']};}";
            $css .= "#nav-single{background:" . swift_rgb2hex($d_o['post_nav_bg']) . ";background:{$d_o['post_nav_bg']};}";
            $css .= "#nav-single a{color:" . swift_rgb2hex($d_o['post_nav_a']) . ";color:{$d_o['post_nav_a']};border:none}";
            $css .= "#nav-single a:hover{}";
            $css .= "#related-posts .h4{color:" . swift_rgb2hex($d_o['rp_title']) . ";color:{$d_o['rp_title']};background:" . swift_rgb2hex($d_o['rp_title_bg']) . ";background:{$d_o['rp_title_bg']};}";

            $css .= "#related-posts li a{color:" . swift_rgb2hex($d_o['rp_a']) . ";color:{$d_o['rp_a']};}";
            $css .= "#related-posts .posted-on,
		#related-posts .posted-on a{color:" . swift_rgb2hex($d_o['rp_meta']) . ";color:{$d_o['rp_meta']}}";
            $css .= "#related-posts img{background:" . swift_rgb2hex($d_o['rp_thumb_bg']) . ";background:{$d_o['rp_thumb_bg']};border-color:" . swift_rgb2hex($d_o['rp_thumb_border']) . ";border-color:{$d_o['rp_thumb_border']}}";
        endif;

        /* Author BIO */
        if (isset($d_o['author_bio_colors']) && $d_o['author_bio_colors']):
            $css .= "#author-info{background:" . swift_rgb2hex($d_o['ab_bg']) . ";background:{$d_o['ab_bg']};border-color:" . swift_rgb2hex($d_o['ab_border']) . ";border-color:{$d_o['ab_border']};color:" . swift_rgb2hex($d_o['ab']) . ";color:{$d_o['ab']};}";
            $css .= "#author-info a{color:" . swift_rgb2hex($d_o['ab_a']) . ";color:{$d_o['ab_a']};}";
            $css .= "#author-info a:hover{color:" . swift_rgb2hex($d_o['ab_a_hover']) . ";color:{$d_o['ab_a_hover']};}";
            $css .= "footer #author-info .avatar{background:" . swift_rgb2hex($d_o['ab_avatar_bg']) . ";background:{$d_o['ab_avatar_bg']};}";
        endif;

        if (isset($d_o['generic_element_colors']) && $d_o['generic_element_colors']):
            /* Generic elements */
            $css .= "a.btn,a.comment-reply-link,.btn,
	#commentform input#submit,#searchsubmit,input[type=submit] {border: 1px solid {$d_o['button_border']};border-bottom-color: {$d_o['button_bottom_border']};
	color: {$d_o['button_text']} !important;


	/*Background*/
	background-color: {$d_o['button_bg']}; /*Fallback*/
	background: -webkit-gradient(
	linear,
	left top,
	left bottom,
	color-stop(.2, {$d_o['button_gradient_start']}),
	color-stop(1, {$d_o['button_gradient_stop']})
	);
	background: -moz-linear-gradient(
	center top,
	{$d_o['button_gradient_start']} 20%,
	{$d_o['button_gradient_stop']} 100%
	);
}
a.btn:hover,.btn:hover,a.comment-reply-link:hover,
#commentform input#submit:hover,#searchsubmit:hover,input[type=submit]:hover {

/*Background*/
background-color: {$d_o['button_bg']}; /*Fallback*/
background: -webkit-gradient(
linear,
left top,
left bottom,
color-stop(.2, {$d_o['button_gradient_stop']}),
color-stop(1, {$d_o['button_gradient_start']})
);
background: -moz-linear-gradient(
center top,
{$d_o['button_gradient_stop']} 20%,
{$d_o['button_gradient_start']} 100%
);
}";

            $css .= "
	footer.home.entry-meta,
	.wp-pagenavi,
	.page-link{border-color:" . swift_rgb2hex($d_o['generic_border_light']) . ";border-color:{$d_o['generic_border_light']};}";

            $css .= "
	.wp-pagenavi a,
	.wp-pagenavi span.current,
	.page-link a,
	a.page-numbers,
	.page-numbers.current{border-color:" . swift_rgb2hex($d_o['generic_border_dark']) . ";border-color:{$d_o['generic_border_dark']};}";

            $css .= "
	.wp-pagenavi a:hover,
	.wp-pagenavi span.current,
	.page-link a:hover,
	a.page-numbers:hover,
	.page-numbers.current{background:" . swift_rgb2hex($d_o['generic_border_light']) . ";background:{$d_o['generic_border_light']};border-color:" . swift_rgb2hex($d_o['generic_border_dark']) . ";border-color:{$d_o['generic_border_dark']}}";
        endif;

        if (isset($d_o['slider_colors']) && $d_o['slider_colors']):
            // Slider colors //
            $css .= ".flex-caption{background:" . swift_rgb2hex($d_o['slide_caption_bg']) . ";background:{$d_o['slide_caption_bg']};color:" . swift_rgb2hex($d_o['slide_caption']) . ";color:{$d_o['slide_caption']};}";
            $css .= ".flex-caption a,.flex-caption a:hover{color:" . swift_rgb2hex($d_o['slide_caption']) . ";color:{$d_o['slide_caption']};}";
            $css .= ".flex-direction-nav a {color:" . swift_rgb2hex($d_o['direction_nav']) . ";color:{$d_o['direction_nav']};}";
            $css .= ".flexslider:hover .flex-direction-nav a {color:" . swift_rgb2hex($d_o['direction_nav_h']) . ";color:{$d_o['direction_nav_h']};}";
        endif;

        if (isset($d_o['tabs_widget_colors']) && $d_o['tabs_widget_colors']):
            // Swift tabs widget //
            $css .= ".widget_swift_tabs .shortcode-tabs{background:" . swift_rgb2hex($d_o['tabs_border']) . ";background:{$d_o['tabs_border']}}";
            $css .= ".widget_swift_tabs .tab_titles li.sw_nav-tab a{color:" . swift_rgb2hex($d_o['tabs_title']) . ";color:{$d_o['tabs_title']}!important;}";
            $css .= ".widget_swift_tabs .tab_titles li.sw_nav-tab.ui-tabs-selected a,
	.widget_swift_tabs .tab_titles li a:hover,
	.widget_swift_tabs .tab{background:" . swift_rgb2hex($d_o['tabs_bg']) . ";background:{$d_o['tabs_bg']}!important;color:" . swift_rgb2hex($d_o['tabs']) . ";color:{$d_o['tabs']};}";
            $css .= ".widget_swift_tabs .tab a{color:" . swift_rgb2hex($d_o['tabs_a']) . ";color:{$d_o['tabs_a']};}";
            $css .= ".widget_swift_tabs .tab a:hover{color:" . swift_rgb2hex($d_o['tabs_a_h']) . ";color:{$d_o['tabs_a_h']};}";
        endif;

        if (isset($d_o['table_colors']) && $d_o['table_colors']):
            // Table styling widget //
            $css .= ".entry-content tr th,
	.entry-content thead th {background:" . swift_rgb2hex($d_o['t_head_bg']) . ";background:{$d_o['t_head_bg']};color:" . swift_rgb2hex($d_o['t_head']) . ";color:{$d_o['t_head']}}";
            $css .= ".entry-content tr td {background:" . swift_rgb2hex($d_o['t_even_row_bg']) . ";background:{$d_o['t_even_row_bg']}}";
            $css .= ".entry-content tr:nth-child(odd) td {background:" . swift_rgb2hex($d_o['t_odd_row_bg']) . ";background:{$d_o['t_odd_row_bg']}}";

            $css .= ".entry-content table,.entry-content tr td{color:" . swift_rgb2hex($d_o['t_text']) . ";color:{$d_o['t_text']};border-color:" . swift_rgb2hex($d_o['t_border']) . ";border-color:{$d_o['t_border']}}";

            // Misc //
            $css .= ".blog-thumb{background:" . swift_rgb2hex($d_o['blog_thumb_bg']) . ";background:{$d_o['blog_thumb_bg']};border-color:" . swift_rgb2hex($d_o['blog_thumb_border']) . ";border-color:{$d_o['blog_thumb_border']};}";

        endif;

    endif;


    if (isset($d_o['cat_colors']) && is_array($d_o['cat_colors'])) {
        $values = array_unique($d_o['cat_colors']);
        require_once(trailingslashit(SWIFT_ADMIN) . 'palette.php');
        foreach ($values as $value) {
            if ($value == '')
                continue;
            $css .= '.';
            $keys = array_keys($d_o['cat_colors'], $value);
            $css .= implode(".mag1,\n.", $keys);
            $css .= ".mag1\n";
            $css .= "{background:" . swift_rgb2hex($swift_palette[$value]['bg']) . ";background:{$swift_palette[$value]['bg']};color:" . swift_rgb2hex($swift_palette[$value]['color']) . ";color:{$swift_palette[$value]['color']}}";


            $css .= '.';
            $css .= implode(".mag1 a,\n.", $keys);
            $css .= ".mag1 a\n";
            $css .= "{color:" . swift_rgb2hex($swift_palette[$value]['a']) . ";color:{$swift_palette[$value]['a']}}";

            $css .= '.';
            $css .= implode(".mag1 a:hover,\n.", $keys);
            $css .= ".mag1 a:hover\n";
            $css .= "{color:" . swift_rgb2hex($swift_palette[$value]['a_h']) . ";color:{$swift_palette[$value]['a_h']}}";

            $css .= '.';
            $css .= implode(".mag1 .entry-meta,\n.", $keys);
            $css .= ".mag1 .entry-meta\n";
            $css .= "{color:" . swift_rgb2hex($swift_palette[$value]['meta']) . ";color:{$swift_palette[$value]['meta']}}";

            $css .= '.';
            $css .= implode(".mag1 .entry-meta a,\n.", $keys);
            $css .= ".mag1 .entry-meta a\n";
            $css .= "{color:" . swift_rgb2hex($swift_palette[$value]['meta_a']) . ";color:{$swift_palette[$value]['meta_a']}}";
        }
    }


    /* Typography stacks */
    if ($d_o['swift_typography_enable']) {
        include THEME_DIR.'/typography-presets/'.$d_o['swift_typography'].'.php';
        GLOBAL $swift_typography_preset;

        $font = $swift_typography_preset['body'];
        $css .= "body{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['blog-name'];
        $css .= "#site-title{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['blog-title'];
        $css .= "#site-description{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['nav-above'];
        $css .= "#above-logo-container .sw_navigation,#above-logo-container .sw_nav a{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";


        $font = $swift_typography_preset['nav-below'];
        $css .= "#below-logo-container .sw_navigation,#below-logo-container .sw_nav a{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";
        $css .= "#header{font-size:{$font['size']}}";

        $font = $swift_typography_preset['home-page-post-title'];
        $css .= "h2.entry-title{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['mag-post-title'];
        $css .= ".mag1 h2.entry-title{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['single-post-title'];
        $css .= "h1.entry-title{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['headings'];
        $css .= "h1,h2,h3,h4,h5,h6,.post-title,.entry-title{font-family: {$font['family']};font-style:{$font['style']}; text-transform:{$font['text-transform']} }";


        $font = $swift_typography_preset['post-meta'];
        $css .= ".entry-meta{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";
        $css .= ".single-meta-above-title,
                    .single-meta-below-title,
                    .entry-meta,
                    .posted-on,
                    .widget-title,
                    .meta,
                    #cancel-comment-reply-link,
                    .np-section-title
                    {font-family:{$font['family']}}";

        $font = $swift_typography_preset['sb-widget-title'];
        $css .= ".widget-title{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['sb-widget'];
        $css .= ".widget{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['footer-widget-title'];
        $css .= "#footer .widget-title{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['footer-widget'];
        $css .= "#footer .widget{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";


        $font = $swift_typography_preset['copyright'];
        $css .= "#copyright{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";

        $font = $swift_typography_preset['comments'];
        $css .= ".commentlist{font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";


    }

    /* Fonts */

    /*body*/
    if ($d_o['body_font_enable']) {
        if ($d_o['body_font_family'] == 'Use default')
            $d_o['body_font_family'] = 'Georgia';
        $css .= "body{font:{$d_o['body_font_style']} {$d_o['body_font_weight']} {$d_o['body_font_size']}{$d_o['body_font_size_unit']}/{$d_o['body_font_lh']}{$d_o['body_font_lh_unit']} {$d_o['body_font_family']};text-transform:{$d_o['body_font_transform']};}";
    }

    $css .= ".entry-content,
	.entry-summary,
	.widget,
	.comment{text-align:{$d_o['body_text_align']};}";

    /* blog title */
    if ($d_o['blog_name_font_enable']) {

        if ($d_o['blog_name_font_family'] == 'Use default')
            $d_o['blog_name_font_family'] = 'Georgia';
        $css .= "#site-title {font:{$d_o['blog_name_font_style']} {$d_o['blog_name_font_weight']} {$d_o['blog_name_font_size']}{$d_o['blog_name_font_size_unit']}/{$d_o['blog_name_font_lh']}{$d_o['blog_name_font_lh_unit']} {$d_o['blog_name_font_family']};text-transform:{$d_o['blog_name_font_transform']}}";
    }

    /* Blog tag line */
    if ($d_o['blog_tagline_font_enable']) {
        if ($d_o['blog_tagline_font_family'] == 'Use default')
            $d_o['blog_tagline_font_family'] = 'Georgia';
        $css .= "#site-description {font:{$d_o['blog_tagline_font_style']} {$d_o['blog_tagline_font_weight']} {$d_o['blog_tagline_font_size']}{$d_o['blog_tagline_font_size_unit']}/{$d_o['blog_tagline_font_lh']}{$d_o['blog_tagline_font_lh_unit']} {$d_o['blog_tagline_font_family']};text-transform:{$d_o['blog_tagline_font_transform']}}";

    }

    /* Navigation */
    if ($d_o['nav_a_font_enable']) {
        if ($d_o['nav_a_font_family'] == 'Use default')
            $d_o['nav_a_font_family'] = 'Georgia';
        $css .= "#above-logo-container .sw_navigation,#above-logo-container .sw_nav a,#above-logo-container #navsearch {font:{$d_o['nav_a_font_style']} {$d_o['nav_a_font_weight']} {$d_o['nav_a_font_size']}{$d_o['nav_a_font_size_unit']}/1.625em {$d_o['nav_a_font_family']};text-transform:{$d_o['nav_a_font_transform']}}";

        /* RSS icons height depends on the nav font height */
        // if($d_o['nav_a_font_size_unit'] == 'px')
        $height = (1.625 / 2) * $d_o['nav_a_font_size'] . "{$d_o['nav_a_font_size_unit']}";
        //$css .= "#rss-links li a{padding:{$height}}";

    }
    if ($d_o['nav_b_font_enable']) {
        if ($d_o['nav_b_font_family'] == 'Use default')
            $d_o['nav_b_font_family'] = 'Georgia';
        $css .= "#below-logo-container .sw_navigation,#below-logo-container .sw_nav a,#below-logo-container #navsearch{font:{$d_o['nav_b_font_style']} {$d_o['nav_b_font_weight']} {$d_o['nav_b_font_size']}{$d_o['nav_b_font_size_unit']}/1.625em {$d_o['nav_b_font_family']};text-transform:{$d_o['nav_b_font_transform']}}";
        //$css .= "#header{font-size:{$d_o['nav_b_font_size']}{$d_o['nav_b_font_size_unit']}}";

    }
    /* Heading font */
    if ($d_o['heading_tags_enable']) {
        $css .= "h1,h2,h3,h4,h5,h6{font-family:{$d_o['heading_tags_family']};font-weight:{$d_o['heading_tags_weight']};font-style:{$d_o['heading_tags_style']};text-transform:{$d_o['heading_tags_transform']}}";
    }


    /* Home page post title (BLOG) */
    if ($d_o['home_post_title_enable']) {
        if ($d_o['home_post_title_family'] == 'Use default')
            $d_o['home_post_title_family'] = 'Georgia';
        $css .= "h2.entry-title{font:{$d_o['home_post_title_style']} {$d_o['home_post_title_weight']} {$d_o['home_post_title_size']}{$d_o['home_post_title_size_unit']}/{$d_o['home_post_title_lh']}{$d_o['home_post_title_lh_unit']} {$d_o['home_post_title_family']};text-transform:{$d_o['home_post_title_transform']}}";
    }

    /* Home page post title (MAGAZINE) */
    if ($d_o['home_post_title_mag_enable']) {
        if ($d_o['home_post_title_mag_family'] == 'Use default')
            $d_o['home_post_title_mag_family'] = 'Georgia';
        $css .= "article.mag1 h2.entry-title{font:{$d_o['home_post_title_mag_style']} {$d_o['home_post_title_mag_weight']} {$d_o['home_post_title_mag_size']}{$d_o['home_post_title_mag_size_unit']}/{$d_o['home_post_title_mag_lh']}{$d_o['home_post_title_mag_lh_unit']} {$d_o['home_post_title_mag_family']};text-transform:{$d_o['home_post_title_mag_transform']}}";
    }

    /* Single page post title */
    if ($d_o['single_post_title_enable']) {
        if ($d_o['single_post_title_family'] == 'Use default')
            $d_o['single_post_title_family'] = 'Georgia';
        $css .= "h1.entry-title{font:{$d_o['single_post_title_style']} {$d_o['single_post_title_weight']} {$d_o['single_post_title_size']}{$d_o['single_post_title_size_unit']}/{$d_o['single_post_title_lh']}{$d_o['single_post_title_lh_unit']} {$d_o['single_post_title_family']};text-transform:{$d_o['single_post_title_transform']}}";
    }

    /* Post meta *
	 if( $d_o['post_meta_font_enable'] ){
	if( $d_o['post_meta_font_family'] == 'Use default')
		$d_o['post_meta_font_family'] = 'Georgia';
	$css .= ".single-meta-above-title,
	.single-meta-below-title,
	.single-meta-above-title a,
	.single-meta-below-title a,
	.meta a{font:{$d_o['post_meta_font_style']} {$d_o['post_meta_font_weight']} {$d_o['post_meta_font_size']}{$d_o['post_meta_font_size_unit']}/{$d_o['post_meta_font_lh']}{$d_o['post_meta_font_lh_unit']} {$d_o['post_meta_font_family']};text-transform:{$d_o['post_meta_font_transform']}}";
	}

	/* Sidebar title */
    if ($d_o['sidebar_title_font_enable']) {
        if ($d_o['sidebar_title_font_family'] == 'Use default')
            $d_o['sidebar_title_font_family'] = 'Georgia';
        $css .= "p.widget-title{font:{$d_o['sidebar_title_font_style']} {$d_o['sidebar_title_font_weight']} {$d_o['sidebar_title_font_size']}{$d_o['sidebar_title_font_size_unit']}/{$d_o['sidebar_title_font_lh']}{$d_o['sidebar_title_font_lh_unit']} {$d_o['sidebar_title_font_family']};text-transform:{$d_o['sidebar_title_font_transform']}}";
    }

    /* Sidebar widget */
    if ($d_o['sidebar_widget_font_enable']) {
        if ($d_o['sidebar_widget_font_family'] == 'Use default')
            $d_o['sidebar_widget_font_family'] = 'Georgia';
        $css .= "#sidebar .widget{font:{$d_o['sidebar_widget_font_style']} {$d_o['sidebar_widget_font_weight']} {$d_o['sidebar_widget_font_size']}{$d_o['sidebar_widget_font_size_unit']}/{$d_o['sidebar_widget_font_lh']}{$d_o['sidebar_widget_font_lh_unit']} {$d_o['sidebar_widget_font_family']};text-transform:{$d_o['sidebar_widget_font_transform']}}";
    }

    /* Footer title */
    if ($d_o['footer_title_font_enable']) {
        if ($d_o['footer_title_font_family'] == 'Use default')
            $d_o['footer_title_font_family'] = 'Georgia';
        $css .= "#footer p.widget-title{font:{$d_o['footer_title_font_style']} {$d_o['footer_title_font_weight']} {$d_o['footer_title_font_size']}{$d_o['footer_title_font_size_unit']}/{$d_o['footer_title_font_lh']}{$d_o['footer_title_font_lh_unit']} {$d_o['footer_title_font_family']};text-transform:{$d_o['footer_title_font_transform']}}";
    }

    /* Footer widget */
    if ($d_o['footer_widget_font_enable']) {
        if ($d_o['footer_widget_font_family'] == 'Use default')
            $d_o['footer_widget_font_family'] = 'Georgia';
        $css .= "#footer .widget{font:{$d_o['footer_widget_font_style']} {$d_o['footer_widget_font_weight']} {$d_o['footer_widget_font_size']}{$d_o['footer_widget_font_size_unit']}/{$d_o['footer_widget_font_lh']}{$d_o['footer_widget_font_lh_unit']} {$d_o['footer_widget_font_family']};text-transform:{$d_o['footer_widget_font_transform']}}";
    }

    /* Copyright container */
    if ($d_o['copyright_font_enable']) {
        if ($d_o['copyright_font_family'] == 'Use default')
            $d_o['copyright_font_family'] = 'Georgia';
        $css .= "#copyright{font:{$d_o['copyright_font_style']} {$d_o['copyright_font_weight']} {$d_o['copyright_font_size']}{$d_o['copyright_font_size_unit']}/{$d_o['copyright_font_lh']}{$d_o['copyright_font_lh_unit']} {$d_o['copyright_font_family']};text-transform:{$d_o['copyright_font_transform']}}";
    }

    /* Background images */
    if (isset($d_o['html_bg_image']) && $d_o['html_bg_image'])
        $css .= 'html{background-image: url("' . $d_o['html_bg_image'] . '");background-repeat:' . $d_o['html_bg_image_repeat'] . ';background-position:' . $d_o['html_bg_image_p_l'] . ' ' . $d_o['html_bg_image_p_t'] . ' ;}' . "\n";

    if (isset($d_o['body_bg_image']) && $d_o['body_bg_image'])
        $css .= 'body{background-color:' . $d_o['body_bg'] . ';background-image: url("' . $d_o['body_bg_image'] . '");background-repeat:' . $d_o['body_bg_image_repeat'] . ';background-position:' . $d_o['body_bg_image_p_l'] . ' ' . $d_o['body_bg_image_p_t'] . ' ;}' . "\n";

    if (isset($d_o['wrapper_bg_image']) && $d_o['wrapper_bg_image'])
        $css .= '#wrapper{background-color:' . $d_o['wrapper_bg'] . ';background-image: url("' . $d_o['wrapper_bg_image'] . '");background-repeat:' . $d_o['wrapper_bg_image_repeat'] . ';background-position:' . $d_o['wrapper_bg_image_p_l'] . ' ' . $d_o['wrapper_bg_image_p_t'] . ' ;}' . "\n";

    if (isset($d_o['main_bg_image']) && $d_o['main_bg_image'])
        $css .= '#main{background-color:' . $d_o['main_bg'] . ';background-image: url("' . $d_o['main_bg_image'] . '");background-repeat:' . $d_o['main_bg_image_repeat'] . ';background-position:' . $d_o['main_bg_image_p_l'] . ' ' . $d_o['main_bg_image_p_t'] . ' ;}' . "\n";

    if (isset($d_o['header_bg_image']) && $d_o['header_bg_image'])
        $css .= '#header-container{background-color:' . $d_o['header_bg'] . ';background-image: url("' . $d_o['header_bg_image'] . '");background-repeat:' . $d_o['header_bg_image_repeat'] . ';background-position:' . $d_o['header_bg_image_p_l'] . ' ' . $d_o['header_bg_image_p_t'] . ' ;}' . "\n";

    if (isset($d_o['sidebar_bg_image']) && $d_o['sidebar_bg_image'])
        $css .= '#sidebar-container{background-color:' . $d_o['sb_bg'] . ';background-image: url("' . $d_o['sidebar_bg_image'] . '");background-repeat:' . $d_o['sidebar_bg_image_repeat'] . ';background-position:' . $d_o['sidebar_bg_image_p_l'] . ' ' . $d_o['sidebar_bg_image_p_t'] . ' ;}' . "\n";

    if (isset($d_o['footer_bg_image']) && $d_o['footer_bg_image'])
        $css .= '#footer-container{background-color:' . $d_o['fo_bg'] . ';background-image: url("' . $d_o['footer_bg_image'] . '");background-repeat:' . $d_o['footer_bg_image_repeat'] . ';background-position:' . $d_o['footer_bg_image_p_l'] . ' ' . $d_o['footer_bg_image_p_t'] . ' ;}' . "\n";


    if ($d_o['bordered_nav_border_remove'])
        $css .= '#above-logo-container,#below-logo-container{border-width:0}';

    /* Rounded corners */
    if (isset($d_o['solid_nav_rounded']) && !$d_o['solid_nav_rounded'])
        $css .= '#above-logo-container,#below-logo-container{border-radius:0;-moz-border-radius: 0 ;-webkit-border-radius:0;}';

    if (isset($d_o['mag1_rounded']) && $d_o['mag1_rounded'])
        $css .= '.mag1{border-radius:5px;-moz-border-radius: 5px ;-webkit-border-radius: 5px;}';

    if (isset($d_o['sb_widget_rounded']) && $d_o['sb_widget_rounded'])
        $css .= '.widget{border-radius:5px;-moz-border-radius: 5px ;-webkit-border-radius: 5px;}';

    if (isset($d_o['footer_widget_rounded']) && $d_o['footer_widget_rounded'])
        $css .= '#footer .widget{border-radius:5px;-moz-border-radius: 5px ;-webkit-border-radius: 5px;}';


    if (isset($d_o['comment_rounded']) && $d_o['comment_rounded']) {
        $css .= 'li.comment,li.pingback,li.trackback,li.comment .avatar{border-radius:5px;-moz-border-radius: 5px ;-webkit-border-radius: 5px;}';
        $css .= 'li.comment li.comment{-moz-border-radius-topright:0;
				-webkit-border-top-right-radius:0;
				border-top-right-radius:0;
				-moz-border-radius-bottomright:0;
				-webkit-border-bottom-right-radius:0;
				border-bottom-right-radius:0;}';

    }

    if (isset($d_o['header-height']) && $d_o['header-height'] != 0) {
        $css .= "#branding{height:{$d_o['header-height']}px;}";
        $css .= "#social-media{line-height:{$d_o['header-height']}px}";
    }


    /* Mobile colors */
    if (isset($d_o['enable_custom_colors_mobile']) && $d_o['enable_custom_colors_mobile']):
        $css .= '@media screen and (max-width: 580px){ ';
        $css .= '#below-logo-container{background-color:' . swift_rgb2hex($d_o['mo_nav_bg']) . ';background-color:' . $d_o['mo_nav_bg'] . '!important}';
        $css .= '.pull.alignleft{background-color:' . swift_rgb2hex($d_o['mo_nav_icon_l_bg']) . ';background-color:' . $d_o['mo_nav_icon_l_bg'] . '!important;color:' . swift_rgb2hex($d_o['mo_nav_l_a']) . ';color:' . $d_o['mo_nav_l_a'] . '!important}';
     //   $css .= '.pull.alignleft a{color:' . swift_rgb2hex($d_o['mo_nav_l_a']) . ';color:' . $d_o['mo_nav_l_a'] . '!important}';

        $css .= '.pull.alignright{background-color:' . swift_rgb2hex($d_o['mo_nav_icon_r_bg']) . ';background-color:' . $d_o['mo_nav_icon_r_bg'] . '!important;color:' . swift_rgb2hex($d_o['mo_nav_r_a']) . ';color:' . $d_o['mo_nav_r_a'] . '!important}';
       // $css .= '.pull.alignright a{}';

        $css .= '}';
    endif;

    /* child theme overrides */
    if (file_exists(CHILD_THEME_DIR . '/css/custom-styles.css'))
        $css .= $wp_filesystem->get_contents(CHILD_THEME_DIR . '/css/custom-styles.css');

	if (isset($d_o['enable_responsive']) && $d_o['enable_responsive']){

		$css .= "@media screen and (max-width: {$wrapper}px) {";
		$css .=".footer-widgets{width:".(100/$d_o['footer_columns'])."%}";
		$css .= '}';

			//$css .= "@media screen and (max-width: {$wrapper}px) {";
		$temp = $wp_filesystem->get_contents(THEME_DIR . '/css/responsive.css');
		$css .= preg_replace('(__site_width__)', $wrapper.'px', $temp);
		//$css .= $wp_filesystem->get_contents(THEME_DIR . '/css/responsive.css');
		if (isset($swift_options['enable_np']) && $swift_options['enable_np'])
			$css .= $wp_filesystem->get_contents(THEME_DIR . '/css/np-responsive.css');

	}


	$css = apply_filters('swift_custom_css', $css);


    /* User CSS */
    if (isset($d_o['enable_user_css']) && $d_o['enable_user_css']) {
        $css .= $d_o['user_css'];
    }

	/* Desktop CSS */
	if (isset($d_o['enable_user_css_desktops']) && $d_o['enable_user_css_desktops'] && isset($d_o['user_css_desktops']) && $d_o['user_css_desktops']) {
		$css .= '@media screen and (min-width: 768px){';
		$css .= $d_o['user_css_desktops'].'}';
	}
	/* Tablet CSS */
	if (isset($d_o['enable_user_css_tablets']) && $d_o['enable_user_css_tablets'] && isset($d_o['user_css_tablets']) && $d_o['user_css_tablets']) {
		$css .= '@media screen and (min-width:580px) and (max-width: 768px) {';
		$css .= $d_o['user_css_tablets'].'}';
	}
	/* Mobile CSS */
	if (isset($d_o['enable_user_css_mobiles']) && $d_o['enable_user_css_mobiles'] && isset($d_o['user_css_mobiles']) && $d_o['user_css_mobiles']) {
		$css .= '@media screen and (max-width: 580px){';
		$css .= $d_o['user_css_mobiles'].'}';
	}

    $css .= $d_o['color_scheme_css'];

    apply_filters('swift_custom_css', $css);
    return swift_minify_css($css);

}

function swift_editor_stylesheet_generator()
{
    GLOBAL $swift_design_options;
    GLOBAL $swift_thumbnail_sizes;
    GLOBAL $swift_typography_stack;
    global $wp_filesystem;
    $d_o = $swift_design_options;
    $css = '';

    $filename = THEME_DIR . '/css/editor-styles.css';
    $css .= $wp_filesystem->get_contents($filename);
    if(isset($swift_thumbnail_sizes['content_width_slider'])){
        $css .= "body#tinymce.wp-editor {
        width: {$swift_thumbnail_sizes['content_width_slider'][0]}px;padding:0 10px;
        border-right:dashed 1px #CCC;";
    }

    if ($swift_design_options['body_font_enable']) {
        $css .= "font:{$d_o['body_font_style']} {$d_o['body_font_weight']} {$d_o['body_font_size']}{$d_o['body_font_size_unit']}/{$d_o['body_font_lh']}{$d_o['body_font_lh_unit']} {$d_o['body_font_family']};text-transform:{$d_o['body_font_transform']};";
    } elseif ($swift_design_options['swift_typography_enable']) {
        GLOBAL $swift_typography_preset;
        $font = $swift_typography_preset['body'];
        $css .= "font:{$font['style']} {$font['weight']} {$font['size']}/{$font['height']} {$font['family']}; text-transform:{$font['text-transform']} }";
    } else {
        $css .= "font:300 14px/1.625em 'Helvetica Neue', Helvetica, Arial, sans-serif;color:#575757;word-wrap:break-word;background:#FFF;
-webkit-font-smoothing: subpixel-antialiased;
-webkit-text-stroke: 0.15px";
    }
    $css .= "}";

    if (isset($d_o['enable_custom_colors']) && $d_o['enable_custom_colors']) {
        $css .= 'body#tinymce.wp-editor {';
        $css .= "color:{$d_o['body']};background:{$d_o['main_bg']};";
        $css .= "}";

        $css .= 'body#tinymce.wp-editor a{';
        $css .= "color:{$d_o['body_a']};";
        $css .= "}";


        $css .= 'body#tinymce.wp-editor blockquote{';
        $css .= "border-color:{$d_o['post_blockquote_border']};";
        $css .= "}";


        $css .= 'body#tinymce.wp-editor .wp-caption{';
        $css .= "border-color:{$d_o['img_caption_border']};background:{$d_o['img_caption_bg']};";
        $css .= "}";

    }


    return $css;

}



