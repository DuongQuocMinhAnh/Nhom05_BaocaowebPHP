<?php $pageTitle = 'Quản lý sản phẩm — FASHIONSHOP'; $activePage = 'admin-products'; $activeAdmin = 'products'; include __DIR__ . '/../layouts/header.php'; ?>
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
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                    <div>
                        <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text">Danh mục & sản phẩm</div>
                        <h1 class="h2 mb-1">Quản lý sản phẩm</h1>
                        <p class="text-secondary text-muted-soft mb-0">Thêm, cập nhật và quản lý sản phẩm cửa hàng.</p>
                    </div>
                    <button class="btn btn-danger brand-red-button btn-wine mt-3 mt-md-0" type="button" data-bs-toggle="collapse" data-bs-target="#productEditor" aria-expanded="<?= !empty($editingProduct)?'true':'false' ?>">
                    <span class="me-2" aria-hidden="true">+</span>Thêm sản phẩm</button>
                </div>
                <?php if (!empty($flashMessage)): ?>
                <div class="alert alert-success">
                    <?= view_escape($flashMessage) ?>
                </div>
                <?php endif; ?>
                <div class="collapse <?= !empty($editingProduct)?'show':'' ?> mb-4" id="productEditor">
                    <section class="card shadow-sm border-0 admin-card rounded-4 p-4">
                        <h2 class="h5 mb-3">
                            <?= !empty($editingProduct)?'Cập nhật sản phẩm':'Thông tin sản phẩm mới' ?>
                        </h2>
                        <form action="/admin/products/save" method="post" enctype="multipart/form-data" id="product-form">
                            <?= !empty($csrfToken) ? '<input type="hidden" name="csrf_token" value="'.view_escape($csrfToken).'">' : '' ?>
                            <input type="hidden" name="id" value="<?= (int)($editingProduct['id'] ?? 0) ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="product-name" class="form-label">Tên sản phẩm *</label>
                                    <input id="product-name" name="name" class="form-control" value="<?= view_escape($editingProduct['name'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="category" class="form-label">Danh mục *</label>
                                    <select id="category" name="category" class="form-select" required>
                                    <option value="">Chọn danh mục</option>
                                    <?php foreach (($categoryOptions ?? ['Giày','Dép','Sticker','Nón','Ví/Túi xách']) as $option): ?>
                                    <option value="<?= view_escape($option) ?>" <?= (($editingProduct['category'] ?? '')===$option)?'selected':'' ?>>
                                    <?= view_escape($option) ?>
                                    </option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="sub_category" class="form-label">Phân loại *</label>
                                    <input id="sub_category" name="sub_category" class="form-control" value="<?= view_escape($editingProduct['sub_category'] ?? '') ?>" placeholder="Ví dụ: Giày tây" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="price" class="form-label">Giá bán (₫) *</label>
                                    <input id="price" name="price" class="form-control" type="number" min="0" step="1000" value="<?= view_escape($editingProduct['price'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Ảnh sản phẩm</label>
                                    <input id="image" name="image" class="form-control" type="file" accept="image/jpeg,image/png,image/webp">
                                    <div class="form-text">JPG, PNG hoặc WebP; backend cần kiểm tra loại và kích thước tệp.</div>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Mô tả chất liệu & phong cách</label>
                                    <textarea id="description" name="description" class="form-control" rows="3"><?= view_escape($editingProduct['description'] ?? '') ?></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-danger brand-red-button btn-wine" type="submit">Lưu sản phẩm</button>
                                    <a class="btn btn-outline-secondary ms-2" href="/admin/products">Hủy</a>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <section class="card shadow-sm border-0 admin-card rounded-4 p-3 p-lg-4">
                    <form action="/admin/products" method="get" class="row g-2 mb-3">
                        <div class="col-sm-6 col-lg-4">
                            <label for="product-search" class="visually-hidden">Tìm sản phẩm</label>
                            <input id="product-search" class="form-control" type="search" name="q" value="<?= view_escape($filters['q'] ?? '') ?>" placeholder="Tìm theo tên">
                        </div>
                        <div class="col-sm-4 col-lg-3">
                            <label for="product-category-filter" class="visually-hidden">Lọc danh mục</label>
                            <select id="product-category-filter" name="category" class="form-select">
                            <option value="">Tất cả danh mục</option>
                            <?php foreach (($categoryOptions ?? ['Giày','Dép','Sticker','Nón','Ví/Túi xách']) as $option): ?>
                            <option value="<?= view_escape($option) ?>" <?= (($filters['category'] ?? '')===$option)?'selected':'' ?>>
                            <?= view_escape($option) ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-outline-danger brand-outline-button btn-outline-wine w-100" type="submit">Lọc</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Giá bán</th>
                                    <th scope="col">Biến thể</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (($products ?? []) as $product): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="<?= view_escape($product['image'] ?? '') ?>" alt="" width="52" height="60" class="rounded">
                                            <div class="fw-semibold">
                                                <?= view_escape($product['name']) ?>
                                                <div class="small text-secondary text-muted-soft">#<?= (int)$product['id'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?= view_escape($product['category']) ?>
                                        <div class="small text-secondary text-muted-soft">
                                            <?= view_escape($product['sub_category'] ?? '') ?>
                                        </div>
                                    </td>
                                    <td>
                                    <?= number_format((float)$product['price'],0,',','.') ?>₫</td>
                                    <td>
                                        <?= (int)($product['variant_count'] ?? 0) ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?= view_escape($product['created_at'] ?? '') ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-sm btn-outline-secondary" href="/admin/products?edit=<?= (int)$product['id'] ?>" aria-label="Sửa <?= view_escape($product['name']) ?>">
                                            <span aria-hidden="true">✎</span>
                                            </a>
                                            <a class="btn btn-sm btn-outline-danger brand-outline-button" href="/admin/variants?product_id=<?= (int)$product['id'] ?>" aria-label="Quản lý biến thể">
                                            <span aria-hidden="true">◉</span>
                                            </a>
                                            <form action="/admin/products/delete" method="post" data-confirm="Xóa sản phẩm này?">
                                                <input type="hidden" name="id" value="<?= (int)$product['id'] ?>">
                                                <button class="btn btn-sm btn-outline-danger brand-outline-button" type="submit" aria-label="Xóa <?= view_escape($product['name']) ?>">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">Chưa có sản phẩm phù hợp.</td>
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
