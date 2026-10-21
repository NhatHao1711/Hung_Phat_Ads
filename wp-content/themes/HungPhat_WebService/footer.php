<?php
/**
 * Footer template for HungPhat WebService
 */
if (!defined('ABSPATH')) {
    exit;
}

$brand_name      = hungphat_opt('brand_name', 'Hưng Phát Ads');
$brand_slogan    = hungphat_opt('brand_slogan', 'Đồng hành cùng phát triển');
$legal_name      = hungphat_opt('company_legal_name', 'CÔNG TY TNHH PHÁT TRIỂN DỊCH VỤ CÔNG NGHỆ HƯNG PHÁT');
$mst             = hungphat_opt('company_mst', '0313666158');
$hotline         = hungphat_opt('hotline', '0902 172 192');
$phone_landline  = hungphat_opt('phone_landline', '028 2239 9992');
$clean_hotline   = preg_replace('/[^0-9]/', '', $hotline);
$zalo            = hungphat_opt('zalo_number', '0902172192');
$email           = hungphat_opt('contact_email', 'sales@hungphatads.com');
$address         = hungphat_opt('company_address', '236 Nguyễn Xí, Phường Bình Lợi Trung, TP. Hồ Chí Minh');
$hq_address      = hungphat_opt('company_hq_address', '127 – 129 Hoàng Văn Thụ, Phường 8, Quận Phú Nhuận, TP. Hồ Chí Minh');
$copyright       = hungphat_opt('footer_copyright', '© 2016 - ' . date('Y') . ' Hưng Phát Ads. Bản quyền thuộc về CÔNG TY TNHH PHÁT TRIỂN DỊCH VỤ CÔNG NGHỆ HƯNG PHÁT.');
$footer_logo     = hungphat_opt('footer_logo', '');
$site_logo       = hungphat_opt('site_logo', '');
$effective_logo  = !empty($footer_logo) ? $footer_logo : $site_logo;
?>
<footer class="site-footer" id="site-footer">
    <div class="footer-top">
        <div class="container footer-container">
            <!-- Col 1: Brand & About -->
            <div class="footer-col footer-col-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo footer-logo">
                    <?php if (!empty($effective_logo)): ?>
                        <img src="<?php echo esc_url($effective_logo); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="site-footer-logo-img" style="max-height: 48px; width: auto; object-fit: contain; margin-bottom: 12px;">
                    <?php else: ?>
                        <div class="logo-text-box">
                            <span class="logo-title">Hưng Phát Ads</span>
                            <span class="logo-subtitle"><?php echo esc_html($brand_slogan); ?></span>
                        </div>
                    <?php endif; ?>
                </a>
                <p class="footer-desc">
                    <strong><?php echo esc_html($legal_name); ?></strong><br>
                    Hơn 9 năm kinh nghiệm chuyên thiết kế website chuẩn SEO và cung cấp giải pháp quảng cáo trực tuyến đa nền tảng cho mọi quy mô doanh nghiệp.
                </p>
                <div class="footer-badges">
                    <span class="badge-trust">Google Premier Partner</span>
                    <span class="badge-trust">Meta Business Partner</span>
                    <span class="badge-trust">Bảo Hành Trọn Đời</span>
                </div>
            </div>

            <!-- Col 2: Dịch Vụ -->
            <div class="footer-col">
                <h4 class="footer-heading">Giải Pháp Marketing</h4>
                <ul class="footer-links">
                    <li><a href="#dich-vu">Thiết Kế Web Doanh Nghiệp</a></li>
                    <li><a href="#dich-vu">Thiết Kế Web Bán Hàng E-Commerce</a></li>
                    <li><a href="#dich-vu">Landing Page Chạy Ads Tối Ưu</a></li>
                    <li><a href="#dich-vu">Lập Trình Web Theo Yêu Cầu</a></li>
                    <li><a href="#dich-vu">Tối Ưu SEO Chuẩn Google PageSpeed</a></li>
                    <li><a href="#dich-vu">Quản Trị & Bảo Trì Toàn Diện</a></li>
                </ul>
            </div>

            <!-- Col 3: Liên Kết Nhanh -->
            <div class="footer-col">
                <h4 class="footer-heading">Thông Tin Hưng Phát</h4>
                <ul class="footer-links">
                    <li><a href="#gioi-thieu">Về Hưng Phát Ads (Hồ Sơ Năng Lực)</a></li>
                    <li><a href="#bang-gia">Bảng Giá Thiết Kế Web</a></li>
                    <li><a href="#du-an">Kho Giao Diện Tham Khảo</a></li>
                    <li><a href="#quy-trinh">Quy Trình 6 Bước Triển Khai</a></li>
                    <li><a href="#tu-van">Đăng Ký Nhận Ưu Đãi 20%</a></li>
                    <li><a href="<?php echo esc_url(admin_url()); ?>" target="_blank">Đăng Nhập Quản Trị</a></li>
                </ul>
            </div>

            <!-- Col 4: Liên Hệ -->
            <div class="footer-col">
                <h4 class="footer-heading">Văn Phòng & Liên Hệ</h4>
                <ul class="footer-contact-list">
                    <li>
                        <span><strong>VPGD:</strong> <?php echo esc_html($address); ?></span>
                    </li>
                    <?php if (!empty($hq_address)): ?>
                    <li>
                        <span><strong>Trụ sở:</strong> <?php echo esc_html($hq_address); ?></span>
                    </li>
                    <?php endif; ?>
                    <li>
                        <span><strong>Hotline:</strong> <a href="tel:<?php echo esc_attr($clean_hotline); ?>" style="color: #ed1c24; font-weight: 700;"><?php echo esc_html($hotline); ?></a><?php if (!empty($phone_landline)): ?> (<?php echo esc_html($phone_landline); ?>)<?php endif; ?></span>
                    </li>
                    <li>
                        <span><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></span>
                    </li>
                    <li>
                        <span><strong>MST:</strong> <?php echo esc_html($mst); ?> (Sở KH&ĐT TP.HCM)</span>
                    </li>
                </ul>
                <div class="footer-social-section">
                    <span class="footer-social-label">Mạng xã hội:</span>
                    <div class="footer-socials">
                        <a href="https://www.facebook.com/agencyhungphatads/" target="_blank" rel="noopener noreferrer" class="social-btn social-fb" title="Facebook Hưng Phát Ads" aria-label="Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@hungphatads" target="_blank" rel="noopener noreferrer" class="social-btn social-tiktok" title="TikTok Hưng Phát Ads" aria-label="TikTok">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 3 15.68a6.34 6.34 0 0 0 10.86 4.43 6.27 6.27 0 0 0 1.88-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-.92-.11z"/>
                            </svg>
                        </a>
                        <a href="https://zalo.me/<?php echo esc_attr($zalo); ?>" target="_blank" rel="noopener noreferrer" class="social-btn social-zalo" title="Zalo Hưng Phát Ads" aria-label="Zalo">
                            <svg width="22" height="22" viewBox="0 0 48 48" fill="none">
                                <path d="M24 4C12.95 4 4 12.51 4 23c0 4.1 1.39 7.9 3.75 10.98L5.05 42.12a1 1 0 0 0 1.26 1.24l9.13-3.24A19.82 19.82 0 0 0 24 42c11.05 0 20-8.51 20-19S35.05 4 24 4z" fill="#0068FF"/>
                                <text x="24" y="28" text-anchor="middle" font-family="system-ui, -apple-system, sans-serif" font-weight="900" font-size="14" fill="#ffffff" letter-spacing="-0.5">Zalo</text>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/watch?v=unoZ-lcogp0" target="_blank" rel="noopener noreferrer" class="social-btn social-yt" title="YouTube Hưng Phát Ads" aria-label="YouTube">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <p><?php echo esc_html($copyright); ?></p>
            <div class="footer-bottom-links">
                <a href="#tu-van">Chính Sách Bảo Mật</a>
                <span class="sep">•</span>
                <a href="#tu-van">Hình Thức Thanh Toán</a>
                <span class="sep">•</span>
                <a href="#tu-van">Cam Kết Hoàn Tiền</a>
            </div>
        </div>
    </div>
</footer>

<!-- FLOATING QUICK CONTACT BUTTONS -->
<div class="floating-contact-group">
    <a href="https://zalo.me/<?php echo esc_attr($zalo); ?>" target="_blank" rel="noopener noreferrer" class="float-btn float-zalo" title="Chat Zalo ngay: <?php echo esc_attr($zalo); ?>" id="float-zalo-btn">
        <div class="float-btn-icon">
            <svg width="32" height="32" viewBox="0 0 48 48" fill="none">
                <path d="M24 4C12.95 4 4 12.51 4 23c0 4.1 1.39 7.9 3.75 10.98L5.05 42.12a1 1 0 0 0 1.26 1.24l9.13-3.24A19.82 19.82 0 0 0 24 42c11.05 0 20-8.51 20-19S35.05 4 24 4z" fill="#ffffff"/>
                <text x="24" y="27.5" text-anchor="middle" font-family="system-ui, -apple-system, sans-serif" font-weight="900" font-size="13" fill="#0068FF" letter-spacing="-0.5">Zalo</text>
            </svg>
        </div>
        <span class="float-tooltip">Chat Zalo: <?php echo esc_html($zalo); ?></span>
    </a>
    <a href="tel:<?php echo esc_attr($clean_hotline); ?>" class="float-btn float-phone" title="Gọi Hotline tư vấn ngay" id="float-phone-btn">
        <div class="float-btn-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#ffffff">
                <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 0 0-1.01.24l-2.2 2.2a15.057 15.057 0 0 1-6.59-6.59l2.2-2.21a.96.96 0 0 0 .25-1.01A11.36 11.36 0 0 1 8.57 3.9c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.52c0-.55-.45-1-.99-1z"/>
            </svg>
        </div>
        <span class="float-tooltip">Gọi ngay: <?php echo esc_html($hotline); ?></span>
    </a>
    <button class="float-btn float-back-to-top" id="back-to-top" title="Lên đầu trang" aria-label="Lên đầu trang">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 15l-6-6-6 6"/>
        </svg>
    </button>
</div>

<!-- TOAST NOTIFICATION CONTAINER -->
<div id="toast-container" class="toast-container" aria-live="polite"></div>

<!-- LIVE PROJECT PREVIEW MODAL -->
<div id="project-modal" class="project-modal" role="dialog" aria-hidden="true">
    <div class="modal-backdrop" id="modal-backdrop"></div>
    <div class="modal-content">
        <button class="modal-close" id="modal-close" aria-label="Đóng cửa sổ">&times;</button>
        <div class="modal-body" id="modal-body-content">
            <!-- Injected via JavaScript -->
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
