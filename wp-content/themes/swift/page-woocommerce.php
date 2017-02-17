<?php
/*
 Template Name: WooCommerce
*/
$content_width = (int)$swift_design_options['wrapper_width'] * .75 - 4 * $swift_design_options['airy'];
get_header();
?>

	<div id="content" class="fourcol-three woocommerce-page" role="main">
		<div class="div-content">
			<?php swift_before_content() ?>

			<?php while (have_posts()) : the_post(); ?>


				<?php get_template_part('display/post', 'page'); ?>

				<?php //swift_content_nav( 'nav-below' ); ?>

				<?php comments_template('', true); ?>

			<?php endwhile; // end of the loop. ?>
			<?php swift_after_content() ?>

		</div>
		<!-- #content -->
	</div>
	<!-- #primary -->
<?php get_sidebar('woocommerce'); ?>
<?php get_footer(); ?>