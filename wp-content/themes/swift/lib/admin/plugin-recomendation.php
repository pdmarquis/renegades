<?php
add_action( 'tgmpa_register', 'swift_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function swift_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'inSite for WP: Personalization Made Easy', // The plugin name
			'slug'     => 'insite-for-wp-personalization-made-easy', // The plugin slug (typically the folder name)
			'required' => false
		)
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'swift';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */

	$config = array(
		'domain'           => $theme_text_domain, // Text domain - likely want to be the same as your theme.
		'default_path'     => '', // Default absolute path to pre-packaged plugins
		'parent_slug' => 'themes.php', // Default parent menu slug
		'menu'             => 'install-swift-addons', // Menu slug
		'has_notices'      => true, // Show admin notices or not
		'is_automatic'     => true, // Automatically activate plugins after installation or not
		'message'          => '', // Message to output right before the plugins table
		'strings'          => array(
			'page_title'                      => __( 'Swift Add Features', 'swift' ),
			'menu_title'                      => __( 'Activate Add Ons', 'swift' ),
			'installing'                      => __( 'Installing Plugin: %s', 'swift' ), // %1$s = plugin name
			'oops'                            => __( 'Something went wrong with the plugin API.', 'swift' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'swift' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'swift' ), // %1$s = plugin name(s)
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'swift' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'swift' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'swift' ), // %1$s = plugin name(s)
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'swift' ), // %1$s = plugin name(s)
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'swift' ), // %1$s = plugin name(s)
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'swift' ), // %1$s = plugin name(s)
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'swift' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'swift' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'swift' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'swift' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'swift' ) // %1$s = dashboard link
		)
	);

	global $pagenow;
	// Add plugin notification only if the current user is admin and on theme.php
	if ( current_user_can( 'manage_options' ) && 'themes.php' == $pagenow ) {
		tgmpa( $plugins, $config );
	}
}
