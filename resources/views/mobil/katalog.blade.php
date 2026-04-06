<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Katalog Armada ❄️</title>
    
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --ice-bg: #f0f8ff;
            --ice-primary: #00d2ff;
            --ice-secondary: #3a7bd5;
            --ice-dark: #2c3e50;
            --glass: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.4);
        }

        body { 
            background-color: var(--ice-bg); 
            font-family: 'Nunito', sans-serif; 
            overflow-x: hidden;
            color: var(--ice-dark);
        }

        #snow-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .hero-section {
            background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
            padding: 100px 0 140px 0;
            border-bottom-left-radius: 80px;
            border-bottom-right-radius: 80px;
            position: relative;
            z-index: 2;
            box-shadow: 0 10px 30px rgba(58, 123, 213, 0.3);
        }

        .search-container {
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 40px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--glass-border);
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }

        .card-mobil-ice {
            border: 1px solid var(--glass-border) !important;
            border-radius: 30px !important;
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            overflow: hidden;
        }

        .card-mobil-ice:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(58, 123, 213, 0.2) !important;
            background: #ffffff !important;
        }

        .mobil-img-container {
            height: 220px;
            position: relative;
            overflow: hidden;
            background: #f8fbff;
        }

        .mobil-img-container img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s ease;
        }

        .card-mobil-ice:hover .mobil-img-container img { transform: scale(1.1); }

        .status-overlay { position: absolute; top: 20px; left: 20px; z-index: 10; }

        .badge-ice {
            padding: 8px 16px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 800;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .status-ready { background: linear-gradient(45deg, #00f2fe, #4facfe); color: white; }
        .status-full { background: #e0e6ed; color: #95a5a6; }

        .card-title-custom { font-size: 1.3rem; font-weight: 800; color: #1a2a3a; letter-spacing: -0.5px; }
        .price-text { font-size: 1.2rem; font-weight: 800; color: #3a7bd5; }

        .unit-pill {
            padding: 4px 10px; border-radius: 8px;
            font-size: 0.7rem; font-weight: 700;
            background: #f1f7ff; border: 1px solid #e1eeff;
        }

        .btn-modern { border-radius: 20px; padding: 12px; font-weight: 800; letter-spacing: 0.5px; transition: 0.3s; }
        .btn-ice { background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%); color: white; border: none; }
        .btn-ice:hover { box-shadow: 0 10px 20px rgba(58, 123, 213, 0.4); transform: scale(1.02); color: white; }

        .btn-back-floating {
            position: absolute; top: 30px; left: 30px; z-index: 1000;
            background: var(--glass); backdrop-filter: blur(10px);
            padding: 12px 20px; border-radius: 20px; color: var(--ice-secondary);
            font-weight: 800; border: 1px solid var(--glass-border);
        }

        .grayscale { filter: grayscale(100%); opacity: 0.7; }
        .unit-pill.bg-danger {
            background: linear-gradient(45deg, #ff416c, #ff4b2b) !important;
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .price-text.text-danger { color: #e74c3c !important; }
    </style>
</head>
<body>

    {{-- LOGIKA PROMO DIPINDAHKAN KE ATAS --}}
    @php
        $activePromoCode = null;
        $activePromoDiscount = 0;
        $appliedPromo = session('applied_promo');

        // Cek database jika session kosong
        if (!$appliedPromo && auth()->check()) {
            $dbPromo = auth()->user()->usedPromos()->latest()->first();
            if ($dbPromo) {
                $appliedPromo = [
                    'id' => $dbPromo->id,
                    'code' => $dbPromo->code,
                    'discount' => $dbPromo->discount_percent,
                    'type' => $dbPromo->type,
                    'target_id' => $dbPromo->target_id,
                ];
            }
        }

        if ($appliedPromo) {
            $activePromoCode = $appliedPromo['code'];
            $activePromoDiscount = $appliedPromo['discount'];
        }
    @endphp

    <canvas id="snow-canvas"></canvas>

    <a href="{{ url('/dashboard') }}" class="btn-back-floating shadow-sm">
        <i class="fas fa-chevron-left mr-2"></i> Dashboard
    </a>

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 font-weight-bold text-white mb-2">Armada Kristal 🧊</h1>
            <p class="text-white opacity-75 font-weight-bold">Perjalanan sejuk dengan armada pilihan terbaik kami</p>
        </div>
    </section>

    <div class="container pb-5">
        <div class="search-container mb-5 mx-lg-5">
            <div class="row align-items-end">
                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="small font-weight-bold ml-2 text-primary">Cari Model / Merek</label>
                    <input type="text" id="searchName" class="form-control filter-input border-0 bg-light" placeholder="Masukkan nama mobil...">
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="small font-weight-bold ml-2 text-primary">Kategori</label>
                    <select id="filterCategory" class="form-control filter-input border-0 bg-light">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ strtolower($cat->nama_kategori) }}">{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-ice btn-block font-weight-bold rounded-pill shadow-sm" style="height: 50px;" onclick="resetFilter()">
                        <i class="fas fa-sync-alt mr-2"></i> Reset Filter
                    </button>
                </div>
            </div>
        </div>

        @if($activePromoCode)
        <div class="container px-lg-5 mb-4">
            <div class="alert shadow-sm border-0 d-flex align-items-center justify-content-between p-3" 
                 style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 20px; color: white;">
                <div class="d-flex align-items-center">
                    <div class="mr-3 d-flex align-items-center justify-content-center" 
                         style="background: #fbbf24; color: #0f172a; width: 45px; height: 45px; border-radius: 12px;">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">Promo Aktif: <span class="text-warning">{{ $activePromoCode }}</span></h6>
                        <small class="opacity-75">Potongan tambahan {{ $activePromoDiscount }}% otomatis terpasang!</small>
                    </div>
                </div>
                <form action="{{ route('booking.remove_promo') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light rounded-pill px-3">Lepas</button>
                </form>
            </div>
        </div>
        @endif

        <div class="row" id="mobilGrid">
            @forelse($mobils as $mobil)
                @php
                    $tersedia = $mobil->units->where('status', 'tersedia')->count();
                    $diskonRedeem = 0;

                    // Hitung diskon promo jika ada
                    if ($appliedPromo) {
                        $pType = $appliedPromo['type'];
                        $pTargetId = (int)$appliedPromo['target_id'];

                        if ($pType == 'all' || 
                           ($pType == 'category' && (int)$mobil->category_id === $pTargetId) || 
                           ($pType == 'unit' && (int)$mobil->id === $pTargetId)) {
                            $diskonRedeem = (int)$appliedPromo['discount'];
                        }
                    }

                    $hargaAwal = $mobil->harga_sewa;
                    $hargaSetelahUnit = $hargaAwal - ($hargaAwal * ($mobil->diskon / 100));
                    $hargaAkhir = $hargaSetelahUnit - ($hargaSetelahUnit * ($diskonRedeem / 100));
                @endphp

                <div class="col-xl-3 col-lg-4 col-md-6 mb-4 mobil-item" 
                     data-category="{{ strtolower($mobil->category->nama_kategori ?? '') }}"
                     data-search="{{ strtolower($mobil->merek . ' ' . $mobil->model) }}">
                    
                    <div class="card card-mobil-ice h-100 shadow-sm border-0 position-relative">
                        <div class="status-overlay">
                            @if($tersedia > 0)
                                <span class="badge badge-ice status-ready"><i class="fas fa-snowflake mr-1"></i> {{ $tersedia }} Ready</span>
                            @else
                                <span class="badge badge-ice status-full"><i class="fas fa-lock mr-1"></i> Full</span>
                            @endif
                        </div>

                        <div class="mobil-img-container">
                            <img src="{{ asset('storage/' . $mobil->gambar) }}" class="{{ $tersedia == 0 ? 'grayscale' : '' }}">
                        </div>

                        <div class="card-body d-flex flex-column p-4">
                            <div class="mb-2 d-flex justify-content-between">
                                <span class="text-primary small font-weight-bold">{{ $mobil->category->nama_kategori ?? 'Standard' }}</span>
                                <span class="text-muted small">{{ $mobil->transmisi }}</span>
                            </div>
                            
                            <h5 class="card-title-custom mb-1">{{ $mobil->merek }}</h5>
                            <p class="text-muted small mb-3">{{ $mobil->model }}</p>

                            <div class="d-flex flex-wrap mb-3" style="gap: 5px;">
                                @if($mobil->diskon > 0)
                                    <div class="unit-pill bg-danger text-white border-0">
                                        <i class="fas fa-percentage mr-1"></i> -{{ $mobil->diskon }}%
                                    </div>
                                @endif

                                @if($diskonRedeem > 0)
                                    <div class="unit-pill bg-warning text-dark border-0">
                                        <i class="fas fa-magic mr-1"></i> Extra -{{ $diskonRedeem }}%
                                    </div>
                                @endif
                            </div>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-end mb-3">
                                    <div>
                                        <p class="text-muted small mb-0">Harga Sewa</p>
                                        @if($mobil->diskon > 0 || $diskonRedeem > 0)
                                            <small class="text-muted"><del>Rp {{ number_format($hargaAwal, 0, ',', '.') }}</del></small><br>
                                            <span class="price-text text-danger">Rp {{ number_format($hargaAkhir, 0, ',', '.') }}</span>
                                        @else
                                            <span class="price-text">Rp {{ number_format($hargaAwal, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <span class="text-muted small">/Hari</span>
                                </div>
                                
                                @if($tersedia > 0)
                                    <a href="{{ route('mobil.show', $mobil->id) }}" class="btn btn-ice btn-block btn-modern shadow-sm">
                                        SEWA SEKARANG <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                @else
                                    <button class="btn btn-light btn-block btn-modern text-muted" disabled>PENUH</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">Armada belum tersedia ❄️</h3>
                </div>
            @endforelse
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        // Animasi Salju
        const canvas = document.getElementById('snow-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        function resize() { canvas.width = window.innerWidth; canvas.height = window.innerHeight; }
        window.addEventListener('resize', resize);
        resize();

        class Particle {
            constructor() { this.reset(); }
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height - canvas.height;
                this.size = Math.random() * 2 + 1;
                this.speed = Math.random() * 1 + 0.5;
                this.velX = Math.random() * 0.5 - 0.25;
            }
            update() { this.y += this.speed; this.x += this.velX; if (this.y > canvas.height) this.reset(); }
            draw() { ctx.fillStyle = 'rgba(255, 255, 255, 0.7)'; ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2); ctx.fill(); }
        }

        function init() { for (let i = 0; i < 100; i++) particles.push(new Particle()); }
        function animate() { ctx.clearRect(0, 0, canvas.width, canvas.height); particles.forEach(p => { p.update(); p.draw(); }); requestAnimationFrame(animate); }
        init(); animate();

        // Filter Logic
        function filterCars() {
            let name = $("#searchName").val().toLowerCase();
            let category = $("#filterCategory").val().toLowerCase();
            $(".mobil-item").each(function() {
                let searchData = $(this).data("search");
                let carCat = $(this).data("category");
                if (searchData.includes(name) && (category === "" || carCat === category)) {
                    $(this).fadeIn(400);
                } else {
                    $(this).fadeOut(200);
                }
            });
        }
        $("#searchName, #filterCategory").on("input change", filterCars);
        function resetFilter() {
            $("#searchName").val("");
            $("#filterCategory").val("");
            $(".mobil-item").fadeIn(400);
        }
    </script>
</body>
</html>