<?php
/**
 * Main template file fallback
 */

if (!defined('ABSPATH')) {
    exit;
}

// Render the front page landing page as main content
include get_template_directory() . '/front-page.php';
