<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Swift
 * @subpackage Template
 */

get_header();
global $swift_options, $swift_design_options, $swift_post_count;
$swift_post_count = 0;

$content_id = 'blog-wrapper';
if($swift_design_options['blog_or_mag_archives'] == 'blog'){
    $layout = 'display/blog';
}elseif (in_array($swift_design_options['blog_or_mag_archives'], array('magazine', 'magazine-full'))) {
    $layout = 'display/mag';
    $content_id = 'mas-wrapper';
}elseif(in_array($swift_design_options['blog_or_mag_archives'], array('magazine-grid', 'magazine-grid-full'))){
    $layout = 'display/mag2';
}elseif ($swift_design_options['blog_or_mag_archives'] == 'list') {
    $layout = 'display/list';
}


?>
    <div id="content" role="main">
        <div class="div-content clearfix">

            <?php swift_before_content() ?>

            <?php
            if (isset($_GET['author_name'])) :
                $curauth = get_userdatabylogin($author_name);
            else:
                $curauth = get_userdata(intval($author));
            endif;

            $google_profile = $curauth->google_profile;

            if ($google_profile) {
                $author_name = '<a href="' . esc_url($google_profile) . '" title="' . $curauth->display_name . '\' google profile" rel="me">' . $curauth->display_name . '</a>';
            } else {
                $author_name = $curauth->display_name;
            }
            ?>
            <div id="author-info" class="clearfix" style="margin-top: 20px">
                <h3 class="archive-title reset">
                    <span class="normal"><?php _e('About', 'swift') ?> </span>
                    <?php echo $author_name; ?>
                </h3>
			<span id="author-avatar"><?php echo get_avatar($curauth->user_email, 90); ?>
			</span>
                <?php
                if (!empty($curauth->user_description))
                    echo $curauth->user_description . '<br />';
                ?>
                <strong><?php _e('Website:', 'swift') ?> </strong> <a
                    href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?>
                </a><br/>
                <?php
                printf(((get_the_author_posts() > 0) ? _n('%1$s has written %2$s article so far, you can find it below.',
                    '%1$s has written %2$s articles so far, you can find them below.', get_the_author_posts(), 'swift') : __('%1$s has written no articles so far.', 'swift')), $curauth->nickname, '<strong>' . get_the_author_posts() . '</strong>'); ?>
                <br/>
            </div>
        </div>
        <div id="<?php echo $content_id ?>" class="div-content clearfix">
            <div class="gutter-sizer"></div>

            <?php if (have_posts()) : ?>
                <?php if ($swift_design_options['blog_or_mag_archives'] == 'list') echo '<ul class="post-listing">' ?>
                <?php /* Start the Loop */ ?>
                <?php
                while (have_posts()) : the_post();
                    get_template_part($layout, get_post_format());
                endwhile;
                ?>
                <?php if ($swift_design_options['blog_or_mag_archives'] == 'list') echo '</ul>' ?>

            <?php else : ?>

                <article id="post-0" class="post no-results not-found">
                    <header class="entry-header">
                        <h1 class="entry-title">
                            <?php _e('Nothing Found', 'swift'); ?>
                        </h1>
                    </header>
                    <!-- .entry-header -->

                    <div class="entry-content">
                        <p>
                            <?php _e('Apologies, but no results were found for the requested author. Perhaps searching will help find a related post.', 'swift'); ?>
                        </p>
                        <?php get_search_form(); ?>
                    </div>
                    <!-- .entry-content -->
                </article>
                <!-- #post-0 -->

            <?php endif; ?>

            <?php swift_after_content() ?>
            <div class="clear"></div>
        </div>
        <!-- /.div-content -->
        <div class="div-content">
            <?php if (function_exists('swift_pagenavi')) swift_pagenavi(); ?>
        </div>
    </div>
    <!-- #content -->
<?php
if (in_array($swift_design_options['blog_or_mag_archives'], array('magazine-full', 'magazine-grid-full')))
    echo '</div></div>';
else
    get_sidebar();
?>
<?php get_footer(); ?>