# E-KOST 🏠

**E-KOST** adalah platform pencarian kost modern yang menghubungkan pencari kost dengan pemilik kost secara langsung tanpa perantara.

![E-KOST Hero](https://via.placeholder.com/800x400?text=E-KOST+Platform) _<!-- Ganti dengan screenshot aplikasi jika ada -->_

## ✨ Fitur Unggulan

### 🌍 Untuk Pencari Kost (User)

-   **Pencarian Cerdas**: Cari kost berdasarkan lokasi, harga, dan fasilitas.
-   **Filter Lengkap**: Saring hasil pencarian sesuai budget dan kebutuhan Anda.
-   **Detail Lengkap**: Lihat foto, fasilitas, dan deskripsi kost secara rinci.
-   **Favorit**: Simpan kost impian Anda ke daftar favorit.
-   **Interaksi**: Berikan komentar atau pertanyaan pada listing kost.
-   **Hubungi Pemilik**: Dapatkan kontak langsung (WhatsApp) pemilik kost.

### 🏢 Untuk Pemilik Kost (Owner)

-   **Dashboard Manajemen**: Kelola data kost Anda dengan mudah.
-   **Manajemen Kost**: Tambah, edit, dan hapus listing kost.
-   **Galeri Foto**: Upload banyak foto untuk menarik peminat.
-   **Status Verifikasi**: Pantau status persetujuan listing Anda dari admin.

### 🛡️ Untuk Admin

-   **Verifikasi Listing**: Setujui atau tolak pengajuan kost baru untuk menjaga kualitas platform.
-   **Manajemen Feedback**: Lihat dan kelola masukan dari pengguna.
-   **Kontrol Penuh**: Hapus listing atau komentar yang melanggar aturan.

## 🎨 Desain & UI/UX

Project ini mengusung tema **"Black & Silver"** yang elegan dan modern:

-   **Responsive Design**: Tampilan optimal di desktop dan mobile.
-   **SweetAlert2 Integration**: Notifikasi dan konfirmasi aksi yang interaktif dan cantik.
-   **Glassmorphism Navbar**: Navigasi modern dengan efek blur.

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 10/11 (PHP)
-   **Frontend**: Blade Templates, Tailwind CSS
-   **Database**: MySQL
-   **Assets**: Vite (untuk build assets)
-   **Icons**: Heroicons / SVG

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

### Prasyarat

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL

### Langkah-langkah

1.  **Clone Repository**

    ```bash
    git clone https://github.com/iqsanazhr/E-KOST.git
    cd E-KOST
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

    Buka file `.env` dan sesuaikan konfigurasi database Anda:

    ```env
    DB_DATABASE=db_ekost
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate App Key**

    ```bash
    php artisan key:generate
    ```

5.  **Migrasi Database & Seeder**
    Jalankan migrasi untuk membuat tabel dan mengisi data awal (akun demo):

    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Project**
    Buka dua terminal terpisah:
    Terminal 1 (Laravel Server):

    ```bash
    php artisan serve
    ```

    Terminal 2 (Vite Build/Dev):

    ```bash
    npm run dev
    ```

7.  **Selesai!**
    Buka browser dan akses `http://127.0.0.1:8000`.

## 🔐 Akun Demo (Seeder)

Gunakan akun berikut untuk mencoba berbagai role:

| Role        | Email               | Password   |
| ----------- | ------------------- | ---------- |
| **Admin**   | `admin@example.com` | `password` |
| **Pemilik** | `owner@example.com` | `password` |
| **User**    | `user@example.com`  | `password` |

## 🤝 Kontribusi (Contributing)

Silakan fork repository ini dan buat Pull Request jika Anda ingin berkontribusi.

## 📝 Lisensi

[MIT License](LICENSE)
