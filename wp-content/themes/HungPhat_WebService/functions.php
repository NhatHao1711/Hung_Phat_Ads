<?php
/**
 * HungPhat WebService Theme Functions and Definitions
 */

if (!defined('ABSPATH')) {
    exit;
}

define('HUNGPHAT_THEME_VERSION', '1.0.0');
define('HUNGPHAT_THEME_DIR', get_template_directory());
define('HUNGPHAT_THEME_URI', get_template_directory_uri());

// Include Modules
require_once HUNGPHAT_THEME_DIR . '/inc/database.php';
require_once HUNGPHAT_THEME_DIR . '/inc/leads-manager.php';
require_once HUNGPHAT_THEME_DIR . '/inc/admin-settings.php';
require_once HUNGPHAT_THEME_DIR . '/inc/ajax-handlers.php';

// Setup Theme
add_action('after_setup_theme', 'hungphat_theme_setup');
function hungphat_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);

    // Register Nav Menus
    register_nav_menus([
        'primary-menu' => 'Menu Chính (Header)',
        'footer-menu'  => 'Menu Chân Trang (Footer)'
    ]);

    // Ensure Vietnam Timezone (Asia/Ho_Chi_Minh, GMT+7)
    if (get_option('timezone_string') !== 'Asia/Ho_Chi_Minh') {
        update_option('timezone_string', 'Asia/Ho_Chi_Minh');
        update_option('gmt_offset', 7);
    }
}

// Enqueue Styles & Scripts
add_action('wp_enqueue_scripts', 'hungphat_enqueue_assets');
function hungphat_enqueue_assets() {
    // Google Fonts (Full Vietnamese Support: Montserrat & Inter)
    wp_enqueue_style(
        'hungphat-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap',
        [],
        null
    );

    // Font Awesome 6 Icons (CDN for rich icons)
    wp_enqueue_style(
        'hungphat-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        [],
        '6.4.0'
    );

    // Main Theme CSS
    wp_enqueue_style(
        'hungphat-main-style',
        HUNGPHAT_THEME_URI . '/assets/css/main.css',
        ['hungphat-google-fonts', 'hungphat-fontawesome'],
        HUNGPHAT_THEME_VERSION
    );

    // Main Theme JS
    wp_enqueue_script(
        'hungphat-main-script',
        HUNGPHAT_THEME_URI . '/assets/js/main.js',
        [],
        HUNGPHAT_THEME_VERSION,
        true
    );

    // Localize Script for AJAX
    wp_localize_script('hungphat-main-script', 'hungphat_vars', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('hungphat_lead_nonce')
    ]);
}

// Clean up WP head unnecessary tags for high performance & clean HTML
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
