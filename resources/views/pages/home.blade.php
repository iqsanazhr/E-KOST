@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden" style="padding-top: 3rem; padding-bottom: 5rem; text-align: center;">
    <!-- Canvas Background -->
    <canvas id="bg-animation" class="absolute" style="top: 0; left: 0; width: 100%; height: 100%; z-index: -10;"></canvas>

    <div class="container relative z-10">
        <div class="inline-flex items-center gap-2" style="background-color: rgba(243, 244, 246, 0.8); backdrop-filter: blur(4px); border: 1px solid #e5e7eb; border-radius: 9999px; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; color: #4b5563; margin-bottom: 2rem;">
            <span style="width: 0.5rem; height: 0.5rem; background-color: #22c55e; border-radius: 50%;"></span>
            Puluhan kost baru ditambahkan minggu ini
        </div>
        
        <h1 class="font-bold text-gray-900 mb-6" style="font-size: 3rem; line-height: 1.1; letter-spacing: -0.025em;">
            Temukan Kost <br class="md-block hidden" />
            <span class="text-gradient">Tanpa Ribet.</span>
        </h1>
        
        <p class="text-gray-500 max-w-2xl mx-auto mb-12 text-lg" style="line-height: 1.625;">
            Platform pencarian kost modern dengan pengalaman terbaik. Filter canggih, foto terverifikasi, dan langsung hubungi pemilik.
        </p>

        <!-- Search Component -->
        <div class="max-w-3xl mx-auto relative group">
            <div class="absolute" style="inset: -4px; background: linear-gradient(to right, #e5e7eb, #f3f4f6, #e5e7eb); border-radius: 1rem; filter: blur(8px); opacity: 0.75; z-index: -1;"></div>
            <form action="{{ route('home') }}" method="GET" style="position: relative; background-color: white; border-radius: 0.75rem; box-shadow: var(--shadow-xl); border: 1px solid rgba(17, 24, 39, 0.05); display: flex; align-items: center; padding: 0.5rem;">
                <div style="flex: 1; display: flex; align-items: center; padding: 0 1rem; gap: 0.75rem;">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lokasi, nama kost, atau area..." style="width: 100%; border: none; font-size: 1rem; color: #111827; background: transparent; outline: none;">
                </div>
                
                <div style="height: 2rem; width: 1px; background-color: #e5e7eb; margin: 0 0.5rem;"></div>
                
                <select name="tipe" style="border: none; font-size: 0.875rem; color: #4b5563; font-weight: 500; background: transparent; cursor: pointer; outline: none;">
                    <option value="">Semua Tipe</option>
                    <option value="putra" {{ request('tipe') == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ request('tipe') == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="campur" {{ request('tipe') == 'campur' ? 'selected' : '' }}>Campur</option>
                </select>

                <button type="submit" class="btn-primary ml-2" style="font-size: 0.875rem;">
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
<div class="container pb-20">
    <div class="flex flex-col md-flex lg-flex gap-12" style="gap: 3rem;">
        
        <!-- Sidebar Filters (Sticky) -->
        <aside style="width: 100%; flex-shrink: 0;" class="md-block">
            <div class="sticky-sidebar">
                
                <style>
                    @media (min-width: 1024px) {
                        aside { width: 16rem !important; }
                        .flex-col.lg-flex { flex-direction: row; }
                    }
                </style>
                
                <div class="filter-group">
                    <h3 class="text-xs font-bold text-gray-400 uppercase mb-4" style="letter-spacing: 0.05em;">Harga</h3>
                    <form action="{{ route('home') }}" method="GET" id="filterForm">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                        
                        <div class="space-y-3" style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Harga" class="filter-input">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Harga" class="filter-input">
                        </div>
                </div>

                <div class="filter-group">
                    <h3 class="text-xs font-bold text-gray-400 uppercase mb-4" style="letter-spacing: 0.05em;">Fasilitas</h3>
                    <div class="space-y-2" style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach($facilities as $facility)
                            <label class="flex items-center group cursor-pointer" style="display: flex; align-items: center; cursor: pointer;">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" 
                                    {{ in_array($facility->id, request('facilities', [])) ? 'checked' : '' }}
                                    style="border-radius: 0.25rem; border: 1px solid #d1d5db; width: 1rem; height: 1rem;">
                                <span class="ml-3 text-sm text-gray-600 transition-colors" style="margin-left: 0.75rem;">{{ $facility->nama_fasilitas }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full" style="width: 100%;">
                    Terapkan Filter
                </button>
                </form>
            </div>
        </aside>

        <!-- Grid -->
        <div style="flex: 1;">
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-xl font-bold text-gray-900" style="font-size: 1.25rem;">Hasil Pencarian</h2>
                <span class="text-sm text-gray-500">{{ $kosts->total() }} kost ditemukan</span>
            </div>

            <div class="grid grid-cols-1 md-grid-cols-2 xl-grid-cols-3 gap-6">
                @forelse($kosts as $kost)
                    <a href="{{ route('kost.show', $kost->id) }}" class="group card-hover block bg-white rounded-2xl overflow-hidden" style="display: block; border-radius: 1rem;">
                        <div class="relative aspect-4-3 bg-gray-100 overflow-hidden">
                            @if($kost->images->count() > 0)
                                <img src="{{ asset('storage/' . $kost->images->first()->path_foto) }}" alt="{{ $kost->nama_kost }}" class="w-full h-full object-cover group-hover-scale transition" style="transition: transform 0.5s;">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-300">
                                    <svg style="width: 3rem; height: 3rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <div class="absolute" style="top: 0.75rem; right: 0.75rem;">
                                <span style="padding: 0.25rem 0.625rem; border-radius: 0.375rem; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; backdrop-filter: blur(12px); background-color: rgba(255, 255, 255, 0.9); border: 1px solid rgba(255, 255, 255, 0.2); 
                                    color: {{ $kost->tipe == 'putra' ? '#1d4ed8' : ($kost->tipe == 'putri' ? '#be185d' : '#7e22ce') }};">
                                    {{ $kost->tipe }}
                                </span>
                            </div>
                        </div>
                        
                        <div style="padding: 1.25rem;">
                            <div class="flex justify-between items-start" style="margin-bottom: 0.5rem;">
                                <h3 class="font-bold text-gray-900 line-clamp-1" style="font-weight: 600;">{{ $kost->nama_kost }}</h3>
                            </div>
                            
                            <p class="text-sm text-gray-500 mb-4 line-clamp-1 flex items-center gap-1">
                                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $kost->alamat_lengkap }}
                            </p>
                            
                            <div class="flex items-center gap-2 mb-4 overflow-hidden">
                                @foreach($kost->facilities->take(3) as $fasilitas)
                                    <span style="font-size: 10px; font-weight: 500; background-color: #f9fafb; color: #4b5563; padding: 0.25rem 0.5rem; border-radius: 0.25rem; border: 1px solid #f3f4f6;">{{ $fasilitas->nama_fasilitas }}</span>
                                @endforeach
                                @if($kost->facilities->count() > 3)
                                    <span style="font-size: 10px; font-weight: 500; color: #9ca3af;">+{{ $kost->facilities->count() - 3 }}</span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between pt-4" style="border-top: 1px solid #f9fafb;">
                                <div>
                                    <span class="text-xs text-gray-400">Mulai dari</span>
                                    <div class="font-bold text-gray-900">Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}</div>
                                </div>
                                <div style="width: 2rem; height: 2rem; border-radius: 50%; background-color: #f9fafb; display: flex; align-items: center; justify-content: center; transition: all 0.3s; color: #4b5563;">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div style="grid-column: 1 / -1; padding: 5rem 0; text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 4rem; height: 4rem; border-radius: 50%; background-color: #f3f4f6; margin-bottom: 1rem;">
                            <svg style="width: 2rem; height: 2rem; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
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
