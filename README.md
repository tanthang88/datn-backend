# Dự án tốt nghiệp (TKTW-PHP Framework) - Nhóm Fivepass
## Step 1: Vào thư mục www của Laragon hoặc htdocs của Xampp, chạy lệnh dưới để kéo source code về máy
```
git clone https://github.com/tanthang88/datn-fivepass.git
```
## Step 2: Cách chuyển sang nhánh dev
```
git checkout dev
```

## Step 3: Tạo nhánh cá nhân
```
git checkout -b username
```
## Step 4: Tạo file .env từ file .env.example
```
cp .env.example .env
```
## Step 5: Generate App Key
```
php artisan key:generate
```
## Step 6: Chạy composer
```
composer install
```
> Đang cập nhật thêm...
