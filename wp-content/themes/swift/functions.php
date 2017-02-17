<?php
/**
 * This file loads the required files and sets the global variables used in the theme.
 *
 * It's higly adviced not to edit this file or anyother file in the theme for that matter. Use child themes instead.
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package Swift
 * @subpackage Functions
 * @version 6.1.0
 * @author Satish Gandham <satish@swiftthemes.com>
 * @copyright Copyright (c) 2008 - 2012, Satish Gandham
 * @link http://swiftthemes.com/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

require_once get_template_directory() . '/lib/load-core.php';
require_once(get_template_directory() . '/lib/functions/Mobile_Detect.php');
$swift_is_mobile = new Mobile_Detect();

// Setting the global variables used in the theme
global $swift_options;
global $swift_design_options;
global $swift_thumbnail_sizes;
global $swift_is_mobile;
global $swift_post_meta;
add_theme_support('woocommerce');
$temp_options = get_option('SwiftOptions');
$swift_options = $temp_options['site_options'];
$swift_design_options = $temp_options['design_options'];
$swift_thumbnail_sizes = get_option('swift_dimensions');
$swift_thumbnail_sizes['np-tiles'] = array(300, 185);
if(isset($swift_thumbnail_sizes['mag1'])){
    add_image_size('mag1', $swift_thumbnail_sizes['mag1'][0], $swift_thumbnail_sizes['mag1'][1]);
    add_image_size('mag1_mobile', $swift_thumbnail_sizes['mag1_mobile'][0], $swift_thumbnail_sizes['mag1_mobile'][1]);
    add_image_size('content_width_slider', $swift_thumbnail_sizes['content_width_slider'][0], $swift_thumbnail_sizes['content_width_slider'][1]);
    add_image_size('full_width_slider', $swift_thumbnail_sizes['full_width_slider'][0], $swift_thumbnail_sizes['full_width_slider'][1]);



    if (isset($swift_thumbnail_sizes['full_width_slider'][0])) {
        add_image_size('full_width_tablet', 800, (int)(800 / $swift_thumbnail_sizes['full_width_slider'][0] * $swift_thumbnail_sizes['full_width_slider'][1]));
    }
	if (isset($swift_thumbnail_sizes['content_width_slider'][0])) {
		if($swift_thumbnail_sizes['full_width_slider'][0])
			add_image_size('full_width_mobile', 560, (int)(560 / $swift_thumbnail_sizes['full_width_slider'][0] * $swift_thumbnail_sizes['full_width_slider'][1]));
		if($swift_thumbnail_sizes['content_width_slider'][0])
			add_image_size('content_width_tablet', 560, (int)(560 / $swift_thumbnail_sizes['content_width_slider'][0] * $swift_thumbnail_sizes['content_width_slider'][1]));
		if($swift_thumbnail_sizes['content_width_slider'][0])
			add_image_size('content_width_mobile', 560, (int)(560 / $swift_thumbnail_sizes['content_width_slider'][0] * $swift_thumbnail_sizes['content_width_slider'][1]));
	}
    if (isset($swift_design_options['blog_thumb_width']) && $swift_design_options['blog_thumb_width'] != 0)
        add_image_size('blog_thumb', $swift_design_options['blog_thumb_width'], $swift_design_options['blog_thumb_height']);
    else
        add_image_size('blog_thumb', $swift_thumbnail_sizes['blog-thumb'][0], $swift_thumbnail_sizes['blog-thumb'][0], true);


    add_image_size('icon', 36, 36, true);
    add_image_size('large_icon', 48, 48, true);
    add_image_size('np_tabs_large', 620, 360, true);
    add_image_size('np_tabs_small', 120, 120, true);

    if ($swift_is_mobile->isTablet() && isset($swift_thumbnail_sizes)) {
        $swift_thumbnail_sizes['full_width_slider'] = array(800, (int)(800 / $swift_thumbnail_sizes['full_width_slider'][0] * $swift_thumbnail_sizes['full_width_slider'][1]));
        $swift_thumbnail_sizes['content_width_slider'] = array(560, (int)(560 / $swift_thumbnail_sizes['content_width_slider'][0] * $swift_thumbnail_sizes['content_width_slider'][1]));
        $swift_thumbnail_sizes['np-tiles'] = array(400, 200);
    }
    if ($swift_is_mobile->isMobile() && !$swift_is_mobile->isTablet() && isset($swift_thumbnail_sizes['content_width_slider'][0])) {
        $swift_thumbnail_sizes['full_width_slider'] = array(560, (int)(560 / $swift_thumbnail_sizes['full_width_slider'][0] * $swift_thumbnail_sizes['full_width_slider'][1]));
        $swift_thumbnail_sizes['content_width_slider'] = array(560, (int)(560 / $swift_thumbnail_sizes['content_width_slider'][0] * $swift_thumbnail_sizes['content_width_slider'][1]));
        $swift_thumbnail_sizes['mag1'] = $swift_thumbnail_sizes['mag1_mobile'];
        $swift_thumbnail_sizes['np-tiles'] = array(200, 200);
        $swift_thumbnail_sizes['blog-thumb'] = array(300, 120);
    }

    $content_width = $swift_thumbnail_sizes['content_width_slider'][0];

    /* New related posts thumb sizes */
    $width = $swift_thumbnail_sizes['content_width_slider'][0];
    $swift_thumbnail_sizes['rp_thumbs'] = array();
    $swift_thumbnail_sizes['rp_thumbs'][] = array($width, (int)($width / 2.5));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 2), (int)($width / 4));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 2), (int)($width / 4));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 2), (int)($width / 4));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 2), (int)($width / 4));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 4), (int)($width / 4));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 4), (int)($width / 4));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 4), (int)($width / 4));
    $swift_thumbnail_sizes['rp_thumbs'][] = array((int)($width / 4), (int)($width / 4));


}


add_action('wp_head', 'swift_cms_mode');
/**
 * Remove WordPress formatting and adding page specific CSS
 *
 * WordPress auto formatting makes it difficult to design static pages. This function
 * stops WP from adding <p> tags and removing line breaks.
 *
 * Second part of this function pulls the CSS added through the page through custom fields
 * and adds it to the head
 *
 * @since Swift 6.0
 */
function swift_cms_mode()
{

	if (!is_singular())
        return;

    global $wp_query, $swift_post_meta;

	$swift_post_meta = get_post_meta($wp_query->post->ID, '_swift_post_meta', true);
    // Removing wpautop
    if (isset($swift_post_meta['disable_oversmart_tinymce']) && (bool)$swift_post_meta['disable_oversmart_tinymce']) {
	    remove_filter('the_content', 'wpautop');
	    //remove_filter('widget_text', 'wpautop');
	    if ( function_exists( 'bstw' ) ) {
		    remove_filter( 'widget_text', array( bstw()->text_filters(), 'wpautop' ), 8 );
	    }

    }

	echo '<style>';
	if (isset($swift_post_meta['page_css']) && $swift_post_meta['page_css'] != '')
		echo $swift_post_meta['page_css'];

	if (isset($swift_post_meta['page_css_desktops']) && $swift_post_meta['page_css_desktops'] != '')
		echo '@media screen and (min-width: 768px){'.$swift_post_meta['page_css_desktops'].'}';

	if (isset($swift_post_meta['page_css_tablets']) && $swift_post_meta['page_css_tablets'] != '')
		echo '@media screen and (min-width:580px) and (max-width: 768px){'.$swift_post_meta['page_css_tablets'].'}';

	if (isset($swift_post_meta['page_css_mobiles']) && $swift_post_meta['page_css_mobiles'] != '')
		echo '@media screen and (max-width: 580px){'.$swift_post_meta['page_css_mobiles'].'}';

	echo '</style>';
}

/**
 * A small wrapper function for yoast_breadcrumb
 */
function swift_breadcrumb_output()
{
    if (function_exists('yoast_breadcrumb'))
        yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
    return;
}

/**
 * Add yoast breadcrumbs before the content div
 *
 * We don't want breadcrumbs on home page and front page of the blog. So the first if condition
 * takes care of it, but the is_home() and is_front_page() are not availble until the wp_head is
 * loaded. So we hook this fucntion to wp_head action hook.
 *
 */
add_action('swift_before_content_singular', 'swift_breadcrumb_output', 8, 1);
add_action('swift_before_content_archive', 'swift_breadcrumb_output', 8, 1);
add_action('swift_before_content_search', 'swift_breadcrumb_output', 8, 1);
/**
 * Adds CSS to WordPress admin to add icon to Swift theme widgets
 */
function swift_admin_custom_css()
{
    echo '<style type="text/css">
			div[id*="swift"] .widget-title{background:url("' . THEME_URI . '/lib/admin/images/icon.png") no-repeat 5px 50%;padding-left:50px}
					</style>';
}

add_action('admin_head', 'swift_admin_custom_css');
add_action('admin_init', 'download_css_js', 100);
/*add_action('wp_loaded','test',100);
 function test(){
GLOBAL $wp_filesystem;
var_dump($wp_filesystem);
}*/

/* Loading Google Fonts */
add_action('wp_footer', 'swift_load_gfonts', 1);
function swift_load_gfonts()
{
    global $swift_design_options;
    if (isset($swift_design_options['swift_gfonts']) && is_array($swift_design_options['swift_gfonts']) && $swift_design_options['swift_gfonts'] )
        $fonts = $swift_design_options['swift_gfonts'];
    else
        return;
    $list = '';
    foreach ($fonts as $font) {
        if ($font[1] && $font[2]) {
            echo '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' . urlencode($font[0]) . '&text=' . urlencode(get_bloginfo('name') . get_bloginfo('description')) . '">';
        } else {
            if ($font[1])
                echo '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' . urlencode($font[0]) . '&text=' . urlencode(get_bloginfo('name')) . '">';
            if ($font[2])
                echo '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' . urlencode($font[0]) . '&text=' . urlencode(get_bloginfo('description')) . '">';
        }
        if (!$font[1] && !$font[2]) {
            $list .= urlencode($font[0]) . '|';
        }
    }
    echo '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=' . $list . '">';
}

function swift_limit_posts_per_archive_page()
{
    global $swift_design_options;
    if (is_archive())
        set_query_var('posts_per_archive_page', $swift_design_options['archive_post_count']); // or use variable key: posts_per_page
}

if (isset($swift_design_options['archive_post_count_enable']) && $swift_design_options['archive_post_count_enable'] && isset($swift_design_options['archive_post_count']))
    add_filter('pre_get_posts', 'swift_limit_posts_per_archive_page');


add_action('template_redirect', 'swift_random_template');
function swift_random_template()
{
    if (isset($_GET['random']) && $_GET['random'] == 1) {

        $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
        foreach ($posts as $post) {
            $link = get_permalink($post);
        }
        wp_redirect($link, 307);
        exit;
    }
}


function swift_w3tc_mobile_groups($w3tc_groups)
{
    global $swift_design_options;
    if (!$swift_design_options['enable_responsive'])
        return $w3tc_groups;
    // any operations
    // clear all groups example
    $w3tc_groups = array();
    // delete all groups and add new example
    //$w3tc_groups = array(....);
    // merge groups example:
    $theme = wp_get_theme();
    $w3tc_groups = array_merge($w3tc_groups, array(
        'mobiles' => array(
            'theme' => 'swift/' . $theme->stylesheet,
            'enabled' => true,
            'redirect' => '',
            'agents' => array(
                '(iPhone.*Mobile|iPod|iTunes)',
                'BlackBerry|rim[0-9]+',
                'HTC|Desire',
                'Nexus\ One|Nexus\ S',
                'Dell\ Streak',
                '\bDroid\b.*Build|HRI39|MOT\-',
                'Samsung|GT\-P1000|SGH\-T959D|GT\-I9100|GT\-I9000',
                'E10i',
                'Asus.*Galaxy',
                'PalmSource|Palm',
                '(mmp|pocket|psp|symbian|Smartphone|smartfon|treo|up.browser|up.link|vodafone|wap|nokia|Series40|Series60|S60|SonyEricsson|N900|\bPPC\b|MAUI.*WAP.*Browser|LG\-P500)'
            )
        ),
        'tablets' => array(
            'theme' => 'swift/' . $theme->stylesheet,
            'enabled' => true,
            'redirect' => '',
            'agents' => array(
                'PlayBook|RIM\ Tablet',
                'iPad.*Mobile',
                'Kindle|Silk.*Accelerated',
                'SCH\-I800|GT\-P1000|Galaxy.*Tab',
                'xoom|sholest',
                'Transformer|TF101',
                'NookColor|nook\ browser|BNTV250A|LogicPD\ Zoom2',
                'Tablet|ViewPad7|LG\-V909|MID7015|BNTV250A|LogicPD\ Zoom2|\bA7EB\b|CatNova8|A1_07|CT704|CT1002|\bM721\b'
            )
        )
    ));
    return $w3tc_groups;
}

add_filter('w3tc_mobile_groups', 'swift_w3tc_mobile_groups');

function swift_rgb2hex($rgb, $hash = true)
{
    if ($rgb == NULL) {
        return '';
    }
    if ($rgb == 'rgba(0, 0, 0, 0)') {
        return 'transparent';
    }
    /* Our color picker doesnt allow inherit option.
       So, we are using #aabbcc as inherit. You can not use #aabbcc
       in your coloroptions
    */

    if ($hash)
        $hex = '#';

    if (strpos($rgb, 'rgb') === false) {
        return '#' . $rgb;
    }
    $temp = explode('(', $rgb);
    $rgb = $temp[1];
    $temp = explode(')', $rgb);
    $rgb = $temp[0];
    $rgb = explode(',', $rgb);

    $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
    return $hex;
}

function swift_social_media($before = "<ul>", $after = "</ul>", $order=False){
    global $swift_options;

    if(!$order)
        $order = $swift_options['sm_order'];
    echo $before;
    foreach ($order as $network) {

        switch ($network) {
            case "facebook":
                ?>
                <li class="facebook">
                    <div class="fb-like" data-href="<?php the_permalink() ?>" data-layout="button_count"
                         data-action="like"
                         data-width="300" data-share="true"></div>
                </li>

                <?php
                break;
            case "twitter":
                ?>
                <li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button"
                                       data-text="<?php the_title() ?>"
                                       data-url="<?php the_permalink() ?>"
                                       data-via="<?php $swift_options['sm_twitter'] ?>">Tweet</a></li>
                <?php
                break;

            case "linkedin":
                ?>
                <li class="linkedin">
                    <script type="IN/Share" data-counter="right" url="<?php the_permalink() ?>"></script>
                </li>


                <?php
                break;
            case "pinterest":
                ?>
                <li class="st-pinterest">
                    <?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail'); ?>
                    <a href="//www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()) ?>&media=<?php
                    echo urlencode($img[0])?> &description=<?php echo urlencode(get_the_title()) ?>"
                       data-pin-do="buttonPin"
                       data-pin-config="beside">
                        <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png"/></a></li>

                <?php
                break;
            case "google_plus":
                ?>
                <li class="google_plus">
                    <div class="g-plusone" data-size="medium" data-align="left"
                         data-href="<?php the_permalink() ?>"></div>

                </li>

                <?php
                break;

        }


    }

    echo $after;

}

add_action('wp_footer', 'swift_social_media_includes', 1);
function swift_social_media_includes()
{

    GLOBAL $swift_options,$swift_design_options;
    if (  ((is_single() || is_page())&& $swift_options['social_share']) ||
          (in_array($swift_design_options['blog_or_mag'],array('magazine-grid','magazine-grid-full')) && !is_single()  ) ||
          (in_array($swift_design_options['blog_or_mag_archives'],array('magazine-grid','magazine-grid-full')) && is_archive()  ) ||
          get_page_template_slug() == 'news-paper-template.php' ) {
        ?>

        <script type="text/javascript">
                function loadSocialProxy(){
                    loadSocial();
                }
        </script>
    <?php
    }
}

function swift_fb_og_image()
{
    if (!is_single())
        return;
    global $post;
    if (has_post_thumbnail($post->ID)):
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
        echo '<meta property="og:image" content="' . $image[0] . '"/>';
    endif;
}

add_action('wp_head', 'swift_fb_og_image');


add_filter('tiny_mce_before_init', 'swift_dont_strip_div');
function swift_dont_strip_div($a)
{
    if (isset($a["extended_valid_elements"]))
        $a["extended_valid_elements"] .= ",div[*],br";
    else
        $a["extended_valid_elements"] = "div[*],br";

    return $a;
}

function swift_add_editor_styles()
{
    $upload_dir = wp_upload_dir();
    add_editor_style($upload_dir['baseurl'] . '/swift-magic/editor-styles.css');
}

add_action('init', 'swift_add_editor_styles');

function swift_page_template_editor_styles()
{

    if (!isset($_GET['post']))
        return;
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
    // check for a template type

    if ($template_file == 'page.php')
        return;
    GLOBAL $swift_design_options;

    if (in_array($template_file, array('page-full-width-hybrid.php', 'page-feedback.php', 'page-full-width.php', 'page-feedback-mosaic.php', 'page-landing.php')))
        $width = $swift_design_options['wrapper_width'] - 2 * $swift_design_options['airy'];
    elseif (in_array($template_file, array('page-left-sidebar.php', 'page-right-sidebar.php')))
        $width = ($swift_design_options['wrapper_width'] - 2 * $swift_design_options['airy']) * .75;
    elseif (in_array($template_file, array('page-85-without-sb.pphp')))
        $width = ($swift_design_options['wrapper_width'] - 2 * $swift_design_options['airy']) * .85;


    $css = "<style type='text/css'>body#tinymce.wp-editor {width:{$width}px;}</style>";
    ?>
    <script>

        jQuery(window).load(function () {
            jQuery('iframe#content_ifr').contents().find("head")
                .append("<?php echo $css;?>");
        });

    </script>
    <?php
    // echo $css;

}

add_action('admin_footer', 'swift_page_template_editor_styles', 20);


function get_swift_random_gradient_class()
{
    $gradients = array(
        'virgin',
        'dance-to-forget',
        'cherryblossoms',
        'starfall',
        'orange',
        'softgreen'
    );
    return $gradients[rand(0, 5)];
}

function swift_random_gradient_class()
{
    echo get_swift_random_gradient_class();
}

add_action('wp_print_styles', 'swift_deregister_styles', 10);
add_action('get_footer','swift_deregister_styles');

function swift_deregister_styles()
{
	global $swift_design_options;
	$style_sheets = explode(",",$swift_design_options['stylesheets_to_un_queue']);
	foreach($style_sheets as $style_sheet):
		wp_deregister_style($style_sheet);
	endforeach;

}


add_action('wp_head','swift_hide_ads');
function swift_hide_ads(){
    GLOBAL $swift_hide_all_ads;
    if(is_single()){
        GLOBAL $post;
        $swift_hide_all_ads = get_post_meta($post->ID,'_swift_post_meta',true);
        if(isset($swift_hide_all_ads['disable_all_ads']))
            $swift_hide_all_ads = $swift_hide_all_ads['disable_all_ads'];
        else
            $swift_hide_all_ads = false;
    }else{
        $swift_hide_all_ads = false;
    }

}

function swift_media_img_link_to( $form_fields, $post ){

	$form_fields['swift-media-img-link-to'] = array(
		'label' => __('Link to (for slider)', 'swift'),
		'input' => 'text',
		'value' => get_post_meta($post->ID, 'swift_media_img_link_to',true),
		'helps' => __('When using shortcode slider, this will be used as target link for the slide.','swift')
	);

	$form_fields['swift-media-slide-caption-class'] = array(
		'label' => __('Slide caption class (for slider)','swift'),
		'input' => 'text',
		'value' => get_post_meta($post->ID, 'swift_media_slide_caption_class',true),
		'helps' => __('When using shortcode slider, you can set the caption for slider here.','swift')
	);

	return $form_fields;
}
add_filter("attachment_fields_to_edit", "swift_media_img_link_to", null, 2);

function swift_save_media_img_link( $post, $attachment ){

	if( isset($attachment['swift-media-img-link-to']) ){
		update_post_meta($post['ID'], 'swift_media_img_link_to', $attachment['swift-media-img-link-to']);
	}
	if( isset($attachment['swift-media-slide-caption-class']) ){
		update_post_meta($post['ID'], 'swift_media_slide_caption_class', $attachment['swift-media-slide-caption-class']);
	}
	return $post;
}
add_filter("attachment_fields_to_save","swift_save_media_img_link",null,2);



?>