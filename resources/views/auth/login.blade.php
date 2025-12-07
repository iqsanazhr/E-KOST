@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 px-6">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Masuk ke E-Kost</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent outline-none transition-all"
                        placeholder="nama@email.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent outline-none transition-all"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-black text-white font-medium py-2.5 rounded-lg hover:bg-gray-800 transition-all shadow-lg shadow-gray-500/20">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Belum punya akun? <a href="{{ route('register') }}" class="text-black font-medium hover:underline">Daftar
                    sekarang</a>
            </div>
        </div>
    </div>
@endsection