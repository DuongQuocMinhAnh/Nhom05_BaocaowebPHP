<?php $pageTitle = 'Chi tiết đơn hàng — FASHIONSHOP'; $activePage = 'admin-orders'; $activeAdmin = 'orders'; include __DIR__ . '/../layouts/header.php'; $order = $order ?? []; $statusLabels = ['Chờ duyệt'=>'Chờ duyệt','Đang giao'=>'Đang giao','Đã giao'=>'Đã giao','Đã hủy'=>'Đã hủy']; $paymentStatusLabels = ['Chưa thanh toán'=>'Chưa thanh toán','Đã thanh toán'=>'Đã thanh toán']; ?>
<main class="admin-shell bg-light py-4 py-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row g-4">
            <div class="col-lg-3 col-xl-2">
                <aside class="admin-sidebar bg-dark text-white p-3 rounded-3">
                    <a class="d-block text-decoration-none fw-bold text-white mb-4" href="/admin/dashboard">FASHIONSHOP<small class="d-block text-white-50">QUẢN TRỊ CỬA HÀNG</small>
                    </a>
                    <?php $adminItems = [['key'=>'dashboard','url'=>'/admin/dashboard','label'=>'Tổng quan','icon'=>'▦'],['key'=>'products','url'=>'/admin/products','label'=>'Sản phẩm','icon'=>'□'],['key'=>'variants','url'=>'/admin/variants','label'=>'Biến thể & tồn kho','icon'=>'◉'],['key'=>'orders','url'=>'/admin/orders','label'=>'Đơn hàng','icon'=>'▤']]; ?>
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
                <a class="small text-secondary text-muted-soft text-decoration-none" href="/admin/orders">
                <span class="me-1" aria-hidden="true">←</span>Quay lại danh sách</a>
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-3 mb-4">
                    <div>
                        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text">Thông tin đơn hàng</div>
                        <h1 class="h2 mb-1">Đơn hàng #<?= (int)($order['id'] ?? 0) ?>
                        </h1>
                        <p class="text-secondary text-muted-soft mb-0">Đặt lúc <?= view_escape($order['created_at'] ?? '') ?>
                        </p>
                    </div>
                    <span class="badge rounded-pill fs-6 <?= ($order['status'] ?? '')==='Đã giao'?'text-bg-success':'text-bg-danger-subtle badge-soft' ?> mt-3 mt-md-0">
                    <?= view_escape($statusLabels[$order['status'] ?? ''] ?? ($order['status'] ?? '')) ?>
                    </span>
                </div>
                <?php if (!empty($flashMessage)): ?>
                <div class="alert alert-success">
                    <?= view_escape($flashMessage) ?>
                </div>
                <?php endif; ?>
                <div class="row g-4">
                    <div class="col-xl-8">
                        <section class="card shadow-sm border-0 admin-card rounded-4 p-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="h5 mb-0">Sản phẩm đã đặt</h2>
                                <span class="small text-secondary text-muted-soft">
                                <?= count($orderItems ?? []) ?> dòng hàng</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sản phẩm & biến thể</th>
                                            <th scope="col">Đơn giá</th>
                                            <th scope="col">SL</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (($orderItems ?? []) as $item): ?>
                                        <tr>
                                            <td class="fw-semibold">
                                                <?= view_escape($item['product_name']) ?>
                                                <div class="small text-secondary text-muted-soft">Màu <?= view_escape($item['color']) ?> · Size <?= view_escape($item['size']) ?> · Mã biến thể <?= (int)$item['variant_id'] ?>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">
                                            <?= number_format((float)$item['price'],0,',','.') ?>₫</td>
                                            <td>
                                                <?= (int)$item['quantity'] ?>
                                            </td>
                                            <td class="fw-semibold text-nowrap">
                                            <?= number_format((float)$item['price']*(int)$item['quantity'],0,',','.') ?>₫</td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Tổng thanh toán</th>
                                            <th class="text-danger brand-red-text">
                                            <?= number_format((float)($order['total_amount'] ?? 0),0,',','.') ?>₫</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                        <section class="card shadow-sm border-0 admin-card rounded-4 p-4">
                            <h2 class="h5 mb-3">Cập nhật trạng thái</h2>
                            <form action="/admin/orders/update-status" method="post" class="row g-3 align-items-end">
                                <input type="hidden" name="id" value="<?= (int)($order['id'] ?? 0) ?>">
                                <div class="col-md-5">
                                    <label class="form-label" for="order-detail-status">Trạng thái giao hàng</label>
                                    <select class="form-select" id="order-detail-status" name="status">
                                    <?php foreach ($statusLabels as $value=>$label): ?>
                                    <option value="<?= view_escape($value) ?>" <?= (($order['status'] ?? '')===$value)?'selected':'' ?>>
                                    <?= view_escape($label) ?>
                                    </option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="order-detail-payment-status">Trạng thái thanh toán</label>
                                    <select class="form-select" id="order-detail-payment-status" name="payment_status">
                                    <?php foreach ($paymentStatusLabels as $value=>$label): ?>
                                    <option value="<?= view_escape($value) ?>" <?= (($order['payment_status'] ?? '')===$value)?'selected':'' ?>>
                                    <?= view_escape($label) ?>
                                    </option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-danger brand-red-button btn-wine w-100" type="submit">Lưu trạng thái</button>
                                </div>
                                <div class="col-12">
                                    <div class="form-text">Luồng xử lý chính: Chờ duyệt → Đang giao → Đã giao.</div>
                                </div>
                            </form>
                        </section>
                    </div>
                    <div class="col-xl-4">
                        <section class="card shadow-sm border-0 admin-card rounded-4 p-4 mb-4">
                            <h2 class="h5 mb-3">Khách hàng</h2>
                            <div class="mb-3">
                                <div class="small text-secondary text-muted-soft">Họ tên</div>
                                <div class="fw-semibold">
                                    <?= view_escape($order['customer_name'] ?? '') ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="small text-secondary text-muted-soft">Email</div>
                                <a href="mailto:<?= view_escape($order['email'] ?? '') ?>">
                                <?= view_escape($order['email'] ?? '') ?>
                                </a>
                            </div>
                            <div class="mb-3">
                                <div class="small text-secondary text-muted-soft">Điện thoại</div>
                                <a href="tel:<?= view_escape($order['phone'] ?? '') ?>">
                                <?= view_escape($order['phone'] ?? '') ?>
                                </a>
                            </div>
                            <div>
                                <div class="small text-secondary text-muted-soft">Địa chỉ giao hàng</div>
                                <div>
                                    <?= nl2br(view_escape($order['address'] ?? '')) ?>
                                </div>
                            </div>
                        </section>
                        <section class="card shadow-sm border-0 admin-card rounded-4 p-4">
                            <h2 class="h5 mb-3">Thanh toán</h2>
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary text-muted-soft">Phương thức</span>
                                <span>
                                <?= view_escape($order['payment_method'] ?? 'COD') ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="text-secondary text-muted-soft">Trạng thái</span>
                                <span>
                                <?= view_escape($order['payment_status'] ?? 'Chưa thanh toán') ?>
                                </span>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
