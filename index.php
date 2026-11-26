<?php
/**
 * TỆP PREVIEW TẠM THỜI (CHỈ DÙNG ĐỂ XEM TRƯỚC GIAO DIỆN TRÊN XAMPP)
 * Khi test xong có thể xóa trắng file này để trả lại trạng thái ban đầu (0 byte).
 */

$route = $_GET['route'] ?? '/';
if ($route === '' || $route[0] !== '/') {
    $route = '/' . ltrim($route, '/');
}

// Dữ liệu mẫu khớp với database/fashion_store.sql
$sampleProducts = [
    [
        'id' => 1,
        'name' => 'Giày Tây Oxford Nam Classic',
        'category' => 'Giày',
        'sub_category' => 'Giày tây',
        'price' => 850000,
        'image' => 'assets/Images/oxford_black.jpg',
        'description' => 'Giày tây da bò cao cấp dáng Oxford sang trọng cho nam giới công sở.',
        'variant_count' => 4,
        'created_at' => '2026-11-20 09:00:00',
        'review_count' => 18,
    ],
    [
        'id' => 2,
        'name' => 'Giày Sneaker Thể Thao Streetwear',
        'category' => 'Giày',
        'sub_category' => 'Giày thể thao',
        'price' => 620000,
        'image' => 'assets/Images/sneaker_white.jpg',
        'description' => 'Giày sneaker phong cách đường phố năng động, đệm êm thoáng khí.',
        'variant_count' => 5,
        'created_at' => '2026-11-21 10:15:00',
        'review_count' => 32,
    ],
    [
        'id' => 3,
        'name' => 'Giày Cao Gót Mũi Nhọn 7cm Nữ',
        'category' => 'Giày',
        'sub_category' => 'Giày nữ',
        'price' => 490000,
        'image' => 'assets/Images/highheel_beige.jpg',
        'description' => 'Giày cao gót tôn dáng quý phái, chất liệu da mềm êm chân.',
        'variant_count' => 3,
        'created_at' => '2026-11-21 14:20:00',
        'review_count' => 24,
    ],
    [
        'id' => 4,
        'name' => 'Dép Quai Ngang Unisex Basic',
        'category' => 'Dép',
        'sub_category' => 'Dép quai ngang',
        'price' => 180000,
        'image' => 'assets/Images/slides_black.jpg',
        'description' => 'Dép quai ngang chống trượt, phong cách tối giản tiện dụng thường ngày.',
        'variant_count' => 3,
        'created_at' => '2026-11-22 08:30:00',
        'review_count' => 41,
    ],
    [
        'id' => 5,
        'name' => 'Dép Sandal Chiến Binh Đi Học',
        'category' => 'Dép',
        'sub_category' => 'Dép sandal',
        'price' => 250000,
        'image' => 'assets/Images/sandal_casual.jpg',
        'description' => 'Sandal học sinh quai dù chắc chắn, thiết kế thanh lịch năng động.',
        'variant_count' => 2,
        'created_at' => '2026-11-22 11:00:00',
        'review_count' => 15,
    ],
    [
        'id' => 6,
        'name' => 'Tấm Sticker Chiikawa & Những Người Bạn Dễ Thương',
        'category' => 'Sticker',
        'sub_category' => 'Sticker hoạt hình',
        'price' => 35000,
        'image' => 'assets/Images/sticker_chiikawa.jpg',
        'description' => 'Tấm hình dán nhân vật Chiikawa Nhật Bản phong cách chibi đáng yêu trang trí sổ tay, phụ kiện.',
        'variant_count' => 1,
        'created_at' => '2026-11-23 09:45:00',
        'review_count' => 56,
    ],
    [
        'id' => 7,
        'name' => 'Set 50 Sticker Meme Mèo Hài Hước Chống Nước',
        'category' => 'Sticker',
        'sub_category' => 'Sticker meme',
        'price' => 45000,
        'image' => 'assets/Images/sticker_cat_meme.jpg',
        'description' => 'Bộ 50 hình dán meme mèo biểu cảm siêu bựa chống nước dán mũ bảo hiểm, vali, laptop, ốp lưng.',
        'variant_count' => 1,
        'created_at' => '2026-11-23 16:00:00',
        'review_count' => 63,
    ],
    [
        'id' => 8,
        'name' => 'Nón Lưỡi Trai Kaki Form Mềm Đen',
        'category' => 'Nón',
        'sub_category' => 'Nón lưỡi trai',
        'price' => 120000,
        'image' => 'assets/Images/cap_black.jpg',
        'description' => 'Mũ lưỡi trai vải kaki wash cao cấp, có khóa cài điều chỉnh kích cỡ.',
        'variant_count' => 2,
        'created_at' => '2026-11-24 10:00:00',
        'review_count' => 27,
    ],
    [
        'id' => 9,
        'name' => 'Nón Bucket Vành Tròn Thời Trang',
        'category' => 'Nón',
        'sub_category' => 'Nón bucket',
        'price' => 150000,
        'image' => 'assets/Images/bucket_hat.jpg',
        'description' => 'Nón vành tròn che nắng chống tia UV, phong cách trẻ trung unisex.',
        'variant_count' => 2,
        'created_at' => '2026-11-24 15:20:00',
        'review_count' => 19,
    ],
    [
        'id' => 10,
        'name' => 'Ví Da Bò Dáng Đứng Nhiều Ngăn Nam',
        'category' => 'Ví/Túi xách',
        'sub_category' => 'Ví nam',
        'price' => 350000,
        'image' => 'assets/Images/wallet_leather.jpg',
        'description' => 'Ví nam da bò thật nhỏ gọn, nhiều ngăn chứa thẻ tiện lợi.',
        'variant_count' => 2,
        'created_at' => '2026-11-25 09:10:00',
        'review_count' => 22,
    ],
    [
        'id' => 11,
        'name' => 'Túi Đeo Chéo Canvas Mini Hàn Quốc',
        'category' => 'Ví/Túi xách',
        'sub_category' => 'Túi đeo chéo',
        'price' => 220000,
        'image' => 'assets/Images/crossbody_bag.jpg',
        'description' => 'Túi vải canvas thời trang đựng điện thoại, ví tiền nhỏ gọn khi dạo phố.',
        'variant_count' => 2,
        'created_at' => '2026-11-25 14:40:00',
        'review_count' => 35,
    ],
];

$sampleVariants = [
    ['id' => 1, 'product_id' => 1, 'product_name' => 'Giày Tây Oxford Nam Classic', 'size' => '39', 'color' => 'Đen', 'stock_quantity' => 15],
    ['id' => 2, 'product_id' => 1, 'product_name' => 'Giày Tây Oxford Nam Classic', 'size' => '40', 'color' => 'Đen', 'stock_quantity' => 20],
    ['id' => 3, 'product_id' => 1, 'product_name' => 'Giày Tây Oxford Nam Classic', 'size' => '41', 'color' => 'Đen', 'stock_quantity' => 0],
    ['id' => 4, 'product_id' => 1, 'product_name' => 'Giày Tây Oxford Nam Classic', 'size' => '40', 'color' => 'Nâu', 'stock_quantity' => 10],
    ['id' => 5, 'product_id' => 2, 'product_name' => 'Giày Sneaker Thể Thao Streetwear', 'size' => '38', 'color' => 'Trắng', 'stock_quantity' => 8],
    ['id' => 6, 'product_id' => 2, 'product_name' => 'Giày Sneaker Thể Thao Streetwear', 'size' => '39', 'color' => 'Trắng', 'stock_quantity' => 12],
    ['id' => 7, 'product_id' => 2, 'product_name' => 'Giày Sneaker Thể Thao Streetwear', 'size' => '40', 'color' => 'Trắng', 'stock_quantity' => 0],
    ['id' => 8, 'product_id' => 2, 'product_name' => 'Giày Sneaker Thể Thao Streetwear', 'size' => '41', 'color' => 'Trắng', 'stock_quantity' => 14],
    ['id' => 9, 'product_id' => 2, 'product_name' => 'Giày Sneaker Thể Thao Streetwear', 'size' => '40', 'color' => 'Đen', 'stock_quantity' => 10],
    ['id' => 10, 'product_id' => 3, 'product_name' => 'Giày Cao Gót Mũi Nhọn 7cm Nữ', 'size' => '36', 'color' => 'Kem/Be', 'stock_quantity' => 10],
    ['id' => 11, 'product_id' => 3, 'product_name' => 'Giày Cao Gót Mũi Nhọn 7cm Nữ', 'size' => '37', 'color' => 'Kem/Be', 'stock_quantity' => 15],
    ['id' => 12, 'product_id' => 3, 'product_name' => 'Giày Cao Gót Mũi Nhọn 7cm Nữ', 'size' => '38', 'color' => 'Đen', 'stock_quantity' => 0],
    ['id' => 13, 'product_id' => 4, 'product_name' => 'Dép Quai Ngang Unisex Basic', 'size' => '39', 'color' => 'Đen', 'stock_quantity' => 25],
    ['id' => 14, 'product_id' => 4, 'product_name' => 'Dép Quai Ngang Unisex Basic', 'size' => '40', 'color' => 'Trắng', 'stock_quantity' => 18],
    ['id' => 16, 'product_id' => 5, 'product_name' => 'Dép Sandal Chiến Binh Đi Học', 'size' => '39', 'color' => 'Đen', 'stock_quantity' => 30],
    ['id' => 20, 'product_id' => 8, 'product_name' => 'Nón Lưỡi Trai Kaki Form Mềm Đen', 'size' => 'Freesize', 'color' => 'Đen', 'stock_quantity' => 40],
    ['id' => 24, 'product_id' => 10, 'product_name' => 'Ví Da Bò Dáng Đứng Nhiều Ngăn Nam', 'size' => 'Tiêu chuẩn', 'color' => 'Nâu Bò', 'stock_quantity' => 20],
    ['id' => 26, 'product_id' => 11, 'product_name' => 'Túi Đeo Chéo Canvas Mini Hàn Quốc', 'size' => 'Mini', 'color' => 'Đen', 'stock_quantity' => 35],
];

$sampleCartItems = [
    [
        'product_id' => 1,
        'variant_id' => 1,
        'name' => 'Giày Tây Oxford Nam Classic',
        'image' => 'assets/Images/oxford_black.jpg',
        'color' => 'Đen',
        'size' => '39',
        'price' => 850000,
        'quantity' => 1,
        'stock_quantity' => 15,
    ],
    [
        'product_id' => 11,
        'variant_id' => 26,
        'name' => 'Túi Đeo Chéo Canvas Mini Hàn Quốc',
        'image' => 'assets/Images/crossbody_bag.jpg',
        'color' => 'Đen',
        'size' => 'Mini',
        'price' => 220000,
        'quantity' => 2,
        'stock_quantity' => 35,
    ],
];

$sampleOrders = [
    [
        'id' => 1,
        'customer_name' => 'Nguyễn Văn Người Dùng',
        'email' => 'user@gmail.com',
        'phone' => '0912345678',
        'address' => 'Số 123 Cầu Giấy, Hà Nội',
        'total_amount' => 850000,
        'payment_method' => 'COD',
        'payment_status' => 'Chưa thanh toán',
        'status' => 'Chờ duyệt',
        'created_at' => '2026-11-24 10:30:00',
    ],
    [
        'id' => 2,
        'customer_name' => 'Nguyễn Văn Người Dùng',
        'email' => 'user@gmail.com',
        'phone' => '0912345678',
        'address' => 'Số 123 Cầu Giấy, Hà Nội',
        'total_amount' => 620000,
        'payment_method' => 'Banking',
        'payment_status' => 'Đã thanh toán',
        'status' => 'Đang giao',
        'created_at' => '2026-11-24 15:45:00',
    ],
    [
        'id' => 3,
        'customer_name' => 'Khách Vãng Lai VIP',
        'email' => 'vip@gmail.com',
        'phone' => '0933333333',
        'address' => 'Quận 1, TP. Hồ Chí Minh',
        'total_amount' => 500000,
        'payment_method' => 'Momo',
        'payment_status' => 'Đã thanh toán',
        'status' => 'Đã giao',
        'created_at' => '2026-11-25 09:20:00',
    ],
    [
        'id' => 4,
        'customer_name' => 'Nguyễn Văn Người Dùng',
        'email' => 'user@gmail.com',
        'phone' => '0912345678',
        'address' => 'Số 123 Cầu Giấy, Hà Nội',
        'total_amount' => 180000,
        'payment_method' => 'COD',
        'payment_status' => 'Chưa thanh toán',
        'status' => 'Đã hủy',
        'created_at' => '2026-11-25 18:00:00',
    ],
];

$sampleOrderItems = [
    ['product_name' => 'Giày Tây Oxford Nam Classic', 'size' => '39', 'color' => 'Đen', 'quantity' => 1, 'price' => 850000, 'variant_id' => 1],
    ['product_name' => 'Túi Đeo Chéo Canvas Mini Hàn Quốc', 'size' => 'Mini', 'color' => 'Đen', 'quantity' => 2, 'price' => 220000, 'variant_id' => 26],
];

$currentUser = null;
$cartCount = 0;

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');

ob_start();

switch ($route) {
    case '/':
        $featuredProducts = array_slice($sampleProducts, 0, 8);
        include __DIR__ . '/views/client/home.php';
        break;

    case '/collection':
        $filters = [
            'q' => trim((string) ($_GET['q'] ?? '')),
            'category' => trim((string) ($_GET['category'] ?? '')),
            'sub_category' => trim((string) ($_GET['sub_category'] ?? '')),
            'price_min' => $_GET['price_min'] ?? '',
            'price_max' => $_GET['price_max'] ?? '',
            'sort' => $_GET['sort'] ?? 'newest',
        ];
        $subcategoryOptions = [
            'Giày tây', 'Giày thể thao', 'Giày nữ',
            'Dép quai ngang', 'Dép sandal',
            'Sticker hoạt hình', 'Sticker meme',
            'Nón lưỡi trai', 'Nón bucket',
            'Ví nam', 'Túi đeo chéo',
        ];
        $products = array_values(array_filter($sampleProducts, function ($item) use ($filters) {
            if ($filters['category'] !== '' && $item['category'] !== $filters['category']) {
                return false;
            }
            if ($filters['sub_category'] !== '' && $item['sub_category'] !== $filters['sub_category']) {
                return false;
            }
            if ($filters['q'] !== '' && mb_stripos($item['name'], $filters['q']) === false) {
                return false;
            }
            if ($filters['price_min'] !== '' && $item['price'] < (float) $filters['price_min']) {
                return false;
            }
            if ($filters['price_max'] !== '' && $item['price'] > (float) $filters['price_max']) {
                return false;
            }
            return true;
        }));
        if ($filters['sort'] === 'price_asc') {
            usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
        } elseif ($filters['sort'] === 'price_desc') {
            usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
        }
        $collectionTitle = $filters['sub_category'] ?: ($filters['category'] ?: 'BỘ SƯU TẬP');
        $totalProducts = count($products);
        include __DIR__ . '/views/client/collection.php';
        break;

    case '/product':
        $productId = (int) ($_GET['id'] ?? 1);
        $product = $sampleProducts[0];
        foreach ($sampleProducts as $item) {
            if ($item['id'] === $productId) {
                $product = $item;
                break;
            }
        }
        $variants = array_values(array_filter($sampleVariants, fn($v) => $v['product_id'] === $product['id']));
        if (empty($variants)) {
            $variants = [['id' => 99, 'product_id' => $product['id'], 'size' => 'Tiêu chuẩn', 'color' => 'Mặc định', 'stock_quantity' => 10]];
        }
        include __DIR__ . '/views/client/product_detail.php';
        break;

    case '/cart':
        $cartItems = $sampleCartItems;
        $subtotal = 850000 + (220000 * 2);
        $shippingFee = 0;
        $total = $subtotal;
        include __DIR__ . '/views/client/cart.php';
        break;

    case '/checkout':
        $cartItems = $sampleCartItems;
        $subtotal = 850000 + (220000 * 2);
        $shippingFee = 0;
        $total = $subtotal;
        include __DIR__ . '/views/client/checkout.php';
        break;

    case '/my-orders':
        $orders = $sampleOrders;
        include __DIR__ . '/views/client/my_orders.php';
        break;

    case '/login':
        $currentUser = null;
        include __DIR__ . '/views/auth/login.php';
        break;

    case '/register':
        $currentUser = null;
        include __DIR__ . '/views/auth/register.php';
        break;

    case '/admin/dashboard':
        $stats = [
            ['label' => 'Doanh thu tháng', 'value' => '1.970.000₫'],
            ['label' => 'Đơn hàng tháng', 'value' => '4'],
            ['label' => 'Đơn chờ duyệt', 'value' => '1'],
            ['label' => 'Sản phẩm đang bán', 'value' => '11'],
        ];
        $recentOrders = $sampleOrders;
        $revenueChart = [
            'labels' => ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            'values' => [1200000, 1800000, 1500000, 2100000, 2400000, 1950000, 2800000, 3100000, 2600000, 3400000, 3900000, 1970000],
        ];
        include __DIR__ . '/views/admin/dashboard.php';
        break;

    case '/admin/products':
        $products = $sampleProducts;
        $editId = (int) ($_GET['edit'] ?? 0);
        $editingProduct = null;
        foreach ($sampleProducts as $item) {
            if ($item['id'] === $editId) {
                $editingProduct = $item;
                break;
            }
        }
        include __DIR__ . '/views/admin/products.php';
        break;

    case '/admin/variants':
        $productOptions = array_map(fn($p) => ['id' => $p['id'], 'name' => $p['name']], $sampleProducts);
        $filters = [
            'product_id' => (int) ($_GET['product_id'] ?? 0),
            'stock' => $_GET['stock'] ?? '',
        ];
        $variants = array_values(array_filter($sampleVariants, function ($v) use ($filters) {
            if ($filters['product_id'] > 0 && $v['product_id'] !== $filters['product_id']) {
                return false;
            }
            if ($filters['stock'] === 'low' && $v['stock_quantity'] >= 5) {
                return false;
            }
            if ($filters['stock'] === 'out' && $v['stock_quantity'] > 0) {
                return false;
            }
            return true;
        }));
        include __DIR__ . '/views/admin/variants.php';
        break;

    case '/admin/orders':
        $filters = [
            'status' => $_GET['status'] ?? '',
            'payment_status' => $_GET['payment_status'] ?? '',
            'date_from' => $_GET['date_from'] ?? '',
            'date_to' => $_GET['date_to'] ?? '',
        ];
        $orders = array_values(array_filter($sampleOrders, function ($o) use ($filters) {
            if ($filters['status'] !== '' && $o['status'] !== $filters['status']) {
                return false;
            }
            if ($filters['payment_status'] !== '' && $o['payment_status'] !== $filters['payment_status']) {
                return false;
            }
            return true;
        }));
        include __DIR__ . '/views/admin/orders.php';
        break;

    case '/admin/orders/detail':
    case '/my-orders/detail':
        $orderId = (int) ($_GET['id'] ?? 1);
        $order = $sampleOrders[0];
        foreach ($sampleOrders as $o) {
            if ($o['id'] === $orderId) {
                $order = $o;
                break;
            }
        }
        $orderItems = $sampleOrderItems;
        include __DIR__ . '/views/admin/order_detail.php';
        break;

    default:
        $featuredProducts = array_slice($sampleProducts, 0, 8);
        include __DIR__ . '/views/client/home.php';
        break;
}

$html = ob_get_clean();

// Chuyển đổi các link gốc ("/...") sang index.php?route=/... để chạy trực tiếp trong thư mục con XAMPP
$rewriteUrl = function (string $url) use ($scriptName): string {
    if ($url === '/') {
        return $scriptName;
    }
    $parts = explode('?', $url, 2);
    $path = $parts[0];
    $query = isset($parts[1]) && $parts[1] !== '' ? '&' . $parts[1] : '';
    return $scriptName . '?route=' . rawurlencode($path) . $query;
};

// Chèn hidden input route cho form method="get"
$html = preg_replace_callback(
    '/<form\b([^>]*\baction="(\/[^"]*)"[^>]*)>/i',
    function ($m) {
        $attrs = $m[1];
        $path = explode('?', $m[2], 2)[0];
        if (preg_match('/\bmethod="get"/i', $attrs)) {
            return '<form' . $attrs . '><input type="hidden" name="route" value="' . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . '">';
        }
        return $m[0];
    },
    $html
);

$html = preg_replace_callback(
    '/\b(href|action)="(\/(?!\/)[^"]*)"/i',
    fn($m) => $m[1] . '="' . htmlspecialchars($rewriteUrl($m[2]), ENT_QUOTES, 'UTF-8') . '"',
    $html
);

echo $html;
