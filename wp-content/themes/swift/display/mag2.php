<?php
/**
 * The default template for displaying content
 *
 * @package Swift
 * @subpackage template
 * @since 6.0
 */
?>
<?php
GLOBAL $swift_post_count, $swift_thumbnail_sizes, $swift_design_options, $swift_options;
$columns = isset($swift_design_options['cn_ws']) ? $swift_design_options['cn_ws'] : 2;
if ($swift_post_count % $columns == ($columns - 1)) {
    $post_class = 'clearfix mag2 omega';
} else {
    $post_class = "clearfix mag2";
}
$swift_post_count++;
?>

<article id="post-<?php the_ID(); ?>"
    <?php post_class($post_class); ?>>

    <?php
    the_post_thumbnail(array(120,120), array('class' => 'mag-thumbnail alignleft'));
    ?>
    <div class="div-content">

        <div class="entry-summary">
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>"
                   title="<?php printf(esc_attr__('Permalink to %s', 'swift'), the_title_attribute('echo=0')); ?>"
                   rel="bookmark"><?php the_title(); ?> </a>
            </h2>

        </div>
        <!-- .entry-summary -->



        <footer class="entry-meta clearfix">
            <?php swift_meta_generator($swift_options['home_grid_meta'], 'alignleft')?>
            <?php if (comments_open()) : ?>
                <span
                    class="comments-link alignright parallelogram fa-comments entry-meta"><?php comments_popup_link(_x('0', '0 comments', 'swift'), _x('1', '1 comment', 'swift'), sprintf(_x('%s', 'n comments', 'swift'), '%')); ?>
			</span>
            <?php endif; // End if comments_open() ?>


            <div class="clear"></div>
            <div class="button-group">
                <a href="#" class="btn btn-mini share fa-share-square-o">Share</a>&nbsp;
                <a href="<?php the_permalink()?>" class="btn btn-success btn-mini fa-eye">View Post</a>
                <?php  swift_social_media('<div class="mag2-sm-container"><ul class="mag2-sm clearfix">','</ul></div>',array('facebook','twitter','pinterest','google_plus'))?>
            </div>

        </footer>
        <!-- #entry-meta -->
    </div>
</article>
<!-- #post-<?php the_ID(); ?> -->
