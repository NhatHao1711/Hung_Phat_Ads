# Hưng Phát Ads - Website Dịch Vụ Thiết Kế Web & Giải Pháp Chuyển Đổi Số

Website giới thiệu dịch vụ thiết kế website doanh nghiệp chuyên nghiệp, chuẩn SEO Google, tối ưu trải nghiệm người dùng (UX/UI) và tỷ lệ chuyển đổi đơn hàng cho **Công Ty TNHH Phát Triển Dịch Vụ Công Nghệ Hưng Phát**.

---

## 🚀 Công Nghệ Sử Dụng

- **CMS Nền Tảng:** WordPress 6.x
- **Theme Tùy Biến (Custom Theme):** `HungPhat_WebService` (Tự xây dựng chuẩn WordPress Codex, không phụ thuộc page builder nặng nề)
- **Front-end:** HTML5, CSS3 hiện đại, Vanilla JavaScript, Font Awesome 6.x, Google Fonts (Montserrat & Inter hỗ trợ đầy đủ tiếng Việt)
- **Cơ Sở Dữ Liệu:** MySQL / MariaDB (utf8mb4)
- **Tính năng nổi bật:**
  - Giao diện Responsive 100% hiển thị hoàn hảo trên Mobile, Tablet, PC
  - Hiệu ứng số liệu tăng dần (Counter Animation) và tương tác trực quan
  - Khối đối tác xác thực chính thức của Google & các thương hiệu lớn
  - Hệ thống Form tư vấn & quản lý Leads tự động
  - Tối ưu tốc độ tải trang Google PageSpeed

---

## 💻 Hướng Dẫn Cài Đặt Trên Localhost (XAMPP)

1. **Clone mã nguồn về thư mục `htdocs` của XAMPP:**
   ```bash
   git clone https://github.com/NhatHao1711/Hung_Phat_Ads.git C:/xampp/htdocs/Hung_Phat_Ads
   ```

2. **Khởi động dịch vụ:**
   - Mở **XAMPP Control Panel** và nhấn **Start** cho cả **Apache** và **MySQL**.

3. **Tạo và Import cơ sở dữ liệu:**
   - Mở trình duyệt truy cập `http://localhost/phpmyadmin/`.
   - Tạo cơ sở dữ liệu mới tên là: `hungphat_ads` (Collation: `utf8mb4_unicode_ci` hoặc `utf8mb4_general_ci`).
   - Nhấn **Import** và chọn file [`hungphat_ads.sql`](hungphat_ads.sql) trong thư mục gốc của dự án để nhập dữ liệu.

4. **Kiểm tra file cấu hình `wp-config.php`:**
   ```php
   define( 'DB_NAME', 'hungphat_ads' );
   define( 'DB_USER', 'root' );
   define( 'DB_PASSWORD', '' );
   define( 'DB_HOST', 'localhost' );
   ```

5. **Trải nghiệm website:**
   - Trang chủ: `http://localhost/Hung_Phat_Ads/`
   - Quản trị WordPress Admin: `http://localhost/Hung_Phat_Ads/wp-admin/`

---

## 📁 Cấu Trúc Thư Mục Chính

```
Hung_Phat_Ads/
├── wp-content/
│   ├── themes/
│   │   └── HungPhat_WebService/   # Theme tùy biến chính
│   │       ├── assets/            # CSS, JS, hình ảnh, icons
│   │       ├── inc/               # Xử lý Ajax, Database, Leads
│   │       ├── front-page.php     # Template trang chủ
│   │       ├── header.php         # Header & navigation
│   │       ├── footer.php         # Footer & liên hệ
│   │       ├── functions.php      # Đăng ký script, options, hook
│   │       └── style.css          # Khai báo thông tin theme
│   └── uploads/                   # Media uploads
├── hungphat_ads.sql               # Bản sao lưu CSDL hoàn chỉnh
├── wp-config.php                  # File cấu hình kết nối DB
└── README.md                      # Hướng dẫn dự án
```
