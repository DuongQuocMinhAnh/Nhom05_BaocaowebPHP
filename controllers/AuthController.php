<?php
/**
 * Lớp điều khiển Xác thực (AuthController)
 * Thành viên phụ trách: Phương Quỳnh
 */
class AuthController
{
    public function login(): void
    {
        // TODO: Phương Quỳnh triển khai hiển thị và xử lý đăng nhập
        include __DIR__ . '/../views/auth/login.php';
    }

    public function register(): void
    {
        // TODO: Phương Quỳnh triển khai hiển thị và xử lý đăng ký
        include __DIR__ . '/../views/auth/register.php';
    }

    public function logout(): void
    {
        // TODO: Phương Quỳnh triển khai hủy session đăng nhập
        unset($_SESSION['user']);
        header('Location: ' . BASE_URL);
        exit;
    }
}
