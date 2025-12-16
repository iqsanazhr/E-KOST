@extends('layouts.app')

@section('content')
    @extends('layouts.app')

    @section('content')
        <style>
            .features-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 80px 24px;
                font-family: 'Inter', sans-serif;
            }

            .hero-section {
                text-align: center;
                max-width: 800px;
                margin: 0 auto 80px auto;
            }

            .hero-title {
                font-size: 36px;
                font-weight: 800;
                color: #111827;
                margin-bottom: 24px;
                line-height: 1.2;
            }

            @media (min-width: 768px) {
                .hero-title {
                    font-size: 48px;
                }
            }

            .highlight-text {
                background: linear-gradient(to right, #1f2937, #6b7280);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent;
            }

            .hero-subtitle {
                font-size: 18px;
                color: #6b7280;
                line-height: 1.6;
            }

            .features-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 32px;
                margin-bottom: 80px;
            }

            @media (min-width: 768px) {
                .features-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            .feature-card {
                background: white;
                padding: 32px;
                border-radius: 16px;
                border: 1px solid #f3f4f6;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                border-color: #e5e7eb;
            }

            .icon-wrapper {
                width: 48px;
                height: 48px;
                background-color: #f9fafb;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 24px;
                transition: all 0.3s ease;
            }

            .feature-card:hover .icon-wrapper {
                background-color: #000;
                color: white;
            }

            .feature-card:hover .feature-icon {
                color: white;
            }

            .feature-icon {
                width: 24px;
                height: 24px;
                color: #111827;
                transition: color 0.3s ease;
            }

            .feature-card-title {
                font-size: 20px;
                font-weight: 700;
                color: #111827;
                margin-bottom: 12px;
            }

            .feature-card-desc {
                color: #6b7280;
                line-height: 1.6;
            }

            .cta-section {
                background-color: #000;
                border-radius: 24px;
                padding: 48px;
                text-align: center;
                position: relative;
                overflow: hidden;
                color: white;
            }

            .cta-content {
                position: relative;
                z-index: 10;
            }

            .cta-title {
                font-size: 30px;
                font-weight: 700;
                margin-bottom: 24px;
                color: white;
            }

            .cta-desc {
                color: #9ca3af;
                margin-bottom: 32px;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

            .cta-buttons {
                display: flex;
                justify-content: center;
                gap: 16px;
                flex-wrap: wrap;
            }

            .btn-white {
                background-color: white;
                color: black;
                padding: 12px 32px;
                border-radius: 9999px;
                font-weight: 700;
                text-decoration: none;
                transition: background-color 0.2s;
            }

            .btn-white:hover {
                background-color: #f3f4f6;
            }

            .btn-outline {
                border: 1px solid #4b5563;
                color: white;
                padding: 12px 32px;
                border-radius: 9999px;
                font-weight: 700;
                text-decoration: none;
                transition: background-color 0.2s;
            }

            .btn-outline:hover {
                background-color: #1f2937;
            }
        </style>

        <div class="features-container">
            <!-- Hero -->
            <div class="hero-section">
                <h1 class="hero-title">
                    Kenapa Memilih <span class="highlight-text">E-Kost?</span>
                </h1>
                <p class="hero-subtitle">
                    Kami menyederhanakan proses pencarian tempat tinggal bagi mahasiswa dan umum dengan teknologi modern dan
                    data terverifikasi.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="features-grid">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="feature-card-title">Pencarian Cepat</h3>
                    <p class="feature-card-desc">
                        Filter canggih berdasarkan harga, lokasi, dan fasilitas membantu Anda menemukan kost impian dalam
                        hitungan detik.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="feature-card-title">Data Terverifikasi</h3>
                    <p class="feature-card-desc">
                        Setiap listing kost diperiksa secara manual oleh tim admin kami untuk memastikan keakuratan data dan
                        foto.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="feature-card-title">Hubungi Langsung</h3>
                    <p class="feature-card-desc">
                        Tanpa perantara. Dapatkan kontak langsung pemilik kost untuk negosiasi dan janji temu survei lokasi.
                    </p>
                </div>
            </div>

            <!-- CTA -->
            <div class="cta-section">
                <div class="cta-content">
                    <h2 class="cta-title">Siap Mencari Tempat Tinggal Baru?</h2>
                    <p class="cta-desc">Bergabunglah dengan ribuan pencari kost lainnya dan temukan
                        kenyamanan Anda hari ini.</p>
                    <div class="cta-buttons">
                        <a href="{{ route('home') }}" class="btn-white">
                            Mulai Mencari
                        </a>
                        <a href="{{ route('help') }}" class="btn-outline">
                            Butuh bantuan?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection