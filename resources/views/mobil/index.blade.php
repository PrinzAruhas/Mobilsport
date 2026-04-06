<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Armada Kristal ❄️</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --ice-bg: #f4f9fc;
            --ice-primary: #00d2ff;
            --ice-secondary: #3a7bd5;
            --glass: rgba(255, 255, 255, 0.75);
            --border-glass: rgba(255, 255, 255, 0.4);
        }

        body { 
            background-color: var(--ice-bg) !important; 
            font-family: 'Nunito', sans-serif;
            color: #2d3436;
        }

        /* --- Canvas Salju (Lebih Halus) --- */
        #snow-canvas {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: 0;
        }

        /* --- Elegant Header --- */
        .page-title {
            letter-spacing: -1px;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- Premium Card --- */
        .card-mobil-ice {
            border: 1px solid var(--border-glass) !important;
            border-radius: 30px !important;
            background: var(--glass) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.03) !important;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
        }

        /* Glossy Shine Effect on Hover */
        .card-mobil-ice::before {
            content: "";
            position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.4), transparent);
            transform: skewX(-25deg);
            transition: 0.8s;
            z-index: 3;
        }

        .card-mobil-ice:hover::before { left: 150%; }

        .card-mobil-ice:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(58, 123, 213, 0.15) !important;
        }

        /* --- Image Styling --- */
        .mobil-img-container {
            height: 200px;
            margin: 12px;
            border-radius: 22px;
            overflow: hidden;
            position: relative;
        }

        .mobil-img-container img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.2s ease;
        }

        .card-mobil-ice:hover .mobil-img-container img {
            transform: scale(1.1) rotate(1deg);
        }

        /* --- Luxury Badge --- */
        .badge-ice {
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .status-tersedia { background: #00b894; color: white; }
        .status-servis { background: #fdcb6e; color: #634d00; }
        .status-disewa { background: #ff7675; color: white; }
        .status-rusak { background: #2d3436; color: #dfe6e9; }

        /* --- Price Tag --- */
        .price-container {
            background: rgba(58, 123, 213, 0.05);
            padding: 10px 15px;
            border-radius: 15px;
            display: inline-block;
        }
        .price-tag {
            font-weight: 800;
            color: #0984e3;
            font-size: 1.1rem;
        }

        /* --- Action Buttons --- */
        .btn-glass-primary {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            color: white !important;
            border-radius: 14px;
            font-weight: 700;
            padding: 12px;
            border: none;
            transition: 0.3s;
        }
        .btn-glass-danger {
            background: rgba(255, 118, 117, 0.1);
            color: #d63031 !important;
            border-radius: 14px;
            width: 48px;
            border: none;
            transition: 0.3s;
        }
        .btn-glass-danger:hover { background: #d63031; color: white !important; }

        /* --- Filter Area --- */
        .glass-search {
            border-radius: 18px;
            border: 1px solid var(--border-glass);
            background: white;
            padding: 5px 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }

        .btn-add-premium {
            background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
            color: white !important;
            border-radius: 18px;
            padding: 12px 25px;
            font-weight: 800;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 210, 255, 0.3);
        }
    </style>
</head>

<body>
    <canvas id="snow-canvas"></canvas>

    <div class="container-fluid px-lg-5 py-5" style="position: relative; z-index: 1;">
        
        <div class="row align-items-center mb-5">
            <div class="col-md-7">
                <h1 class="page-title font-weight-bold mb-1">Armada Kristal 🧊</h1>
                <p class="text-muted font-weight-600">Kelola operasional armada dengan presisi dan gaya.</p>
            </div>
            <div class="col-md-5 text-md-right">
                <a href="/dashboard" class="btn btn-link text-muted font-weight-bold mr-3 text-decoration-none">
                    <i class="fas fa-chevron-left mr-2"></i>Dashboard
                </a>
                <a href="/mobil/create" class="btn btn-add-premium shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Tambah Armada
                </a>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="glass-search d-flex align-items-center">
                            <i class="fas fa-filter text-primary mr-3"></i>
                            <select class="form-control border-0 shadow-none bg-transparent font-weight-bold" id="filterKategori">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ strtolower($cat->nama_kategori) }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <div class="glass-search d-flex align-items-center">
                            <i class="fas fa-search text-primary mr-3"></i>
                            <input type="text" id="searchMobil" class="form-control border-0 shadow-none bg-transparent" placeholder="Cari merek, plat nomor, atau model...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="mobilGrid">
            @forelse($mobils as $mobil)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-5 mobil-item" 
                 id="mobil-card-{{ $mobil->id }}"
                 data-category="{{ strtolower($mobil->category->nama_kategori ?? '') }}"
                 data-search="{{ strtolower($mobil->merek . ' ' . $mobil->model . ' ' . $mobil->no_polisi) }}">
                
                <div class="card card-mobil-ice h-100">
                    <div class="mobil-img-container">
                        <div class="position-absolute" style="top:15px; left:15px; z-index:4;">
                            @if($mobil->status == 'tersedia')
                                <span class="badge-ice status-tersedia"><i class="fas fa-check-circle mr-1"></i> Tersedia</span>
                            @elseif($mobil->status == 'servis')
                                <span class="badge-ice status-servis"><i class="fas fa-tools mr-1"></i> Maintenance</span>
                            @elseif($mobil->status == 'rusak')
                                <span class="badge-ice status-rusak"><i class="fas fa-exclamation-triangle mr-1"></i> Rusak</span>
                            @else
                                <span class="badge-ice status-disewa"><i class="fas fa-key mr-1"></i> Disewa</span>
                            @endif
                        </div>
                        
                        @if($mobil->gambar)
                            <img src="{{ asset('storage/' . $mobil->gambar) }}" alt="{{ $mobil->merek }}" onerror="this.src='https://placehold.co/600x400?text=Mobil'">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted">
                                <i class="fas fa-car fa-4x opacity-25"></i>
                            </div>
                        @endif
                    </div>

                    <div class="card-body pt-2 px-4 pb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <small class="text-primary font-weight-800 text-uppercase" style="letter-spacing:1.5px">
                                {{ $mobil->category->nama_kategori ?? 'Standard' }}
                            </small>
                            <span class="badge badge-white border text-muted px-2 py-1" style="border-radius:8px">
                                {{ $mobil->no_polisi }}
                            </span>
                        </div>

                        <h4 class="font-weight-bold text-dark mb-1">{{ $mobil->merek }}</h4>
                        <p class="text-muted small mb-4">{{ $mobil->model }}</p>

                        <div class="price-container mb-4 w-100">
                            <small class="text-muted d-block">Tarif Harian</small>
                            <span class="price-tag">Rp{{ number_format($mobil->harga_sewa, 0, ',', '.') }}</span>
                            <small class="text-muted">/ hari</small>
                        </div>

                        <div class="d-flex">
                            <a href="{{ route('mobil.edit', $mobil->id) }}" class="btn btn-glass-primary flex-grow-1 mr-2 text-decoration-none text-center">
                                <i class="fas fa-pencil-alt mr-2"></i>Edit Data
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $mobil->id }}')" class="btn btn-glass-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-snowflake fa-4x text-light mb-3"></i>
                <h3 class="text-muted">Gudang Armada Kosong</h3>
                <p class="text-muted">Mulai tambahkan unit kendaraan pertama Anda.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // --- Smooth Filter Logic ---
        $(document).ready(function() {
            function filterGrid() {
                const search = $("#searchMobil").val().toLowerCase();
                const category = $("#filterKategori").val().toLowerCase();

                $(".mobil-item").each(function() {
                    const itemCat = $(this).data("category");
                    const itemText = $(this).data("search");
                    const matchesSearch = itemText.includes(search);
                    const matchesCat = category === "" || itemCat === category;

                    if (matchesSearch && matchesCat) {
                        $(this).css('display', 'block').animate({opacity: 1}, 300);
                    } else {
                        $(this).animate({opacity: 0}, 200, function() {
                            $(this).css('display', 'none');
                        });
                    }
                });
            }
            $("#searchMobil").on("keyup", filterGrid);
            $("#filterKategori").on("change", filterGrid);
        });

        // --- Elegant Snow Effect ---
        const canvas = document.getElementById('snow-canvas');
        const ctx = canvas.getContext('2d');
        let flakes = [];

        function initSnow() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            flakes = [];
            for(let i=0; i<70; i++) {
                flakes.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    r: Math.random() * 3 + 1,
                    d: Math.random() * 1
                });
            }
        }

        function drawSnow() {
            ctx.clearRect(0,0,canvas.width, canvas.height);
            ctx.fillStyle = "rgba(255,255,255,0.6)";
            ctx.beginPath();
            for(let f of flakes) {
                ctx.moveTo(f.x, f.y);
                ctx.arc(f.x, f.y, f.r, 0, Math.PI*2, true);
                f.y += Math.cos(f.d) + 1 + f.r/2;
                f.x += Math.sin(f.d) * 2;
                if(f.y > canvas.height) f.y = -10, f.x = Math.random()*canvas.width;
            }
            ctx.fill();
            requestAnimationFrame(drawSnow);
        }

        window.addEventListener('resize', initSnow);
        initSnow(); drawSnow();

        // --- SweetAlert Delete ---
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Armada?',
                text: "Unit ini akan dihapus dari sistem selamanya.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff7675',
                cancelButtonColor: '#3a7bd5',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: 'rgba(255,255,255,0.95)',
                backdrop: `rgba(0,0,123,0.1)`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/mobil/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            Swal.fire('Terhapus!', 'Armada berhasil dihapus.', 'success');
                            $(`#mobil-card-${id}`).fadeOut(500);
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>