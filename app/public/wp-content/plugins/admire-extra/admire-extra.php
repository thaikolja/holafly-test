<?php
/*
 * Plugin Name: Admire Extra
 * Description: Admire extra is a Elementor as well as Gutenberg template library where you can choose from available designs and use them with any WordPress theme from the repository or elsewhere. These templates are fully editable using Elementor or Gutenberg block editor. They are full fledged wesbites where you get all pages including homepage and inner pages. All of the templates are being imported from our test server at Admire Themes. You can create a wide range of business websites like hotels, lodging, spa, salon, construction, personal, blog, fitness, medical, health, charity, pet, maintenance services etc.
 * Version: 1.5
 * Author: SKT Themes
 * Author URI: https://www.sktthemes.org/
 * License: GPL-2.0+
 */
// Exit if accessed directly.

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('add_action')) {
    die('Nothing to do...');
}

$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
$plugin_version = $plugin_data['Version'];
// Define WC_PLUGIN_FILE.
if (!defined('ADMIRE_EXTRA_CURRENT_VERSION')) {
    define('ADMIRE_EXTRA_CURRENT_VERSION', $plugin_version);
}

//plugin constants
define('ADMIRE_EXTRA_PATH', plugin_dir_path(__FILE__));
define('ADMIRE_EXTRA_PLUGIN_BASE', plugin_basename(__FILE__));
define('ADMIRE_EXTRA_PLUGIN_URL', plugins_url('/', __FILE__));

add_action('plugins_loaded', 'admire_extra_load_textdomain');

function admire_extra_load_textdomain() {
    load_plugin_textdomain('admire-extra', false, basename(dirname(__FILE__)) . '/languages/');
}

/**
 * Style Loading Import Demo Templates
 *
 * @since   1.0
 */

function admire_extra_template_styles() {
	wp_enqueue_style( 'admire-extra-styling', plugin_dir_url( __FILE__ ) . 'lib/demo/assets/css/importdemo.css' );	
}

add_action( 'wp_enqueue_scripts', 'admire_extra_template_styles' );

/**
 * Enqueue script for custom customize control.
 */
function admire_extra_customize_enqueue() {
    wp_enqueue_style('admire-extra-customizer', plugin_dir_url(__FILE__) . 'css/admin/customizer.css', array(), ADMIRE_EXTRA_CURRENT_VERSION);
    wp_enqueue_style('font-awesome-css', plugin_dir_url(__FILE__) . 'include/assets/vendor/fontawesome/css/font-awesome.min.css', array(), '4.7.0');
}

add_action('customize_controls_print_footer_scripts', 'admire_extra_customize_enqueue', 10);

if(!function_exists('wp_get_current_user')) { include(ABSPATH . "wp-includes/pluggable.php"); }

require_once( plugin_dir_path(__FILE__) . 'lib/shortcodes/shortcodes.php' );
include_once( plugin_dir_path(__FILE__) . 'lib/demo/admire-demos.php' );
include_once( plugin_dir_path(__FILE__) . 'lib/admin/dashboard.php' );
include_once( plugin_dir_path(__FILE__) . 'lib/admin/redirect.php' );

add_action('customize_register', 'admire_extra_theme_customize_register', 99);

function admire_extra_theme_customize_register($wp_customize) {

    $wp_customize->remove_control('header_textcolor');
    $wp_customize->remove_section('admire_page_view_pro');
}

register_activation_hook(__FILE__, 'admire_extra_plugin_activate');
add_action('admin_init', 'admire_extra_plugin_redirect');

function admire_extra_plugin_activate() {
    add_option('admr_xtra_plugin_do_activation_redirect', true);
}

/**
 * Redirect after plugin activation
 */
function admire_extra_plugin_redirect() {
    if (get_option('admr_xtra_plugin_do_activation_redirect', false)) {
        delete_option('admr_xtra_plugin_do_activation_redirect');
        if (!is_network_admin() || !isset($_GET['activate-multi'])) {
            wp_redirect('themes.php?page=admire-panel-install-demos');
        }
    }
}

/**
 * Check Elementor plugin
 */
function admire_extra_check_for_elementor() {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    return is_plugin_active('elementor/elementor.php');
}

/**
 * Check Elementor PRO plugin
 */
function admire_extra_check_for_elementor_pro() {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    return is_plugin_active('elementor-pro/elementor-pro.php');
}

remove_filter( 'wp_import_post_meta', 'Elementor\Compatibility::on_wp_import_post_meta');
remove_filter( 'wxr_importer.pre_process.post_meta', 'Elementor\Compatibility::on_wxr_importer_pre_process_post_meta');
