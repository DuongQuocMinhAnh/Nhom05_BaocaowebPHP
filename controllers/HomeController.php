<?php
/**
 * Lớp điều khiển Khách hàng (HomeController)
 * Thành viên phụ trách: Phương Quỳnh
 */
class HomeController
{
    public function home(): void
    {
        // TODO: Phương Quỳnh triển khai gọi Model và truyền dữ liệu ra view
        include __DIR__ . '/../views/client/home.php';
    }

    public function collection(): void
    {
        // TODO: Phương Quỳnh triển khai lọc sản phẩm theo cat, sub, keyword
        include __DIR__ . '/../views/client/collection.php';
    }

    public function detail(): void
    {
        // TODO: Phương Quỳnh triển khai xem chi tiết sản phẩm theo id
        include __DIR__ . '/../views/client/product_detail.php';
    }
}
