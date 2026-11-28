<?php
/**
 * ĐỒ ÁN LẬP TRÌNH WEB PHP - NHÓM 05
 * Thành viên phụ trách: Minh Anh
 * File: index.php (Front Controller điều hướng toàn bộ website)
 */

// 1. Khởi động session để lưu đăng nhập và giỏ hàng
session_start();

// 2. Bật báo lỗi để tiện sửa code khi lập trình
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 3. Khai báo đường dẫn gốc
define('BASE_URL', str_replace('\\', '/', $_SERVER['SCRIPT_NAME']));

// 4. Nạp file kết nối database và 4 Controller của Phương Quỳnh
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/CartController.php';
require_once __DIR__ . '/controllers/AdminController.php';

// 5. Lấy hành động (action) từ thanh địa chỉ URL, mặc định là 'home'
$action = $_GET['action'] ?? 'home';

// Hỗ trợ thêm trường hợp dùng ?route=/... từ giao diện cũ
if (isset($_GET['route'])) {
    $route = trim($_GET['route'], '/');
    $action = ($route === '') ? 'home' : str_replace('/', '_', $route);
    if ($action === 'product') $action = 'detail';
    if ($action === 'my-orders') $action = 'my_orders';
}

// 6. Điều hướng đến đúng Controller và Action bằng switch-case
switch ($action) {

    // --- KHU VỰC KHÁCH HÀNG (HomeController) ---
    case 'home':
        $controller = new HomeController();
        $controller->home();
        break;

    case 'collection':
        $controller = new HomeController();
        $controller->collection();
        break;

    case 'detail':
        $controller = new HomeController();
        $controller->detail();
        break;

    // --- TÀI KHOẢN (AuthController) ---
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    // --- GIỎ HÀNG & ĐẶT HÀNG (CartController) ---
    case 'cart':
        $controller = new CartController();
        $controller->cart();
        break;

    case 'add_to_cart':
        $controller = new CartController();
        $controller->add_to_cart();
        break;

    case 'update_cart':
        $controller = new CartController();
        $controller->update_cart();
        break;

    case 'remove_cart':
        $controller = new CartController();
        $controller->remove_cart();
        break;

    case 'checkout':
        $controller = new CartController();
        $controller->checkout();
        break;

    case 'place_order':
        $controller = new CartController();
        $controller->place_order();
        break;

    case 'my_orders':
        $controller = new CartController();
        $controller->my_orders();
        break;

    // --- QUẢN TRỊ ADMIN (AdminController - Bắt buộc kiểm tra quyền admin) ---
    case 'admin_dashboard':
    case 'admin_products':
    case 'admin_variants':
    case 'admin_orders':
    case 'admin_order_detail':
        // Kiểm tra xem đã đăng nhập và có phải là admin chưa
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $admin = new AdminController();
        if ($action === 'admin_dashboard')    $admin->admin_dashboard();
        if ($action === 'admin_products')     $admin->admin_products();
        if ($action === 'admin_variants')     $admin->admin_variants();
        if ($action === 'admin_orders')       $admin->admin_orders();
        if ($action === 'admin_order_detail') $admin->admin_order_detail();
        break;

    // --- TRƯỜNG HỢP NHẬP SAI LINK -> TỰ ĐỘNG VỀ TRANG CHỦ ---
    default:
        $controller = new HomeController();
        $controller->home();
        break;
}
