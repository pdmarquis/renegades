<?php
GLOBAL $swift_exclude_post_ids, $swift_options;
$count = 0;
?>

<?php
if ($category == -2) {
    $r = new WP_Query(array('posts_per_page' => $swift_options['np_tabs_posts_number'], 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'order' => 'DESC', 'post__not_in' => $swift_exclude_post_ids));
} else {
    $r = new WP_Query(array('posts_per_page' => $swift_options['np_tabs_posts_number'], 'category__in' => $category, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'order' => 'DESC', 'post__not_in' => $swift_exclude_post_ids));
}
if ($r->have_posts()) :

    ?>
    <?php  while ($r->have_posts()) : $r->the_post();
    $swift_exclude_post_ids[] = get_the_ID();

    ?>
    <h3 class="post-title"><a href="<?php the_permalink() ?>"
                              title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if (get_the_title()) the_title(); else the_ID(); ?>
        </a></h3>

    <?php
    if ($count % 3 == 0) {
        the_post_thumbnail(array(620, 360), array('class' => 'aligncenter np-tabs-large'));
    } else {
        the_post_thumbnail(array(120, 120), array('class' => 'alignleft thumb'));

    }
    ?>
    <?php the_excerpt();
    ?>
    <div class="clear"></div>
    <div class="sharing clearfix">

        <?php
        swift_social_media('<ul class="clearfix alignleft">', '</ul>');
        ?>

        <div class="alignright">
    		<span
                class="comments-link alignright"><?php comments_popup_link(_x('0', '0 comments', 'swift'), _x('1', '1 comment', 'swift'), sprintf(_x('%s', 'n comments', 'swift'), '%')); ?>
    		</span>
        </div>
    </div>
    <div class="clear"></div>

    <?php $count++;endwhile; ?>
    <div class="clear"></div>

<?php endif; ?>
<?php wp_reset_query(); ?>

