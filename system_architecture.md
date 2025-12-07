# System Architecture: E-KOST

This document outlines the system architecture for the E-KOST application, categorizing functionalities by role and illustrating the data and logic flows.

## 1. Use Case Diagram

This diagram illustrates the available actions for each role: **Pencari Kost**, **Owner Kost**, and **Admin**.

```mermaid
usecaseDiagram
    actor "Pencari Kost (Mahasiswa)" as Pencari
    actor "Owner Kost" as Owner
    actor "Admin" as Admin

    package "Authentication" {
        usecase "Login" as UC_Login
        usecase "Register" as UC_Register
        usecase "Logout" as UC_Logout
    }

    package "Kost Management" {
        usecase "Manajemen Data Kost" as UC_ManageKost
        usecase "Upload Foto Kost" as UC_UploadFoto
        usecase "Verifikasi Kost" as UC_VerifKost
    }

    package "Search & Interaction" {
        usecase "Cari Kost" as UC_Search
        usecase "Lihat Detail Kost" as UC_ViewDetail
        usecase "Tambah ke Favorit" as UC_Favorite
        usecase "Beri Komentar" as UC_Comment
        usecase "Kirim Feedback" as UC_Feedback
        usecase "Lihat Feedback" as UC_ViewFeedback
    }

    Pencari -- UC_Login
    Pencari -- UC_Register
    Pencari -- UC_Search
    Pencari -- UC_ViewDetail
    Pencari -- UC_Favorite
    Pencari -- UC_Comment
    Pencari -- UC_Feedback

    Owner -- UC_Login
    Owner -- UC_Register
    Owner -- UC_ManageKost
    Owner -- UC_UploadFoto

    Admin -- UC_Login
    Admin -- UC_VerifKost
    Admin -- UC_ViewFeedback
```

## 2. Entity Relationship Diagram (ERD)

This diagram shows the database structure and relationships between entities.

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
        string password
        enum role "mahasiswa, pemilik, admin"
    }

    KOSTS {
        bigint id PK
        bigint user_id FK "Owner"
        string nama_kost
        enum tipe "putra, putri, campur"
        decimal harga_per_bulan
        text deskripsi
        text alamat
        enum status_verifikasi "pending, approved, rejected"
    }

    KOST_IMAGES {
        bigint id PK
        bigint kost_id FK
        string path_foto
        boolean is_primary
    }

    FACILITIES {
        bigint id PK
        string nama_fasilitas
        string icon
    }

    KOST_FACILITY {
        bigint id PK
        bigint kost_id FK
        bigint facility_id FK
    }

    FAVORITES {
        bigint id PK
        bigint user_id FK
        bigint kost_id FK
    }

    COMMENTS {
        bigint id PK
        bigint user_id FK
        bigint kost_id FK
        text content
        bigint parent_id FK
    }

    FEEDBACKS {
        bigint id PK
        bigint user_id FK
        text content
    }

    USERS ||--o{ KOSTS : "owns"
    USERS ||--o{ FAVORITES : "favorites"
    USERS ||--o{ COMMENTS : "writes"
    USERS ||--o{ FEEDBACKS : "sends"
    KOSTS ||--o{ KOST_IMAGES : "has"
    KOSTS ||--o{ FAVORITES : "favorited_by"
    KOSTS ||--o{ COMMENTS : "has"
    KOSTS ||--o{ KOST_FACILITY : "has"
    FACILITIES ||--o{ KOST_FACILITY : "included_in"
    COMMENTS ||--o{ COMMENTS : "replies_to"
```

## 3. Class Diagram

This diagram represents the Model structure in logical code classes.

```mermaid
classDiagram
    class User {
        +Integer id
        +String name
        +String email
        +String role
        +kosts()
        +favorites()
        +comments()
    }

    class Kost {
        +Integer id
        +Integer user_id
        +String nama_kost
        +String tipe
        +Decimal harga_per_bulan
        +String status_verifikasi
        +owner()
        +facilities()
        +images()
        +comments()
        +scopeFilter()
    }

    class Facility {
        +Integer id
        +String nama_fasilitas
        +String icon
        +kosts()
    }

    class KostImage {
        +Integer id
        +Integer kost_id
        +String path_foto
        +kost()
    }

    class Comment {
        +Integer id
        +Integer user_id
        +Integer kost_id
        +String content
        +user()
        +kost()
    }

    class Favorite {
        +Integer id
        +Integer user_id
        +Integer kost_id
    }

    User "1" -- "*" Kost : owns
    User "1" -- "*" Favorite : has
    User "1" -- "*" Comment : writes
    Kost "1" -- "*" KostImage : has
    Kost "*" -- "*" Facility : features
    Kost "1" -- "*" Comment : receives
```

## 4. Flowcharts (Diagram Alur)

### A. Role: Pencari Kost (Mahasiswa)

Flow for searching and viewing kost details.

```mermaid
flowchart TD
    Start([Mulai]) --> Homepage
    Homepage --> Search{Cari Kost?}
    Search -- Ya --> InputFilter[Masukkan Filter: Lokasi, Harga, Tipe]
    Search -- Tidak --> Browse[Lihat Daftar Kost]
    InputFilter --> ResultList[Tampilkan Hasil Pencarian]
    Browse --> ResultList
    ResultList --> SelectKost[Pilih Detail Kost]
    SelectKost --> ViewDetail[Halaman Detail Kost]
    ViewDetail --> Action{Aksi?}
    Action -- Favorit --> CheckLogin{Login?}
    Action -- Komentar --> CheckLogin
    Action -- Hubungi Owner --> Contact[Tampilkan Kontak]
    CheckLogin -- Belum --> LoginPage[Halaman Login] --> ViewDetail
    CheckLogin -- Sudah --> ExecuteAction[Simpan Favorit / Kirim Komentar]
    ExecuteAction --> ViewDetail
    ViewDetail --> Stop([Selesai])
```

### B. Role: Owner Kost

Flow for managing kost data.

```mermaid
flowchart TD
    Start([Mulai]) --> Login
    Login --> Dashboard
    Dashboard --> Menu{Pilih Menu}
    Menu -- Tambah Kost --> FormKost[Isi Data Kost]
    Menu -- List Kost --> ViewMyKost[Lihat Kost Saya]
    FormKost --> UploadImg[Upload Foto Kost]
    UploadImg --> Save[Simpan Data]
    Save --> StatusPending[Status: Pending Verification]
    StatusPending --> Stop([Selesai])

    ViewMyKost --> Edit{Edit/Hapus?}
    Edit -- Edit --> FormEdit[Update Data] --> Save
    Edit -- Hapus --> ConfirmDelete[Konfirmasi Hapus] --> Delete[Hapus Data]
```

### C. Role: Admin

Flow for verifying kost listings.

```mermaid
flowchart TD
    Start([Mulai]) --> Login
    Login --> Dashboard
    Dashboard --> ViewPending[Lihat Kost Pending]
    ViewPending --> SelectItem[Pilih Kost]
    SelectItem --> Review[Review Data & Foto]
    Review --> Decision{Keputusan?}
    Decision -- Approve --> SetActive[Set Status: Approved]
    Decision -- Reject --> SetReject[Set Status: Rejected]
    SetActive --> NotifyOwner[Notifikasi ke Owner]
    SetReject --> NotifyOwner
    NotifyOwner --> Stop([Selesai])
```
