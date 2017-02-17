<?php
GLOBAL $swift_options;
$cat_list = $swift_options['np_mag_cats'];
$count = 0;
global $swift_exclude_post_ids;
foreach ($cat_list as $category) {
    $post_count = 0;
    ?>
    <div class="fourcol-one np-mags">
        <div class="div-content">
            <p class="np-section-title">
                <?php ?>
                <a href="<?php echo get_category_link($category) ?>"
                   title="<?php printf(__('View more posts from %s', 'swift'), get_cat_name($category)); ?>"><?php echo get_cat_name($category) ?>
                </a>
                <a class="alignright fa-rss" href="<?php echo get_category_feed_link($category, 'rss2') ?>"></a>
            </p>

            <div class="clear"></div>
            <?php
            $r = new WP_Query(array('posts_per_page' => 4, 'cat' => $category, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'post__not_in' => $swift_exclude_post_ids));
            if ($r->have_posts()) :
            while ($r->have_posts()) :
            $r->the_post();
            $swift_exclude_post_ids[] = get_the_ID();

            if ($post_count++ == 0):
            ?>
            <div id="post-<?php the_ID(); ?>"
                <?php post_class('np-blog-posts clearfix'); ?>>
                <?php
                the_post_thumbnail(array(265, 163), array('class' => 'np-mag-thumb alignleft',
                        'title' => trim(strip_tags(get_the_title()))
                    )
                );
                ?>
                <h4 class="post-title">
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                       title="<?php printf(esc_attr__('Permalink to %s', 'swift'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?>
                    </a>
                </h4>
                <?php
                echo substr(get_the_excerpt(), 0, 180); ?>
                <a href="<?php the_permalink() ?>"><?php _e('Full Story &raquo;', 'swift'); ?>
                </a>
            </div>

            <div class="clear"></div>
            <ul>
                <?php continue;
                endif; ?>
                <li class="clearfix">
                    <?php the_post_thumbnail(array(48, 48), array('class' => 'alignleft thumb')) ?>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                       title="<?php printf(esc_attr__('Permalink to %s', 'swift'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
                    <?php if (isset($swift_options['np_hide_date']) && !$swift_options['np_hide_date']): ?>
                        <br/><span
                            class="meta"><?php echo get_the_time(get_option('date_format'), get_option('time_format')) ?></span>
                    <?php endif; ?>
                </li>

                <?php endwhile;
                endif; ?>
                <?php wp_reset_query(); ?>
            </ul>
        </div>
    </div>
    <?php $count++;
} ?>