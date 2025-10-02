<?php
/**
 * Plugin Name: WooCommerce Treatment Options
 * Description: Adds custom treatment options to WooCommerce products.
 * Version: 1.0.5
 * Author: Tarek Nabil
 * Text Domain: woocommerce-treatment-options
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'WTO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WTO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files
require_once WTO_PLUGIN_DIR . 'includes/class-helper.php';
require_once WTO_PLUGIN_DIR . 'includes/class-admin.php';
require_once WTO_PLUGIN_DIR . 'includes/class-frontend.php';
require_once WTO_PLUGIN_DIR . 'includes/class-shortcode.php';

// Initialize the plugin
function wto_init() {
    new Treatment_Options_Helper();
    new WooCommerce_Treatment_Options_Admin();
    new Frontend();
    new Treatment_Options_Shortcode();
}
add_action( 'plugins_loaded', 'wto_init' );
?>