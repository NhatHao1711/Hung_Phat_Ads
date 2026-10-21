<?php
/**
 * Header template for HungPhat WebService
 */
if (!defined('ABSPATH')) {
    exit;
}

$brand_name      = hungphat_opt('brand_name', 'Hưng Phát Ads');
$brand_slogan    = hungphat_opt('brand_slogan', 'Đồng hành cùng phát triển');
$hotline         = hungphat_opt('hotline', '0902 172 192');
$clean_hotline   = preg_replace('/[^0-9]/', '', $hotline);
$site_logo       = hungphat_opt('site_logo', '');
$site_favicon    = hungphat_opt('site_favicon', '');
$header_cta_text = hungphat_opt('header_cta_text', 'Nhận Báo Giá');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr($brand_name . ' - ' . $brand_slogan . '. Thiết kế website chuẩn SEO, sở hữu trọn đời. Đối tác Google Premier Partner 2026 & Meta Business Partner.'); ?>">
    <?php if (!empty($site_favicon)): ?>
        <link rel="icon" type="image/x-icon" href="<?php echo esc_url($site_favicon); ?>">
        <link rel="apple-touch-icon" href="<?php echo esc_url($site_favicon); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- HEADER NAVIGATION -->
<header id="main-header" class="site-header">
    <div class="container header-container">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" id="header-brand-logo">
            <?php if (!empty($site_logo)): ?>
                <img src="<?php echo esc_url($site_logo); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="site-header-logo-img" style="max-height: 48px; width: auto; object-fit: contain;">
            <?php else: ?>
                <div class="logo-text-box">
                    <span class="logo-title">Hưng Phát Ads</span>
                    <span class="logo-subtitle"><?php echo esc_html($brand_slogan); ?></span>
                </div>
            <?php endif; ?>
        </a>

        <!-- Desktop Nav -->
        <nav class="desktop-navigation" aria-label="Main Navigation">
            <ul class="nav-links">
                <li><a href="#gioi-thieu" class="nav-link">Giới Thiệu</a></li>
                <li><a href="#dich-vu" class="nav-link">Dịch Vụ</a></li>
                <li><a href="#bang-gia" class="nav-link">Bảng Giá</a></li>
                <li><a href="#du-an" class="nav-link">Dự Án Mẫu</a></li>
                <li><a href="#quy-trinh" class="nav-link">Quy Trình</a></li>
                <li><a href="#lien-he" class="nav-link">Liên Hệ</a></li>
            </ul>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <a href="tel:<?php echo esc_attr($clean_hotline); ?>" class="hotline-btn" id="header-hotline-btn">
                <div class="hotline-text">
                    <span class="hotline-label">Hotline 24/7</span>
                    <span class="hotline-number"><?php echo esc_html($hotline); ?></span>
                </div>
            </a>
            <a href="#tu-van" class="btn btn-primary btn-cta" id="header-cta-btn">
                <span><?php echo esc_html($header_cta_text); ?></span>
            </a>

            <!-- Mobile Hamburger Toggle -->
            <button class="mobile-toggle-btn" id="mobile-menu-toggle" aria-label="Mở menu điện thoại">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-menu-drawer" id="mobile-menu">
        <ul class="mobile-nav-links">
            <li><a href="#gioi-thieu" class="mobile-nav-link">Giới Thiệu</a></li>
            <li><a href="#dich-vu" class="mobile-nav-link">Dịch Vụ</a></li>
            <li><a href="#bang-gia" class="mobile-nav-link">Bảng Giá</a></li>
            <li><a href="#du-an" class="mobile-nav-link">Dự Án Mẫu</a></li>
            <li><a href="#quy-trinh" class="mobile-nav-link">Quy Trình</a></li>
            <li><a href="#lien-he" class="mobile-nav-link">Liên Hệ</a></li>
            <li class="mobile-cta-item">
                <a href="#tu-van" class="btn btn-primary btn-block">Đăng Ký Tư Vấn Ngay</a>
            </li>
        </ul>
    </div>
</header>
