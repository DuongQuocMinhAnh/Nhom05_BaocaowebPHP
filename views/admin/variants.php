<?php $pageTitle = 'Biến thể & tồn kho — FASHIONSHOP'; $activePage = 'admin-variants'; $activeAdmin = 'variants'; include __DIR__ . '/../layouts/header.php'; ?>
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
                    <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text">Size · Màu sắc · Tồn kho</div>
                    <h1 class="h2 mb-1">Biến thể sản phẩm</h1>
                    <p class="text-secondary text-muted-soft mb-0">Tồn kho được theo dõi riêng cho từng cặp kích cỡ và màu.</p>
                </div>
                <?php if (!empty($flashMessage)): ?>
                <div class="alert alert-success">
                    <?= view_escape($flashMessage) ?>
                </div>
                <?php endif; ?>
                <section class="card shadow-sm border-0 admin-card rounded-4 p-4 mb-4">
                    <h2 class="h5 mb-3">Thêm biến thể</h2>
                    <form action="/admin/variants/save" method="post" id="variant-form">
                        <?= !empty($csrfToken) ? '<input type="hidden" name="csrf_token" value="'.view_escape($csrfToken).'">' : '' ?>
                        <input type="hidden" name="id" value="0">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="variant-product" class="form-label">Sản phẩm *</label>
                                <select class="form-select" id="variant-product" name="product_id" required>
                                <option value="">Chọn sản phẩm</option>
                                <?php foreach (($productOptions ?? []) as $option): ?>
                                <option value="<?= (int)$option['id'] ?>" <?= ((int)($_GET['product_id'] ?? 0)===(int)$option['id'])?'selected':'' ?>>
                                <?= view_escape($option['name']) ?>
                                </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="variant-size" class="form-label">Size *</label>
                                <input class="form-control" id="variant-size" name="size" placeholder="39 / M / Free size" required>
                            </div>
                            <div class="col-md-2">
                                <label for="variant-color" class="form-label">Màu sắc *</label>
                                <input class="form-control" id="variant-color" name="color" placeholder="Đen" required>
                            </div>
                            <div class="col-md-2">
                                <label for="variant-stock" class="form-label">Tồn kho *</label>
                                <input class="form-control" id="variant-stock" name="stock_quantity" type="number" min="0" value="0" required>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger brand-red-button btn-wine w-100" type="submit">Thêm biến thể</button>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="card shadow-sm border-0 admin-card rounded-4 p-3 p-lg-4">
                    <form action="/admin/variants" method="get" class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label for="variant-filter-product" class="visually-hidden">Sản phẩm</label>
                            <?php $currentProductId = (int)($filters['product_id'] ?? ($_GET['product_id'] ?? 0)); ?>
                            <select class="form-select" id="variant-filter-product" name="product_id">
                            <option value="">Tất cả sản phẩm</option>
                            <?php foreach (($productOptions ?? []) as $option): ?>
                            <option value="<?= (int)$option['id'] ?>" <?= ($currentProductId === (int)$option['id']) ? 'selected' : '' ?>>
                            <?= view_escape($option['name']) ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="stock-filter" class="visually-hidden">Tình trạng tồn kho</label>
                            <?php $currentStock = $filters['stock'] ?? ($_GET['stock'] ?? ''); ?>
                            <select id="stock-filter" class="form-select" name="stock">
                            <option value="" <?= $currentStock === '' ? 'selected' : '' ?>>Tất cả tồn kho</option>
                            <option value="low" <?= $currentStock === 'low' ? 'selected' : '' ?>>Sắp hết (&lt; 5)</option>
                            <option value="out" <?= $currentStock === 'out' ? 'selected' : '' ?>>Hết hàng</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-danger brand-outline-button btn-outline-wine w-100" type="submit">Lọc danh sách</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Màu</th>
                                    <th scope="col">Tồn kho</th>
                                    <th scope="col">Cập nhật tồn</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (($variants ?? []) as $variant): ?>
                                <tr>
                                    <td class="fw-semibold">
                                        <?= view_escape($variant['product_name']) ?>
                                        <div class="small text-secondary text-muted-soft">ID biến thể: <?= (int)$variant['id'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= view_escape($variant['size']) ?>
                                    </td>
                                    <td>
                                        <span class="d-inline-block rounded-circle border me-2 align-middle">
                                        </span>
                                        <?= view_escape($variant['color']) ?>
                                    </td>
                                    <td>
                                        <span class="badge <?= (int)$variant['stock_quantity']===0?'text-bg-danger':((int)$variant['stock_quantity']<5?'text-bg-warning':'text-bg-success') ?>">
                                        <?= (int)$variant['stock_quantity'] ?> sản phẩm</span>
                                    </td>
                                    <td>
                                        <form action="/admin/variants/update-stock" method="post" class="d-flex gap-2">
                                            <input type="hidden" name="id" value="<?= (int)$variant['id'] ?>">
                                            <label class="visually-hidden" for="stock-<?= (int)$variant['id'] ?>">Số lượng tồn</label>
                                            <input class="form-control form-control-sm" id="stock-<?= (int)$variant['id'] ?>" name="stock_quantity" type="number" min="0" value="<?= (int)$variant['stock_quantity'] ?>">
                                            <button class="btn btn-sm btn-outline-secondary" type="submit">Lưu</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/admin/variants/delete" method="post" data-confirm="Xóa biến thể này?">
                                            <input type="hidden" name="id" value="<?= (int)$variant['id'] ?>">
                                            <button class="btn btn-sm btn-outline-danger brand-outline-button" type="submit" aria-label="Xóa biến thể">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($variants)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">Chưa có biến thể nào.</td>
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
