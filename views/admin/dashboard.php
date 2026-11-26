<?php $pageTitle = 'Tổng quan quản trị — FASHIONSHOP';
$activePage = 'admin-dashboard';
$activeAdmin = 'dashboard';
include __DIR__ . '/../layouts/header.php'; ?>
<main class="admin-shell bg-light py-4 py-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row g-4">
            <div class="col-lg-3 col-xl-2">
                <aside class="admin-sidebar bg-dark text-white p-3 rounded-3">
                    <a class="d-block text-decoration-none fw-bold text-white mb-4" href="/admin/dashboard">FASHIONSHOP<small class="d-block text-white-50">QUẢN TRỊ CỬA HÀNG</small>
                    </a>
                    <?php $adminItems = [['key' => 'dashboard', 'url' => '/admin/dashboard', 'label' => 'Tổng quan', 'icon' => '▦'], ['key' => 'products', 'url' => '/admin/products', 'label' => 'Sản phẩm', 'icon' => '□'], ['key' => 'variants', 'url' => '/admin/variants', 'label' => 'Biến thể & tồn kho', 'icon' => '◉'], ['key' => 'orders', 'url' => '/admin/orders', 'label' => 'Đơn hàng', 'icon' => '▤']]; ?>
                    <nav class="nav flex-column" aria-label="Điều hướng quản trị">
                        <?php foreach ($adminItems as $item): ?>
                            <a class="nav-link text-white <?= ($activeAdmin ?? '') === $item['key'] ? 'active' : '' ?>" href="<?= view_escape($item['url']) ?>">
                                <span class="me-2" aria-hidden="true">
                                    <?= view_escape($item['icon']) ?>
                                </span>
                                <?= view_escape($item['label']) ?>
                            </a>
                        <?php endforeach; ?>
                    </nav>
                    <hr class="border-light border-opacity-25">
                    <a class="d-block text-white text-decoration-none" href="/" target="_blank" rel="noopener">Xem cửa hàng</a>
                    <form action="/logout" method="post" class="mt-3">
                        <button class="btn btn-sm btn-outline-light w-100" type="submit">Đăng xuất</button>
                    </form>
                </aside>
            </div>
            <div class="col-lg-9 col-xl-10">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                    <div>
                        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text">Không gian quản trị</div>
                        <h1 class="h2 mb-1">Tổng quan</h1>
                        <p class="text-secondary text-muted-soft mb-0">Theo dõi hoạt động cửa hàng của bạn.</p>
                    </div>
                    <form action="/admin/dashboard" method="get" class="d-flex gap-2 mt-3 mt-md-0">
                        <label for="report-month" class="visually-hidden">Tháng thống kê</label>
                        <input id="report-month" class="form-control" type="month" name="month" value="<?= view_escape($selectedMonth ?? date('Y-m')) ?>">
                        <button class="btn btn-danger brand-red-button btn-wine" type="submit">Xem báo cáo</button>
                    </form>
                </div>
                <?php if (!empty($flashMessage)): ?>
                    <div class="alert alert-success">
                        <?= view_escape($flashMessage) ?>
                    </div>
                <?php endif; ?>
                <div class="row g-3 mb-4">
                    <?php foreach (($stats ?? [['label' => 'Doanh thu tháng', 'value' => '0₫', 'icon' => 'cash-stack'], ['label' => 'Đơn hàng tháng', 'value' => '0', 'icon' => 'receipt'], ['label' => 'Đơn chờ duyệt', 'value' => '0', 'icon' => 'hourglass-split'], ['label' => 'Sản phẩm đang bán', 'value' => '0', 'icon' => 'box-seam']]) as $stat): ?>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-sm border-0 admin-card rounded-4 p-3 h-100">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="small text-secondary text-muted-soft">
                                        <?= view_escape($stat['label']) ?>
                                    </span>
                                    <span class="fs-5 text-danger brand-red-text" aria-hidden="true">▦</span>
                                </div>
                                <div class="h3 mt-3 mb-0">
                                    <?= view_escape($stat['value']) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row g-4">
                    <div class="col-xl-8">
                        <section class="card shadow-sm border-0 admin-card rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h2 class="h5 mb-1">Doanh thu theo tháng</h2>
                                    <p class="small text-secondary text-muted-soft mb-0">Tổng hợp doanh thu trong năm</p>
                                </div>
                                <span class="badge text-bg-danger-subtle badge-soft">
                                    <?= view_escape($selectedYear ?? date('Y')) ?>
                                </span>
                            </div>
                            <div>
                                <canvas id="revenueChart" aria-label="Biểu đồ doanh thu theo tháng" role="img">
                                </canvas>
                            </div>
                            <script type="application/json" id="revenue-chart-data">
                                <?= json_encode($revenueChart ?? ['labels' => ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'], 'values' => array_fill(0, 12, 0)], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
                            </script>
                        </section>
                    </div>
                    <div class="col-xl-4">
                        <section class="card shadow-sm border-0 admin-card rounded-4 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="h5 mb-0">Đơn hàng gần đây</h2>
                                <a href="/admin/orders" class="small text-danger brand-red-text">Tất cả</a>
                            </div>
                            <?php foreach (($recentOrders ?? []) as $order): ?>
                                <a href="/admin/orders/detail?id=<?= (int)$order['id'] ?>" class="d-flex justify-content-between align-items-center py-3 border-top text-decoration-none text-dark">
                                    <div>
                                        <div class="fw-semibold">#<?= (int)$order['id'] ?> · <?= view_escape($order['customer_name']) ?>
                                        </div>
                                        <div class="small text-secondary text-muted-soft">
                                            <?= view_escape($order['created_at']) ?>
                                        </div>
                                    </div>
                                    <span class="small fw-semibold text-danger brand-red-text">
                                        <?= number_format((float)$order['total_amount'], 0, ',', '.') ?>₫</span>
                                </a>
                            <?php endforeach; ?>
                            <?php if (empty($recentOrders)): ?>
                                <p class="text-secondary text-muted-soft small border-top pt-3">Chưa có đơn hàng nào.</p>
                            <?php endif; ?>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>