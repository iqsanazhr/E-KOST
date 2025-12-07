@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 mb-4">Pusat Bantuan</h1>
            <p class="text-gray-500 text-lg">Temukan jawaban atas pertanyaan Anda atau hubungi tim support kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- FAQ Section -->
            <div class="md:col-span-2 space-y-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pertanyaan Umum</h2>

                <!-- FAQ Item 1 -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-colors">
                    <h3 class="font-bold text-gray-900 mb-2">Bagaimana cara menghubungi pemilik kost?</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Anda dapat melihat detail kontak pemilik kost (nomor telepon/WhatsApp) pada halaman detail kost.
                        Klik tombol "Hubungi Pemilik" untuk terhubung langsung.
                    </p>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-colors">
                    <h3 class="font-bold text-gray-900 mb-2">Apakah ada biaya admin untuk pencari kost?</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Tidak. E-Kost 100% gratis untuk pencari kost. Kami tidak memungut biaya apapun dari transaksi sewa
                        menyewa Anda.
                    </p>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-colors">
                    <h3 class="font-bold text-gray-900 mb-2">Bagaimana cara mendaftarkan kost saya?</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Cukup daftar akun sebagai "Pemilik", lalu masuk ke Dashboard Pemilik. Klik tombol "Tambah Kost
                        Baru", isi formulir data kost, dan upload foto. Listing Anda akan tayang setelah diverifikasi admin.
                    </p>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-colors">
                    <h3 class="font-bold text-gray-900 mb-2">Berapa lama proses verifikasi kost?</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Tim admin kami biasanya memproses verifikasi dalam waktu 1x24 jam kerja. Anda akan melihat status
                        listing berubah menjadi "Approved" di dashboard.
                    </p>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="md:col-span-1">
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 sticky top-28">
                    <h3 class="font-bold text-gray-900 mb-4">Kirim Masukan</h3>
                    <p class="text-gray-500 text-sm mb-6">
                        Punya saran atau kendala? Kirimkan pesan kepada kami.
                    </p>

                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 text-sm p-3 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" required
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-black focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" required
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-black focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Pesan</label>
                            <textarea name="message" rows="4" required
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-black focus:border-transparent transition-all resize-none"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-black text-white font-bold py-2.5 rounded-lg hover:bg-gray-800 transition-all text-sm shadow-lg shadow-gray-500/20">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection