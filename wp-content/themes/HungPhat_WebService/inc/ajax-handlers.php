<?php
/**
 * AJAX Handlers for Consultation Form & Database Management
 * Theme: HungPhat WebService
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * =========================================================================
 * CẤU HÌNH GỬI DỮ LIỆU VỀ GOOGLE SHEETS TRỰC TIẾP TRONG CODE:
 * =========================================================================
 * Bạn có thể tự chỉnh sửa URL Webhook Google Apps Script của bạn ở đây.
 * Nếu không sử dụng, hãy giữ nguyên giá trị rỗng: ''
 * Khi có URL, khách điền form sẽ tự động được gửi 1 bản ghi về Google Sheet.
 */
define('HUNGPHAT_GOOGLE_SHEET_WEBHOOK_URL', 'https://script.google.com/macros/s/AKfycbyALBwz34pC4xnDWZiU98DSAAv6peoSo4kL6EntJqzxAdtFgM0w6HfHQxfbfFK-1fI/exec');

// Frontend Consultation Submission Handler
add_action('wp_ajax_hungphat_submit_consultation', 'hungphat_handle_ajax_consultation');
add_action('wp_ajax_nopriv_hungphat_submit_consultation', 'hungphat_handle_ajax_consultation');

function hungphat_handle_ajax_consultation() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'hungphat_lead_nonce')) {
        wp_send_json_error([
            'message' => 'Lỗi xác thực bảo mật (Token không hợp lệ). Vui lòng tải lại trang và thử lại.'
        ]);
    }

    $fullname   = isset($_POST['fullname']) ? sanitize_text_field(trim($_POST['fullname'])) : '';
    $phone      = isset($_POST['phone']) ? sanitize_text_field(trim($_POST['phone'])) : '';
    $email      = isset($_POST['email']) ? sanitize_email(trim($_POST['email'])) : '';
    $service    = isset($_POST['service']) ? sanitize_text_field(trim($_POST['service'])) : '';
    $budget     = isset($_POST['budget']) ? sanitize_text_field(trim($_POST['budget'])) : '';
    $notes      = isset($_POST['notes']) ? sanitize_textarea_field(trim($_POST['notes'])) : '';
    $client_ip  = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '127.0.0.1';
    $created_at = current_time('mysql');

    // Validation
    if (empty($fullname)) {
        wp_send_json_error(['message' => 'Vui lòng nhập họ và tên của bạn.']);
    }

    if (empty($phone)) {
        wp_send_json_error(['message' => 'Vui lòng cung cấp số điện thoại liên hệ.']);
    }

    // Check phone pattern
    $clean_phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($clean_phone) < 9 || strlen($clean_phone) > 12) {
        wp_send_json_error(['message' => 'Số điện thoại không đúng định dạng. Vui lòng kiểm tra lại.']);
    }

    // 1. Lưu an toàn vào cơ sở dữ liệu MySQL WordPress
    global $wpdb;
    $table_name = $wpdb->prefix . 'hungphat_consultations';

    $inserted = $wpdb->insert(
        $table_name,
        [
            'fullname'   => $fullname,
            'phone'      => $phone,
            'email'      => $email,
            'service'    => $service ?: 'Tư vấn thiết kế website',
            'budget'     => $budget ?: 'Chưa chọn',
            'notes'      => $notes,
            'status'     => 'new',
            'created_at' => $created_at
        ],
        ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']
    );

    if ($inserted === false) {
        wp_send_json_error(['message' => 'Có lỗi xảy ra khi lưu thông tin vào hệ thống. Vui lòng thử lại hoặc gọi hotline trực tiếp.']);
    }

    $lead_id = $wpdb->insert_id;

    // 2. Gửi về Google Sheets nếu bạn đã điền URL Webhook trong code ở trên
    if (defined('HUNGPHAT_GOOGLE_SHEET_WEBHOOK_URL') && !empty(HUNGPHAT_GOOGLE_SHEET_WEBHOOK_URL)) {
        $sheet_payload = [
            'timestamp' => $created_at,
            'fullname'  => $fullname,
            'phone'     => $phone,
            'email'     => $email,
            'service'   => $service ?: 'Tư vấn thiết kế website',
            'budget'    => $budget ?: 'Chưa chọn',
            'notes'     => $notes,
            'status'    => 'Mới'
        ];

        // Gửi HTTP POST bất đồng bộ không làm chậm trải nghiệm của khách
        wp_remote_post(HUNGPHAT_GOOGLE_SHEET_WEBHOOK_URL, [
            'method'      => 'POST',
            'timeout'     => 8,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => false,
            'headers'     => [
                'Content-Type' => 'application/json; charset=utf-8'
            ],
            'body'        => wp_json_encode($sheet_payload)
        ]);
    }

    wp_send_json_success([
        'message' => ' Cảm ơn quý khách ' . esc_html($fullname) . '! Hưng Phát Ads đã tiếp nhận thông tin và chuyên viên tư vấn sẽ liên hệ lại trong vòng 15 phút.',
        'lead_id' => $lead_id
    ]);
}
