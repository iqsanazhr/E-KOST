@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Syarat dan Ketentuan</h1>
        <div class="prose prose-gray max-w-none">
            <p class="text-gray-600 mb-4">Terakhir diperbarui: {{ date('F Y') }}</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Ketentuan Umum</h3>
            <p class="text-gray-600 mb-4">
                Dengan mengakses atau menggunakan E-Kost, Anda setuju untuk terikat oleh syarat dan ketentuan ini. Jika Anda
                tidak setuju, harap jangan gunakan layanan kami.
            </p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. Tanggung Jawab Pengguna</h3>
            <p class="text-gray-600 mb-4">
                Anda bertanggung jawab sepenuhnya atas segala aktivitas yang terjadi di bawah akun Anda. Anda setuju untuk
                memberikan informasi yang akurat dan menjaga kerahasiaan kredensial login Anda.
            </p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Larangan</h3>
            <p class="text-gray-600 mb-4">
                Pengguna dilarang keras untuk:
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Memposting konten palsu, menyesatkan, atau ilegal.</li>
                <li>Melakukan scraping atau pengumpulan data otomatis tanpa izin.</li>
                <li>Mengganggu operasi situs web atau server kami.</li>
            </ul>
            </p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. Perubahan Layanan</h3>
            <p class="text-gray-600 mb-4">
                Kami berhak untuk mengubah atau menghentikan layanan kapan saja tanpa pemberitahuan sebelumnya. Kami tidak
                bertanggung jawab atas kerugian yang timbul akibat perubahan tersebut.
            </p>
        </div>
    </div>
@endsection