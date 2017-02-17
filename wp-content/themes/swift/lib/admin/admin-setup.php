<?php

/**
 *
 * Adds the stylesheet for Swift admin pages
 */
function swift_admin_stylesheet()
{
	wp_enqueue_style('swift-zebra-tooltip', get_template_directory_uri() . '/css/power-tip.css');

	wp_enqueue_style('swift-admin-stylesheet', get_template_directory_uri() . '/lib/admin/css/style.css');
    if (is_rtl())
        wp_enqueue_style('swift-admin-rtl-stylesheet', get_template_directory_uri() . '/lib/admin/css/rtl.css');
	wp_enqueue_style('swift-font-awesome-common', get_template_directory_uri() . '/css/fa-common.css');
	wp_enqueue_style('swift-font-awesome', get_template_directory_uri() . '/css/fontawesome-large/font-awesome.min.css');
    wp_enqueue_style('spectrum', get_template_directory_uri() . '/lib/admin/css/spectrum.css');
	wp_enqueue_style('swift-admin-bootstrap', get_template_directory_uri() . '/css/bootstrap-flat-buttons.css');

}

/**
 * Add JS scripts to Swift admin pages
 */
function swift_admin_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('jquery-ui-draggable');
    wp_enqueue_script('jquery-ui-droppable');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-accordion');
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('jquery-masonry');
	wp_enqueue_script( 'jquery-form' );

	wp_enqueue_script('cookie', get_template_directory_uri() . '/lib/admin/js/jquery.cookie.js', array(
        'jquery',
        'jquery-ui-core',
        'jquery-ui-tabs',
        //'jsColor'
    ));
    wp_enqueue_script('admin-scripts', get_template_directory_uri() . '/lib/admin/js/scripts.js', array(
        'jquery',
        'cookie',
        'jquery-ui-core',
        'jquery-ui-tabs',
        'masonry'
        //'jsColor'
    ));

    wp_enqueue_script('scroll', get_template_directory_uri() . '/lib/admin/js/scroll.jquery.js', array(
        'jquery'
    ));
    wp_enqueue_script('spectrum', get_template_directory_uri() . '/lib/admin/js/spectrum.js', array(
        'jquery'
    ));

    wp_enqueue_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(
        'jquery'
    ));
	wp_enqueue_script('zebra-tooltip', get_template_directory_uri() . '/js/jquery.powertip.min.js', array(
		'jquery'
	));

	wp_enqueue_media();
}

/**
 * Gravatar JS
 */
function swift_gravatar_loading()
{
    wp_enqueue_script('gravatarLoading', get_template_directory_uri() . '/lib/admin/js/gravatar-delayed-loading.js');
}

// Add the options pages
add_action('admin_menu', 'swift_add_admin_pages');

function swift_add_admin_pages()
{
    $icon_url = get_template_directory_uri() . '/lib/admin/images/favicon.ico';
    $swift_options_page = add_theme_page(__('Swift Options', 'swift'), __('Swift Options', 'swift'), 'edit_theme_options', 'swift-options', 'swift_options_page', $icon_url, 62);
    $swift_design_options_page = add_theme_page( __('Swift Design Options', 'swift'), __('Swift Design Options', 'swift'), 'edit_theme_options', 'swift-design-options', 'swift_design_options_page');
    $swift_color_schemes_page = add_theme_page( __('Swift Color Schemes', 'swift'), __('Swift Color Schemes', 'swift'), 'edit_theme_options', 'swift-color-schemes', 'swift_color_schemes_page');
    //$swift_import_export = add_theme_page( __('Import / Export', 'swift'), __('Import / Export', 'swift'), 'edit_theme_options', 'swift-import-export', 'swift_import_export_page');
    $swift_useful_info = add_theme_page( __('Swift Useful info', 'swift'), __('Swift Useful info', 'swift'), 'edit_theme_options', 'swift-useful-info', 'swift_useful_info');
    $swift_help = add_theme_page( __('Swift Quick Help', 'swift'), __('Swift Quick Help', 'swift'), 'edit_theme_options', 'swift-help', 'swift_help');

    add_action("admin_print_styles-$swift_options_page", 'swift_admin_stylesheet');
    add_action("admin_print_scripts-$swift_options_page", 'swift_admin_scripts');

    add_action("admin_print_styles-$swift_design_options_page", 'swift_admin_stylesheet', 1);
    add_action("admin_print_scripts-$swift_design_options_page", 'swift_admin_scripts', 2);
    add_action("admin_print_scripts-$swift_color_schemes_page", 'swift_admin_scripts', 2);

    //add_action("admin_print_styles-$swift_import_export", 'swift_admin_stylesheet');
    add_action("admin_print_styles-$swift_help", 'swift_admin_stylesheet');
    add_action("admin_print_styles-$swift_color_schemes_page", 'swift_admin_stylesheet');

    add_action("admin_print_styles-$swift_useful_info", 'swift_admin_stylesheet');
    add_action("admin_print_scripts-$swift_useful_info", 'swift_admin_scripts', 2);


}

add_action('admin_init', 'swift_options_init');

function swift_options_init()
{
    register_setting('swift_options', 'swift_options', 'swift_validate_options');
    register_setting('swift_design_options', 'swift_design_options', 'swift_validate_options');

    add_settings_section('swift-options', NULL, 'swift_admin_header', 'swift-options');
    add_settings_section('swift-design-options', NULL, 'swift_admin_header', 'swift-design-options');

    add_settings_field('', '', 'swift_options_input', 'swift-options', 'swift-options');
    add_settings_field('', '', 'swift_design_options_input', 'swift-design-options', 'swift-design-options');
}

add_action('admin_notices','swift_errors',20);
function swift_errors(){
	$errors = get_option( 'swift_error' );
	if($errors){
		$upload_dir = wp_upload_dir();

		$buttons = 'Please download the files and upload them to <br /><br /><code>' . trailingslashit($upload_dir['basedir']) . 'swift-magic</code>';
		$buttons .= '<form action="" method="post" class="alignleft">
				<input type="submit" class="button" value="' . __('Download custom-styles.css', 'swift') . '" name="download_css">
						</form>';
		$buttons .= '<form action="" method="post" class="alignleft">&nbsp;&nbsp;&nbsp;
				<input type="submit" class="button" value="' . __('Download swift-js.js', 'swift') . '" name="download_js">
						</form>';
		$buttons .= '<div class="clear"></div>';
?>

<div class="error">
        <p class="clearfix">We were unable to save the following files automatically.<?php echo $buttons?></p>
</div>
<?php
	}
}

add_action('update_option_SwiftOptions','swift_write_file',20);
function swift_options_page()
{
	if(isset($_GET['settings-updated']) && $_GET['settings-updated']=='true') {
		swift_write_file();
	}

	$SwiftOptions = get_option('SwiftOptions');
	if(isset($_GET['settings-updated']) && $_GET['settings-updated']=='true' && !$SwiftOptions['reset']){
		return;
	}
   ?>
    <div class="swift-wrap clearfix">
        <?php include(SWIFT_ADMIN . '/admin-sidebar.php') ?>
        <form action="options.php" method="post" id="swift-form">
            <?php settings_fields('swift_options') ?>
            <?php do_settings_sections('swift-options') ?>


	        <div id="saveResult"><div id='saveMessage' class='clearfix'></div></div>
	        <script type="text/javascript">
		        jQuery(document).ready(function() {
			        jQuery('#swift-options-buttons').show()

			        jQuery('#save').click(function() {
				        jQuery('#saveMessage').html("<p class='successModal'><i class='fa-2x fa-spinner fa-spin'></i> Saving&hellip;</p>").show();
				        jQuery('#swift-form').ajaxSubmit({
					        success: function(){
						        jQuery('#saveMessage').html("<p class='successModal'><i class='fa-2x fa-check-circle'></i><?php echo htmlentities(__('Settings Saved','wp'),ENT_QUOTES); ?></p>").show();
					        },
					        timeout: 1000
				        });
				        setTimeout("jQuery('#saveMessage').hide('slow');", 5000);
				        return false;
			        });
		        });
	        </script>
        </form>
    </div>
<?php
	$SwiftOptions['reset']=false;
	update_option('SwiftOptions',$SwiftOptions);
}

function swift_design_options_page()
{
	if(isset($_GET['settings-updated']) && $_GET['settings-updated']=='true') {
		swift_write_file();
	}

	$SwiftOptions = get_option('SwiftOptions');
	if(isset($_GET['settings-updated']) && $_GET['settings-updated']=='true' && !$SwiftOptions['reset']){
		return;
	}
    ?>
    <div class="swift-wrap clearfix">
        <?php include(SWIFT_ADMIN . '/admin-sidebar.php') ?>
        <form action="options.php" method="post" id="swift-form">
            <?php settings_fields('swift_design_options') ?>
            <?php do_settings_sections('swift-design-options') ?>
	        <div id="saveResult"><div id='saveMessage' class='clearfix'></div></div>
	        <script type="text/javascript">
		        jQuery(document).ready(function() {
			        jQuery('#swift-options-buttons').show()
			        jQuery('#save').click(function() {
				        jQuery('#saveMessage').html("<p class='successModal'><i class='fa-2x fa-spinner fa-spin'></i> Saving&hellip;</p>").show();
				        jQuery('#swift-form').ajaxSubmit({
					        success: function(){
						        jQuery('#saveMessage').html("<p class='successModal'><i class='fa-2x fa-check-circle'></i><?php echo htmlentities(__('Settings Saved','wp'),ENT_QUOTES); ?></p>").show();
					        },
					        timeout: 5000
				        });
				        setTimeout("jQuery('#saveMessage').hide('slow');", 5000);
				        return false;
			        });
		        });
	        </script>
        </form>
    </div>
<?php

}

function swift_import_export_page()
{
    if (isset ($_POST))
        swift_import_options($_POST);

    //if ( swift_write_file(TRUE) ) return;
    $msg = swift_write_file(TRUE);
    if ($msg && $msg === TRUE)
        return;
    ?>
    <div class="swift-wrap clearfix">
        <form action="" method="post" id="import_export">
            <?php swift_import_export_form() ?>
            <div id="swift-options-buttons" class="clearfix">
                <input name="swift_import_export" type="submit"
                       value="<?php _e('Save changes', 'swift'); ?>"
                       class="button-primary alignright"/>
            </div>

        </form>
    </div>
<?php

}

function swift_help()
{
    include(SWIFT_ADMIN . '/swift-help.php');
}

function swift_useful_info()
{
    include(SWIFT_ADMIN . '/useful-info.php');

}

function swift_admin_header()
{
    return '';
    ?>


    <div id="header" class="clearfix">
        <div id="theme-logo" class="alignleft">
            <a href="http://SwiftThemes.Com"><img
                    src="<?php echo get_template_directory_uri() ?>/lib/admin/images/SwiftThemesLogo.png"
                    alt="SwiftThemes" width="149"> </a>
        </div>
        <div id="theme-info" class="clearfix alignright">
            <?php

            if (function_exists('wp_get_theme')):
                $ct = wp_get_theme();
                if (is_child_theme()) {
                    $pt = $ct->parent();
                    $theme_name = $pt->get('Name');
                    $theme_version = $pt->get('Version');
                    $child_theme_name = $ct->get('Name');
                    $child_theme_version = $ct->get('Version');
                } else {
                    $theme_name = $ct->get('Name');
                    $theme_version = $ct->get('Version');
                }
                ?>
                <h3>
                    <?php echo $theme_name . ' <strong>v' . $theme_version . '</strong>'; ?>
                </h3>
                <span><?php echo __('Location:', 'swift') . str_replace(WP_CONTENT_DIR, '', get_template_directory()); ?>
		</span>
                <?php if (get_template_directory() != get_stylesheet_directory()) { ?>
                <h4>
                    <?php echo $child_theme_name . ' <strong>v' . $child_theme_version . '</strong>'; ?>
                </h4>
                <span><?php echo __('Location:', 'swift') . str_replace(WP_CONTENT_DIR, '', get_stylesheet_directory()); ?>
		</span>
            <?php } ?>
            <?php
            endif;?>
        </div>

    </div>
    <!--
<ul id="swift-nav" class="clearfix">
	<li id="hire" class="alignleft"><a
		href="http://swiftthemes.com/hire-me/"
		title="<?php printf(__('Hire %s for a custom theme modification', 'swift'), 'Satish Gandham'); ?>"><?php _e('Request a custom theme modification', 'swift'); ?>
	</a></li>
	<li id="manual"><a
		href="http://swiftthemes.com/wordpress-themes/swift/swift-user-guide/"
		title="<?php _e('A complete guide to installing and customizing SWIFT', 'swift'); ?>"><?php _e('User Guide', 'swift'); ?>
	</a></li>
	<li id="support"><a href="http://swiftthemes.com/forums"
		title="<?php _e('Need more help? Check out support forum.', 'swift'); ?>"><?php _e('Support forum', 'swift'); ?>
	</a></li>
	<li id="testimonial"><a href="http://swiftthemes.com/testimonials/"
		title="<?php _e('Write a testimonial for SWIFT', 'swift'); ?>"><?php _e('Write a Testimonial', 'swift'); ?>
	</a></li>
</ul>
-->
<?php

}

function swift_validate_options($input)
{
    GLOBAL $swift_image_repeat, $swift_font_stack, $swift_font_unit, $swift_font_style, $swift_font_weight, $swift_typography_stack;
    GLOBAL $swift_text_transform, $swift_design_options_init, $swift_options_init, $swift_font_defaults, $swift_design_options;


    if (isset ($swift_design_opt['fontstack1']) || isset ($swift_design_opt['fontstack2']))
        array_unshift($swift_font_stack, array(
            $swift_design_opt['fontstack1'],
            ''
        ), array(
            $swift_design_opt['fontstack2'],
            ''
        ));

    if ($input['which'] == 'design_options') {
        $options = apply_filters('swift_design_options_init', $swift_design_options_init);
    } elseif ($input['which'] == 'options') {
        $options = apply_filters('swift_options_init', $swift_options_init);
    } else {
        return $input;
    }
    $sanitized_options = array();

    if (isset ($input['reset'])) {
        foreach ($options as $option) {
            if (isset($option['datatype']) && $option['datatype'] != 'none' && $option['datatype'] != 'font') {
                if (isset($option['default']))
                    $sanitized_options[$option['id']] = $option['default'];
            } elseif (isset($option['datatype']) && $option['datatype'] == 'font') {
                $sanitized_options[$option['id'] . '_enable'] = $swift_font_defaults[$option['id'] . '_enable'];
                $sanitized_options[$option['id'] . '_family'] = $swift_font_defaults[$option['id'] . '_family'];
                $sanitized_options[$option['id'] . '_size'] = $swift_font_defaults[$option['id'] . '_size'];
                $sanitized_options[$option['id'] . '_size_unit'] = $swift_font_defaults[$option['id'] . '_size_unit'];
                $sanitized_options[$option['id'] . '_lh'] = $swift_font_defaults[$option['id'] . '_lh'];
                $sanitized_options[$option['id'] . '_lh_unit'] = $swift_font_defaults[$option['id'] . '_lh_unit'];
                $sanitized_options[$option['id'] . '_weight'] = $swift_font_defaults[$option['id'] . '_weight'];
                $sanitized_options[$option['id'] . '_transform'] = $swift_font_defaults[$option['id'] . '_transform'];
                $sanitized_options[$option['id'] . '_style'] = $swift_font_defaults[$option['id'] . '_style'];
            }
        }

        if (is_array(get_option('SwiftOptions'))) {
            $temp_options = get_option('SwiftOptions');
        }
        if ($input['which'] == 'options') {
            $temp_options['site_options'] = $sanitized_options;
        } elseif ($input['which'] == 'design_options') {
            $temp_options['design_options'] = $sanitized_options;
        }
	    $temp_options['reset'] = $input['which'];
        update_option('SwiftOptions', $temp_options);
        return NULL;
    }
    foreach ($options as $option) {
        if (!isset($option['datatype'])) {
            continue;
        }
        switch ($option['datatype']) {
            case 'none' :
                break;
            case 'hidden' :
                break;

            case 'predefined' :
                $keys = array_keys($option['options']);
                if (isset ($input[$option['id']]) && in_array($input[$option['id']], $keys)) {
                    $sanitized_options[$option['id']] = $input[$option['id']];
                } else {
                    $sanitized_options[$option['id']] = $option['default'];
                }
                break;
            case 'int' :
                $sanitized_options[$option['id']] = absint($input[$option['id']]);

                break;

            case 'float' :
                $sanitized_options[$option['id']] = abs((float)$input[$option['id']]);

                break;

            case 'uri' :
                $sanitized_options[$option['id']] = esc_url($input[$option['id']]);

                break;

            case 'text' :
                $sanitized_options[$option['id']] = sanitize_text_field($input[$option['id']]);

                break;

            case 'javascript' :
                $sanitized_options[$option['id']] = force_balance_tags($input[$option['id']]);
                break;

            case 'sortable_array' :
                $temp = array();
                $temp = explode(',', $input[$option['id']]);
                $sanitized_options[$option['id']] = $temp;

                break;

            case 'sortable' :
                $i = 0;
                $temp = $temp2 = array();
                $temp = explode(',', $input[$option['id']]);
                foreach ($temp as $value) {
                    if (!in_array($value, $option['options']) && $value != '') {
                        $temp2[$i++] = "text";
                        $temp2[$i++] = $value;
                    } else {
                        $temp2[$i++] = $value;
                    }
                }

                $sanitized_options[$option['id']] = $temp2;

                $temp2 = $temp = NULL;
                break;

            case 'cat_colors':
                $cats = get_categories();
                //var_dump($input);
                foreach ($cats as $cat) {
                    if (isset($input['cat_colors']['category-' . $cat->slug]))
                        $sanitized_options['cat_colors']['category-' . $cat->slug] = strip_tags($input['cat_colors']['category-' . $cat->slug]);
                    //echo ($input['cat_colors']['category-'.$cat->slug]);

                }
                //boom();
                break;

            case 'google_fonts':
                $temp = array();
                if (isset($input[$option['id']]) && is_array($input[$option['id']])) {
                    foreach ($input[$option['id']] as $font) {
                        $temp2 = explode('%', $font);
                        $temp2[1] = ($temp2[1] === 'true') || ($temp2[1] === '1') ? true : false;
                        $temp2[2] = ($temp2[2] === 'true') || ($temp2[2] === '1') ? true : false;
                        $temp[] = $temp2;
                    }
                } else {
                    $temp = FALSE;
                }
                $sanitized_options[$option['id']] = $temp;

                break;

            case 'custom_slider':
                $slides = array();
                $slide_count = (int)($input['number_of_slides']);
                for ($i = 0; $i < $slide_count; $i++) {
                    if (empty($input['slides'][$i]['img']))
                        continue;
                    $slides[$i]['img'] = esc_url($input['slides'][$i]['img']);
                    $slides[$i]['href'] = esc_url($input['slides'][$i]['href']);
                    $slides[$i]['caption'] = ($input['slides'][$i]['caption']);
                }

                $sanitized_options['slides'] = $slides;


                break;


            case 'ads':
                $sanitized_options[$option['id']] = force_balance_tags($input[$option['id']]);

                break;


            case 'font' :
                $id = $option['id'];
                if (isset ($swift_design_options['fontstack1']) || isset ($swift_design_options['fontstack2']))
                    array_unshift($swift_font_stack, array(
                        $swift_design_options['fontstack1'],
                        ''
                    ), array(
                        $swift_design_options['fontstack2'],
                        ''
                    ));

                if (isset ($input[$option['id'] . '_enable']))
                    $sanitized_options[$option['id'] . '_enable'] = (bool)($input[$option['id'] . '_enable']);
                else
                    $sanitized_options[$option['id'] . '_enable'] = FALSE;
                /*
                 $keys = array_keys( $font_stack );
                if( in_array( $input[ $option['id'].'_family' ], $keys ) )
                    $sanitized_options[ $option['id'].'_family' ] = $input[ $option['id'].'_family'];
                else
                    $sanitized_options[ $option['id'].'_family' ] = '';
                */
                foreach ($swift_font_stack as $font) {
                    if ($input[$option['id'] . '_family'] == $font[0]) {
                        $sanitized_options[$option['id'] . '_family'] = $font[0];
                        BREAK;
                    } else {
                        $sanitized_options[$option['id'] . '_family'] = '';
                    }

                }

                $keys = array_keys($swift_font_unit);
                if (in_array($input[$option['id'] . '_size_unit'], $keys))
                    $sanitized_options[$option['id'] . '_size_unit'] = $input[$option['id'] . '_size_unit'];
                else
                    $sanitized_options[$option['id']] = '';

                if (in_array($input[$option['id'] . '_lh_unit'], $keys))
                    $sanitized_options[$option['id'] . '_lh_unit'] = $input[$option['id'] . '_lh_unit'];
                else
                    $sanitized_options[$option['id']] = '';

                $keys = array_keys($swift_font_style);
                if (in_array($input[$option['id'] . '_style'], $keys))
                    $sanitized_options[$option['id'] . '_style'] = $input[$option['id'] . '_style'];
                else
                    $sanitized_options[$option['id']] = '';

                $keys = array_keys($swift_font_weight);
                if (in_array($input[$option['id'] . '_weight'], $keys))
                    $sanitized_options[$option['id'] . '_weight'] = $input[$option['id'] . '_weight'];
                else
                    $sanitized_options[$option['id']] = '';

                $keys = array_keys($swift_text_transform);
                if (in_array($input[$option['id'] . '_transform'], $keys))
                    $sanitized_options[$option['id'] . '_transform'] = $input[$option['id'] . '_transform'];
                else
                    $sanitized_options[$option['id']] = '';

                $sanitized_options[$option['id'] . '_size'] = (float)($input[$option['id'] . '_size']);

                $sanitized_options[$option['id'] . '_lh'] = (float)($input[$option['id'] . '_lh']);

                break;

            case 'background' :
                $id = $option['id'];
                $sanitized_options[$id] = esc_url($input[$id]);
                $sanitized_options[$id . '_p_t'] = esc_attr($input[$id . '_p_t']);
                $sanitized_options[$id . '_p_l'] = esc_attr($input[$id . '_p_l']);
                $keys = array_keys($swift_image_repeat);
                if (in_array($input[$option['id'] . '_repeat'], $keys))
                    $sanitized_options[$option['id'] . '_repeat'] = $input[$option['id'] . '_repeat'];
                else
                    $sanitized_options[$option['id']] = '';

                break;

            case 'bool' :
                if (isset ($input[$option['id']]))
                    $sanitized_options[$option['id']] = (bool)($input[$option['id']]);
                else
                    $sanitized_options[$option['id']] = FALSE;

                break;

            case 'color' :
                if (!$input[$option['id']] || $input[$option['id']] == '') {
                    $sanitized_options[$option['id']] = '';
                } elseif ($input[$option['id']] == 'rgba(0, 0, 0, 0)') {
                    $sanitized_options[$option['id']] = 'transparent';
                } else {
                    $sanitized_options[$option['id']] = $input[$option['id']];
                }


                break;
            default :
                if (isset ($input[$option['id']]))
                    $sanitized_options[$option['id']] = $input[$option['id']];

                break;

        }
    }
    if (is_array(get_option('SwiftOptions'))) {
        $temp_options = get_option('SwiftOptions');
    } else {
        $temp_options = array();
    }
    if ($input['which'] == 'options') {
        $temp_options['site_options'] = $sanitized_options;
    } elseif ($input['which'] == 'design_options') {
        $temp_options['design_options'] = $sanitized_options;
    }

    if (isset($input['swift_typography_enable']) && $input['swift_typography_enable'] &&
        isset($input['swift_typography']) && $input['swift_typography']
    ) {
        GLOBAL $swift_typography_stack;

        if (is_array($temp_options['design_options']['swift_gfonts']))
            $temp_options['design_options']['swift_gfonts'] = array_merge($temp_options['design_options']['swift_gfonts'], $swift_typography_stack[$input['swift_typography']]['google_fonts']);
        else
            $temp_options['design_options']['swift_gfonts'] = $swift_typography_stack[$input['swift_typography']]['google_fonts'];

        $tmp = array();
        //var_dump($swift_typography_stack[$input['swift_typography']]['google_fonts']);
        //var_dump($temp_options['design_options']['swift_gfonts']);
        foreach ($temp_options['design_options']['swift_gfonts'] as $row) {
            if (!in_array($row, $tmp)) array_push($tmp, $row);
            //var_dump($row);

        }

        $temp_options['design_options']['swift_gfonts'] = $tmp;
    }

    $upload_dir = wp_upload_dir();
    if(is_writable(trailingslashit($upload_dir['basedir']) .'swift-magic')){
        $temp_options['site_options']['is_writable'] = true; 
    }

    update_option('SwiftOptions', $temp_options);
    return NULL;
}

add_action('admin_head', 'swift_on_activation',1);
/**
 *
 * Things to do when the theme is first installed
 */
function swift_on_activation()
{
    if (is_admin() && isset ($_GET['activated'])) {

        require_once get_template_directory() . '/lib/load-core.php';
        swift_functions();
        if (!get_option('SwiftOptions')) {

            GLOBAL $swift_options_init;
            foreach ($swift_options_init as $option) {
                // Use in array and include custom_slider
                if (isset($option['datatype']) && $option['datatype'] != 'none'){
                    $sanitized_options[$option['id']] = $option['default'];
                }
            }
            //update_option('swift_options',$sanitized_options);
            $temp['site_options'] = $sanitized_options;

            GLOBAL $swift_design_options_init;
            foreach ($swift_design_options_init as $option) {
                 if (isset($option['datatype']) && $option['datatype'] == 'font') {
                     GLOBAL $swift_font_defaults;

                     $sanitized_options[$option['id'] . '_enable'] = $swift_font_defaults[$option['id'] . '_enable'];
                    $sanitized_options[$option['id'] . '_family'] = $swift_font_defaults[$option['id'] . '_family'];
                    $sanitized_options[$option['id'] . '_size'] = $swift_font_defaults[$option['id'] . '_size'];
                    $sanitized_options[$option['id'] . '_size_unit'] = $swift_font_defaults[$option['id'] . '_size_unit'];
                    $sanitized_options[$option['id'] . '_lh'] = $swift_font_defaults[$option['id'] . '_lh'];
                    $sanitized_options[$option['id'] . '_lh_unit'] = $swift_font_defaults[$option['id'] . '_lh_unit'];
                    $sanitized_options[$option['id'] . '_weight'] = $swift_font_defaults[$option['id'] . '_weight'];
                    $sanitized_options[$option['id'] . '_transform'] = $swift_font_defaults[$option['id'] . '_transform'];
                     $sanitized_options[$option['id'] . '_style'] = $swift_font_defaults[$option['id'] . '_style'];
                 }elseif (isset($option['datatype']) && $option['datatype'] != 'none' && isset($option['default'])) {
                     $sanitized_options[$option['id']] = $option['default'];
                 }
            }
            $temp['design_options'] = $sanitized_options;
            update_option('SwiftOptions', $temp);
        }
        swift_write_file(true);
        //header('Location: ' . admin_url() . 'admin.php?page=swift-help');
    }
}

function download_css_js()
{
    if (($creds = request_filesystem_credentials('', '', false, false, null))) {
        if (!WP_Filesystem($creds)) {
            // our credentials were no good, ask the user for them again
            return;

        }
    }

    if (isset ($_POST['download_css'])) {

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=custom-styles.css");
        header("Content-Type: application/octet-stream; ");
        header("Content-Transfer-Encoding: binary");

        echo swift_generate_stylesheet();
    }

    if (isset ($_POST['download_js'])) {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=swift-scripts.js");
        header("Content-Type: application/octet-stream; ");
        header("Content-Transfer-Encoding: binary");

        echo swift_generate_js();
    }
}

?>