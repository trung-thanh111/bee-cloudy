# Bee Cloudy - Fashion Shop

Dự án tốt nghiệp: Xây dựng hệ thống website thương mại điện tử thời trang **Bee Cloudy**.

---

## 1. Công Nghệ Sử Dụng (Tech Stack)

- **Backend Framework**: [Laravel 11.x](https://laravel.com/) (PHP 8.2+)
- **Kiến trúc**: Repository & Service Pattern
- **Cơ sở dữ liệu**: MySQL
- **Frontend**: Laravel Blade, Bootstrap 5, SCSS, Vite, Vue 3
- **Thư viện & Tích hợp**:
  - `laravel/socialite`: Đăng nhập mạng xã hội (Google, Facebook)
  - `php-flasher/flasher-laravel`: Thông báo Toastr/Flash message
  - `darryldecode/cart`, `anayarojo/shoppingcart`: Quản lý giỏ hàng
  - Cổng thanh toán trực tuyến: **VNPay**, **MoMo**

---

## 2. Kiến Trúc Hệ Thống (Architecture Base)

Dự án tuân thủ mô hình phân tầng **Repository & Service Pattern** nhằm tách biệt nghiệp vụ và truy xuất dữ liệu:

```
Client / HTTP Request
        │
        ▼
   Controller       (Tiếp nhận Request, gọi Service, trả về View/JSON)
        │
        ▼
    Service         (Xử lý Business Logic, tính toán, kiểm tra nghiệp vụ)
        │
        ▼
   Repository       (Trừu tượng hóa truy vấn CSDL qua Eloquent ORM)
        │
        ▼
 Model / Database   (Bảng CSDL, quan hệ Eloquent)
```

### Các tầng chính:
- **`app/Repositories`**:
  - `Interfaces/`: Định nghĩa các hàm hợp đồng (Contracts) cho từng Repository.
  - `BaseRepository.php`: Chứa các phương thức CRUD nền tảng (`all`, `create`, `update`, `delete`, `findById`, `pagination`...).
  - Các Repository cụ thể kế thừa `BaseRepository` và triển khai Interface tương ứng.
- **`app/Services`**:
  - `Interfaces/`: Định nghĩa hợp đồng nghiệp vụ cho từng Service.
  - `BaseService.php`: Tầng xử lý logic chung.
  - Các Service cụ thể đảm nhận xử lý nghiệp vụ, giao tiếp với Repository.
- **`app/Providers/AppRepositoryProvider.php`**:
  - Đăng ký Dependency Injection: Tự động bind cặp Interface và Implementation của Repository & Service vào Service Container.

---

## 3. Cấu Trúc Định Tuyến (Routing Structure)

Hệ thống router được chia tách thành các module chuyên biệt trong thư mục `routes/web/` và được load tập trung tại `routes/web.php`:

```
routes/
├── web.php                 # Entrypoint chính nạp các module router và fallback 404
├── api.php                 # Các API endpoints (Sanctum)
├── console.php             # Lệnh Artisan console
└── web/                    # Thư mục router phân hệ
    ├── auth.php            # Xác thực: Đăng nhập, đăng ký, OTP quên mật khẩu, OAuth (Google, Facebook), đăng xuất
    ├── frontend.php        # Client công khai: Trang chủ, danh mục sản phẩm, bộ lọc, chi tiết sản phẩm, bài viết, liên hệ, chính sách
    ├── user.php            # Client yêu cầu đăng nhập (middleware 'auth'): Hồ sơ, đổi mật khẩu, đơn hàng, thanh toán VNPay/MoMo, đánh giá, bình luận
    ├── ajax.php            # AJAX nội bộ: Gợi ý tìm kiếm realtime, nạp biến thể thuộc tính, giỏ hàng AJAX, wishlist
    └── backend.php         # Admin (middleware 'auth', 'admin'): Dashboard doanh thu, quản lý danh mục/sản phẩm/thuộc tính/thương hiệu, đơn hàng, banner, tài khoản
```

---

## 4. Quy Trình Phát Triển Tính Năng (Workflow)

Khi thêm một tính năng hoặc module mới vào dự án, tuân theo quy trình chuẩn:

1. **Migration & Seeder**: Tạo cấu trúc bảng và dữ liệu mẫu (`database/migrations`, `database/seeders`).
2. **Model**: Định nghĩa model trong `app/Models`, khai báo `$fillable` và quan hệ Eloquent (`belongsTo`, `hasMany`...).
3. **Routes**: Khai báo route trong file tương ứng thuộc `routes/web/`.
4. **Repository**:
   - Tạo Interface trong `app/Repositories/Interfaces/`.
   - Tạo Repository class trong `app/Repositories/` (kế thừa `BaseRepository`).
5. **Service**:
   - Tạo Interface trong `app/Services/Interfaces/`.
   - Tạo Service class trong `app/Services/` (kế thừa `BaseService`).
6. **Provider Binding**: Khai báo cặp Interface -> Class trong `app/Providers/AppRepositoryProvider.php`.
7. **Controller & Form Request**: Tạo Controller tiếp nhận input, inject Service qua constructor và thực hiện gọi hàm nghiệp vụ.
8. **View / Response**: Xây dựng Blade template hoặc trả về JSON Ajax.

---

## 5. Hướng Dẫn Cài Đặt & Chạy Dự Án

### Yêu cầu môi trường:
- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 18.x & NPM
- MySQL >= 8.0

### Các bước cài đặt:

1. **Clone repository và cài đặt thư viện**:
   ```bash
   git clone <repository-url>
   cd bee-cloudy
   composer install
   npm install
   ```

2. **Cấu hình môi trường**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Cấu hình thông số kết nối Database trong file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bee_cloudy
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Chạy Migration & Seeder**:
   ```bash
   php artisan migrate --seed
   ```

4. **Tạo symlink cho thư mục storage**:
   ```bash
   php artisan storage:link
   ```

5. **Biên dịch Frontend assets**:
   ```bash
   npm run dev
   # hoặc build production: npm run build
   ```

6. **Khởi chạy ứng dụng**:
   ```bash
   php artisan serve
   ```
   Truy cập website tại: `http://127.0.0.1:8000`
