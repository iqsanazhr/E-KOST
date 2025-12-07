@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen pb-20">
        <!-- Image Gallery (Airbnb Style) -->
        <div class="max-w-7xl mx-auto px-4 pt-6 pb-8">
            <div
                class="grid grid-cols-1 md:grid-cols-4 gap-2 h-[400px] md:h-[500px] rounded-2xl overflow-hidden relative group">
                <!-- Main Image -->
                <div class="md:col-span-2 h-full relative">
                    @if($kost->images->first())
                        <img src="{{ asset('storage/' . $kost->images->first()->path_foto) }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700 cursor-pointer">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Secondary Images Grid -->
                <div class="hidden md:grid md:col-span-2 grid-cols-2 grid-rows-2 gap-2 h-full">
                    @foreach($kost->images->skip(1)->take(4) as $index => $img)
                        <div class="relative overflow-hidden h-full">
                            <img src="{{ asset('storage/' . $img->path_foto) }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-700 cursor-pointer">
                        </div>
                    @endforeach

                    <!-- Placeholder if less than 5 images -->
                    @for($i = $kost->images->count(); $i < 5; $i++)
                        @if($i > 0) <!-- Skip the first one as it's main -->
                            <div class="bg-gray-100 w-full h-full"></div>
                        @endif
                    @endfor
                </div>

                <button
                    class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg text-sm font-medium shadow-lg hover:bg-white transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Lihat Semua Foto
                </button>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4">
            @if(session('success'))
                <div
                    class="bg-black text-white text-sm p-4 rounded-xl mb-6 shadow-lg border border-gray-800 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif
            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Left Content -->
                <div class="flex-1">
                    <!-- Header -->
                    <div class="border-b pb-6 mb-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $kost->nama_kost }}</h1>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    class="px-4 py-1.5 rounded-full text-sm font-bold tracking-wide border
                                        {{ $kost->tipe == 'putra' ? 'bg-black text-white border-black' : ($kost->tipe == 'putri' ? 'bg-pink-50 text-pink-700 border-pink-200' : 'bg-gray-100 text-gray-800 border-gray-200') }}">
                                    {{ ucfirst($kost->tipe) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Host Info -->
                    <div class="flex items-center justify-between py-6 border-b mb-8">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-gray-700 to-black rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                {{ substr($kost->owner->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-900">Disewakan oleh {{ $kost->owner->name }}</h3>
                                <p class="text-gray-500 text-sm">Bergabung {{ $kost->owner->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Tentang tempat ini</h2>
                        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                            {!! nl2br(e($kost->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Fasilitas yang tersedia</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-8">
                            @foreach($kost->facilities as $fasilitas)
                                <div class="flex items-center gap-3 text-gray-700 p-3 rounded-lg hover:bg-gray-50 transition">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="w-full lg:w-[380px]">
                    <div class="sticky top-28">
                        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-gray-100 p-6">
                            <div class="flex justify-between items-end mb-6">
                                <div>
                                    <span class="text-gray-500 text-sm line-through">Rp
                                        {{ number_format($kost->harga_per_bulan * 1.1, 0, ',', '.') }}</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-2xl font-bold text-gray-900">Rp
                                            {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}</span>
                                        <span class="text-gray-500 font-medium">/ bulan</span>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center gap-1 bg-green-50 px-2 py-1 rounded text-green-700 text-xs font-bold">
                                    <span>Hemat 10%</span>
                                </div>
                            </div>

                            <div class="space-y-4 mb-6">
                                @php
                                    $phone = $kost->owner->phone;
                                    if (substr($phone, 0, 1) == '0') {
                                        $phone = '62' . substr($phone, 1);
                                    }
                                    $waUrl = "https://wa.me/{$phone}?text=Halo, saya tertarik dengan kost {$kost->nama_kost} di E-Kost.";
                                @endphp

                                <a href="{{ $waUrl }}" target="_blank"
                                    class="block w-full bg-black text-white text-center py-3.5 rounded-xl font-bold hover:bg-gray-800 transition-all shadow-lg shadow-gray-500/20 flex items-center justify-center gap-2 group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    Hubungi Pemilik
                                </a>

                                @auth
                                                        @php
                                                            /** @var \App\Models\User $user */
                                                            $user = Auth::user();
                                                        @endphp
                                                        <form action="{{ route('kost.favorite', $kost->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="w-full border border-gray-200 py-3.5 rounded-xl font-bold transition-all flex items-center justify-center gap-2
                                                                        {{ $user->favorites->contains($kost->id)
                                    ? 'bg-red-50 border-red-200 text-red-600'
                                    : 'bg-white text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                                                                @if($user->favorites->contains($kost->id))
                                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                                    </svg>
                                                                    <span>Tersimpan</span>
                                                                @else
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        class="w-full border border-gray-200 py-3.5 rounded-xl font-bold transition-all flex items-center justify-center gap-2 bg-white text-gray-700 hover:bg-gray-50 hover:border-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                        <!-- Comments Section -->
                        <div
                            class="mt-6 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-gray-100 p-6">
                            <h3 class="font-bold text-lg text-gray-900 mb-4">Diskusi</h3>

                            <!-- Comment Form -->
                            @auth
                                <form action="{{ route('kost.comment.store', $kost->id) }}" method="POST" class="mb-4">
                                    @csrf
                                    <div class="relative">
                                        <textarea name="content" rows="2"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-black focus:border-transparent transition-all resize-none"
                                            placeholder="Tanya sesuatu..."></textarea>
                                        <button type="submit"
                                            class="absolute bottom-2 right-2 bg-black text-white px-3 py-1 rounded-lg text-[10px] font-bold hover:bg-gray-800 transition">
                                            Kirim
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="bg-gray-50 rounded-xl p-3 text-center mb-4 border border-gray-100">
                                    <p class="text-xs text-gray-500 mb-1">Ingin bertanya?</p>
                                    <a href="{{ route('login') }}"
                                        class="text-black font-bold text-xs hover:underline">Masuk</a>
                                </div>
                            @endauth

                            <!-- Comments List -->
                            <div class="space-y-4 max-h-[500px] overflow-y-auto pr-1 custom-scrollbar">
                                @forelse($kost->comments()->whereNull('parent_id')->latest()->get() as $comment)
                                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                        <!-- Parent Comment -->
                                        <div class="flex items-start gap-3">
                                            <div
                                                class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold text-gray-600 shrink-0">
                                                {{ substr($comment->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                                    <span
                                                        class="font-bold text-sm text-gray-900 truncate">{{ $comment->user->name }}</span>

                                                    @if($comment->user_id == $kost->owner_id)
                                                        <span
                                                            class="bg-black text-white text-[10px] px-2 py-0.5 rounded-full font-bold tracking-wide">OWNER</span>
                                                    @endif

                                                    @if($comment->user->role == 'admin')
                                                        <span
                                                            class="bg-blue-600 text-white text-[10px] px-2 py-0.5 rounded-full font-bold tracking-wide">ADMIN</span>
                                                    @endif
                                                    
                                                    <span class="text-xs text-gray-400">• {{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-sm text-gray-600 leading-relaxed break-words">
                                                    {{ $comment->content }}</p>
                                                
                                                <!-- Actions -->
                                                <div class="flex items-center gap-4 mt-2">
                                                    @auth
                                                        <button onclick="toggleReplyForm({{ $comment->id }})" class="text-xs font-bold text-gray-500 hover:text-black transition-colors">
                                                            Balas
                                                        </button>
                                                    @endauth

                                                    @if(auth()->id() == $comment->user_id || auth()->user()?->isAdmin())
                                                        <button
                                                            onclick="confirmDeleteComment('{{ route('comments.destroy', $comment->id) }}')"
                                                            class="text-xs font-bold text-gray-400 hover:text-red-600 transition-colors">
                                                            Hapus
                                                        </button>
                                                    @endif
                                                </div>

                                                <!-- Reply Form -->
                                                @auth
                                                    <form id="reply-form-{{ $comment->id }}" action="{{ route('kost.comment.store', $kost->id) }}" method="POST" class="hidden mt-3">
                                                        @csrf
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <div class="flex gap-2">
                                                            <input type="text" name="content" class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-black transition-colors" placeholder="Tulis balasan...">
                                                            <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-800 transition-colors">Kirim</button>
                                                        </div>
                                                    </form>
                                                @endauth
                                            </div>
                                        </div>

                                        <!-- Replies -->
                                        @if($comment->replies->count() > 0)
                                            <div class="ml-11 mt-3 space-y-3 border-l-2 border-gray-100 pl-4">
                                                <!-- Visible Replies (First 2) -->
                                                @foreach($comment->replies->take(2) as $reply)
                                                    <div class="flex items-start gap-3">
                                                        <div
                                                            class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-[10px] font-bold text-gray-500 shrink-0">
                                                            {{ substr($reply->user->name, 0, 1) }}
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <div class="flex items-center gap-2 mb-0.5">
                                                                <span class="font-bold text-xs text-gray-900">{{ $reply->user->name }}</span>
                                                                @if($reply->user_id == $kost->owner_id)
                                                                    <span class="bg-gray-200 text-gray-800 text-[8px] px-1.5 py-0.5 rounded-full font-bold">OWNER</span>
                                                                @endif
                                                                <span class="text-[10px] text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="text-xs text-gray-600">{{ $reply->content }}</p>
                                                            
                                                            @if(auth()->id() == $reply->user_id || auth()->user()?->isAdmin())
                                                                <button
                                                                    onclick="confirmDeleteComment('{{ route('comments.destroy', $reply->id) }}')"
                                                                    class="text-[10px] text-gray-400 hover:text-red-600 font-medium mt-1 transition-colors">
                                                                    Hapus
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <!-- Hidden Replies (Remaining) -->
                                                @if($comment->replies->count() > 2)
                                                    <div id="hidden-replies-{{ $comment->id }}" class="hidden space-y-3">
                                                        @foreach($comment->replies->skip(2) as $reply)
                                                            <div class="flex items-start gap-3">
                                                                <div
                                                                    class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-[10px] font-bold text-gray-500 shrink-0">
                                                                    {{ substr($reply->user->name, 0, 1) }}
                                                                </div>
                                                                <div class="flex-1 min-w-0">
                                                                    <div class="flex items-center gap-2 mb-0.5">
                                                                        <span class="font-bold text-xs text-gray-900">{{ $reply->user->name }}</span>
                                                                        @if($reply->user_id == $kost->owner_id)
                                                                            <span class="bg-gray-200 text-gray-800 text-[8px] px-1.5 py-0.5 rounded-full font-bold">OWNER</span>
                                                                        @endif
                                                                        <span class="text-[10px] text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                                    </div>
                                                                    <p class="text-xs text-gray-600">{{ $reply->content }}</p>
                                                                    
                                                                    @if(auth()->id() == $reply->user_id || auth()->user()?->isAdmin())
                                                                        <button
                                                                            onclick="confirmDeleteComment('{{ route('comments.destroy', $reply->id) }}')"
                                                                            class="text-[10px] text-gray-400 hover:text-red-600 font-medium mt-1 transition-colors">
                                                                            Hapus
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- View More Button -->
                                                    <button id="btn-view-more-{{ $comment->id }}" onclick="toggleReplies({{ $comment->id }})" class="text-xs font-bold text-gray-500 hover:text-black flex items-center gap-1 mt-2">
                                                        <span>Lihat {{ $comment->replies->count() - 2 }} balasan lainnya</span>
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-gray-400 text-sm">
                                        Belum ada diskusi. Jadilah yang pertama berkomentar!
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle('hidden');
        }

        function toggleReplies(commentId) {
            const hiddenReplies = document.getElementById(`hidden-replies-${commentId}`);
            const btn = document.getElementById(`btn-view-more-${commentId}`);
            
            hiddenReplies.classList.remove('hidden');
            btn.classList.add('hidden');
        }

        function confirmDeleteComment(url) {
            Swal.fire({
                title: 'Hapus Komentar?',
                text: "Komentar yang dihapus tidak dapat dikembalikan.",
                icon: 'question',
                iconColor: '#000000',
                showCancelButton: true,
                confirmButtonColor: '#000000', // Black
                cancelButtonColor: '#E5E7EB', // Silver
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                color: '#000000',
                customClass: {
                    popup: 'rounded-2xl border border-gray-100 shadow-xl',
                    confirmButton: 'mx-2 px-6 py-2.5 rounded-xl font-bold text-sm text-white bg-black border-2 border-black shadow-sm hover:bg-transparent hover:text-black transition-all duration-200',
                    cancelButton: 'mx-2 px-6 py-2.5 rounded-xl font-bold text-sm text-gray-800 bg-white border-2 border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200',
                    title: 'text-xl font-bold text-gray-900',
                    htmlContainer: 'text-gray-600'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            })
        }
    </script>
@endsection