<?php
/**
 * Consultation Leads Manager for WordPress Admin
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register Admin Menu
add_action('admin_menu', 'hungphat_register_leads_menu');
function hungphat_register_leads_menu() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hungphat_consultations';
    
    // Count new leads for notification bubble
    $new_count = 0;
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
        $new_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'new'");
    }

    $menu_title = 'Khách Hàng Tư Vấn';
    if ($new_count > 0) {
        $menu_title .= sprintf(' <span class="awaiting-mod update-plugins count-%1$d"><span class="pending-count">%1$d</span></span>', $new_count);
    }

    add_menu_page(
        'Khách Hàng Đăng Ký Tư Vấn',
        $menu_title,
        'manage_options',
        'hungphat-leads',
        'hungphat_render_leads_page',
        'dashicons-id-alt',
        25
    );
}

// Handle Export CSV
add_action('admin_init', 'hungphat_handle_export_leads_csv');
function hungphat_handle_export_leads_csv() {
    if (isset($_GET['page']) && $_GET['page'] === 'hungphat-leads' && isset($_GET['action']) && $_GET['action'] === 'export_csv') {
        if (!current_user_can('manage_options')) {
            wp_die('Bạn không có quyền thực hiện thao tác này.');
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'hungphat_consultations';
        $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC", ARRAY_A);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=hungphat-leads-' . date('Y-m-d-His') . '.csv');

        $output = fopen('php://output', 'w');
        // Add BOM for UTF-8 in Excel
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, ['ID', 'Họ tên', 'Số điện thoại', 'Email', 'Dịch vụ quan tâm', 'Ngân sách', 'Ghi chú', 'Trạng thái', 'Ngày gửi']);

        $status_labels = [
            'new' => 'Mới',
            'contacted' => 'Đang liên hệ',
            'completed' => 'Đã chốt hợp đồng',
            'cancelled' => 'Đã hủy'
        ];

        foreach ($leads as $lead) {
            fputcsv($output, [
                $lead['id'],
                $lead['fullname'],
                $lead['phone'],
                $lead['email'],
                $lead['service'],
                $lead['budget'],
                $lead['notes'],
                isset($status_labels[$lead['status']]) ? $status_labels[$lead['status']] : $lead['status'],
                date('H:i d/m/Y', strtotime($lead['created_at']))
            ]);
        }

        fclose($output);
        exit;
    }
}

// Render Admin Leads Page
function hungphat_render_leads_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hungphat_consultations';

    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && check_admin_referer('delete_lead_' . $_GET['id'])) {
        $del_id = intval($_GET['id']);
        $wpdb->delete($table_name, ['id' => $del_id]);
        echo '<div class="notice notice-success is-dismissible"><p>Đã xóa yêu cầu tư vấn thành công.</p></div>';
    }

    // Handle status update via GET
    if (isset($_GET['action']) && $_GET['action'] === 'update_status' && isset($_GET['id']) && isset($_GET['status']) && check_admin_referer('status_lead_' . $_GET['id'])) {
        $lead_id = intval($_GET['id']);
        $new_status = sanitize_text_field($_GET['status']);
        $wpdb->update($table_name, ['status' => $new_status], ['id' => $lead_id]);
        echo '<div class="notice notice-success is-dismissible"><p>Đã cập nhật trạng thái thành công.</p></div>';
    }

    // Statistics
    $total_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    $new_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'new'");
    $contacted_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'contacted'");
    $completed_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'completed'");

    // Filter and search
    $status_filter = isset($_GET['status_filter']) ? sanitize_text_field($_GET['status_filter']) : '';
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    $where = [];
    if (!empty($status_filter)) {
        $where[] = $wpdb->prepare("status = %s", $status_filter);
    }
    if (!empty($search_query)) {
        $like = '%' . $wpdb->esc_like($search_query) . '%';
        $where[] = $wpdb->prepare("(fullname LIKE %s OR phone LIKE %s OR email LIKE %s OR service LIKE %s)", $like, $like, $like, $like);
    }

    $where_sql = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
    $leads = $wpdb->get_results("SELECT * FROM $table_name $where_sql ORDER BY id DESC LIMIT 100");
    ?>
    <div class="wrap hungphat-admin-wrap">
        <h1 class="wp-heading-inline">
            Danh Sách Khách Hàng Đăng Ký Tư Vấn – Hưng Phát Ads
        </h1>
        <a href="<?php echo esc_url(admin_url('admin.php?page=hungphat-leads&action=export_csv')); ?>" class="page-title-action" style="background: #10b981; color: #fff; border-color: #10b981; font-weight: 600; padding: 4px 16px; border-radius: 999px;">
            Xuất File CSV / Excel
        </a>
        <hr class="wp-header-end">

        <!-- Stat Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin: 20px 0;">
            <div style="background: #fff; border-left: 4px solid #2563eb; padding: 16px 20px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="font-size: 13px; color: #64748b; font-weight: 500;">TỔNG YÊU CẦU</div>
                <div style="font-size: 28px; font-weight: 700; color: #1e293b; margin-top: 4px;"><?php echo number_format($total_count); ?></div>
            </div>
            <div style="background: #fff; border-left: 4px solid #f59e0b; padding: 16px 20px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="font-size: 13px; color: #64748b; font-weight: 500;">YÊU CẦU MỚI (CHƯA XỬ LÝ)</div>
                <div style="font-size: 28px; font-weight: 700; color: #d97706; margin-top: 4px;"><?php echo number_format($new_count); ?></div>
            </div>
            <div style="background: #fff; border-left: 4px solid #06b6d4; padding: 16px 20px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="font-size: 13px; color: #64748b; font-weight: 500;">ĐANG TƯ VẤN</div>
                <div style="font-size: 28px; font-weight: 700; color: #0891b2; margin-top: 4px;"><?php echo number_format($contacted_count); ?></div>
            </div>
            <div style="background: #fff; border-left: 4px solid #10b981; padding: 16px 20px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="font-size: 13px; color: #64748b; font-weight: 500;">ĐÃ CHỐT HỢP ĐỒNG</div>
                <div style="font-size: 28px; font-weight: 700; color: #059669; margin-top: 4px;"><?php echo number_format($completed_count); ?></div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div style="background: #fff; padding: 14px 18px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px;">
            <ul class="subsubsub" style="margin: 0; padding: 0;">
                <li><a href="<?php echo admin_url('admin.php?page=hungphat-leads'); ?>" class="<?php echo empty($status_filter) ? 'current' : ''; ?>">Tất cả <span class="count">(<?php echo $total_count; ?>)</span></a> |</li>
                <li><a href="<?php echo admin_url('admin.php?page=hungphat-leads&status_filter=new'); ?>" class="<?php echo $status_filter === 'new' ? 'current' : ''; ?>">Mới <span class="count">(<?php echo $new_count; ?>)</span></a> |</li>
                <li><a href="<?php echo admin_url('admin.php?page=hungphat-leads&status_filter=contacted'); ?>" class="<?php echo $status_filter === 'contacted' ? 'current' : ''; ?>">Đang liên hệ <span class="count">(<?php echo $contacted_count; ?>)</span></a> |</li>
                <li><a href="<?php echo admin_url('admin.php?page=hungphat-leads&status_filter=completed'); ?>" class="<?php echo $status_filter === 'completed' ? 'current' : ''; ?>">Đã chốt <span class="count">(<?php echo $completed_count; ?>)</span></a></li>
            </ul>

            <form method="get" style="display: flex; gap: 8px;">
                <input type="hidden" name="page" value="hungphat-leads">
                <?php if (!empty($status_filter)): ?>
                    <input type="hidden" name="status_filter" value="<?php echo esc_attr($status_filter); ?>">
                <?php endif; ?>
                <input type="search" name="s" value="<?php echo esc_attr($search_query); ?>" placeholder="Tìm tên, SĐT, email..." style="width: 240px;">
                <button type="submit" class="button button-primary">Tìm kiếm</button>
            </form>
        </div>

        <!-- Leads Table -->
        <table class="wp-list-table widefat fixed striped table-view-list" style="box-shadow: 0 1px 3px rgba(0,0,0,0.05); border-radius: 6px; overflow: hidden;">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px;">ID</th>
                    <th scope="col" style="width: 180px;">Họ và Tên</th>
                    <th scope="col" style="width: 140px;">Số Điện Thoại</th>
                    <th scope="col" style="width: 170px;">Email</th>
                    <th scope="col" style="width: 160px;">Dịch Vụ Quan Tâm</th>
                    <th scope="col" style="width: 130px;">Ngân Sách</th>
                    <th scope="col">Ghi Chú Yêu Cầu</th>
                    <th scope="col" style="width: 140px;">Trạng Thái</th>
                    <th scope="col" style="width: 140px;">Thời Gian</th>
                    <th scope="col" style="width: 90px; text-align: center;">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($leads)): ?>
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 30px; color: #64748b;">
                            Chưa có dữ liệu yêu cầu tư vấn nào phù hợp.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($leads as $item): ?>
                        <tr>
                            <td><strong>#<?php echo esc_html($item->id); ?></strong></td>
                            <td>
                                <strong style="color: #1e293b;"><?php echo esc_html($item->fullname); ?></strong>
                            </td>
                            <td>
                                <a href="tel:<?php echo esc_attr($item->phone); ?>" style="font-weight: 600; color: #2563eb; text-decoration: none;">
                                    <?php echo esc_html($item->phone); ?>
                                </a>
                            </td>
                            <td>
                                <?php if (!empty($item->email)): ?>
                                    <a href="mailto:<?php echo esc_attr($item->email); ?>" style="color: #475569; text-decoration: none;">
                                        <?php echo esc_html($item->email); ?>
                                    </a>
                                <?php else: ?>
                                    <span style="color: #94a3b8;">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; display: inline-block;">
                                    <?php echo esc_html($item->service ?: 'Tư vấn tổng quát'); ?>
                                </span>
                            </td>
                            <td>
                                <span style="color: #059669; font-weight: 600; font-size: 13px;">
                                    <?php echo esc_html($item->budget ?: 'Chưa xác định'); ?>
                                </span>
                            </td>
                            <td style="color: #334155; font-size: 13px;">
                                <?php echo nl2br(esc_html($item->notes ?: '—')); ?>
                            </td>
                            <td>
                                <?php
                                $status_map = [
                                    'new' => ['label' => 'Mới gửi', 'bg' => '#fef3c7', 'color' => '#b45309'],
                                    'contacted' => ['label' => 'Đang liên hệ', 'bg' => '#e0e7ff', 'color' => '#4338ca'],
                                    'completed' => ['label' => 'Đã chốt HĐ', 'bg' => '#d1fae5', 'color' => '#065f46'],
                                    'cancelled' => ['label' => 'Đã hủy', 'bg' => '#fee2e2', 'color' => '#991b1b']
                                ];
                                $cur = isset($status_map[$item->status]) ? $status_map[$item->status] : ['label' => $item->status, 'bg' => '#f1f5f9', 'color' => '#475569'];
                                ?>
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <span style="background: <?php echo $cur['bg']; ?>; color: <?php echo $cur['color']; ?>; padding: 3px 8px; border-radius: 999px; font-size: 11px; font-weight: 700; text-align: center; width: fit-content;">
                                        <?php echo esc_html($cur['label']); ?>
                                    </span>
                                    <select onchange="window.location.href = this.value;" style="font-size: 11px; height: 26px; padding: 0 4px; margin-top: 4px;">
                                        <option value="">-- Đổi trạng thái --</option>
                                        <option value="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hungphat-leads&action=update_status&id=' . $item->id . '&status=new'), 'status_lead_' . $item->id)); ?>">Mới gửi</option>
                                        <option value="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hungphat-leads&action=update_status&id=' . $item->id . '&status=contacted'), 'status_lead_' . $item->id)); ?>">Đang liên hệ</option>
                                        <option value="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hungphat-leads&action=update_status&id=' . $item->id . '&status=completed'), 'status_lead_' . $item->id)); ?>">Đã chốt</option>
                                        <option value="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hungphat-leads&action=update_status&id=' . $item->id . '&status=cancelled'), 'status_lead_' . $item->id)); ?>">Đã hủy</option>
                                    </select>
                                </div>
                            </td>
                            <td style="color: #64748b; font-size: 12px;">
                                <?php echo esc_html(date('H:i d/m/Y', strtotime($item->created_at))); ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hungphat-leads&action=delete&id=' . $item->id), 'delete_lead_' . $item->id)); ?>" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu tư vấn này?');" 
                                   style="color: #ef4444; font-weight: 600; text-decoration: none;" title="Xóa">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
