
<?php

/**
 * Swift Child
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage swift-child
 * @since 1.0
 */

function swift_child_enqueue_styles() {

    // enqueue parent styles
    $parent_style = 'swift-style';
    $parent_custom_style = 'swift_custom_styles';
    $parent_responsive_style = 'swift_responsive_layout';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( $parent_custom_style, content_url('/uploads/swift-magic') . '/custom-styles.css' );
    wp_enqueue_style( $parent_responsive_style, get_template_directory_uri() . '/css/responsive.css' );
    
    // enqueue child styles with parent styles as dependants
    wp_enqueue_style( 'swift-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style, $parent_custom_style, $parent_responsive_style),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'swift_child_enqueue_styles' );

function post_pw_sess_expire() {
    if ( isset( $_COOKIE['wp-postpass_' . COOKIEHASH] ) )
    // Setting a time of 0 in setcookie() forces the cookie to expire with the session
    setcookie('wp-postpass_' . COOKIEHASH, '', 0, COOKIEPATH);
}

add_action( 'wp', 'post_pw_sess_expire' );

function swift_child_before_content_search() {
    echo "<h2 style='font-size:20%;color:#FFFFFF;'>search this site</h2>";
}

add_action('swift_before_content_search', 'swift_child_before_content_search');

?>
