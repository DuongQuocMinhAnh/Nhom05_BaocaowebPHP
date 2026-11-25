CREATE DATABASE IF NOT EXISTS `fashion_store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fashion_store`;

-- Tắt kiểm tra khóa ngoại khi khởi tạo để tránh xung đột thứ tự DROP TABLE
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `product_variants`;
DROP TABLE IF EXISTS `products`;

DROP TABLE IF EXISTS `users`;

SET FOREIGN_KEY_CHECKS = 1;

-- 1. Bảng Users
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fullname` VARCHAR(150) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) NULL,
    `address` VARCHAR(255) NULL,
    `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Bảng Products
CREATE TABLE `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `sub_category` VARCHAR(100) NOT NULL,
    `price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    `image` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Bảng product_variants
CREATE TABLE `product_variants` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT NOT NULL,
    `size` VARCHAR(50) NOT NULL,
    `color` VARCHAR(50) NOT NULL,
    `stock_quantity` INT NOT NULL DEFAULT 0,
    CONSTRAINT `fk_variants_product`
        FOREIGN KEY (`product_id`) 
        REFERENCES `products`(`id`) 
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Bảng orders
CREATE TABLE `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NULL,
    `customer_name` VARCHAR(150) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `total_amount` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    `status` ENUM('Chờ duyệt', 'Đang giao', 'Đã giao', 'Đã hủy') NOT NULL DEFAULT 'Chờ duyệt',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_orders_user`
        FOREIGN KEY (`user_id`) 
        REFERENCES `users`(`id`) 
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Bảng order_items
CREATE TABLE `order_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `variant_id` INT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    CONSTRAINT `fk_order_items_order`
        FOREIGN KEY (`order_id`) 
        REFERENCES `orders`(`id`) 
        ON DELETE CASCADE,
    CONSTRAINT `fk_order_items_variant`
        FOREIGN KEY (`variant_id`) 
        REFERENCES `product_variants`(`id`) 
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- DỮ LIỆU: 

-- 1. Dữ liệu mẫu bảng USERS
-- Ghi chú: Mật khẩu mặc định đều là "123456" đã mã hóa bằng password_hash('123456', PASSWORD_BCRYPT)
-- Hash chuẩn: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
(1, 'Quản Trị Viên', 'admin@fashionstore.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0901234567', 'Cao Lãnh', 'admin', NOW()),
(2, 'Minh Anh', 'user@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0912345678', 'Cao Lãnh', 'user', NOW()),
(3, 'Bảo Như', 'baonhu@fashionstore.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0987654321', 'Cao Lãnh', 'admin', NOW());

-- 2. Dữ liệu mẫu bảng PRODUCTS (5 danh mục chính: Giày, Dép, Sticker, Nón, Ví/Túi xách)
INSERT INTO `products` (`id`, `name`, `category`, `sub_category`, `price`, `image`, `description`, `created_at`) VALUES
-- 1. Danh mục Giày
(1, 'Giày Tây Oxford Nam Classic', 'Giày', 'Giày tây', 850000.00, 'assets/Images/oxford_black.jpg', 'Giày tây da bò cao cấp dáng Oxford sang trọng cho nam giới công sở.', NOW()),
(2, 'Giày Sneaker Thể Thao Streetwear', 'Giày', 'Giày thể thao', 620000.00, 'assets/Images/sneaker_white.jpg', 'Giày sneaker phong cách đường phố năng động, đệm êm thoáng khí.', NOW()),
(3, 'Giày Cao Gót Mũi Nhọn 7cm Nữ', 'Giày', 'Giày nữ', 490000.00, 'assets/Images/highheel_beige.jpg', 'Giày cao gót tôn dáng quý phái, chất liệu da mềm êm chân.', NOW()),

-- 2. Danh mục Dép
(4, 'Dép Quai Ngang Unisex Basic', 'Dép', 'Dép quai ngang', 180000.00, 'assets/Images/slides_black.jpg', 'Dép quai ngang chống trượt, phong cách tối giản tiện dụng thường ngày.', NOW()),
(5, 'Dép Sandal Chiến Binh Đi Học', 'Dép', 'Dép sandal', 250000.00, 'assets/Images/sandal_casual.jpg', 'Sandal học sinh quai dù chắc chắn, thiết kế thanh lịch năng động.', NOW()),

-- 3. Danh mục Sticker
(6, 'Tấm Sticker Chiikawa & Những Người Bạn Dễ Thương', 'Sticker', 'Sticker hoạt hình', 35000.00, 'assets/Images/sticker_chiikawa.jpg', 'Tấm hình dán nhân vật Chiikawa Nhật Bản phong cách chibi đáng yêu trang trí sổ tay, phụ kiện.', NOW()),
(7, 'Set 50 Sticker Meme Mèo Hài Hước Chống Nước', 'Sticker', 'Sticker meme', 45000.00, 'assets/Images/sticker_cat_meme.jpg', 'Bộ 50 hình dán meme mèo biểu cảm siêu bựa chống nước dán mũ bảo hiểm, vali, laptop, ốp lưng.', NOW()),

-- 4. Danh mục Nón
(8, 'Nón Lưỡi Trai Kaki Form Mềm Đen', 'Nón', 'Nón lưỡi trai', 120000.00, 'assets/Images/cap_black.jpg', 'Mũ lưỡi trai vải kaki wash cao cấp, có khóa cài điều chỉnh kích cỡ.', NOW()),
(9, 'Nón Bucket Vành Tròn Thời Trang', 'Nón', 'Nón bucket', 150000.00, 'assets/Images/bucket_hat.jpg', 'Nón vành tròn che nắng chống tia UV, phong cách trẻ trung unisex.', NOW()),

-- 5. Danh mục Ví/Túi xách
(10, 'Ví Da Bò Dáng Đứng Nhiều Ngăn Nam', 'Ví/Túi xách', 'Ví nam', 350000.00, 'assets/Images/wallet_leather.jpg', 'Ví nam da bò thật nhỏ gọn, nhiều ngăn chứa thẻ tiện lợi.', NOW()),
(11, 'Túi Đeo Chéo Canvas Mini Hàn Quốc', 'Ví/Túi xách', 'Túi đeo chéo', 220000.00, 'assets/Images/crossbody_bag.jpg', 'Túi vải canvas thời trang đựng điện thoại, ví tiền nhỏ gọn khi dạo phố.', NOW());

-- 3. Dữ liệu mẫu bảng PRODUCT_VARIANTS (Size, Màu, có cả còn hàng > 0 và hết hàng = 0)
INSERT INTO `product_variants` (`id`, `product_id`, `size`, `color`, `stock_quantity`) VALUES
-- Biến thể Giày Tây Oxford (id: 1)
(1, 1, '39', 'Đen', 15),
(2, 1, '40', 'Đen', 20),
(3, 1, '41', 'Đen', 0),  
(4, 1, '40', 'Nâu', 10),

-- Biến thể Sneaker (id: 2)
(5, 2, '38', 'Trắng', 8),
(6, 2, '39', 'Trắng', 12),
(7, 2, '40', 'Trắng', 0), 
(8, 2, '41', 'Trắng', 14),
(9, 2, '40', 'Đen', 10),

-- Biến thể Giày Cao Gót (id: 3)
(10, 3, '36', 'Kem/Be', 10),
(11, 3, '37', 'Kem/Be', 15),
(12, 3, '38', 'Đen', 0),   

-- Biến thể Dép Quai Ngang (id: 4)
(13, 4, '39', 'Đen', 25),
(14, 4, '40', 'Trắng', 18),
(15, 4, '41', 'Đen', 0),   

-- Biến thể Sandal (id: 5)
(16, 5, '39', 'Đen', 30),
(17, 5, '40', 'Nâu', 15),

-- Biến thể Sticker (id: 6, 7) - Size Tiêu chuẩn
(18, 6, 'Tấm A6', 'Nhiều màu (Chiikawa)', 80),
(19, 7, 'Set 50 cái', 'Nhiều biểu cảm (Meme Mèo)', 120),

-- Biến thể Nón (id: 8, 9)
(20, 8, 'Freesize', 'Đen', 40),
(21, 8, 'Freesize', 'Trắng', 0), 
(22, 9, 'Freesize', 'Đen', 20),
(23, 9, 'Freesize', 'Be', 15),

-- Biến thể Ví/Túi xách (id: 10, 11)
(24, 10, 'Tiêu chuẩn', 'Nâu Bò', 20),
(25, 10, 'Tiêu chuẩn', 'Đen', 15),
(26, 11, 'Mini', 'Đen', 35),
(27, 11, 'Mini', 'Kem', 0); 

-- 4. Dữ liệu mẫu bảng ORDERS (Đủ các trạng thái theo yêu cầu: Chờ duyệt, Đang giao, Đã giao, Đã hủy)
INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `email`, `phone`, `address`, `total_amount`, `status`, `created_at`) VALUES
(1, 2, 'Nguyễn Văn Người Dùng', 'user@gmail.com', '0912345678', 'Số 123 Cầu Giấy, Hà Nội', 850000.00, 'Chờ duyệt', NOW()),
(2, 2, 'Nguyễn Văn Người Dùng', 'user@gmail.com', '0912345678', 'Số 123 Cầu Giấy, Hà Nội', 620000.00, 'Đang giao', NOW()),
(3, 1, 'Khách Vãng Lai VIP', 'vip@gmail.com', '0933333333', 'Quận 1, TP. Hồ Chí Minh', 500000.00, 'Đã giao', NOW()),
(4, 2, 'Nguyễn Văn Người Dùng', 'user@gmail.com', '0912345678', 'Số 123 Cầu Giấy, Hà Nội', 180000.00, 'Đã hủy', NOW());

-- 5. Dữ liệu mẫu bảng ORDER_ITEMS (Chi tiết đơn hàng kèm giá tại thời điểm mua)
INSERT INTO `order_items` (`id`, `order_id`, `variant_id`, `quantity`, `price`) VALUES
-- Đơn hàng 1: Mua 1 đôi Giày Oxford Đen size 39
(1, 1, 1, 1, 850000.00),
-- Đơn hàng 2: Mua 1 đôi Sneaker Trắng size 39
(2, 2, 6, 1, 620000.00),
-- Đơn hàng 3: Mua 2 chiếc Sandal quai đen size 39 (2 x 250.000 = 500.000)
(3, 3, 16, 2, 250000.00),
-- Đơn hàng 4: Mua 1 đôi dép quai ngang (Đã hủy)
(4, 4, 13, 1, 180000.00);