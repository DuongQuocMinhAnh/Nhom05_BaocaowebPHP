<?php
$pageTitle = 'FASHIONSHOP — Phụ kiện & giày dép';
$activePage = 'home';
include __DIR__ . '/../layouts/header.php';


// [BANNER 1] Banner toàn chiều ngang đầu trang.
$heroBanner = $heroBanner ?? [
    'image' => 'assets/Images/wear_the_attitude.png',
    'alt' => 'FASHIONSHOP — Bộ sưu tập thời trang và phụ kiện',
];

// [BANNER 2] Ảnh nhỏ hình viên thuốc nằm giữa dòng tiêu đề giới thiệu 
$inlinePillBanner = $inlinePillBanner ?? 'assets/Images/red_tinted.jpg';

// [BANNER 3, 4, 5] 3 ảnh Lookbook ngang hàng ở giữa trang 
$lookbookBanners = $lookbookBanners ?? [
    [
        'image' => 'assets/Images/sneaker_white.jpg',
        'alt' => 'Lookbook Giày Sneaker đường phố',
        'label' => 'Streetwear',
        'url' => '/collection?category=Gi%C3%A0y',
    ],
    [
        'image' => 'assets/Images/highheel_beige.jpg',
        'alt' => 'Lookbook Giày nữ thanh lịch',
        'label' => 'Minimal Chic',
        'url' => '/collection?category=Gi%C3%A0y&sub_category=Gi%C3%A0y%20n%E1%BB%AF',
    ],
    [
        'image' => 'assets/Images/crossbody_bag.jpg',
        'alt' => 'Lookbook Túi đeo chéo & phụ kiện',
        'label' => 'Everyday Carry',
        'url' => '/collection?category=V%C3%AD%2FT%C3%BAi%20x%C3%A1ch',
    ],
];

// [BANNER 6 - 10] Lối tắt 5 bộ sưu tập chính khớp CSDL
$categories = $categories ?? [
    [
        'name' => 'Giày',
        'sub' => 'Giày tây · Sneaker · Giày nữ',
        'image' => 'assets/Images/sneaker_white.jpg',
    ],
    [
        'name' => 'Dép',
        'sub' => 'Dép quai ngang · Sandal',
        'image' => 'assets/Images/slides_black.jpg',
    ],
    [
        'name' => 'Sticker',
        'sub' => 'Sticker hoạt hình & meme',
        'image' => 'assets/Images/sticker_chiikawa.jpg',
    ],
    [
        'name' => 'Nón',
        'sub' => 'Nón lưỡi trai · Bucket',
        'image' => 'assets/Images/cap_black.jpg',
    ],
    [
        'name' => 'Ví/Túi xách',
        'sub' => 'Ví nam · Túi đeo chéo',
        'image' => 'assets/Images/crossbody_bag.jpg',
    ],
];

// [BANNER 11] Banner câu chuyện thương hiệu cuối trang 
$storyBanner = $storyBanner ?? [
    'image' => 'assets/Images/fashion.jpg',
    'alt' => 'Phong cách FASHIONSHOP mỗi ngày',
];
?>
<main>
    <!-- Banner dùng nguyên tỷ lệ ảnh, tràn hết chiều ngang và không bo khung. -->
    <section class="home-hero position-relative overflow-hidden bg-dark" aria-label="Banner FASHIONSHOP">
        <img src="<?= view_escape($heroBanner['image']) ?>" alt="<?= view_escape($heroBanner['alt']) ?>" class="hero-banner-image d-block w-100" data-image-hover loading="eager">
        <div class="position-absolute bottom-0 start-0 p-3 p-md-5">
            <div class="bg-dark bg-opacity-75 text-white rounded-4 p-3 p-md-4">
                <p class="small text-uppercase fw-bold text-success mb-2">FASHIONSHOP • FALL/WINTER DROP 01</p>
                <h1 class="display-font h2 fw-bold text-uppercase mb-1">Break the rules</h1>
                <p class="small text-white-50 mb-0">Bộ sưu tập phụ kiện và giày dép định hình bản sắc đường phố</p>
            </div>
        </div>
    </section>

    <!-- =========================================================
         PHẦN 2: TUYÊN NGÔN THƯƠNG HIỆU & 3 ẢNH LOOKBOOK
         (Thay link tại $inlinePillBanner và $lookbookBanners)
         ========================================================= -->
    <section class="section-space py-5 bg-light">
        <div class="container py-3">
            <!-- Khối chữ lớn kèm ảnh nhỏ giữa dòng -->
            <div class="row align-items-start g-3 mb-5">
                <div class="col-lg-10">
                    <h2 class="display-font display-5 fw-normal text-uppercase lh-sm mb-3">
                        THIẾT KẾ TINH GỌN
                        <!-- [BANNER 2] Ảnh nhỏ hình viên thuốc chèn giữa tiêu đề -->
                        <img src="<?= view_escape($inlinePillBanner) ?>" alt="Phụ kiện FASHIONSHOP" class="rounded-pill object-fit-cover align-middle mx-1 border banner-pill-image" width="88" height="42" loading="lazy">
                        <span class="text-secondary">ĐỊNH HÌNH VĂN HÓA PHONG CÁCH ĐƯƠNG ĐẠI</span>
                    </h2>
                    <p class="small text-secondary col-lg-7 mb-0">
                        Fashion Shop kết hợp chất liệu bền bỉ, phom dáng tối giản và chi tiết cá tính để bạn tự tin phối đồ mỗi ngày — từ công sở, dạo phố đến những chuyến đi xa.
                    </p>
                </div>
                <div class="col-auto ms-auto d-none d-lg-block text-end small text-uppercase text-secondary">
                    Fashion Shop Studio<br>2026
                </div>
            </div>

            <!-- Hàng dưới: Nhãn trái + 3 thẻ Lookbook phải -->
            <div class="row align-items-stretch g-4">
                <div class="col-lg-3">
                    <div class="card bg-dark text-white border-0 rounded-4 h-100 p-4 p-xl-5 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge rounded-pill border border-light border-opacity-50 bg-transparent text-light fw-normal">FASHIONSHOP · 2026</span>
                        </div>
                        <div>
                            <div class="small text-uppercase fw-bold text-success mb-2">Lookbook mới nhất</div>
                            <h3 class="display-font h2 fw-normal text-uppercase mb-3">Chọn phong cách của bạn</h3>
                            <a href="/collection" class="link-light text-uppercase small fw-semibold text-decoration-none">Xem tất cả thiết kế <span aria-hidden="true">↗</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row g-3">
                        <?php foreach ($lookbookBanners as $idx => $banner): ?>
                            <!-- [BANNER <?= $idx + 3 ?>] Ảnh Lookbook #<?= $idx + 1 ?> -->
                            <div class="col-4">
                                <a href="<?= view_escape($banner['url']) ?>" class="d-block text-decoration-none">
                                    <div class="card border-0 rounded-4 overflow-hidden shadow-sm ratio ratio-1x1">
                                        <img src="<?= view_escape($banner['image']) ?>" alt="<?= view_escape($banner['alt']) ?>" class="card-img object-fit-cover" loading="lazy">
                                        <div class="card-img-overlay d-flex align-items-end p-2 p-md-3 bg-dark bg-opacity-25">
                                            <span class="badge rounded-pill bg-dark bg-opacity-75 text-white fw-normal"><?= view_escape($banner['label']) ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         PHẦN 3: TIÊU ĐỀ CĂN GIỮA & 5 BỘ SƯU TẬP CHÍNH
         (Thay link tại $categories - BANNER 6 đến BANNER 10)
         ========================================================= -->
    <section class="section-space py-5 bg-white border-top border-bottom">
        <div class="container py-3">
            <div class="text-center mb-5">
                <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">Chọn theo phong cách</div>
                <h2 class="display-font display-5 fw-semibold text-uppercase mb-3">
                    <span class="text-secondary">MỌI PHỤ KIỆN</span> BẠN CẦN ĐỂ TỎA SÁNG
                </h2>
                <p class="small text-secondary col-lg-6 mx-auto mb-0">
                    Khám phá 5 bộ sưu tập chủ lực tại Fashion Shop — phối hợp linh hoạt từ giày dép đi làm, đi chơi đến nón, ví và sticker cá tính.
                </p>
            </div>

            <!-- 5 thẻ bộ sưu tập kiểu showcase tối màu (thẻ giữa nổi bật hơn trên màn hình lớn) -->
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 align-items-center">
                <?php foreach ($categories as $index => $category): ?>
                    <?php $isCenterHighlight = ($index === 2); ?>
                    <!-- [BANNER <?= $index + 6 ?>] Ảnh bộ sưu tập: <?= view_escape($category['name']) ?> -->
                    <div class="col">
                        <a href="/collection?category=<?= rawurlencode($category['name']) ?>" class="text-decoration-none">
                            <div class="product-category-card card border-0 bg-dark text-white rounded-4 overflow-hidden <?= $isCenterHighlight ? 'shadow-lg' : 'shadow-sm' ?>">
                                <div class="ratio ratio-1x1">
                                    <img src="<?= view_escape($category['image']) ?>" alt="<?= view_escape($category['name']) ?>" class="card-img object-fit-cover opacity-75 image-hover" data-image-hover loading="lazy">
                                    <div class="card-img-overlay d-flex flex-column justify-content-between p-3 bg-dark bg-opacity-50">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge rounded-pill border border-light border-opacity-50 bg-dark bg-opacity-50 fw-normal">0<?= $index + 1 ?></span>
                                            <span class="small" aria-hidden="true">↗</span>
                                        </div>
                                        <div>
                                            <div class="small text-white-50 mb-1"><?= view_escape($category['sub']) ?></div>
                                            <h3 class="h5 fw-semibold mb-0"><?= view_escape($category['name']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- =========================================================
         PHẦN 4: LƯỚI SẢN PHẨM NỔI BẬT (4 CỘT PC / 2 CỘT MOBILE)
         (Dữ liệu tự động lấy từ CSDL qua biến $featuredProducts)
         ========================================================= -->
    <section class="section-space py-5">
        <div class="container py-2">
            <div class="row align-items-end mb-4">
                <div class="col">
                    <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-2">Được yêu thích</div>
                    <h2 class="display-font display-6 fw-semibold text-uppercase mb-0">LỰA CHỌN NỔI BẬT</h2>
                </div>
                <div class="col-auto">
                    <a href="/collection?sort=popular" class="btn btn-outline-danger brand-outline-button btn-outline-wine rounded-pill btn-sm px-3">Xem bộ sưu tập <span aria-hidden="true">→</span></a>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach (($featuredProducts ?? []) as $product): ?>
                    <div class="col-6 col-lg-3">
                        <article class="product-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <a class="text-decoration-none text-dark" href="/product?id=<?= (int)($product['id'] ?? 0) ?>">
                                <div class="ratio ratio-1x1 bg-light">
                                    <img class="card-img-top product-card-image object-fit-cover image-hover" data-image-hover src="<?= view_escape($product['image'] ?? '') ?>" alt="<?= view_escape($product['name'] ?? 'Sản phẩm') ?>" loading="lazy">
                                </div>
                                <div class="card-body">
                                    <div class="small text-secondary text-muted-soft">
                                        <?= view_escape($product['category'] ?? '') ?> · <?= view_escape($product['sub_category'] ?? '') ?>
                                    </div>
                                    <h3 class="h6 mt-2 mb-1">
                                        <?= view_escape($product['name'] ?? '') ?>
                                    </h3>
                                    <div class="fw-bold text-danger brand-red-text">
                                        <?= number_format((float)($product['price'] ?? 0), 0, ',', '.') ?>₫
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($featuredProducts)): ?>
                    <div class="col-12">
                        <div class="p-4 bg-light rounded-3 text-secondary text-muted-soft text-center">Sản phẩm nổi bật sẽ hiển thị tại đây.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- =========================================================
         PHẦN 5: BANNER CÂU CHUYỆN THƯƠNG HIỆU CUỐI TRANG
         (Thay link tại $storyBanner - BANNER 11)
         ========================================================= -->
    <section class="section-space py-5 bg-light border-top">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <!-- [BANNER 11] Ảnh minh họa câu chuyện thương hiệu -->
                    <img class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover" src="<?= view_escape($storyBanner['image']) ?>" alt="<?= view_escape($storyBanner['alt']) ?>" loading="lazy">
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text mb-3">Fashion Shop · Made for your everyday</div>
                    <h2 class="display-font display-5 fw-semibold text-uppercase mb-4">MỌI CHI TIẾT<br>ĐỀU CÓ LÝ DO.</h2>
                    <p class="text-secondary text-muted-soft">Từ đôi giày đồng hành suốt ngày dài đến món phụ kiện khiến bạn mỉm cười mỗi khi nhìn thấy. Chúng tôi tin phong cách nằm trong những lựa chọn rất riêng.</p>
                    <a href="/collection" class="btn btn-danger brand-red-button btn-wine rounded-pill px-4 mt-3">Tìm món dành cho bạn <span class="ms-2" aria-hidden="true">↗</span></a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>