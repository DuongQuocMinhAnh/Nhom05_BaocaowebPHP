<?php
// Expected optional variables: $pageTitle, $activePage, $cartCount, $currentUser.
if (!function_exists('view_escape')) {
function view_escape($value): string { return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8'); }
}
$pageTitle = $pageTitle ?? 'FASHIONSHOP — Phụ kiện & giày dép';
$activePage = $activePage ?? '';
$cartCount = $cartCount ?? 0;
$currentUser = $currentUser ?? ($_SESSION['user'] ?? null);
$adminView = str_starts_with((string) $activePage, 'admin');
$catalogGroups = [
'Giày' => ['Giày tây', 'Giày thể thao', 'Giày nữ'],
'Dép' => ['Dép quai ngang', 'Dép sandal'],
'Sticker' => ['Sticker hoạt hình', 'Sticker meme'],
'Nón' => ['Nón lưỡi trai', 'Nón bucket'],
'Ví/Túi xách' => ['Ví nam', 'Túi đeo chéo'],
];
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#171717">
<title>
<?= view_escape($pageTitle) ?>
</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="brand-theme">
    <nav class="site-nav navbar navbar-expand-xl navbar-dark py-3 z-3 <?= $activePage === 'home' ? 'position-absolute top-0 start-0 w-100 bg-transparent border-0' : 'bg-dark border-bottom border-secondary' ?>" aria-label="Điều hướng chính">
        <div class="container-fluid px-3 px-xl-5">
            <a class="brand brand-mark brand-mint-text display-font text-light text-decoration-none fw-bold me-xl-5 text-nowrap" href="/">FASHIONSHOP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Mở menu">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link text-nowrap <?= $activePage === 'home' ? 'active brand-mint-text' : '' ?>" href="/">TRANG CHỦ</a>
                    </li>
                    <?php foreach ($catalogGroups as $group => $children): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-nowrap" href="/collection?category=<?= rawurlencode($group) ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= view_escape(mb_strtoupper($group)) ?>
                        </a>
                        <ul class="dropdown-menu mega-menu">
                            <li>
                                <a class="dropdown-item fw-bold text-uppercase" href="/collection?category=<?= rawurlencode($group) ?>">Tất cả <?= view_escape($group) ?></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php foreach ($children as $child): ?>
                            <li>
                                <a class="dropdown-item" href="/collection?category=<?= rawurlencode($group) ?>&sub_category=<?= rawurlencode($child) ?>">
                                <?= view_escape($child) ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="nav-tools d-flex align-items-center gap-2 gap-xl-3 mt-3 mt-xl-0 ms-xl-auto flex-wrap flex-xl-nowrap">
                    <form action="/collection" method="get" class="d-flex" role="search">
                        <label class="visually-hidden" for="nav-search">Tìm sản phẩm</label>
                        <input class="form-control form-control-sm" id="nav-search" name="q" placeholder="Tìm sản phẩm...">
                    </form>
                    <?php if ($currentUser): ?>
                    <a href="/my-orders" class="link-light text-decoration-none" aria-label="Đơn hàng của tôi">
                    <span class="fs-5" aria-hidden="true">♙</span>
                    </a>
                    <span class="small text-light d-none d-xl-inline">
                    <?= view_escape($currentUser['fullname'] ?? $currentUser['name'] ?? 'Tài khoản') ?>
                    </span>
                    <?php endif; ?>
                    <a href="/cart" class="link-light text-decoration-none position-relative" aria-label="Giỏ hàng">
                    <span class="fs-5" aria-hidden="true">👜</span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger brand-badge">
                    <?= (int) $cartCount ?>
                    </span>
                    </a>
                    <?php if (!$currentUser): ?>
                    <div class="d-flex align-items-center gap-2 text-nowrap">
                        <a class="nav-link text-light p-0" href="/login">Đăng nhập</a>
                        <span class="text-white-50" aria-hidden="true">/</span>
                        <a class="nav-link text-light p-0" href="/register">Đăng ký</a>
                    </div>
                    <?php endif; ?>
                    <?php if ($currentUser && (($currentUser['role'] ?? '') === 'admin')): ?>
                    <a href="/admin/dashboard" class="link-light text-decoration-none" title="Quản trị">
                    <span class="fs-5" aria-hidden="true">◷</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
