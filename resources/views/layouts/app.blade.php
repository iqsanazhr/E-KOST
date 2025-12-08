<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kost - Cari Kost Idamanmu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar fixed">
        <div class="nav-container">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="nav-brand">
                    <div class="brand-logo">
                        E
                    </div>
                    <span class="font-bold text-lg text-gray-900">E-Kost</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md-flex items-center gap-1">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Jelajahi
                    </a>
                    <a href="{{ route('features') }}"
                        class="nav-link {{ request()->routeIs('features') ? 'active' : '' }}">
                        Fitur
                    </a>

                    @if(!auth()->check() || !auth()->user()->isAdmin())
                        <a href="{{ route('help') }}" class="nav-link {{ request()->routeIs('help') ? 'active' : '' }}">
                            Bantuan
                        </a>
                    @endif

                    @auth
                        <a href="{{ route('favorites.index') }}"
                            class="nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                            Favorit
                        </a>
                    @endauth
                </div>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    @php
                        /** @var \App\Models\User $user */
                        $user = Auth::user();
                    @endphp

                    <div class="flex items-center gap-2" style="margin-right: 0.5rem;">
                        @if($user->isPemilik())
                            <a href="{{ route('owner.kosts.index') }}"
                                class="nav-link {{ request()->routeIs('owner.kosts.*') ? 'active' : '' }}">
                                Dashboard
                            </a>
                        @elseif($user->isAdmin())
                            <a href="{{ route('admin.verification.index') }}"
                                class="nav-link {{ request()->routeIs('admin.verification.index') ? 'active' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.feedbacks.index') }}"
                                class="nav-link {{ request()->routeIs('admin.feedbacks.index') ? 'active' : '' }}">
                                Masukan
                            </a>
                        @endif
                    </div>

                    <div style="height: 1.5rem; width: 1px; background-color: #e5e7eb; margin: 0 0.5rem;"></div>

                    <div class="flex items-center gap-3">
                        <div style="width: 2.25rem; height: 2.25rem; border-radius: 9999px; background: linear-gradient(to bottom right, #f3f4f6, #e5e7eb); border: 1px solid #d1d5db; display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: bold; color: #374151;"
                            title="{{ $user->name }}">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit"
                                style="font-size: 0.875rem; font-weight: 500; color: #6b7280; background: none; border: none; cursor: pointer; transition: color 0.2s;"
                                onmouseover="this.style.color='#ef4444'"
                                onmouseout="this.style.color='#6b7280'">Keluar</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="pt-24" style="min-height: 100vh;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-grid">
                <!-- Brand -->
                <div>
                    <div class="nav-brand mb-4">
                        <div class="brand-logo" style="background: black;">
                            E
                        </div>
                        <span class="font-bold text-lg text-gray-900">E-Kost</span>
                    </div>
                    <p class="text-gray-500 text-sm" style="line-height: 1.625;">
                        Platform pencarian kost modern yang memudahkan Anda menemukan tempat tinggal impian dengan aman
                        dan nyaman.
                    </p>
                </div>

                <!-- Links 1 -->
                <div>
                    <h4 class="footer-heading">Perusahaan</h4>
                    <ul class="footer-links" style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <li><a href="{{ route('home') }}">Jelajahi</a></li>
                        <li><a href="{{ route('features') }}">Fitur</a></li>
                        <li><a href="{{ route('help') }}">Bantuan</a></li>
                        <li><a href="{{ route('favorites.index') }}">Favorit</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h4 class="footer-heading">Dukungan</h4>
                    <ul class="footer-links" style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <li><a href="{{ route('help') }}">Pusat Bantuan</a></li>
                        <li><a href="{{ route('terms') }}">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('privacy') }}">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('safety') }}">Panduan Keamanan</a></li>
                    </ul>
                </div>

                <!-- Social -->
                <div>
                    <h4 class="footer-heading">Ikuti Kami</h4>
                    <div class="flex gap-4">
                        <a href="#" class="social-link">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} E-Kost System. All rights reserved.
                </div>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="{{ route('privacy') }}" class="hover:text-black">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-black">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>