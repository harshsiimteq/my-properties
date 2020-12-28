<?php
/**
 * Plugin Name: Property Listings
 * Description: Simple elegent & minimal proterty listing that made with love.
 * Plugin URI: https://shahnotes.github.io
 * Author: Harsh Shah
 * Author URI: https://shahnotes.github.io
 * Version: 1.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: property-list
 */

defined( 'ABSPATH' ) || exit;

define('PROPERTY_LISTING_VERSION', '1.0.0');
define('PROPERTY_LISTING_ABS_PATH',plugin_dir_path(__FILE__));
define('PROPERTY_LISTING_ABS_URL',plugin_dir_url(__FILE__));

require_once plugin_dir_path( __FILE__ ) . 'functions.php';

function activate_property_listing() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-property-listing-activator.php';
	PropertyListingActivator::activate();
}

function deactivate_property_listing() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-property-listing-deactivator.php';
	PropertyListingDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_property_listing' );

register_deactivation_hook( __FILE__, 'deactivate_property_listing' );

function run_property_listing() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-property-listing.php';
	$plugin = new PropertyListing();
	$plugin->run();
}

run_property_listing();
