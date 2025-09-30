<?php
/**
 * Plugin Name: WooCommerce Treatment Options
 * Description: Adds custom treatment options to WooCommerce products.
 * Version: 1.0.3
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

// Enqueue admin styles and scripts
function wto_enqueue_admin_assets() {
    wp_enqueue_style( 'wto-admin-css', WTO_PLUGIN_URL . 'assets/css/admin.css' );
    wp_enqueue_script( 'wto-admin-js', WTO_PLUGIN_URL . 'assets/js/admin.js', array( 'jquery' ), null, true );
}
// add_action( 'admin_enqueue_scripts', 'wto_enqueue_admin_assets' );

// Enqueue frontend styles and scripts
function wto_enqueue_frontend_assets() {
    wp_enqueue_style( 'wto-frontend-css', WTO_PLUGIN_URL . 'assets/css/frontend.css' );
    wp_enqueue_script( 'wto-frontend-js', WTO_PLUGIN_URL . 'assets/js/frontend.js', array( 'jquery' ), null, true );
}
// add_action( 'wp_enqueue_scripts', 'wto_enqueue_frontend_assets' );
?>