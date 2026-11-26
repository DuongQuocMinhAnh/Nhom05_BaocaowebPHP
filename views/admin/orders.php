<?php $pageTitle = 'Quản lý đơn hàng — FASHIONSHOP'; $activePage = 'admin-orders'; $activeAdmin = 'orders'; include __DIR__ . '/../layouts/header.php'; $statusLabels = ['Chờ duyệt'=>'Chờ duyệt','Đang giao'=>'Đang giao','Đã giao'=>'Đã giao','Đã hủy'=>'Đã hủy']; $paymentStatusLabels = ['Chưa thanh toán'=>'Chưa thanh toán','Đã thanh toán'=>'Đã thanh toán']; ?>
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
                <div class="mb-4">
                    <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text">Đơn hàng & giao nhận</div>
                    <h1 class="h2 mb-1">Quản lý đơn hàng</h1>
                    <p class="text-secondary text-muted-soft mb-0">Duyệt đơn và cập nhật trạng thái giao hàng.</p>
                </div>
                <?php if (!empty($flashMessage)): ?>
                <div class="alert alert-success">
                    <?= view_escape($flashMessage) ?>
                </div>
                <?php endif; ?>
                <section class="card shadow-sm border-0 admin-card rounded-4 p-3 p-lg-4">
                    <form action="/admin/orders" method="get" class="row g-2 mb-4">
                        <div class="col-md-3">
                            <label for="order-status" class="visually-hidden">Trạng thái giao hàng</label>
                            <select class="form-select" id="order-status" name="status">
                            <option value="">Tất cả trạng thái giao</option>
                            <?php foreach ($statusLabels as $value=>$label): ?>
                            <option value="<?= view_escape($value) ?>" <?= (($filters['status'] ?? ($_GET['status'] ?? ''))===$value)?'selected':'' ?>>
                            <?= view_escape($label) ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="order-payment-status" class="visually-hidden">Trạng thái thanh toán</label>
                            <select class="form-select" id="order-payment-status" name="payment_status">
                            <option value="">Tất cả thanh toán</option>
                            <?php foreach ($paymentStatusLabels as $value=>$label): ?>
                            <option value="<?= view_escape($value) ?>" <?= (($filters['payment_status'] ?? ($_GET['payment_status'] ?? ''))===$value)?'selected':'' ?>>
                            <?= view_escape($label) ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="order-from" class="visually-hidden">Từ ngày</label>
                            <input class="form-control" id="order-from" type="date" name="date_from" value="<?= view_escape($filters['date_from'] ?? ($_GET['date_from'] ?? '')) ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="order-to" class="visually-hidden">Đến ngày</label>
                            <input class="form-control" id="order-to" type="date" name="date_to" value="<?= view_escape($filters['date_to'] ?? ($_GET['date_to'] ?? '')) ?>">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-danger brand-outline-button btn-outline-wine w-100" type="submit">Lọc đơn hàng</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đơn</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Thanh toán</th>
                                    <th scope="col">Giao hàng</th>
                                    <th scope="col">Cập nhật</th>
                                    <th scope="col">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (($orders ?? []) as $order): ?>
                                <tr>
                                    <td class="fw-bold">#<?= (int)$order['id'] ?>
                                    </td>
                                    <td>
                                        <?= view_escape($order['customer_name']) ?>
                                        <div class="small text-secondary text-muted-soft">
                                            <?= view_escape($order['phone']) ?>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <?= view_escape($order['created_at']) ?>
                                    </td>
                                    <td class="fw-semibold text-nowrap">
                                    <?= number_format((float)$order['total_amount'],0,',','.') ?>₫</td>
                                    <td>
                                        <span class="badge <?= ($order['payment_status'] ?? '')==='Đã thanh toán'?'text-bg-success':'text-bg-warning' ?>">
                                        <?= view_escape($paymentStatusLabels[$order['payment_status'] ?? ''] ?? ($order['payment_status'] ?? 'Chưa thanh toán')) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?= ($order['status'] ?? '')==='Đã giao'?'text-bg-success':(($order['status'] ?? '')==='Đã hủy'?'text-bg-secondary':'text-bg-danger-subtle badge-soft') ?>">
                                        <?= view_escape($statusLabels[$order['status'] ?? ''] ?? $order['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="/admin/orders/update-status" method="post" class="d-flex flex-wrap flex-xl-nowrap gap-2">
                                            <input type="hidden" name="id" value="<?= (int)$order['id'] ?>">
                                            <label class="visually-hidden" for="status-<?= (int)$order['id'] ?>">Trạng thái giao hàng đơn #<?= (int)$order['id'] ?></label>
                                            <select class="form-select form-select-sm" id="status-<?= (int)$order['id'] ?>" name="status">
                                            <?php foreach ($statusLabels as $value=>$label): ?>
                                            <option value="<?= view_escape($value) ?>" <?= (($order['status'] ?? '')===$value)?'selected':'' ?>>
                                            <?= view_escape($label) ?>
                                            </option>
                                            <?php endforeach; ?>
                                            </select>
                                            <label class="visually-hidden" for="payment-status-<?= (int)$order['id'] ?>">Trạng thái thanh toán đơn #<?= (int)$order['id'] ?></label>
                                            <select class="form-select form-select-sm" id="payment-status-<?= (int)$order['id'] ?>" name="payment_status">
                                            <?php foreach ($paymentStatusLabels as $value=>$label): ?>
                                            <option value="<?= view_escape($value) ?>" <?= (($order['payment_status'] ?? '')===$value)?'selected':'' ?>>
                                            <?= view_escape($label) ?>
                                            </option>
                                            <?php endforeach; ?>
                                            </select>
                                            <button class="btn btn-sm btn-outline-secondary" type="submit" aria-label="Lưu trạng thái">Lưu</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-danger brand-outline-button" href="/admin/orders/detail?id=<?= (int)$order['id'] ?>">Xem</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">Chưa có đơn hàng.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
