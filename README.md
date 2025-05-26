# crud sederhana web penjualan

Ini adalah project Laravel. Ikuti langkah-langkah berikut untuk meng-clone dan menjalankannya secara lokal.

## 🚀 Langkah-Langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/aaasihab/uas-web-penjualan.git
cd uas-web-penjualan
```

### 2. Install Dependency PHP

Pastikan Composer sudah terinstal di komputer Anda, lalu jalankan:

```bash
composer install
```

### 3. Salin File Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

### 4. Konfigurasi Environment

Edit file `.env` sesuai konfigurasi lokal Anda, terutama bagian koneksi database:

```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Buat Database

Buat database di MySQL sesuai nama di file `.env`.

### 7. Jalankan Migrasi dan seeder 

Jika tersedia migrasi database:

```bash
php artisan migrate --seed
```

### 8. Jalankan Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: [http://localhost:8000](http://localhost:8000)

### 9. Login ke halaman admin

email : admin@admin.com
password : admin123

## ✅ Selesai


