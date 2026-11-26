<?php $pageTitle = 'Đơn hàng của tôi — FASHIONSHOP'; $activePage = 'orders'; include __DIR__ . '/../layouts/header.php'; $statusLabels = ['Chờ duyệt'=>'Chờ duyệt','Đang giao'=>'Đang giao','Đã giao'=>'Đã giao','Đã hủy'=>'Đã hủy']; ?>
<main class="section-space py-5">
    <div class="container">
        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">Tài khoản của bạn</div>
        <h1 class="display-5 mb-4">ĐƠN HÀNG CỦA TÔI</h1>
        <?php if (!empty($flashMessage)): ?>
        <div class="alert alert-success">
            <?= view_escape($flashMessage) ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($orders)): ?>
        <section class="card shadow-sm border-0 admin-card rounded-4 p-3 p-lg-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Người nhận</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Giao hàng</th>
                            <th scope="col" class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td class="fw-bold">#<?= (int)$order['id'] ?></td>
                            <td class="text-nowrap small text-secondary text-muted-soft"><?= view_escape($order['created_at']) ?></td>
                            <td>
                                <div class="fw-semibold"><?= view_escape($order['customer_name']) ?></div>
                                <div class="small text-secondary text-muted-soft"><?= view_escape($order['phone']) ?></div>
                            </td>
                            <td class="fw-bold text-danger brand-red-text text-nowrap"><?= number_format((float)$order['total_amount'],0,',','.') ?>₫</td>
                            <td>
                                <span class="badge rounded-pill <?= ($order['payment_status'] ?? '') === 'Đã thanh toán' ? 'text-bg-success' : 'text-bg-warning' ?>">
                                <?= view_escape($order['payment_status'] ?? 'Chưa thanh toán') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill <?= ($order['status'] ?? '') === 'Đã giao' ? 'text-bg-success' : (($order['status'] ?? '') === 'Đã hủy' ? 'text-bg-secondary' : 'text-bg-danger-subtle badge-soft') ?>">
                                <?= view_escape($statusLabels[$order['status'] ?? ''] ?? $order['status']) ?>
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a class="btn btn-outline-danger brand-outline-button btn-outline-wine btn-sm" href="/my-orders/detail?id=<?= (int)$order['id'] ?>">Xem chi tiết</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php else: ?>
        <div class="text-center py-5 bg-light rounded-3">
            <span class="fs-1 text-muted" aria-hidden="true">□</span>
            <h2 class="h4 mt-3">Bạn chưa có đơn hàng</h2>
            <a href="/collection" class="btn btn-danger brand-red-button btn-wine mt-2">Bắt đầu mua sắm</a>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
