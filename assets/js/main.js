/**
 * ĐỒ ÁN LẬP TRÌNH WEB PHP - NHÓM 05
 * Thành viên phụ trách JS: Hoàng Phúc
 * File: assets/js/main.js
 */

document.addEventListener('DOMContentLoaded', function () {

    const navBar = document.querySelector('.site-nav');
    if (navBar) {
        window.addEventListener('scroll', function () {
            // Nếu cuộn chuột xuống quá 40px thì thêm class scrolled
            if (window.scrollY > 40) {
                navBar.classList.add('scrolled');
            } else {
                navBar.classList.remove('scrolled');
            }
        });
    }


    const variantForm = document.getElementById('product-variant-form');

    if (variantForm) {
        // Lấy danh sách biến thể từ thẻ script json trong html
        let variantsList = [];
        const jsonTag = document.getElementById('product-variants-data');
        if (jsonTag) {
            try {
                variantsList = JSON.parse(jsonTag.textContent);
            } catch (err) {
                console.log('Lỗi đọc dữ liệu biến thể:', err);
            }
        }

        // Lấy các nút và phần tử trên giao diện
        const colorButtons = document.querySelectorAll('.variant-color-option');
        const sizeButtons = document.querySelectorAll('.variant-size-option');
        const inputVariantId = document.getElementById('selected-variant-id');
        const stockMessage = document.getElementById('variant-stock-message');
        const btnAddToCart = document.getElementById('add-to-cart');
        const lblSelectedColor = document.getElementById('selected-color-label');
        const inputQuantity = document.getElementById('quantity');

        // Biến lưu màu và size khách đang bấm chọn
        let currentColor = '';
        let currentSize = '';

        // Hàm kiểm tra và cập nhật tồn kho khi khách chọn màu hoặc size
        function checkStockAndVariants() {
            // Khi đã chọn màu, kiểm tra xem size nào của màu này còn hàng thì cho bấm, hết thì mờ đi
            if (currentColor !== '') {
                sizeButtons.forEach(function (btnSize) {
                    const sizeValue = btnSize.getAttribute('data-variant-size') || btnSize.getAttribute('data-variant-size-choice');

                    // Tìm biến thể khớp với màu và size này
                    const item = variantsList.find(function (v) {
                        return v.color === currentColor && v.size === sizeValue;
                    });

                    // Nếu không có hoặc số lượng tồn kho <= 0 thì khóa nút size này
                    if (!item || parseInt(item.stock_quantity) <= 0) {
                        btnSize.classList.add('disabled');
                        // Nếu đang chọn trúng size hết hàng thì hủy chọn
                        if (currentSize === sizeValue) {
                            currentSize = '';
                            btnSize.classList.remove('active');
                        }
                    } else {
                        btnSize.classList.remove('disabled');
                    }
                });
            }

            // Trường hợp 1: Khách chưa chọn đủ cả Màu và Size
            if (currentColor === '' || currentSize === '') {
                inputVariantId.value = '';
                btnAddToCart.disabled = true; // Khóa nút Thêm vào giỏ
                if (stockMessage) {
                    stockMessage.className = 'small mt-2 text-muted';
                    stockMessage.innerText = 'Vui lòng chọn màu sắc và kích cỡ.';
                }
                return;
            }

            // Trường hợp 2: Khách đã chọn đủ cả Màu và Size -> Tìm biến thể tương ứng
            const foundVariant = variantsList.find(function (v) {
                return v.color === currentColor && v.size === currentSize;
            });

            if (foundVariant) {
                const stockQty = parseInt(foundVariant.stock_quantity);

                if (stockQty > 0) {
                    // CÒN HÀNG: Cho phép mua
                    inputVariantId.value = foundVariant.id; // Gán id biến thể vào input ẩn
                    btnAddToCart.disabled = false;           // Mở khóa nút Thêm vào giỏ

                    if (inputQuantity) {
                        inputQuantity.max = stockQty; // Không cho mua vượt quá tồn kho
                    }
                    if (stockMessage) {
                        stockMessage.className = 'small mt-2 in-stock';
                        stockMessage.innerText = 'Còn ' + stockQty + ' sản phẩm trong kho.';
                    }
                } else {
                    // HẾT HÀNG: Khóa nút mua
                    inputVariantId.value = '';
                    btnAddToCart.disabled = true;
                    if (stockMessage) {
                        stockMessage.className = 'small mt-2 out-of-stock';
                        stockMessage.innerText = 'Mẫu này tạm thời hết hàng.';
                    }
                }
            } else {
                // Không tìm thấy biến thể
                inputVariantId.value = '';
                btnAddToCart.disabled = true;
                if (stockMessage) {
                    stockMessage.className = 'small mt-2 out-of-stock';
                    stockMessage.innerText = 'Không có mẫu này.';
                }
            }
        }

        // Bắt sự kiện khi click chọn Màu
        colorButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Bỏ class active ở các nút màu khác
                colorButtons.forEach(function (b) { b.classList.remove('active'); });
                // Thêm active cho nút vừa bấm
                btn.classList.add('active');
                currentColor = btn.getAttribute('data-variant-color');

                if (lblSelectedColor) {
                    lblSelectedColor.innerText = currentColor;
                }
                checkStockAndVariants();
            });
        });

        // Bắt sự kiện khi click chọn Size
        sizeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Nếu nút size này bị khóa (hết hàng) thì không làm gì
                if (btn.classList.contains('disabled')) {
                    return;
                }
                // Bỏ active ở các nút size khác
                sizeButtons.forEach(function (b) { b.classList.remove('active'); });
                // Thêm active cho nút vừa bấm
                btn.classList.add('active');
                currentSize = btn.getAttribute('data-variant-size') || btn.getAttribute('data-variant-size-choice');

                checkStockAndVariants();
            });
        });

        // Tự động bấm chọn màu đầu tiên cho tiện
        if (colorButtons.length > 0) {
            colorButtons[0].click();
        }
    }

    const canvasChart = document.getElementById('revenueChart');
    if (canvasChart && typeof Chart !== 'undefined') {
        // Dữ liệu mặc định 12 tháng
        let chartLabels = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'];
        let chartValues = [1200000, 1800000, 1500000, 2100000, 2400000, 1950000, 2800000, 3100000, 2600000, 3400000, 3900000, 1970000];

        // Đọc dữ liệu từ PHP truyền sang nếu có
        const chartJson = document.getElementById('revenue-chart-data');
        if (chartJson) {
            try {
                const dataFromPhp = JSON.parse(chartJson.textContent);
                if (dataFromPhp.labels && dataFromPhp.values) {
                    chartLabels = dataFromPhp.labels;
                    chartValues = dataFromPhp.values;
                }
            } catch (err) {
                console.log('Lỗi đọc dữ liệu biểu đồ:', err);
            }
        }

        // Tạo biểu đồ đường bằng thư viện Chart.js
        new Chart(canvasChart, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: chartValues,
                    borderColor: '#d32f2f',
                    backgroundColor: 'rgba(211, 47, 47, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
    // 4.1. Kiểm tra form Đăng ký (views/auth/register.php)
    const formRegister = document.querySelector('form[action="/register"]');
    if (formRegister) {
        formRegister.addEventListener('submit', function (event) {
            const inputEmail = formRegister.querySelector('input[name="email"]');
            const inputPass = formRegister.querySelector('input[name="password"]');
            const inputConfirm = formRegister.querySelector('input[name="confirm_password"]');
            const inputPhone = formRegister.querySelector('input[name="phone"]');

            // Kiểm tra mật khẩu tối thiểu 6 ký tự
            if (inputPass && inputPass.value.length < 6) {
                alert('Mật khẩu phải có ít nhất 6 ký tự!');
                inputPass.focus();
                event.preventDefault();
                return;
            }

            // Kiểm tra mật khẩu nhập lại có khớp không
            if (inputConfirm && inputPass && inputConfirm.value !== inputPass.value) {
                alert('Mật khẩu nhập lại không khớp!');
                inputConfirm.focus();
                event.preventDefault();
                return;
            }

            // Kiểm tra số điện thoại có phải 10 chữ số không
            const phoneRegex = /^[0-9]{10}$/;
            if (inputPhone && inputPhone.value.trim() !== '' && !phoneRegex.test(inputPhone.value.trim())) {
                alert('Số điện thoại phải gồm đúng 10 chữ số!');
                inputPhone.focus();
                event.preventDefault();
                return;
            }
        });
    }

    // 4.2. Kiểm tra form Thanh toán (views/client/checkout.php)
    const formCheckout = document.querySelector('form[action="/checkout"]');
    if (formCheckout) {
        formCheckout.addEventListener('submit', function (event) {
            const inputName = formCheckout.querySelector('input[name="customer_name"]');
            const inputPhone = formCheckout.querySelector('input[name="phone"]');
            const inputAddress = formCheckout.querySelector('input[name="address"]');

            if (inputName && inputName.value.trim() === '') {
                alert('Vui lòng nhập họ tên người nhận hàng!');
                inputName.focus();
                event.preventDefault();
                return;
            }

            const phoneRegex = /^[0-9]{10}$/;
            if (inputPhone && !phoneRegex.test(inputPhone.value.trim())) {
                alert('Số điện thoại nhận hàng không đúng định dạng (10 số)!');
                inputPhone.focus();
                event.preventDefault();
                return;
            }

            if (inputAddress && inputAddress.value.trim() === '') {
                alert('Vui lòng nhập địa chỉ nhận hàng!');
                inputAddress.focus();
                event.preventDefault();
                return;
            }
        });
    }

});
