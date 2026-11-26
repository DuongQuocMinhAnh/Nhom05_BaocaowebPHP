<footer class="site-footer bg-dark text-light pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4 pb-4">
            <div class="col-lg-4">
                <a class="brand-mint-text text-light text-decoration-none fw-bold display-font" href="/">FASHIONSHOP<small class="d-block text-white-50">ACCESSORIES &amp; FOOTWEAR</small>
                </a>
                <p class="small text-white-50 mt-3 mb-0">Những món đồ nhỏ tạo nên dấu ấn lớn. Chọn phụ kiện dành riêng cho nhịp sống của bạn.</p>
            </div>
            <div class="col-6 col-lg-2">
                <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text text-white-50 mb-3">Khám phá</div>
                <a class="link-light text-decoration-none d-block small mb-2" href="/collection?category=Giày">Giày dép</a>
                <a class="link-light text-decoration-none d-block small mb-2" href="/collection?category=Nón">Nón & phụ kiện</a>
                <a class="link-light text-decoration-none d-block small mb-2" href="/collection">Bộ sưu tập</a>
            </div>
            <div class="col-6 col-lg-2">
                <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text text-white-50 mb-3">Hỗ trợ</div>
                <a class="link-light text-decoration-none d-block small mb-2" href="/my-orders">Tra cứu đơn hàng</a>
                <a class="link-light text-decoration-none d-block small mb-2" href="#policy">Chính sách đổi trả</a>
                <a class="link-light text-decoration-none d-block small mb-2" href="#contact">Liên hệ</a>
            </div>
            <div class="col-lg-4">
                <div class="eyebrow small text-uppercase fw-bold text-danger brand-red-text text-white-50 mb-3">Luôn cập nhật</div>
                <p class="small text-white-50">Theo dõi bộ sưu tập mới và ưu đãi dành riêng cho bạn.</p>
                <form action="/newsletter" method="post" class="d-flex gap-2">
                    <label class="visually-hidden" for="newsletter-email">Email</label>
                    <input class="form-control" id="newsletter-email" type="email" name="email" placeholder="Email của bạn" required>
                    <button class="btn btn-light" type="submit" aria-label="Đăng ký">
                    <span aria-hidden="true">→</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="border-top border-light border-opacity-25 pt-3 d-flex flex-column flex-md-row justify-content-between small text-white-50">
            <span>© <?= date('Y') ?> FASHIONSHOP. Fashion accessories & footwear.</span>
            <span>Thanh toán an toàn · Giao hàng toàn quốc</span>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js">
</script>
<script src="assets/js/main.js">
</script>
</body>
</html>
