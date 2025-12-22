@extends('layouts.app')

@section('content')


    <div class="form-container">
        <div class="form-card">
            <h1 class="page-title">Tambah Kost Baru</h1>

            @if ($errors->any())
                <div class="alert-danger">
                    <ul class="alert-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('owner.kosts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Nama Kost</label>
                    <input type="text" name="nama_kost" value="{{ old('nama_kost') }}" class="form-input" required>
                </div>

                <div class="form-grid">
                    <div>
                        <label class="form-label">Tipe Kost</label>
                        <select name="tipe" class="form-select" required>
                            <option value="putra">Putra</option>
                            <option value="putri">Putri</option>
                            <option value="campur">Campur</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Harga per Bulan (Rp)</label>
                        <input type="number" name="harga_per_bulan" value="{{ old('harga_per_bulan') }}" class="form-input"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="3" class="form-textarea"
                        required>{{ old('alamat_lengkap') }}</textarea>
                </div>

                <div class="form-grid">
                    <div>
                        <label class="form-label">Kota / Kabupaten</label>
                        <input type="text" name="kota" value="{{ old('kota') }}" class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi') }}" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi & Peraturan</label>
                    <textarea name="deskripsi" rows="5" class="form-textarea" required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Fasilitas</label>
                    <div class="facilities-grid">
                        @foreach($facilities as $facility)
                            <label class="facility-checkbox">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" class="checkbox-input">
                                <span style="font-size: 14px; color: #374151;">{{ $facility->nama_fasilitas }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Kost (Maksimal 5)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="form-input" required>
                    <p class="help-text">Anda dapat memilih lebih dari satu foto sekaligus (Ctrl + Click).</p>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Simpan Kost</button>
                </div>
            </form>
        </div>
    </div>
@endsection