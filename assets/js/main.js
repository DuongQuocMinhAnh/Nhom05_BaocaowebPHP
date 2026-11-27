

document.addEventListener("DOMContentLoaded", function () {
    initProductVariants();
    initFormValidation();
    initRevenueChart();
});

/* 1. CHỌN SIZE, MÀU SẮC VÀ KIỂM TRA TỒN KHO */

function initProductVariants() {
    const form = document.querySelector("[data-variant-form]");

    // Không phải trang chi tiết sản phẩm thì bỏ qua.
    if (!form) return;

    const colorButtons = Array.from(
        form.querySelectorAll("[data-variant-color]")
    );

    const sizeButtons = Array.from(
        form.querySelectorAll("[data-variant-size]")
    );

    const variantIdInput = form.querySelector("#selected-variant-id");
    const stockMessage = form.querySelector("#variant-stock-message");
    const colorLabel = form.querySelector("#selected-color-label");
    const addToCartButton = form.querySelector("#add-to-cart");
    const quantityInput = form.querySelector("#quantity");
    const errorMessage = form.querySelector("#variant-error");

    let selectedColor = "";
    let selectedSize = "";
    let availableStock = 0;

    // Đọc danh sách biến thể từ JSON trong HTML.
    let variants = [];

    const jsonElement = form.querySelector("#product-variants-data");

    try {
        if (jsonElement && jsonElement.textContent.trim() !== "") {
            variants = JSON.parse(jsonElement.textContent);
        } else if (form.dataset.variants) {
            variants = JSON.parse(form.dataset.variants);
        }
    } catch (error) {
        console.error("Không đọc được dữ liệu biến thể sản phẩm:", error);
        showStockMessage("Không thể tải dữ liệu size và màu. Vui lòng tải lại trang.", "error");
        return;
    }

    if (!Array.isArray(variants) || variants.length === 0) {
        showStockMessage("Sản phẩm hiện chưa có biến thể.", "error");
        if (addToCartButton) addToCartButton.disabled = true;
        return;
    }

    // Chuẩn hóa dữ liệu để tránh trường hợp số tồn kho là chuỗi.
    variants = variants.map(function (item) {
        return {
            id: item.id,
            size: String(item.size ?? ""),
            color: String(item.color ?? ""),
            stock_quantity: Number(item.stock_quantity ?? 0)
        };
    });

    function findVariant(color, size) {
        return variants.find(function (item) {
            return item.color === color && item.size === size;
        });
    }

    function showStockMessage(message, type) {
        if (!stockMessage) return;

        stockMessage.textContent = message;
        stockMessage.classList.remove("text-success", "text-danger", "text-secondary");

        if (type === "success") {
            stockMessage.classList.add("text-success");
        } else if (type === "error") {
            stockMessage.classList.add("text-danger");
        } else {
            stockMessage.classList.add("text-secondary");
        }
    }

    function resetPurchase() {
        availableStock = 0;

        if (variantIdInput) variantIdInput.value = "";
        if (addToCartButton) addToCartButton.disabled = true;

        if (quantityInput) {
            quantityInput.value = 1;
            quantityInput.max = 1;
        }
    }

    // Cập nhật trạng thái nút size/màu theo lựa chọn hiện tại.
    function updateOptionStates() {
        colorButtons.forEach(function (button) {
            const color = button.dataset.variantColor;

            const hasAvailableSize = variants.some(function (item) {
                return item.color === color &&
                    item.stock_quantity > 0 &&
                    (!selectedSize || item.size === selectedSize);
            });

            const isSelected = color === selectedColor;

            button.classList.toggle("active", isSelected);
            button.classList.toggle("disabled", !hasAvailableSize);
            button.disabled = !hasAvailableSize;
            button.setAttribute("aria-pressed", isSelected ? "true" : "false");
        });

        sizeButtons.forEach(function (button) {
            const size = button.dataset.variantSize;

            const hasAvailableColor = variants.some(function (item) {
                return item.size === size &&
                    item.stock_quantity > 0 &&
                    (!selectedColor || item.color === selectedColor);
            });

            const isSelected = size === selectedSize;

            button.classList.toggle("active", isSelected);
            button.classList.toggle("disabled", !hasAvailableColor);
            button.disabled = !hasAvailableColor;
            button.setAttribute("aria-pressed", isSelected ? "true" : "false");
        });
    }

    // Kiểm tra cặp size + màu sau mỗi lần người dùng chọn.
    function updateSelectedVariant() {
        resetPurchase();

        if (errorMessage) errorMessage.textContent = "";

        if (colorLabel) {
            colorLabel.textContent = selectedColor || "Chọn màu";
        }

        updateOptionStates();

        if (!selectedColor || !selectedSize) {
            showStockMessage("Vui lòng chọn màu và kích cỡ để kiểm tra tồn kho.", "normal");
            return;
        }

        const variant = findVariant(selectedColor, selectedSize);

        if (!variant) {
            showStockMessage("Không có biến thể phù hợp với lựa chọn này.", "error");
            return;
        }

        if (variant.stock_quantity <= 0) {
            showStockMessage("Hết hàng với lựa chọn này.", "error");
            return;
        }

        // Còn hàng: gán ID biến thể và mở nút mua.
        availableStock = variant.stock_quantity;

        if (variantIdInput) {
            variantIdInput.value = variant.id;
        }

        if (quantityInput) {
            quantityInput.value = 1;
            quantityInput.min = 1;
            quantityInput.max = availableStock;
        }

        if (addToCartButton) {
            addToCartButton.disabled = false;
        }

        showStockMessage("Còn " + availableStock + " sản phẩm trong kho.", "success");
    }

    // Người dùng chọn màu.
    colorButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            selectedColor = button.dataset.variantColor || "";

            // Nếu size đang chọn không có ở màu mới thì bỏ chọn size.
            if (selectedSize && !findVariant(selectedColor, selectedSize)) {
                selectedSize = "";
            }

            updateSelectedVariant();
        });
    });

    // Người dùng chọn size.
    sizeButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            selectedSize = button.dataset.variantSize || "";

            // Nếu màu đang chọn không có size mới thì bỏ chọn màu.
            if (selectedColor && !findVariant(selectedColor, selectedSize)) {
                selectedColor = "";
            }

            updateSelectedVariant();
        });
    });

    // Không cho nhập số lượng nhỏ hơn 1 hoặc lớn hơn tồn kho.
    if (quantityInput) {
        quantityInput.addEventListener("input", function () {
            let quantity = Number(quantityInput.value);

            if (!Number.isFinite(quantity) || quantity < 1) {
                quantityInput.value = 1;
                quantity = 1;
            }

            if (availableStock > 0 && quantity > availableStock) {
                quantityInput.value = availableStock;
            }
        });
    }

    // Kiểm tra lần cuối trước khi gửi form thêm vào giỏ hàng.
    form.addEventListener("submit", function (event) {
        const selectedVariantId = variantIdInput ? variantIdInput.value : "";

        if (!selectedVariantId || availableStock <= 0) {
            event.preventDefault();

            if (errorMessage) {
                errorMessage.textContent = "Vui lòng chọn Size và Màu còn hàng trước khi thêm vào giỏ.";
            }

            return;
        }

        const quantity = Number(quantityInput ? quantityInput.value : 1);

        if (!Number.isInteger(quantity) || quantity < 1 || quantity > availableStock) {
            event.preventDefault();

            if (errorMessage) {
                errorMessage.textContent = "Số lượng phải từ 1 đến " + availableStock + ".";
            }
        }
    });

    // Thiết lập giao diện ban đầu.
    resetPurchase();
    updateOptionStates();
}

/* 2. KIỂM TRA DỮ LIỆU BIỂU MẪU (FORM VALIDATION) */

function initFormValidation() {
    const registerForm = document.querySelector("#register-form");
    const checkoutForm = document.querySelector("#checkout-form");

    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            if (!validateCommonFields(registerForm, false)) {
                event.preventDefault();
                focusFirstInvalid(registerForm);
                return;
            }

            const password = registerForm.querySelector("#password");
            const confirmPassword = registerForm.querySelector("#confirm_password");

            if (password && confirmPassword && password.value !== confirmPassword.value) {
                event.preventDefault();
                setFieldError(confirmPassword, "Mật khẩu nhập lại không khớp.");
                confirmPassword.focus();
                return;
            }

            if (confirmPassword) clearFieldError(confirmPassword);
        });
    }

    if (checkoutForm) {
        checkoutForm.addEventListener("submit", function (event) {
            if (!validateCommonFields(checkoutForm, true)) {
                event.preventDefault();
                focusFirstInvalid(checkoutForm);
            }
        });
    }
}

// Kiểm tra email, số điện thoại và các trường bắt buộc.
function validateCommonFields(form, phoneRequired) {
    let isValid = true;

    const emailInput = form.querySelector('input[type="email"]');
    const phoneInput = form.querySelector('input[name="phone"], input[name="customer_phone"], #phone');
    const requiredInputs = Array.from(form.querySelectorAll("[required]"));

    // Xóa thông báo lỗi cũ trước khi kiểm tra lại.
    requiredInputs.forEach(function (input) {
        clearFieldError(input);
    });

    // Kiểm tra các trường bắt buộc.
    requiredInputs.forEach(function (input) {
        if (input.type === "checkbox" && !input.checked) {
            setFieldError(input, "Vui lòng xác nhận mục này.");
            isValid = false;
        } else if (input.type !== "checkbox" && !input.value.trim()) {
            setFieldError(input, "Vui lòng nhập thông tin này.");
            isValid = false;
        }
    });

    // Kiểm tra định dạng email.
    if (emailInput && emailInput.value.trim() !== "") {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

        if (!emailPattern.test(emailInput.value.trim())) {
            setFieldError(emailInput, "Email chưa đúng định dạng. Ví dụ: ten@gmail.com");
            isValid = false;
        }
    }

    // Số điện thoại đăng ký có thể để trống; thanh toán thì bắt buộc.
    if (phoneInput) {
        const phone = phoneInput.value.trim();

        if (phoneRequired && phone === "") {
            setFieldError(phoneInput, "Vui lòng nhập số điện thoại nhận hàng.");
            isValid = false;
        } else if (phone !== "") {
            const normalizedPhone = phone.replace(/[\s.-]/g, "");
            const phonePattern = /^(0\d{9}|\+84\d{9})$/;

            if (!phonePattern.test(normalizedPhone)) {
                setFieldError(phoneInput, "Số điện thoại phải có 10 số, hoặc bắt đầu bằng +84.");
                isValid = false;
            }
        }
    }

    // Kiểm tra các trường theo thuộc tính HTML: required, minlength, type...
    requiredInputs.forEach(function (input) {
        if (input.type !== "checkbox" && input.value.trim() !== "" && !input.checkValidity()) {
            if (!input.classList.contains("is-invalid")) {
                setFieldError(input, input.validationMessage || "Thông tin chưa hợp lệ.");
            }
            isValid = false;
        }
    });

    return isValid;
}

// Hiển thị lỗi ngay dưới ô nhập liệu.
function setFieldError(input, message) {
    if (!input) return;

    input.classList.add("is-invalid");
    input.setAttribute("aria-invalid", "true");

    let feedback = input.parentElement.querySelector(".js-validation-message");

    if (!feedback) {
        feedback = document.createElement("div");
        feedback.className = "invalid-feedback js-validation-message";
        input.insertAdjacentElement("afterend", feedback);
    }

    feedback.textContent = message;
}

// Xóa trạng thái lỗi khi người dùng sửa dữ liệu.
function clearFieldError(input) {
    if (!input) return;

    input.classList.remove("is-invalid");
    input.removeAttribute("aria-invalid");

    const feedback = input.parentElement.querySelector(".js-validation-message");

    if (feedback) {
        feedback.remove();
    }
}

// Khi người dùng nhập lại, xóa lỗi của ô đó.
document.addEventListener("input", function (event) {
    if (event.target.matches("#register-form input, #register-form textarea, #checkout-form input, #checkout-form textarea")) {
        clearFieldError(event.target);
    }
});

function focusFirstInvalid(form) {
    const firstInvalid = form.querySelector(".is-invalid");

    if (firstInvalid) {
        firstInvalid.focus();
    }
}

/* 3. BIỂU ĐỒ DOANH THU TRÊN TRANG QUẢN TRỊ */

function initRevenueChart() {
    const canvas = document.querySelector("#revenueChart");
    const dataElement = document.querySelector("#revenue-chart-data");

    // Không phải trang Admin Dashboard thì không cần tạo biểu đồ.
    if (!canvas || !dataElement) return;

    // Kiểm tra thư viện Chart.js đã được tải chưa.
    if (typeof Chart === "undefined") {
        console.error("Chart.js chưa được tải. Vui lòng kiểm tra đường dẫn thư viện trong footer.php.");
        return;
    }

    let chartData;

    try {
        chartData = JSON.parse(dataElement.textContent);
    } catch (error) {
        console.error("Không đọc được dữ liệu biểu đồ doanh thu:", error);
        return;
    }

    const labels = Array.isArray(chartData.labels) ? chartData.labels : [];
    const values = Array.isArray(chartData.values)
        ? chartData.values.map(function (value) {
            return Number(value) || 0;
        })
        : [];

    new Chart(canvas, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Doanh thu",
                data: values,
                backgroundColor: "rgba(123, 38, 56, 0.72)",
                borderColor: "#7b2638",
                borderWidth: 1,
                borderRadius: 6,
                maxBarThickness: 42
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: "top"
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const amount = Number(context.parsed.y || 0);
                            return "Doanh thu: " + amount.toLocaleString("vi-VN") + " ₫";
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return Number(value).toLocaleString("vi-VN") + " ₫";
                        }
                    }
                }
            }
        }
    });
}
