@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 32px 16px;
        font-family: 'Inter', sans-serif;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 24px;
    }

    .alert-danger {
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .alert-list {
        list-style-type: disc;
        list-style-position: inside;
        margin: 0;
        padding: 0;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
        box-sizing: border-box;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (min-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .facilities-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    @media (min-width: 768px) {
        .facilities-grid {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    .facility-checkbox {
        display: flex;
        align-items: center;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .facility-checkbox:hover {
        background-color: #f9fafb;
    }

    .checkbox-input {
        border-radius: 4px;
        border-color: #d1d5db;
        color: #2563eb;
        margin-right: 8px;
        width: 16px;
        height: 16px;
    }

    .help-text {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }

    .btn-submit {
        background-color: #2563eb;
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.2s;
    }

    .btn-submit:hover {
        background-color: #1d4ed8;
    }

    .btn-cancel {
        background-color: white;
        color: #374151;
        border: 1px solid #d1d5db;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.2s;
    }

    .btn-cancel:hover {
        background-color: #f9fafb;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
    }

    /* Image Grid Styles */
    .image-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (min-width: 768px) {
        .image-grid {
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
    }

    .image-wrapper {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 4/3;
    }

    .image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-delete-img {
        position: absolute;
        top: 8px;
        right: 8px;
        background-color: #dc2626;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0; /* Hidden by default */
        transition: opacity 0.2s;
    }

    .image-wrapper:hover .btn-delete-img {
        opacity: 1; /* Show on hover */
    }

    .btn-delete-img svg {
        width: 16px;
        height: 16px;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <h1 class="page-title">Edit Kost</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul class="alert-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('owner.kosts.update', $kost->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Nama Kost</label>
                <input type="text" name="nama_kost" value="{{ old('nama_kost', $kost->nama_kost) }}"
                    class="form-input" required>
            </div>

            <div class="form-grid">
                <div>
                    <label class="form-label">Tipe Kost</label>
                    <select name="tipe" class="form-select" required>
                        <option value="putra" {{ old('tipe', $kost->tipe) == 'putra' ? 'selected' : '' }}>Putra</option>
                        <option value="putri" {{ old('tipe', $kost->tipe) == 'putri' ? 'selected' : '' }}>Putri</option>
                        <option value="campur" {{ old('tipe', $kost->tipe) == 'campur' ? 'selected' : '' }}>Campur</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Harga per Bulan (Rp)</label>
                    <input type="number" name="harga_per_bulan" value="{{ old('harga_per_bulan', $kost->harga_per_bulan) }}"
                        class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat_lengkap" rows="3" class="form-textarea" required>{{ old('alamat_lengkap', $kost->alamat_lengkap) }}</textarea>
            </div>

            <div class="form-grid">
                <div>
                    <label class="form-label">Kota / Kabupaten</label>
                    <input type="text" name="kota" value="{{ old('kota', $kost->kota) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $kost->provinsi) }}" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi & Peraturan</label>
                <textarea name="deskripsi" rows="5" class="form-textarea" required>{{ old('deskripsi', $kost->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Fasilitas</label>
                <div class="facilities-grid">
                    @foreach($facilities as $facility)
                        <label class="facility-checkbox">
                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                class="checkbox-input"
                                {{ $kost->facilities->contains($facility->id) ? 'checked' : '' }}>
                            <span>{{ $facility->nama_fasilitas }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Kost</label>
                
                <!-- Existing Images -->
                @if($kost->images->count() > 0)
                    <div class="image-grid">
                        @foreach($kost->images as $image)
                            <div class="image-wrapper">
                                <img src="{{ asset('storage/' . $image->path_foto) }}" class="image-preview">
                                <button type="button" onclick="deleteImage({{ $image->id }})" class="btn-delete-img">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Upload New Images -->
                <div style="margin-top: 8px;">
                    <label class="help-text" style="display:block; margin-bottom:4px;">Tambah Foto Baru (Maksimal 5)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="form-input">
                    <p class="help-text">Ctrl + Click untuk memilih banyak foto.</p>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('owner.kosts.index') }}" class="btn-cancel">
                    Batal
                </a>
                <button type="submit" class="btn-submit">
                    Update Kost
                </button>
            </div>

        </form>

        <!-- Hidden Delete Form (Moved Outside) -->
        <form id="delete-image-form" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function deleteImage(imageId) {
                Swal.fire({
                    title: 'Hapus Foto?',
                    html: `
                        <div class="mx-auto mb-4">
                             <svg width="120" height="120" viewBox="0 0 24 24" fill="#52525B" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm font-normal mt-2">Foto ini akan dihapus permanen!</p>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-xl p-8',
                        title: 'text-2xl font-bold text-gray-900 mb-0',
                        confirmButton: 'bg-black text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-800 transition-colors mx-1 min-w-[120px]',
                        cancelButton: 'bg-white text-black border-2 border-black px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-50 transition-colors mx-1 min-w-[120px]',
                        actions: 'flex gap-2 justify-center mt-6'
                    },
                    width: '400px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('delete-image-form');
                        form.action = `/owner/kost-images/${imageId}`;
                        form.submit();
                    }
                })
            }
        </script>
    </div>
</div>
@endsection
