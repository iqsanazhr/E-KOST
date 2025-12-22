@extends('layouts.app')

@section('content')
    <div class="admin-container">
        <div class="page-header">
            <div>
                <h1 class="page-title">Masukan Pengguna</h1>
                <p class="page-subtitle">Daftar pesan dan feedback dari pengguna.</p>
            </div>
            <a href="{{ route('admin.feedbacks.export') }}" class="btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export CSV
            </a>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="custom-table">
                    <thead class="table-head">
                        <tr>
                            <th class="th-cell">Nama</th>
                            <th class="th-cell">Email</th>
                            <th class="th-cell">Pesan</th>
                            <th class="th-cell">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($feedbacks as $feedback)
                            <tr class="tbody-row">
                                <td class="td-cell td-name">{{ $feedback->name }}</td>
                                <td class="td-cell">{{ $feedback->email }}</td>
                                <td class="td-cell message-cell">{{ $feedback->message }}</td>
                                <td class="td-cell time-cell">{{ $feedback->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state-table">
                                    Belum ada masukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($feedbacks->hasPages())
                <div class="pagination-wrapper">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection