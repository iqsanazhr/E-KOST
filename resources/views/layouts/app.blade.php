<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kost - Cari Kost Idamanmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F7F7F8] text-[#1A1A1A] antialiased selection:bg-gray-200 selection:text-black">

    <!-- Navbar (Linear Style: Minimal, Sticky, Blur) -->
    <nav
        class="fixed top-0 w-full z-50 bg-[#F7F7F8]/80 backdrop-blur-md border-b border-gray-200/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-gray-800 to-black rounded-lg flex items-center justify-center text-white font-bold shadow-lg group-hover:shadow-gray-500/20 transition-all">
                        E
                    </div>
                    <span class="font-bold text-lg tracking-tight text-gray-900">E-Kost</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 {{ request()->routeIs('home') ? 'bg-black text-white shadow-md' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
                        Jelajahi
                    </a>
                    <a href="{{ route('features') }}"
                        class="text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 {{ request()->routeIs('features') ? 'bg-black text-white shadow-md' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
                        Fitur
                    </a>

                    @if(!auth()->check() || !auth()->user()->isAdmin())
                        <a href="{{ route('help') }}"
                            class="text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 {{ request()->routeIs('help') ? 'bg-black text-white shadow-md' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
                            Bantuan
                        </a>
                    @endif

                    @auth
                        <a href="{{ route('favorites.index') }}"
                            class="text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 {{ request()->routeIs('favorites.index') ? 'bg-black text-white shadow-md' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
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

                    <div class="flex items-center gap-2 mr-2">
                        @if($user->isPemilik())
                            <a href="{{ route('owner.kosts.index') }}"
                                class="text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 {{ request()->routeIs('owner.kosts.*') ? 'bg-black text-white shadow-md' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
                                Dashboard
                            </a>
                        @elseif($user->isAdmin())
                            <a href="{{ route('admin.verification.index') }}"
                                class="text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 {{ request()->routeIs('admin.verification.index') ? 'bg-black text-white shadow-md' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.feedbacks.index') }}"
                                class="text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 {{ request()->routeIs('admin.feedbacks.index') ? 'bg-black text-white shadow-md' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
                                Masukan
                            </a>
                        @endif
                    </div>

                    <div class="h-6 w-px bg-gray-200 mx-2"></div>

                    <div class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 border border-gray-300 flex items-center justify-center text-sm font-bold text-gray-700 shadow-sm"
                            title="{{ $user->name }}">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors">Keluar</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-600 hover:text-black px-4 py-2 rounded-full hover:bg-gray-100 transition-all">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-sm font-medium bg-black text-white px-5 py-2.5 rounded-full hover:bg-gray-800 transition-all shadow-lg shadow-gray-500/20 hover:shadow-gray-500/40 transform hover:-translate-y-0.5">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="pt-24 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 mt-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center text-white font-bold">
                            E
                        </div>
                        <span class="font-bold text-lg tracking-tight text-gray-900">E-Kost</span>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Platform pencarian kost modern yang memudahkan Anda menemukan tempat tinggal impian dengan aman
                        dan nyaman.
                    </p>
                </div>

                <!-- Links 1 -->
                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Perusahaan</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="{{ route('home') }}" class="hover:text-black transition-colors">Jelajahi</a></li>
                        <li><a href="{{ route('features') }}" class="hover:text-black transition-colors">Fitur</a></li>
                        <li><a href="{{ route('help') }}" class="hover:text-black transition-colors">Bantuan</a></li>
                        <li><a href="{{ route('favorites.index') }}"
                                class="hover:text-black transition-colors">Favorit</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Dukungan</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="{{ route('help') }}" class="hover:text-black transition-colors">Pusat Bantuan</a>
                        </li>
                        <li><a href="{{ route('terms') }}" class="hover:text-black transition-colors">Syarat &
                                Ketentuan</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-black transition-colors">Kebijakan
                                Privasi</a></li>
                        <li><a href="{{ route('safety') }}" class="hover:text-black transition-colors">Panduan
                                Keamanan</a></li>
                    </ul>
                </div>

                <!-- Social -->
                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Ikuti Kami</h4>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-black hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-black hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} E-Kost System. All rights reserved.
                </div>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="{{ route('privacy') }}" class="hover:text-black transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-black transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>