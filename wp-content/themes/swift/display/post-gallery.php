<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Swift
 * @subpackage Template
 * @since Swift 6.0
 */
?>
<?php
GLOBAL $swift_options,$swift_design_options, $swift_is_mobile,$swift_hide_all_ads;
if($swift_is_mobile->isMobile() && !$swift_is_mobile->isTablet()){
    global $content_width;
}else{
    $content_width = $swift_design_options['wrapper_width'] - 4*$swift_design_options['airy'] -12;
}
?>
<div class="clear"></div>
<article id="post-<?php the_ID(); ?>"
    <?php post_class(); ?>>

    <div class="entry-content">
        <div id="nav-above" class="navigation">
            <div class="gallery-nav alignleft">
                <?php previous_image_link(array(48, 48)); ?>
            </div>
            <div class="gallery-nav alignright">
                <?php next_image_link(array(48, 48)); ?>
            </div>
            <h1 class="entry-title">
                <?php the_title(); ?>
            </h1>
        </div>
        <div class="clear"></div>


        <?php    if (!$swift_hide_all_ads && isset($swift_options['image_above_ad_enable']) && $swift_options['image_above_ad_enable'] && isset($swift_options['image_above_ad']) && $swift_options['image_above_ad'] != '')
            if ($swift_is_mobile->isMobile() && !$swift_is_mobile->isTablet())
                echo stripslashes($swift_options['image_above_ad_m']);
            else
                echo stripslashes($swift_options['image_above_ad']);        ?>


        <a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image($post->ID, array($content_width, 0), false, array('class' => 'gallery-full aligncenter')); ?>
        </a>

        <div class="entry-caption">
            <?php if (!empty($post->post_excerpt)) {
                echo '<h2>' . str_replace(array('<p>', '</p>'), "", get_the_excerpt()) . '</h2>';
            }?>
        </div>

        <?php the_content(sprintf(__('Continue reading %s&rarr;%s', 'swift'), '<span class="meta-nav">', '</span>')); ?>
        <div class="clear"></div>

        <?php    if (!$swift_hide_all_ads && isset($swift_options['image_below_ad_enable']) && $swift_options['image_below_ad_enable'] && isset($swift_options['image_below_ad']) && $swift_options['image_below_ad'] != '')
            if ($swift_is_mobile->isMobile() && !$swift_is_mobile->isTablet())
                echo stripslashes($swift_options['image_below_ad_m']);
            else
                echo stripslashes($swift_options['image_below_ad']);
        ?>
        <div id="nav-below" class="navigation clearfix">
            <div class="gallery-nav alignleft">
                <?php previous_image_link(array(48, 48)); ?>
            </div>
            <div class="gallery-nav alignright">
                <?php next_image_link(array(48, 48)); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- .entry-content -->

</article>
<!-- #post-<?php the_ID(); ?> -->
<div class="clear"></div>
