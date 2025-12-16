@extends('layouts.app')

@section('content')
    @extends('layouts.app')

    @section('content')
        <style>
            .help-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 80px 24px;
                font-family: 'Inter', sans-serif;
            }

            .help-header {
                text-align: center;
                margin-bottom: 64px;
            }

            .help-title {
                font-size: 36px;
                font-weight: 800;
                color: #111827;
                margin-bottom: 16px;
                letter-spacing: -0.025em;
            }

            .help-subtitle {
                color: #6b7280;
                font-size: 18px;
            }

            .help-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 48px;
            }

            @media (min-width: 768px) {
                .help-grid {
                    grid-template-columns: 2fr 1fr;
                }
            }

            .faq-section {
                display: flex;
                flex-direction: column;
                gap: 24px;
            }

            .section-title {
                font-size: 24px;
                font-weight: 700;
                color: #111827;
                margin-bottom: 24px;
            }

            .faq-item {
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                padding: 24px;
                transition: border-color 0.2s;
            }

            .faq-item:hover {
                border-color: #d1d5db;
            }

            .faq-question {
                font-weight: 700;
                color: #111827;
                margin-bottom: 8px;
                font-size: 16px;
            }

            .faq-answer {
                color: #6b7280;
                font-size: 14px;
                line-height: 1.6;
            }

            .contact-card {
                background-color: #f9fafb;
                border-radius: 16px;
                padding: 24px;
                border: 1px solid #f3f4f6;
                position: sticky;
                top: 112px;
                /* Adjusted roughly for top-28 */
            }

            .contact-title {
                font-weight: 700;
                color: #111827;
                margin-bottom: 16px;
                font-size: 18px;
            }

            .contact-desc {
                color: #6b7280;
                font-size: 14px;
                margin-bottom: 24px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                display: block;
                font-size: 12px;
                font-weight: 700;
                color: #374151;
                margin-bottom: 4px;
            }

            .form-input {
                width: 100%;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 8px 12px;
                font-size: 14px;
                transition: all 0.2s;
                outline: none;
                box-sizing: border-box;
                /* Important for padding */
            }

            .form-input:focus {
                border-color: #000;
                box-shadow: 0 0 0 1px #000;
            }

            .form-textarea {
                width: 100%;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 8px 12px;
                font-size: 14px;
                resize: none;
                outline: none;
                box-sizing: border-box;
            }

            .form-textarea:focus {
                border-color: #000;
                box-shadow: 0 0 0 1px #000;
            }

            .btn-submit {
                width: 100%;
                background-color: #000;
                color: white;
                font-weight: 700;
                padding: 10px 16px;
                border-radius: 8px;
                font-size: 14px;
                border: none;
                cursor: pointer;
                transition: background-color 0.2s;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .btn-submit:hover {
                background-color: #333;
            }

            .alert-success {
                background-color: #eff6ff;
                /* blue-50 equivalent styling as green was requested in original file but typically success is green, sticking to original request or improved style? Original was green-50 text-green-700. Let's do that manually. */
                background-color: #f0fdf4;
                color: #15803d;
                font-size: 14px;
                padding: 12px;
                border-radius: 8px;
                margin-bottom: 16px;
            }
        </style>

        <div class="help-container">
            <div class="help-header">
                <h1 class="help-title">Pusat Bantuan</h1>
                <p class="help-subtitle">Temukan jawaban atas pertanyaan Anda atau hubungi tim support kami.</p>
            </div>

            <div class="help-grid">
                <!-- FAQ Section -->
                <div class="faq-section">
                    <h2 class="section-title">Pertanyaan Umum</h2>

                    <!-- FAQ Item 1 -->
                    <div class="faq-item">
                        <h3 class="faq-question">Bagaimana cara menghubungi pemilik kost?</h3>
                        <p class="faq-answer">
                            Anda dapat melihat detail kontak pemilik kost (nomor telepon/WhatsApp) pada halaman detail kost.
                            Klik tombol "Hubungi Pemilik" untuk terhubung langsung.
                        </p>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="faq-item">
                        <h3 class="faq-question">Apakah ada biaya admin untuk pencari kost?</h3>
                        <p class="faq-answer">
                            Tidak. E-Kost 100% gratis untuk pencari kost. Kami tidak memungut biaya apapun dari transaksi sewa
                            menyewa Anda.
                        </p>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="faq-item">
                        <h3 class="faq-question">Bagaimana cara mendaftarkan kost saya?</h3>
                        <p class="faq-answer">
                            Cukup daftar akun sebagai "Pemilik", lalu masuk ke Dashboard Pemilik. Klik tombol "Tambah Kost
                            Baru", isi formulir data kost, dan upload foto. Listing Anda akan tayang setelah diverifikasi admin.
                        </p>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="faq-item">
                        <h3 class="faq-question">Berapa lama proses verifikasi kost?</h3>
                        <p class="faq-answer">
                            Tim admin kami biasanya memproses verifikasi dalam waktu 1x24 jam kerja. Anda akan melihat status
                            listing berubah menjadi "Approved" di dashboard.
                        </p>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="md:col-span-1">
                    <div class="contact-card">
                        <h3 class="contact-title">Kirim Masukan</h3>
                        <p class="contact-desc">
                            Punya saran atau kendala? Kirimkan pesan kepada kami.
                        </p>

                        @if(session('success'))
                            <div class="alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pesan</label>
                                <textarea name="message" rows="4" required class="form-textarea"></textarea>
                            </div>
                            <button type="submit" class="btn-submit">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection