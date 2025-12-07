@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Kost Favorit Saya</h1>
        <p class="text-gray-500 mt-2">Daftar kost yang telah Anda simpan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($favorites as $kost)
            <a href="{{ route('kost.show', $kost->id) }}" class="group block bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:border-gray-200 transition-all duration-300">
                <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
                    @if($kost->images->count() > 0)
                        <img src="{{ asset('storage/' . $kost->images->first()->path_foto) }}" alt="{{ $kost->nama_kost }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider backdrop-blur-md bg-white/90 border border-white/20 shadow-sm
                            {{ $kost->tipe == 'putra' ? 'text-blue-700' : ($kost->tipe == 'putri' ? 'text-pink-700' : 'text-purple-700') }}">
                            {{ $kost->tipe }}
                        </span>
                    </div>
                </div>
                
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1">{{ $kost->nama_kost }}</h3>
                    </div>
                    
                    <p class="text-sm text-gray-500 mb-4 line-clamp-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $kost->alamat }}
                    </p>
                    
                    <div class="flex items-center gap-2 mb-4 overflow-hidden">
                        @foreach($kost->facilities->take(3) as $fasilitas)
                            <span class="text-[10px] font-medium bg-gray-50 text-gray-600 px-2 py-1 rounded border border-gray-100">{{ $fasilitas->nama_fasilitas }}</span>
                        @endforeach
                        @if($kost->facilities->count() > 3)
                            <span class="text-[10px] font-medium text-gray-400">+{{ $kost->facilities->count() - 3 }}</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                        <div>
                            <span class="text-xs text-gray-400">Mulai dari</span>
                            <div class="font-bold text-gray-900">Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}</div>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-black group-hover:text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada kost favorit</h3>
                <p class="text-gray-500 mt-1">Simpan kost yang Anda sukai untuk dilihat nanti.</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-black text-white px-6 py-2 rounded-lg font-medium hover:bg-gray-800 transition-all">
                    Cari Kost
                </a>
            </div>
        @endforelse
    </div>
    
    <div class="mt-12">
        {{ $favorites->links() }}
    </div>
</div>
@endsection
