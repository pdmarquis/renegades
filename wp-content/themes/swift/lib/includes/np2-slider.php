<?php
global $swift_options;
$args['posts_per_page'] = $swift_options['np_slider_posts_number'];
$args['ignore_sticky_posts'] = true;
if(!in_array(-2,$swift_options['np_slider_cats']))
	$args['category__in'] = $swift_options['np_slider_cats'];
$recentPosts = new WP_Query();
$recentPosts->query($args);
global $swift_thumbnail_sizes;
global $swift_exclude_post_ids;
?>
<?php if (have_posts()) :

    ?>
    <div id="np-slider" class="flex-container clearfix">
        <div class="flexslider">
            <ul class="slides">
                <?php while ($recentPosts->have_posts()) : $recentPosts->the_post();
                    $swift_exclude_post_ids[] = get_the_ID()

                    ?>
                    <li><?php   the_post_thumbnail(array(480, 296), array('class' => "slide-thubnail")
                        );
                        ?>
                        <div class="flex-caption">
                            <?php              the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                            ?>
                            <?php the_excerpt() ?>
                        </div>
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>

            </ul>
        </div>
    </div>
    <div class="clear"></div>
<?php endif; ?>
<?php wp_reset_query(); ?>