<?php /*
Swift template for YARPP
Author: Satish Gandham
*/
$sizes = array(array(600, 300), array(300, 300), array(300, 150), array(300, 150));
$count = 0;
?>

<?php if ($related_query->have_posts()): ?>
    <div id="st-related-posts" class="clearfix">
        <ol>
            <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                <li class="clearfix"><?php the_post_thumbnail($sizes[$count++], array('class' => 'st-rp-thumb st-rp-thumb-' . $count)); ?>
                    <a
                        href="<?php the_permalink() ?>" rel="bookmark" class="st-post-title"><?php the_title(); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ol>
    </div>
<?php else: ?>
    <p>
        <?php _e('No related posts.', 'swift'); ?>
    </p>
<?php endif; ?>
