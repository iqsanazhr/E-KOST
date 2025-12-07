@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Kost</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('owner.kosts.update', $kost->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kost</label>
                    <input type="text" name="nama_kost" value="{{ old('nama_kost', $kost->nama_kost) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2"
                        required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Kost</label>
                        <select name="tipe"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2"
                            required>
                            <option value="putra" {{ old('tipe', $kost->tipe) == 'putra' ? 'selected' : '' }}>Putra</option>
                            <option value="putri" {{ old('tipe', $kost->tipe) == 'putri' ? 'selected' : '' }}>Putri</option>
                            <option value="campur" {{ old('tipe', $kost->tipe) == 'campur' ? 'selected' : '' }}>Campur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Bulan (Rp)</label>
                        <input type="number" name="harga_per_bulan" value="{{ old('harga_per_bulan', $kost->harga_per_bulan) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2"
                            required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2"
                        required>{{ old('alamat', $kost->alamat) }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi & Peraturan</label>
                    <textarea name="deskripsi" rows="5"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2"
                        required>{{ old('deskripsi', $kost->deskripsi) }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($facilities as $facility)
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                    {{ $kost->facilities->contains($facility->id) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ $facility->nama_fasilitas }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kost</label>
                    
                    <!-- Existing Images -->
                    @if($kost->images->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            @foreach($kost->images as $image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $image->path_foto) }}" class="w-full h-32 object-cover rounded-lg">
                                    <button type="button" onclick="deleteImage({{ $image->id }})" 
                                        class="absolute top-2 right-2 bg-red-600 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Upload New Images -->
                    <div class="mt-2">
                        <label class="block text-xs text-gray-500 mb-1">Tambah Foto Baru (Maksimal 5)</label>
                        <input type="file" name="images[]" multiple accept="image/*"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
                        <p class="text-xs text-gray-500 mt-1">Ctrl + Click untuk memilih banyak foto.</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('owner.kosts.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                        Update Kost
                    </button>
                </div>

            </form>

            <!-- Hidden Delete Form (Moved Outside) -->
            <form id="delete-image-form" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            <script>
                function deleteImage(imageId) {
                    if(confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                        const form = document.getElementById('delete-image-form');
                        form.action = `/owner/kost-images/${imageId}`;
                        form.submit();
                    }
                }
            </script>
        </div>
    </div>
@endsection
