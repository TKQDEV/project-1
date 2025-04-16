**1. Cài đặt và chạy dự án
# Bước 1: Tạo mới project
1.1. chạy lệnh: laravel new E-commerce (laravel 12.0)
1.2. Tạo cấu trúc thư mục Repository & Service
1.3. Tạo và cấu hình RepositoryServiceProvider để bind các Repository & Service
1.4.  Đăng ký Provider trong config/app.php
# Bước 2: Thiết kế Database
2.1. Migration
2.2. Định nghĩa các relationship giữa các Model
2.3. Chạy migration

# Bước 3: Cài Laravel Breeze để có Authentication (Đăng ký, đăng nhập, phân quyền)
3.1. chạy lệnh:
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
3.2. Phân quyền (Admin - User)
3.3. Trang quản lý thông tin cá nhân
3.4. Tạo các route, controller, blade cho Quản lý danh mục sản phẩm, Quản lý sản phẩm, Giỏ hàng và đơn hàng, Admin dashboard 

### Bước 4: Testing
4.1. Unit test cho Repository và Service
4.2. Feature test cho các chức năng chính

# Bước 5: Serve ứng dụng
php artisan serve

**2. Cấu trúc dự án
E-commerce/
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── UserController.php
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── RegisterController.php
│   │   │   └── ProductController.php
│   │   ├── Middleware/
│   │   │   ├── RoleMiddleware.php
│   │   └── Requests/
│   │       └── ProductRequest.php
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Product.php
│   │   └── User.php
│   ├── Providers/
│   └── Services/
│       └── ProductService.php
├── bootstrap/
│   └── app.php
├── config/
│   ├── app.php
│   └── auth.php
├── database/
│   ├── factories/
│   │   └── ProductFactory.php
│   ├── migrations/
│   │   ├── 2025_04_15_123456_create_users_table.php
│   │   ├── 2025_04_15_123457_create_categories_table.php
│   │   ├── 2025_04_15_123458_create_products_table.php
│   │   ├── 2025_04_15_123459_create_product_images_table.php
│   │   └── 2025_04_15_123460_add_role_to_users_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── CategorySeeder.php
│       ├── ProductSeeder.php
│       └── UserSeeder.php
├── public/
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── products.blade.php
│   │   │   └── categories.blade.php
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── admin.blade.php
│   │   │   ├── user.blade.php
│   │   ├── user/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── cart.blade.php
│   │   │   └── orders.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   └── welcome.blade.php
├── routes/
│   └── web.php
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
└── tests/
    ├── Feature/
    └── Unit/

**3. Các tính năng đã cài đặt
3.1. Xác Thực Người Dùng (Authentication)
Đăng ký người dùng: Người dùng có thể đăng ký tài khoản mới với các thông tin như tên, email và mật khẩu.

Đăng nhập và đăng xuất: Người dùng có thể đăng nhập và đăng xuất khỏi hệ thống.

Vai trò người dùng (Admin và User): Hệ thống phân quyền giữa Admin và User dựa trên vai trò, được lưu trong cơ sở dữ liệu.

3.2. Quản Lý Danh Mục Sản Phẩm
CRUD cho danh mục sản phẩm:

Tạo, đọc, cập nhật, xóa (CRUD) các danh mục sản phẩm.

Cấu trúc cây cho danh mục: Các danh mục có thể có danh mục con (parent-child relationship). Bạn đã triển khai cấu trúc cây cho danh mục bằng cách sử dụng parent_id.

Hiển thị danh mục theo cấu trúc cây: Danh mục sản phẩm được hiển thị dưới dạng cây, giúp dễ dàng quản lý danh mục con.

3.3. Quản Lý Sản Phẩm
CRUD cho sản phẩm:

Tạo, đọc, cập nhật, xóa (CRUD) các sản phẩm.

Thêm ảnh cho sản phẩm: Người dùng có thể upload nhiều ảnh cho một sản phẩm (với các ảnh được lưu trong thư mục storage).

Hiển thị chi tiết sản phẩm: Mỗi sản phẩm có một trang chi tiết với thông tin về tên, mô tả, giá và ảnh.

Tìm kiếm và phân trang sản phẩm: Bạn đã triển khai tính năng tìm kiếm và phân trang để người dùng dễ dàng duyệt qua các sản phẩm.

3.4. Quản Lý Giỏ Hàng và Đơn Hàng
Giỏ hàng:

Người dùng có thể thêm sản phẩm vào giỏ hàng của họ.

Giỏ hàng được lưu trữ trong phiên (session), giúp người dùng duy trì sản phẩm trong giỏ khi duyệt qua các trang khác.

Tạo đơn hàng:

Người dùng có thể tạo đơn hàng từ giỏ hàng của họ.

Thông tin đơn hàng được lưu vào cơ sở dữ liệu, bao gồm sản phẩm đã mua, số lượng, và giá trị tổng.

Xem lịch sử đơn hàng: Người dùng có thể xem danh sách các đơn hàng trước đó của họ.

Quản lý trạng thái đơn hàng (cho Admin):

Admin có thể cập nhật trạng thái đơn hàng, ví dụ như "Đang xử lý", "Đã giao", "Đã hủy".

3.5. Phân Quyền Người Dùng (Admin và User)
Phân quyền giữa Admin và User:

Admin có quyền truy cập vào các tính năng quản lý sản phẩm, danh mục và đơn hàng.

User có thể thêm sản phẩm vào giỏ hàng, tạo đơn hàng, và xem lịch sử đơn hàng của họ.

Middleware kiểm tra vai trò người dùng:

Sử dụng middleware để kiểm tra vai trò của người dùng và đảm bảo rằng người dùng chỉ có thể truy cập các tính năng phù hợp với vai trò của họ (Admin hoặc User).

3.6. Giao Diện Người Dùng (UI/UX)
Giao diện cho Admin và User:

Tùy thuộc vào vai trò của người dùng (Admin hoặc User), hệ thống sẽ chọn layout phù hợp (ví dụ: Admin có giao diện quản lý, User có giao diện mua sắm).

Các trang đăng nhập, đăng ký được thiết kế đơn giản và dễ sử dụng.

Các thông báo được hiển thị rõ ràng, chẳng hạn như thông báo khi người dùng đăng xuất thành công.

3.7. Các Tính Năng Bảo Mật và Quản Lý Phiên
Xác thực bảo mật: Đảm bảo rằng người dùng chỉ có thể truy cập vào các phần của hệ thống mà họ có quyền (dựa trên vai trò).

CSRF Protection: Các form trong ứng dụng sử dụng CSRF tokens để bảo vệ khỏi các cuộc tấn công giả mạo.

Session Management: Quản lý phiên người dùng để đảm bảo rằng giỏ hàng của người dùng được lưu trữ trong phiên và không bị mất khi tải lại trang.

3.8. Tính Năng Đăng Xuất
Đăng xuất người dùng: Người dùng có thể đăng xuất khỏi hệ thống bằng cách nhấn nút Đăng xuất. Sau khi đăng xuất, người dùng sẽ được chuyển hướng về trang đăng nhập với thông báo "Bạn đã đăng xuất thành công!".

3.9. Seeder Mẫu Cho Dữ Liệu
Seeder: Bạn đã tạo các Seeder mẫu để thêm dữ liệu vào các bảng như users, categories, và products, giúp dễ dàng kiểm tra hệ thống trong quá trình phát triển.

3.10. Các Công Cụ và Thư Viện Sử Dụng
Laravel Breeze: Để cung cấp hệ thống xác thực đơn giản (đăng nhập, đăng ký).

Laravel Eloquent: Để thao tác với cơ sở dữ liệu và thực hiện các CRUD cho sản phẩm, danh mục, và đơn hàng.

Tailwind CSS: Để thiết kế giao diện người dùng đẹp mắt và dễ sử dụng.

**4. Giải thích về Repository-Service Layer Pattern trong dự án

4.1. Repository Pattern:
Repository là một lớp hoặc đối tượng chịu trách nhiệm truy xuất dữ liệu từ cơ sở dữ liệu (hoặc bất kỳ nguồn dữ liệu nào). Nó cung cấp một giao diện đơn giản để thực hiện các thao tác như CRUD (Create, Read, Update, Delete) mà không cần phải biết chi tiết về cách thức dữ liệu được lưu trữ hoặc truy vấn.

Vai trò của Repository:

Ẩn giấu chi tiết lưu trữ dữ liệu: Repository chỉ cung cấp các phương thức để thực hiện thao tác với dữ liệu mà không cần phải quan tâm đến việc dữ liệu được lưu trữ như thế nào (MySQL, MongoDB, API, etc.).

Cải thiện khả năng kiểm thử (testing): Bằng cách tách biệt việc truy xuất dữ liệu ra khỏi phần còn lại của ứng dụng, bạn có thể dễ dàng mock repository trong khi kiểm thử.

Tăng tính linh hoạt: Bạn có thể thay đổi cách dữ liệu được lưu trữ (chẳng hạn từ MySQL sang MongoDB) mà không làm ảnh hưởng đến các phần còn lại của ứng dụng.

4.2. Service Pattern:
Service Layer là lớp chịu trách nhiệm cho việc xử lý logic nghiệp vụ (business logic). Nó sẽ sử dụng repositories để thực hiện các thao tác dữ liệu (CRUD) và xử lý các yêu cầu liên quan đến nghiệp vụ của ứng dụng.

Vai trò của Service:

Tách biệt logic nghiệp vụ: Service chứa logic nghiệp vụ (ví dụ: xử lý yêu cầu tạo đơn hàng, kiểm tra quyền truy cập, v.v.) và giúp tránh việc đưa logic nghiệp vụ vào controller hoặc model.

Tăng tính dễ bảo trì và mở rộng: Nếu bạn cần thay đổi logic nghiệp vụ, bạn chỉ cần thay đổi trong service mà không cần phải sửa lại controller hoặc model.

Dễ dàng kiểm thử: Giống như repository, bạn có thể dễ dàng mock các service trong khi kiểm thử, điều này làm cho việc kiểm thử trở nên dễ dàng hơn.

4.3. Kết hợp Repository và Service:
Controller sẽ không cần phải xử lý logic nghiệp vụ hay truy vấn dữ liệu trực tiếp mà thay vào đó, Controller chỉ gọi Service, và Service sẽ sử dụng Repository để truy xuất dữ liệu.

4.4. Cấu hình Dependency Injection (DI) trong Laravel
Trong Laravel, bạn cần cấu hình dependency injection để có thể inject các repository và service vào controller.

**5. Database schema 
![image](https://github.com/user-attachments/assets/29f47f4d-4d95-487b-9524-51f761c43b92)

**6. Link triển khai 

http://127.0.0.1:8000

