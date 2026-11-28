<?php
/**
 * Lớp điều khiển Khu vực Quản trị (AdminController)
 * Thành viên phụ trách: Phương Quỳnh
 */
class AdminController
{
    public function admin_dashboard(): void
    {
        // TODO: Phương Quỳnh triển khai thống kê doanh thu, đơn hàng
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function admin_products(): void
    {
        // TODO: Phương Quỳnh triển khai quản lý danh sách sản phẩm
        include __DIR__ . '/../views/admin/products.php';
    }

    public function admin_variants(): void
    {
        // TODO: Phương Quỳnh triển khai quản lý biến thể Size - Màu
        include __DIR__ . '/../views/admin/variants.php';
    }

    public function admin_orders(): void
    {
        // TODO: Phương Quỳnh triển khai quản lý đơn hàng
        include __DIR__ . '/../views/admin/orders.php';
    }

    public function admin_order_detail(): void
    {
        // TODO: Phương Quỳnh triển khai xem chi tiết đơn hàng
        include __DIR__ . '/../views/admin/order_detail.php';
    }
}
