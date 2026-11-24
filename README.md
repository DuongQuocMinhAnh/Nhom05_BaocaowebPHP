# Dự Án Website Phụ Kiện Thời Trang (Fashion Accessories MVC)

> **Môn học:** Báo cáo đồ án Lập trình Web PHP  
> **Nhóm thực hiện:** Nhóm 05  
> **Kiến trúc:** Mô hình MVC (Model - View - Controller) thuần, kết nối cơ sở dữ liệu qua PHP PDO.

---

## Sơ đồ cấu trúc thư mục

```text
Nhom05_BaocaowebPHP/
├── index.php                         # Front Controller điều hướng toàn bộ ứng dụng
├── README.md                         # Tài liệu thuyết minh cấu trúc & công dụng file
├── config/
│   └── database.php                  # Kết nối CSDL MySQL (PDO)
├── database/
│   └── fashion_store.sql             # Script khởi tạo CSDL & dữ liệu mẫu
├── models/
│   ├── UserModel.php                 # Quản lý người dùng, tài khoản & phân quyền
│   ├── ProductModel.php              # Quản lý danh mục & thông tin sản phẩm
│   ├── VariantModel.php              # Quản lý biến thể sản phẩm (Size, Màu, Tồn kho)
│   └── OrderModel.php                # Xử lý đơn hàng & thống kê doanh thu
├── controllers/
│   ├── HomeController.php            # Điều hướng trang khách hàng (Home, Detail, Collection)
│   ├── AuthController.php            # Xử lý đăng ký, đăng nhập, phân quyền, đăng xuất
│   ├── CartController.php            # Xử lý giỏ hàng & thanh toán
│   └── AdminController.php           # Quản trị viên (Dashboard, Quản lý SP, Đơn hàng)
├── views/
│   ├── layouts/
│   │   ├── header.php                # Giao diện đầu trang, thanh điều hướng Navbar 2 cấp
│   │   └── footer.php                # Chân trang, nhúng thư viện JS (Bootstrap, Chart.js)
│   ├── client/
│   │   ├── home.php                  # Giao diện Trang chủ (Banner, Sản phẩm nổi bật)
│   │   ├── collection.php            # Giao diện danh mục/bộ sưu tập sản phẩm kèm bộ lọc
│   │   ├── product_detail.php        # Trang chi tiết sản phẩm, chọn biến thể Màu/Size
│   │   ├── cart.php                  # Giao diện xem giỏ hàng
│   │   ├── checkout.php              # Giao diện nhập thông tin đặt hàng & thanh toán
│   │   └── my_orders.php             # Lịch sử đơn hàng của khách hàng
│   ├── auth/
│   │   ├── login.php                 # Giao diện Đăng nhập
│   │   └── register.php              # Giao diện Đăng ký tài khoản
│   └── admin/
│       ├── dashboard.php             # Bảng điều khiển thống kê doanh thu & đơn hàng
│       ├── products.php              # Giao diện danh sách & quản lý CRUD sản phẩm
│       ├── variants.php              # Giao diện quản lý biến thể (Size, Màu sắc, Số lượng tồn)
│       ├── orders.php                # Giao diện danh sách và duyệt trạng thái đơn hàng
│       └── order_detail.php          # Giao diện chi tiết đơn hàng cho Admin
└── assets/
    ├── css/
    │   └── style.css                 # File định dạng CSS tùy biến giao diện
    ├── js/
    │   └── main.js                   # Xử lý JS frontend (chọn biến thể động, ajax, validate form)
    └── uploads/                      # Thư mục lưu trữ hình ảnh tải lên từ Admin
```