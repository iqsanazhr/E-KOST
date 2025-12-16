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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            box-sizing: border-box;
            /* Important so padding fits inside width */
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
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

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 32px;
        }
    </style>

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