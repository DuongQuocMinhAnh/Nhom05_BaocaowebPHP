<?php
$shippingFee = (float) ($shippingFee ?? 0);
$pageTitle = 'Thanh toán — FASHIONSHOP';
$activePage = 'cart';
include __DIR__ . '/../layouts/header.php';
?>
<main class="section-space py-5">
    <div class="container">
        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">Chỉ còn một bước</div>
        <h1 class="display-5 mb-5">HOÀN TẤT ĐƠN HÀNG</h1>
        <form action="/checkout/place-order" method="post" id="checkout-form" class="row g-4">
            <?= !empty($csrfToken) ? '<input type="hidden" name="csrf_token" value="'.view_escape($csrfToken).'">' : '' ?>
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 admin-card rounded-4 p-4 p-lg-5">
                    <h2 class="h4 mb-4">Thông tin nhận hàng</h2>
                    <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                            <li>
                                <?= view_escape($error) ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="customer_name" class="form-label">Họ và tên *</label>
                            <input class="form-control" id="customer_name" name="customer_name" value="<?= view_escape($old['customer_name'] ?? $currentUser['fullname'] ?? '') ?>" autocomplete="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email *</label>
                            <input class="form-control" id="email" name="email" type="email" value="<?= view_escape($old['email'] ?? $currentUser['email'] ?? '') ?>" autocomplete="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Số điện thoại *</label>
                            <input class="form-control" id="phone" name="phone" type="tel" value="<?= view_escape($old['phone'] ?? $currentUser['phone'] ?? '') ?>" autocomplete="tel" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Địa chỉ nhận hàng *</label>
                            <textarea class="form-control" id="address" name="address" rows="3" autocomplete="street-address" required><?= view_escape($old['address'] ?? $currentUser['address'] ?? '') ?></textarea>
                        </div>
                        <div class="col-12">
                            <label for="note" class="form-label">Ghi chú cho cửa hàng</label>
                            <textarea class="form-control" id="note" name="note" rows="2" placeholder="Không bắt buộc"><?= view_escape($old['note'] ?? '') ?></textarea>
                        </div>
                    </div>
                    <h2 class="h5 mt-5 mb-3">Phương thức thanh toán</h2>
                    <div class="form-check border rounded p-3 ps-5 mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="COD" checked>
                        <label class="form-check-label w-100" for="payment_cod">
                        <strong>Thanh toán khi nhận hàng</strong>
                        <span class="d-block small text-secondary text-muted-soft">COD — thanh toán trực tiếp với đơn vị giao hàng</span>
                        </label>
                    </div>
                    <div class="form-check border rounded p-3 ps-5 mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_banking" value="Banking">
                        <label class="form-check-label w-100" for="payment_banking">
                        <strong>Chuyển khoản ngân hàng</strong>
                        </label>
                    </div>
                    <div class="form-check border rounded p-3 ps-5 mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_momo" value="Momo">
                        <label class="form-check-label w-100" for="payment_momo">
                        <strong>Ví điện tử MoMo</strong>
                        </label>
                    </div>
                    <div class="form-check border rounded p-3 ps-5">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_vnpay" value="VNPAY">
                        <label class="form-check-label w-100" for="payment_vnpay">
                        <strong>VNPay</strong>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 admin-card rounded-4 p-4">
                    <h2 class="h5 mb-4">Đơn hàng của bạn</h2>
                    <?php foreach (($cartItems ?? []) as $item): ?>
                    <div class="d-flex justify-content-between gap-3 mb-3">
                        <div>
                            <div class="fw-semibold">
                                <?= view_escape($item['name']) ?> <span class="text-secondary text-muted-soft">× <?= (int)$item['quantity'] ?>
                                </span>
                            </div>
                            <div class="small text-secondary text-muted-soft">
                                <?= view_escape($item['color']) ?> · <?= view_escape($item['size']) ?>
                            </div>
                        </div>
                        <span class="text-nowrap">
                        <?= number_format((float)$item['price']*(int)$item['quantity'],0,',','.') ?>₫</span>
                    </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary text-muted-soft">Tạm tính</span>
                        <span>
                        <?= number_format((float)($subtotal ?? 0),0,',','.') ?>₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary text-muted-soft">Giao hàng</span>
                        <span>
                        <?= ($shippingFee ?? 0) ? number_format((float)$shippingFee,0,',','.').'₫' : 'Miễn phí' ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-3">
                        <span>Tổng cộng</span>
                        <span class="text-danger brand-red-text">
                        <?= number_format((float)($total ?? $subtotal ?? 0),0,',','.') ?>₫</span>
                    </div>
                    <button type="submit" class="btn btn-danger brand-red-button btn-wine btn-lg w-100 mt-4" <?= empty($cartItems) ? 'disabled' : '' ?>>Đặt hàng <span class="ms-2" aria-hidden="true">→</span>
                    </button>
                    <p class="small text-secondary text-muted-soft mt-3 mb-0">Đặt hàng đồng nghĩa với việc bạn đồng ý với chính sách mua hàng của Fashion Shop.</p>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
