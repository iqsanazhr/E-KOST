# E-KOST 🏠

E-KOST adalah platform berbasis web yang menghubungkan pencari kost dengan pemilik kost. Aplikasi ini memudahkan pencarian tempat tinggal sementara yang nyaman, aman, dan transparan, serta membantu pemilik kost dalam mengelola properti mereka.

## 🌟 Fitur Utama

### 🔍 Pencari Kost

-   **Pencarian Kost**: Cari kost berdasarkan lokasi, harga, dan tipe (Putra/Putri/Campur).
-   **Detail Lengkap**: Lihat foto, fasilitas, harga, dan deskripsi kost secara detail.
-   **Filter**: Saring hasil pencarian berdasarkan fasilitas (AC, WiFi, Kamar Mandi Dalam, dll).
-   **Simpan Favorit**: (Coming Soon) Simpan kost impian untuk dilihat nanti.

### 🏢 Pemilik Kost (Owner)

-   **Manajemen Kost**: Tambah, edit, dan hapus data kost.
-   **Upload Foto**: Unggah foto-foto kost untuk menarik peminat.
-   **Kelola Fasilitas**: Atur fasilitas yang tersedia di setiap kamar.
-   **Status Verifikasi**: Pantau status verifikasi kost oleh admin.

### 🛡️ Admin

-   **Verifikasi Kost**: Setujui atau tolak listing kost baru untuk menjaga kualitas platform.
-   **Manajemen User**: Kelola pengguna aplikasi.
-   **Dashboard**: Tinjau statistik keseluruhan platform.

## 🛠️ Teknologi yang Digunakan

-   **Framework**: [Laravel 9.x](https://laravel.com)
-   **Database**: MySQL
-   **Frontend**: Blade Templates, Tailwind CSS / Vanilla CSS
-   **Icons**: FontAwesome

## 🚀 Instalasi dan Menjalankan

Ikuti langkah-langkah berikut untuk menjalankan project di lokal:

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
    Salin file `.env.example` menjadi `.env` dan atur koneksi database.

    ```bash
    cp .env.example .env
    ```

    Buka file `.env` dan sesuaikan:

    ```
    DB_DATABASE=db_ekost
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key & Migrate Database**

    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```

    _Note: `migrate:fresh --seed` akan mengisi database dengan data dummy awal (User Admin, Owner, Kost, Fasilitas)._

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Akses aplikasi di `http://localhost:8000`.

## 👤 Akun Demo

-   **Admin**: `admin@test.com` / `password`
-   **Owner**: `owner@test.com` / `password`
-   **Pencari**: `mahasiswa@test.com` / `password`

## 📝 Lisensi

[MIT](https://opensource.org/licenses/MIT)
