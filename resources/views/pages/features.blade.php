@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-20">
        <!-- Hero -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-gray-900 mb-6">
                Kenapa Memilih <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-gray-800 to-gray-500">E-Kost?</span>
            </h1>
            <p class="text-lg text-gray-500 leading-relaxed">
                Kami menyederhanakan proses pencarian tempat tinggal bagi mahasiswa dan umum dengan teknologi modern dan
                data terverifikasi.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <!-- Feature 1 -->
            <div
                class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mb-6 group-hover:bg-black group-hover:text-white transition-colors">
                    <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Pencarian Cepat</h3>
                <p class="text-gray-500 leading-relaxed">
                    Filter canggih berdasarkan harga, lokasi, dan fasilitas membantu Anda menemukan kost impian dalam
                    hitungan detik.
                </p>
            </div>

            <!-- Feature 2 -->
            <div
                class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mb-6 group-hover:bg-black group-hover:text-white transition-colors">
                    <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Data Terverifikasi</h3>
                <p class="text-gray-500 leading-relaxed">
                    Setiap listing kost diperiksa secara manual oleh tim admin kami untuk memastikan keakuratan data dan
                    foto.
                </p>
            </div>

            <!-- Feature 3 -->
            <div
                class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mb-6 group-hover:bg-black group-hover:text-white transition-colors">
                    <svg class="w-6 h-6 text-gray-900 group-hover:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Hubungi Langsung</h3>
                <p class="text-gray-500 leading-relaxed">
                    Tanpa perantara. Dapatkan kontak langsung pemilik kost untuk negosiasi dan janji temu survei lokasi.
                </p>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-black rounded-3xl p-12 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-gray-800 to-black opacity-50"></div>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-6">Siap Mencari Tempat Tinggal Baru?</h2>
                <p class="text-gray-400 mb-8 max-w-xl mx-auto">Bergabunglah dengan ribuan pencari kost lainnya dan temukan
                    kenyamanan Anda hari ini.</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('home') }}"
                        class="bg-white text-black px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-colors">
                        Mulai Mencari
                    </a>
                    <a href="{{ route('help') }}"
                        class="border border-gray-600 text-white px-8 py-3 rounded-full font-bold hover:bg-gray-800 transition-colors">
                        Butuh bantuan?
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection