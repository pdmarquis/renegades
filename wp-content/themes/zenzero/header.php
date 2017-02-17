<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package zenzero
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div>
		
		<?php $zenzero_theme_options_socialheader = get_theme_mod('zenzero_theme_options_socialheader', '');  
		if ($zenzero_theme_options_socialheader == 1) : ?>
		<div class="site-social smallPart">
			<?php 
				$hideRss = get_theme_mod('zenzero_theme_options_rss', '1');
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
		</div>
		<?php endif; ?>

		<nav id="site-navigation" class="main-navigation smallPart" role="navigation">
			<button class="menu-toggle"><?php esc_html_e( 'Main Menu', 'zenzero' ); ?><i class="fa fa-align-justify"></i></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
