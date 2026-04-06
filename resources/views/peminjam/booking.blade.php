<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Pengembalian Armada ❄️</title>
    
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --ice-bg: #f0f7ff;
            --ice-primary: #00d2ff;
            --ice-secondary: #3a7bd5;
            --ice-dark: #1e3c72;
        }

        body { 
            background-color: var(--ice-bg);
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden;
            color: #444;
        }

        #snow-canvas {
            position: fixed;
            top: 0; left: 0; 
            width: 100%; height: 100%;
            pointer-events: none; 
            z-index: -1; 
        }

        .btn-dashboard {
            background: rgba(30, 60, 114, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(30, 60, 114, 0.2);
            color: var(--ice-dark) !important;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 700;
            position: absolute;
            top: 25px; left: 25px;
            text-decoration: none !important;
            z-index: 10;
        }

        .main-card {
            border: none !important;
            border-radius: 30px !important;
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05) !important;
            margin-top: 80px;
            padding: 20px !important;
        }

        .unit-card {
            background: white;
            border-radius: 25px;
            padding: 20px;
            border: 1px solid #edf2f7;
            transition: transform 0.3s;
            height: 100%;
        }

        .unit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        /* --- Ice Ticket Styling --- */
        .ticket-wrapper {
            max-width: 100%;
            perspective: 1000px;
        }

        .ice-ticket {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 20px;
            color: white;
            padding: 15px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .ticket-img-container {
            width: 100%;
            height: 120px;
            background: rgba(0,0,0,0.2);
            border-radius: 15px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .ticket-img-container img {
            width: 100%; height: 100%; object-fit: cover;
        }

        .license-plate {
            display: inline-block;
            background: white;
            color: #1e3c72;
            padding: 2px 12px;
            border-radius: 8px;
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 0.9rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .custom-file-upload {
            border: 2px dashed var(--ice-primary);
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            background: #f0faff;
            cursor: pointer;
            display: block;
        }

        .btn-kirim {
            background: linear-gradient(to right, var(--ice-secondary), var(--ice-primary));
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-weight: 700;
            color: white;
        }
    </style>
</head>
<body>

    <canvas id="snow-canvas"></canvas>

    <a href="{{ url('/dashboard') }}" class="btn-dashboard">
        <i class="fas fa-chevron-left mr-2"></i> KEMBALI
    </a>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card main-card">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-car-side mr-2 text-primary"></i>Armada Anda
                        </h5>
                        @if($bookings->count() > 0)
                        <button class="btn btn-sm btn-primary rounded-pill px-3" onclick="downloadAll()">
                            <i class="fas fa-download mr-1"></i> Unduh Semua Kartu
                        </button>
                        @endif
                    </div>

                    <div class="card-body">
    <div class="row">
        @forelse($bookings as $booking)
            {{-- 1. Cek Status Booking --}}
          @if($booking->status == 'disetujui' || $booking->status == 'disewa')

          @php
            $unitsKeluar = $booking->mobil_units->filter(function($u) {
                // Mencari kata 'tidak' di dalam status untuk menghindari masalah spasi/enter di DB
                return str_contains(strtolower($u->status), 'tidak');
            });
        @endphp
                
                {{-- 2. Loop Unit yang sedang tidak tersedia (sedang disewa) --}}
              @foreach($unitsKeluar as $unit)
                    <div class="col-md-6 mb-4">
                        <div class="unit-card border-left-primary shadow-sm">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="ticket-wrapper" id="captureArea{{ $unit->id }}">
                                        <div class="ice-ticket" id="cardContent{{ $unit->id }}">
                                            <div class="d-flex justify-content-between mb-2">
                                                <small class="font-weight-bold opacity-75">UNIT {{ $loop->iteration }}</small>
                                                <span style="background:{{ $unit->warna }}; width:12px; height:12px; border-radius:50%; border:1px solid white;"></span>
                                            </div>
                                            <div class="ticket-img-container text-center">
                                                <img src="{{ asset('storage/' . $unit->foto_unit) }}" onerror="this.src='https://placehold.co/300x200/1e3c72/ffffff?text=Car+Ready'">
                                            </div>
                                            <div class="text-center">
                                                <div class="license-plate mb-1">{{ $unit->no_polisi }}</div>
                                                <div class="small">{{ $booking->mobil->merek }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-link btn-sm btn-block mt-2 text-decoration-none" onclick="downloadTicket('{{ $unit->id }}')">
                                        <i class="fas fa-file-download mr-1"></i> Simpan Kartu
                                    </button>
                                </div>
                                
                                <div class="col-sm-6 border-left">
                                    <h6 class="font-weight-bold mt-2">{{ $booking->mobil->merek }}</h6>
                                    <p class="small text-muted mb-3">{{ $booking->mobil->model }}</p>
                                    
                                    <div class="alert alert-light p-2 mb-3 border">
                                        <small class="text-dark d-block"><i class="far fa-calendar-alt mr-1"></i> Batas Sewa:</small>
                                        <b class="small">{{ \Carbon\Carbon::parse($booking->tgl_selesai)->format('d M Y') }}</b>
                                    </div>

                                    <button class="btn btn-kirim btn-block btn-sm shadow-sm" data-toggle="modal" data-target="#modalKembali{{ $unit->id }}">
                                        KEMBALIKAN <i class="fas fa-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalKembali{{ $unit->id }}" tabindex="-1" role="dialog" aria-labelledby="label{{ $unit->id }}" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg" style="border-radius: 25px; border: none;">
            <form action="{{ route('pengembalian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sewa_id" value="{{ $booking->id }}">
                <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-primary">
                        <i class="fas fa-clipboard-check mr-2"></i>Laporan Kembali - {{ $unit->no_polisi }}
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Kondisi Armada:</label>
                        <div class="d-flex">
                            <div class="custom-control custom-radio mr-4">
                                <input type="radio" id="bagus{{ $unit->id }}" name="kondisi" value="bagus" class="custom-control-input" checked onclick="toggleAlasan('{{ $unit->id }}', false)">
                                <label class="custom-control-label text-success" for="bagus{{ $unit->id }}"><i class="fas fa-check-circle mr-1"></i> Bagus</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="rusak{{ $unit->id }}" name="kondisi" value="rusak" class="custom-control-input" onclick="toggleAlasan('{{ $unit->id }}', true)">
                                <label class="custom-control-label text-danger" for="rusak{{ $unit->id }}"><i class="fas fa-exclamation-triangle mr-1"></i> Rusak</label>
                            </div>
                        </div>
                    </div>

                    <div id="wrapperAlasan{{ $unit->id }}" class="form-group mb-3 d-none animate__animated animate__fadeIn">
                        <label class="small font-weight-bold text-danger">Detail Kerusakan:</label>
                        <textarea name="alasan_rusak" class="form-control form-control-sm" rows="2" placeholder="Jelaskan bagian yang rusak..."></textarea>
                    </div>

                    <hr class="my-3">

                    <p class="small text-muted mb-2">Unggah kembali kartu digital sebagai validasi:</p>
                    <label for="uploadCard{{ $unit->id }}" class="custom-file-upload w-100" id="labelUpload{{ $unit->id }}">
                        <i class="fas fa-upload text-primary mb-2"></i>
                        <p class="mb-0 small" id="fileName{{ $unit->id }}">Pilih Gambar Kartu</p>
                    </label>
                    <input type="file" name="bukti_kartu" id="uploadCard{{ $unit->id }}" class="d-none" accept="image/*" required onchange="validateUpload('{{ $unit->id }}')">
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="btnFinal{{ $unit->id }}" class="btn btn-kirim btn-block shadow-sm" disabled>
                        KIRIM LAPORAN SEKARANG
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
                @endforeach {{-- Penutup foreach unit --}}
            @endif {{-- Penutup if status booking --}}
        @empty {{-- Jika tidak ada data di $bookings --}}
            <div class="col-12 text-center py-5">
                <i class="fas fa-car-crash fa-3x text-light mb-3"></i>
                <p class="text-muted">Belum ada armada yang aktif.</p>
            </div>
        @endforelse
    </div>
</div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
    <script>
        function downloadTicket(id) {
            const card = document.getElementById('cardContent' + id);
            html2canvas(card, { scale: 2, useCORS: true }).then(canvas => {
                const link = document.createElement('a');
                link.download = `Key-${id}.png`;
                link.href = canvas.toDataURL("image/png");
                link.click();
            });
        }

        function downloadAll() {
            const buttons = document.querySelectorAll('[onclick^="downloadTicket"]');
            buttons.forEach((btn, i) => {
                setTimeout(() => btn.click(), i * 800);
            });
        }

        function validateUpload(id) {
            const input = document.getElementById('uploadCard' + id);
            const fileNameDisplay = document.getElementById('fileName' + id);
            const btnFinal = document.getElementById('btnFinal' + id);
            if (input.files.length > 0) {
                fileNameDisplay.innerText = input.files[0].name;
                btnFinal.disabled = false;
            }
        }

        // Efek Salju Sederhana
        const canvas = document.getElementById('snow-canvas');
        const ctx = canvas.getContext('2d');
        let flakes = [];
        function initSnow() {
            canvas.width = window.innerWidth; canvas.height = window.innerHeight;
            flakes = [];
            for (let i = 0; i < 50; i++) flakes.push({ x: Math.random()*canvas.width, y: Math.random()*canvas.height, s: Math.random()*2, d: Math.random()*0.5 });
        }
        function drawSnow() {
            ctx.clearRect(0,0,canvas.width,canvas.height);
            ctx.fillStyle = "rgba(255,255,255,0.3)";
            for (let f of flakes) {
                ctx.beginPath(); ctx.arc(f.x, f.y, f.s, 0, Math.PI*2); ctx.fill();
                f.y += f.d; if (f.y > canvas.height) f.y = -5;
            }
            requestAnimationFrame(drawSnow);
        }
        window.addEventListener('resize', initSnow);
        initSnow(); drawSnow();

        function toggleAlasan(id, isRusak) {
    const wrapper = document.getElementById('wrapperAlasan' + id);
    const textarea = wrapper.querySelector('textarea');
    
    if (isRusak) {
        wrapper.classList.remove('d-none');
        textarea.setAttribute('required', 'required');
    } else {
        wrapper.classList.add('d-none');
        textarea.removeAttribute('required');
        textarea.value = ''; // Reset isi jika berubah jadi bagus
    }
}

    // Perbaikan agar modal tidak gelap (memindah modal ke body agar tidak tertutup backdrop-filter)
    $(document).ready(function() {
        $('.modal').appendTo("body");
    });
    </script>
</body>
</html>