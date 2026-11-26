<?php $pageTitle = 'Đăng nhập — FASHIONSHOP'; $activePage = 'auth'; include __DIR__ . '/../layouts/header.php'; ?>
<main class="section-space py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card shadow-sm border-0 admin-card rounded-4 p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text">Chào mừng trở lại</div>
                        <h1 class="h2 mt-2">ĐĂNG NHẬP</h1>
                        <p class="small text-secondary text-muted-soft">Đăng nhập để theo dõi đơn hàng và lưu lựa chọn của bạn.</p>
                    </div>
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= view_escape($error) ?>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($success)): ?>
                    <div class="alert alert-success" role="status">
                        <?= view_escape($success) ?>
                    </div>
                    <?php endif; ?>
                    <form action="/login" method="post" id="login-form">
                        <?= !empty($csrfToken) ? '<input type="hidden" name="csrf_token" value="'.view_escape($csrfToken).'">' : '' ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" id="email" name="email" type="email" value="<?= view_escape($old['email'] ?? '') ?>" autocomplete="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input class="form-control" id="password" name="password" type="password" autocomplete="current-password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">
                                <label class="form-check-label small" for="remember">Ghi nhớ đăng nhập</label>
                            </div>
                            <a class="small text-danger brand-red-text" href="/forgot-password">Quên mật khẩu?</a>
                        </div>
                        <button class="btn btn-danger brand-red-button btn-wine btn-lg w-100" type="submit">Đăng nhập</button>
                    </form>
                    <p class="text-center small mt-4 mb-0">Chưa có tài khoản? <a href="/register" class="fw-bold text-danger brand-red-text">Tạo tài khoản</a>
                    </p>
                </div>
                <p class="text-center small text-secondary text-muted-soft mt-3">
                    <a href="/" class="text-secondary text-muted-soft">
                    <span class="me-1" aria-hidden="true">←</span>Quay về cửa hàng</a>
                </p>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
