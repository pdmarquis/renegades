<?php
function swift_load_tab()
{

    $temp = get_option('SwiftOptions');
    $swift_options = $temp['site_options'];
    $category = $_POST['cat_id'];

    $swift_exclude_post_ids = $_POST['exclude_post_ids'];
    remove_filter('the_content', 'swift_single_ads');
    add_filter('image_downsize', 'swift_image_downsize', 10, 3);
    include(SWIFT_INCLUDES . '/np-tab.php');
    die();
}

add_action('wp_ajax_nopriv_load_np_tab', 'swift_load_tab');
add_action('wp_ajax_load_np_tab', 'swift_load_tab');
?>