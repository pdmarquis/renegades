<?php
GLOBAL $swift_thumbnail_sizes;
GLOBAL $swift_exclude_post_ids;
GLOBAL $swift_is_mobile;
GLOBAL $swift_options;
?>
<div id="np-tiles">
    <?php
    wp_reset_query();
    $args = array();
    if ($swift_is_mobile->isTablet())
        $args['posts_per_page'] = 3;
    else
        $args['posts_per_page'] = $swift_options['np_tiles_count'];;

    $args['ignore_sticky_posts'] = true;
    $args['category__in'] = $swift_options['np_tiles_cats'];;
    $args['post__not_in'] = $swift_exclude_post_ids;
    $r = new WP_Query();
    $r->query($args);
    while ($r->have_posts()) : $r->the_post();
        ?>
        <div class="twocol-one">
            <div class="div-content">
                <?php

                the_post_thumbnail($swift_thumbnail_sizes['np-tiles'], array('class' => "alignleft"));
                the_title('<strong class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></strong>');
                $swift_exclude_post_ids[] = get_the_ID();
                ?>

            </div>
        </div>
    <?php endwhile; ?>
    <div class="clear"></div>
    <div class="div-content" id="np-ad">
        <?php
        if (isset ($swift_options['np_below_tiles_ad_enable']) && $swift_options['np_below_tiles_ad_enable']) {
            if ($swift_is_mobile->isMobile() && !$swift_is_mobile->isTablet())
                echo do_shortcode(stripslashes($swift_options['np_below_tiles_ad_m']));
            else
                echo do_shortcode(stripslashes($swift_options['np_below_tiles_ad']));
        }
        ?>
    </div>
</div>
