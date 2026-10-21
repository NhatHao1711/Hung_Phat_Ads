<?php
/**
 * The base configuration for WordPress
 *
 * @package WordPress
 */

// ** Database settings ** //
define( 'DB_NAME', 'hungphat_ads' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 */
define( 'AUTH_KEY',         'x%g9!Vn#7Q@zLp$2kM&8wE*4rT^1yU~0aB+5cD?6eF<3gH>9' );
define( 'SECURE_AUTH_KEY',  'K#8vN!2mP$9qW%4eR^7tY&1uI*5oO~3aS+6dF?8gH<0jK>4' );
define( 'LOGGED_IN_KEY',    'L&3wE*9rT^1yU~5aB+7cD?0eF<2gH>8jK#4vN!6mP$8qW%2' );
define( 'NONCE_KEY',        'Z~5aB+9cD?1eF<4gH>7jK#0vN!3mP$6qW%8eR^2tY&4uI*7' );
define( 'AUTH_SALT',        'P$2kM&7wE*0rT^4yU~8aB+1cD?5eF<9gH>3jK#6vN!8mP$1' );
define( 'SECURE_AUTH_SALT', 'Q%4eR^8tY&2uI*6oO~0aS+4dF?7gH<1jK>5vN#9mP!3qW$6' );
define( 'LOGGED_IN_SALT',   'R^7tY&1uI*5oO~9aS+3dF?6gH<0jK>4vN#8mP!2qW$5eR%8' );
define( 'NONCE_SALT',       'T*0oO~4aS+8dF?2gH<6jK>9vN#3mP!7qW$1eR%5tY^9uI&3' );
/**#@-*/

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );
// Hỗ trợ SSL Termination từ Cloudflare / Reverse Proxy để tránh vòng lặp chuyển hướng (Too many redirects)
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
    $_SERVER['HTTPS'] = 'on';
}

// Cấu hình URL động (Hỗ trợ truy cập cả localhost và link tạm thời Cloudflare Tunnel từ xa)
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
    $protocol = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ) ? 'https://' : 'http://';
    define( 'WP_SITEURL', $protocol . $_SERVER['HTTP_HOST'] . '/Hung_Phat_Ads' );
    define( 'WP_HOME',    $protocol . $_SERVER['HTTP_HOST'] . '/Hung_Phat_Ads' );
} else {
    define( 'WP_SITEURL', 'http://localhost/Hung_Phat_Ads' );
    define( 'WP_HOME',    'http://localhost/Hung_Phat_Ads' );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
