@extends('layouts.app')

@section('content')
    @extends('layouts.app')

    @section('content')
        <style>
            .owner-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 32px 16px;
                font-family: 'Inter', sans-serif;
            }

            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 32px;
            }

            .page-title {
                font-size: 24px;
                font-weight: 700;
                color: #111827;
            }

            .btn-add {
                background-color: #2563eb;
                color: white;
                padding: 10px 16px;
                border-radius: 8px;
                font-weight: 500;
                text-decoration: none;
                transition: background-color 0.2s;
                display: inline-flex;
                align-items: center;
                font-size: 14px;
            }

            .btn-add:hover {
                background-color: #1d4ed8;
            }

            .alert-success {
                background-color: #f0fdf4;
                border: 1px solid #bbf7d0;
                color: #15803d;
                padding: 12px 16px;
                border-radius: 8px;
                margin-bottom: 24px;
                font-size: 14px;
            }

            .table-card {
                background: white;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                border-radius: 12px;
                border: 1px solid #e5e7eb;
                overflow: hidden;
                overflow-x: auto;
            }

            .custom-table {
                min-width: 100%;
                border-collapse: collapse;
            }

            .table-head {
                background-color: #f9fafb;
            }

            .th-cell {
                padding: 12px 24px;
                text-align: left;
                font-size: 12px;
                font-weight: 500;
                color: #6b7280;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .th-right {
                text-align: right;
            }

            .tbody-row {
                border-bottom: 1px solid #e5e7eb;
            }

            .td-cell {
                padding: 16px 24px;
                vertical-align: top;
            }

            .kost-item {
                display: flex;
                align-items: center;
            }

            .kost-thumb-sm {
                height: 40px;
                width: 40px;
                flex-shrink: 0;
                background-color: #e5e7eb;
                border-radius: 4px;
                overflow: hidden;
                margin-right: 16px;
            }

            .thumb-img-sm {
                height: 100%;
                width: 100%;
                object-fit: cover;
            }

            .kost-info-sm {
                /* */
            }

            .kost-name-sm {
                font-size: 14px;
                font-weight: 500;
                color: #111827;
            }

            .kost-address-sm {
                font-size: 14px;
                color: #6b7280;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 200px;
            }

            .badge {
                display: inline-flex;
                padding: 2px 8px;
                font-size: 12px;
                font-weight: 600;
                border-radius: 9999px;
            }

            .badge-putra {
                background-color: #dbeafe;
                color: #1e40af;
            }

            .badge-putri {
                background-color: #fce7f3;
                color: #9d174d;
            }

            .badge-campur {
                background-color: #f3e8ff;
                color: #6b21a8;
            }

            .badge-approved {
                background-color: #dcfce7;
                color: #166534;
            }

            .badge-rejected {
                background-color: #fee2e2;
                color: #991b1b;
            }

            .badge-pending {
                background-color: #fef9c3;
                color: #854d0e;
            }

            .price-text {
                font-size: 14px;
                color: #6b7280;
            }

            .action-links {
                display: flex;
                justify-content: flex-end;
                align-items: center;
                gap: 16px;
            }

            .link-edit {
                color: #4f46e5;
                font-size: 14px;
                font-weight: 500;
                text-decoration: none;
                transition: color 0.2s;
            }

            .link-edit:hover {
                color: #312e81;
            }

            .btn-delete {
                color: #dc2626;
                background: none;
                border: none;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: color 0.2s;
            }

            .btn-delete:hover {
                color: #7f1d1d;
            }

            .empty-row {
                text-align: center;
                padding: 48px 24px;
                color: #6b7280;
            }
        </style>

        <div class="owner-container">
            <div class="page-header">
                <h1 class="page-title">Kelola Kost Saya</h1>
                <a href="{{ route('owner.kosts.create') }}" class="btn-add">
                    + Tambah Kost Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="table-card">
                <table class="custom-table">
                    <thead class="table-head">
                        <tr>
                            <th class="th-cell">Nama Kost</th>
                            <th class="th-cell">Tipe</th>
                            <th class="th-cell">Harga</th>
                            <th class="th-cell">Status</th>
                            <th class="th-cell th-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kosts as $kost)
                            <tr class="tbody-row">
                                <td class="td-cell">
                                    <div class="kost-item">
                                        <div class="kost-thumb-sm">
                                            @if($kost->images->first())
                                                <img class="thumb-img-sm"
                                                    src="{{ asset('storage/' . $kost->images->first()->path_foto) }}" alt="">
                                            @endif
                                        </div>
                                        <div class="kost-info-sm">
                                            <div class="kost-name-sm">{{ $kost->nama_kost }}</div>
                                            <div class="kost-address-sm">{{ $kost->alamat }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="td-cell">
                                    <span
                                        class="badge {{ $kost->tipe == 'putra' ? 'badge-putra' : ($kost->tipe == 'putri' ? 'badge-putri' : 'badge-campur') }}">
                                        {{ ucfirst($kost->tipe) }}
                                    </span>
                                </td>
                                <td class="td-cell">
                                    <span class="price-text">Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}</span>
                                </td>
                                <td class="td-cell">
                                    @if($kost->status_verifikasi == 'approved')
                                        <span class="badge badge-approved">Approved</span>
                                    @elseif($kost->status_verifikasi == 'rejected')
                                        <span class="badge badge-rejected">Rejected</span>
                                    @else
                                        <span class="badge badge-pending">Pending</span>
                                    @endif
                                </td>
                                <td class="td-cell">
                                    <div class="action-links">
                                        <a href="{{ route('owner.kosts.edit', $kost->id) }}" class="link-edit">Edit</a>
                                        <button onclick="confirmDelete('{{ route('owner.kosts.destroy', $kost->id) }}')"
                                            class="btn-delete">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-row">
                                    Belum ada kost yang didaftarkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(url) {
                Swal.fire({
                    title: 'Hapus Kost?',
                    html: `
                                <div class="mx-auto mb-4">
                                     <svg width="120" height="120" viewBox="0 0 24 24" fill="#52525B" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm font-normal mt-2">Tindakan ini tidak dapat dibatalkan!</p>
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
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        form.appendChild(methodField);

                        document.body.appendChild(form);
                        form.submit();
                    }
                })
            }
        </script>
    @endsection
@endsection