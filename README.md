# 🏸 Sistem Reservasi Lapangan Badminton

Aplikasi web untuk manajemen dan reservasi lapangan badminton yang dibangun dengan Laravel framework. Memudahkan pengguna untuk melihat ketersediaan, melakukan booking, dan mengelola reservasi lapangan badminton secara online.

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 📋 Fitur Utama

- ✅ **Daftar & Login** - Sistem autentikasi pengguna yang aman
- ✅ **Lihat Ketersediaan** - Tampil jadwal dan ketersediaan lapangan badminton
- ✅ **Booking Lapangan** - Reservasi lapangan dengan mudah
- ✅ **Manajemen Reservasi** - Lihat, edit, dan batalkan reservasi Anda
- ✅ **Responsive Design** - Dapat diakses dari berbagai perangkat
- ✅ **Admin Dashboard** - Panel pengelolaan untuk administrator

## 🛠️ Teknologi yang Digunakan

- **Framework**: [Laravel 10.10](https://laravel.com/)
- **PHP**: ^8.1
- **Database**: MySQL/MariaDB
- **Frontend**: Blade Template Engine, Tailwind CSS (atau CSS framework lainnya)
- **Authentication**: Laravel Sanctum
- **API Client**: Guzzle HTTP

### Dependensi Utama

```json
{
  "laravel/framework": "^10.10",
  "laravel/sanctum": "^3.3",
  "laravel/tinker": "^2.8",
  "guzzlehttp/guzzle": "^7.2"
}
```

## 📦 Instalasi

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm (untuk aset frontend)
- MySQL/MariaDB
- Git

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/sofiyalathifa/reservasi-lapangan-badminton-laravel.git
cd reservasi-lapangan-badminton-laravel
```

2. **Install Dependencies**
```bash
composer install
```

3. **Setup Environment**
```bash
cp .env.example .env
```

4. **Generate Application Key**
```bash
php artisan key:generate
```

5. **Konfigurasi Database**
   - Edit file `.env` dan sesuaikan konfigurasi database:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=reservasi_badminton
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Jalankan Migrasi & Seeding**
```bash
php artisan migrate
php artisan db:seed
```

7. **Install Node Dependencies** (jika diperlukan)
```bash
npm install
npm run dev
```

8. **Jalankan Server Development**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📁 Struktur Proyek

```
reservasi-lapangan-badminton-laravel/
├── app/                    # Logika aplikasi
│   ├── Models/            # Model Eloquent
│   ├── Controllers/       # Controllers
│   ├── Requests/          # Form Requests
│   └── Services/          # Business Logic
├── database/              # Database
│   ├── migrations/        # Database Migrations
│   ├── seeders/          # Database Seeders
│   └── factories/        # Model Factories
├── resources/            # Resources
│   └── views/           # Blade Templates
├── routes/              # Routes
│   ├── web.php         # Web Routes
│   └── api.php         # API Routes
├── public/             # File publik
├── tests/              # Unit & Feature Tests
├── .env.example        # Contoh Environment File
├── composer.json       # PHP Dependencies
└── README.md          # Dokumentasi ini
```

## 🚀 Penggunaan

### Sebagai User Biasa

1. Buka aplikasi di browser
2. Daftar akun atau login
3. Lihat jadwal lapangan yang tersedia
4. Pilih lapangan dan waktu yang diinginkan
5. Selesaikan booking

### Sebagai Administrator

1. Login dengan akun administrator
2. Akses dashboard admin
3. Kelola lapangan (tambah, edit, hapus)
4. Kelola reservasi pengguna
5. Lihat laporan dan statistik

## 🔐 Keamanan

- Implementasi CSRF protection
- Password hashing dengan bcrypt
- SQL injection prevention melalui prepared statements
- Rate limiting untuk API
- Authorization & authentication menggunakan Laravel built-in

## 📝 API Endpoints

Aplikasi menyediakan API untuk integrasi pihak ketiga:

- `GET /api/lapangan` - Daftar semua lapangan
- `GET /api/lapangan/{id}` - Detail lapangan
- `POST /api/reservasi` - Buat reservasi baru
- `GET /api/reservasi` - Daftar reservasi pengguna
- `PUT /api/reservasi/{id}` - Update reservasi
- `DELETE /api/reservasi/{id}` - Batalkan reservasi

*Lebih detail, lihat dokumentasi API di file yang relevan*

## 🧪 Testing

Jalankan unit tests:

```bash
php artisan test
```

Dengan coverage:

```bash
php artisan test --coverage
```

## 📊 Development

### Format Code dengan Pint

```bash
./vendor/bin/pint
```

### Lint dan Check

```bash
./vendor/bin/pint --check
```

## 🔄 Database Migrations

Buat migration baru:

```bash
php artisan make:migration nama_migration
```

Jalankan migrasi:

```bash
php artisan migrate
```

Rollback migrasi:

```bash
php artisan migrate:rollback
```

## 📚 Dokumentasi Lengkap

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel API](https://laravel.com/api/10.x)

## 🤝 Kontribusi

Kontribusi sangat diterima! Berikut cara berkontribusi:

1. Fork repository ini
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

## 👨‍💻 Author

Mochamad Rico Andreano 	    24082010005
Hafida Zahra Sofiya L.    	24082010013
Evelin Salsabila A. 		24082010017

## 💬 Support & Feedback

Jika Anda menemukan bug atau memiliki saran, silakan buat [Issue](https://github.com/sofiyalathifa/reservasi-lapangan-badminton-laravel/issues) baru.

## 🎯 Roadmap

- [ ] Integrasi payment gateway (Midtrans, GoPay)
- [ ] Sistem notifikasi email
- [ ] Multi-bahasa (i18n)
- [ ] Mobile app
- [ ] Laporan PDF
- [ ] Sistem rating & review

---

**Made with ❤️ by Team 4**

Terakhir diperbarui: Juni 2026
