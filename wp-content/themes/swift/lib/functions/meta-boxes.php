<?php
/* Define the custom box */

//add_action('add_meta_boxes', 'swift_add_custom_box');

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'swift_add_custom_box', 1 );

/* Do something with the data entered */
//add_action('save_post', 'swift_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function swift_add_custom_box()
{
    add_meta_box('hide_title', __('Swift CMS options', 'swift'), 'swift_post_meta_hide_title', '', 'side', 'high', '');
    add_meta_box('custom_css', __('Custom CSS for this page', 'swift'), 'swift_page_css', '', 'normal', 'high', '');
    add_meta_box('page_specific_ads', __('Enter ad code for page specific widget', 'swift'), 'swift_page_specific_ads', '', 'normal', 'high', '');
}

/* Prints the box content */
function swift_post_meta_hide_title($post)
{

    // Use nonce for verification
    wp_nonce_field((__FILE__), 'swift_noncename');

    $swift_post_meta = get_post_meta($post->ID, '_swift_post_meta', true);

    if (!is_array($swift_post_meta)) {
        $swift_post_meta['hide_title'] = FALSE;
        $swift_post_meta['disable_ads'] = FALSE;
        $swift_post_meta['disable_oversmart_tinymce'] = FALSE;
    }
    // The actual fields for data entry
    $output = '<p><input type="checkbox" id="swift_hide_title" name="swift_hide_title" value="TRUE" ';
    $output .= checked($swift_post_meta['hide_title'], TRUE, FALSE);
    $output .= ' />&nbsp;';
    $output .= '<label for="swift_hide_title">' . __("Hide post title", 'swift') . '</label></p>';

    $output .= '<p><input type="checkbox" id="swift_disable_ads" name="swift_disable_ads" value="TRUE" ';
    $output .= checked($swift_post_meta['disable_ads'], TRUE, FALSE);
    $output .= ' />&nbsp;';
    $output .= '<label for="swift_disable_ads">' . __("Disable ads within post content on this page", 'swift') . '</label></p>';

    $output .= '<p><input type="checkbox" id="swift_disable_all_ads" name="swift_disable_all_ads" value="TRUE" ';
    $output .= checked($swift_post_meta['disable_all_ads'], TRUE, FALSE);
    $output .= ' />&nbsp;';
    $output .= '<label for="swift_disable_all_ads">' . __("Disable all ads on this page", 'swift') . '</label></p>';


    $output .= '<p><input type="checkbox" id="swift_disable_oversmart_tinymce" name="swift_disable_oversmart_tinymce" value="TRUE" ';
    $output .= checked($swift_post_meta['disable_oversmart_tinymce'], TRUE, FALSE);
    $output .= ' />&nbsp;';
    $output .= '<label for="swift_disable_oversmart_tinymce">' . __("Prevent WordPress from adding &lt;p&gt; and removing &lt;br /&gt; tags.", 'swift') . '</label></p>';

    echo $output;
}

function swift_page_css($post)
{
    // Use nonce for verification
    wp_nonce_field((__FILE__), 'swift_noncename');

    $swift_post_meta = get_post_meta($post->ID, '_swift_post_meta', true);
    // The actual fields for data entry
	echo '<div style="width:48%;float:left;margin-right: 4%;"><label for="swift_page_css">';
    _e("CSS that's applied for all devices", 'swift');
    echo '</label> <br />';
    echo '<textarea name="swift_page_css" style="width:100%;height:120px;">';
    if (isset($swift_post_meta['page_css']))
        echo $swift_post_meta['page_css'];

    echo '</textarea><br /></div>';


	echo '<div style="width:48%;float:left;"><label for="swift_page_css_desktops">';
	_e("Only for desktop", 'swift');
	echo '</label> <br />';
	echo '<textarea name="swift_page_css_desktops" style="width:100%;height:120px;">';
	if (isset($swift_post_meta['page_css_desktops']))
		echo $swift_post_meta['page_css_desktops'];

	echo '</textarea><br /></div>';

	echo '<div class="clear"></div>';
	echo '<div style="width:48%;float:left;margin-right: 4%;"><label for="swift_page_css_tablets">';
	_e("Only for tablets", 'swift');
	echo '</label> <br />';
	echo '<textarea name="swift_page_css_tablets" style="width:100%;height:120px;">';
	if (isset($swift_post_meta['page_css_tablets']))
		echo $swift_post_meta['page_css_tablets'];

	echo '</textarea><br /></div>';


	echo '<div style="width:48%;float:left;"><label for="swift_page_css_mobiles">';
	_e("Only for mobiles", 'swift');
	echo '</label> <br />';
	echo '<textarea name="swift_page_css_mobiles" style="width:100%;height:120px;">';
	if (isset($swift_post_meta['page_css_mobiles']))
		echo $swift_post_meta['page_css_mobiles'];

	echo '</textarea><br /></div>';
	echo '<div class="clear"></div>';

}

function swift_page_specific_ads($post)
{
    // Use nonce for verification
    wp_nonce_field((__FILE__), 'swift_noncename');

    $swift_post_meta = get_post_meta($post->ID, '_swift_post_meta', true);
    // The actual fields for data entry
    echo '<textarea name="swift_page_ad" style="width:48%;height:120px;float:left;margin-right:3%">';
    if (isset($swift_post_meta['page_ad']))
        echo $swift_post_meta['page_ad'];

    echo '</textarea>';

    echo '<textarea name="swift_page_ad_m" style="width:48%;height:120px;float:left">';
    if (isset($swift_post_meta['page_ad_m']))
        echo $swift_post_meta['page_ad_m'];

    echo '</textarea><br />';

    echo '<div  class="clear"></div>';
    echo '<label for="swift_page_css">';
    _e("You can add page-specific CSS here", 'swift');
    echo '</label> <br />';

}

/* When the post is saved, saves our custom data */
function swift_save_postdata($post_id)
{
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    /* if ( !wp_verify_nonce( $_POST['swift_noncename'], plugin_basename( __FILE__ ) ) )
     return;
    */

    // Check permissions
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }

    // OK, we're authenticated: we need to find and save the data

    $swift_post_meta = get_post_meta($post_id, '_swift_post_meta', true);
    if (isset($_POST['swift_hide_title']) && $_POST['swift_hide_title'] == TRUE) {
        $swift_post_meta['hide_title'] = TRUE;
    } else {
        $swift_post_meta['hide_title'] = FALSE;
    }

    if (isset($_POST['swift_disable_ads']) && $_POST['swift_disable_ads'] == TRUE) {
        $swift_post_meta['disable_ads'] = TRUE;
    } else {
        $swift_post_meta['disable_ads'] = FALSE;
    }

    if (isset($_POST['swift_disable_all_ads']) && $_POST['swift_disable_all_ads'] == TRUE) {
        $swift_post_meta['disable_all_ads'] = TRUE;
    } else {
        $swift_post_meta['disable_all_ads'] = FALSE;
    }

    if (isset($_POST['swift_disable_oversmart_tinymce']) && $_POST['swift_disable_oversmart_tinymce'] == TRUE) {
        $swift_post_meta['disable_oversmart_tinymce'] = TRUE;
    } else {
        $swift_post_meta['disable_oversmart_tinymce'] = FALSE;
    }


    if (isset($_POST['swift_page_css']) && current_user_can('manage_options')) {
        $swift_post_meta['page_css'] =  ($_POST['swift_page_css']);
    }

	if (isset($_POST['swift_page_css_desktops']) && current_user_can('manage_options')) {
		$swift_post_meta['page_css_desktops'] =  ($_POST['swift_page_css_desktops']);
	}
	if (isset($_POST['swift_page_css_tablets']) && current_user_can('manage_options')) {
		$swift_post_meta['page_css_tablets'] =  ($_POST['swift_page_css_tablets']);
	}
	if (isset($_POST['swift_page_css_mobiles']) && current_user_can('manage_options')) {
		$swift_post_meta['page_css_mobiles'] =  ($_POST['swift_page_css_mobiles']);
	}

    if (isset($_POST['swift_page_ad']) && current_user_can('manage_options')) {
        $swift_post_meta['page_ad'] = ($_POST['swift_page_ad']);
    }
    if (isset($_POST['swift_page_ad_m']) && current_user_can('manage_options')) {
        $swift_post_meta['page_ad_m'] = ($_POST['swift_page_ad_m']);
    }

    update_post_meta($post_id, '_swift_post_meta', $swift_post_meta);

}

?>