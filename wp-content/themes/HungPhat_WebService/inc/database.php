<?php
/**
 * Database setup for HungPhat WebService
 */

if (!defined('ABSPATH')) {
    exit;
}

function hungphat_init_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hungphat_consultations';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        fullname varchar(255) NOT NULL,
        phone varchar(50) NOT NULL,
        email varchar(255) DEFAULT '',
        service varchar(255) DEFAULT '',
        budget varchar(100) DEFAULT '',
        notes text DEFAULT '',
        status varchar(50) DEFAULT 'new',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Hook to ensure table exists
add_action('after_setup_theme', 'hungphat_init_database');
