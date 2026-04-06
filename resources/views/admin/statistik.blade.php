<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan MobiRent</title>
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <style>
        /* CSS STANDAR UNTUK LAYAR */
        body { background-color: #f8f9fc; color: #333; }
        .print-area { padding: 20px; }
        
        /* ATURAN KERAS UNTUK PRINT */
        @media print {
            /* Sembunyikan SEMUA elemen kecuali area laporan */
            body * { visibility: hidden; }
            .print-area, .print-area * { visibility: visible; }
            
            /* Posisikan area laporan ke paling atas kiri */
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                background: white !important;
            }

            /* Paksa tabel agar garisnya muncul */
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                border: 1px solid #000 !important;
            }
            th, td {
                border: 1px solid #000 !important;
                padding: 8px !important;
                color: black !important;
                visibility: visible !important;
            }
            
            /* Matikan efek shadow/glass yang bikin PDF berat/error */
            .card { border: none !important; box-shadow: none !important; }
            .d-print-none { display: none !important; }
        }
    </style>
</head>
<body>

<div class="container print-area">
    <div class="text-center mb-4">
        <h2 style="color: #003366; margin:0;">MOBILRENT CAR RENTAL</h2>
        <p>Jl. Es Kristal No. 123, Kota Salju | Telp: (021) 888-999</p>
        <hr style="border: 1px solid #000;">
        <h4>LAPORAN STATISTIK OPERASIONAL KENDARAAN</h4>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="text-right mb-4 d-print-none">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Klik untuk Cetak / Simpan PDF
        </button>
    </div>

    <div class="row mb-4">
        <div class="col-4"><strong>Total Sewa:</strong> {{ $totalTransaksi }}</div>
        <div class="col-4"><strong>Armada Siap:</strong> {{ $mobilTersedia }} Unit</div>
        <div class="col-4"><strong>Butuh Servis:</strong> {{ $mobilRusak }} Unit</div>
    </div>

    <table class="table table-bordered">
        <thead style="background-color: #eee !important;">
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Armada & No. Polisi</th>
                <th>Tgl Sewa</th>
                <th>Status</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanSewa as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->user->name }}</td>
                <td>
                    @foreach($item->mobil_units as $unit)
                        {{ $unit->mobil->merek }} [{{ $unit->no_polisi }}]<br>
                    @endforeach
                </td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>{{ strtoupper($item->status) }}</td>
                <td>{{ strtoupper($item->kondisi ?? 'BAGUS') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Data Tidak Ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col-8"></div>
        <div class="col-4 text-center">
            <p>Mengetahui,</p>
            <br><br><br>
            <p><strong>( ____________________ )</strong></p>
            <p>Manajer Operasional</p>
        </div>
    </div>
</div>

</body>
</html>