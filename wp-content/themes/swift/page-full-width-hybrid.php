<?php
/*
 Template Name: Full width hybrid template
*/
$content_width = $swift_design_options['wrapper_width'] - 4 * $swift_design_options['airy'];
get_header(); ?>

	</div>
	</div>
	<div id="content" role="main"
	     class="clearfix">

		<?php while (have_posts()) : the_post(); ?>



			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<!-- .entry-content -->
			</article>
			<!-- #post-<?php the_ID(); ?> -->

			<div class="hybrid">
	<div class="div-content">
			<?php comments_template('', true); ?>
	</div>
			</div>
		<?php endwhile; // end of the loop. ?>

	</div>
	<!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>