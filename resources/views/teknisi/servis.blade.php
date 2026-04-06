<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Servis | Ice Petugas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --ice-bg: #f8fbff;
            --ice-primary: #00d2ff;
            --ice-secondary: #3a7bd5;
            --frost-white: rgba(255, 255, 255, 0.9);
        }

        body {
            background: linear-gradient(135deg, #f0f8ff 0%, #e6effd 100%);
            font-family: 'Nunito', sans-serif;
        }

        .ice-card {
            background: var(--frost-white);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 25px rgba(154, 182, 212, 0.2);
        }

        .status-badge {
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .bg-rusak { background: rgba(231, 74, 59, 0.1); color: #e74a3b; border: 1px solid #e74a3b; }
        .bg-servis { background: rgba(246, 194, 62, 0.1); color: #f6c23e; border: 1px solid #f6c23e; }

        .btn-ice {
            background: linear-gradient(135deg, var(--ice-primary), var(--ice-secondary));
            color: white;
            border: none;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-ice:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 5px 15px rgba(58, 123, 213, 0.3);
        }
    </style>
</head>
<body>

<div class="container-fluid p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Maintenance Control 🛠️</h1>
            <p class="text-muted small">Kelola jadwal perbaikan armada yang rusak.</p>
        </div>
        <span class="badge badge-light p-2 shadow-sm"><i class="fas fa-user-cog mr-2"></i> Role: Petugas</span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card ice-card shadow mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tools mr-2"></i>Daftar Unit Perlu Servis</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-muted">
                                <tr>
                                    <th>Unit Mobil</th>
                                    <th>No. Polisi</th>
                                    <th>Status Saat Ini</th>
                                    <th class="text-center">Tindakan Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $unit)
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $unit->mobil->merek }}</div>
                                        <small>{{ $unit->mobil->model }} - {{ $unit->warna }}</small>
                                    </td>
                                    <td><span class="text-monospace font-weight-bold">{{ $unit->no_polisi }}</span></td>
                                    <td>
                                        <span class="status-badge {{ $unit->status == 'rusak' ? 'bg-rusak' : 'bg-servis' }}">
                                            {{ $unit->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($unit->status == 'rusak')
                                            <form action="/servis/update/{{ $unit->id }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="servis">
                                                <button type="submit" class="btn btn-sm btn-ice px-3">
                                                    <i class="fas fa-wrench mr-1"></i> Mulai Perbaikan
                                                </button>
                                            </form>
                                        @else
                                            <form action="/servis/update/{{ $unit->id }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="tersedia">
                                                <button type="submit" class="btn btn-sm btn-success px-3 shadow-sm" style="border-radius:10px;">
                                                    <i class="fas fa-check-circle mr-1"></i> Selesai & Ready
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-glass-cheers fa-3x mb-3 text-light"></i><br>
                                        Semua armada dalam kondisi prima! Tidak ada jadwal servis.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>