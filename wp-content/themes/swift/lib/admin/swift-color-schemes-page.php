<?php
/**
 * Display the contents of the color schemes page
 */
function swift_color_schemes_page()
{
    ?>
    <div class="wrap clearfix">
        <style>
            .ui-tabs .ui-tabs-nav, div.wrap {
                background: none
            }

            div.wrap {
                padding-bottom: 20px
            }

            .current-color-scheme {
                position: relative;
                width: 100%;
                float: left
            }

            .current-color-scheme div {
                float: left;
                position: relative
            }

            .current-color-scheme .buttons {
            }

            .current-color-scheme .button {
                -webkit-border-radius: 5px;
                color: #C00;
                font-weight: lighter !important;
                padding: 6px 10px;
                opacity: .95;
                -moz-border-radius: 5px;
                border-radius: 5px;
                font-size: 18px;
                height: auto !important;
            }

            .current-color-scheme span {
                display: none
            }

            .current-color-scheme div:hover span {
                display: block;
                width: 100%;
                padding: 5px 0;
                background: rgba(0, 0, 0, .8);
                text-align: center;
                color: #F00;
                position: absolute;
                top: 50%;
                left: 0;
                font-size: 10px;
                min-width: 120px;
                z-index: 20
            }

            .color-schemes {
                padding: 10px;
                border: solid 1px #DDD;
                background: #f6f6f6;
                width: 385px;
                margin: 20px 9px 0;
                position: relative;
                float: left
            }

            .color-schemes img {
                float: left;
            }

            .color-schemes .scheme-colors {
                float: right;
                width: 75px
            }

            .color-schemes form {
                display: none
            }

            .color-schemes:hover form {
                display: inline-block;
                float: right;
                position: absolute;
                top: 48%;
                left: 32%
            }

            .color-schemes .button {
                padding: 10px;
                font-weight: bold;
                opacity: .9;
                color: #f00;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                height: auto;
            }

            .buttons {
                border: solid 1px #DDD;
                border-width: 0 1px 1px;
                display: block;
                width: 100%;
                background: #F6F6F6;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;

            }

            .buttons form {
                float: left;
                padding: 20px;
            }

            .buttons input[type="text"] {
                line-height: 26px;
                padding: 6px 10px;
                display: block;
                width: 100%
            }

            .buttons form:first-child {
                border-right: solid 1px #CCC
            }
        </style>
        <?php
        swift_admin_header();
        swift_import_color_scheme();
        swift_download_colors();
        swift_list_themes();
        ?>
        <div class="clear"></div>

    </div>

<?php
}

/**
 * Imports the color scheme
 * Reads the color settings from colors.php and updates theme to database
 */

function swift_import_color_scheme()
{
    if (isset($_POST['scheme'])) {
        $dir = get_template_directory() . '/colors/' . $_POST['scheme'];
        if (is_dir($dir)) {
            include $dir . '/colors.php';
            global $swift_design_options, $swift_colors;
            foreach ($swift_colors as $key => $value) {
                $swift_design_options[$key] = $value;
            }
            $temp_options = get_option('SwiftOptions');
            $temp_options['design_options'] = $swift_design_options;
            update_option('SwiftOptions', $temp_options);
            if (swift_write_file(TRUE)) return;

        }
    }
}

function cmp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}

add_action('admin_init', 'swift_save_color_scheme', 10);
function swift_save_color_scheme()
{
    if (isset($_POST['save_color_scheme'])) {

        $scheme_name = sanitize_text_field($_POST['scheme_name']);
        global $swift_design_options_init;
        global $swift_design_options;
        $start = array_keys($swift_design_options_init, 'color_options_start');
        $end = array_keys($swift_design_options_init, 'color_options_end');

        $colors = array_slice($swift_design_options_init, $start[0] + 1, $end[0] - $start[0] - 1);


        //header('Content-Type: text/plain');
        //header("Content-Disposition: attachment; filename=colors.php");
        //header("Content-Type: application/octet-stream; ");
        //header("Content-Transfer-Encoding: binary");

        global $current_user;
        $author = get_currentuserinfo();
        $output = '<?php';
        $output .= "\n/*\n";
        $output .= "Scheme Name: " . $scheme_name . " \n";
        $output .= "Scheme URI: http://SwiftThemes.Com \n";
        $output .= "Description: " . __('Describe your color scheme here, you could say how you picked the colors', 'swift') . "\n";
        $output .= "Author: {$current_user->user_nicename}\n";
        $output .= "Author URI: {$current_user->user_url}\n";
        $output .= "Version: 0.0.0\n";
        $output .= "Tags:\n\n";
        $output .= "License:\n";
        $output .= "License URI:\n\n";
        $output .= __('Add general comments here', 'swift') . "\n";
        $output .= "*/\n\n\n";

        $output .= 'GLOBAL $swift_colors;' . "\n";
        $output .= '$swift_colors = array(';
        foreach ($colors as $color) {
            if (isset($color['id']))
                $output .= "\t'" . $color['id'] . "' =>'" . $swift_design_options[$color['id']] . "',\n";
        }
        $output = substr($output, 0, -2); //get rid of the ; from the last array element
        $output .= ");\n";
        $output .= "?>";
        $url = wp_nonce_url('admin.php?page=swift-color-schemes');

        if (false === ($creds = request_filesystem_credentials($url, '', false, false, null))) {
            // if we get here, then we don't have credentials yet,
            // but have just produced a form for the user to fill in,
            // so stop processing for now

            return true; // stop the normal page form from displaying
        }

        // now we have some credentials, try to get the wp_filesystem running
        if (!WP_Filesystem($creds)) {
            // our credentials were no good, ask the user for them again
            request_filesystem_credentials($url, '', true, false, $_POST);
            return true;
        }

        global $wp_filesystem;
        $scheme_path = THEME_DIR . '/colors/' . $scheme_name;
        print $scheme_path;
        $msg = '';
        if (!is_dir($scheme_path)) {
            if (!$wp_filesystem->mkdir($scheme_path)) {
                $msg .= '<li>Error creating directory</li>';
                $error = 1;
            } else {
                $msg .= '<li>Created color scheme directory at <strong>' . $scheme_path . '</strong></li>';
            }
        }
        if (!$wp_filesystem->put_contents($scheme_path . '/colors.php', $output, FS_CHMOD_FILE)) {
            $msg .= '<li>Error creating color scheme</li>';
            $error = 1;
        } else {
            $msg .= '<li>Successfully save the color scheme at <strong>' . $scheme_path . '</strong></li>';

        }
        echo $msg;


    }
}

//swift_save_color_scheme();
/**
 * List the color schemes.
 * Scans the color schmes in colors folder of the theme
 * and displays each color scheme.
 */

function swift_list_themes()
{
    $colors_dir = get_template_directory() . '/colors';
    if (is_dir(get_template_directory() . '/colors')) {
        $schemes = scandir($colors_dir);
        foreach ($schemes as $scheme) {
            //If not valid folder name, pass.
            if (!preg_match('/[\w_-]+/', $scheme))
                continue;

            $scheme_dir = $colors_dir . '/' . $scheme . '/';
            if (is_dir($scheme_dir) && @include($scheme_dir . '/colors.php')) {
                include $scheme_dir . '/colors.php';
                $result = array_count_values($swift_colors);
                uasort($result, 'cmp');
                $total_count = count($swift_colors) - $result["1"];
                ?>
                <div class="color-schemes clearfix">
                    <img
                        src="<?php echo get_template_directory_uri() . '/colors/' . $scheme . '/screenshot.png'; ?>"/>

                    <div class="scheme-colors">
                        <?php
                        foreach ($result as $color => $count) {
                            if ($color == '1' || $color == '') continue;
                            $height = (1 / (count($result) - 1) * 190) . 'px';
                            echo '<div style="background:' . swift_rgb2hex($color) . ';background:' . $color . ';height:' . $height . '"></div>';
                        }
                        ?>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" value="<?php echo $scheme ?>" name="scheme"> <input
                            type="submit" class="button" onClick="return confirm_color_import()"
                            value="<?php printf(__('Use %s', 'swift'), $scheme); ?>">
                    </form>
                </div>
            <?php
            }
        }
    } else {
        _e('Couldn\'t find the color schemes directory', 'swift');
        return;
    }
}

function swift_download_colors()
{
    global $swift_design_options;
    global $swift_design_options_init;

    $start = array_keys($swift_design_options_init, 'color_options_start');
    $end = array_keys($swift_design_options_init, 'color_options_end');

    $colors = array_slice($swift_design_options_init, $start[0] + 1, $end[0] - $start[0] - 1);

    $scheme = array();
    foreach ($colors as $color) {
        if (isset($color['id']) && isset($swift_design_options[$color['id']]) && $color['datatype'] == 'color')
            $scheme[] = $swift_design_options[$color['id']];
    }
    $result = array_count_values($scheme);
    uasort($result, 'cmp');
    ?>
    <div class="current-color-scheme">
        <?php
        $cummulative = 0;
        foreach ($result as $color => $count) {
            $cummulative += $count;
        }
        foreach ($result as $color => $count) {
            if ($color == '1' || $color == '') continue;
            $width = (string)(($count / $cummulative) * 100) . '%';
            echo '<div style="background:' . swift_rgb2hex($color) . ';background:' . $color . ';width:' . $width . ';height:100px;"><span>' . $color . '</span></div>';
        }
        ?>
        <div class="buttons">
            <form action="<?php echo THEME_URI ?>/lib/admin/download-colorscheme.php" method="post">
                <input type="text" name="scheme_name" placeholder="Color scheme name">
                <br>
                <input type="submit" class="button"
                       value="<?php _e('Download your current color scheme', 'swift'); ?>"
                       name="download">
            </form>
            <form action="" method="post">
                <input type="text" name="scheme_name" placeholder="Color scheme name">
                <br> <input type="submit" class="button"
                            value="<?php _e('Save current color scheme to theme folder', 'swift'); ?>"
                            name="save_color_scheme">
            </form>
        </div>
    </div>

<?php

}

?>