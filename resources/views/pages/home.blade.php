@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative max-w-7xl mx-auto px-6 pt-12 pb-20 text-center overflow-hidden">
    <!-- Canvas Background -->
    <canvas id="bg-animation" class="absolute top-0 left-0 w-full h-full -z-10"></canvas>

    <div class="relative z-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100/80 backdrop-blur-sm border border-gray-200 text-xs font-medium text-gray-600 mb-8 animate-fade-in-up">
            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
            Puluhan kost baru ditambahkan minggu ini
        </div>
        
        <h1 class="text-5xl md:text-7xl font-bold tracking-tight text-gray-900 mb-6 leading-tight">
            Temukan Kost <br class="hidden md:block" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-900 via-gray-700 to-gray-500">Tanpa Ribet.</span>
        </h1>
        
        <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-12 leading-relaxed">
            Platform pencarian kost modern dengan pengalaman terbaik. Filter canggih, foto terverifikasi, dan langsung hubungi pemilik.
        </p>

        <!-- Search Component -->
        <div class="max-w-3xl mx-auto relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-gray-200 via-gray-100 to-gray-200 rounded-2xl blur opacity-75 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
            <form action="{{ route('home') }}" method="GET" class="relative bg-white rounded-xl shadow-xl ring-1 ring-gray-900/5 flex items-center p-2">
                <div class="flex-1 flex items-center px-4 gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lokasi, nama kost, atau area..." class="w-full border-none focus:ring-0 text-gray-900 placeholder-gray-400 text-base bg-transparent">
                </div>
                
                <div class="h-8 w-px bg-gray-200 mx-2"></div>
                
                <select name="tipe" class="border-none focus:ring-0 text-sm text-gray-600 font-medium bg-transparent cursor-pointer hover:text-black transition-colors">
                    <option value="">Semua Tipe</option>
                    <option value="putra" {{ request('tipe') == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ request('tipe') == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="campur" {{ request('tipe') == 'campur' ? 'selected' : '' }}>Campur</option>
                </select>

                <button type="submit" class="ml-2 bg-black text-white px-6 py-2.5 rounded-lg font-medium hover:bg-gray-800 transition-all shadow-lg shadow-gray-500/20 text-sm">
                    Cari Kost
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        const canvas = document.getElementById('bg-animation');
        if (!canvas) return;
        
        const ctx = canvas.getContext('2d');
        let particlesArray;

        const config = {
            particleColor: 'rgba(0, 0, 0, 0.6)', 
            lineColor: 'rgba(0, 0, 0, 0.08)',
            particleSize: 2,
            connectionDistance: 120,
            numberOfParticles: 90,
            speed: 0.3
        };

        function resizeCanvas() {
            // Set canvas size to match the parent container
            const parent = canvas.parentElement;
            canvas.width = parent.offsetWidth;
            canvas.height = parent.offsetHeight;
            
            const area = canvas.width * canvas.height;
            config.numberOfParticles = Math.floor(area / 10000); 
            
            init();
        }

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.directionX = (Math.random() * config.speed) - (config.speed / 2);
                this.directionY = (Math.random() * config.speed) - (config.speed / 2);
                this.size = Math.random() * config.particleSize + 1;
            }

            update() {
                if (this.x > canvas.width || this.x < 0) {
                    this.directionX = -this.directionX;
                }
                if (this.y > canvas.height || this.y < 0) {
                    this.directionY = -this.directionY;
                }

                this.x += this.directionX;
                this.y += this.directionY;

                this.draw();
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
                ctx.fillStyle = config.particleColor;
                ctx.fill();
            }
        }

        function init() {
            particlesArray = [];
            for (let i = 0; i < config.numberOfParticles; i++) {
                particlesArray.push(new Particle());
            }
        }

        function connect() {
            for (let a = 0; a < particlesArray.length; a++) {
                for (let b = a; b < particlesArray.length; b++) {
                    let distance = ((particlesArray[a].x - particlesArray[b].x) * (particlesArray[a].x - particlesArray[b].x)) +
                                   ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y));
                    
                    if (distance < (config.connectionDistance * config.connectionDistance)) {
                        let opacityValue = 1 - (distance / 20000);
                        ctx.strokeStyle = config.lineColor.replace(/[\d\.]+\)$/g, opacityValue * 0.5 + ')'); 
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                        ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                        ctx.stroke();
                    }
                }
            }
        }

        function animate() {
            requestAnimationFrame(animate);
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
            }
            connect();
        }

        window.addEventListener('resize', resizeCanvas);
        
        // Initial setup
        resizeCanvas();
        animate();
    })();
</script>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-6 pb-24">
    <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- Sidebar Filters (Sticky) -->
        <aside class="w-full lg:w-64 flex-shrink-0">
            <div class="sticky top-28 space-y-8">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Harga</h3>
                    <form action="{{ route('home') }}" method="GET" id="filterForm">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                        
                        <div class="space-y-3">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Harga" class="w-full bg-transparent border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-black focus:ring-0 transition-colors">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Harga" class="w-full bg-transparent border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-black focus:ring-0 transition-colors">
                        </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Fasilitas</h3>
                    <div class="space-y-2">
                        @foreach($facilities as $facility)
                            <label class="flex items-center group cursor-pointer">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" 
                                    {{ in_array($facility->id, request('facilities', [])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-black focus:ring-black transition-all">
                                <span class="ml-3 text-sm text-gray-600 group-hover:text-black transition-colors">{{ $facility->nama_fasilitas }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full bg-white border border-gray-200 text-gray-900 py-2 rounded-lg hover:border-gray-400 hover:shadow-sm text-sm font-medium transition-all">
                    Terapkan Filter
                </button>
                </form>
            </div>
        </aside>

        <!-- Grid -->
        <div class="flex-1">
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-xl font-bold text-gray-900">Hasil Pencarian</h2>
                <span class="text-sm text-gray-500">{{ $kosts->total() }} kost ditemukan</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($kosts as $kost)
                    <a href="{{ route('kost.show', $kost->id) }}" class="group block bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:border-gray-200 transition-all duration-300">
                        <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
                            @if($kost->images->count() > 0)
                                <img src="{{ asset('storage/' . $kost->images->first()->path_foto) }}" alt="{{ $kost->nama_kost }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider backdrop-blur-md bg-white/90 border border-white/20 shadow-sm
                                    {{ $kost->tipe == 'putra' ? 'text-blue-700' : ($kost->tipe == 'putri' ? 'text-pink-700' : 'text-purple-700') }}">
                                    {{ $kost->tipe }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1">{{ $kost->nama_kost }}</h3>
                            </div>
                            
                            <p class="text-sm text-gray-500 mb-4 line-clamp-1 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $kost->alamat }}
                            </p>
                            
                            <div class="flex items-center gap-2 mb-4 overflow-hidden">
                                @foreach($kost->facilities->take(3) as $fasilitas)
                                    <span class="text-[10px] font-medium bg-gray-50 text-gray-600 px-2 py-1 rounded border border-gray-100">{{ $fasilitas->nama_fasilitas }}</span>
                                @endforeach
                                @if($kost->facilities->count() > 3)
                                    <span class="text-[10px] font-medium text-gray-400">+{{ $kost->facilities->count() - 3 }}</span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <div>
                                    <span class="text-xs text-gray-400">Mulai dari</span>
                                    <div class="font-bold text-gray-900">Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}</div>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-black group-hover:text-white transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
                        <p class="text-gray-500 mt-1">Coba ubah kata kunci atau filter pencarian Anda.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12">
                {{ $kosts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
