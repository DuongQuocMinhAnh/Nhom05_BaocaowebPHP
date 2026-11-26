<?php $pageTitle = 'Tạo tài khoản — FASHIONSHOP'; $activePage = 'auth'; include __DIR__ . '/../layouts/header.php'; ?>
<main class="section-space py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0 admin-card rounded-4 p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text">Gia nhập Fashion Shop</div>
                        <h1 class="h2 mt-2">TẠO TÀI KHOẢN</h1>
                        <p class="small text-secondary text-muted-soft">Lưu thông tin giao hàng và theo dõi hành trình đơn hàng.</p>
                    </div>
                    <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                            <li>
                                <?= view_escape($error) ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <form action="/register" method="post" id="register-form">
                        <?= !empty($csrfToken) ? '<input type="hidden" name="csrf_token" value="'.view_escape($csrfToken).'">' : '' ?>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên *</label>
                            <input class="form-control" id="fullname" name="fullname" value="<?= view_escape($old['fullname'] ?? '') ?>" autocomplete="name" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input class="form-control" id="email" name="email" type="email" value="<?= view_escape($old['email'] ?? '') ?>" autocomplete="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input class="form-control" id="phone" name="phone" type="tel" value="<?= view_escape($old['phone'] ?? '') ?>" autocomplete="tel">
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <textarea class="form-control" id="address" name="address" rows="2" autocomplete="street-address"><?= view_escape($old['address'] ?? '') ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Mật khẩu *</label>
                                <input class="form-control" id="password" name="password" type="password" minlength="8" autocomplete="new-password" required>
                                <div class="form-text">Tối thiểu 8 ký tự.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label">Nhập lại mật khẩu *</label>
                                <input class="form-control" id="confirm_password" name="confirm_password" type="password" minlength="8" autocomplete="new-password" required>
                            </div>
                        </div>
                        <div class="form-check my-4">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" value="1" required>
                            <label class="form-check-label small" for="terms">Tôi đồng ý với điều khoản sử dụng và chính sách bảo mật.</label>
                        </div>
                        <button class="btn btn-danger brand-red-button btn-wine btn-lg w-100" type="submit">Tạo tài khoản</button>
                    </form>
                    <p class="text-center small mt-4 mb-0">Đã có tài khoản? <a href="/login" class="fw-bold text-danger brand-red-text">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
