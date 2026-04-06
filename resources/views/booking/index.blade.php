<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Saya - MobiRent Ice Edition</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --ice-gradient: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 50%, #fbcfe8 100%);
            --crystal-glass: rgba(255, 255, 255, 0.4);
            --ice-border: rgba(255, 255, 255, 0.6);
            --deep-ice: #0ea5e9;
            --soft-text: #1e293b;
        }

        body {
            background: var(--ice-gradient);
            background-attachment: fixed;
            font-family: 'Quicksand', sans-serif;
            min-height: 100vh;
            color: var(--soft-text);
        }

        .glass-card {
            background: var(--crystal-glass);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--ice-border);
            border-radius: 24px;
        }

        .booking-card {
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            overflow: hidden;
            height: 100%;
        }

        .booking-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.6);
        }

        .card-img-container {
            width: 100%;
            height: 180px;
            overflow: hidden;
            border-radius: 18px;
            margin-bottom: 15px;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.4);
        }

        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .booking-card:hover .card-img-container img {
            transform: scale(1.1);
        }

        .badge-ice {
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-menunggu { background: #fef9c3; color: #854d0e; border: 1px solid #fde047; }
        .status-disetujui { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .status-aktif { background: #e0f2fe; color: #075985; border: 1px solid #7dd3fc; }
        .status-selesai { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .status-ditolak { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        .price-tag {
            font-size: 1.4rem;
            font-weight: 800;
            background: linear-gradient(45deg, #0ea5e9, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-detail {
            background: var(--deep-ice);
            color: white;
            border-radius: 15px;
            padding: 10px 20px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-detail:hover {
            background: #0369a1;
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
            color: white;
        }

        .btn-light.glass-card:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(-3px);
            transition: all 0.3s ease;
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>

    <div class="container" style="margin-top: 50px; padding-bottom: 80px;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-7 col-md-6 mb-4 mb-md-0">
                <h1 class="fw-bold display-5 mb-1" style="color: #0f172a;">Trip Saya</h1>
                <p class="fs-5 text-muted mb-0">Kelola perjalanan Anda dengan kenyamanan kristal.</p>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="d-flex gap-2 justify-content-md-end">
                    <a href="/dashboard" class="btn btn-light btn-lg glass-card px-4" style="border-radius: 18px; border: 1px solid var(--ice-border); color: var(--soft-text); font-size: 0.95rem;">
                        <i class="fas fa-home me-2 text-primary"></i>Dashboard
                    </a>
                    <a href="/sewa" class="btn btn-primary btn-lg shadow-lg px-4" style="border-radius: 18px; background: var(--deep-ice); border: none; font-size: 0.95rem;">
                        <i class="fas fa-plus-circle me-2"></i>Sewa Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($bookings as $sewa)
            <div class="col-md-6 col-lg-4">
                <div class="booking-card glass-card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                        <span class="badge bg-white text-dark shadow-sm" style="border-radius: 8px;">#{{ $sewa->id }}</span>
                        @php
                            $statusClass = [
                                'menunggu_verifikasi' => 'status-menunggu',
                                'disetujui' => 'status-disetujui',
                                'aktif' => 'status-aktif',
                                'selesai' => 'status-selesai',
                                'ditolak' => 'status-ditolak'
                            ];
                            $statusLabel = [
                                'menunggu_verifikasi' => 'Pending',
                                'disetujui' => 'Verified',
                                'aktif' => 'On Trip',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Dibatalkan'
                            ];
                        @endphp
                        <span class="badge-ice {{ $statusClass[$sewa->status] ?? 'status-menunggu' }}">
                            {{ $statusLabel[$sewa->status] ?? $sewa->status }}
                        </span>
                    </div>

                    <div class="card-img-container">
                        @if($sewa->gambar)
                            <img src="{{ asset('storage/' . $sewa->gambar) }}" 
                                 alt="{{ $sewa->nama_mobil }}"
                                 onerror="this.src='{{ asset('storage/mobil/' . $sewa->gambar) }}'; this.onerror=function(){this.src='https://placehold.co/600x400?text=Gambar+Mobil';}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                <i class="fas fa-car-side fa-4x text-white-50"></i>
                            </div>
                        @endif
                    </div>

                    <div class="px-2">
                        <h4 class="fw-bold mb-3">{{ $sewa->nama_mobil ?? 'Unit Mobil' }}</h4>
                        
                        <div class="row mb-4">
                            <div class="col-6 border-end">
                                <small class="text-muted d-block">Check-in</small>
                                <span class="fw-bold small">{{ date('d M Y', strtotime($sewa->tgl_mulai)) }}</span>
                            </div>
                            <div class="col-6 ps-3">
                                <small class="text-muted d-block">Durasi</small>
                                <span class="fw-bold small text-primary">{{ \Carbon\Carbon::parse($sewa->tgl_mulai)->diffInDays($sewa->tgl_selesai) }} Hari</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Total Harga</small>
                                <span class="price-tag">Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</span>
                            </div>
                            <a href="/booking/{{ $sewa->id }}" class="btn-detail shadow-sm">
                                Detail <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="glass-card p-5 floating d-inline-block" style="max-width: 500px;">
                    <img src="https://illustrations.popsy.co/sky/falling-ice-cubes.svg" alt="Empty" style="width: 250px;">
                    <h2 class="fw-bold mt-4">Belum Ada Jejak</h2>
                    <p class="text-muted">Jelajahi koleksi mobil kami dan ciptakan momen tak terlupakan.</p>
                    <a href="/sewa" class="btn btn-primary btn-lg mt-3 px-5 shadow" style="border-radius: 15px; background: var(--deep-ice); border: none;">Mulai Sekarang</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>

</body>
</html>