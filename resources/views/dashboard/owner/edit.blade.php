@extends('layouts.app')

@section('content')


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
