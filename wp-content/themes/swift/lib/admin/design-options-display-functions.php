<?php
/*
 * Created on Jan 12, 2013
*
* To change the template for this generated file go to
* Window - Preferences - PHPeclipse - PHP - Code Templates
*/

function swift_cat_colors()
{
    global $swift_design_options;
    $swift_design_opt = $swift_design_options;
    $cats = get_categories();
    ?>
    <div class="clear"></div>
    <script>
        jQuery(function () {
            jQuery(".palette").draggable({revert: true});

            jQuery(".cat-colors").droppable({
                drop: function (event, ui) {
                    var palette = ui.draggable.attr('data');
                    jQuery(this).find('input.hidden').attr('value', palette)

                    jQuery(this).attr('data', palette)

                    jQuery(this).removeClass(function (index, css) {
                        return (css.match(/\palette_\S+/g) || []).join(' ');
                    })

                    jQuery(this).addClass('palette_' + palette)
                }
            });

        });
    </script>
    <?php

    include(trailingslashit(SWIFT_ADMIN) . 'palette.php');
    $css = '';
    foreach ($swift_palette as $key => $value) {
        $css .= ".box.palette_$key{background:{$value['bg']}!important;color:{$value['color']}}";
        $css .= ".box.palette_$key .meta{background:{$value['meta']}!important}";
    }
    ?>
    <style>
        <?php echo $css ?>
    </style>
    <div class="explain alert alert-info"><h2>
            <?php _e('Drag the color palettes below onto the categories to paint them.Categories below screen? Don\'t worry, once you painted a category, you can drag it over others', 'swift'); ?>
            :)</h2></div>
    <?php
    foreach ($swift_palette as $key => $value) {
        ?>
        <div class="palette palette_<?php echo $key ?> box" data="<?php echo $key ?>">
            <a href="#"><img
                    src="<?php echo get_template_directory_uri() ?>/lib/admin/images/holder.jpg"
                    alt="SwiftThemes"> </a>

            <div class="entry-content">
                <h1>Lorem Ipsum is simply dummy</h1>

                <p>
                    text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                    text ever since the 1500s, when an unknown &hellip;
                </p>
            </div>
            <div class="meta">
                January 7, 2012
            </div>
        </div>

    <?php
    }
    echo '<div class="clear"></div>';
    ?>
    <h2 style="padding:10px;border-bottom:solid 1px #CCC;margin-bottom:20px">Category colors when using magazine
        layout</h2>
    <?php
    foreach ($cats as $cat) {
        ?>
        <div
            data="<?php echo (!isset($swift_design_options['cat_colors']['category-' . $cat->slug])) ? '' : $swift_design_options['cat_colors']['category-' . $cat->slug]; ?>"
            id="<?php echo 'category-' . $cat->slug ?>"
            class="clearfix cat-colors box palette palette_<?php echo (!isset($swift_design_options['cat_colors']['category-' . $cat->slug])) ? '' : $swift_design_options['cat_colors']['category-' . $cat->slug]; ?>"
            id="<?php echo 'category-' . $cat->slug ?>">
            <input class="hidden" name="swift_design_options[cat_colors][<?php echo 'category-' . $cat->slug ?>]"
                   value="<?php echo (!isset($swift_design_options['cat_colors']['category-' . $cat->slug])) ? '' : $swift_design_options['cat_colors']['category-' . $cat->slug]; ?>"/>
            <a href="#"><img
                    src="<?php echo get_template_directory_uri() ?>/lib/admin/images/holder.jpg"
                    alt="SwiftThemes"> </a>

            <div class="entry-content">
                <h1><?php echo $cat->name; ?></h1>

                <p>
                    text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                    text ever since the 1500s
                </p>
            </div>
            <div class="meta">
                January 7, 2012
            </div>
        </div>

    <?php
    }
}

function swift_set_widths()
{
    global $swift_design_options;
    $wrapper = ($swift_design_options['wrapper_width'] - 2 * $swift_design_options['airy']) / 100;
    echo '<div id="width-selector" class="btn btn-danger btn-large clearfix">';
    echo '<h4>Set the content and sidebar widths by dragging the vertical lines below</h4> <br>{<em>Widths are correct upto 1px</em>}<div class=""clear"></div>';
    echo '<ul class="alignleft"><li id="content-width">Content width is <strong >' . $swift_design_options['content_width'] . '% {' . (int)($swift_design_options['content_width'] * $wrapper) . 'px}</strong></li>';
    echo '<li id="sb-width">Sidebar  width is <strong >' . (100 - $swift_design_options['content_width']) . '% {' . (int)((100 - $swift_design_options['content_width']) * $wrapper) . 'px}</strong></li>';
    echo '<li id="sb1-width">Sidebar 1 width is <strong >' . $swift_design_options['sb1_width'] . '% {' . (int)($swift_design_options['sb1_width'] * $wrapper) . 'px}</strong></li>';
    echo '<li id="sb2-width">Sidebar 2 width is <strong >' . (100 - $swift_design_options['content_width'] - $swift_design_options['sb1_width']) . '% {' . (int)((100 - $swift_design_options['content_width'] - $swift_design_options['sb1_width']) * $wrapper) . 'px}</strong></li></ul>';
    echo '<div class="clear"></div><div id="slider-range"></div>';
    echo '</div>';
    ?>
    <div id="width-demo">
        <div id="content"></div>
        <div id="sidebar">
            <div id="sb1"></div>
            <div id="sb2"></div>
        </div>
    </div>
<?php
}

function swift_gfonts()
{
    global $swift_design_options;

    ?>
    <div id="selected_fonts" class="clearfix">
        <?php
        if (isset($swift_design_options['swift_gfonts']) && is_array($swift_design_options['swift_gfonts'])):
            foreach ($swift_design_options['swift_gfonts'] as $font) {
                $san_font = preg_replace('([\s\:\,\+])', '_', $font[0]);
                $li = '<li id="li_' . $san_font . '" style="font-family:' . $font[0] . '" class="btn btn-primary"><strong>' . $font[0] . '</strong><br><span>';
                if ($font[1] && $font[2]) {
                    $li .= 'For blogname and tagline only';
                } else {
                    if ($font[1])
                        $li .= 'For blogname only';
                    if ($font[2])
                        $li .= 'For tagline only';
                }
                if (!$font[1] && !$font[2]) {
                    $li .= 'Load entire font';
                }
                $li .= '</span><span data="' . $san_font . '"class="remove"></li>';
                $input = '<input type="hidden" id="input_' . $san_font . '" name="swift_design_options[swift_gfonts][]" value="' . $font[0] . '%' . $font[1] . '%' . $font[2] . '">';

                echo $li;
                echo $input;
            }
        endif;
        ?>
    </div>

    <div id="font_demo">
        <input type="text" value="SwiftThemes" id="sample_text"><label
            for="sample_text"><?php _e('Preview text', 'swift') ?></label>
    </div>
    <div id="font_preview">
        <?php global $current_user;
        get_currentuserinfo(); ?>
        <h2>
            <?php bloginfo('name'); ?>
        </h2>

        <p>
            Howdy
            <?php echo $current_user->display_name; ?>
            ,<br> Thank you for purchasing and using Swift on this blog. If you
            need <strong>any help with WordPress</strong>, feel free to drop me a
            mail at <strong>satish@swiftthemes.com</strong>.<br> <img
                src="<?php echo THEME_URI ?>/lib/admin/images/idea.png">Do you know,
            we can optimize your blog to get <strong>90+ page speed score for only
                50$.</strong>
        </p>
    </div>
    <div id="font_optimization">
        <button type="button" id="addfont" style="margin-top: -4px"
                class="btn btn-primary btn-xs alignright">Click Me!
        </button>
        <input type="checkbox" name="blogname" value="true" id="blogname"><label
            for="blogname">For blog name only</label> <input type="checkbox"
                                                             name="blogname" value="true" id="tagline"><label
            for="tagline">For
            blog tag only</label>
    </div>
    <?php
    $i = 0;
    if (!($json = get_transient('swift_fonts_json'))) {
        $json = wp_remote_retrieve_body(wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDVKxwBB7u0r7p1jNtveJ-GA2EHvbGB6h4'));
        set_transient('swift_fonts_json', $json, 86400);
    }
    //var_dump($json);
    $fonts = json_decode($json, true);
    $fonts = $fonts['items'];
    $count = count($fonts);
    $font_list = '[';
    //var_dump($fonts);
    $i = 0;
    $step = 6;
    echo '<ul id="infinite_scroll">';
    for ($i; $i < $step; $i++) {
        $output = '<li style="font-family:' . $fonts[$i]['family'] . '" data="' . $fonts[$i]['family'] . '">' . $fonts[$i]['family'];
        $output .= '<div class="varinats"><strong>Select varinats:</strong>';
        foreach ($fonts[$i]['variants'] as $variant) {
            $output .= '<input type="checkbox" value="' . $variant . '" name="varinats[]">' . $variant;
        }
        $output .= '</div></li>';
        echo $output;

        $font_list .= '"' . $fonts[$i]['family'] . '",';
    }
    GLOBAL $swift_design_options;
    $selected_fonts = $swift_design_options['swift_gfonts'];
    if (isset($swift_design_options['swift_gfonts']) && is_array($swift_design_options['swift_gfonts'])):
        foreach ($swift_design_options['swift_gfonts'] as $font) {
            $font_list .= '"' . $font[0] . '",';
        }
    endif;
    $font_list .= ']';
    echo '</ul>';
    ?>
    <script
        src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"
        defer="true"></script>

    <script type="text/javascript">
        var font_list_start
        font_list_start =
        <?php echo $font_list ?>
    </script>
    <style type="text/css">
        #infinite_scroll {
            height: 240px;
            overflow-y: scroll;
            margin: 0 auto 20px;
            display: block;
            width: 100%;
        }

        #infinite_scroll a {
            font-weight: bold;
        }

        #infinite_scroll p {
            margin-bottom: 20px;
        }

        #infinite_scroll li {
            padding: 15px 20px;
            border-bottom: dotted 1px #CCC;
            font-size: 24px
        }

        .loading {
            text-align: right;
            margin-top: -100px
        }
    </style>
<?php
}

function swift_typography()
{

}

?>
