@extends('layouts.app')

@section('content')

    <style>
        .fav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 24px;
            font-family: 'Inter', sans-serif;
        }

        .fav-header {
            margin-bottom: 32px;
        }

        .fav-title {
            font-size: 30px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
        }

        .fav-subtitle {
            color: #6b7280;
            font-size: 16px;
        }

        .fav-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 24px;
        }

        @media (min-width: 768px) {
            .fav-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1280px) {
            .fav-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .fav-card {
            background: white;
            border: 1px solid #f3f4f6;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }

        .fav-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-color: #e5e7eb;
        }

        .fav-image-wrapper {
            position: relative;
            padding-top: 75%;
            /* 4:3 Aspect Ratio */
            background-color: #f3f4f6;
            overflow: hidden;
        }

        .fav-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .fav-card:hover .fav-image {
            transform: scale(1.05);
        }

        .fav-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .tag-putra {
            color: #1d4ed8;
        }

        .tag-putri {
            color: #be185d;
        }

        .tag-campur {
            color: #7e22ce;
        }

        .fav-content {
            padding: 20px;
        }

        .fav-name {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fav-card:hover .fav-name {
            color: #000;
        }

        .fav-address {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fav-facilities {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            overflow: hidden;
        }

        .fav-badge {
            font-size: 10px;
            font-weight: 600;
            background-color: #f9fafb;
            color: #4b5563;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #f3f4f6;
        }

        .fav-footer {
            padding-top: 16px;
            border-top: 1px solid #f9fafb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fav-price-label {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 2px;
        }

        .fav-price {
            font-size: 16px;
            font-weight: 800;
            color: #111827;
        }

        .fav-arrow {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111827;
            transition: all 0.2s;
        }

        .fav-card:hover .fav-arrow {
            background-color: #000;
            color: #fff;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 0;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            background-color: #f3f4f6;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: #9ca3af;
        }

        .btn-black {
            display: inline-block;
            margin-top: 16px;
            background-color: #000;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-black:hover {
            background-color: #333;
        }
    </style>

    <div class="fav-container">
        <div class="fav-header">
            <h1 class="fav-title">Kost Favorit Saya</h1>
            <p class="fav-subtitle">Daftar kost yang telah Anda simpan.</p>
        </div>

        <div class="fav-grid">
            @forelse($favorites as $kost)
                <a href="{{ route('kost.show', $kost->id) }}" class="fav-card">
                    <div class="fav-image-wrapper">
                        @if($kost->images->count() > 0)
                            <img src="{{ asset('storage/' . $kost->images->first()->path_foto) }}" alt="{{ $kost->nama_kost }}"
                                class="fav-image">
                        @else
                            <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #d1d5db;">
                                <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif

                        <div
                            class="fav-tag {{ $kost->tipe == 'putra' ? 'tag-putra' : ($kost->tipe == 'putri' ? 'tag-putri' : 'tag-campur') }}">
                            {{ $kost->tipe }}
                        </div>
                    </div>

                    <div class="fav-content">
                        <h3 class="fav-name">{{ $kost->nama_kost }}</h3>

                        <p class="fav-address">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $kost->alamat }}
                        </p>

                        <div class="fav-facilities">
                            @foreach($kost->facilities->take(3) as $fasilitas)
                                <span class="fav-badge">{{ $fasilitas->nama_fasilitas }}</span>
                            @endforeach
                            @if($kost->facilities->count() > 3)
                                <span class="fav-badge" style="color: #9ca3af;">+{{ $kost->facilities->count() - 3 }}</span>
                            @endif
                        </div>

                        <div class="fav-footer">
                            <div>
                                <div class="fav-price-label">Mulai dari</div>
                                <div class="fav-price">Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}</div>
                            </div>
                            <div class="fav-arrow">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 4px;">Belum ada kost favorit
                    </h3>
                    <p style="color: #6b7280;">Simpan kost yang Anda sukai untuk dilihat nanti.</p>
                    <a href="{{ route('home') }}" class="btn-black">
                        Cari Kost
                    </a>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 48px;">
            {{ $favorites->links() }}
        </div>
    </div>

@endsection