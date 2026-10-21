<?php
/**
 * Landing Page Content & Media Settings in WordPress Admin
 * Theme: HungPhat WebService
 */

if (!defined('ABSPATH')) {
    exit;
}

// Helper to get theme option with fallback
function hungphat_opt($key, $default = '') {
    $options = get_option('hungphat_theme_options', []);
    return isset($options[$key]) && $options[$key] !== '' ? $options[$key] : $default;
}

// Register Settings Menu
add_action('admin_menu', 'hungphat_register_settings_menu');
function hungphat_register_settings_menu() {
    $hook = add_menu_page(
        'Cài Đặt Landing Page',
        'Cài Đặt Landing Page',
        'manage_options',
        'hungphat-settings',
        'hungphat_render_settings_page',
        'dashicons-admin-customizer',
        26
    );

    // Enqueue Media scripts for this page only
    add_action('admin_print_scripts-' . $hook, 'hungphat_admin_enqueue_media');
}

function hungphat_admin_enqueue_media() {
    wp_enqueue_media();
}

// Handle Settings Save
add_action('admin_init', 'hungphat_handle_settings_save');
function hungphat_handle_settings_save() {
    if (isset($_POST['hungphat_save_settings']) && check_admin_referer('hungphat_settings_verify')) {
        if (!current_user_can('manage_options')) {
            wp_die('Bạn không có quyền chỉnh sửa cài đặt.');
        }

        $input = isset($_POST['hungphat']) ? (array) $_POST['hungphat'] : [];
        $existing = get_option('hungphat_theme_options', []);
        if (!is_array($existing)) {
            $existing = [];
        }

        $sanitized = $existing;

        foreach ($input as $k => $v) {
            if (is_array($v)) {
                $sanitized[$k] = array_map('sanitize_text_field', $v);
            } else {
                $sanitized[$k] = wp_kses_post(wp_unslash($v));
            }
        }

        update_option('hungphat_theme_options', $sanitized);
        $tab = isset($_POST['active_tab_saved']) ? sanitize_text_field($_POST['active_tab_saved']) : 'general';
        wp_redirect(add_query_arg(['page' => 'hungphat-settings', 'tab' => $tab, 'updated' => 'true'], admin_url('admin.php')));
        exit;
    }
}

// Helper to render Image Upload Field with Preview and WP Media Uploader
function hungphat_image_field($name, $label, $description = '', $default = '') {
    $val = hungphat_opt($name, $default);
    ?>
    <div class="hungphat-media-uploader" data-target="<?php echo esc_attr($name); ?>" style="margin-bottom: 15px;">
        <label for="<?php echo esc_attr($name); ?>" style="font-weight: 600; display: block; margin-bottom: 6px; color: #1e293b;">
            <?php echo esc_html($label); ?>
        </label>
        
        <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 8px;">
            <input type="text" 
                   name="hungphat[<?php echo esc_attr($name); ?>]" 
                   id="<?php echo esc_attr($name); ?>" 
                   value="<?php echo esc_attr($val); ?>" 
                   class="regular-text hungphat-img-input" 
                   placeholder="https://... hoặc chọn ảnh tải lên"
                   style="flex: 1; max-width: 500px;">
            <button type="button" class="button button-secondary hungphat-upload-btn" data-input-id="<?php echo esc_attr($name); ?>">
                <span>Chọn Ảnh / Tải Lên</span>
            </button>
            <button type="button" class="button hungphat-remove-btn" data-input-id="<?php echo esc_attr($name); ?>" style="<?php echo empty($val) ? 'display:none;' : ''; ?> color: #b91c1c;">
                <span>Xóa Ảnh</span>
            </button>
        </div>

        <div class="hungphat-img-preview-box" id="preview-<?php echo esc_attr($name); ?>" style="width: 140px; height: 90px; border: 2px dashed #cbd5e1; border-radius: 6px; display: flex; align-items: center; justify-content: center; background: #f8fafc; overflow: hidden; position: relative;">
            <?php if (!empty($val)): ?>
                <img src="<?php echo esc_url($val); ?>" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            <?php else: ?>
                <span style="color: #94a3b8; font-size: 12px; text-align: center; padding: 5px;">Chưa chọn ảnh</span>
            <?php endif; ?>
        </div>

        <?php if (!empty($description)): ?>
            <p class="description" style="margin-top: 5px; color: #64748b; font-size: 13px;"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

// Render Settings Page
function hungphat_render_settings_page() {
    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
    ?>
    <!-- Global CSS Fix For Centered Dashicons & Modern Buttons -->
    <style>
    .hungphat-admin-wrap {
        max-width: 1150px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif;
    }
    /* Button Pill Red (Perfect Center Flex for Icon & Text) */
    .hungphat-admin-wrap .button-pill-red {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: #ed1c24 !important;
        border: 1px solid #ed1c24 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        border-radius: 9999px !important;
        text-shadow: none !important;
        line-height: 1 !important;
        height: auto !important;
        box-shadow: 0 4px 14px rgba(237, 28, 36, 0.3) !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        cursor: pointer !important;
        box-sizing: border-box !important;
    }
    .hungphat-admin-wrap .button-pill-red:hover,
    .hungphat-admin-wrap .button-pill-red:focus {
        background: #c41219 !important;
        border-color: #c41219 !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 18px rgba(237, 28, 36, 0.4) !important;
    }
    .hungphat-admin-wrap .button-pill-red:active {
        transform: translateY(1px) !important;
    }
    .hungphat-admin-wrap .button-pill-red .dashicons {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 18px !important;
        height: 18px !important;
        font-size: 18px !important;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
        vertical-align: middle !important;
        position: static !important;
    }
    /* Fix Nav Tabs */
    .hungphat-admin-wrap .nav-tab {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        line-height: 24px !important;
    }
    .hungphat-admin-wrap .nav-tab .dashicons {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 17px !important;
        width: 17px !important;
        height: 17px !important;
        line-height: 1 !important;
        margin: 0 !important;
        vertical-align: middle !important;
    }
    /* Fix Upload / Remove Buttons */
    .hungphat-admin-wrap .hungphat-upload-btn,
    .hungphat-admin-wrap .hungphat-remove-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        line-height: 1 !important;
        height: 32px !important;
        padding: 0 14px !important;
    }
    .hungphat-admin-wrap .hungphat-upload-btn .dashicons,
    .hungphat-admin-wrap .hungphat-remove-btn .dashicons {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 16px !important;
        width: 16px !important;
        height: 16px !important;
        line-height: 1 !important;
        margin: 0 !important;
    }
    </style>

    <div class="wrap hungphat-admin-wrap">
        <!-- Top Header Banner -->
        <div style="background: #0d0c22; color: #fff; padding: 22px 30px; border-radius: 10px; margin-bottom: 22px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
            <div>
                <h1 style="color: #fff; margin: 0; font-size: 24px; font-weight: 700;">
                    Cài Đặt Nội Dung & Hình Ảnh – Hưng Phát Ads
                </h1>
                <p style="color: #94a3b8; margin: 6px 0 0; font-size: 14px;">Quản lý tập trung toàn bộ văn bản, hình ảnh, bảng giá, dự án của Landing Page.</p>
            </div>
            <div>
                <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="button-pill-red" style="padding: 10px 24px; font-size: 14px;">
                    Xem Website Thực Tế
                </a>
            </div>
        </div>

        <?php if (isset($_GET['updated']) && $_GET['updated'] === 'true'): ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #10b981; padding: 12px 20px;">
                <p style="font-size: 14px; color: #065f46; margin: 0;"><strong>Thành công!</strong> Đã lưu thay đổi nội dung & hình ảnh của Landing Page thành công.</p>
            </div>
        <?php endif; ?>

        <!-- Nav Tabs -->
        <h2 class="nav-tab-wrapper" style="margin-bottom: 20px; border-bottom: 2px solid #cbd5e1;">
            <a href="?page=hungphat-settings&tab=general" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>">
                Thông Tin Chung & Logo
            </a>
            <a href="?page=hungphat-settings&tab=hero" class="nav-tab <?php echo $active_tab === 'hero' ? 'nav-tab-active' : ''; ?>">
                Hero Banner & Ảnh
            </a>
            <a href="?page=hungphat-settings&tab=about" class="nav-tab <?php echo $active_tab === 'about' ? 'nav-tab-active' : ''; ?>">
                Giới Thiệu & Điểm Mạnh
            </a>
            <a href="?page=hungphat-settings&tab=services" class="nav-tab <?php echo $active_tab === 'services' ? 'nav-tab-active' : ''; ?>">
                6 Thẻ Dịch Vụ
            </a>
            <a href="?page=hungphat-settings&tab=pricing" class="nav-tab <?php echo $active_tab === 'pricing' ? 'nav-tab-active' : ''; ?>">
                Bảng Giá Chi Tiết
            </a>
            <a href="?page=hungphat-settings&tab=portfolio" class="nav-tab <?php echo $active_tab === 'portfolio' ? 'nav-tab-active' : ''; ?>">
                Dự Án Mẫu & Ảnh Screenshot
            </a>
            <a href="?page=hungphat-settings&tab=process" class="nav-tab <?php echo $active_tab === 'process' ? 'nav-tab-active' : ''; ?>">
                Quy Trình 6 Bước
            </a>
            <a href="?page=hungphat-settings&tab=contact" class="nav-tab <?php echo $active_tab === 'contact' ? 'nav-tab-active' : ''; ?>">
                Liên Hệ, Form & QR
            </a>
        </h2>

        <form method="post" action="" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
            <?php wp_nonce_field('hungphat_settings_verify'); ?>
            <input type="hidden" name="hungphat_save_settings" value="1">
            <input type="hidden" name="active_tab_saved" value="<?php echo esc_attr($active_tab); ?>">

            <!-- ================= TAB: GENERAL & LOGOS ================= -->
            <?php if ($active_tab === 'general'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    1. Quản Lý Hình Ảnh Nhận Diện Thương Hiệu (Logo & Favicon)
                </h3>
                
                <table class="form-table" style="margin-bottom: 25px;">
                    <tr>
                        <th scope="row"><label>Logo Chính (Header)</label></th>
                        <td>
                            <?php hungphat_image_field('site_logo', 'Tải lên Logo Website (Header)', 'Logo hiển thị trên thanh điều hướng đầu trang. Định dạng gợi ý: PNG hoặc SVG nền trong suốt (kích thước tối ưu: 220x60px). Nếu để trống, hệ thống dùng Icon + Tên chữ mặc định.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Logo Chân Trang (Footer)</label></th>
                        <td>
                            <?php hungphat_image_field('footer_logo', 'Tải lên Logo Footer (Chân trang)', 'Hiển thị ở cột thông tin công ty dưới chân trang. Nếu để trống sẽ dùng Logo Chính.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Icon Trình Duyệt (Favicon)</label></th>
                        <td>
                            <?php hungphat_image_field('site_favicon', 'Tải lên Favicon (32x32px hoặc 64x64px)', 'Biểu tượng nhỏ hiển thị trên tab trình duyệt của khách hàng.'); ?>
                        </td>
                    </tr>
                </table>

                <h3 style="border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 20px; color: #0d0c22; font-size: 18px;">
                    2. Thông Tin Pháp Nhân & Kênh Liên Hệ Hưng Phát Ads
                </h3>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="brand_name">Tên thương hiệu</label></th>
                        <td>
                            <input name="hungphat[brand_name]" type="text" id="brand_name" value="<?php echo esc_attr(hungphat_opt('brand_name', 'Hưng Phát Ads - Đồng Hành Cùng Phát Triển')); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="company_legal_name">Tên pháp nhân công ty</label></th>
                        <td>
                            <input name="hungphat[company_legal_name]" type="text" id="company_legal_name" value="<?php echo esc_attr(hungphat_opt('company_legal_name', 'CÔNG TY TNHH PHÁT TRIỂN DỊCH VỤ CÔNG NGHỆ HƯNG PHÁT')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="company_mst">Mã số thuế (MST)</label></th>
                        <td>
                            <input name="hungphat[company_mst]" type="text" id="company_mst" value="<?php echo esc_attr(hungphat_opt('company_mst', '0313666158')); ?>" class="regular-text">
                            <p class="description">Do Sở KH&ĐT TP.HCM cấp ngày 29/02/2016.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="brand_slogan">Slogan thương hiệu</label></th>
                        <td>
                            <input name="hungphat[brand_slogan]" type="text" id="brand_slogan" value="<?php echo esc_attr(hungphat_opt('brand_slogan', 'Quảng Cáo Google Hiệu Quả & Thiết Kế Website Chuyên Nghiệp')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hotline">Hotline tư vấn (24/7)</label></th>
                        <td>
                            <input name="hungphat[hotline]" type="text" id="hotline" value="<?php echo esc_attr(hungphat_opt('hotline', '0902 172 192')); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="phone_landline">Điện thoại bàn</label></th>
                        <td>
                            <input name="hungphat[phone_landline]" type="text" id="phone_landline" value="<?php echo esc_attr(hungphat_opt('phone_landline', '028 2239 9992')); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="zalo_number">Số Zalo liên hệ</label></th>
                        <td>
                            <input name="hungphat[zalo_number]" type="text" id="zalo_number" value="<?php echo esc_attr(hungphat_opt('zalo_number', '0902172192')); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="contact_email">Email tiếp nhận dự án</label></th>
                        <td>
                            <input name="hungphat[contact_email]" type="email" id="contact_email" value="<?php echo esc_attr(hungphat_opt('contact_email', 'sales@hungphatads.com')); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="company_address">Văn phòng giao dịch (VPGD)</label></th>
                        <td>
                            <input name="hungphat[company_address]" type="text" id="company_address" value="<?php echo esc_attr(hungphat_opt('company_address', '236 Nguyễn Xí, Phường Bình Lợi Trung, TP. Hồ Chí Minh')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="company_hq_address">Trụ sở chính công ty</label></th>
                        <td>
                            <input name="hungphat[company_hq_address]" type="text" id="company_hq_address" value="<?php echo esc_attr(hungphat_opt('company_hq_address', '127 – 129 Hoàng Văn Thụ, Phường 8, Quận Phú Nhuận, TP. Hồ Chí Minh')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="working_hours">Giờ làm việc</label></th>
                        <td>
                            <input name="hungphat[working_hours]" type="text" id="working_hours" value="<?php echo esc_attr(hungphat_opt('working_hours', 'Thứ 2 - Thứ 6: 08:00 - 17:00 | Thứ 7: 08:00 - 11:30 (Hotline hỗ trợ 24/7)')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="header_cta_text">Chữ trên nút CTA Header</label></th>
                        <td>
                            <input name="hungphat[header_cta_text]" type="text" id="header_cta_text" value="<?php echo esc_attr(hungphat_opt('header_cta_text', 'Nhận Báo Giá')); ?>" class="regular-text">
                        </td>
                    </tr>
                </table>

            <!-- ================= TAB: HERO & STATS ================= -->
            <?php elseif ($active_tab === 'hero'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    Cấu Hình Banner Chính (Hero Section) & Ảnh Minh Họa
                </h3>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="hero_badge">Huy hiệu Hero</label></th>
                        <td>
                            <input name="hungphat[hero_badge]" type="text" id="hero_badge" value="<?php echo esc_attr(hungphat_opt('hero_badge', '🏆 GOOGLE PREMIER PARTNER 2026 & META BUSINESS PARTNER')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_title">Tiêu đề chính (H1)</label></th>
                        <td>
                            <textarea name="hungphat[hero_title]" id="hero_title" rows="2" class="large-text"><?php echo esc_textarea(hungphat_opt('hero_title', 'Thiết Kế Web 1 Lần Sở Hữu Trọn Đời – Bứt Phá Doanh Số Cùng Hưng Phát Ads')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_subtitle">Đoạn giới thiệu ngắn</label></th>
                        <td>
                            <textarea name="hungphat[hero_subtitle]" id="hero_subtitle" rows="3" class="large-text"><?php echo esc_textarea(hungphat_opt('hero_subtitle', 'Dù bạn đang kinh doanh bất cứ lĩnh vực nào, Hưng Phát Ads giúp bạn xây dựng website độc quyền theo yêu cầu, giao diện Responsive hiển thị đẹp trên mọi thiết bị, tốc độ đạt chuẩn Google và tối ưu tỷ lệ chuyển đổi đơn hàng vượt trội.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Ảnh Minh Họa / Mockup Hero</label></th>
                        <td>
                            <?php hungphat_image_field('hero_image', 'Ảnh Minh Họa Hero Banner', 'Tải lên hình ảnh banner đồ họa, phối cảnh laptop/mobile hoặc giao diện mẫu (kích thước tối ưu 800x600px). Nếu để trống, hệ thống sẽ hiển thị giao diện trình duyệt công nghệ cao mặc định.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_cta_text">Nút CTA chính</label></th>
                        <td>
                            <input name="hungphat[hero_cta_text]" type="text" id="hero_cta_text" value="<?php echo esc_attr(hungphat_opt('hero_cta_text', 'Bắt Đầu Ngay')); ?>" class="regular-text">
                            <span style="margin: 0 10px;">Link:</span>
                            <input name="hungphat[hero_cta_link]" type="text" id="hero_cta_link" value="<?php echo esc_attr(hungphat_opt('hero_cta_link', '#tu-van')); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_secondary_cta">Nút phụ</label></th>
                        <td>
                            <input name="hungphat[hero_secondary_cta]" type="text" id="hero_secondary_cta" value="<?php echo esc_attr(hungphat_opt('hero_secondary_cta', 'Xem Mẫu Giao Diện')); ?>" class="regular-text">
                            <span style="margin: 0 10px;">Link:</span>
                            <input name="hungphat[hero_secondary_cta_link]" type="text" id="hero_secondary_cta_link" value="<?php echo esc_attr(hungphat_opt('hero_secondary_cta_link', '#du-an')); ?>" class="regular-text">
                        </td>
                    </tr>
                </table>

                <h4 style="margin-top: 25px; margin-bottom: 10px; color: #ed1c24; font-size: 16px;">4 Chỉ Số Thống Kê Dưới Hero Banner</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; background: #f8fafc; padding: 20px; border-radius: 8px;">
                    <div>
                        <label><strong>Chỉ số 1: Con số</strong></label>
                        <input name="hungphat[stat_1_num]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_1_num', '9+ Năm')); ?>" class="regular-text" style="width: 100%;">
                        <label style="margin-top: 6px; display: block;">Nhãn mô tả:</label>
                        <input name="hungphat[stat_1_label]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_1_label', 'Đồng Hành Cùng Phát Triển')); ?>" class="regular-text" style="width: 100%;">
                    </div>
                    <div>
                        <label><strong>Chỉ số 2: Con số</strong></label>
                        <input name="hungphat[stat_2_num]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_2_num', '100%')); ?>" class="regular-text" style="width: 100%;">
                        <label style="margin-top: 6px; display: block;">Nhãn mô tả:</label>
                        <input name="hungphat[stat_2_label]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_2_label', 'Bảo Hành & Nâng Cấp Trọn Đời')); ?>" class="regular-text" style="width: 100%;">
                    </div>
                    <div>
                        <label><strong>Chỉ số 3: Con số</strong></label>
                        <input name="hungphat[stat_3_num]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_3_num', '7 - 10 Ngày')); ?>" class="regular-text" style="width: 100%;">
                        <label style="margin-top: 6px; display: block;">Nhãn mô tả:</label>
                        <input name="hungphat[stat_3_label]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_3_label', 'Hoàn Thành Nhanh Chóng')); ?>" class="regular-text" style="width: 100%;">
                    </div>
                    <div>
                        <label><strong>Chỉ số 4: Con số</strong></label>
                        <input name="hungphat[stat_4_num]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_4_num', '24/7')); ?>" class="regular-text" style="width: 100%;">
                        <label style="margin-top: 6px; display: block;">Nhãn mô tả:</label>
                        <input name="hungphat[stat_4_label]" type="text" value="<?php echo esc_attr(hungphat_opt('stat_4_label', 'Đội Ngũ Tận Tâm Hỗ Trợ')); ?>" class="regular-text" style="width: 100%;">
                    </div>
                </div>

            <!-- ================= TAB: ABOUT ================= -->
            <?php elseif ($active_tab === 'about'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    Nội Dung & Hình Ảnh Phần Giới Thiệu (About Us)
                </h3>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="about_badge">Huy hiệu giới thiệu</label></th>
                        <td>
                            <input name="hungphat[about_badge]" type="text" id="about_badge" value="<?php echo esc_attr(hungphat_opt('about_badge', 'VỀ HƯNG PHÁT ADS')); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="about_title">Tiêu đề phần giới thiệu</label></th>
                        <td>
                            <input name="hungphat[about_title]" type="text" id="about_title" value="<?php echo esc_attr(hungphat_opt('about_title', 'Công Ty TNHH Phát Triển Dịch Vụ Công Nghệ Hưng Phát')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="about_desc">Mô tả chi tiết</label></th>
                        <td>
                            <textarea name="hungphat[about_desc]" id="about_desc" rows="4" class="large-text"><?php echo esc_textarea(hungphat_opt('about_desc', 'Hưng Phát Ads (MST: 0313666158 do Sở KH&ĐT TP.HCM cấp ngày 29/02/2016) tự hào với hơn 9 năm kinh nghiệm chuyên thiết kế website và cung cấp giải pháp quảng cáo trực tuyến đa nền tảng phù hợp với mọi doanh nghiệp lớn, vừa và nhỏ tại Việt Nam và trên toàn cầu. Tất cả những gì bạn cần để thực hiện công việc kinh doanh vượt trội đều có trong một gói thiết kế web của Hưng Phát Ads.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Hình Ảnh Minh Họa Giới Thiệu</label></th>
                        <td>
                            <?php hungphat_image_field('about_image', 'Tải ảnh Đội ngũ / Văn phòng Hưng Phát Ads', 'Ảnh hiển thị bên trái khối giới thiệu (kích thước tối ưu 700x550px). Nếu để trống sẽ hiển thị thẻ thông số nổi bật mặc định.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="about_highlight_1">Điểm mạnh 1</label></th>
                        <td>
                            <input name="hungphat[about_highlight_1]" type="text" id="about_highlight_1" value="<?php echo esc_attr(hungphat_opt('about_highlight_1', 'Giao diện web đẹp chuyên nghiệp: Sử dụng công nghệ Responsive, đồng bộ hiển thị đẹp trên mọi thiết bị PC, Laptop, Tablet, Mobile.')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="about_highlight_2">Điểm mạnh 2</label></th>
                        <td>
                            <input name="hungphat[about_highlight_2]" type="text" id="about_highlight_2" value="<?php echo esc_attr(hungphat_opt('about_highlight_2', 'Tốc độ load trang nhanh: Tối ưu chuẩn Google PageSpeed, mang đến trải nghiệm mượt mà không độ trễ.')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="about_highlight_3">Điểm mạnh 3</label></th>
                        <td>
                            <input name="hungphat[about_highlight_3]" type="text" id="about_highlight_3" value="<?php echo esc_attr(hungphat_opt('about_highlight_3', 'Băng thông không giới hạn: Hosting chất lượng cao đảm bảo đường truyền nhanh, chịu tải lượng lớn người truy cập cùng lúc.')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="about_highlight_4">Điểm mạnh 4</label></th>
                        <td>
                            <input name="hungphat[about_highlight_4]" type="text" id="about_highlight_4" value="<?php echo esc_attr(hungphat_opt('about_highlight_4', 'Tối ưu tỷ lệ chuyển đổi đơn hàng & Bảo hành trọn đời: Hỗ trợ quản trị nội dung, nâng cấp bảo trì miễn phí trọn đời.')); ?>" class="large-text">
                        </td>
                    </tr>
                </table>

            <!-- ================= TAB: SERVICES ================= -->
            <?php elseif ($active_tab === 'services'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    Cấu Hình Tiêu Đề & Nội Dung 6 Dịch Vụ Chủ Lực
                </h3>

                <table class="form-table" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="services_title">Tiêu đề phần Dịch Vụ</label></th>
                        <td>
                            <input name="hungphat[services_title]" type="text" id="services_title" value="<?php echo esc_attr(hungphat_opt('services_title', 'Giải Pháp Thiết Kế Website Chuyên Nghiệp')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="services_subtitle">Mô tả phần Dịch Vụ</label></th>
                        <td>
                            <input name="hungphat[services_subtitle]" type="text" id="services_subtitle" value="<?php echo esc_attr(hungphat_opt('services_subtitle', 'Phù hợp với tất cả doanh nghiệp, cửa hàng quy mô lớn, vừa và nhỏ.')); ?>" class="large-text">
                        </td>
                    </tr>
                </table>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <?php
                    $default_services = [
                        1 => ['title' => 'Thiết Kế Web Doanh Nghiệp', 'desc' => 'Xây dựng hình ảnh thương hiệu đẳng cấp, giới thiệu năng lực công ty, sản phẩm dịch vụ chuyên nghiệp, tạo dựng niềm tin tuyệt đối với đối tác & khách hàng.'],
                        2 => ['title' => 'Thiết Kế Web Bán Hàng E-Commerce', 'desc' => 'Website thương mại điện tử hoàn chỉnh với đầy đủ tính năng giỏ hàng, thanh toán qua VNPay/Momo/Banking, quản lý đơn hàng & tồn kho thông minh.'],
                        3 => ['title' => 'Landing Page Chạy Quảng Cáo', 'desc' => 'Landing Page tối ưu phễu bán hàng cao cấp, thiết kế theo tâm lý học hành vi người dùng (AIDA), tăng gấp 3 lần tỷ lệ chuyển đổi cho chiến dịch Ads.'],
                        4 => ['title' => 'Lập Trình Web Theo Yêu Cầu', 'desc' => 'Xây dựng hệ thống web ứng dụng phức tạp, cổng thông tin điện tử, hệ thống đặt chỗ (Booking), CRM nội bộ, kết nối API linh hoạt theo nhu cầu riêng.'],
                        5 => ['title' => 'Tối Ưu SEO & Tốc Độ Website', 'desc' => 'Tối ưu toàn diện Core Web Vitals, nén mã nguồn, tăng tốc độ tải trang Google PageSpeed 90+, chuẩn hóa cấu trúc Semantic SEO đưa website lên top.'],
                        6 => ['title' => 'Bảo Trì & Quản Trị Toàn Diện', 'desc' => 'Giải pháp chăm sóc website trọn gói cho doanh nghiệp không có nhân sự IT: cập nhật nội dung, sao lưu dữ liệu mỗi ngày, phòng chống virus & sửa lỗi tức thì.']
                    ];
                    for ($i = 1; $i <= 6; $i++):
                    ?>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px;">
                            <h4 style="margin: 0 0 10px; color: #ed1c24; font-size: 15px;">Dịch Vụ #<?php echo $i; ?></h4>
                            <label style="font-weight: 600; display: block; margin-bottom: 4px;">Tên dịch vụ:</label>
                            <input name="hungphat[service_<?php echo $i; ?>_title]" type="text" value="<?php echo esc_attr(hungphat_opt("service_{$i}_title", $default_services[$i]['title'])); ?>" class="regular-text" style="width: 100%; margin-bottom: 10px;">
                            <label style="font-weight: 600; display: block; margin-bottom: 4px;">Mô tả ngắn dịch vụ:</label>
                            <textarea name="hungphat[service_<?php echo $i; ?>_desc]" rows="3" class="large-text" style="width: 100%;"><?php echo esc_textarea(hungphat_opt("service_{$i}_desc", $default_services[$i]['desc'])); ?></textarea>
                        </div>
                    <?php endfor; ?>
                </div>

            <!-- ================= TAB: PRICING ================= -->
            <?php elseif ($active_tab === 'pricing'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    Cấu Hình Bảng Giá Dịch Vụ Minh Bạch & Ưu Đãi
                </h3>

                <table class="form-table" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="pricing_title">Tiêu đề phần Bảng Giá</label></th>
                        <td>
                            <input name="hungphat[pricing_title]" type="text" id="pricing_title" value="<?php echo esc_attr(hungphat_opt('pricing_title', 'Bảng Giá Dịch Vụ Minh Bạch & Tối Ưu')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pricing_subtitle">Mô tả phần Bảng Giá</label></th>
                        <td>
                            <input name="hungphat[pricing_subtitle]" type="text" id="pricing_subtitle" value="<?php echo esc_attr(hungphat_opt('pricing_subtitle', 'Báo giá trọn gói - Hoàn thành nhanh chóng từ 7 - 10 ngày - Không phát sinh chi phí.')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pricing_note">Thông báo khuyến mãi nổi bật</label></th>
                        <td>
                            <textarea name="hungphat[pricing_note]" id="pricing_note" rows="2" class="large-text"><?php echo esc_textarea(hungphat_opt('pricing_note', '🎁 ƯU ĐÃI ĐẶC BIỆT: Tặng Tên Miền Quốc Tế + Hosting Tốc Độ Cao Băng Thông Không Giới Hạn + Chứng Chỉ Bảo Mật SSL khi ký hợp đồng trong tháng này!')); ?></textarea>
                        </td>
                    </tr>
                </table>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                    <!-- Gói 1 -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px;">
                        <h4 style="margin: 0 0 10px; color: #1e293b; font-size: 16px;">Gói 1: Khởi Nghiệp</h4>
                        <label>Tên gói:</label>
                        <input name="hungphat[plan_1_name]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_1_name', 'Gói Khởi Nghiệp')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Giá hiển thị (VNĐ):</label>
                        <input name="hungphat[plan_1_price]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_1_price', '3.900.000')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Mô tả đối tượng:</label>
                        <input name="hungphat[plan_1_desc]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_1_desc', 'Dành cho cá nhân, dự án nhỏ, landing page chạy quảng cáo')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Thời gian bàn giao:</label>
                        <input name="hungphat[plan_1_time]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_1_time', '3 - 5 ngày')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Chữ trên nút bấm:</label>
                        <input name="hungphat[plan_1_btn]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_1_btn', 'Chọn Gói Khởi Nghiệp')); ?>" style="width: 100%;">
                    </div>

                    <!-- Gói 2 -->
                    <div style="background: #fff1f2; border: 2px solid #ed1c24; border-radius: 8px; padding: 18px;">
                        <h4 style="margin: 0 0 10px; color: #ed1c24; font-size: 16px;">Gói 2: Doanh Nghiệp (Phổ Biến)</h4>
                        <label>Tên gói:</label>
                        <input name="hungphat[plan_2_name]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_2_name', 'Gói Doanh Nghiệp')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Giá hiển thị (VNĐ):</label>
                        <input name="hungphat[plan_2_price]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_2_price', '7.900.000')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Mô tả đối tượng:</label>
                        <input name="hungphat[plan_2_desc]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_2_desc', 'Lựa chọn hàng đầu cho công ty, doanh nghiệp khẳng định thương hiệu')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Thời gian bàn giao:</label>
                        <input name="hungphat[plan_2_time]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_2_time', '5 - 7 ngày')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Chữ trên nút bấm:</label>
                        <input name="hungphat[plan_2_btn]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_2_btn', 'Đăng Ký Gói Doanh Nghiệp')); ?>" style="width: 100%;">
                    </div>

                    <!-- Gói 3 -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px;">
                        <h4 style="margin: 0 0 10px; color: #1e293b; font-size: 16px;">Gói 3: E-Commerce VIP</h4>
                        <label>Tên gói:</label>
                        <input name="hungphat[plan_3_name]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_3_name', 'Gói E-Commerce VIP')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Giá hiển thị (VNĐ):</label>
                        <input name="hungphat[plan_3_price]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_3_price', '14.900.000')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Mô tả đối tượng:</label>
                        <input name="hungphat[plan_3_desc]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_3_desc', 'Website bán hàng toàn diện, tích hợp thanh toán & quản lý kho')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Thời gian bàn giao:</label>
                        <input name="hungphat[plan_3_time]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_3_time', '10 - 14 ngày')); ?>" style="width: 100%; margin-bottom: 8px;">
                        <label>Chữ trên nút bấm:</label>
                        <input name="hungphat[plan_3_btn]" type="text" value="<?php echo esc_attr(hungphat_opt('plan_3_btn', 'Chọn Gói E-Commerce VIP')); ?>" style="width: 100%;">
                    </div>
                </div>

            <!-- ================= TAB: PORTFOLIO & IMAGES ================= -->
            <?php elseif ($active_tab === 'portfolio'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    Kho Dự Án Mẫu & Quản Lý Hình Ảnh Screenshot Dự Án
                </h3>

                <table class="form-table" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="portfolio_title">Tiêu đề phần Dự Án Mẫu</label></th>
                        <td>
                            <input name="hungphat[portfolio_title]" type="text" id="portfolio_title" value="<?php echo esc_attr(hungphat_opt('portfolio_title', 'Kho Dự Án Tiêu Biểu Đã Triển Khai')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="portfolio_subtitle">Mô tả phần Dự Án Mẫu</label></th>
                        <td>
                            <input name="hungphat[portfolio_subtitle]" type="text" id="portfolio_subtitle" value="<?php echo esc_attr(hungphat_opt('portfolio_subtitle', 'Khám phá các website thực tế được Hưng Phát Ads thiết kế và vận hành hiệu quả cho hàng trăm khách hàng.')); ?>" class="large-text">
                        </td>
                    </tr>
                </table>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <?php
                    $default_projects = [
                        1 => ['name' => 'Chuỗi Cửa Hàng Bán Lẻ Tiện Lợi', 'cat' => 'Ngành Bán Lẻ', 'desc' => 'Hệ thống quản lý hàng nghìn mã sản phẩm, hỗ trợ đặt hàng trực tuyến và giao hàng nhanh.', 'metrics' => 'Doanh số +320% | PageSpeed 98', 'tags' => 'Chuẩn SEO, Quét Mã QR, Tốc độ 99'],
                        2 => ['name' => 'Nhà Hàng & Quán Ăn Đặc Sản', 'cat' => 'Lĩnh Vực Quán Ăn', 'desc' => 'Menu điện tử hình ảnh hấp dẫn, tích hợp bản đồ chỉ đường và hệ thống đặt bàn nhanh.', 'metrics' => 'Đặt bàn +280% | Menu QR số', 'tags' => 'Menu QR, Đặt Bàn Online, Google Maps'],
                        3 => ['name' => 'Công Ty May Mặc & Thời Trang', 'cat' => 'Ngành May Mặc', 'desc' => 'Thiết kế thanh lịch, hỗ trợ tải hồ sơ năng lực (Profile PDF) và báo giá đơn hàng sỉ số lượng lớn.', 'metrics' => 'Chuyển đổi 4.8% | Xuất khẩu', 'tags' => 'Catalog Mẫu, Báo Giá Sỉ, Responsive'],
                        4 => ['name' => 'Shop Hoa Tươi & Cây Cảnh Văn Phòng', 'cat' => 'Hoa Tươi - Cây Xanh', 'desc' => 'Trải nghiệm mua hoa trực quan theo chủ đề sự kiện, chọn ngày giờ giao hoa chính xác.', 'metrics' => 'Tăng 190% đơn đặt hoa | Giao 2H', 'tags' => 'Điện Hoa 24/7, Thiệp Chúc, Zalo Chat'],
                        5 => ['name' => 'Nhà Máy Gia Công Cơ Khí Chính Xác', 'cat' => 'Ngành Cơ Khí', 'desc' => 'Khẳng định năng lực kỹ thuật với bảng thông số máy móc, dự án hoàn thành và hệ thống gửi bản vẽ trực tuyến.', 'metrics' => 'Chuẩn ISO 9001 | Hợp đồng lớn', 'tags' => 'Bản Vẽ Kỹ Thuật, Profile, Chuẩn SEO'],
                        6 => ['name' => 'Sàn Bất Động Sản & Dự Án Đô Thị', 'cat' => 'Bất Động Sản', 'desc' => 'Giao diện sang trọng, tích hợp bản đồ quy hoạch, bảng giá căn hộ và biểu mẫu tư vấn dự án.', 'metrics' => '+450 Khách Lead/tháng | Tải 0.8s', 'tags' => 'Bản Đồ 3D, Form Lead CRM, Tối Ưu Ads']
                    ];

                    for ($p = 1; $p <= 6; $p++):
                    ?>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; border-bottom: 1px solid #cbd5e1; padding-bottom: 8px;">
                                <h4 style="margin: 0; color: #ed1c24; font-size: 15px;">Dự Án Mẫu #<?php echo $p; ?> (<?php echo esc_html($default_projects[$p]['cat']); ?>)</h4>
                            </div>

                            <label style="font-weight: 600; display: block; margin-bottom: 4px;">Tên dự án:</label>
                            <input name="hungphat[proj_<?php echo $p; ?>_name]" type="text" value="<?php echo esc_attr(hungphat_opt("proj_{$p}_name", $default_projects[$p]['name'])); ?>" style="width: 100%; margin-bottom: 10px;">

                            <label style="font-weight: 600; display: block; margin-bottom: 4px;">Danh mục / Ngành nghề:</label>
                            <input name="hungphat[proj_<?php echo $p; ?>_cat]" type="text" value="<?php echo esc_attr(hungphat_opt("proj_{$p}_cat", $default_projects[$p]['cat'])); ?>" style="width: 100%; margin-bottom: 10px;">

                            <label style="font-weight: 600; display: block; margin-bottom: 4px;">Mô tả ngắn dự án:</label>
                            <textarea name="hungphat[proj_<?php echo $p; ?>_desc]" rows="2" style="width: 100%; margin-bottom: 10px;"><?php echo esc_textarea(hungphat_opt("proj_{$p}_desc", $default_projects[$p]['desc'])); ?></textarea>

                            <label style="font-weight: 600; display: block; margin-bottom: 4px;">Chỉ số kết quả nổi bật:</label>
                            <input name="hungphat[proj_<?php echo $p; ?>_metrics]" type="text" value="<?php echo esc_attr(hungphat_opt("proj_{$p}_metrics", $default_projects[$p]['metrics'])); ?>" style="width: 100%; margin-bottom: 10px;">

                            <label style="font-weight: 600; display: block; margin-bottom: 4px;">Các thẻ Tags (ngăn cách bởi dấu phẩy):</label>
                            <input name="hungphat[proj_<?php echo $p; ?>_tags]" type="text" value="<?php echo esc_attr(hungphat_opt("proj_{$p}_tags", $default_projects[$p]['tags'])); ?>" style="width: 100%; margin-bottom: 14px;">

                            <!-- Image Upload for Project -->
                            <div style="background: #ffffff; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                                <?php hungphat_image_field("proj_{$p}_image", "Ảnh Chụp / Giao Diện Dự Án #{$p}", "Nếu tải ảnh thật, giao diện sẽ hiển thị ảnh screenshot thực tế thay cho đồ họa mô phỏng.", ""); ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

            <!-- ================= TAB: PROCESS ================= -->
            <?php elseif ($active_tab === 'process'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    Cấu Hình Quy Trình Triển Khai 6 Bước Chuẩn Hóa
                </h3>

                <table class="form-table" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="process_title">Tiêu đề phần Quy Trình</label></th>
                        <td>
                            <input name="hungphat[process_title]" type="text" id="process_title" value="<?php echo esc_attr(hungphat_opt('process_title', 'Quy Trình Triển Khai Chuyên Nghiệp')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="process_subtitle">Mô tả phần Quy Trình</label></th>
                        <td>
                            <input name="hungphat[process_subtitle]" type="text" id="process_subtitle" value="<?php echo esc_attr(hungphat_opt('process_subtitle', 'Quy trình chuẩn hóa giúp hoàn thành nhanh chóng từ 7 - 10 ngày làm việc.')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="guarantee_text">Nội dung Cam Kết Vàng</label></th>
                        <td>
                            <textarea name="hungphat[guarantee_text]" id="guarantee_text" rows="3" class="large-text"><?php echo esc_textarea(hungphat_opt('guarantee_text', 'Hưng Phát Ads cam kết hỗ trợ khách hàng quản trị nội dung web trọn đời, bảo hành và nâng cấp bảo trì miễn phí.')); ?></textarea>
                        </td>
                    </tr>
                </table>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <?php
                    $default_steps = [
                        1 => ['title' => 'Khảo Sát & Tư Vấn', 'time' => '1 - 2 Ngày', 'desc' => 'Tiếp nhận yêu cầu, phân tích ngành hàng, đối thủ cạnh tranh và tư vấn cấu trúc sitemap tối ưu chuyển đổi.'],
                        2 => ['title' => 'Thiết Kế UI/UX Bản Vẽ', 'time' => '2 - 3 Ngày', 'desc' => 'Phác thảo Wireframe và thiết kế bản vẽ giao diện Figma độc quyền theo đúng màu sắc nhận diện thương hiệu.'],
                        3 => ['title' => 'Lập Trình & Tối Ưu Tốc Độ', 'time' => '3 - 5 Ngày', 'desc' => 'Lập trình các tính năng, tối ưu mã nguồn chuẩn W3C, nén ảnh thế hệ mới, cấu hình chuẩn SEO Google Onpage.'],
                        4 => ['title' => 'Kiểm Thử & Đánh Giá', 'time' => '1 - 2 Ngày', 'desc' => 'Chạy thử nghiệm trên 15+ dòng điện thoại, máy tính bảng và các trình duyệt (Chrome, Safari, Edge) để đảm bảo không lỗi.'],
                        5 => ['title' => 'Bàn Giao & Hướng Dẫn', 'time' => '1 Ngày', 'desc' => 'Bàn giao toàn bộ source code và tài khoản quản trị. Hướng dẫn 1:1 và cung cấp video hướng dẫn quản trị chi tiết.'],
                        6 => ['title' => 'Bảo Hành & Đồng Hành', 'time' => 'Vĩnh Viễn', 'desc' => 'Bảo hành trọn đời mã nguồn, sao lưu tự động định kỳ hàng ngày và hỗ trợ kỹ thuật nhanh chóng qua hotline 24/7.']
                    ];

                    for ($s = 1; $s <= 6; $s++):
                    ?>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                            <h4 style="margin: 0 0 10px; color: #ed1c24;">Bước 0<?php echo $s; ?></h4>
                            <label style="font-weight: 600;">Tên bước:</label>
                            <input name="hungphat[step_<?php echo $s; ?>_title]" type="text" value="<?php echo esc_attr(hungphat_opt("step_{$s}_title", $default_steps[$s]['title'])); ?>" style="width: 100%; margin-bottom: 8px;">
                            <label style="font-weight: 600;">Thời gian ước tính:</label>
                            <input name="hungphat[step_<?php echo $s; ?>_time]" type="text" value="<?php echo esc_attr(hungphat_opt("step_{$s}_time", $default_steps[$s]['time'])); ?>" style="width: 100%; margin-bottom: 8px;">
                            <label style="font-weight: 600;">Mô tả thực hiện:</label>
                            <textarea name="hungphat[step_<?php echo $s; ?>_desc]" rows="2" style="width: 100%;"><?php echo esc_textarea(hungphat_opt("step_{$s}_desc", $default_steps[$s]['desc'])); ?></textarea>
                        </div>
                    <?php endfor; ?>
                </div>

            <!-- ================= TAB: CONTACT & QR ================= -->
            <?php elseif ($active_tab === 'contact'): ?>
                <h3 style="border-bottom: 2px solid #ed1c24; padding-bottom: 10px; margin-top: 0; color: #0d0c22; font-size: 18px;">
                    Cấu Hình Khối Liên Hệ, Form Tư Vấn & Mã QR Zalo
                </h3>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="contact_title">Tiêu đề khối liên hệ</label></th>
                        <td>
                            <input name="hungphat[contact_title]" type="text" id="contact_title" value="<?php echo esc_attr(hungphat_opt('contact_title', 'Sẵn Sàng Bứt Phá Doanh Số Cùng Website Đẳng Cấp?')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="contact_desc">Mô tả khối liên hệ</label></th>
                        <td>
                            <textarea name="hungphat[contact_desc]" id="contact_desc" rows="3" class="large-text"><?php echo esc_textarea(hungphat_opt('contact_desc', 'Hãy để lại thông tin nhu cầu hoặc liên hệ trực tiếp với chúng tôi. Đội ngũ chuyên gia Hưng Phát Ads sẽ nghiên cứu và gửi bản kế hoạch cùng báo giá chi tiết trong vòng 15 phút.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="form_title">Tiêu đề Form đăng ký</label></th>
                        <td>
                            <input name="hungphat[form_title]" type="text" id="form_title" value="<?php echo esc_attr(hungphat_opt('form_title', 'Đăng Ký Tư Vấn & Nhận Ưu Đãi')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="form_subtitle">Phụ đề Form đăng ký</label></th>
                        <td>
                            <input name="hungphat[form_subtitle]" type="text" id="form_subtitle" value="<?php echo esc_attr(hungphat_opt('form_subtitle', 'Điền thông tin bên dưới để nhận ngay báo giá ưu đãi giảm 20%')); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Ảnh Mã QR Zalo / Hotline</label></th>
                        <td>
                            <?php hungphat_image_field('contact_qr_image', 'Tải lên Ảnh Mã QR Code Zalo', 'Mã QR quét nhanh vào Zalo Official Account hoặc hotline Hưng Phát Ads để khách hàng liên hệ trực tiếp từ điện thoại.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="footer_copyright">Bản quyền chân trang</label></th>
                        <td>
                            <input name="hungphat[footer_copyright]" type="text" id="footer_copyright" value="<?php echo esc_attr(hungphat_opt('footer_copyright', '© 2016 - 2026 Hưng Phát Ads. Bản quyền thuộc về CÔNG TY TNHH PHÁT TRIỂN DỊCH VỤ CÔNG NGHỆ HƯNG PHÁT.')); ?>" class="large-text">
                        </td>
                    </tr>
                </table>
            <?php endif; ?>

            <!-- Submit Button Bar (Centered Dashicon & Beautiful Pill Style) -->
            <div class="submit" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <button type="submit" class="button-pill-red" style="padding: 12px 36px; font-size: 15px;">
                    Lưu Tất Cả Thay Đổi
                </button>
                <span style="color: #64748b; font-size: 13px;">Dữ liệu sẽ được cập nhật trực tiếp ra ngoài Landing Page ngay sau khi lưu.</span>
            </div>
        </form>
    </div>

    <!-- Media Uploader Scripts -->
    <script>
    jQuery(document).ready(function($) {
        // WordPress Media Uploader Modal Trigger
        $('.hungphat-upload-btn').on('click', function(e) {
            e.preventDefault();
            var targetInputId = $(this).data('input-id');
            var inputField = $('#' + targetInputId);
            var previewBox = $('#preview-' + targetInputId);
            var removeBtn = $(this).siblings('.hungphat-remove-btn');

            var customUploader = wp.media({
                title: 'Chọn hoặc Tải Ảnh Lên Thư Viện',
                button: { text: 'Sử Dụng Ảnh Này' },
                multiple: false,
                library: { type: 'image' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
                previewBox.html('<img src="' + attachment.url + '" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">');
                removeBtn.show();
            });

            customUploader.open();
        });

        // Remove Image Button
        $('.hungphat-remove-btn').on('click', function(e) {
            e.preventDefault();
            var targetInputId = $(this).data('input-id');
            $('#' + targetInputId).val('');
            $('#preview-' + targetInputId).html('<span style="color: #94a3b8; font-size: 12px; text-align: center; padding: 5px;">Chưa chọn ảnh</span>');
            $(this).hide();
        });
    });
    </script>
    <?php
}
