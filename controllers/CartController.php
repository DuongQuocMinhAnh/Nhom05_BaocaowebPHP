<?php
/**
 * Lớp điều khiển Giỏ hàng & Đặt hàng (CartController)
 * Thành viên phụ trách: Phương Quỳnh
 */
class CartController
{
    public function cart(): void
    {
        // TODO: Phương Quỳnh triển khai xem giỏ hàng
        include __DIR__ . '/../views/client/cart.php';
    }

    public function add_to_cart(): void
    {
        // TODO: Phương Quỳnh triển khai thêm biến thể vào giỏ hàng
    }

    public function update_cart(): void
    {
        // TODO: Phương Quỳnh triển khai cập nhật số lượng giỏ hàng
    }

    public function remove_cart(): void
    {
        // TODO: Phương Quỳnh triển khai xóa sản phẩm khỏi giỏ hàng
    }

    public function checkout(): void
    {
        // TODO: Phương Quỳnh triển khai trang thanh toán
        include __DIR__ . '/../views/client/checkout.php';
    }

    public function place_order(): void
    {
        // TODO: Phương Quỳnh triển khai lưu đơn hàng vào CSDL
    }

    public function my_orders(): void
    {
        // TODO: Phương Quỳnh triển khai xem lịch sử đơn hàng
        include __DIR__ . '/../views/client/my_orders.php';
    }
}
