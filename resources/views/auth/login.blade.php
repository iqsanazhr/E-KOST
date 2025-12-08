@extends('layouts.app')

@section('content')
    <div class="max-w-md mt-10 px-6">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200"
            style="border: 1px solid #e5e7eb; border-radius: 1rem;">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center" style="font-size: 1.5rem;">Masuk ke E-Kost</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" required class="form-input" placeholder="nama@email.com"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" required class="form-input" placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full shadow-lg" style="width: 100%; margin-top: 1rem;">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Belum punya akun? <a href="{{ route('register') }}" class="font-medium hover:text-black"
                    style="color: black; text-decoration: underline;">Daftar sekarang</a>
            </div>
        </div>
    </div>
@endsection