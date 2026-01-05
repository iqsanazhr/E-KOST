@extends('layouts.app')

@section('content')
    <div class="container p-8">
        <div class="flex flex-col md-flex-row justify-between items-center mb-6 gap-4" style="align-items: center;">
            <div class="w-full md-w-auto">
                <h1 class="page-title" style="margin-bottom: 0.25rem;">Masukan Pengguna</h1>
                <p class="text-gray-500 text-sm">Daftar pesan dan feedback dari pengguna.</p>
            </div>

            <a href="{{ route('admin.feedbacks.export') }}" class="btn-primary inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Ekspor CSV
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm custom-table">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 font-bold text-gray-900 text-left">Nama</th>
                            <th class="px-6 py-4 font-bold text-gray-900 text-left">Email</th>
                            <th class="px-6 py-4 font-bold text-gray-900 text-left">Pesan</th>
                            <th class="px-6 py-4 font-bold text-gray-900 text-left display-time">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($feedbacks as $feedback)
                            <tr class="hover-bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $feedback->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $feedback->email }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 max-w-xs truncate" title="{{ $feedback->message }}">
                                    {{ $feedback->message }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap text-xs">
                                    {{ $feedback->created_at->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-4">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                        <p>Belum ada masukan dari pengguna.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($feedbacks->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Custom Responsive Logic since full Tailwind is missing */
        @media (min-width: 768px) {
            .md-flex-row {
                flex-direction: row !important;
            }

            .md-w-auto {
                width: auto !important;
            }
        }

        /* Table Styles */
        .custom-table th,
        .custom-table td {
            text-align: left;
        }

        .border-b {
            border-bottom: 1px solid #f3f4f6;
        }

        .divide-y>tr>td {
            border-top: 1px solid #f3f4f6;
        }

        .hover-bg-gray-50:hover {
            background-color: #f9fafb;
        }

        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .max-w-xs {
            max-width: 20rem;
        }

        .font-bold {
            font-weight: 600;
        }
    </style>
@endsection