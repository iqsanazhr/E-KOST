@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Verifikasi Listing Kost</h1>

        @if(session('success'))
            <div class="bg-gray-900 text-white px-4 py-3 rounded-xl relative mb-6 shadow-lg flex items-center gap-3">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kost Info
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pemilik
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal
                            Submit</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($pendingKosts as $kost)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-start">
                                    <div
                                        class="h-16 w-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                        @if($kost->images->first())
                                            <img class="h-full w-full object-cover"
                                                src="{{ asset('storage/' . $kost->images->first()->path_foto) }}" alt="">
                                        @else
                                            <div class="flex items-center justify-center h-full text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $kost->nama_kost }}</div>
                                        <div class="text-sm text-gray-500 line-clamp-1">{{ $kost->alamat }}</div>
                                        <div
                                            class="text-xs text-gray-900 mt-1 font-bold bg-gray-100 px-2 py-0.5 rounded inline-block">
                                            Rp {{ number_format($kost->harga_per_bulan) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $kost->owner->name }}</div>
                                <div class="text-xs text-gray-500">{{ $kost->owner->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $kost->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('kost.show', $kost->id) }}" target="_blank"
                                        class="bg-white border border-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-gray-50 transition-all shadow-sm">
                                        Lihat
                                    </a>

                                    <button
                                        onclick="confirmAction('approve', '{{ route('admin.verification.approve', $kost->id) }}')"
                                        class="bg-black text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-gray-800 transition-all shadow-lg shadow-gray-500/20">
                                        Approve
                                    </button>

                                    <button
                                        onclick="confirmAction('reject', '{{ route('admin.verification.reject', $kost->id) }}')"
                                        class="bg-white border border-gray-200 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-50 transition-all">
                                        Reject
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3 text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium">Semua beres! Tidak ada kost pending.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Active Kosts Section -->
        <h2 class="text-xl font-bold text-gray-900 mt-12 mb-6">Daftar Kost Aktif</h2>
        <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kost Info
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pemilik
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($activeKosts as $kost)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-start">
                                    <div
                                        class="h-16 w-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                        @if($kost->images->first())
                                            <img class="h-full w-full object-cover"
                                                src="{{ asset('storage/' . $kost->images->first()->path_foto) }}" alt="">
                                        @else
                                            <div class="flex items-center justify-center h-full text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $kost->nama_kost }}</div>
                                        <div class="text-sm text-gray-500 line-clamp-1">{{ $kost->alamat }}</div>
                                        <div
                                            class="text-xs text-gray-900 mt-1 font-bold bg-gray-100 px-2 py-0.5 rounded inline-block">
                                            Rp {{ number_format($kost->harga_per_bulan) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $kost->owner->name }}</div>
                                <div class="text-xs text-gray-500">{{ $kost->owner->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2.5 py-1 inline-flex text-[10px] font-bold uppercase tracking-wide rounded-full bg-green-50 text-green-700 border border-green-200">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('kost.show', $kost->id) }}" target="_blank"
                                        class="bg-white border border-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-gray-50 transition-all shadow-sm">
                                        Lihat
                                    </a>

                                    <button
                                        onclick="confirmAction('delete', '{{ route('admin.verification.destroy', $kost->id) }}')"
                                        class="bg-white border border-gray-200 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-50 hover:border-red-200 transition-all">
                                        Delisting
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
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
            let confirmButtonColor = '';
            let cancelButtonColor = '#E5E7EB'; // Silver/Gray

            if (type === 'approve') {
                title = 'Setujui Kost?';
                text = "Kost ini akan ditampilkan ke publik.";
                confirmButtonText = 'Ya, Setujui';
                confirmButtonColor = '#000000'; // Black
            } else if (type === 'reject') {
                title = 'Tolak Kost?';
                text = "Kost ini tidak akan ditampilkan.";
                confirmButtonText = 'Ya, Tolak';
                confirmButtonColor = '#000000'; // Black (Theme consistency)
            } else if (type === 'delete') {
                title = 'Hapus Listing?';
                text = "Tindakan ini tidak dapat dibatalkan!";
                confirmButtonText = 'Ya, Hapus';
                confirmButtonColor = '#000000'; // Black (Theme consistency)
            }

            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                iconColor: '#000000',
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: cancelButtonColor,
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Batal',
                background: '#ffffff',
                color: '#000000',
                customClass: {
                    popup: 'rounded-2xl border border-gray-100 shadow-xl',
                    confirmButton: 'mx-2 px-6 py-2.5 rounded-xl font-bold text-sm text-white bg-black border-2 border-black shadow-sm hover:bg-transparent hover:text-black transition-all duration-200',
                    cancelButton: 'mx-2 px-6 py-2.5 rounded-xl font-bold text-sm text-gray-800 bg-white border-2 border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200',
                    title: 'text-xl font-bold text-gray-900',
                    htmlContainer: 'text-gray-600'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create a form and submit it
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
            })
        }
    </script>
@endsection