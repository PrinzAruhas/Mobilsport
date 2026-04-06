<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Riwayat Pengembalian ❄️</title>
    
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.92);
            --car-blue: #3a7bd5;
            --car-dark: #003366;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #2a5298, #1e3c72);
            min-height: 100vh;
            color: #1a202c;
        }

        /* Salju */
        .snow-wrapper { position: fixed; inset: 0; z-index: 0; pointer-events: none; }
        .snowflake { position: absolute; top: -10px; color: white; animation: fall linear infinite; opacity: 0.6; }
        @keyframes fall { to { transform: translateY(105vh) rotate(360deg); } }

        /* Konten */
        .content-container { position: relative; z-index: 10; }

        .hero-section {
            padding: 70px 0 110px;
            color: white;
            text-align: center;
        }

        .hero-section h1 {
            font-weight: 800;
            font-size: 3rem;
            background: linear-gradient(to bottom, #ffffff, #a5c9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Card & Table */
        .main-card {
            margin-top: -70px;
            border: none;
            border-radius: 30px;
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        .table thead th {
            background: transparent;
            border: none;
            color: #4a5568;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 25px 20px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .table tbody tr:hover {
            background: rgba(58, 123, 213, 0.05);
            transform: scale(1.005);
        }

        .table td {
            vertical-align: middle !important;
            border-top: 1px solid rgba(0,0,0,0.03);
            padding: 20px;
        }

        /* Unit Box */
        .car-unit-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .car-icon-wrapper {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #3a7bd5, #003366);
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(58, 123, 213, 0.3);
        }

        /* Bukti Gambar */
        .img-proof {
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 16px;
            border: 4px solid white;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            transition: 0.4s;
            cursor: pointer;
        }

        .img-proof:hover {
            transform: translateY(-5px) rotate(-3deg);
            box-shadow: 0 12px 20px rgba(0,0,0,0.2);
        }

        /* Badges */
        .status-badge {
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-baik { background: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; }
        .badge-rusak { background: #fff5f5; color: #c53030; border: 1px solid #feb2b2; }

        .modal-content {
            border-radius: 35px;
            border: none;
            overflow: hidden;
        }
        .unit-item:last-child {
    border-bottom: none !important;
}

.rounded-xl {
    border-radius: 24px !important;
}

/* Mempercantik Modal agar serasi dengan tema "Ice" */
.modal-content {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-primary {
    background: linear-gradient(135deg, var(--car-blue), var(--car-dark));
    border: none;
    transition: 0.3s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(58, 123, 213, 0.4);
}
    </style>
</head>

<body>

<div class="snow-wrapper" id="snow-field"></div>

<div class="content-container">
    <section class="hero-section">
        <div class="container">
            <h1>Riwayat Servis</h1>
            <p class="lead opacity-75">Sistem Monitoring Kondisi Kendaraan MobiRent</p>
        </div>
    </section>

    <div class="container pb-5">
        <div class="card main-card">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Unit Armada</th>
                            <th>Penyewa</th>
                            <th class="text-center">Bukti Akses</th>
                            <th class="text-center">Kondisi</th>
                            <th>Laporan</th>
                            <th>Waktu Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
<tbody>
    @forelse($history as $item)
    <tr>
        <td>
            <div class="car-unit-box">
                <div class="car-icon-wrapper">
                    <i class="fas fa-car-side"></i>
                </div>
                <div>
                    @foreach($item->mobil_units as $unit)
                        <div class="unit-item {{ !$loop->last ? 'mb-2 pb-2 border-bottom' : '' }}" style="border-bottom-style: dotted !important;">
                            <div class="font-weight-bold" style="color: var(--car-dark);">
                                {{ $unit->mobil->merek }} <span class="text-muted small">{{ $unit->mobil->model }}</span>
                            </div>
                            <div class="mt-1">
                                <span class="badge badge-primary shadow-sm" style="font-size: 9px;">
                                    <i class="fas fa-id-card-alt mr-1"></i>{{ $unit->no_polisi }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </td>

        <td>
            <div class="font-weight-bold">{{ $item->user->name }}</div>
            <small class="text-muted">Inv: #{{ $item->id }}</small>
        </td>

        <td class="text-center">
            {{-- Sesuaikan dengan nama kolom di screenshot: laporan (berisi path gambar) --}}
            @if($item->laporan && Storage::disk('public')->exists($item->laporan))
                <img src="{{ asset('storage/' . $item->laporan) }}" 
                     class="img-proof"
                     data-toggle="modal" 
                     data-target="#modal{{ $item->id }}">
            @else
                <div class="py-2 px-3 border rounded text-muted small bg-light" style="border-style: dashed !important;">
                    <i class="fas fa-image-slash d-block mb-1"></i> No Image
                </div>
            @endif
        </td>

        <td class="text-center">
            <span class="status-badge {{ $item->kondisi == 'bagus' || $item->kondisi == 'baik' ? 'badge-baik' : 'badge-rusak' }}">
                <i class="fas {{ $item->kondisi == 'bagus' || $item->kondisi == 'baik' ? 'fa-check-circle' : 'fa-tools' }}"></i>
                {{ strtoupper($item->kondisi ?? 'BAIK') }}
            </span>
        </td>

        <td>
            <div class="bg-light p-2 rounded small" style="max-width: 180px; font-style: italic;">
                "Unit telah kembali"
            </div>
        </td>

        <td>
            {{-- Menggunakan tgl_kembali_aktual dari database --}}
            @if($item->tgl_kembali_aktual)
                <div class="font-weight-bold" style="color: var(--car-dark);">
                    {{ \Carbon\Carbon::parse($item->tgl_kembali_aktual)->format('H:i') }}
                </div>
                <div class="text-muted small">
                    {{ \Carbon\Carbon::parse($item->tgl_kembali_aktual)->format('d M Y') }}
                </div>
            @else
                -
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center py-5">
            <p class="text-muted">Data pengembalian belum tersedia.</p>
        </td>
    </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mb-5">
    

{{-- Modal Preview --}}
@foreach($history as $item)
<div class="modal fade" id="modal{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-weight-bold m-0"><i class="fas fa-camera mr-2"></i>Bukti Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <img src="{{ asset('storage/bukti_kartu/' . $item->bukti_kartu) }}" 
                     class="img-fluid rounded-xl shadow-lg mb-4" 
                     style="width: 100%; border-radius: 20px;">

                <div class="alert alert-secondary border-0 mb-0" style="border-radius: 15px;">
                    <label class="font-weight-bold small text-uppercase">Catatan Lapangan:</label>
                    <p class="m-0">{{ $item->laporan ?? 'Unit telah diperiksa dan dinyatakan kembali dalam kondisi sesuai.' }}</p>
                </div>
            </div>
            <div class="bg-light p-3 text-center">
                <button type="button" class="btn btn-primary px-5 font-weight-bold" style="border-radius: 12px;" data-dismiss="modal">Selesai</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    function createSnowflake() {
        const snow = document.getElementById('snow-field');
        const flake = document.createElement('div');
        flake.classList.add('snowflake');
        flake.innerHTML = '❄';
        flake.style.left = Math.random() * 100 + 'vw';
        flake.style.fontSize = (Math.random() * 10 + 5) + 'px';
        flake.style.opacity = Math.random() * 0.5 + 0.3;
        flake.style.animationDuration = (Math.random() * 4 + 5) + 's';
        snow.appendChild(flake);
        setTimeout(() => flake.remove(), 8000);
    }
    setInterval(createSnowflake, 400);
</script>

</body>
</html>