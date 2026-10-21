<?php
/**
 * Template Name: Landing Page - Hưng Phát Ads
 * The main template file for displaying the Landing Page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// 1. General & Contact Options
$brand_name     = hungphat_opt('brand_name', 'Hưng Phát Ads - Đồng Hành Cùng Phát Triển');
$hotline        = hungphat_opt('hotline', '0902 172 192');
$clean_hotline  = preg_replace('/[^0-9]/', '', $hotline);
$email          = hungphat_opt('contact_email', 'sales@hungphatads.com');
$address        = hungphat_opt('company_address', '236 Nguyễn Xí, Phường Bình Lợi Trung, TP. Hồ Chí Minh (Trụ sở: 127 – 129 Hoàng Văn Thụ, TP.HCM)');
$working_hours  = hungphat_opt('working_hours', 'Thứ 2 - Thứ 6: 08:00 - 17:00 | Thứ 7: 08:00 - 11:30 (Hotline hỗ trợ 24/7)');

// 2. Hero Section Options
$hero_badge     = hungphat_opt('hero_badge', 'GOOGLE PREMIER PARTNER 2026 & META BUSINESS PARTNER');
$hero_title     = hungphat_opt('hero_title', 'Thiết Kế Web 1 Lần Sở Hữu Trọn Đời – Bứt Phá Doanh Số Cùng Hưng Phát Ads');
$hero_subtitle  = hungphat_opt('hero_subtitle', 'Dù bạn đang kinh doanh bất cứ lĩnh vực nào, Hưng Phát Ads giúp bạn xây dựng website độc quyền theo yêu cầu, giao diện Responsive hiển thị đẹp trên mọi thiết bị, tốc độ đạt chuẩn Google và tối ưu tỷ lệ chuyển đổi đơn hàng vượt trội.');
$hero_cta       = hungphat_opt('hero_cta_text', 'Bắt Đầu Ngay');
$hero_cta_link  = hungphat_opt('hero_cta_link', '#tu-van');
$hero_sec_cta   = hungphat_opt('hero_secondary_cta', 'Xem Mẫu Giao Diện');
$hero_sec_link  = hungphat_opt('hero_secondary_cta_link', '#du-an');
$hero_image     = hungphat_opt('hero_image', '');

$stat_1_num     = hungphat_opt('stat_1_num', '9+ Năm');
$stat_1_lbl     = hungphat_opt('stat_1_label', 'Đồng Hành Cùng Phát Triển');
$stat_2_num     = hungphat_opt('stat_2_num', '100%');
$stat_2_lbl     = hungphat_opt('stat_2_label', 'Bảo Hành & Nâng Cấp Trọn Đời');
$stat_3_num     = hungphat_opt('stat_3_num', '7 - 10 Ngày');
$stat_3_lbl     = hungphat_opt('stat_3_label', 'Hoàn Thành Nhanh Chóng');
$stat_4_num     = hungphat_opt('stat_4_num', '24/7');
$stat_4_lbl     = hungphat_opt('stat_4_label', 'Đội Ngũ Tận Tâm Hỗ Trợ');

// 3. About Section Options
$about_badge    = hungphat_opt('about_badge', 'VỀ HƯNG PHÁT ADS');
$about_title    = hungphat_opt('about_title', 'Công Ty TNHH Phát Triển Dịch Vụ Công Nghệ Hưng Phát');
$about_desc     = hungphat_opt('about_desc', 'Hưng Phát Ads (MST: 0313666158 do Sở KH&ĐT TP.HCM cấp ngày 29/02/2016) tự hào với hơn 9 năm kinh nghiệm chuyên thiết kế website và cung cấp giải pháp quảng cáo trực tuyến đa nền tảng phù hợp với mọi doanh nghiệp lớn, vừa và nhỏ tại Việt Nam và trên toàn cầu. Tất cả những gì bạn cần để thực hiện công việc kinh doanh vượt trội đều có trong một gói thiết kế web của Hưng Phát Ads.');
$about_image    = hungphat_opt('about_image', '');
$hl_1           = hungphat_opt('about_highlight_1', 'Giao diện web đẹp chuyên nghiệp: Sử dụng công nghệ Responsive, đồng bộ hiển thị đẹp trên mọi thiết bị PC, Laptop, Tablet, Mobile.');
$hl_2           = hungphat_opt('about_highlight_2', 'Tốc độ load trang nhanh: Tối ưu chuẩn Google PageSpeed, mang đến trải nghiệm mượt mà không độ trễ.');
$hl_3           = hungphat_opt('about_highlight_3', 'Băng thông không giới hạn: Hosting chất lượng cao đảm bảo đường truyền nhanh, chịu tải lượng lớn người truy cập cùng lúc.');
$hl_4           = hungphat_opt('about_highlight_4', 'Tối ưu tỷ lệ chuyển đổi đơn hàng & Bảo hành trọn đời: Hỗ trợ quản trị nội dung, nâng cấp bảo trì miễn phí trọn đời.');

// 4. Services Section Options
$services_title = hungphat_opt('services_title', 'Giải Pháp Thiết Kế Website Chuyên Nghiệp');
$services_sub   = hungphat_opt('services_subtitle', 'Phù hợp với tất cả doanh nghiệp, cửa hàng quy mô lớn, vừa và nhỏ.');

// 5. Pricing Section Options
$pricing_title  = hungphat_opt('pricing_title', 'Bảng Giá Dịch Vụ Minh Bạch & Tối Ưu');
$pricing_sub    = hungphat_opt('pricing_subtitle', 'Báo giá trọn gói - Hoàn thành nhanh chóng từ 7 - 10 ngày - Không phát sinh chi phí.');
$pricing_note   = hungphat_opt('pricing_note', 'ƯU ĐÃI ĐẶC BIỆT: Tặng Tên Miền Quốc Tế + Hosting Tốc Độ Cao Băng Thông Không Giới Hạn + Chứng Chỉ Bảo Mật SSL khi ký hợp đồng trong tháng này!');

// 6. Portfolio Section Options
$portfolio_title = hungphat_opt('portfolio_title', 'Kho Dự Án Tiêu Biểu Đã Triển Khai');
$portfolio_sub   = hungphat_opt('portfolio_subtitle', 'Khám phá các website thực tế được Hưng Phát Ads thiết kế và vận hành hiệu quả cho hàng trăm khách hàng.');

// 7. Process Section Options
$process_title  = hungphat_opt('process_title', 'Quy Trình Triển Khai Chuyên Nghiệp');
$process_sub    = hungphat_opt('process_subtitle', 'Quy trình chuẩn hóa giúp hoàn thành nhanh chóng từ 7 - 10 ngày làm việc.');
$guarantee_text = hungphat_opt('guarantee_text', 'Hưng Phát Ads cam kết hỗ trợ khách hàng quản trị nội dung web trọn đời, bảo hành và nâng cấp bảo trì miễn phí.');

// 8. Contact Section Options
$contact_title  = hungphat_opt('contact_title', 'Sẵn Sàng Bứt Phá Doanh Số Cùng Website Đẳng Cấp?');
$contact_desc   = hungphat_opt('contact_desc', 'Hãy để lại thông tin nhu cầu hoặc liên hệ trực tiếp với chúng tôi. Đội ngũ chuyên gia Hưng Phát Ads sẽ nghiên cứu và gửi bản kế hoạch cùng báo giá chi tiết trong vòng 15 phút.');
$form_title     = hungphat_opt('form_title', 'Đăng Ký Tư Vấn & Nhận Ưu Đãi');
$form_subtitle  = hungphat_opt('form_subtitle', 'Điền thông tin bên dưới để nhận ngay báo giá ưu đãi giảm 20%');
$contact_qr     = hungphat_opt('contact_qr_image', '');
?>

<main id="primary-content" class="site-main">

    <!-- 1. HERO SECTION -->
    <section class="hero-section" id="hero">
        <div class="hero-glow-1"></div>
        <div class="hero-glow-2"></div>
        <div class="container hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>

                <div class="hero-cta-group">
                    <a href="<?php echo esc_attr($hero_cta_link); ?>" class="btn btn-primary btn-large btn-glow">
                        <span><?php echo esc_html($hero_cta); ?></span>
                    </a>
                    <a href="<?php echo esc_attr($hero_sec_link); ?>" class="btn btn-secondary btn-large">
                        <span><?php echo esc_html($hero_sec_cta); ?></span>
                    </a>
                </div>

                <!-- Metrics Strip -->
                <div class="hero-stats-grid" id="hero-stats">
                    <div class="stat-card">
                        <div class="stat-number" data-target="<?php echo esc_attr($stat_1_num); ?>"><?php echo esc_html($stat_1_num); ?></div>
                        <div class="stat-label"><?php echo esc_html($stat_1_lbl); ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="<?php echo esc_attr($stat_2_num); ?>"><?php echo esc_html($stat_2_num); ?></div>
                        <div class="stat-label"><?php echo esc_html($stat_2_lbl); ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="<?php echo esc_attr($stat_3_num); ?>"><?php echo esc_html($stat_3_num); ?></div>
                        <div class="stat-label"><?php echo esc_html($stat_3_lbl); ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="<?php echo esc_attr($stat_4_num); ?>"><?php echo esc_html($stat_4_num); ?></div>
                        <div class="stat-label"><?php echo esc_html($stat_4_lbl); ?></div>
                    </div>
                </div>
            </div>

            <!-- Hero Visual Mockup or Custom Hero Image -->
            <div class="hero-visual">
                <?php if (!empty($hero_image)): ?>
                    <div class="browser-mockup custom-hero-img-wrap" style="padding: 10px; background: #16192e; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
                        <div class="browser-header" style="margin-bottom: 8px;">
                            <div class="browser-dots">
                                <span class="dot dot-red"></span>
                                <span class="dot dot-yellow"></span>
                                <span class="dot dot-green"></span>
                            </div>
                            <div class="browser-address-bar">
                                <span>https://hungphatads.com</span>
                            </div>
                        </div>
                        <img src="<?php echo esc_url($hero_image); ?>" alt="Banner Hero Hưng Phát Ads" style="width: 100%; height: auto; border-radius: 8px; display: block; object-fit: cover;">
                    </div>
                <?php else: ?>
                    <div class="browser-mockup">
                        <div class="browser-header">
                            <div class="browser-dots">
                                <span class="dot dot-red"></span>
                                <span class="dot dot-yellow"></span>
                                <span class="dot dot-green"></span>
                            </div>
                            <div class="browser-address-bar">
                                <span>https://hungphatads.com/demo-preview</span>
                            </div>
                        </div>
                        <div class="browser-screen">
                            <div class="mockup-hero-banner">
                                <div class="mockup-tag">UI/UX Premium Design</div>
                                <h3>Bứt Phá Doanh Thu Cùng Website Chuyên Nghiệp</h3>
                                <div class="mockup-mock-bars">
                                    <span class="bar-fill w-80"></span>
                                    <span class="bar-fill w-60"></span>
                                </div>
                            </div>
                            <div class="mockup-cards-row">
                                <div class="mock-card">
                                    <strong>PageSpeed</strong>
                                    <span class="badge-score">99/100</span>
                                </div>
                                <div class="mock-card">
                                    <strong>Chuẩn SEO</strong>
                                    <span class="badge-score">Top 1 Google</span>
                                </div>
                                <div class="mock-card">
                                    <strong>Responsive</strong>
                                    <span class="badge-score">100% Mobile</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Floating badges -->
                <div class="float-badge badge-seo">
                    <div>
                        <div class="badge-t">Google Core Vitals</div>
                        <div class="badge-b">Điểm tối đa 100/100</div>
                    </div>
                </div>
                <div class="float-badge badge-conversion">
                    <div>
                        <div class="badge-t">Tăng Chuyển Đổi</div>
                        <div class="badge-b">+250% Đơn Hàng Mới</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GOOGLE PARTNER STRIP -->
    <section class="google-partner-strip">
        <div class="container">
            <div class="google-partner-box">
                <div class="google-partner-badge-card">
                    <div class="google-badge-bar">
                        <span class="bg-blue"></span>
                        <span class="bg-red"></span>
                        <span class="bg-yellow"></span>
                        <span class="bg-green"></span>
                    </div>
                    <div class="google-badge-body">
                        <div class="google-brand-row">
                            <svg class="google-svg" width="22" height="22" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.36 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.36 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span class="google-wordmark">Google</span>
                        </div>
                        <div class="google-badge-tier">Premier Partner</div>
                    </div>
                </div>
                <div class="google-partner-text">
                    <h3 class="google-partner-heading">Hưng Phát đối tác chính thức của Google</h3>
                    <p class="google-partner-desc">Chứng nhận chỉ dành cho công ty có đủ năng lực và chuyên môn cao như một cam kết của Google tại thị trường VIỆT NAM và trên TOÀN CẦU.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- OFFICIAL MULTI-PARTNERS BAR (HÌNH 2) -->
    <section class="official-partners-bar">
        <div class="container">
            <div class="partners-bar-content">
                <span class="partners-bar-title">Hưng Phát Ads cũng là đối tác chính thức:</span>
                <div class="partners-bar-icons">
                    <!-- Google -->
                    <div class="partner-icon-circle partner-google" title="Google Partner">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.36 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.36 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                        </svg>
                    </div>

                    <!-- Facebook -->
                    <div class="partner-icon-circle partner-facebook" title="Facebook / Meta Partner">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#ffffff">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </div>

                    <!-- YouTube -->
                    <div class="partner-icon-circle partner-youtube" title="YouTube Partner">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#ffffff">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </div>

                    <!-- Zalo -->
                    <div class="partner-icon-circle partner-zalo" title="Zalo Partner">
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none">
                            <path d="M24 4C12.95 4 4 12.51 4 23c0 4.1 1.39 7.9 3.75 10.98L5.05 42.12a1 1 0 0 0 1.26 1.24l9.13-3.24A19.82 19.82 0 0 0 24 42c11.05 0 20-8.51 20-19S35.05 4 24 4z" fill="#ffffff"/>
                            <text x="24" y="27.5" text-anchor="middle" font-family="system-ui, -apple-system, sans-serif" font-weight="900" font-size="13" fill="#0068FF" letter-spacing="-0.5">Zalo</text>
                        </svg>
                    </div>

                    <!-- TikTok -->
                    <div class="partner-icon-circle partner-tiktok" title="TikTok Partner">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#ffffff">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 3 15.68a6.34 6.34 0 0 0 10.86 4.43 6.27 6.27 0 0 0 1.88-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-.92-.11z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. GIỚI THIỆU (ABOUT US) -->
    <section class="section about-section" id="gioi-thieu">
        <div class="container">
            <div class="about-grid">
                <div class="about-visual">
                    <?php if (!empty($about_image)): ?>
                        <div class="about-custom-img-wrap" style="border-radius: 16px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                            <img src="<?php echo esc_url($about_image); ?>" alt="<?php echo esc_attr($brand_name); ?>" style="width: 100%; height: auto; display: block; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <div class="about-image-wrapper">
                            <div class="about-main-card">
                                <div class="about-card-head">
                                    <div>
                                        <h4><?php echo esc_html($brand_name); ?></h4>
                                        <p>Đơn vị thiết kế website uy tín</p>
                                    </div>
                                </div>
                                <div class="about-card-metrics">
                                    <div class="metric-item">
                                        <span class="m-val"><?php echo esc_html($stat_1_num); ?></span>
                                        <span class="m-lbl">Đồng hành phát triển</span>
                                    </div>
                                    <div class="metric-item">
                                        <span class="m-val">2,500+</span>
                                        <span class="m-lbl">Dự án bàn giao</span>
                                    </div>
                                    <div class="metric-item">
                                        <span class="m-val">100%</span>
                                        <span class="m-lbl">Khách hàng hài lòng</span>
                                    </div>
                                </div>
                                <div class="about-card-quote">
                                    <p>"Website không chỉ là bộ mặt thương hiệu, mà là nhân viên bán hàng xuất sắc nhất làm việc 24/7 không biết mệt mỏi."</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="about-content">
                    <div class="section-tag"><?php echo esc_html($about_badge); ?></div>
                    <h2 class="section-title"><?php echo esc_html($about_title); ?></h2>
                    <p class="section-desc"><?php echo nl2br(esc_html($about_desc)); ?></p>

                    <!-- Core Strengths -->
                    <div class="strengths-list">
                        <div class="strength-item">
                            <div class="strength-body">
                                <h4>Giao Diện UI/UX Độc Quyền</h4>
                                <p><?php echo esc_html($hl_1); ?></p>
                            </div>
                        </div>
                        <div class="strength-item">
                            <div class="strength-body">
                                <h4>Tối Ưu Chuẩn SEO & Siêu Tốc Độ</h4>
                                <p><?php echo esc_html($hl_2); ?></p>
                            </div>
                        </div>
                        <div class="strength-item">
                            <div class="strength-body">
                                <h4>Băng Thông Không Giới Hạn</h4>
                                <p><?php echo esc_html($hl_3); ?></p>
                            </div>
                        </div>
                        <div class="strength-item">
                            <div class="strength-body">
                                <h4>Bảo Hành & Nâng Cấp Trọn Đời</h4>
                                <p><?php echo esc_html($hl_4); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="about-cta">
                        <a href="#tu-van" class="btn btn-primary">
                            <span>Khám Phá Dịch Vụ Của Chúng Tôi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. DỊCH VỤ (SERVICES) -->
    <section class="section services-section" id="dich-vu">
        <div class="container">
            <div class="section-header text-center">
                <div class="section-tag">DỊCH VỤ CHUYÊN NGHIỆP</div>
                <h2 class="section-title"><?php echo esc_html($services_title); ?></h2>
                <p class="section-desc max-w-700"><?php echo esc_html($services_sub); ?></p>
            </div>

            <div class="services-grid">
                <?php
                $services_defaults = [
                    1 => [
                        'title' => 'Thiết Kế Web Doanh Nghiệp',
                        'desc' => 'Xây dựng hình ảnh thương hiệu đẳng cấp, giới thiệu năng lực công ty, sản phẩm dịch vụ chuyên nghiệp, tạo dựng niềm tin tuyệt đối với đối tác & khách hàng.',
                        'features' => ['Giao diện độc quyền theo nhận diện', 'Chuẩn SEO cấu trúc Schema doanh nghiệp', 'Đa ngôn ngữ (Việt - Anh - Nhật - Trung)']
                    ],
                    2 => [
                        'title' => 'Thiết Kế Web Bán Hàng E-Commerce',
                        'desc' => 'Website thương mại điện tử hoàn chỉnh với đầy đủ tính năng giỏ hàng, thanh toán qua VNPay/Momo/Banking, quản lý đơn hàng & tồn kho thông minh.',
                        'featured' => true,
                        'features' => ['Tích hợp cổng thanh toán trực tuyến', 'Quản lý kho, biến thể sản phẩm chi tiết', 'Tự động gửi email xác nhận & thông báo']
                    ],
                    3 => [
                        'title' => 'Landing Page Chạy Quảng Cáo',
                        'desc' => 'Landing Page tối ưu phễu bán hàng cao cấp, thiết kế theo tâm lý học hành vi người dùng (AIDA), tăng gấp 3 lần tỷ lệ chuyển đổi cho chiến dịch Ads.',
                        'features' => ['Tốc độ mở trang tức thì dưới 1 giây', 'Tích hợp pixel Facebook, Google Ads, TikTok', 'Form thu thập data lưu trữ tự động']
                    ],
                    4 => [
                        'title' => 'Lập Trình Web Theo Yêu Cầu',
                        'desc' => 'Xây dựng hệ thống web ứng dụng phức tạp, cổng thông tin điện tử, hệ thống đặt chỗ (Booking), CRM nội bộ, kết nối API linh hoạt theo nhu cầu riêng.',
                        'features' => ['Kiến trúc mở rộng cao, chịu tải lớn', 'Phân quyền người dùng & bảo mật chặt chẽ', 'Bàn giao tài liệu API & mã nguồn gốc']
                    ],
                    5 => [
                        'title' => 'Tối Ưu SEO & Tốc Độ Website',
                        'desc' => 'Tối ưu toàn diện Core Web Vitals, nén mã nguồn, tăng tốc độ tải trang Google PageSpeed 90+, chuẩn hóa cấu trúc Semantic SEO đưa website lên top.',
                        'features' => ['Tối ưu điểm Google PageSpeed Insights', 'Cấu hình CDN, nén ảnh thế hệ mới WebP/AVIF', 'Khắc phục hoàn toàn lỗi SEO kỹ thuật']
                    ],
                    6 => [
                        'title' => 'Bảo Trì & Quản Trị Toàn Diện',
                        'desc' => 'Giải pháp chăm sóc website trọn gói cho doanh nghiệp không có nhân sự IT: cập nhật nội dung, sao lưu dữ liệu mỗi ngày, phòng chống virus & sửa lỗi tức thì.',
                        'features' => ['Sao lưu tự động đám mây hàng ngày', 'Quét mã độc & cập nhật bảo mật 24/7', 'Hỗ trợ kỹ thuật qua Hotline/Zalo ưu tiên']
                    ]
                ];

                for ($i = 1; $i <= 6; $i++):
                    $s_title = hungphat_opt("service_{$i}_title", $services_defaults[$i]['title']);
                    $s_desc  = hungphat_opt("service_{$i}_desc", $services_defaults[$i]['desc']);
                    $s_conf  = $services_defaults[$i];
                ?>
                    <div class="service-card <?php echo !empty($s_conf['featured']) ? 'featured-service' : ''; ?>" data-service-name="<?php echo esc_attr($s_title); ?>">
                        <?php if (!empty($s_conf['featured'])): ?>
                            <div class="service-badge">Bán Chạy Nhất</div>
                        <?php endif; ?>
                        <h3 class="service-title"><?php echo esc_html($s_title); ?></h3>
                        <p class="service-text"><?php echo esc_html($s_desc); ?></p>
                        <ul class="service-features">
                            <?php foreach ($s_conf['features'] as $ft): ?>
                                <li>• <?php echo esc_html($ft); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="#tu-van" class="service-cta select-service-btn" data-service="<?php echo esc_attr($s_title); ?>">
                            <span>Đăng ký tư vấn</span>
                        </a>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- 4. BẢNG GIÁ (PRICING) -->
    <section class="section pricing-section" id="bang-gia">
        <div class="container">
            <div class="section-header text-center">
                <div class="section-tag">CHI PHÍ MINH BẠCH</div>
                <h2 class="section-title"><?php echo esc_html($pricing_title); ?></h2>
                <p class="section-desc max-w-700"><?php echo esc_html($pricing_sub); ?></p>
            </div>

            <!-- Promotion banner -->
            <?php if (!empty($pricing_note)): ?>
                <div class="promo-banner">
                    <div class="promo-text"><?php echo esc_html($pricing_note); ?></div>
                </div>
            <?php endif; ?>

            <div class="pricing-grid">
                <!-- Package 1: Khởi Nghiệp -->
                <?php
                $p1_name  = hungphat_opt('plan_1_name', 'Gói Khởi Nghiệp');
                $p1_price = hungphat_opt('plan_1_price', '3.900.000');
                $p1_desc  = hungphat_opt('plan_1_desc', 'Dành cho cá nhân, dự án nhỏ, landing page chạy quảng cáo');
                $p1_time  = hungphat_opt('plan_1_time', '3 - 5 ngày');
                $p1_btn   = hungphat_opt('plan_1_btn', 'Chọn Gói Khởi Nghiệp');
                ?>
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3 class="package-name"><?php echo esc_html($p1_name); ?></h3>
                        <p class="package-desc"><?php echo esc_html($p1_desc); ?></p>
                        <div class="package-price">
                            <span class="price-val"><?php echo esc_html($p1_price); ?></span>
                            <span class="price-unit">VNĐ</span>
                        </div>
                        <div class="package-payment-type">Thanh toán 1 lần - Sở hữu vĩnh viễn</div>
                    </div>
                    <div class="pricing-body">
                        <ul class="pricing-features">
                            <li>• Thiết kế Landing Page theo mẫu chuẩn SEO</li>
                            <li>• Giao diện Responsive (PC, Tablet, Mobile)</li>
                            <li>• Tích hợp form tư vấn & liên hệ Zalo/Hotline</li>
                            <li>• Miễn phí tên miền .com & Hosting 1 năm</li>
                            <li>• Cài đặt chứng chỉ bảo mật SSL miễn phí</li>
                            <li>• Thời gian triển khai: <strong><?php echo esc_html($p1_time); ?></strong></li>
                            <li>• Bảo hành kỹ thuật: <strong>12 tháng</strong></li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="#tu-van" class="btn btn-outline-primary btn-block select-pricing-btn" data-package="<?php echo esc_attr($p1_name); ?> (<?php echo esc_attr($p1_price); ?>đ)">
                            <?php echo esc_html($p1_btn); ?>
                        </a>
                    </div>
                </div>

                <!-- Package 2: Doanh Nghiệp (Featured) -->
                <?php
                $p2_name  = hungphat_opt('plan_2_name', 'Gói Doanh Nghiệp');
                $p2_price = hungphat_opt('plan_2_price', '7.900.000');
                $p2_desc  = hungphat_opt('plan_2_desc', 'Lựa chọn hàng đầu cho công ty, doanh nghiệp khẳng định thương hiệu');
                $p2_time  = hungphat_opt('plan_2_time', '5 - 7 ngày');
                $p2_btn   = hungphat_opt('plan_2_btn', 'Đăng Ký Gói Doanh Nghiệp');
                ?>
                <div class="pricing-card pricing-featured">
                    <div class="featured-ribbon">Phổ Biến Nhất</div>
                    <div class="pricing-header">
                        <h3 class="package-name"><?php echo esc_html($p2_name); ?></h3>
                        <p class="package-desc"><?php echo esc_html($p2_desc); ?></p>
                        <div class="package-price">
                            <span class="price-val"><?php echo esc_html($p2_price); ?></span>
                            <span class="price-unit">VNĐ</span>
                        </div>
                        <div class="package-payment-type">Thanh toán 1 lần - Sở hữu vĩnh viễn</div>
                    </div>
                    <div class="pricing-body">
                        <ul class="pricing-features">
                            <li>• <strong>Thiết kế UI/UX Độc Quyền Theo Yêu Cầu</strong></li>
                            <li>• Chuẩn SEO Google Onpage 90+ điểm</li>
                            <li>• Đầy đủ trang Giới thiệu, Dịch vụ, Dự án, Tin tức</li>
                            <li>• Quản trị trực quan, dễ dàng thêm sửa bài viết</li>
                            <li>• Tặng Tên Miền Quốc Tế + Hosting NVMe tốc độ cao</li>
                            <li>• Kết nối Google Analytics, Search Console, Pixel</li>
                            <li>• Thời gian triển khai: <strong><?php echo esc_html($p2_time); ?></strong></li>
                            <li>• <strong>Bảo Hành Trọn Đời</strong></li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="#tu-van" class="btn btn-primary btn-block btn-glow select-pricing-btn" data-package="<?php echo esc_attr($p2_name); ?> (<?php echo esc_attr($p2_price); ?>đ)">
                            <?php echo esc_html($p2_btn); ?>
                        </a>
                    </div>
                </div>

                <!-- Package 3: E-Commerce VIP -->
                <?php
                $p3_name  = hungphat_opt('plan_3_name', 'Gói E-Commerce VIP');
                $p3_price = hungphat_opt('plan_3_price', '14.900.000');
                $p3_desc  = hungphat_opt('plan_3_desc', 'Website bán hàng toàn diện, tích hợp thanh toán & quản lý kho');
                $p3_time  = hungphat_opt('plan_3_time', '10 - 14 ngày');
                $p3_btn   = hungphat_opt('plan_3_btn', 'Chọn Gói E-Commerce VIP');
                ?>
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3 class="package-name"><?php echo esc_html($p3_name); ?></h3>
                        <p class="package-desc"><?php echo esc_html($p3_desc); ?></p>
                        <div class="package-price">
                            <span class="price-val"><?php echo esc_html($p3_price); ?></span>
                            <span class="price-unit">VNĐ</span>
                        </div>
                        <div class="package-payment-type">Thanh toán 1 lần - Sở hữu vĩnh viễn</div>
                    </div>
                    <div class="pricing-body">
                        <ul class="pricing-features">
                            <li>• Mọi tính năng của Gói Doanh Nghiệp</li>
                            <li>• <strong>Hệ thống Giỏ Hàng & Đặt Hàng Thông Minh</strong></li>
                            <li>• Tích hợp cổng thanh toán VNPay, MoMo, Chuyển khoản</li>
                            <li>• Quản lý danh mục, biến thể màu sắc, size, kho hàng</li>
                            <li>• Hệ thống mã giảm giá & voucher khuyến mãi</li>
                            <li>• Tặng Tên Miền + Hosting NVMe 10GB siêu tốc</li>
                            <li>• Thời gian triển khai: <strong><?php echo esc_html($p3_time); ?></strong></li>
                            <li>• <strong>Bảo Hành & Hỗ Trợ Kỹ Thuật VIP 24/7</strong></li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="#tu-van" class="btn btn-outline-primary btn-block select-pricing-btn" data-package="<?php echo esc_attr($p3_name); ?> (<?php echo esc_attr($p3_price); ?>đ)">
                            <?php echo esc_html($p3_btn); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. DỰ ÁN MẪU (PORTFOLIO) -->
    <section class="section portfolio-section" id="du-an">
        <div class="container">
            <div class="section-header text-center">
                <div class="section-tag">NĂNG LỰC THỰC CHIẾN</div>
                <h2 class="section-title"><?php echo esc_html($portfolio_title); ?></h2>
                <p class="section-desc max-w-700"><?php echo esc_html($portfolio_sub); ?></p>
            </div>

            <!-- Portfolio Filter Tabs -->
            <div class="portfolio-filter-tabs">
                <button class="filter-btn active" data-filter="all">Tất Cả Dự Án</button>
                <button class="filter-btn" data-filter="banle">Bán Lẻ & Cửa Hàng</button>
                <button class="filter-btn" data-filter="quanan">Lĩnh Vực Quán Ăn - F&B</button>
                <button class="filter-btn" data-filter="maymac">May Mặc & Thời Trang</button>
                <button class="filter-btn" data-filter="hoatuoi">Hoa Tươi - Cây Xanh</button>
                <button class="filter-btn" data-filter="cokhi">Cơ Khí & Công Nghiệp</button>
                <button class="filter-btn" data-filter="batdongsan">Bất Động Sản</button>
            </div>

            <!-- Portfolio Grid -->
            <div class="portfolio-grid">
                <?php
                $portfolio_defaults = [
                    1 => ['name' => 'Chuỗi Cửa Hàng Bán Lẻ Tiện Lợi', 'filter' => 'banle', 'cat' => 'Ngành Bán Lẻ', 'desc' => 'Hệ thống quản lý hàng nghìn mã sản phẩm, hỗ trợ đặt hàng trực tuyến và giao hàng nhanh.', 'metrics' => 'Doanh số +320% | PageSpeed 98', 'tags' => 'Chuẩn SEO, Quét Mã QR, Tốc độ 99', 'bg' => 'bg-gradient-1'],
                    2 => ['name' => 'Nhà Hàng & Quán Ăn Đặc Sản', 'filter' => 'quanan', 'cat' => 'Lĩnh Vực Quán Ăn', 'desc' => 'Menu điện tử hình ảnh hấp dẫn, tích hợp bản đồ chỉ đường và hệ thống đặt bàn nhanh.', 'metrics' => 'Đặt bàn +280% | Menu QR số', 'tags' => 'Menu QR, Đặt Bàn Online, Google Maps', 'bg' => 'bg-gradient-5'],
                    3 => ['name' => 'Công Ty May Mặc & Thời Trang', 'filter' => 'maymac', 'cat' => 'Ngành May Mặc', 'desc' => 'Thiết kế thanh lịch, hỗ trợ tải hồ sơ năng lực (Profile PDF) và báo giá đơn hàng sỉ số lượng lớn.', 'metrics' => 'Chuyển đổi 4.8% | Xuất khẩu', 'tags' => 'Catalog Mẫu, Báo Giá Sỉ, Responsive', 'bg' => 'bg-gradient-4'],
                    4 => ['name' => 'Shop Hoa Tươi & Cây Cảnh Văn Phòng', 'filter' => 'hoatuoi', 'cat' => 'Hoa Tươi - Cây Xanh', 'desc' => 'Trải nghiệm mua hoa trực quan theo chủ đề sự kiện, chọn ngày giờ giao hoa chính xác.', 'metrics' => 'Tăng 190% đơn đặt hoa | Giao 2H', 'tags' => 'Điện Hoa 24/7, Thiệp Chúc, Zalo Chat', 'bg' => 'bg-gradient-2'],
                    5 => ['name' => 'Nhà Máy Gia Công Cơ Khí Chính Xác', 'filter' => 'cokhi', 'cat' => 'Ngành Cơ Khí', 'desc' => 'Khẳng định năng lực kỹ thuật với bảng thông số máy móc, dự án hoàn thành và hệ thống gửi bản vẽ trực tuyến.', 'metrics' => 'Chuẩn ISO 9001 | Hợp đồng lớn', 'tags' => 'Bản Vẽ Kỹ Thuật, Profile, Chuẩn SEO', 'bg' => 'bg-gradient-3'],
                    6 => ['name' => 'Sàn Bất Động Sản & Dự Án Đô Thị', 'filter' => 'batdongsan', 'cat' => 'Bất Động Sản', 'desc' => 'Giao diện sang trọng, tích hợp bản đồ quy hoạch, bảng giá căn hộ và biểu mẫu tư vấn dự án.', 'metrics' => '+450 Khách Lead/tháng | Tải 0.8s', 'tags' => 'Bản Đồ 3D, Form Lead CRM, Tối Ưu Ads', 'bg' => 'bg-gradient-6']
                ];

                for ($p = 1; $p <= 6; $p++):
                    $p_def   = $portfolio_defaults[$p];
                    $p_name  = hungphat_opt("proj_{$p}_name", $p_def['name']);
                    $p_cat   = hungphat_opt("proj_{$p}_cat", $p_def['cat']);
                    $p_desc  = hungphat_opt("proj_{$p}_desc", $p_def['desc']);
                    $p_met   = hungphat_opt("proj_{$p}_metrics", $p_def['metrics']);
                    $p_tags  = hungphat_opt("proj_{$p}_tags", $p_def['tags']);
                    $p_img   = hungphat_opt("proj_{$p}_image", '');
                    $tag_arr = array_map('trim', explode(',', $p_tags));
                ?>
                    <div class="portfolio-card" data-category="<?php echo esc_attr($p_def['filter']); ?>">
                        <div class="portfolio-thumb <?php echo empty($p_img) ? esc_attr($p_def['bg']) : ''; ?>" style="<?php echo !empty($p_img) ? 'background: #0d0c22; overflow: hidden;' : ''; ?>">
                            <?php if (!empty($p_img)): ?>
                                <img src="<?php echo esc_url($p_img); ?>" alt="<?php echo esc_attr($p_name); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            <?php else: ?>
                                <div class="thumb-device">
                                    <div class="device-screen">
                                        <div class="device-bar"><span></span><span></span><span></span></div>
                                        <div class="device-content">
                                            <span class="preview-brand"><?php echo esc_html($p_cat); ?></span>
                                            <h4><?php echo esc_html($p_name); ?></h4>
                                            <span class="preview-price"><?php echo esc_html($p_met); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="portfolio-overlay">
                                <button class="btn-preview-demo" 
                                        data-title="<?php echo esc_attr($p_name); ?>" 
                                        data-cat="<?php echo esc_attr($p_cat); ?>" 
                                        data-metrics="<?php echo esc_attr($p_met); ?>" 
                                        data-desc="<?php echo esc_attr($p_desc); ?>"
                                        <?php if (!empty($p_img)): ?>data-img="<?php echo esc_url($p_img); ?>"<?php endif; ?>>
                                    Xem Demo
                                </button>
                            </div>
                        </div>
                        <div class="portfolio-info">
                            <div class="portfolio-cat"><?php echo esc_html($p_cat); ?></div>
                            <h4 class="portfolio-name"><?php echo esc_html($p_name); ?></h4>
                            <p class="portfolio-brief"><?php echo esc_html($p_desc); ?></p>
                            <div class="portfolio-tags">
                                <?php foreach ($tag_arr as $tg): if (empty($tg)) continue; ?>
                                    <span><?php echo esc_html($tg); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="portfolio-bottom-action text-center">
                <a href="#tu-van" class="btn btn-primary btn-large">
                    <span>Bạn Cần Giao Diện Độc Quyền Cho Riêng Mình? Liên Hệ Ngay</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 6. QUY TRÌNH LÀM VIỆC (PROCESS) -->
    <section class="section process-section" id="quy-trinh">
        <div class="container">
            <div class="section-header text-center">
                <div class="section-tag">TIÊU CHUẨN KỸ THUẬT</div>
                <h2 class="section-title"><?php echo esc_html($process_title); ?></h2>
                <p class="section-desc max-w-700"><?php echo esc_html($process_sub); ?></p>
            </div>

            <div class="process-timeline">
                <?php
                $step_defaults = [
                    1 => ['title' => 'Khảo Sát & Tư Vấn', 'time' => '1 - 2 Ngày', 'desc' => 'Tiếp nhận yêu cầu, phân tích ngành hàng, đối thủ cạnh tranh và tư vấn cấu trúc sitemap tối ưu chuyển đổi.'],
                    2 => ['title' => 'Thiết Kế UI/UX Bản Vẽ', 'time' => '2 - 3 Ngày', 'desc' => 'Phác thảo Wireframe và thiết kế bản vẽ giao diện Figma độc quyền theo đúng màu sắc nhận diện thương hiệu.'],
                    3 => ['title' => 'Lập Trình & Tối Ưu Tốc Độ', 'time' => '3 - 5 Ngày', 'desc' => 'Lập trình các tính năng, tối ưu mã nguồn chuẩn W3C, nén ảnh thế hệ mới, cấu hình chuẩn SEO Google Onpage.'],
                    4 => ['title' => 'Kiểm Thử & Đánh Giá', 'time' => '1 - 2 Ngày', 'desc' => 'Chạy thử nghiệm trên 15+ dòng điện thoại, máy tính bảng và các trình duyệt (Chrome, Safari, Edge) để đảm bảo không lỗi.'],
                    5 => ['title' => 'Bàn Giao & Hướng Dẫn', 'time' => '1 Ngày', 'desc' => 'Bàn giao toàn bộ source code và tài khoản quản trị. Hướng dẫn 1:1 và cung cấp video hướng dẫn quản trị chi tiết.'],
                    6 => ['title' => 'Bảo Hành & Đồng Hành', 'time' => 'Vĩnh Viễn', 'desc' => 'Bảo hành trọn đời mã nguồn, sao lưu tự động định kỳ hàng ngày và hỗ trợ kỹ thuật nhanh chóng qua hotline 24/7.']
                ];

                for ($s = 1; $s <= 6; $s++):
                    $st_def   = $step_defaults[$s];
                    $st_title = hungphat_opt("step_{$s}_title", $st_def['title']);
                    $st_time  = hungphat_opt("step_{$s}_time", $st_def['time']);
                    $st_desc  = hungphat_opt("step_{$s}_desc", $st_def['desc']);
                ?>
                    <div class="process-step">
                        <div class="step-badge">0<?php echo $s; ?></div>
                        <h3 class="step-title"><?php echo esc_html($st_title); ?></h3>
                        <p class="step-desc"><?php echo esc_html($st_desc); ?></p>
                        <span class="step-time"><?php echo esc_html($st_time); ?></span>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- Guarantee Box -->
            <div class="guarantee-box">
                <div class="guarantee-content">
                    <h4>Cam Kết Vàng Từ Hưng Phát Ads</h4>
                    <p><?php echo esc_html($guarantee_text); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. LIÊN HỆ & FORM ĐĂNG KÝ TƯ VẤN (CONTACT & FORM) -->
    <section class="section contact-section" id="lien-he">
        <div class="container" id="tu-van">
            <div class="contact-card-wrapper">
                <div class="contact-info-col">
                    <div class="section-tag text-white-tag">LIÊN HỆ TRỰC TIẾP</div>
                    <h2 class="contact-title"><?php echo esc_html($contact_title); ?></h2>
                    <p class="contact-desc"><?php echo nl2br(esc_html($contact_desc)); ?></p>

                    <div class="contact-details-list">
                        <div class="detail-item">
                            <div>
                                <span class="detail-lbl">Hotline Tư Vấn (24/7)</span>
                                <a href="tel:<?php echo esc_attr($clean_hotline); ?>" class="detail-val"><?php echo esc_html($hotline); ?></a>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div>
                                <span class="detail-lbl">Email Tiếp Nhận Dự Án</span>
                                <a href="mailto:<?php echo esc_attr($email); ?>" class="detail-val"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div>
                                <span class="detail-lbl">Trụ Sở Văn Phòng</span>
                                <span class="detail-val-text"><?php echo esc_html($address); ?></span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div>
                                <span class="detail-lbl">Thời Gian Làm Việc</span>
                                <span class="detail-val-text"><?php echo esc_html($working_hours); ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($contact_qr)): ?>
                        <div class="contact-qr-box" style="margin-top: 20px; background: rgba(255,255,255,0.06); padding: 15px; border-radius: 12px; display: flex; align-items: center; gap: 15px; border: 1px solid rgba(255,255,255,0.12);">
                            <img src="<?php echo esc_url($contact_qr); ?>" alt="QR Code Zalo Hưng Phát Ads" style="width: 75px; height: 75px; object-fit: contain; border-radius: 6px; background: #fff; padding: 4px;">
                            <div>
                                <strong style="color: #fff; font-size: 14px; display: block; margin-bottom: 3px;">Quét Mã Zalo Trực Tiếp</strong>
                                <span style="color: #94a3b8; font-size: 12px; line-height: 1.4; display: block;">Mở camera điện thoại quét mã QR để trò chuyện trực tiếp cùng chuyên viên Hưng Phát Ads.</span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Trust indicators -->
                    <div class="contact-trust-box">
                        <div class="trust-badge-item">
                            <span>Bảo mật thông tin 100%</span>
                        </div>
                        <div class="trust-badge-item">
                            <span>Tư vấn giải pháp miễn phí</span>
                        </div>
                        <div class="trust-badge-item">
                            <span>Báo giá minh bạch, trọn gói</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Registration Form -->
                <div class="contact-form-col">
                    <div class="form-wrapper">
                        <div class="form-header">
                            <h3 class="form-title"><?php echo esc_html($form_title); ?></h3>
                            <p class="form-subtitle"><?php echo esc_html($form_subtitle); ?></p>
                        </div>

                        <form id="hungphat-consultation-form" class="consultation-form" novalidate>
                            <!-- Alert message container -->
                            <div id="form-alert" class="form-alert" style="display: none;"></div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="lead_fullname" class="form-label">Họ và tên của bạn <span class="text-required">*</span></label>
                                    <input type="text" id="lead_fullname" name="fullname" class="form-control" placeholder="Nguyễn Văn A" required>
                                </div>

                                <div class="form-group">
                                    <label for="lead_phone" class="form-label">Số điện thoại / Zalo <span class="text-required">*</span></label>
                                    <input type="tel" id="lead_phone" name="phone" class="form-control" placeholder="0987 654 321" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="lead_email" class="form-label">Email liên hệ (nếu có)</label>
                                    <input type="email" id="lead_email" name="email" class="form-control" placeholder="example@gmail.com">
                                </div>

                                <div class="form-group">
                                    <label for="lead_service" class="form-label">Dịch vụ bạn quan tâm</label>
                                    <select id="lead_service" name="service" class="form-control">
                                        <option value="Web Doanh Nghiệp">Thiết Kế Web Doanh Nghiệp</option>
                                        <option value="Web Bán Hàng (E-Commerce)">Thiết Kế Web Bán Hàng E-Commerce</option>
                                        <option value="Landing Page Chạy Ads">Thiết Kế Landing Page Chạy Ads</option>
                                        <option value="Lập Trình Web Theo Yêu Cầu">Lập Trình Web Theo Yêu Cầu</option>
                                        <option value="Tối Ưu SEO & Tốc Độ Web">Tối Ưu SEO & Tốc Độ Website</option>
                                        <option value="Bảo Trì & Quản Trị Website">Bảo Trì & Quản Trị Trọn Gói</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lead_budget" class="form-label">Ngân sách dự kiến</label>
                                <select id="lead_budget" name="budget" class="form-control">
                                    <option value="Dưới 5 triệu (Gói Khởi Nghiệp)">Dưới 5 triệu (Gói Khởi Nghiệp / Landing Page)</option>
                                    <option value="5 - 10 triệu (Gói Doanh Nghiệp)" selected>5 - 10 triệu (Gói Doanh Nghiệp chuẩn SEO)</option>
                                    <option value="10 - 20 triệu (Gói Bán Hàng VIP)">10 - 20 triệu (Gói Bán Hàng VIP E-Commerce)</option>
                                    <option value="Trên 20 triệu (Dự án theo yêu cầu)">Trên 20 triệu (Dự án đặc thù / Web App)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lead_notes" class="form-label">Ghi chú hoặc yêu cầu tính năng cụ thể</label>
                                <textarea id="lead_notes" name="notes" rows="3" class="form-control" placeholder="Mô tả ngành nghề, màu sắc yêu cầu hoặc đường link website bạn thích..."></textarea>
                            </div>

                            <button type="submit" id="btn-submit-lead" class="btn btn-primary btn-large btn-block btn-glow">
                                <span class="btn-text">GỬI YÊU CẦU TƯ VẤN NGAY</span>
                                <span class="btn-spinner" style="display: none;">Đang gửi...</span>
                            </button>

                            <p class="form-privacy-note">
                                Chúng tôi cam kết bảo mật 100% thông tin cá nhân của bạn. Không gửi spam.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
