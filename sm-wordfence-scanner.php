<?php
 /*
 Plugin Name:	SM Wordfence Scanner
 Plugin URI:	https://github.com/sgmurphy/sm-wordfence-scanner
 Description:	Scan your website for security vulnerabilities.
 Version:		1.0.0
 Author:		Sean Murphy
 Author URI:	http://iamseanmurphy.com/
 */

// If this file is accessed directly, abort.
defined( 'ABSPATH' ) OR exit;

/**
 * Require the core plugin class
 */
require_once( plugin_dir_path( __FILE__ ) . 'class-sm-wordfence-scanner.php' );

// Activation/deactivation/uninstall hooks cannot be registered from inside other hooks
register_activation_hook( __FILE__, array( 'SM_Wordfence_Scanner', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'SM_Wordfence_Scanner', 'deactivate' ) );
register_uninstall_hook( __FILE__, array( 'SM_Wordfence_Scanner', 'uninstall' ) );

// Run plugin code once WP admin has been initialized
add_action( 'admin_init', array( 'SM_Wordfence_Scanner', 'init' ) );