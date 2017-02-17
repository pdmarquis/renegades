<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package zenzero
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info smallPart">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'zenzero' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'zenzero' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'zenzero' ), '<a target="_blank" href="https://crestaproject.com/downloads/zenzero/" rel="nofollow" title="Zenzero Theme">Zenzero</a>', 'CrestaProject' ); ?>
		</div><!-- .site-info -->
		<div class="site-social smallPart">
			<?php 
				$hideRss = get_theme_mod('zenzero_theme_options_rss', '1');
				$hideSearch = get_theme_mod('zenzero_theme_options_hidesearch', '1');
				$facebookURL = get_theme_mod('zenzero_theme_options_facebookurl', '#');
				$twitterURL = get_theme_mod('zenzero_theme_options_twitterurl', '#');
				$googleplusURL = get_theme_mod('zenzero_theme_options_googleplusurl', '#');
				$linkedinURL = get_theme_mod('zenzero_theme_options_linkedinurl', '#');
				$instagramURL = get_theme_mod('zenzero_theme_options_instagramurl', '#');
				$youtubeURL = get_theme_mod('zenzero_theme_options_youtubeurl', '#');
				$pinterestURL = get_theme_mod('zenzero_theme_options_pinteresturl', '#');
				$tumblrURL = get_theme_mod('zenzero_theme_options_tumblrurl', '#');
				$vkURL = get_theme_mod('zenzero_theme_options_vkurl', '#');
			?>
				<?php if (!empty($facebookURL)) : ?>
					<a href="<?php echo esc_url($facebookURL); ?>" title="<?php esc_attr_e( 'Facebook', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-facebook"><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($twitterURL)) : ?>
					<a href="<?php echo esc_url($twitterURL); ?>" title="<?php esc_attr_e( 'Twitter', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-twitter"><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($googleplusURL)) : ?>
					<a href="<?php echo esc_url($googleplusURL); ?>" title="<?php esc_attr_e( 'Google Plus', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-google-plus"><span class="screen-reader-text"><?php esc_html_e( 'Google Plus', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($linkedinURL)) : ?>
					<a href="<?php echo esc_url($linkedinURL); ?>" title="<?php esc_attr_e( 'Linkedin', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-linkedin"><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($instagramURL)) : ?>
					<a href="<?php echo esc_url($instagramURL); ?>" title="<?php esc_attr_e( 'Instagram', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-instagram"><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($youtubeURL)) : ?>
					<a href="<?php echo esc_url($youtubeURL); ?>" title="<?php esc_attr_e( 'YouTube', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-youtube"><span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($pinterestURL)) : ?>
					<a href="<?php echo esc_url($pinterestURL); ?>" title="<?php esc_attr_e( 'Pinterest', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-pinterest"><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($tumblrURL)) : ?>
					<a href="<?php echo esc_url($tumblrURL); ?>" title="<?php esc_attr_e( 'Tumblr', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-tumblr"><span class="screen-reader-text"><?php esc_html_e( 'Tumblr', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($vkURL)) : ?>
					<a href="<?php echo esc_url($vkURL); ?>" title="<?php esc_attr_e( 'VK', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-vk"><span class="screen-reader-text"><?php esc_html_e( 'VK', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
				<?php if ($hideRss == 1 ) : ?>
					<a href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php esc_attr_e( 'RSS', 'zenzero' ); ?>"><i class="fa spaceLeftRight fa-rss"><span class="screen-reader-text"><?php esc_html_e( 'RSS', 'zenzero' ); ?></span></i></a>
				<?php endif; ?>
		</div><!-- .site-social -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php get_sidebar(); ?>
<a href="#top" id="toTop" class="showTop"><i class="fa fa-angle-up"></i></a>
<?php if ($hideSearch == 1 ) : ?>
	<div id="open-search" class="showSearch"><i class="fa fa-search"></i></div>
	<!-- Start: Search Form -->
	<div id="search-full">
		<div class="search-container">
			<form id="search-form" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
				<input id="search-field" type="text" name="s" value="" placeholder="<?php esc_attr_e('Type here and hit enter...', 'zenzero'); ?>" />
			</form>
			<span><a id="close-search"><i class="fa fa-close"></i> <?php esc_html_e('Close', 'zenzero'); ?></a></span>
		</div>
	</div>
	<!-- End: Search Form -->
<?php endif; ?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="open-sidebar" class="showSide"><span class="sidebarButton"></span></div>
<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>
