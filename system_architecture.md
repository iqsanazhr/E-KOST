# System Architecture: E-KOST

This document outlines the system architecture for the E-KOST application, visually representing the system's behavior, structure, and data flow using UML diagrams.

## 1. Use Case Diagram

This diagram illustrates the available actions for each role: **Pencari Kost**, **Owner Kost**, and **Admin**.

```mermaid
usecaseDiagram
    actor "Pencari Kost" as Pencari
    actor "Owner Kost" as Owner
    actor "Admin" as Admin

    package "Sistem E-KOST" {
        usecase "Login / Register" as UC_Auth
        usecase "Cari Kost" as UC_Search
        usecase "Lihat Detail Kost" as UC_Detail
        usecase "Kelola Favorit" as UC_Fav
        usecase "Kirim Komentar" as UC_Comment
        usecase "Hubungi Owner" as UC_Contact

        usecase "Kelola Data Kost (CRUD)" as UC_ManageKost
        usecase "Upload Foto Kost" as UC_Upload

        usecase "Verifikasi Kost" as UC_Verif
        usecase "Moderasi Konten" as UC_Mod
    }

    Pencari --> UC_Auth
    Pencari --> UC_Search
    Pencari --> UC_Detail
    Pencari --> UC_Fav
    Pencari --> UC_Comment
    Pencari --> UC_Contact

    Owner --> UC_Auth
    Owner --> UC_ManageKost
    Owner --> UC_Upload
    Owner --> UC_Search
    Owner --> UC_Detail
    Owner --> UC_Contact

    Admin --> UC_Auth
    Admin --> UC_Verif
    Admin --> UC_Mod
    Admin --> UC_Search
    Admin --> UC_Detail
```

---

## 2. Activity Diagrams

These diagrams describe the workflow of specific processes for each user role.

### A. Activity Diagram: Pencari Kost (Search & Interact)

Alur pencarian kost hingga melakukan interaksi (Favorit/Komentar).

```mermaid
flowchart TD
    Start([Mulai]) --> Homepage[Buka Halaman Utama]
    Homepage --> Search{Cari Kost?}
    Search -- Global Search --> InputKeyword[Input Lokasi/Nama]
    Search -- Filter --> InputFilter[Set Filter Harga/Tipe]
    InputKeyword --> Result[Tampilkan Hasil Pencarian]
    InputFilter --> Result
    Result --> Select[Pilih Listing Kost]
    Select --> ViewDetail[Halaman Detail Kost]
    ViewDetail --> Interaction{Pilih Aksi}

    Interaction -- "Simpan Favorit" --> CheckAuth1{Login?}
    Interaction -- "Kirim Komentar" --> CheckAuth2{Login?}
    Interaction -- "Hubungi Owner" --> ClickWA[Redirect ke WhatsApp]

    CheckAuth1 -- "Belum" --> Login1[Halaman Login]
    CheckAuth1 -- "Sudah" --> ToggleFav[Simpan ke Database]

    CheckAuth2 -- "Belum" --> Login2[Halaman Login]
    CheckAuth2 -- "Sudah" --> PostComment[Simpan Komentar]

    Login1 --> ToggleFav
    Login2 --> PostComment

    ToggleFav --> Notify1[Notifikasi Sukses]
    PostComment --> Notify2[Notifikasi Terkirim]
    ClickWA --> End([Selesai])
    Notify1 --> End
    Notify2 --> End
```

### B. Activity Diagram: Owner Kost (Manage Listing)

Alur pemilik menambahkan listing kost baru.

```mermaid
flowchart TD
    Start([Mulai]) --> Login[Login Owner]
    Login --> Dashboard[Dashboard Owner]
    Dashboard --> ClickAdd[Klik "Tambah Kost"]
    ClickAdd --> FormKost[Isi Form Data Kost\n(Nama, Harga, Fasilitas, dll)]
    FormKost --> UploadImg[Upload Foto Kost]
    UploadImg --> Valid{Validasi Input?}

    Valid -- "Gagal" --> ShowError[Tampilkan Error]
    ShowError --> FormKost

    Valid -- "Sukses" --> SaveDB[Simpan Data & Foto]
    SaveDB --> SetStatus[Set Status: Pending]
    SetStatus --> Notify[Notifikasi: Menunggu Verifikasi]
    Notify --> End([Selesai])
```

### C. Activity Diagram: Admin (Verification)

Alur admin memverifikasi listing yang masuk.

```mermaid
flowchart TD
    Start([Mulai]) --> LoginAd[Login Admin]
    LoginAd --> DashAd[Dashboard Admin]
    DashAd --> ViewPending[Lihat Menu "Verifikasi Kost"]
    ViewPending --> SelectItem[Pilih Kost Pending]
    SelectItem --> Review[Review Foto & Deskripsi]
    Review --> Decision{Keputusan?}

    Decision -- "Approve" --> SetApprove[Update Status: Approved]
    Decision -- "Reject" --> SetReject[Update Status: Rejected]

    SetApprove --> NotifyOwner1[Email Pemberitahuan Tayang]
    SetReject --> NotifyOwner2[Email Pemberitahuan Penolakan]

    NotifyOwner1 --> End([Selesai])
    NotifyOwner2 --> End
```

---

## 3. Sequence Diagrams

These diagrams show the interaction between objects (View, Controller, Model) over time.

### A. Sequence Diagram: Pendaftaran Kost Baru (Owner)

```mermaid
sequenceDiagram
    autonumber
    actor Owner
    participant View as KostCreateView
    participant Ctrl as OwnerKostController
    participant Model as KostModel
    participant DB as Database

    Owner->>View: Buka Form Tambah Kost
    View-->>Owner: Tampilkan Form
    Owner->>View: Input Data & Upload Foto
    Owner->>View: Klik "Simpan"
    View->>Ctrl: store(request)
    Ctrl->>Ctrl: Validate Input
    alt Input Invalid
        Ctrl-->>View: Return Errors
        View-->>Owner: Tampilkan Pesan Error
    else Input Valid
        Ctrl->>Model: Create Kost (status='pending')
        Model->>DB: INSERT INTO kosts
        DB-->>Model: Success ID
        Ctrl->>Model: Upload & Save Images
        Model->>DB: INSERT INTO kost_images
        Ctrl-->>View: Redirect with Success Message
        View-->>Owner: Tampilkan "Berhasil Disimpan"
    end
```

### B. Sequence Diagram: Pencarian Kost (Pencari)

```mermaid
sequenceDiagram
    autonumber
    actor User as Pencari
    participant View as SearchView
    participant Ctrl as PublicController
    participant Model as KostModel
    participant DB as Database

    User->>View: Input Keyword & Filter
    User->>View: Klik "Cari"
    View->>Ctrl: index(request)
    Ctrl->>Model: query(filters)
    Model->>DB: SELECT * FROM kosts WHERE ...
    DB-->>Model: Return Results
    Model-->>Ctrl: Return Collection
    Ctrl-->>View: Return View with Data
    View-->>User: Tampilkan List Kost
```

---

## 4. Class Diagram

This diagram represents the static structure of the system's classes and their relationships.

```mermaid
classDiagram
    class User {
        +id: BigInt
        +name: String
        +email: String
        +password: String
        +role: Enum
        +kosts()
        +favorites()
        +comments()
    }

    class Kost {
        +id: BigInt
        +user_id: BigInt
        +nama_kost: String
        +tipe: Enum
        +harga: Decimal
        +status_verifikasi: Enum
        +owner()
        +facilities()
        +images()
        +comments()
        +getHargaFormatted()
    }

    class Facility {
        +id: BigInt
        +nama_fasilitas: String
        +icon: String
        +kosts()
    }

    class KostImage {
        +id: BigInt
        +kost_id: BigInt
        +path_foto: String
    }

    class Comment {
        +id: BigInt
        +user_id: BigInt
        +kost_id: BigInt
        +content: Text
        +parent_id: BigInt
    }

    class Favorite {
        +id: BigInt
        +user_id: BigInt
        +kost_id: BigInt
    }

    User "1" -- "*" Kost : owns
    User "1" -- "*" Favorite : has
    User "1" -- "*" Comment : writes
    Kost "1" -- "*" KostImage : contains
    Kost "*" -- "*" Facility : features
    Kost "1" -- "*" Comment : receives
    Comment "1" -- "*" Comment : replies
```

---

## 5. Entity Relationship Diagram (ERD)

This diagram shows the database schema structure.

```mermaid
erDiagram
    USERS ||--o{ KOSTS : owns
    USERS ||--o{ FAVORITES : has
    USERS ||--o{ COMMENTS : writes
    USERS ||--o{ FEEDBACKS : sends

    KOSTS ||--o{ KOST_IMAGES : contains
    KOSTS ||--o{ KOST_FACILITY : has
    KOSTS ||--o{ FAVORITES : favorited_by
    KOSTS ||--o{ COMMENTS : receives

    FACILITIES ||--o{ KOST_FACILITY : included_in
    COMMENTS ||--o{ COMMENTS : replies_to

    USERS {
        bigint id PK
        string name
        string email
        string password
        enum role "admin, pemilik, mahasiswa"
    }

    KOSTS {
        bigint id PK
        bigint user_id FK
        string nama_kost
        enum tipe "putra, putri, campur"
        decimal harga
        text deskripsi
        text alamat
        enum status_verifikasi "pending, approved, rejected"
    }

    KOST_IMAGES {
        bigint id PK
        bigint kost_id FK
        string path_foto
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
```
