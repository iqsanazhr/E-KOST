@extends('layouts.app')

@section('content')
    @extends('layouts.app')

    @section('content')
        <style>
            .feedback-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 32px 24px;
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
                margin: 0;
            }

            .page-subtitle {
                color: #6b7280;
                margin: 4px 0 0 0;
                font-size: 16px;
            }

            .btn-export {
                background-color: #000;
                color: white;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 8px;
                transition: background-color 0.2s;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }

            .btn-export:hover {
                background-color: #1f2937;
            }

            .table-card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                border: 1px solid #e5e7eb;
                overflow: hidden;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .custom-table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
                font-size: 14px;
            }

            .table-head {
                background-color: #f9fafb;
                border-bottom: 1px solid #e5e7eb;
            }

            .th-cell {
                padding: 16px 24px;
                font-weight: 500;
                color: #111827;
            }

            .tbody-row {
                border-bottom: 1px solid #e5e7eb;
                transition: background-color 0.2s;
            }

            .tbody-row:last-child {
                border-bottom: none;
            }

            .tbody-row:hover {
                background-color: #f9fafb;
            }

            .td-cell {
                padding: 16px 24px;
                color: #4b5563;
            }

            .td-name {
                font-weight: 500;
                color: #111827;
            }

            .message-cell {
                max-width: 450px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .time-cell {
                color: #6b7280;
                font-size: 12px;
            }

            .empty-state {
                text-align: center;
                padding: 32px 24px;
                color: #6b7280;
            }

            .pagination-wrapper {
                padding: 16px 24px;
                border-top: 1px solid #e5e7eb;
            }
        </style>

        <div class="feedback-container">
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
                                    <td colspan="4" class="empty-state">
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
@endsection