<?php $product = $product ?? []; $pageTitle = ($product['name'] ?? 'Chi tiết sản phẩm') . ' — FASHIONSHOP'; $activePage = 'collection'; include __DIR__ . '/../layouts/header.php'; ?>
<main class="py-4 py-lg-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="/" class="text-secondary text-muted-soft">Trang chủ</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/collection?category=<?= rawurlencode($product['category'] ?? '') ?>" class="text-secondary text-muted-soft">
                    <?= view_escape($product['category'] ?? 'Sản phẩm') ?>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= view_escape($product['name'] ?? '') ?>
                </li>
            </ol>
        </nav>
        <div class="row g-5 mt-1">
            <div class="col-lg-7">
                <div class="rounded-3 overflow-hidden bg-light">
                    <img class="w-100" src="<?= view_escape($product['image'] ?? 'assets/Images/sneaker_white.jpg') ?>" alt="<?= view_escape($product['name'] ?? 'Sản phẩm') ?>">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">
                    <?= view_escape($product['category'] ?? 'Bộ sưu tập Fashion Shop') ?>
                </div>
                <h1 class="display-5 mb-2">
                    <?= view_escape($product['name'] ?? 'Tên sản phẩm') ?>
                </h1>
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="text-warning">★★★★★</span>
                    <span class="small text-secondary text-muted-soft">(<?= (int)($product['review_count'] ?? 0) ?> đánh giá)</span>
                </div>
                <div class="h3 text-danger brand-red-text mb-4">
                <?= number_format((float)($product['price'] ?? 0), 0, ',', '.') ?>₫</div>
                <p class="text-secondary text-muted-soft">
                    <?= nl2br(view_escape($product['description'] ?? 'Mô tả chất liệu và phong cách sản phẩm.')) ?>
                </p>
                <hr class="my-4">
                <form action="/cart/add" method="post" id="product-variant-form" data-variant-form data-variants="<?= view_escape(json_encode($variants ?? [], JSON_UNESCAPED_UNICODE)) ?>">
                    <?= !empty($csrfToken) ? '<input type="hidden" name="csrf_token" value="'.view_escape($csrfToken).'">' : '' ?>
                    <input type="hidden" name="product_id" value="<?= (int)($product['id'] ?? 0) ?>">
                    <input type="hidden" name="variant_id" id="selected-variant-id" value="">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Màu sắc <span class="text-danger brand-red-text">*</span>
                            </label>
                            <span id="selected-color-label" class="small text-secondary text-muted-soft">Chọn màu</span>
                        </div>
                        <div id="variant-colors" class="variant-options d-flex flex-wrap gap-2" role="group" aria-label="Chọn màu sắc">
                            <?php $colors = array_unique(array_column($variants ?? [], 'color')); foreach ($colors as $color): ?>
                            <button class="variant-color-option btn btn-outline-secondary btn-sm" type="button" data-variant-color="<?= view_escape($color) ?>">
                            <span class="d-inline-block rounded-circle border me-1">
                            </span>
                            <?= view_escape($color) ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Kích cỡ <span class="text-danger brand-red-text">*</span>
                            </label>
                            <button class="btn btn-link btn-sm p-0 text-secondary text-muted-soft" type="button" data-bs-toggle="modal" data-bs-target="#sizeGuide">Hướng dẫn chọn size</button>
                        </div>
                        <div id="variant-sizes" class="variant-options d-flex flex-wrap gap-2" role="group" aria-label="Chọn kích cỡ">
                            <?php $sizes = array_unique(array_column($variants ?? [], 'size')); foreach ($sizes as $size): ?>
                            <button class="variant-size-option btn btn-outline-secondary btn-sm px-3" type="button" data-variant-size="<?= view_escape($size) ?>" data-variant-size-choice="<?= view_escape($size) ?>">
                            <?= view_escape($size) ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                        <div id="variant-stock-message" class="small mt-2 text-secondary text-muted-soft" aria-live="polite">Vui lòng chọn màu và kích cỡ để kiểm tra tồn kho.</div>
                    </div>
                    <script type="application/json" id="product-variants-data">
                        <?= json_encode($variants ?? [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_UNESCAPED_UNICODE) ?>
                    </script>
                    <div class="row align-items-end g-3">
                        <div class="col-4">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input class="form-control" id="quantity" name="quantity" type="number" min="1" value="1" max="99" required>
                        </div>
                        <div class="col-8">
                            <button class="btn btn-danger brand-red-button btn-wine btn-lg w-100" id="add-to-cart" type="submit" disabled>
                            <span class="me-2" aria-hidden="true">＋</span>Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                    <div class="small text-danger brand-red-text mt-2" id="variant-error" aria-live="polite">
                    </div>
                </form>
                <div class="d-flex gap-4 border-top mt-4 pt-4 small">
                    <span>
                    <span class="me-2" aria-hidden="true">🚚</span>Giao hàng toàn quốc</span>
                    <span>
                    <span class="me-2" aria-hidden="true">↻</span>Hỗ trợ đổi size</span>
                </div>
            </div>
        </div>
        <section class="py-5 mt-4 border-top">
            <div class="row">
                <div class="col-lg-8">
                    <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">Chi tiết sản phẩm</div>
                    <h2 class="h3 mb-3">Chất liệu & phong cách</h2>
                    <p class="text-secondary text-muted-soft">
                        <?= nl2br(view_escape($product['description'] ?? 'Thông tin chi tiết đang được cập nhật.')) ?>
                    </p>
                </div>
            </div>
        </section>
    </div>
</main>
<div class="modal fade" id="sizeGuide" tabindex="-1" aria-labelledby="sizeGuideTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title h5" id="sizeGuideTitle">Hướng dẫn chọn kích cỡ</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng">
                </button>
            </div>
            <div class="modal-body">Chọn kích cỡ bạn thường mang. Nếu ở giữa hai cỡ, hãy liên hệ đội ngũ Fashion Shop để được tư vấn.</div>
            <div class="modal-footer">
                <button class="btn btn-danger brand-red-button btn-wine" data-bs-dismiss="modal">Đã hiểu</button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
