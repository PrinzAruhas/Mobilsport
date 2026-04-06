<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem Promo Code | Frosty App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.75);
            --glass-border: rgba(255, 255, 255, 0.4);
            --ice-primary: #0ea5e9;
            --ice-secondary: #6366f1;
            --dark-blue: #0f172a;
        }

        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass-container {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            transition: all 0.4s ease;
        }

        .redeem-input {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            padding: 15px 20px;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s;
            text-align: center;
            color: var(--dark-blue);
        }

        .redeem-input:focus {
            border-color: var(--ice-primary);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            outline: none;
        }

        .btn-redeem {
            background: linear-gradient(135deg, var(--ice-primary), var(--ice-secondary));
            border: none;
            border-radius: 15px;
            padding: 15px;
            color: white;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
            transition: all 0.3s;
        }

        .btn-redeem:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(99, 102, 241, 0.3);
            filter: brightness(1.1);
        }

        /* Tampilan Promo Terpakai (Disabled) */
        .available-promo.used {
            opacity: 0.6;
            cursor: not-allowed;
            filter: grayscale(0.8);
            background: #f8fafc;
        }

        .available-promo {
            background: #ffffff;
            border-radius: 15px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        .available-promo:not(.used):hover {
            border-color: var(--ice-primary);
            background: #f0f9ff;
        }
    </style>
</head>
<body>

<div class="container p-3">
    <div class="glass-container mx-auto text-center">
        <div class="promo-illustration" style="font-size: 4rem; background: linear-gradient(135deg, var(--ice-primary), var(--ice-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 20px;">
            <i class="fas fa-ticket-alt"></i>
        </div>
        
        <h2 class="font-weight-bold text-dark mb-1">Gunakan Promo ❄️</h2>
        <p class="text-muted mb-4">Masukkan kode voucher Anda untuk mendapatkan potongan harga spesial.</p>

        <form action="{{ route('booking.apply_promo') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <input type="text" name="promo_code" id="mainInput" 
                       class="form-control redeem-input shadow-sm" 
                       placeholder="KETIK KODE DISINI" required autocomplete="off">
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 rounded-pill small py-2 mb-3">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 rounded-pill small py-2 mb-3">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                </div>
            @endif

            <button type="submit" class="btn btn-redeem">
                <i class="fas fa-magic mr-2"></i> KLAIM DISKON
            </button>
        </form>

        <hr class="my-4" style="border-top: 1px dashed #cbd5e1;">

        <div class="text-left">
            <h6 class="small font-weight-bold text-muted text-uppercase mb-3">Promo Aktif Untukmu</h6>
            
         @php
    // Ambil promo terbaru
    $promos = \App\Models\Promo::latest()->take(3)->get();

    // Pastikan user login dan relasi ada, jika tidak kasih array kosong
    $usedPromoIds = [];
    if (auth()->check() && auth()->user()->usedPromos) {
        $usedPromoIds = auth()->user()->usedPromos->pluck('id')->toArray();
    }
@endphp

            @forelse($promos as $p)
                @php $isUsed = in_array($p->id, $usedPromoIds); @endphp
                
                <div class="available-promo d-flex align-items-center {{ $isUsed ? 'used' : '' }}" 
                     onclick="{{ $isUsed ? "alert('Anda sudah pernah menggunakan promo ini.')" : "useThisCode('$p->code')" }}">
                    
                    <div class="bg-dark text-white rounded px-2 py-1 mr-3 small font-weight-bold">
                        {{ $p->discount_percent }}%
                    </div>
                    
                    <div class="flex-grow-1">
                        <div class="font-weight-bold text-dark small">
                            {{ $p->code }}
                            @if($isUsed)
                                <span class="badge badge-secondary ml-1" style="font-size: 0.6rem;">TERPAKAI</span>
                            @endif
                        </div>
                        <small class="text-muted">
                            {{ $isUsed ? 'Sudah pernah diklaim' : 'Klik untuk menggunakan kode' }}
                        </small>
                    </div>
                    
                    <i class="fas {{ $isUsed ? 'fa-lock' : 'fa-chevron-right' }} text-light small"></i>
                </div>
            @empty
                <div class="text-center py-2">
                    <small class="text-muted italic">Belum ada promo tersedia.</small>
                </div>
            @endforelse
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-link btn-sm text-muted mt-4">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
</div>

<script>
    function useThisCode(code) {
        const input = document.getElementById('mainInput');
        input.value = code;
        input.focus();
        
        // Animasi feedback
        input.style.transform = "scale(1.05)";
        input.style.borderColor = "#0ea5e9";
        setTimeout(() => {
            input.style.transform = "scale(1)";
        }, 200);
    }
</script>

</body>
</html>