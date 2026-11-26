<?php $pageTitle = 'Giỏ hàng — FASHIONSHOP'; $activePage = 'cart'; include __DIR__ . '/../layouts/header.php'; ?>
<main class="section-space py-5">
    <div class="container">
        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">Túi đồ của bạn</div>
        <h1 class="display-5 mb-4">GIỎ HÀNG <span class="text-secondary text-muted-soft fs-4">(<?= count($cartItems ?? []) ?>)</span>
        </h1>
        <?php if (!empty($cartItems)): ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">
                                    <span class="visually-hidden">Xóa</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= view_escape($item['image'] ?? '') ?>" alt="" width="76" height="88" class="rounded">
                                        <div>
                                            <a class="text-dark text-decoration-none fw-semibold" href="/product?id=<?= (int)$item['product_id'] ?>">
                                            <?= view_escape($item['name']) ?>
                                            </a>
                                            <div class="small text-secondary text-muted-soft mt-1">Màu: <?= view_escape($item['color']) ?> · Size: <?= view_escape($item['size']) ?>
                                            </div>
                                            <div class="small text-secondary text-muted-soft">SKU biến thể: <?= (int)$item['variant_id'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                <?= number_format((float)$item['price'],0,',','.') ?>₫</td>
                                <td>
                                    <form action="/cart/update" method="post" class="d-flex gap-2">
                                        <input type="hidden" name="variant_id" value="<?= (int)$item['variant_id'] ?>">
                                        <label class="visually-hidden" for="qty-<?= (int)$item['variant_id'] ?>">Số lượng <?= view_escape($item['name']) ?>
                                        </label>
                                        <input id="qty-<?= (int)$item['variant_id'] ?>" name="quantity" class="form-control form-control-sm" type="number" min="1" max="<?= (int)($item['stock_quantity'] ?? 99) ?>" value="<?= (int)$item['quantity'] ?>">
                                        <button class="btn btn-outline-secondary btn-sm" type="submit" aria-label="Cập nhật số lượng">
                                        <span aria-hidden="true">↻</span>
                                        </button>
                                    </form>
                                    <div class="small text-secondary text-muted-soft mt-1">Còn <?= (int)($item['stock_quantity'] ?? 0) ?> sản phẩm</div>
                                </td>
                                <td class="fw-bold">
                                <?= number_format((float)$item['price'] * (int)$item['quantity'],0,',','.') ?>₫</td>
                                <td>
                                    <form action="/cart/remove" method="post">
                                        <input type="hidden" name="variant_id" value="<?= (int)$item['variant_id'] ?>">
                                        <button class="btn btn-link text-secondary text-muted-soft p-1" type="submit" aria-label="Xóa <?= view_escape($item['name']) ?>">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="/collection" class="text-dark small">
                <span class="me-2" aria-hidden="true">←</span>Tiếp tục mua sắm</a>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 admin-card rounded-4 p-4">
                    <h2 class="h5 mb-4">TÓM TẮT ĐƠN HÀNG</h2>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary text-muted-soft">Tạm tính</span>
                        <span>
                        <?= number_format((float)($subtotal ?? 0),0,',','.') ?>₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary text-muted-soft">Phí vận chuyển</span>
                        <span>
                        <?= ($shippingFee ?? 0) ? number_format((float)$shippingFee,0,',','.').'₫' : 'Miễn phí' ?>
                        </span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Tổng cộng</span>
                        <span class="text-danger brand-red-text">
                        <?= number_format((float)($total ?? $subtotal ?? 0),0,',','.') ?>₫</span>
                    </div>
                    <a class="btn btn-danger brand-red-button btn-wine btn-lg w-100" href="/checkout">Tiến hành thanh toán <span class="ms-2" aria-hidden="true">→</span>
                    </a>
                    <p class="small text-secondary text-muted-soft mt-3 mb-0">
                        <span class="me-1" aria-hidden="true">✓</span>Thông tin đặt hàng được bảo mật.</p>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="text-center py-5 bg-light rounded-3">
            <span class="fs-1 text-muted" aria-hidden="true">👜</span>
            <h2 class="h4 mt-3">Giỏ hàng đang trống</h2>
            <p class="text-secondary text-muted-soft">Bắt đầu với món đồ khiến bạn vui hôm nay.</p>
            <a href="/collection" class="btn btn-danger brand-red-button btn-wine rounded-pill px-4">Khám phá sản phẩm</a>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
