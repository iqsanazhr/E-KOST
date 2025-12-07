@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Kebijakan Privasi</h1>
        <div class="prose prose-gray max-w-none">
            <p class="text-gray-600 mb-4">Terakhir diperbarui: {{ date('F Y') }}</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Pendahuluan</h3>
            <p class="text-gray-600 mb-4">
                E-Kost menghargai privasi Anda. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan
                melindungi informasi pribadi Anda saat menggunakan layanan kami.
            </p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. Informasi yang Kami Kumpulkan</h3>
            <p class="text-gray-600 mb-4">
                Kami mengumpulkan informasi yang Anda berikan secara langsung, seperti saat mendaftar akun, mencari kost,
                atau menghubungi pemilik kost. Informasi ini dapat meliputi nama, alamat email, nomor telepon, dan
                preferensi pencarian.
            </p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Penggunaan Informasi</h3>
            <p class="text-gray-600 mb-4">
                Kami menggunakan informasi Anda untuk:
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Menyediakan dan meningkatkan layanan kami.</li>
                <li>Menghubungkan pencari kost dengan pemilik kost.</li>
                <li>Mengirimkan pembaruan, keamanan, dan notifikasi layanan.</li>
            </ul>
            </p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. Keamanan Data</h3>
            <p class="text-gray-600 mb-4">
                Kami menerapkan langkah-langkah keamanan yang wajar untuk melindungi informasi Anda dari akses yang tidak
                sah. Namun, tidak ada metode transmisi internet yang 100% aman.
            </p>
        </div>
    </div>
@endsection