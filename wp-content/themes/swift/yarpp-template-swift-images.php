<?php /*
Swift template for YARPP
Author: Satish Gandham
*/
GLOBAL $swift_options;
GLOBAL $swift_thumbnail_sizes;
GLOBAL $content_width;
$sizes = $swift_thumbnail_sizes['rp_thumbs'];
$count = 0;

?>

<?php if ($related_query->have_posts()): ?>
    <div id="related-posts" class="clearfix">
        <?php if (isset($swift_options['yarpp_title']) && $swift_options['yarpp_title'] != '') { ?>
            <p class="h4">
                <?php echo $swift_options['yarpp_title'] ?>
            </p>
        <?php } ?>
        <ol>
            <?php while ($related_query->have_posts()) : $related_query->the_post();
	            if(!has_post_thumbnail( $post->ID ))
		            continue;
	            $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $sizes[$count++]);

	            ?>
                <li class="clearfix">
                    <img data-src="<?php echo $img[0]; ?>"
                         src="<?php echo get_template_directory_uri(); ?>/images/rp-dummy.png"
                         width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>" class="rp-thumb">
                    <?php //the_post_thumbnail( $sizes[$count++], array( 'class' => 'rp-thumb') ); ?>
                    <a
                        href="<?php the_permalink() ?>">
                        <div class="rp-title-container <?php swift_random_gradient_class() ?>"></div>
                    </a>

                    <div class="rp-title"><a
                            href="<?php the_permalink() ?>" rel="bookmark" class="post-title"><?php the_title(); ?>
                        </a> <br/>
                        <?php swift_posted_on(); ?>
                    </div>
                    <div class="parallelogram c_count fa-comment"><?php comments_number('0', '1', '%'); ?></div>
                </li>
            <?php endwhile; ?>
        </ol>
    </div>
<?php else: ?>
    <p>
        <?php _e('No related posts.', 'swift'); ?>
    </p>
<?php endif; ?>
