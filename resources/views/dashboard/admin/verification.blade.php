@extends('layouts.app')

@section('content')
    @extends('layouts.app')

    @section('content')
        <style>
            .admin-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 32px 16px;
                font-family: 'Inter', sans-serif;
            }

            .page-title {
                font-size: 24px;
                font-weight: 700;
                color: #111827;
                margin-bottom: 32px;
            }

            .section-title {
                font-size: 20px;
                font-weight: 700;
                color: #111827;
                margin-top: 48px;
                margin-bottom: 24px;
            }

            .alert-success {
                background-color: #111827;
                color: white;
                padding: 12px 16px;
                border-radius: 12px;
                margin-bottom: 24px;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .alert-icon {
                width: 20px;
                height: 20px;
                color: #4ade80;
            }

            .table-card {
                background: white;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
                border-radius: 16px;
                border: 1px solid #f3f4f6;
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
                padding: 16px 24px;
                text-align: left;
                font-size: 12px;
                font-weight: 700;
                color: #6b7280;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .th-right {
                text-align: right;
            }

            .tbody-row {
                border-bottom: 1px solid #f3f4f6;
                transition: background-color 0.2s;
            }

            .tbody-row:hover {
                background-color: #f9fafb;
            }

            .td-cell {
                padding: 16px 24px;
                vertical-align: top;
            }

            .kost-info {
                display: flex;
                align-items: flex-start;
            }

            .kost-thumb {
                height: 64px;
                width: 96px;
                flex-shrink: 0;
                background-color: #f3f4f6;
                border-radius: 8px;
                overflow: hidden;
                border: 1px solid #e5e7eb;
                margin-right: 16px;
            }

            .thumb-img {
                height: 100%;
                width: 100%;
                object-fit: cover;
            }

            .placeholder-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                color: #9ca3af;
            }

            .kost-details {
                /* margin-left handled by flex margin-right on thumb for better spacing control if wrapped */
            }

            .kost-name {
                font-size: 14px;
                font-weight: 700;
                color: #111827;
            }

            .kost-address {
                font-size: 14px;
                color: #6b7280;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .kost-price {
                font-size: 12px;
                color: #111827;
                margin-top: 4px;
                font-weight: 700;
                background-color: #f3f4f6;
                padding: 2px 8px;
                border-radius: 4px;
                display: inline-block;
            }

            .owner-name {
                font-size: 14px;
                font-weight: 500;
                color: #111827;
            }

            .owner-email {
                font-size: 12px;
                color: #6b7280;
            }

            .date-text {
                font-size: 14px;
                color: #6b7280;
                white-space: nowrap;
            }

            .action-group {
                display: flex;
                justify-content: flex-end;
                gap: 8px;
            }

            .btn-view {
                background-color: white;
                border: 1px solid #e5e7eb;
                color: #374151;
                padding: 6px 12px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
                text-decoration: none;
                transition: all 0.2s;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }

            .btn-view:hover {
                background-color: #f9fafb;
            }

            .btn-approve {
                background-color: #000;
                color: white;
                padding: 6px 12px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 700;
                border: none;
                cursor: pointer;
                transition: all 0.2s;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .btn-approve:hover {
                background-color: #1f2937;
            }

            .btn-reject {
                background-color: white;
                border: 1px solid #e5e7eb;
                color: #dc2626;
                padding: 6px 12px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.2s;
            }

            .btn-reject:hover {
                background-color: #fef2f2;
            }

            .empty-state {
                padding: 48px 24px;
                text-align: center;
                color: #6b7280;
            }

            .empty-icon-wrapper {
                width: 48px;
                height: 48px;
                background-color: #f3f4f6;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 12px auto;
                color: #9ca3af;
            }

            .badge-active {
                display: inline-flex;
                padding: 4px 10px;
                background-color: #f0fdf4;
                color: #15803d;
                border: 1px solid #bbf7d0;
                border-radius: 9999px;
                font-size: 10px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }
        </style>

        <div class="admin-container">
            <h1 class="page-title">Verifikasi Listing Kost</h1>

            @if(session('success'))
                <div class="alert-success">
                    <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span style="font-weight: 500;">{{ session('success') }}</span>
                </div>
            @endif

            <div class="table-card">
                <table class="custom-table">
                    <thead class="table-head">
                        <tr>
                            <th class="th-cell">Kost Info</th>
                            <th class="th-cell">Pemilik</th>
                            <th class="th-cell">Tanggal Submit</th>
                            <th class="th-cell th-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingKosts as $kost)
                            <tr class="tbody-row">
                                <td class="td-cell">
                                    <div class="kost-info">
                                        <div class="kost-thumb">
                                            @if($kost->images->first())
                                                <img class="thumb-img" src="{{ asset('storage/' . $kost->images->first()->path_foto) }}"
                                                    alt="">
                                            @else
                                                <div class="placeholder-icon">
                                                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="kost-details">
                                            <div class="kost-name">{{ $kost->nama_kost }}</div>
                                            <div class="kost-address">{{ $kost->alamat }}</div>
                                            <div class="kost-price">
                                                Rp {{ number_format($kost->harga_per_bulan) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="td-cell">
                                    <div class="owner-name">{{ $kost->owner->name }}</div>
                                    <div class="owner-email">{{ $kost->owner->email }}</div>
                                </td>
                                <td class="td-cell date-text">
                                    {{ $kost->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="td-cell">
                                    <div class="action-group">
                                        <a href="{{ route('kost.show', $kost->id) }}" target="_blank" class="btn-view">
                                            Lihat
                                        </a>

                                        <button
                                            onclick="confirmAction('approve', '{{ route('admin.verification.approve', $kost->id) }}')"
                                            class="btn-approve">
                                            Approve
                                        </button>

                                        <button
                                            onclick="confirmAction('reject', '{{ route('admin.verification.reject', $kost->id) }}')"
                                            class="btn-reject">
                                            Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    <div class="empty-icon-wrapper">
                                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <p style="font-size: 14px; font-weight: 500;">Semua beres! Tidak ada kost pending.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Active Kosts Section -->
            <h2 class="section-title">Daftar Kost Aktif</h2>
            <div class="table-card">
                <table class="custom-table">
                    <thead class="table-head">
                        <tr>
                            <th class="th-cell">Kost Info</th>
                            <th class="th-cell">Pemilik</th>
                            <th class="th-cell">Status</th>
                            <th class="th-cell th-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeKosts as $kost)
                            <tr class="tbody-row">
                                <td class="td-cell">
                                    <div class="kost-info">
                                        <div class="kost-thumb">
                                            @if($kost->images->first())
                                                <img class="thumb-img" src="{{ asset('storage/' . $kost->images->first()->path_foto) }}"
                                                    alt="">
                                            @else
                                                <div class="placeholder-icon">
                                                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="kost-details">
                                            <div class="kost-name">{{ $kost->nama_kost }}</div>
                                            <div class="kost-address">{{ $kost->alamat }}</div>
                                            <div class="kost-price">
                                                Rp {{ number_format($kost->harga_per_bulan) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="td-cell">
                                    <div class="owner-name">{{ $kost->owner->name }}</div>
                                    <div class="owner-email">{{ $kost->owner->email }}</div>
                                </td>
                                <td class="td-cell">
                                    <span class="badge-active">
                                        Active
                                    </span>
                                </td>
                                <td class="td-cell">
                                    <div class="action-group">
                                        <a href="{{ route('kost.show', $kost->id) }}" target="_blank" class="btn-view">
                                            Lihat
                                        </a>

                                        <button
                                            onclick="confirmAction('delete', '{{ route('admin.verification.destroy', $kost->id) }}')"
                                            class="btn-reject" style="color: #dc2626; border-color: #e5e7eb;">
                                            Delisting
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    Tidak ada kost aktif saat ini.
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
            function confirmAction(type, url) {
                let title = '';
                let text = '';
                let confirmButtonText = '';
                let iconHtml = '';

                if (type === 'approve') {
                    title = 'Setujui Kost?';
                    text = "Kost ini akan ditampilkan ke publik.";
                    confirmButtonText = 'Ya, Setujui';
                    iconHtml = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-gray-600 mx-auto mb-4" viewBox="0 0 24 24" fill="#4B5563">
                            <path d="M9 3v1H4v2h1v13a2 2 0 002 2h10a2 2 0 002-2V6h1V4h-5V3H9zM7 6h10v13H7V6zm2 2v9h2V8H9zm4 0v9h2V8h-2z" />
                        </svg>`; // Simple trash icon for consistency, or check if specific icon needed for approve. User image specifically showed Delete. Use checkmark for approve.
                    iconHtml = `
                        <div class="mx-auto mb-4">
                            <svg class="w-24 h-24 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>`;
                } else if (type === 'reject') {
                    title = 'Tolak Kost?';
                    text = "Kost ini tidak akan ditampilkan.";
                    confirmButtonText = 'Ya, Tolak';
                    iconHtml = `
                        <div class="mx-auto mb-4">
                            <svg class="w-24 h-24 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>`;
                } else if (type === 'delete') {
                    title = 'Hapus Listing?';
                    text = "Tindakan ini tidak dapat dibatalkan!";
                    confirmButtonText = 'Ya, Hapus';
                    // Custom simplified trash icon to match the bulky grey one in image
                    iconHtml = `
                        <div class="mx-auto mb-4">
                            <svg width="120" height="120" viewBox="0 0 24 24" fill="#52525B" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" />
                            </svg>
                        </div>`;
                }

                Swal.fire({
                    title: title,
                    html: `
                        ${iconHtml}
                        <p class="text-gray-500 text-sm font-normal mt-2">${text}</p>
                            `,
                    showCancelButton: true,
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                    reverseButtons: true, // Buttons close together usually imply reverse in some designs, or just flex gap
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

                        if (type === 'delete') {
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            form.appendChild(methodField);
                        }

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        </script>
        </script>
    @endsection
@endsection