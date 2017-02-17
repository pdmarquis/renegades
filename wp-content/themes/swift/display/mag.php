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
    $post_class = 'clearfix mag1 omega';
} else {
    $post_class = "clearfix mag1";
}
$swift_post_count++;
?>

<article id="post-<?php the_ID(); ?>"
    <?php post_class($post_class . ' temp'); ?>>

    <?php
    the_post_thumbnail($swift_thumbnail_sizes['mag1'], array('class' => 'mag-thumbnail'));
    ?>
    <div class="div-content">

        <div class="entry-summary">
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>"
                   title="<?php printf(esc_attr__('Permalink to %s', 'swift'), the_title_attribute('echo=0')); ?>"
                   rel="bookmark"><?php the_title(); ?> </a>
            </h2>
            <?php
            if (isset($swift_design_options['mag_excerpts_enable']) && $swift_design_options['mag_excerpts_enable']):
                ?>
                <div class="excerpt">
                    <?php the_excerpt();
                    ?>
                </div>
            <?php endif; ?>
            <?php edit_post_link(__('Edit', 'swift'), '<span class="edit-link">', '</span>'); ?>

        </div>
        <!-- .entry-summary -->

        <?php if (comments_open()) : ?>
            <span
                class="comments-link alignright"><?php comments_popup_link(_x('0', '0 comments', 'swift'), _x('1', '1 comment', 'swift'), sprintf(_x('%s', 'n comments', 'swift'), '%')); ?>
			</span>
        <?php endif; // End if comments_open() ?>

        <footer class="entry-meta clearfix">


            <div class="alignleft">
                <?php
                $email_hash = md5(strtolower(get_the_author_meta('user_email')));
                $out = $email_hash;
                $out .= '?s=24';
                ?>
                <img src="#" class="avatar" data-gravatar-hash='<?php echo $out ?>'/> <a
                    href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                    rel="author"> <span class="meta-nav"><?php echo get_the_author() ?></span>
                </a>
                on
                <?php echo get_the_time(get_option('date_format')) ?>
            </div>
            <?php // echo get_the_category_list()?>
            <?php // echo get_the_tag_list('<span class="tags">',', ','</p>')?>

            <div class="clear"></div>

        </footer>
        <!-- #entry-meta -->
    </div>
</article>
<!-- #post-<?php the_ID(); ?> -->
