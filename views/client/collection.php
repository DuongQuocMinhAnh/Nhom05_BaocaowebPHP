<?php $pageTitle = 'Bộ sưu tập — FASHIONSHOP'; $activePage = 'collection'; include __DIR__ . '/../layouts/header.php'; $filters = $filters ?? []; ?>
<main>
    <section class="section-space py-5">
        <div class="container">
            <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">Khám phá Fashion Shop</div>
            <h1 class="display-4 mb-2">
                <?= view_escape($collectionTitle ?? 'BỘ SƯU TẬP') ?>
            </h1>
            <p class="text-secondary text-muted-soft mb-0">Những thiết kế hoàn thiện phong cách của bạn.</p>
        </div>
    </section>
    <section class="section-space py-5">
        <div class="container">
            <div class="row g-4">
                <aside class="col-lg-3">
                    <form action="/collection" method="get" class="card shadow-sm border-0 admin-card rounded-4 p-3">
                        <h2 class="h6 mb-3">LỌC SẢN PHẨM</h2>
                        <div class="mb-3">
                            <label for="filter-q" class="form-label">Từ khóa</label>
                            <input id="filter-q" class="form-control" type="search" name="q" value="<?= view_escape($filters['q'] ?? ($_GET['q'] ?? '')) ?>" placeholder="Tên sản phẩm">
                        </div>
                        <div class="mb-3">
                            <label for="filter-category" class="form-label">Danh mục</label>
                            <select id="filter-category" class="form-select" name="category">
                            <option value="">Tất cả danh mục</option>
                            <?php foreach (($categoryOptions ?? ['Giày','Dép','Sticker','Nón','Ví/Túi xách']) as $option): ?>
                            <option value="<?= view_escape($option) ?>" <?= (($filters['category'] ?? $_GET['category'] ?? '') === $option) ? 'selected' : '' ?>>
                            <?= view_escape($option) ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filter-subcategory" class="form-label">Phân loại</label>
                            <select id="filter-subcategory" class="form-select" name="sub_category">
                            <option value="">Tất cả phân loại</option>
                            <?php foreach (($subcategoryOptions ?? []) as $option): ?>
                            <option value="<?= view_escape($option) ?>" <?= (($filters['sub_category'] ?? $_GET['sub_category'] ?? '') === $option) ? 'selected' : '' ?>>
                            <?= view_escape($option) ?>
                            </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="price-min" class="form-label">Giá từ</label>
                                <input id="price-min" class="form-control" type="number" min="0" name="price_min" value="<?= view_escape($filters['price_min'] ?? '') ?>" placeholder="0">
                            </div>
                            <div class="col-6">
                                <label for="price-max" class="form-label">Đến</label>
                                <input id="price-max" class="form-control" type="number" min="0" name="price_max" value="<?= view_escape($filters['price_max'] ?? '') ?>" placeholder="2.000.000">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sort" class="form-label">Sắp xếp</label>
                            <?php $currentSort = $filters['sort'] ?? ($_GET['sort'] ?? 'newest'); ?>
                            <select id="sort" class="form-select" name="sort">
                            <option value="newest" <?= $currentSort === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                            <option value="price_asc" <?= $currentSort === 'price_asc' ? 'selected' : '' ?>>Giá thấp đến cao</option>
                            <option value="price_desc" <?= $currentSort === 'price_desc' ? 'selected' : '' ?>>Giá cao đến thấp</option>
                            <option value="popular" <?= $currentSort === 'popular' ? 'selected' : '' ?>>Bán chạy</option>
                            </select>
                        </div>
                        <button class="btn btn-danger brand-red-button btn-wine w-100" type="submit">Áp dụng bộ lọc</button>
                        <a class="btn btn-link text-secondary text-muted-soft w-100 mt-1" href="/collection">Xóa bộ lọc</a>
                    </form>
                </aside>
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="small text-secondary text-muted-soft">
                        <?= (int)($totalProducts ?? count($products ?? [])) ?> sản phẩm</span>
                        <form action="/collection" method="get" class="d-flex gap-2 d-lg-none">
                            <?php if (!empty($filters['q'] ?? ($_GET['q'] ?? ''))): ?>
                            <input type="hidden" name="q" value="<?= view_escape($filters['q'] ?? ($_GET['q'] ?? '')) ?>">
                            <?php endif; ?>
                            <?php if (!empty($filters['category'] ?? ($_GET['category'] ?? ''))): ?>
                            <input type="hidden" name="category" value="<?= view_escape($filters['category'] ?? ($_GET['category'] ?? '')) ?>">
                            <?php endif; ?>
                            <?php if (!empty($filters['sub_category'] ?? ($_GET['sub_category'] ?? ''))): ?>
                            <input type="hidden" name="sub_category" value="<?= view_escape($filters['sub_category'] ?? ($_GET['sub_category'] ?? '')) ?>">
                            <?php endif; ?>
                            <?php if (($filters['price_min'] ?? ($_GET['price_min'] ?? '')) !== ''): ?>
                            <input type="hidden" name="price_min" value="<?= view_escape($filters['price_min'] ?? ($_GET['price_min'] ?? '')) ?>">
                            <?php endif; ?>
                            <?php if (($filters['price_max'] ?? ($_GET['price_max'] ?? '')) !== ''): ?>
                            <input type="hidden" name="price_max" value="<?= view_escape($filters['price_max'] ?? ($_GET['price_max'] ?? '')) ?>">
                            <?php endif; ?>
                            <label class="visually-hidden" for="mobile-sort">Sắp xếp</label>
                            <select id="mobile-sort" name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="newest" <?= $currentSort === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                            <option value="price_asc" <?= $currentSort === 'price_asc' ? 'selected' : '' ?>>Giá thấp đến cao</option>
                            <option value="price_desc" <?= $currentSort === 'price_desc' ? 'selected' : '' ?>>Giá cao đến thấp</option>
                            <option value="popular" <?= $currentSort === 'popular' ? 'selected' : '' ?>>Bán chạy</option>
                            </select>
                        </form>
                    </div>
                    <div class="row g-4">
                        <?php foreach (($products ?? []) as $product): ?>
                        <div class="col-6 col-lg-3">
                            <article class="product-card card h-100 rounded-4 overflow-hidden">
                                <a class="text-decoration-none text-dark" href="/product?id=<?= (int)($product['id'] ?? 0) ?>">
                                <img class="card-img-top product-card-image object-fit-cover image-hover" data-image-hover src="<?= view_escape($product['image'] ?? '') ?>" alt="<?= view_escape($product['name'] ?? 'Sản phẩm') ?>" loading="lazy">
                                <div class="card-body">
                                    <div class="small text-secondary text-muted-soft">
                                        <?= view_escape($product['category'] ?? '') ?> · <?= view_escape($product['sub_category'] ?? '') ?>
                                    </div>
                                    <h3 class="h6 mt-2">
                                        <?= view_escape($product['name'] ?? '') ?>
                                    </h3>
                                    <div class="fw-bold text-danger brand-red-text">
                                    <?= number_format((float)($product['price'] ?? 0), 0, ',', '.') ?>₫</div>
                                </div>
                                </a>
                            </article>
                        </div>
                        <?php endforeach; ?>
                        <?php if (empty($products)): ?>
                        <div class="col-12">
                            <div class="text-center py-5 bg-light rounded-3">
                                <span class="fs-2 text-muted" aria-hidden="true">⌕</span>
                                <h2 class="h5 mt-3">Chưa tìm thấy sản phẩm</h2>
                                <p class="text-secondary text-muted-soft mb-0">Thử thay đổi bộ lọc để xem thêm lựa chọn.</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($pagination)): ?>
                    <nav class="mt-5" aria-label="Phân trang">
                        <ul class="pagination justify-content-center">
                            <?php foreach ($pagination as $page): ?>
                            <li class="page-item <?= !empty($page['active']) ? 'active' : '' ?> <?= !empty($page['disabled']) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= view_escape($page['url'] ?? '#') ?>">
                                <?= view_escape($page['label']) ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
