@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Masukan Pengguna</h1>
                <p class="text-gray-500">Daftar pesan dan feedback dari pengguna.</p>
            </div>
            <a href="{{ route('admin.feedbacks.export') }}"
                class="bg-black text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors flex items-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export CSV
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-900">Nama</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Email</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Pesan</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($feedbacks as $feedback)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $feedback->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $feedback->email }}</td>
                                <td class="px-6 py-4 text-gray-600 max-w-md truncate">{{ $feedback->message }}</td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $feedback->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada masukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($feedbacks->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection