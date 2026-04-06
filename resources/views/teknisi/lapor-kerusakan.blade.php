<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Maintenance Log ❄️</title>
    
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root { 
            --primary-ice: #4e73df; 
            --danger-ice: #e74a3b;
            --glass: rgba(255, 255, 255, 0.85); 
        }

        body { 
            background: linear-gradient(135deg, #cfdef3 0%, #e0eafc 100%); 
            font-family: 'Nunito', sans-serif; 
            min-height: 100vh;
        }

        /* Snow Effect */
        .snow-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; }
        .snowflake { position: absolute; background: white; border-radius: 50%; opacity: 0.8; top: -10%; animation: fall linear infinite; }
        @keyframes fall { to { transform: translateY(110vh) translateX(20px); } }

        .main-content { position: relative; z-index: 1; }

        /* Glassmorphism Card */
        .glass-card { 
            background: var(--glass); 
            backdrop-filter: blur(15px); 
            border-radius: 25px; 
            border: 1px solid rgba(255,255,255,0.4); 
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .navbar-ice {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .badge-status {
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .report-bubble {
            background: rgba(231, 74, 59, 0.05);
            border-left: 4px solid var(--danger-ice);
            border-radius: 10px;
            padding: 15px;
        }

        .form-repair {
            background: white;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #e3e6f0;
        }

        .btn-action {
            border-radius: 15px;
            font-weight: 700;
            padding: 12px;
            transition: 0.3s;
        }
    </style>
</head>
<body>

<div class="snow-container" id="snow"></div>

<nav class="navbar navbar-expand navbar-light navbar-ice mb-4 main-content">
    <div class="container">
        <a class="navbar-brand font-weight-bold text-primary" href="#">
            <i class="fas fa-tools mr-2"></i> TEKNISI PANEL ❄️
        </a>
    </div>
</nav>

<div class="container py-2 main-content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Daftar Laporan Kerusakan</h1>
        <span class="badge badge-primary shadow-sm p-2 px-3 badge-status">
            {{ $daftarKerusakan->count() }} Tugas Masuk
        </span>
    </div>

    <div class="row">
       @forelse($daftarKerusakan as $item)
<div class="col-lg-6 mb-4">
    <div class="card glass-card h-100 shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    {{-- Loop untuk menampilkan semua mobil dalam satu invoice sewa --}}
                    @foreach($item->mobil_units as $unit)
                        <h5 class="font-weight-bold text-dark mb-0">{{ $unit->mobil->merek }}</h5>
                        <span class="text-primary font-weight-bold small d-block mb-2">
                            <i class="fas fa-tag mr-1"></i> {{ $unit->no_polisi }}
                        </span>
                    @endforeach
                </div>
                <span class="badge badge-light text-danger border border-danger badge-status">Kondisi: {{ strtoupper($item->kondisi) }}</span>
            </div>

            <div class="report-bubble mb-4">
                <small class="text-uppercase font-weight-bold text-muted d-block mb-1">
                    Laporan Masuk (User: {{ $item->user->name }}):
                </small>
                {{-- Mengambil laporan dari tabel sewas --}}
                <p class="text-dark font-italic mb-0">"{{ $item->laporan ?? 'Tidak ada detail kerusakan.' }}"</p>
            </div>

            <div class="form-repair">
                {{-- Arahkan ke route update Anda --}}
                <form action="{{ route('sewa.updateStatus', $item->id) }}" method="POST">
                    @csrf
                    {{-- Status diubah ke 'selesai' atau 'tersedia' setelah diperbaiki --}}
                    <input type="hidden" name="kondisi" value="bagus"> 
                    
                    <div class="form-group">
                        <label class="small font-weight-bold text-dark">LOG PERBAIKAN TEKNISI</label>
                        <textarea name="catatan_teknisi" class="form-control bg-light border-0 shadow-sm" rows="3" placeholder="Contoh: Ganti oli, perbaikan bemper..." required style="border-radius: 12px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block btn-action shadow">
                        <i class="fas fa-tools mr-2"></i> SELESAI DIPERBAIKI
                    </button>
                </form>
            </div>
            
            <div class="mt-3 text-center">
                <small class="text-muted">
                    <i class="far fa-clock mr-1"></i> 
                    Dikembalikan: {{ \Carbon\Carbon::parse($item->tgl_kembali_aktual)->format('d M Y H:i') }}
                </small>
            </div>
        </div>
    </div>
</div>
@empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/blue/ice-skating.svg" style="width: 200px;" class="mb-4">
            <h4 class="text-gray-600 font-weight-bold">Semua Unit Aman Terkendali!</h4>
            <p class="text-muted">Tidak ada unit yang butuh perhatian teknis saat ini.</p>
        </div>
        @endforelse
    </div>
</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    function createSnow() {
        const container = document.getElementById('snow');
        for (let i = 0; i < 30; i++) {
            const snowflake = document.createElement('div');
            snowflake.className = 'snowflake';
            const size = Math.random() * 4 + 2 + 'px';
            snowflake.style.width = size; snowflake.style.height = size;
            snowflake.style.left = Math.random() * 100 + '%';
            snowflake.style.animationDuration = Math.random() * 3 + 2 + 's';
            container.appendChild(snowflake);
        }
    }
    createSnow();
</script>

</body>
</html>