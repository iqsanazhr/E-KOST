@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen pb-20" style="background-color: white; padding-bottom: 5rem;">
        <!-- Image Gallery (Airbnb Style) -->
        <div class="container pt-6 pb-8" style="padding-top: 1.5rem; padding-bottom: 2rem;">
            <div class="image-gallery-grid"
                style="display: grid; gap: 0.5rem; height: 400px; border-radius: 1rem; overflow: hidden; position: relative;">
                <style>
                    .image-gallery-grid {
                        grid-template-columns: 1fr;
                    }

                    @media (min-width: 768px) {
                        .image-gallery-grid {
                            grid-template-columns: repeat(4, 1fr);
                            height: 500px !important;
                        }

                        .gallery-main {
                            grid-column: span 2;
                        }

                        .gallery-sub {
                            grid-column: span 2;
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            grid-template-rows: repeat(2, 1fr);
                            gap: 0.5rem;
                        }
                    }

                    .gallery-hidden-mobile {
                        display: none;
                    }

                    @media (min-width: 768px) {
                        .gallery-hidden-mobile {
                            display: grid;
                        }
                    }
                </style>

                <!-- Main Image -->
                <div class="gallery-main h-full relative" style="height: 100%; position: relative;">
                    @if($kost->images->first())
                        <img src="{{ asset('storage/' . $kost->images->first()->path_foto) }}"
                            class="w-full h-full object-cover"
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s;">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400"
                            style="background-color: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Secondary Images Grid -->
                <div class="gallery-hidden-mobile gallery-sub h-full">
                    @foreach($kost->images->skip(1)->take(4) as $index => $img)
                        <div class="relative overflow-hidden h-full">
                            <img src="{{ asset('storage/' . $img->path_foto) }}" class="w-full h-full object-cover"
                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s;">
                        </div>
                    @endforeach

                    <!-- Placeholder if less than 5 images -->
                    @for($i = $kost->images->count(); $i < 5; $i++)
                        @if($i > 0) <!-- Skip the first one as it's main -->
                            <div class="bg-gray-100 w-full h-full" style="background-color: #f3f4f6;"></div>
                        @endif
                    @endfor
                </div>

                <button
                    class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg text-sm font-medium shadow-lg hover:bg-white transition flex items-center gap-2"
                    style="position: absolute; bottom: 1rem; right: 1rem; background-color: rgba(255,255,255,0.9); backdrop-filter: blur(4px); padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; border: none; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--shadow-lg);">
                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Lihat Semua Foto
                </button>
            </div>
        </div>

        <div class="container">
            @if(session('success'))
                <div class="custom-alert-container">
                    <style>
                        .custom-alert-container {
                            animation: slideInDown 0.5s ease-out forwards;
                            margin-bottom: 24px;
                        }

                        @keyframes slideInDown {
                            from {
                                transform: translateY(-20px);
                                opacity: 0;
                            }

                            to {
                                transform: translateY(0);
                                opacity: 1;
                            }
                        }
                    </style>
                    <div style="
                                                                                            background: linear-gradient(to right, #f3f4f6, #ffffff);
                                                                                            border-left: 4px solid black;
                                                                                            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                                                                                            padding: 16px;
                                                                                            border-radius: 12px;
                                                                                            display: flex;
                                                                                            align-items: center;
                                                                                            justify-content: space-between;
                                                                                            gap: 12px;
                                                                                            position: relative;
                                                                                            overflow: hidden;
                                                                                            color: #111827;
                                                                                        ">
                        <div style="display: flex; align-items: center; gap: 12px; position: relative; z-index: 10;">
                            <div
                                style="background-color: black; color: white; padding: 6px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </div>
                            <span style="font-weight: 700; font-size: 14px;">{{ session('success') }}</span>
                        </div>
                        <!-- Close Button -->
                        <button onclick="this.parentElement.parentElement.remove()"
                            style="background: none; border: none; cursor: pointer; color: #9ca3af; padding: 4px; display: flex; align-items: center; justify-content: center; transition: color 0.2s;">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            <div class="content-layout">
                <style>
                    .content-layout {
                        display: flex;
                        flex-direction: column;
                        gap: 4rem;
                    }

                    @media (min-width: 768px) {
                        .content-layout {
                            flex-direction: row;
                        }

                        .content-main {
                            flex: 3;
                        }

                        .content-sidebar {
                            flex: 1;
                            min-width: 0;
                        }
                    }
                </style>
                <!-- Left Content -->
                <div class="content-main">
                    <!-- Header -->
                    <div class="border-b pb-6 mb-8"
                        style="border-bottom: 1px solid #e5e7eb; padding-bottom: 1.5rem; margin-bottom: 2rem;">
                        <div class="flex justify-between items-start"
                            style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <h1 class="font-bold text-gray-900 mb-2" style="font-size: 1.875rem; line-height: 1.25;">
                                    {{ $kost->nama_kost }}
                                </h1>
                                <div class="flex items-center gap-2 text-gray-600"
                                    style="display: flex; align-items: center; gap: 0.5rem; color: #4b5563;">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $kost->alamat }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    style="padding: 0.375rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 700; border: 1px solid; 
                                                                                            {{ $kost->tipe == 'putra' ? 'background-color: black; color: white; border-color: black;' : ($kost->tipe == 'putri' ? 'background-color: #fdf2f8; color: #be185d; border-color: #fbcfe8;' : 'background-color: #f3f4f6; color: #1f2937; border-color: #e5e7eb;') }}">
                                    {{ ucfirst($kost->tipe) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Host Info -->
                    <div class="flex items-center justify-between py-6 border-b mb-8"
                        style="display: flex; align-items: center; justify-content: space-between; padding-top: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; margin-bottom: 2rem;">
                        <div class="flex items-center gap-4" style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="width: 3.5rem; height: 3.5rem; background: linear-gradient(to bottom right, #374151, #000000); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.25rem; box-shadow: var(--shadow-lg);">
                                {{ substr($kost->owner->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-900" style="font-size: 1.125rem;">Disewakan oleh
                                    {{ $kost->owner->name }}
                                </h3>
                                <p class="text-gray-500 text-sm">Bergabung {{ $kost->owner->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-10" style="margin-bottom: 2.5rem;">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4" style="font-size: 1.5rem; margin-bottom: 1rem;">
                            Tentang tempat ini</h2>
                        <div class="text-gray-600 leading-relaxed" style="line-height: 1.625;">
                            {!! nl2br(e($kost->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="mb-10" style="margin-bottom: 2.5rem;">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6" style="font-size: 1.5rem; margin-bottom: 1.5rem;">
                            Fasilitas yang tersedia</h2>
                        <div class="facilities-grid" style="display: grid; gap: 1rem 2rem;">
                            <style>
                                .facilities-grid {
                                    grid-template-columns: repeat(2, 1fr);
                                }

                                @media(min-width: 768px) {
                                    .facilities-grid {
                                        grid-template-columns: repeat(3, 1fr);
                                    }
                                }
                            </style>
                            @foreach($kost->facilities as $fasilitas)
                                <div class="flex items-center gap-3 text-gray-700 p-3 rounded-lg hover:bg-gray-50 transition"
                                    style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem;">
                                    <div
                                        style="width: 2rem; height: 2rem; border-radius: 50%; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #4b5563;">
                                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $fasilitas->nama_fasilitas }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>



                </div>
                <!-- Sticky Sidebar -->
                <div class="content-sidebar">
                    <div class="sticky-sidebar"
                        style="position: sticky; top: 7rem; display: flex; flex-direction: column; gap: 1.5rem;">
                        <div class="bg-white rounded-2xl p-6"
                            style="background-color: white; border-radius: 1rem; box-shadow: 0 8px 30px rgb(0 0 0 / 0.12); border: 1px solid #f3f4f6; padding: 1.5rem; flex-shrink: 0;">
                            <div class="mb-6" style="margin-bottom: 1.5rem;">
                                <!-- Top Row: Original Price & Badge -->
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                    <span style="text-decoration: line-through; color: #6b7280; font-size: 14px;">
                                        Rp {{ number_format($kost->harga_per_bulan * 1.1, 0, ',', '.') }}
                                    </span>
                                    <span
                                        style="background-color: #dcfce7; color: #166534; font-size: 12px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">
                                        Hemat 10%
                                    </span>
                                </div>
                                <!-- Bottom Row: Current Price & Duration -->
                                <div style="display: flex; align-items: baseline; gap: 4px;">
                                    <span style="font-size: 24px; font-weight: 800; color: #111827;">
                                        Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}
                                    </span>
                                    <span style="color: #6b7280; font-size: 14px; font-weight: 500;">
                                        / bulan
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-4 mb-6" style="display: flex; flex-direction: column; gap: 1rem;">
                                @php
                                    $phone = $kost->owner->phone;
                                    if (substr($phone, 0, 1) == '0') {
                                        $phone = '62' . substr($phone, 1);
                                    }
                                    $waUrl = "https://wa.me/{$phone}?text=Halo, saya tertarik dengan kost {$kost->nama_kost} di E-Kost.";
                                @endphp

                                <a href="{{ $waUrl }}" target="_blank" class="btn-primary w-full"
                                    style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-align: center; font-weight: 700;">
                                    Hubungi Pemilik
                                </a>

                                @auth
                                    @php
                                        /** @var \App\Models\User $user */
                                        $user = Auth::user();
                                    @endphp
                                    <form action="{{ route('kost.favorite', $kost->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full border py-3.5 rounded-xl font-bold transition-all flex items-center justify-center gap-2"
                                            style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid {{ $user->favorites->contains($kost->id) ? '#fecaca' : '#e5e7eb' }}; background-color: {{ $user->favorites->contains($kost->id) ? '#fef2f2' : 'white' }}; color: {{ $user->favorites->contains($kost->id) ? '#dc2626' : '#374151' }}; cursor: pointer;">
                                            @if($user->favorites->contains($kost->id))
                                                <svg style="width: 1.25rem; height: 1.25rem; fill: currentColor;"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                </svg>
                                                <span>Tersimpan</span>
                                            @else
                                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                    </path>
                                                </svg>
                                                <span>Simpan Favorit</span>
                                            @endif
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        style="width: 100%; border: 1px solid #e5e7eb; padding: 0.875rem; border-radius: 0.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 0.5rem; background-color: white; color: #374151;">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                        <span>Simpan Favorit</span>
                                    </a>
                                @endauth
                            </div>

                            <div class="text-center">
                                <p class="text-xs text-gray-400">Tidak dikenakan biaya tambahan</p>
                            </div>
                        </div>

                        <!-- Diskusi / Komentar with Global Social Media UI -->
                        <div style="padding-top: 1rem;">
                            <!-- Embedded Styles for this section only -->
                            <style>
                                .discussion-section {
                                    font-family: 'Inter', sans-serif;
                                    color: #0f1419;
                                    margin-bottom: 3rem;
                                }

                                .discussion-header {
                                    font-size: 1.25rem;
                                    font-weight: 800;
                                    margin-bottom: 1.5rem;
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                }

                                .discussion-count {
                                    font-size: 1rem;
                                    font-weight: normal;
                                    color: #536471;
                                }

                                /* Input Area */
                                .comment-input-wrapper {
                                    display: flex;
                                    gap: 1rem;
                                    margin-bottom: 2rem;
                                    align-items: flex-start;
                                }

                                .user-avatar {
                                    width: 40px;
                                    height: 40px;
                                    border-radius: 50%;
                                    background: linear-gradient(135deg, #1f2937, #000000);
                                    color: white;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-weight: 600;
                                    font-size: 1rem;
                                    flex-shrink: 0;
                                }

                                .input-box-container {
                                    flex: 1;
                                    position: relative;
                                }

                                .modern-input {
                                    width: 100%;
                                    border: none;
                                    border-bottom: 2px solid #eff3f4;
                                    padding: 0.75rem 0;
                                    font-size: 1rem;
                                    outline: none;
                                    transition: border-color 0.2s;
                                    background: transparent;
                                    resize: none;
                                    min-height: 48px;
                                    color: #0f1419;
                                }

                                .modern-input:focus {
                                    border-bottom-color: #000;
                                }

                                .input-actions {
                                    display: flex;
                                    justify-content: flex-end;
                                    margin-top: 0.5rem;
                                }

                                .post-btn {
                                    background-color: #000;
                                    color: white;
                                    border: none;
                                    border-radius: 9999px;
                                    padding: 0.5rem 1.25rem;
                                    font-weight: 700;
                                    font-size: 0.9rem;
                                    cursor: pointer;
                                    transition: background 0.2s;
                                }

                                .post-btn:hover {
                                    background-color: #272c30;
                                }

                                .post-btn:disabled {
                                    background-color: #eff3f4;
                                    color: #b9cad3;
                                    cursor: default;
                                }

                                /* Comment List & Scroll */
                                .comment-scroll-container {
                                    max-height: 350px;
                                    /* Approximate height for 2 comments */
                                    overflow-y: auto;
                                    padding-right: 6px;
                                    scrollbar-width: thin;
                                    scrollbar-color: #cfd9de transparent;
                                    border: 1px solid #e5e7eb;
                                    border-radius: 12px;
                                    padding: 16px;
                                    background: #fff;
                                }

                                .comment-scroll-container::-webkit-scrollbar {
                                    width: 6px;
                                }

                                .comment-scroll-container::-webkit-scrollbar-track {
                                    background: transparent;
                                }

                                .comment-scroll-container::-webkit-scrollbar-thumb {
                                    background-color: #d1d5db;
                                    border-radius: 20px;
                                }

                                .comment-thread {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 1.5rem;
                                }

                                .comment-item {
                                    display: flex;
                                    gap: 1rem;
                                    position: relative;
                                }

                                .comment-content-col {
                                    flex: 1;
                                    min-width: 0;
                                }

                                .comment-header {
                                    display: flex;
                                    align-items: baseline;
                                    gap: 0.5rem;
                                    margin-bottom: 0.25rem;
                                }

                                .comment-author {
                                    font-weight: 700;
                                    font-size: 0.9rem;
                                    color: #0f1419;
                                }

                                .comment-meta {
                                    font-size: 0.85rem;
                                    color: #536471;
                                }

                                .comment-body {
                                    font-size: 0.9rem;
                                    line-height: 1.5;
                                    color: #0f1419;
                                    white-space: pre-wrap;
                                    margin-bottom: 0.5rem;
                                }

                                .comment-actions {
                                    display: flex;
                                    gap: 1.5rem;
                                    align-items: center;
                                }

                                .action-link {
                                    background: none;
                                    border: none;
                                    padding: 0;
                                    color: #536471;
                                    font-size: 0.8rem;
                                    font-weight: 600;
                                    cursor: pointer;
                                    transition: color 0.2s;
                                }

                                .action-link:hover {
                                    color: #000;
                                    text-decoration: underline;
                                }

                                .action-link.delete {
                                    color: #f4212e;
                                }

                                .action-link.delete:hover {
                                    background-color: rgba(244, 33, 46, 0.1);
                                    text-decoration: none;
                                    border-radius: 9999px;
                                    /* If we want button-like hover, else keep simple */
                                }

                                /* Reply Section */
                                .reply-thread {
                                    margin-top: 1rem;
                                    position: relative;
                                }

                                /* Vertical line for replies */
                                .reply-connector {
                                    position: absolute;
                                    top: 0;
                                    bottom: 0;
                                    left: -24px;
                                    /* Adjust based on avatar size */
                                    width: 2px;
                                    background-color: #cfd9de;
                                    border-radius: 99px;
                                }

                                .reply-item {
                                    margin-bottom: 1rem;
                                }

                                /* Empty State */
                                .empty-state {
                                    text-align: center;
                                    padding: 2rem 1rem;
                                    border-radius: 1rem;
                                    color: #536471;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                    gap: 0.5rem;
                                }
                            </style>

                            <div class="discussion-section">
                                <h2 class="discussion-header">
                                    Diskusi <span class="discussion-count">({{ $kost->comments->count() }})</span>
                                </h2>

                                <!-- Input Section -->
                                <div class="comment-input-wrapper">
                                    @auth
                                        <div class="user-avatar">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                        <div class="input-box-container">
                                            <form action="{{ route('kost.comment.store', $kost->id) }}" method="POST">
                                                @csrf
                                                <textarea name="content" class="modern-input"
                                                    placeholder="Tanya sesuatu tentang kost ini..." rows="1" required
                                                    oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                                                <div class="input-actions">
                                                    <button type="submit" class="post-btn">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="w-full bg-gray-50 rounded-xl p-6 text-center border border-dashed border-gray-300">
                                            <p class="text-gray-600 mb-3">Login untuk mulai berdiskusi dengan pemilik kost</p>
                                            <a href="{{ route('login') }}"
                                                class="inline-block bg-black text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-800 transition">
                                                Masuk Akun
                                            </a>
                                        </div>
                                    @endauth
                                </div>

                                <!-- Comment List (Scrollable Box) -->
                                <div class="comment-scroll-container">
                                    <div class="comment-thread">
                                        @forelse($kost->comments->whereNull('parent_id') as $comment)
                                            <div class="comment-item">
                                                <div class="user-avatar" style="background: #eef2ff; color: #111827;">
                                                    {{ substr($comment->user->name, 0, 1) }}
                                                </div>
                                                <div class="comment-content-col">
                                                    <div class="comment-header">
                                                        <span class="comment-author">{{ $comment->user->name }}</span>
                                                        <span class="comment-meta">·
                                                            {{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="comment-body">{{ $comment->content }}</div>

                                                    <div class="comment-actions">
                                                        @auth
                                                            <button class="action-link"
                                                                onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')">
                                                                Balas
                                                            </button>
                                                            @if(auth()->id() == $comment->user_id || auth()->user()->role == 'admin')
                                                                <form id="delete-form-{{ $comment->id }}"
                                                                    action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                                                    class="inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        onclick="confirmDelete(event, 'delete-form-{{ $comment->id }}')"
                                                                        class="action-link delete">Hapus</button>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                    </div>

                                                    <!-- Reply Input -->
                                                    @auth
                                                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
                                                            <form action="{{ route('kost.comment.store', $kost->id) }}"
                                                                method="POST" class="flex gap-3 items-start">
                                                                @csrf
                                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                <div class="user-avatar"
                                                                    style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                                    {{ substr(auth()->user()->name, 0, 1) }}
                                                                </div>
                                                                <div class="flex-1">
                                                                    <textarea name="content" class="modern-input"
                                                                        style="font-size: 0.9rem; padding: 0.5rem 0; min-height: 2.5rem;"
                                                                        placeholder="Balas komentar ini..." rows="1"
                                                                        required></textarea>
                                                                    <div class="flex justify-end mt-2">
                                                                        <button type="submit" class="post-btn"
                                                                            style="padding: 0.4rem 1rem; font-size: 0.8rem;">Kirim
                                                                            Balasan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endauth

                                                    <!-- Nested Replies -->
                                                    @if($comment->replies->count() > 0)
                                                        <div class="reply-thread">
                                                            <!-- Defines the connector line relative to parent avatar -->
                                                            <!-- Simplified threading lookup -->
                                                            @foreach($comment->replies as $reply)
                                                                <div class="comment-item reply-item">
                                                                    <div class="user-avatar"
                                                                        style="width: 32px; height: 32px; font-size: 0.8rem; background: #f3f4f6; color: #374151;">
                                                                        {{ substr($reply->user->name, 0, 1) }}
                                                                    </div>
                                                                    <div class="comment-content-col">
                                                                        <div class="comment-header">
                                                                            <span class="comment-author">{{ $reply->user->name }}</span>
                                                                            <span class="comment-meta">·
                                                                                {{ $reply->created_at->diffForHumans() }}</span>
                                                                        </div>
                                                                        <div class="comment-body">{{ $reply->content }}</div>
                                                                        <div class="comment-actions">
                                                                            @auth
                                                                                @if(auth()->id() == $reply->user_id || auth()->user()->role == 'admin')
                                                                                    <form id="delete-form-{{ $reply->id }}"
                                                                                        action="{{ route('comments.destroy', $reply->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="button"
                                                                                            onclick="confirmDelete(event, 'delete-form-{{ $reply->id }}')"
                                                                                            class="action-link delete">Hapus</button>
                                                                                    </form>
                                                                                @endif
                                                                            @endauth
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div class="empty-state">
                                                <div
                                                    class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center mb-2 text-xl">
                                                    💬
                                                </div>
                                                <p class="font-medium text-gray-900 text-sm">Belum ada diskusi</p>
                                                <p class="text-xs">Jadilah yang pertama diskusi!</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Custom Confirmation Modal -->
        <div id="confirmationModal" class="custom-modal-overlay hidden">
            <div class="custom-modal-content" id="modalContent">
                <div style="text-align: center;">
                    <div
                        style="margin: 0 auto; width: 48px; height: 48px; border-radius: 50%; background-color: #fee2e2; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                        <svg style="width: 24px; height: 24px; color: #dc2626;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 8px;">Hapus Komentar?</h3>
                    <p style="font-size: 14px; color: #6b7280; margin-bottom: 24px; line-height: 1.5;">Tindakan ini tidak
                        dapat dibatalkan. Apakah Anda yakin ingin melanjutkan?</p>
                    <div style="display: flex; gap: 12px; justify-content: center;">
                        <button onclick="closeModal()"
                            style="padding: 10px 20px; background-color: #f3f4f6; color: #1f2937; border: none; border-radius: 12px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background 0.2s;">
                            Batal
                        </button>
                        <button id="confirmBtn"
                            style="padding: 10px 20px; background-color: #000; color: white; border: none; border-radius: 12px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .custom-modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s;
            }

            .custom-modal-overlay.active {
                opacity: 1;
                visibility: visible;
            }

            .custom-modal-content {
                background: white;
                border-radius: 16px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                max-width: 360px;
                width: 90%;
                padding: 24px;
                transform: scale(0.95);
                transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .custom-modal-overlay.active .custom-modal-content {
                transform: scale(1);
            }

            .hidden {
                display: none;
            }
        </style>

        <script>
            let formToDelete = null;
            const modal = document.getElementById('confirmationModal');

            function confirmDelete(event, formId) {
                event.preventDefault();
                formToDelete = document.getElementById(formId);

                modal.classList.remove('hidden');
                // Force reflow
                void modal.offsetWidth;
                modal.classList.add('active');
            }

            function closeModal() {
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    formToDelete = null;
                }, 300);
            }

            document.getElementById('confirmBtn').addEventListener('click', function () {
                if (formToDelete) {
                    formToDelete.submit();
                }
            });

            // Close on click outside
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            function toggleReplies(commentId, btn) {
                const hiddenReplies = document.querySelectorAll('.reply-hidden-' + commentId);
                hiddenReplies.forEach(el => {
                    el.classList.remove('hidden');
                });
                btn.style.display = 'none';
            }
        </script>
@endsection