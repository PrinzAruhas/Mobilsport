<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Konfirmasi Pembayaran ❄️</title>
    
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root { 
            --primary: #4e73df; 
            --success: #1cc88a; 
            --warning: #f6c23e;
            --glass: rgba(255, 255, 255, 0.9); 
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        body { 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
            font-family: 'Nunito', sans-serif; 
            min-height: 100vh; 
            color: #2d3436;
        }

        /* Snow Effect */
        .snow-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; }
        .snowflake { position: absolute; background: white; border-radius: 50%; opacity: 0.8; top: -10%; animation: fall linear infinite; }
        @keyframes fall { to { transform: translateY(110vh) translateX(20px); } }

        .main-content { position: relative; z-index: 1; }

        /* Card Styling */
        .glass-card { 
            background: var(--glass); 
            backdrop-filter: blur(20px) saturate(180%); 
            border-radius: var(--radius-lg); 
            border: 1px solid rgba(255,255,255,0.7); 
            box-shadow: 0 20px 50px rgba(0,0,0,0.1); 
            overflow: hidden; 
        }

        /* Payment Option Styling */
        .payment-radio { display: none; }
        .payment-content { 
            border: 2px solid #edf2f7; 
            border-radius: var(--radius-md); 
            padding: 18px; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            cursor: pointer; 
            background: #fff;
        }
        .payment-content:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .payment-radio:checked + .payment-content { 
            border-color: var(--primary); 
            background: #f8faff; 
            box-shadow: 0 0 0 1px var(--primary);
        }

        .check-badge { 
            width: 24px; height: 24px; border-radius: 50%; 
            background: var(--primary); color: white; 
            display: none; align-items: center; justify-content: center; 
            font-size: 11px; transition: 0.3s;
        }
        .payment-radio:checked + .payment-content .check-badge { display: flex; animation: zoomIn 0.3s; }

        /* Upload Box */
        .upload-box { 
            border: 2px dashed #cbd5e0; 
            border-radius: var(--radius-md); 
            padding: 20px; 
            transition: 0.3s; 
            background: rgba(255,255,255,0.6); 
            cursor: pointer; 
        }
        .upload-box:hover { border-color: var(--primary); background: #fff; }

        /* Unit List Scrollbar */
        .units-list-container::-webkit-scrollbar { width: 5px; }
        .units-list-container::-webkit-scrollbar-track { background: transparent; }
        .units-list-container::-webkit-scrollbar-thumb { background: #cbd5e0; border-radius: 10px; }

        /* Modern Receipt */
        .receipt-paper {
            background: #fff;
            padding: 30px;
            position: relative;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            color: #333;
        }
        .receipt-paper::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 6px;
            background: var(--primary); border-radius: 8px 8px 0 0;
        }
        .receipt-paper::after {
            content: ""; position: absolute; bottom: -12px; left: 0; width: 100%; height: 12px;
            background: radial-gradient(circle, transparent, transparent 50%, #fff 50%, #fff 100%) 0 0 / 12px 24px repeat-x;
        }

        /* Stepper UI */
        .stepper-wrapper { display: flex; justify-content: space-between; margin-bottom: 30px; position: relative; }
        .step { z-index: 2; text-align: center; font-size: 0.75rem; font-weight: 700; color: #cbd5e0; }
        .step.active { color: var(--primary); }
        .step-circle { width: 30px; height: 30px; border-radius: 50%; background: #fff; border: 2px solid #cbd5e0; margin: 0 auto 5px; display: flex; align-items: center; justify-content: center; }
        .step.active .step-circle { border-color: var(--primary); background: var(--primary); color: white; }

        @media print {
            body * { visibility: hidden; }
            #areaStruk, #areaStruk * { visibility: visible; }
            #areaStruk { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; }
            .btn, .close, .modal-header { display: none !important; }
        }
    </style>
</head>
<body>

<div class="snow-container" id="snow"></div>

<div class="container py-5 main-content">
    <div class="row justify-content-center">
        <div class="col-xl-11">
            <div class="glass-card">
                <div class="row no-gutters">
                    
                    <div class="col-lg-7 p-4 p-md-5">
                        <div class="mb-4">
                            <h2 class="font-weight-800 text-dark mb-1">Konfirmasi Pembayaran 💳</h2>
                            <p class="text-muted">Selesaikan pembayaran Anda untuk mengunci jadwal sewa.</p>
                        </div>

                        <div class="stepper-wrapper">
                            <div class="step active"><div class="step-circle">1</div>Identitas</div>
                            <div class="step active"><div class="step-circle">2</div>Metode</div>
                            <div class="step"><div class="step-circle">3</div>Verifikasi</div>
                        </div>

                        <form action="{{ route('sewa.store') }}" method="POST" enctype="multipart/form-data" id="rentalForm">
                            @csrf
                            @foreach($mobils as $item)
                                <input type="hidden" name="unit_ids[]" value="{{ $item->id }}">
                            @endforeach
                            <input type="hidden" name="tgl_mulai" value="{{ $tgl_mulai }}">
                            <input type="hidden" name="durasi" value="{{ $durasi }}">
                            <input type="hidden" name="total_harga" value="{{ $total_final }}">

                            <h6 class="font-weight-bold text-dark mb-3 small text-uppercase" style="letter-spacing: 1px;">1. Dokumen Persyaratan</h6>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="upload-box text-center" onclick="document.getElementById('foto_ktp').click();">
                                        <div class="mb-2"><i class="fas fa-id-card fa-2x text-primary"></i></div>
                                        <p class="small mb-0 font-weight-bold" id="ktp-filename">UNGGAH KTP</p>
                                        <input type="file" name="foto_ktp" id="foto_ktp" class="d-none" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="upload-box text-center" onclick="document.getElementById('foto_sim').click();">
                                        <div class="mb-2"><i class="fas fa-address-card fa-2x text-primary"></i></div>
                                        <p class="small mb-0 font-weight-bold" id="sim-filename">UNGGAH SIM A</p>
                                        <input type="file" name="foto_sim" id="foto_sim" class="d-none" accept="image/*" required>
                                    </div>
                                </div>
                            </div>

                            <h6 class="font-weight-bold text-dark mb-3 small text-uppercase" style="letter-spacing: 1px;">2. Pilih Metode Pembayaran</h6>
                            
                            <div class="payment-options mb-4">
                                <label class="w-100 mb-2">
                                    <input type="radio" name="payment_method" value="transfer_bank" class="payment-radio" checked onclick="handlePaymentChange('online')">
                                    <div class="payment-content d-flex align-items-center justify-content-between">
                                        <div><i class="fas fa-university mr-3 text-primary"></i><b>Transfer Bank BCA</b></div>
                                        <div class="check-badge"><i class="fas fa-check"></i></div>
                                    </div>
                                </label>

                                <div id="bank-detail" class="p-3 mb-3 bg-white border rounded-lg shadow-sm" style="display: none;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="text-muted d-block">Nomor Rekening:</small>
                                            <span class="font-weight-bold text-dark h5 mb-0">8820-XXXX-XXXX</span>
                                            <small class="text-muted d-block">A/N MobiRent Indonesia</small>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('8820-XXXX-XXXX', 'Nomor rekening BCA')">Salin</button>
                                    </div>
                                </div>

                                <label class="w-100 mb-2">
                                    <input type="radio" name="payment_method" value="ewallet" class="payment-radio" onclick="handlePaymentChange('ewallet')">
                                    <div class="payment-content d-flex align-items-center justify-content-between">
                                        <div><i class="fas fa-wallet mr-3 text-primary"></i><b>E-Wallet (DANA/OVO)</b></div>
                                        <div class="check-badge"><i class="fas fa-check"></i></div>
                                    </div>
                                </label>

                                <div id="ewallet-detail" class="p-3 mb-3 bg-white border rounded-lg shadow-sm" style="display: none;">
                                    <div class="btn-group btn-group-toggle w-100 mb-3" data-toggle="buttons">
                                        <label class="btn btn-outline-primary btn-sm active"><input type="radio" name="ewallet_provider" value="DANA" checked> DANA</label>
                                        <label class="btn btn-outline-primary btn-sm"><input type="radio" name="ewallet_provider" value="OVO"> OVO</label>
                                    </div>
                                    <div class="alert alert-info py-2 small">No. Tujuan: <b>0812-3456-7890</b></div>
                                    <input type="number" name="ewallet_phone" class="form-control" placeholder="Masukkan Nomor HP Anda">
                                </div>

                                <label class="w-100 mb-3">
                                    <input type="radio" name="payment_method" value="cod" class="payment-radio" onclick="handlePaymentChange('offline')">
                                    <div class="payment-content d-flex align-items-center justify-content-between">
                                        <div><i class="fas fa-handshake mr-3 text-primary"></i><b>Bayar di Lokasi (COD)</b></div>
                                        <div class="check-badge"><i class="fas fa-check"></i></div>
                                    </div>
                                </label>
                            </div>

                          <div id="struk-section" class="mb-4" style="display:none;">
    <h6 class="font-weight-bold text-dark mb-3 small text-uppercase" style="letter-spacing: 1px;">3. Unggah Bukti Transfer</h6>
    
    <div class="upload-box text-center" id="drop-zone" onclick="document.getElementById('struk_pembayaran').click();">
        <div id="preview-container" class="mb-2 d-none">
            <img id="image-preview" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 10px;" class="mb-2 shadow-sm">
        </div>
        <div id="upload-placeholder">
            <i class="fas fa-file-invoice-dollar fa-3x text-primary mb-3"></i>
            <p class="small mb-1 font-weight-bold text-dark">Klik atau Tarik File ke Sini</p>
            <p class="text-muted small mb-0">Format: JPG, PNG, atau PDF (Maks. 2MB)</p>
        </div>
        <input type="file" name="struk_pembayaran" id="struk_pembayaran" class="d-none" accept="image/*,application/pdf">
    </div>
    
    <div id="file-info" class="mt-2 text-center d-none">
        <span class="badge badge-success py-2 px-3">
            <i class="fas fa-check-circle mr-1"></i> <span id="filename-display">file-name.jpg</span>
        </span>
        <button type="button" class="btn btn-sm text-danger ml-2" onclick="resetUpload()">Hapus</button>
    </div>

    <button type="button" id="btnSimulasiBayar" class="btn btn-success btn-block mt-3 py-2 font-weight-bold shadow-sm">
        <i class="fas fa-magic mr-2"></i> Bayar Sekarang (Simulasi)
    </button>
</div>

                            <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-lg font-weight-bold shadow py-3" style="border-radius: 12px;">
                                Konfirmasi Sewa <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </form>
                    </div>

                    <div class="col-lg-5 bg-light border-left p-4 p-md-5 d-flex flex-column">
                        <div class="mb-4">
                            <h5 class="font-weight-bold text-dark">Ringkasan Pesanan</h5>
                            <p class="text-muted small">Detail kendaraan yang Anda pilih.</p>
                        </div>

                        <div class="units-list-container mb-4" style="max-height: 380px; overflow-y: auto;">
                            @foreach($mobils as $item)
                            <div class="card mb-3 border-0 shadow-sm" style="border-radius: 15px;">
                                <div class="card-body p-3 d-flex align-items-center">
                                   <img src="{{ asset('storage/' . $item->foto_unit) }}" 
     class="rounded shadow-sm mr-3" 
     style="width: 80px; height: 55px; object-fit: cover;"
     onerror="this.onerror=null;this.src='https://placehold.co/160x110/eef7fb/a2d2ff?text=No+Image';">
                                    <div>
                                        <h6 class="font-weight-bold mb-0">{{ $item->merek }}</h6>
                                        <span class="badge badge-light border">{{ $item->no_polisi }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                      <div class="receipt-container mt-auto p-4 bg-white shadow-sm" style="border-radius: 20px; border: 1px solid #e3e6f0;">
    <div class="d-flex justify-content-between mb-2">
        <span class="text-muted small">Durasi Sewa</span>
        <span class="font-weight-bold">{{ $durasi }} Hari</span>
    </div>

    {{-- 1. DISKON UNIT (FLASH SALE) --}}
    @if($mobil->diskon > 0)
    <div class="d-flex justify-content-between mb-2">
        <span class="text-danger small font-weight-bold">Flash Sale ({{ $mobil->diskon }}%)</span>
        <span class="text-danger font-weight-bold">
            @php
                // Hitung potongan unit: (Harga Satuan * % * Durasi * Jumlah Mobil)
                $potonganUnit = ($mobil->harga_sewa * ($mobil->diskon / 100)) * $durasi * count($mobils);
            @endphp
            - Rp{{ number_format($potonganUnit, 0, ',', '.') }}
        </span>
    </div>
    @endif

    {{-- 2. DISKON KODE PROMO (REDEEM) --}}
    @php
        $promo = session('applied_promo');
        $potonganRedeem = 0;
        
        // Cek apakah ada diskonRedeem yang sudah kita hitung sebelumnya (misal dari Controller atau PHP block atas)
        if (isset($diskonRedeem) && $diskonRedeem > 0) {
            // Rumus: Harga setelah diskon unit dipotong persen promo
            $hargaSetelahUnit = $mobil->harga_sewa - ($mobil->harga_sewa * ($mobil->diskon / 100));
            $potonganRedeem = ($hargaSetelahUnit * ($diskonRedeem / 100)) * $durasi * count($mobils);
        }
    @endphp

    @if($potonganRedeem > 0)
    <div class="d-flex justify-content-between mb-2">
        <span class="text-success small font-weight-bold">
            Kode Promo ({{ $promo['code'] ?? 'REDEEM' }})
        </span>
        <span class="text-success font-weight-bold">
            - Rp{{ number_format($potonganRedeem, 0, ',', '.') }}
        </span>
    </div>
    @endif

    <div class="d-flex justify-content-between mb-2">
        <span class="text-muted small">Admin Fee</span>
        <span class="font-weight-bold text-dark">Rp{{ number_format($biaya_admin, 0, ',', '.') }}</span>
    </div>
    
    <hr style="border-top: 1px dashed #ccc;">
    
    <div class="d-flex justify-content-between align-items-end">
        <div>
            <small class="text-muted d-block">Total Bayar</small>
            {{-- Pastikan $total_final di Controller sudah dikurangi $potonganRedeem juga --}}
            <span class="h3 font-weight-bold text-primary mb-0">
                Rp{{ number_format($total_final, 0, ',', '.') }}
            </span>
        </div>
        <span class="badge badge-success mb-2">Tax Incl.</span>
    </div>
</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalStrukVisual" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0">
                <div class="receipt-paper mx-auto" style="max-width: 380px;" id="areaStruk">
                    <div class="text-center mb-4">
                        <div class="bg-primary d-inline-block p-2 rounded-circle mb-2 text-white">
                            <i class="fas fa-car-side fa-lg"></i>
                        </div>
                        <h5 class="font-weight-800 mb-0">MOBRENT OFFICIAL</h5>
                        <small class="text-muted">ID Transaksi: TRX-{{ rand(100000, 999999) }}</small>
                    </div>
                    
                    <div class="row small mb-2">
                        <div class="col-6 text-muted">Metode Pembayaran</div>
                        <div class="col-6 text-right font-weight-bold" id="struk-metode">-</div>
                        <div class="col-6 text-muted">Waktu Transaksi</div>
                        <div class="col-6 text-right font-weight-bold">{{ date('d/m/Y H:i') }}</div>
                    </div>

                    <div style="border-top: 1px dashed #eee; margin: 15px 0;"></div>
                    
                    <div class="small">
                        <p class="font-weight-bold mb-2">DAFTAR UNIT:</p>
                        @foreach($mobils as $item)
                        <div class="d-flex justify-content-between mb-1">
                            <span>{{ $item->merek }} <small class="text-muted">({{ $item->no_polisi }})</small></span>
                            <span>Ready</span>
                        </div>
                        @endforeach
                    </div>

                    <div style="border-top: 1px dashed #eee; margin: 15px 0;"></div>
<div class="d-flex justify-content-between align-items-center py-2">
    <div class="d-flex flex-column">
        <span class="font-weight-bold text-uppercase" style="letter-spacing: 1px;">TOTAL BAYAR</span>
        
        {{-- Menghitung total penghematan (Diskon Unit + Diskon Redeem) --}}
        @php
            $totalHemat = ($potonganUnit ?? 0) + ($potonganRedeem ?? 0);
        @endphp

        @if($totalHemat > 0)
            <small class="text-success font-weight-bold">
                <i class="fas fa-check-circle mr-1"></i> Berhasil hemat Rp{{ number_format($totalHemat, 0, ',', '.') }}
            </small>
        @endif
    </div>
    
    <div class="text-right">
        {{-- Angka Total Final --}}
        <span class="h4 font-weight-bold text-primary mb-0" style="font-size: 1.75rem;">
            Rp{{ number_format($total_final, 0, ',', '.') }}
        </span>
        <small class="d-block text-muted" style="font-size: 0.7rem;">Sudah termasuk pajak & biaya admin</small>
    </div>
</div>

                    <div class="text-center mt-4">
                        <div style="height: 40px; background: repeating-linear-gradient(90deg, #333, #333 2px, #fff 2px, #fff 4px); margin-bottom: 10px;"></div>
                        <p class="small text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> PEMBAYARAN BERHASIL VERIFIKASI</p>
                    </div>
                </div>
                
                <div class="text-center mt-4 no-print">
                    <button type="button" class="btn btn-light rounded-pill px-4 mr-2" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-warning rounded-pill px-4 font-weight-bold shadow" onclick="window.print()">
                        <i class="fas fa-print mr-1"></i> Cetak Struk
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInstruksi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold">Langkah Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="list-instruksi" class="p-3 bg-light rounded-lg small mb-3"></div>
                <div class="alert alert-warning py-2 small border-0">
                    <i class="fas fa-info-circle mr-1"></i> Setelah transfer, klik tombol hijau di bawah untuk simulasi verifikasi.
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" id="confirmSimulation" class="btn btn-success btn-block font-weight-bold py-2">SAYA SUDAH BAYAR</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sandboxModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <i class="fas fa-check-circle fa-4x text-success"></i>
                </div>
                <h4 class="font-weight-bold">Data Berhasil Dikirim!</h4>
                <p class="text-muted small">Mobil Anda akan disiapkan. Teknisi kami akan menghubungi Anda sebentar lagi.</p>
                <button class="btn btn-primary px-5 rounded-pill" onclick="window.location.reload()">Selesai</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Snow Effect
    function createSnow() {
        const container = document.getElementById('snow');
        if(!container) return;
        for (let i = 0; i < 30; i++) {
            const snowflake = document.createElement('div');
            snowflake.className = 'snowflake';
            const size = Math.random() * 4 + 2 + 'px';
            snowflake.style.width = size; snowflake.style.height = size;
            snowflake.style.left = Math.random() * 100 + '%';
            snowflake.style.animationDuration = Math.random() * 3 + 2 + 's';
            snowflake.style.animationDelay = Math.random() * 2 + 's';
            container.appendChild(snowflake);
        }
    }
    createSnow();

    function validateForm() {
        const method = $('input[name="payment_method"]:checked').val();
        const strukFile = $('#struk_pembayaran')[0].files[0];
        const btnSubmit = $('#btnSubmit');
        
        if (method === 'cod') {
            btnSubmit.prop('disabled', false).addClass('btn-primary').removeClass('btn-secondary');
        } else {
            const isReady = !!strukFile;
            btnSubmit.prop('disabled', !isReady).toggleClass('btn-primary', isReady).toggleClass('btn-secondary', !isReady);
        }
    }

    function handlePaymentChange(type) {
        $('#bank-detail, #ewallet-detail, #struk-section').hide();
        
        if (type === 'online') {
            $('#bank-detail, #struk-section').slideDown(300);
        } else if (type === 'ewallet') {
            $('#ewallet-detail, #struk-section').slideDown(300);
        }
        
        validateForm();
    }

    $('#btnSimulasiBayar').on('click', function() {
        const method = $('input[name="payment_method"]:checked').val();
        const list = $('#list-instruksi').empty();
        if(method === 'transfer_bank') {
            list.append('<p class="mb-1">1. Buka m-BCA > m-Transfer</p><p class="mb-0">2. Transfer ke <b>8820-XXXX-XXXX</b></p>');
        } else {
            list.append('<p class="mb-1">1. Buka Aplikasi E-Wallet</p><p class="mb-0">2. Kirim ke <b>0812-3456-7890</b></p>');
        }
        $('#modalInstruksi').modal('show');
    });

    $('#confirmSimulation').on('click', function() {
        $('#modalInstruksi').modal('hide');
        const btn = $('#btnSimulasiBayar');
        btn.addClass('disabled').html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...');

        setTimeout(() => {
            const methodLabel = ($('input[name="payment_method"]:checked').val() === 'transfer_bank') ? "BCA Transfer" : "E-Wallet";
            $('#struk-metode').text(methodLabel);
            $('#modalStrukVisual').modal('show');
            
            btn.removeClass('btn-success').addClass('btn-secondary disabled')
               .html('<i class="fas fa-check-circle mr-2"></i> Pembayaran Terverifikasi');
            
            $('#struk-filename').html('<i class="fas fa-check-circle text-success mr-1"></i> Struk Digital Terlampir').css('color', '#1cc88a');
            $('#btnSubmit').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
        }, 1500);
    });

    function copyToClipboard(text, msg) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({ title: 'Tersalin!', text: msg, icon: 'success', timer: 1500, showConfirmButton: false });
        });
    }

    // 5. Form Submission (AJAX) - Perbaikan
$(document).ready(function() {
    // 1. PENGELOLAAN UI: Deteksi file yang diupload agar muncul "DOKUMEN OK"
    $('#foto_ktp, #foto_sim').on('change', function() {
        const id = $(this).attr('id');
        const label = id === 'foto_ktp' ? '#ktp-filename' : '#sim-filename';
        
        if (this.files && this.files[0]) {
            $(label).text('DOKUMEN OK').css('color', '#1cc88a');
            $(this).closest('.upload-box').css('border-color', '#1cc88a');
        }
    });

    // 2. PENGIRIMAN DATA: AJAX Submission
    $('#rentalForm').on('submit', function(e) {
        e.preventDefault();
        
        // Cek kembali di sisi client apakah file sudah ada
        if ($('#foto_ktp')[0].files.length === 0 || $('#foto_sim')[0].files.length === 0) {
            Swal.fire('Oops!', 'Mohon lampirkan foto KTP dan SIM.', 'warning');
            return;
        }

        let formData = new FormData(this);
        let btnSubmit = $('#btnSubmit');
        let originalText = btnSubmit.html();

        btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...');

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false, // Wajib untuk file
            contentType: false, // Wajib untuk file
            success: function(response) {
                if(response.success) {
                    $('#sandboxModal').modal('show');
                } else {
                    Swal.fire('Gagal!', response.message, 'error');
                    btnSubmit.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr) {
                btnSubmit.prop('disabled', false).html(originalText);
                let errorMessage = xhr.responseJSON?.message || "Terjadi kesalahan sistem.";
                Swal.fire('Gagal!', errorMessage, 'error');
            }
        });
    });
});
// Fungsi untuk preview gambar yang diupload
$('#struk_pembayaran').on('change', function() {
    const file = this.files[0];
    if (file) {
        // Tampilkan nama file
        $('#filename-display').text(file.name);
        $('#file-info').removeClass('d-none');
        $('#upload-placeholder').addClass('d-none');
        
        // Preview gambar jika tipe filenya image
        if (file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#preview-container').removeClass('d-none');
            }
            reader.readAsDataURL(file);
        }
        validateForm(); // Update status tombol submit
    }
});

// Fungsi untuk hapus file
function resetUpload() {
    $('#struk_pembayaran').val('');
    $('#file-info').addClass('d-none');
    $('#preview-container').addClass('d-none');
    $('#upload-placeholder').removeClass('d-none');
    validateForm();
}
</script>

</body>
</html>