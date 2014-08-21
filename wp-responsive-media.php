<?php
/*
 * Plugin Name: WP Responsive Media
 * Version: 1.0.5
 * Plugin URI: http://www.randyjensen.com/
 * Description: Seamless responsive media for WordPress
 * Author: Randy Jensen
 * Author URI: http://www.randyjensen.com/
 * Requires at least: 3.9
 * Tested up to: 3.9.1
 *
 * @package WordPress
 * @author Randy Jensen
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-wp-responsive-media.php' );

// Load plugin libraries
require_once( 'includes/lib/class-wp-responsive-media-admin-main.php' );

/**
 * Returns the main instance of WP_Responsive_Media to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WP_Responsive_Media
 */
function WP_Responsive_Media () {
	$instance = WP_Responsive_Media::instance( __FILE__, '1.0.5' );

	return $instance;
}

WP_Responsive_Media();
