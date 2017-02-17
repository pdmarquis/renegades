<?php 
/**
 * zenzero functions and dynamic template
 *
 * @package zenzero
 */

/**
 * Replace more Excerpt
 */
function zenzero_new_excerpt_more($more) {
       global $post;
	return '&hellip;';
}
add_filter('excerpt_more', 'zenzero_new_excerpt_more');

/**
 * Delete font size style from tag cloud widget
 */
function zenzero_fix_tag_cloud($tag_string){
   return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'zenzero_fix_tag_cloud',10,3);

 /**
 * Register All Colors and Section
 */
function zenzero_color_primary_register( $wp_customize ) {
	$colors = array();
	
	$colors[] = array(
	'slug'=>'text_color_first', 
	'default' => '#919191',
	'label' => __('Box Text Color', 'zenzero')
	);
	
	$colors[] = array(
	'slug'=>'box_color_second', 
	'default' => '#ffffff',
	'label' => __('Box Background Color', 'zenzero')
	);
	
	$colors[] = array(
	'slug'=>'special_color_third', 
	'default' => '#292929',
	'label' => __('Header / Footer / Sidebar Background Color', 'zenzero')
	);
	
	$colors[] = array(
	'slug'=>'special_color_fourth', 
	'default' => '#727272',
	'label' => __('Header / Footer / Sidebar Text Color', 'zenzero')
	);
	
	foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option', 
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'], 
			array('label' => $color['label'], 
			'section' => 'colors',
			'settings' => $color['slug'])
		)
	);
	}
	
	/*
	Start Zenzero Options
	=====================================================
	*/
	$wp_customize->add_section( 'cresta_zenzero_options', array(
	     'title'    => esc_html__( 'Zenzero Theme Options', 'zenzero' ),
	     'priority' => 50,
	) );
	
	/*
	Social Icons
	=====================================================
	*/
	$socialmedia = array();
	
	$socialmedia[] = array(
	'slug'=>'facebookurl', 
	'default' => '#',
	'label' => __('Facebook URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'twitterurl', 
	'default' => '#',
	'label' => __('Twitter URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'googleplusurl', 
	'default' => '#',
	'label' => __('Google Plus URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'linkedinurl', 
	'default' => '#',
	'label' => __('Linkedin URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'instagramurl', 
	'default' => '#',
	'label' => __('Instagram URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'youtubeurl', 
	'default' => '#',
	'label' => __('YouTube URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'pinteresturl', 
	'default' => '#',
	'label' => __('Pinterest URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'tumblrurl', 
	'default' => '#',
	'label' => __('Tumblr URL', 'zenzero')
	);
	$socialmedia[] = array(
	'slug'=>'vkurl', 
	'default' => '#',
	'label' => __('VK URL', 'zenzero')
	);
	
	foreach( $socialmedia as $zenzero_theme_options ) {
		// SETTINGS
		$wp_customize->add_setting(
			'zenzero_theme_options_' . $zenzero_theme_options['slug'], array(
				'default' => $zenzero_theme_options['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
				'type'     => 'theme_mod',
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			$zenzero_theme_options['slug'], 
			array('label' => $zenzero_theme_options['label'], 
			'section'    => 'cresta_zenzero_options',
			'settings' =>'zenzero_theme_options_' . $zenzero_theme_options['slug'],
			)
		);
	}
	
	/*
	RSS Button
	=====================================================
	*/
	$wp_customize->add_setting('zenzero_theme_options_rss', array(
        'default'    => '1',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'zenzero_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('zenzero_theme_options_rss', array(
        'label'      => __( 'Show RSS Button', 'zenzero' ),
        'section'    => 'cresta_zenzero_options',
        'settings'   => 'zenzero_theme_options_rss',
        'type'       => 'checkbox',
    ) );
	
	/*
	Search Button
	=====================================================
	*/
	$wp_customize->add_setting('zenzero_theme_options_hidesearch', array(
        'default'    => '1',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'zenzero_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('zenzero_theme_options_hidesearch', array(
        'label'      => __( 'Show Search Button', 'zenzero' ),
        'section'    => 'cresta_zenzero_options',
        'settings'   => 'zenzero_theme_options_hidesearch',
        'type'       => 'checkbox',
    ) );
	
	/*
	Search Button
	=====================================================
	*/
	$wp_customize->add_setting('zenzero_theme_options_socialheader', array(
        'default'    => '',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'zenzero_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('zenzero_theme_options_socialheader', array(
        'label'      => __( 'Show Social Button in the header', 'zenzero' ),
        'section'    => 'cresta_zenzero_options',
        'settings'   => 'zenzero_theme_options_socialheader',
        'type'       => 'checkbox',
    ) );
	
	/*
	Upgrade to PRO
	=====================================================
	*/
    class Zenzero_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="zenzero-upgrade-title">
        		<span class="customize-control-title">
					<h3 style="text-align:center;"><div class="dashicons dashicons-megaphone"></div> <?php esc_html_e('Get Zenzero PRO WP Theme for only', 'zenzero'); ?> 19,90&euro;</h3>
        		</span>
        	</p>
			<p style="text-align:center;" class="zenzero-upgrade-button">
				<a style="margin: 10px;" target="_blank" href="http://crestaproject.com/demo/zenzero-pro/" class="button button-secondary">
					<?php esc_html_e('Watch the demo', 'zenzero'); ?>
				</a>
				<a style="margin: 10px;" target="_blank" href="https://crestaproject.com/downloads/zenzero/" class="button button-secondary">
					<?php esc_html_e('Get Zenzero PRO Theme', 'zenzero'); ?>
				</a>
			</p>
			<ul>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Advanced Theme Options', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Logo Upload', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Loading Page', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Font Switcher', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Unlimited Colors and Skin', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Post views counter', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Breadcrumb', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Post format', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( '7 Shortcodes', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( '5 Exclusive Widgets', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Related Posts Box', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'Information About Author Box', 'zenzero' ); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e( 'And much more...', 'zenzero' ); ?></b></li>
			<ul><?php
        }
    }
	
	$wp_customize->add_section( 'cresta_upgrade_pro', array(
	     'title'    => esc_html__( 'More features? Upgrade to PRO', 'zenzero' ),
	     'priority' => 999,
	));
	
	$wp_customize->add_setting('zenzero_section_upgrade_pro', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	
	$wp_customize->add_control(new Zenzero_Customize_Upgrade_Control($wp_customize, 'zenzero_section_upgrade_pro', array(
		'section' => 'cresta_upgrade_pro',
		'settings' => 'zenzero_section_upgrade_pro',
	)));
}
add_action( 'customize_register', 'zenzero_color_primary_register' );

function zenzero_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Add Custom CSS to Header 
 */
function zenzero_custom_css_styles() { 
	$text_color_first = get_option('text_color_first');
	$box_color_second = get_option('box_color_second');
	$special_color_third = get_option('special_color_third');
	$special_box_color_fourth = get_option('special_color_fourth');
?>

<style type="text/css">
	<?php if (!empty($text_color_first) && $text_color_first != '#919191' ) : ?>
	body,
	button,
	input,
	select,
	textarea {
		color: <?php echo esc_html($text_color_first); ?>;
	}
	<?php endif; ?>
	
	<?php if (!empty($box_color_second) && $box_color_second != '#ffffff' ) : ?>
	<?php list($r, $g, $b) = sscanf($box_color_second, '#%02x%02x%02x'); ?>
	#search-full {
		background: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>, 0.9);
	}
	
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.main-navigation ul:not(.sub-menu) > li > a:hover::before,
	.main-navigation ul:not(.sub-menu) > li > a:focus::before,
	.main-navigation ul li:hover > a, 
	.main-navigation li.current-menu-item > a, 
	.main-navigation li.current-menu-parent > a, 
	.main-navigation li.current-page-ancestor > a, 
	.main-navigation .current_page_item > a, 
	.main-navigation ul > li:hover .indicator,
	.main-navigation li.current-menu-parent .indicator, 
	.main-navigation li.current-menu-item .indicator,
	.paging-navigation .nav-links a, 
	.comment-navigation a,
	#toTop:hover, 
	.showSide:hover, 
	.showSearch:hover,
	.site-social i.fa-rss:hover,
	.page-links span a,
	.entry-footer a,
	.widget-title	{
		color: <?php echo esc_html($box_color_second); ?>;
	}
	.site-branding a, 
	.site-branding a:hover,
	.menu-toggle, 
	.menu-toggle:hover {
		color: <?php echo esc_html($box_color_second); ?> !important;
	}
	.paging-navigation .nav-links a:hover,
	.comment-navigation a:hover,
	#page	{
		background: <?php echo esc_html($box_color_second); ?>;
	}
	.main-navigation ul:not(.sub-menu) > li > a:hover::before,
	.main-navigation ul:not(.sub-menu) > li > a:focus::before {
		text-shadow: 8px 0 <?php echo esc_html($box_color_second); ?>, -8px 0px <?php echo esc_html($box_color_second); ?>;
	}
	<?php endif; ?>
	
	<?php if (!empty($special_color_third) && $special_color_third != '#292929' ) : ?>
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.main-navigation ul ul,
	.paging-navigation .nav-links a,
	.comment-navigation a,
	.site-header,
	.site-footer,
	#secondary,
	.showSide, 
	.showSearch,
	#toTop,
	.page-links span a,
	.entry-footer a	{
		background: <?php echo esc_html($special_color_third); ?>;
	}
	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	button:focus,
	input[type="button"]:focus,
	input[type="reset"]:focus,
	input[type="submit"]:focus,
	button:active,
	input[type="button"]:active,
	input[type="reset"]:active,
	input[type="submit"]:active,
	a,
	a:hover,
	a:focus,
	a:active,
	.paging-navigation .nav-links a:hover, 
	.comment-navigation a:hover,
	.entry-meta,
	.entry-footer a:hover,
	.sticky .entry-header:before {
		color: <?php echo esc_html($special_color_third); ?>;
	}
	.tagcloud a {	
		color: <?php echo esc_html($special_color_third); ?> !important;
	}
	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	.paging-navigation .nav-links a:hover, 
	.comment-navigation a:hover,
	.entry-footer a:hover {
		border: 1px solid <?php echo esc_html($special_color_third); ?>;
	}
	<?php endif; ?>
	
	<?php if (!empty($special_box_color_fourth) && $special_box_color_fourth != '#727272' ) : ?>
	.site-header a, 
	.site-footer a, 
	#secondary a, 
	.site-footer a:hover,
	.main-navigation ul li .indicator,
	.site-header, .site-footer,
	#secondary,
	.showSide, 
	.showSearch,
	#toTop {
		color: <?php echo esc_html($special_box_color_fourth); ?>;
	}
	.tagcloud a:hover {
		color: <?php echo esc_html($special_box_color_fourth); ?> !important;
	}
	.tagcloud a {
		background: <?php echo esc_html($special_box_color_fourth); ?>;
	}
	#wp-calendar tbody td#today,
	.tagcloud a:hover {
		border: 1px solid <?php echo esc_html($special_box_color_fourth); ?>;
	}
	@media screen and (max-width: 1024px) {
		.main-navigation ul li .indicator {
			color: <?php echo esc_html($special_box_color_fourth); ?>;
		}
	}
	<?php endif; ?>
	
</style>
    <?php
}
add_action('wp_head', 'zenzero_custom_css_styles');
