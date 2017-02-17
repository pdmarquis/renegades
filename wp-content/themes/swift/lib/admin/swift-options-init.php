<?php
/**
 * Swift Options Initialization
 *
 * We define our theme options array here.
 */
$cats = get_categories();
$cat_names = $cat_ids = array();
$cat_names[0] = __('Show recent posts', 'swift');
foreach ($cats as $cat) {
    $cat_names[$cat->cat_ID] = $cat->name;
}
GLOBAL $swift_options_init;
$swift_options_init[] = array('name' => __('tag', 'swift'),
    'id' => 'which',
    'value' => 'options',
    'type' => 'hidden',
    'datatype' => 'none');

$swift_options_init[] = array('name' => __('General settings', 'swift'),
    'id' => 'general-settings',
    'type' => 'heading',
    'datatype' => 'none');

/*
$swift_options_init[] = array('name' => __('Header scripts', 'swift'),
    'desc' => __('If you need to add scripts to your header (like Mint tracking code or BSA script ), you should enter them here. They will be added before the &lt;/head&gt; tag.', 'swift') . '<br /><br />' .
        sprintf(__('%sNote%s: You can add multiple scripts and meta tags too.', 'swift'), '<strong>', '</strong>'),
    'id' => 'header_scripts',
    'default' => '',
    'type' => 'textarea',
    'datatype' => 'js');

$swift_options_init[] = array('name' => __('Footer scripts', 'swift'),
    'desc' => __('Paste your Google Analytics (and/or any other) tracking code here. These scripts will be added in the footer section before the &lt;/body&gt; tag.', 'swift') . '<br /><br />' .
        sprintf(__('%sNote%s: You can add multiple scripts.', 'swift'), '<strong>', '</strong>'),
    'id' => 'footer_scripts',
    'default' => '',
    'type' => 'textarea',
    'datatype' => 'js');
*/
$swift_options_init[] = array('name' => __('About us', 'swift'),
    'desc' => __('If you are using the content width slider in combination with the full width magazine layout, information or AD added here will be shown adjacent to the slider.', 'swift'),
    'id' => 'about_us',
    'default' => '',
    'type' => 'textarea',
    'datatype' => 'js');

$swift_options_init[] = array('name' => __('Default thumbnail image', 'swift'),
    'desc' => __('Upload an image to be used as thumbnail when the post doesn\'t have one. If you are using the full width slider, the image should be at least 940px wide.', 'swift'),
    'id' => 'default_thumb',
    'default' => get_template_directory_uri() . '/images/default.png',
    'type' => 'upload',
    'datatype' => 'uri');

$swift_options_init[] = array('name' => __('SwiftThemes.Com affiliate ID', 'swift'),
    'desc' => __('Enter your affiliate ID to include your affiliate link in footer. (The string after /go/ in your affiliate link is the affiliate ID.)', 'swift'),
    'id' => 'affiliate_id',
    'default' => '2078',
    'type' => 'text',
    'datatype' => 'text');
/*
$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Closing general-settings


/* Header Options *

$swift_options_init[] = array('name' => __('Header Options', 'swift'),
    'id' => 'header-options',
    'type' => 'heading',
    'datatype' => 'none');
*/

$swift_options_init[] = array('name' => __('Custom favicon', 'swift'),
    'desc' => sprintf(__('Upload or specify the URL of your favicon which is visible in browser favorites and tabs %s( Must be a .png or .ico file - 16px by 16px ).%s', 'swift'), '<strong>', '</strong>'),
    'id' => 'favicon',
    'default' => '',
    'type' => 'upload',
    'datatype' => 'uri');


$swift_options_init[] = array('name' => __('Custom retina favicon', 'swift'),
    'desc' => sprintf(__('Upload favicon with twice the dimensions and with filename suffix of  %s @2x.%s, example favicon@2x.ico', 'swift'), '<strong>', '</strong>'),
    'id' => 'favicon_retina',
    'default' => '',
    'type' => 'upload',
    'datatype' => 'uri');

$swift_options_init[] = array('name' => __('Upload Logo', 'swift'),
    'desc' => __('Upload a logo for your site, or specify an image URL directly.', 'swift'),
    'id' => 'logo',
    'default' => NULL,
    'type' => 'upload',
    'datatype' => 'uri');

$swift_options_init[] = array('name' => __('Upload Retina Logo', 'swift'),
    'desc' => __('Upload copy of the above logo with 2x dimensisons and with suffix @2x, example: logo@2x.png.<br>Please make sure the above two urls match except for @2x suffix. This only works when you enable retina support.', 'swift'),
    'id' => 'retina_logo',
    'default' => NULL,
    'type' => 'upload',
    'datatype' => 'uri');


$swift_options_init[] = array('name' => __('Upload Logo for mobiles', 'swift'),
                              'desc' => __('Sometimes desktop logos may not suit well for mobiles, if your logo has this problem you can upload a smaller version for mobiles here.', 'swift'),
                              'id' => 'mobile_logo',
                              'default' => NULL,
                              'type' => 'upload',
                              'datatype' => 'uri');

$swift_options_init[] = array('name' => __('Logo position', 'swift'),
    'desc' => '',
    'id' => 'logo_position',
    'default' => 'left',
    'type' => 'radio',
    'options' => array('left' => 'left', 'center' => 'center', 'right' => 'right'),
    'datatype' => 'predefined');
/*
$swift_options_init[] = array('name' => __('If you are using centered logo, anything you add here will go on the left of the logo<br><br><br>', 'swift'),
    'desc' => __('Ideally a small banner ad or twitter follow button.', 'swift'),
    'id' => 'header_left',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');
*/
$swift_options_init[] = array('name' => __('Show fb,twitter, and g+ icons next to header', 'swift'),
    'desc' => __('Check this box to show social media icons in header. Note: You have to fill your scoial media urls/handles in social media section.', 'swift'),
    'id' => 'social_links_in_header',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

/*
$swift_options_init[] = array('name' => __('Enter your custom search code', 'swift'),
    'desc' => sprintf(__('If you have a custom search code, such as %sAdsense for Search%s, add it here. This will be used for the search box in navigation instead of the default wp search.', 'swift'), '<strong>', '</strong>'),
    'id' => 'search_code',
    'type' => 'textarea',
    'default' => '',
    'datatype' => 'javascript');
*/
$swift_options_init[] = array('name' => __('Show search form in navigation', 'swift'),
    'desc' => __('Check this box to show search form in navigation below logo', 'swift'),
    'id' => 'nav_search_enable',
    'type' => 'checkbox',
    'default' => true,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Show RSS links in navigation', 'swift'),
    'desc' => __('Check this box to show RSS links in navigation above logo', 'swift'),
    'id' => 'rss_links_enable',
    'type' => 'checkbox',
    'default' => true,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Toggle RSS and search positions', 'swift'),
    'desc' => __('Check this box to move RSS from top nav to bottom nav and search to top nav. Comes in handy when you are using only one navigation menu.', 'swift'),
    'id' => 'rss_search_toggle_positions',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');


$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Closing header-options

/*
$swift_options_init[] = array('name' => __('Custom slider', 'swift'),
    'id' => 'slider-options',
    'type' => 'heading',
    'datatype' => 'none');

$swift_options_init[] = array('name' => __('Number of slides', 'swift'),
    'desc' => __('Select the number of slides you want in the slider. If you select a number less than the slides you have now, some slides will be lost', 'swift'),
    'id' => 'number_of_slides',
    'default' => 4,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20),
    'datatype' => 'predefined');


$swift_options_init[] = array('name' => __('Add slides', 'swift'),
    'desc' => '',
    'id' => 'swift_custom_slider',
    'type' => 'function',
    'datatype' => 'custom_slider');

$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Closing slider-options

*/
$swift_options_init[] = array('name' => __('Homepage Options', 'swift'),
    'id' => 'homepage-options',
    'type' => 'heading',
    'datatype' => 'none');

$swift_options_init[] = array('name' => __('Enable featured post slider', 'swift'),
    'desc' => __('Check this box to enable featured post slider on home page.', 'swift'),
    'id' => 'slider_enable',
    'type' => 'checkbox',
    'default' => true,
    'datatype' => 'bool');

/*
$swift_options_init[] = array('name' => __('Replace featured post slider with custom slider', 'swift'),
    'desc' => __('Check this box to disable regular post slider and replace it with custome slider you created in previous tab.', 'swift'),
    'id' => 'custom_slider_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');
*/
$swift_options_init[] = array('name' => __('Hide slider on mobiles', 'swift'),
    'desc' => __('Check this box to hide slider when the site is viewed on mobiles.', 'swift'),
    'id' => 'hide_slider_on_mobiles',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');



$swift_options_init[] = array('name' => __('Hide slider on tablets', 'swift'),
    'desc' => __('Check this box to hide slider when the site is viewed on tablets.', 'swift'),
    'id' => 'hide_slider_on_tablets',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Featured post slider style', 'swift'),
    'desc' => __('Choose between the two sliders in SWIFT', 'swift'),
    'id' => 'slider_style',
    'default' => 'content-width',
    'type' => 'radio',
    'options' => array('content-width' => 'content-width', 'full-width' => 'full-width'),
    'datatype' => 'predefined');

$swift_options_init[] = array('name' => __('Featured slider category', 'swift'),
    'desc' => __('Select the featured post slider category', 'swift'),
    'id' => 'featured_cat_home',
    'default' => '',
    'type' => 'select',
    'options' => $cat_names,
    'datatype' => 'predefined');

$swift_options_init[] = array('name' => __('Number of featured posts', 'swift'),
    'desc' => __('Select the number of featured posts to be displayed in the slider.', 'swift'),
    'id' => 'featured_posts_number_home',
    'default' => 3,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20),
    'datatype' => 'predefined');

$swift_options_init[] = array('name' => __('Slider speed', 'swift'),
    'desc' => __('Set the slider speed in milli seconds, ie., 1000 for one second.', 'swift'),
    'id' => 'slider_speed',
    'default' => '5000',
    'type' => 'text',
    'datatype' => 'int');
/*
$swift_options_init[] = array( 'name' => __( 'Slider transition style', 'swift' ),
		'desc' => sprintf( __( 'Available styles: %s. The default is %s.', 'swift' ), 'fold, fade, sliceDown, random', 'random'),
		'id' => 'slider_transition',
		'default' => 'random',
		'type' => 'text',
		'datatype' => 'text' );
*/
$swift_options_init[] = array('name' => __('Disable auto sliding in slider', 'swift'),
    'desc' => __('Check this box to disable auto sliding in slider.', 'swift'),
    'id' => 'disable_sliding',
    'type' => 'checkbox',
    'default' => FALSE,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Skip posts shown in slider from WP loop', 'swift'),
    'desc' => __('Check this box to avoid duplicate content on homepage ( Useful when using full width slider ).', 'swift'),
    'id' => 'skip_posts',
    'type' => 'checkbox',
    'default' => FALSE,
    'datatype' => 'bool');


$swift_options_init[] = array('name' => __('Enable excerpts on home page', 'swift'),
    'desc' => __('Check this box to enable excerpts on homepage.', 'swift'),
    'id' => 'excerpts_enable',
    'type' => 'checkbox',
    'default' => true,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Number of full length posts', 'swift'),
    'desc' => 'If you enabled excerpts, select the number of full length posts you would like to show before excerpts',
    'id' => 'full_length_posts',
    'default' => 1,
    'type' => 'select',
    'options' => array(0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20),
    'datatype' => 'predefined');


$swift_options_init[] = array('name' => __('Change "Continue reading" button text here', 'swift'),
    'desc' => '',
    'id' => 'continue_reading_button_text',
    'type' => 'text',
    'default' => __('Continue reading &rarr;', 'swift'),
    'datatype' => 'text');

$swift_options_init[] = array('name' => __('Display thumbnails', 'swift'),
    'desc' => __('Check this box to display thumbnails when excerpts are enabled. (Applicable only to blog layout)', 'swift'),
    'id' => 'excerpts_thumbs_enable',
    'type' => 'checkbox',
    'default' => true,
    'datatype' => 'bool');


$swift_options_init[] = array('name' => __('Home page, after post content', 'swift'),
    'desc' => __('Set the meta line to be displayed above title', 'swift'),
    'id' => 'home_blog_meta',
    'default' => array('text', __('Posted on', 'swift') . ' ', 'date', 'text', ' ' . __('by', 'swift') . ' ', 'author'),
    'type' => 'sortable',
    'options' => array('text', 'author','author_avatar','tags', 'categories', 'date', 'updated_on'),
    'datatype' => 'sortable');



$swift_options_init[] = array('name' => __('Post meta for grid layout', 'swift'),
    'desc' => __('Set the meta line to be displayed above title', 'swift'),
    'id' => 'home_grid_meta',
    'default' => array('text', __('Posted on', 'swift') . ' ', 'date', 'text', ' ' . __('by', 'swift') . ' ', 'author'),
    'type' => 'sortable',
    'options' => array('text', 'author','author_avatar','tags', 'categories', 'date', 'updated_on'),
    'datatype' => 'sortable');

$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Closing homepage-options


$swift_options_init[] = array('name' => __('Post meta', 'swift'),
    'id' => 'post-meta',
    'type' => 'heading',
    'datatype' => 'none');


$swift_options_init[] = array('name' => __('Related posts title', 'swift'),
    'desc' => __('If you are using YARPP with custom template included in swift, set the related posts title here.', 'swift'),
    'id' => 'yarpp_title',
    'default' => __('Related posts', 'swift'),
    'type' => 'text',
    'datatype' => 'text');
/*
$swift_options_init[] = array('name' => __('Show social share icons on single post pages', 'swift'),
    'desc' => 'We recommned you use these built in social share buttons as they are loaded in a non blocking way after the entire page is loaded.',
    'id' => 'social_share',
    'default' => false,
    'type' => 'select',
    'options' => array(false => "Don't show", "above_only" => "Below post title", "below_only" => "At the end of post", "both" => "Both"),
    'datatype' => 'predefined');



$swift_options_init[] = array('name' => __('Order your social media icons', 'swift'),
    'desc' => __('Drag and drop to arrange your social media icons', 'swift'),
    'id' => 'sm_order',
    'default' => array('facebook','twitter','google_plus'),
    'type' => 'sortable',
    'options' => array('facebook', 'google_plus', 'linkedin', 'pinterest', 'twitter'),
    'datatype' => 'sortable');

*/

$swift_options_init[] = array('name' => __('Show author BIO', 'swift'),
    'desc' => __('Check this box to display author bio at the end of posts on single post pages.', 'swift'),
    'id' => 'show_author_bio',
    'type' => 'checkbox',
    'default' => true,
    'datatype' => 'bool');


$swift_options_init[] = array('name' => __('Post meta', 'swift'),
    'id' => 'post-meta-explanation',
    'type' => 'explain',
    'desc' => sprintf(__('Post meta is the administrative information provided along with the post, this includes %sauthor of the post, published date, how the post is categorized etc.%s This is usually displayed around the post title or at the end of the post.', 'swift'), '<strong>', '</strong>') . '<br /><br />' .
        sprintf(__('Here you can configure the post meta info displayed in single post page. Simply %sDrag and Drop%s the tags you want to add to your Post. The Blank Box could be used to enter filler text like Written by: \'Author tag\' or Filed under: \'Categories\' etc. These tags can be placed both above and below the post title. Drag and Drop them to adjust them.', 'swift'), '<strong>', '</strong>'),
    'datatype' => 'none');


$swift_options_init[] = array('name' => __('Single page, above title', 'swift'),
    'desc' => __('Set the meta line to be displayed above title', 'swift'),
    'id' => 'single_above_title',
    'default' => array('text', __('Posted on&nbsp;', 'swift') . ' ', 'date', 'text', ' ' . __('by&nbsp;', 'swift'), 'author'),
    'type' => 'sortable',
    'options' => array('text', 'author','author_avatar','tags', 'categories', 'date', 'updated_on'),
    'datatype' => 'sortable');

$swift_options_init[] = array('name' => __('Single page, below title', 'swift'),
    'desc' => __('Set the meta line to be displayed below title', 'swift'),
    'id' => 'single_below_title',
    'default' => array('text', __('Filed under&nbsp;', 'swift') . ' ', 'categories'),
    'type' => 'sortable',
    'options' => array('text', 'author','author_avatar','tags', 'categories', 'date', 'updated_on'),
    'datatype' => 'sortable');

$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Closing post-meta

/*
$swift_options_init[] = array('name' => __('Ad management', 'swift'),
    'id' => 'ad-management',
    'type' => 'heading',
    'datatype' => 'none');

//http://swiftthemes.com/swiftlers-area/aff/go/nijanthan
$swift_options_init[] = array('name' => __('SwiftThemes.Com affiliate ID', 'swift'),
    'desc' => __('Enter your affiliate ID to include your affiliate link in footer. (The string after /go/ in your affiliate link is the affiliate ID.)', 'swift'),
    'id' => 'affiliate_id',
    'default' => '2078',
    'type' => 'text',
    'datatype' => 'text');
/*
$swift_options_init[] = array('name' => __('Ad management explanation', 'swift'),
    'id' => 'ad-management-explanation',
    'type' => 'explain',
    'desc' => __('Use the options below to display ads in different locations on your site. You can add ads from any ad network, and any number of ads in a given location.', 'swift') . '<br />' .
        sprintf(__('You can even add multiple ads in a given location by wrapping them in %s[ads][/ads]%s short code and seperate individual ads by %s&lt;!-- next_ad --&gt;%s', 'swift'), '<strong>', '</strong>', '<strong>', '</strong>') . "<br />Example:" . '<br />' . '
		<code>[ads]<br />
		      First ad &lt;!-- next_ad --&gt;<br />
		      Second ad &lt;!-- next_ad --&gt;<br />
		      third ad &lt;!-- next_ad --&gt;<br />
		      fourth ad<br />
        [/ads]<br /></code>' .
        'You can float the ads either to left or right by wrapping them in a div like this' .
        '<code>' .
        '&lt;div class="alignleft"&gt;AD CODE HERE(flaoted to left)&lt;/div&gt;<br>' .
        '&lt;div class="alignright"&gt;AD CODE HERE(floated to right)&lt;/div&gt;<br>' .
        '&lt;div class="aligncenter" style="width:ad_width"&gt;AD CODE HERE( Centered )&lt;/div&gt;' .
        '</code><br>' .
        sprintf(__('To add ads to the sidebar and footer, use %sone of the several text widgets provided with Swift%s.', 'swift'), '<strong>', '</strong>'),
*

$swift_options_init[] = array('name' => __('Enable the ad area above the header', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement above the top navigation', 'swift'),
    'id' => 'above_header_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably 728*90 ad, or wider ad or two 468*60 ads floated next to each other', 'swift'),
    'id' => 'above_header_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

$swift_options_init[] = array('name' => __('Enable the header ad area', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement next to the blog name/logo.', 'swift'),
    'id' => 'header_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably 468*60 ad', 'swift'),
    'id' => 'header_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');


$swift_options_init[] = array('name' => __('Enable the ad area below the bottom navigation', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement below the bottom navigation.', 'swift'),
    'id' => 'nav_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 728*15 link list unit, or a 728*90 lead-board ad.', 'swift'),
    'id' => 'nav_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');


$swift_options_init[] = array('name' => __('Enable the ad area below the slider', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement below the slider on home page.', 'swift'),
    'id' => 'below_slider_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, try to center it.', 'swift'),
    'id' => 'below_slider_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');


$swift_options_init[] = array('name' => __('Enable the ads between posts on home page and archives', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement between posts on home page and archives when using blog layout.', 'swift'),
    'id' => 'home_archives_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here', 'swift'),
    'id' => 'home_archives_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');


$swift_options_init[] = array('name' => __('Start the ad after first __ posts', 'swift'),
    'desc' => __('Select the number of featured posts to be displayed in the slider.', 'swift'),
    'id' => 'home_archives_start_after',
    'default' => 3,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12),
    'datatype' => 'int');

$swift_options_init[] = array('name' => __('Repeat every __ posts', 'swift'),
    'desc' => __('Select after how many posts should the ad be repeated.', 'swift'),
    'id' => 'home_archives_repeat_every',
    'default' => 2,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5),
    'datatype' => 'int');


$swift_options_init[] = array('name' => __('Repeat for', 'swift'),
    'desc' => __('How many times do you want the ad to be repeated.(For example, you can only have 3 AdSense ad units on a page)', 'swift'),
    'id' => 'home_archives_repeat_for',
    'default' => 2,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5),
    'datatype' => 'int');

//Below title
$swift_options_init[] = array('name' => __('Enable the ad area below title on single post page', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement below the post title on single post pages.', 'swift'),
    'id' => 'before_content_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here. Preferably a 468*60, 300*250, 336*280, or a 120*600 skyscraper ad floated to the left or the right of the post content. To float a skyscraper ad surround the ad code like this:<br><code> &lt;div style=\'float: left; clear: left; margin: 0px 10px 10px 0px;\'&gt;AD CODE HERE&lt;/div&gt; or &lt;div style=\'float: right; clear: right; margin: 0px 0px 10px 10px;\'&gt;AD CODE HERE&lt;/div&gt;</code>', 'swift'),
    'id' => 'before_content_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

// After first paragraph
$swift_options_init[] = array('name' => __('Enable the ad area after first paragraph', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement after the first paragraph single post pages.', 'swift'),
    'id' => 'after_first_p_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here preferably a 468*60, 300*250, 336*280, ad to be displayed between the post\'s title and content.<br>We recommend using this over the below post title and above header ads as the double standard hyporcitic Google frowns upon above the fold ads while their search results page is filled half way with ads.', 'swift'),
    'id' => 'after_first_p_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

//After first image

$swift_options_init[] = array('name' => __('Enable the ad area after the first image', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement between the post content on single post pages.', 'swift'),
    'id' => 'after_first_img_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 468*60, 300*250, 336*280, ad to be displayed after the first image. Due to technical reasons, this works with images wrapped in &lt;a&gt; &lt;/a&gt; tag', 'swift'),
    'id' => 'after_first_img_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

$swift_options_init[] = array('name' => __('Enable the ad area between post content', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement after the first paragraph single post pages.', 'swift'),
    'id' => 'between_content_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 468*60, 300*250, 336*280, ad to be displayed between the post\'s title and content.', 'swift'),
    'id' => 'between_content_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');


$swift_options_init[] = array('name' => __('Enable the ad area below the post text', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement after the post content on single post pages.', 'swift'),
    'id' => 'after_content_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 468*60, 300*250, 336*280 ad to be displayed after the post\'s content. For best results clear and center it surrounding the ad code like this:<br> <code>&lt;div style=\'clear: both; width=ad_width_in_px margin: auto\'&gt;AD CODE HERE&lt;/div&gt;</code>', 'swift'),
    'id' => 'after_content_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

$swift_options_init[] = array('name' => __('Enable the ad area above the footer widgets', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement above the footer widgets.', 'swift'),
    'id' => 'footer_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 768*90 ad to be displayed above the footer widgets.', 'swift'),
    'id' => 'footer_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

$swift_options_init[] = array('name' => __('Enable the ad area above the images in gallery', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement above the image in image.php template', 'swift'),
    'id' => 'image_above_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 768*90 ad to be displayed above the image in image.php template.', 'swift'),
    'id' => 'image_above_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

$swift_options_init[] = array('name' => __('Enable the ad area below the images in gallery', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement below the image in image.php template', 'swift'),
    'id' => 'image_below_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 768*90 ad to be displayed below the image in image.php template.', 'swift'),
    'id' => 'image_below_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'ads');

$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Closing ad-management
*/
/*
$swift_options_init[] = array('name' => __('NEWS paper layout', 'swift'),
    'id' => 'np-layout',
    'type' => 'heading',
    'datatype' => 'none');

$swift_options_init[] = array('name' => __('NEWS paper setup', 'swift'),
    'id' => 'np-setup-explanation',
    'type' => 'explain',
    'desc' => __('Setting up the NEWS paper layout', 'swift') . '<br><ol>' .
        '<li>' . sprintf(__('First set your site width to %s1160px%s', 'swift'), '<strong>', '</strong>') . '</li>
		<li>' . sprintf(__('Create a new blank page, and select the template as "%sNEWS paper layout%s". Publish it.', 'swift'), '<strong>', '</strong>') . '</li>
		<li>' . __('Create another blank page, say "blog" and publish it.', 'swift') . '</li>
		<li>' . __('Now set each section of the options page up by filling the options below.', 'swift') . '</li>
		<li>' . sprintf(__('You can go to the page created in step 1 and see if everything is coming correctly, %sadjust the number of posts in each section so that there are no uneven gaps%s.', 'swift'), '<strong>', '</strong>') . '</li>
		<li>' . sprintf(__('Once you are satisfied with the look, go to %1$s, set %2$s to %3$sstatic page%4$s, then select the page you created in step 1 as the new "Front page" and the page you created in step 2 as the new "Posts page".', 'swift'), '<em><a href="options-reading.php">' . __('Settings', 'default') . ' &rarr; ' . __('Reading', 'default') . '</a></em>', '<strong>' . __('Front page displays', 'default') . '</strong>', '<strong>', '</strong>') . '</li>
		</ol>',
    'datatype' => 'none');

$swift_options_init[] = array('name' => __('Enable newspaper layout', 'swift'),
    'desc' => __('News paper layout styles will be loaded only when this box is checked.', 'swift'),
    'id' => 'enable_np',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');


$swift_options_init[] = array('name' => __('Number of posts in slider', 'swift'),
    'desc' => __('Select the number of featured posts to be displayed in the slider.', 'swift'),
    'id' => 'np_slider_posts_number',
    'default' => 3,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20),
    'datatype' => 'int');

$swift_options_init[] = array('name' => __('Number of posts in tiles', 'swift'),
    'desc' => __('Select the number of tiles to be displayed adjacent to slider.', 'swift'),
    'id' => 'np_tiles_count',
    'default' => 3,
    'type' => 'select',
    'options' => array(2 => 2, 4 => 4, 6 => 6, 8 => 8, 10 => 10),
    'datatype' => 'int');


$swift_options_init[] = array('name' => __('Number of posts in column adjacent to tabs', 'swift'),
    'desc' => __('Select the number of posts to be displayed adjacent to the tabs.', 'swift'),
    'id' => 'np_small_col_posts_number',
    'default' => 5,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20),
    'datatype' => 'int');

$swift_options_init[] = array('name' => __('Number of posts tabs', 'swift'),
    'desc' => __('Select the number of posts to be displayed in tabs', 'swift'),
    'id' => 'np_tabs_posts_number',
    'default' => 5,
    'type' => 'select',
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20),
    'datatype' => 'int');

$swift_options_init[] = array('name' => __('Title for column adjacent to tabs', 'swift'),
    'desc' => __('Enter a title for the posts displayed adjacent to the tabs', 'swift'),
    'id' => 'np_tabs_adjacent_title',
    'default' => __('Trending', 'swift'),
    'type' => 'text',
    'datatype' => 'text');

$swift_options_init[] = array('name' => __('Enable the ad area below tiles', 'swift'),
    'desc' => __('Check this box and enter the ad code below to display an advertisement below the tiles.', 'swift'),
    'id' => 'np_below_tiles_ad_enable',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');

$swift_options_init[] = array('name' => __('Ad Code', 'swift'),
    'desc' => __('Enter your ad code here, preferably a 468*60 ad to be displayed above the tabbed posts.', 'swift'),
    'id' => 'np_below_tiles_ad',
    'type' => 'ads',
    'default' => '',
    'datatype' => 'javascript');


$swift_options_init[] = array('name' => __('Hide all dates in news paper layout', 'swift'),
    'desc' => __('Check this box if you want to hide dates in news paper layout', 'swift'),
    'id' => 'np_hide_date',
    'type' => 'checkbox',
    'default' => false,
    'datatype' => 'bool');


$swift_options_init[] = array('name' => __('Height of magazine columns', 'swift'),
    'desc' => __('Empty space between magazine rows or your posts getting clipped? You can adjut the height here. ', 'swift'),
    'id' => 'np_mag_col_height',
    'default' => 680,
    'type' => 'text',
    'datatype' => 'int');

$swift_options_init[] = array('type' => 'clear',
    'datatype' => 'none');


$swift_options_init[] = array('name' => __('NEWS paper setup', 'swift'),
    'id' => 'np-setup-explanation',
    'type' => 'explain',
    'desc' => sprintf(__('Here you can configure which posts are displayed in the NEWS paper layout. Simply %sDrag and Drop%s the category you want in the specified location. %sRandom posts%s and %sRecent posts%s should not be combined with any other categories. They can only be used in the area under and to the right of the slider.', 'swift'), '<strong>', '</strong>', '<strong>', '</strong>', '<strong>', '</strong>') . '<br /><br />' .
        sprintf(__('%sNote%s: Number of posts in each category or shown along with the name for your reference.', 'swift'), '<strong>', '</strong>'),
    'datatype' => 'none');

$swift_options_init[] = array('name' => __('Slider posts categories', 'swift'),
    'id' => 'np_slider_cats',
    'type' => 'np-setup',
    'default' => '',
    'datatype' => 'sortable_array');


$swift_options_init[] = array('name' => __('Post tiles adjacent to slider', 'swift'),
    'id' => 'np_tiles_cats',
    'type' => 'np-setup',
    'default' => '',
    'datatype' => 'sortable_array');

$swift_options_init[] = array('name' => __('Posts in vertical column adjacent to tabs', 'swift'),
    'id' => 'np_vertical_cats',
    'type' => 'np-setup',
    'default' => '',
    'datatype' => 'sortable_array');

$swift_options_init[] = array('name' => __('Posts in tabbed format', 'swift'),
    'id' => 'np_tabbed_cats',
    'type' => 'np-setup',
    'default' => '',
    'datatype' => 'sortable_array');

$swift_options_init[] = array('name' => __('Posts in mag format', 'swift'),
    'id' => 'np_mag_cats',
    'type' => 'np-setup',
    'default' => '',
    'datatype' => 'sortable_array');

$swift_options_init[] = array('name' => __('NEWS paper layout', 'swift'),
    'id' => 'cat-base',
    'type' => 'cat_base',
    'default' => '',
    'datatype' => 'none');

$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Closing News paper layout

/*
$swift_options_init[] = array( 'name' => __( 'NEWS paper layout 2', 'swift' ),
		'id' => 'np2-layout',
		'type' => 'heading',
		'datatype' => 'none' );
$swift_options_init[] = array( 'name' => __( 'NEWS paper setup', 'swift' ),
		'id' => 'np2-setup-explanation',
		'type' => 'explain',
		'desc' => '<h3>'.__( 'Setting up the NEWS paper layout', 'swift' ).'</h3>
		<ol>'.
		'<li>'.__('This news paper layout is designed for site width 1102px, setting site width to anyting other than this is not advisable','swift').
		'<li>'.sprintf( __( 'Create a new blank page, and select the template as "%sNEWS paper layout 2%s". Publish it.', 'swift' ), '<strong>', '</strong>' ).'</li>
		<li>'.__( 'Create another blank page, say "blog" and publish it.', 'swift' ).'</li>
		<li>'.__( 'Now set each section of the options page up by filling the options below.', 'swift' ).'</li>
		<li>'.sprintf( __( 'You can go to the page created in step 1 and see if everything is coming correctly, %sadjust the number of posts in each section so that there are no uneven gaps%s.', 'swift' ), '<strong>', '</strong>' ).'</li>
		<li>'.sprintf( __( 'Once you are satisfied with the look, go to %1$s, set %2$s to %3$sstatic page%4$s, then select the page you created in step 1 as the new "Front page" and the page you created in step 2 as the new "Posts page".', 'swift'), '<em><a href="options-reading.php">'.__( 'Settings', 'default' ).' &rarr; '.__( 'Reading', 'default' ).'</a></em>', '<strong>'.__( 'Front page displays', 'default' ).'</strong>', '<strong>', '</strong>' ).'</li>
		</ol>',
		'datatype' => 'none' );

$swift_options_init[] = array(  'name' => __('Enable the ad area below the slider', 'swift' ),
		'desc' => __('Check this box and enter the ad code below to display an advertisement below the sldier', 'swift' ),
		'id' => 'np2_below_slider_ad_enable',
		'type' => 'checkbox',
		'default' => false,
		'datatype' => 'bool');

$swift_options_init[] = array(    'name' => __('Ad Code', 'swift' ),
		'desc' => __('Enter your ad code here, preferably 760*90px ad', 'swift' ),
		'id' => 'np2_below_slider_ad',
		'type' => 'textarea',
		'default' => '',
		'datatype' => 'javascript');

$swift_options_init[] = array(  'name' => __('Enable the ad area above the filmstrip', 'swift' ),
		'desc' => __('Check this box and enter the ad code below to display an advertisement above the film strip', 'swift' ),
		'id' => 'np2_above_fs2_ad_enable',
		'type' => 'checkbox',
		'default' => false,
		'datatype' => 'bool');

$swift_options_init[] = array(    'name' => __('Ad Code', 'swift' ),
		'desc' => __('Enter your ad code here, preferably 760*90px ad', 'swift' ),
		'id' => 'np2_above_fs2_ad',
		'type' => 'textarea',
		'default' => '',
		'datatype' => 'javascript');

$swift_options_init[] = array( 'name' => __( 'For slider', 'swift' ),
		'id' => 'np2_slider_cats',
		'type' => 'np-setup',
		'default' => '',
		'datatype' => 'sortable_array' );

$swift_options_init[] = array( 'name' => __( 'For mosaic adjacent to slider', 'swift' ),
		'id' => 'np2_mosaic_slider_adjacent',
		'type' => 'np-setup',
		'default' => '',
		'datatype' => 'sortable_array' );

$swift_options_init[] = array( 'name' => __( 'For film strip', 'swift' ),
		'id' => 'np2_fs_1',
		'type' => 'np-setup',
		'default' => '',
		'datatype' => 'sortable_array' );


$swift_options_init[] = array( 'name' => __( 'For mag columns', 'swift' ),
		'id' => 'np2_mag_cats',
		'type' => 'np-setup',
		'default' => '',
		'datatype' => 'sortable_array' );

$swift_options_init[] = array( 'name' => __( 'NEWS paper layout', 'swift' ),
		'id' => 'cat-base',
		'type' => 'cat_base',
		'default' => '',
		'datatype' => 'none' );

$swift_options_init[] = array( 'type' => 'close',
		'datatype' => 'none' ); // Closing ad-management
*/

$swift_options_init[] = array('name' => __('Social media', 'swift'),
    'id' => 'social-media',
    'type' => 'heading',
    'datatype' => 'none');


$swift_options_init[] = array('name' => __('Feedburner ID', 'swift'),
    'desc' => sprintf(__('Enter your Feedburner ID. If your Feedburner URL is http://feeds.feedburner.com/SwiftThemes, then your feed ID is %sSwiftThemes%s.', 'swift'), '<strong>', '</strong>'),
    'id' => 'feedburnerid',
    'default' => '',
    'type' => 'text',
    'datatype' => 'text');

$swift_options_init[] = array('name' => __('Twitter', 'swift'),
    'desc' => sprintf(__('Enter your Twitter user name (without the \'@\'). Example: %sswiftthemes%s.', 'swift'), '<strong>', '</strong>'),
    'id' => 'sm_twitter',
    'default' => '',
    'type' => 'text',
    'datatype' => 'text');

$swift_options_init[] = array('name' => __('Facebook Page ID', 'swift'),
    'desc' => sprintf(__('Enter your Facebook Page ID. If your Facebook Page is https://www.facebook.com/SwiftThemes, then your Page ID is %sSwiftThemes%s.', 'swift'), '<strong>', '</strong>'),
    'id' => 'sm_fb_page_id',
    'default' => '',
    'type' => 'text',
    'datatype' => 'text');


$swift_options_init[] = array('name' => __('Facebook APP ID', 'swift'),
    'desc' => sprintf(__('If you are using the social sharing options built into the theme, then its adviced you <a href="https://developers.facebook.com/apps/">%screate an app%s</a> and enter it\'s id here.
		Example %s122170911171321%s', 'swift'), '<strong>', '</strong>', '<strong>', '</strong>'),
    'id' => 'sm_fb_app_id',
    'default' => '',
    'type' => 'text',
    'datatype' => 'text');


$swift_options_init[] = array('name' => __('Google plus ID', 'swift'),
    'desc' => sprintf(__('Enter your google plus id, if you got custom url include the + sign. Example: %s112287461115173713985%s.', 'swift'), '<strong>', '</strong>'),
    'id' => 'sm_gplus_page_id',
    'default' => '',
    'type' => 'text',
    'datatype' => 'text');

$swift_options_init[] = array('name' => __('Pinterest ID', 'swift'),
    'desc' => __('Enter your Pinterest id', 'swift'),
    'id' => 'sm_pinterest_page_id',
    'default' => '',
    'type' => 'text',
    'datatype' => 'text');


$swift_options_init[] = array('name' => __('Linkedin URL', 'swift'),
    'desc' => __('Enter your linkedin profile url', 'swift'),
    'id' => 'sm_linkedin_page_url',
    'default' => '',
    'type' => 'text',
    'datatype' => 'text');

$swift_options_init[] = array('name' => __('Google +1', 'swift'),
    'desc' => sprintf(__('URL of the page that will receive +1 clicks. This is usually your home page. Example: %shttp://swiftthemes.com%s.', 'swift'), '<strong>', '</strong>'),
    'id' => 'sm_gplus',
    'default' => '',
    'type' => 'text',
    'datatype' => 'url');

$swift_options_init[] = array('name' => __('Instagram Profile Id', 'swift'),
    'desc' => sprintf(__('Enter your Instagram profile ID. If your Instagram profile is at https://www.instagram.com/SwiftThemes, then your Page ID is %sSwiftThemes%s.', 'swift'), '<strong>', '</strong>'),
    'id' => 'sm_instagram_id',
    'default' => '',
    'type' => 'text',
    'datatype' => 'url');

$swift_options_init[] = array('name' => __('Youtube Channel Id', 'swift'),
    'desc' => sprintf(__('Enter your Channel ID. If your youtube channel is at https://www.Youtube.com/user/SwiftThemes, then your channel ID is %sSwiftThemes%s.', 'swift'), '<strong>', '</strong>'),
    'id' => 'sm_youtube_channel_id',
    'default' => '',
    'type' => 'text',
    'datatype' => 'url');
$swift_options_init[] = array('type' => 'close',
    'datatype' => 'none'); // Social media