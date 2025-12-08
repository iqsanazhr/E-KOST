@extends('layouts.app')

@section('content')
    <div class="max-w-md mt-10 px-6">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200"
            style="border: 1px solid #e5e7eb; border-radius: 1rem;">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center" style="font-size: 1.5rem;">Daftar Akun Baru</h2>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required class="form-input" placeholder="John Doe"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" required class="form-input" placeholder="nama@email.com"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="form-label">Nomor HP / WhatsApp</label>
                    <input type="text" name="phone" id="phone" class="form-input" placeholder="08123456789"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Daftar Sebagai</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="role" value="mahasiswa" style="accent-color: black;" {{ old('role', 'mahasiswa') == 'mahasiswa' ? 'checked' : '' }}>
                            <span class="text-sm text-gray-600">Pencari Kost</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="role" value="pemilik" style="accent-color: black;" {{ old('role') == 'pemilik' ? 'checked' : '' }}>
                            <span class="text-sm text-gray-600">Pemilik Kost</span>
                        </label>
                    </div>
                    @error('role')
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

                <div>
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="form-input" placeholder="••••••••">
                </div>

                <button type="submit" class="btn-primary w-full shadow-lg" style="width: 100%; margin-top: 1rem;">
                    Daftar
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-medium hover:text-black"
                    style="color: black; text-decoration: underline;">Masuk</a>
            </div>
        </div>
    </div>
@endsection