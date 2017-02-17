<?php
/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Swift 1.0
 */
function swift_sidebars_init()
{

    $widths = get_option('swift_dimensions');
    GLOBAL $swift_design_options;

    register_sidebar(array(
        'name' => __('Non sticky sidebar', 'swift'),
        'id' => 'ws_nonsticky',
        'class' =>'wsb',
        'description' => sprintf(__('This sidebar is %dpx wide and is displayed above the top wide sidebar. It doesnt stick to the top', 'swift'), $widths['wsb']),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => __('Wide sidebar top', 'swift'),
        'id' => 'wst',
        'class' =>'wsb',
        'description' => sprintf(__('This sidebar is %dpx wide and is displayed above the two narrow sidebars.', 'swift'), $widths['wsb']),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => __('Narrow sidebar, LEFT', 'swift'),
        'id' => 'ns1',
        'class' => 'ns1',
        'description' => sprintf(__('This sidebar is %dpx wide and is displayed between the two wide sidebars.', 'swift'), $widths['ns1']),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => __('Narrow sidebar, RIGHT', 'swift'),
        'id' => 'ns2',
        'class' => 'ns2',
        'description' => sprintf(__('This sidebar is %dpx wide and is displayed between the two wide sidebars.', 'swift'), $widths['ns2']),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => __('Wide sidebar bottom', 'swift'),
        'id' => 'wsb',
        'class' =>'wsb',
        'description' => sprintf(__('This sidebar is %dpx wide and is displayed below the two narrow sidebars.', 'swift'), $widths['wsb']),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    if ($swift_design_options['footer_columns'] >= 1) {
        register_sidebar(array(
            'name' => __('Footer area one', 'swift'),
            'id' => 'footer-1',
            'class' => 'footer',
            'description' => sprintf(__('An optional widget area for your site footer of width %dpx', 'swift'), $widths['footer-1']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<p class="widget-title">',
            'after_title' => '</p>',
        ));
    }

    if ($swift_design_options['footer_columns'] >= 2) {
        register_sidebar(array(
            'name' => __('Footer area two', 'swift'),
            'id' => 'footer-2',
            'class' => 'footer',
            'description' => sprintf(__('An optional widget area for your site footer of width %dpx', 'swift'), $widths['footer-1']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<p class="widget-title">',
            'after_title' => '</p>',
        ));
    }
    if ($swift_design_options['footer_columns'] >= 3) {
        register_sidebar(array(
            'name' => __('Footer area three', 'swift'),
            'id' => 'footer-3',
            'class' => 'footer',
            'description' => sprintf(__('An optional widget area for your site footer of width %dpx', 'swift'), $widths['footer-1']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<p class="widget-title">',
            'after_title' => '</p>',
        ));
    }
    if ($swift_design_options['footer_columns'] >= 4) {
        register_sidebar(array(
            'name' => __('Footer area four', 'swift'),
            'id' => 'footer-4',
            'class' => 'footer',
            'description' => sprintf(__('An optional widget area for your site footer of width %dpx', 'swift'), $widths['footer-1']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<p class="widget-title">',
            'after_title' => '</p>',
        ));
    }

    if ($swift_design_options['footer_columns'] >= 5) {
        register_sidebar(array(
            'name' => __('Footer area five', 'swift'),
            'id' => 'footer-5',
            'class' => 'footer',
            'description' => sprintf(__('An optional widget area for your site footer of width %dpx', 'swift'), $widths['footer-1']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<p class="widget-title">',
            'after_title' => '</p>',
        ));
    }

    if ($swift_design_options['footer_columns'] >= 6) {
        register_sidebar(array(
            'name' => __('Footer area six', 'swift'),
            'id' => 'footer-6',
            'class' => 'footer',
            'description' => sprintf(__('An optional widget area for your site footer of width %dpx', 'swift'), $widths['footer-1']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<p class="widget-title">',
            'after_title' => '</p>',
        ));
    }

    register_sidebar(array(
        'name' => __('News paper sidebar', 'swift'),
        'id' => 'np-sb',
        'class' => 'np-sb',
        'description' => __('These widgets will be shown in the News paper layout', 'swift'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => __('Left sidebar page template', 'swift'),
        'id' => 'page_temp_l',
        'description' => __('These widgets will be shown on left sidebar page template', 'swift'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => __('Right sidebar page template', 'swift'),
        'id' => 'page_temp_r',
        'description' => __('These widgets will be shown on right sidebar page template', 'swift'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));


    register_sidebar(array(
        'name' => __('bbPress Sidebar', 'swift'),
        'id' => 'bbpress',
        'description' => __('These widgets will be shown on bbPress pages', 'swift'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));


    register_sidebar(array(
        'name' => __('WooCommerce Sidebar', 'swift'),
        'id' => 'woocommerce',
        'description' => __('These widgets will be shown on woocommerce pages', 'swift'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));
}

add_action('widgets_init', 'swift_sidebars_init');
?>