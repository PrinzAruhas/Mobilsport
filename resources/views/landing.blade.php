<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiIce - Premium Car Rental</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --ice-bg: #f8fbff;
            --ice-primary: #a2d2ff;
            --ice-secondary: #00d2ff;
            --ice-dark: #1e293b;
            --ice-text: #4a6d88;
            --ice-gradient: linear-gradient(135deg, #74b9ff 0%, #a2d2ff 100%);
            --glass-bg: rgba(255, 255, 255, 0.4);
            --glass-border: rgba(255, 255, 255, 0.7);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--ice-bg);
            color: var(--ice-text);
            margin: 0;
            overflow-x: hidden;
        }

        .bg-liquid {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 0% 0%, #e0f2fe 0%, transparent 50%),
                        radial-gradient(circle at 100% 100%, #dcf2ff 0%, transparent 50%);
            opacity: 0.8;
        }

        /* --- NAVBAR RESPONSIVE --- */
        .navbar {
            padding: 1.5rem 0;
            transition: 0.4s;
            z-index: 1000;
        }
        
        .navbar.scrolled {
            padding: 0.8rem 0;
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--ice-dark) !important;
        }

        .nav-link-auth {
            font-weight: 600;
            color: var(--ice-dark) !important;
            padding: 10px 20px !important;
            border-radius: 50px;
            transition: 0.3s;
        }

        /* Responsive Navbar Mobile */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                margin-top: 15px;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }
            .nav-link-auth { margin-bottom: 10px; text-align: center; }
        }

        .btn-signup {
            background: var(--ice-dark);
            color: white !important;
        }

        /* --- HERO SECTION RESPONSIVE --- */
        .hero-section {
            padding: 120px 0 60px;
        }

        .hero-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 2px solid var(--glass-border);
            border-radius: 40px; /* Diperkecil dari 60px agar pas di HP */
            padding: 40px 30px;
            box-shadow: 0 40px 80px rgba(162, 210, 255, 0.2);
        }

        @media (min-width: 992px) {
            .hero-card { padding: 80px 60px; border-radius: 60px; }
        }

        .hero-title {
            font-size: 2.5rem; /* Ukuran HP */
            font-weight: 800;
            line-height: 1.1;
            color: var(--ice-dark);
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        @media (min-width: 992px) {
            .hero-title { font-size: 4.5rem; letter-spacing: -2px; }
        }

        .text-ice-gradient {
            background: var(--ice-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- ABOUT SECTION --- */
        .about-section {
            padding: 80px 0;
        }
        
        .glass-box {
            background: white;
            padding: 30px;
            border-radius: 30px;
            border: 1px solid var(--ice-primary);
            height: 100%;
            transition: 0.3s;
        }

        .glass-box:hover {
            background: var(--ice-primary);
            color: white;
        }
        .glass-box:hover i, .glass-box:hover h5 { color: white !important; }

        /* --- CAR CARDS RESPONSIVE --- */
        .card-mobil {
            border-radius: 30px;
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 2px solid var(--glass-border);
            transition: 0.4s;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .car-thumb {
            height: 150px;
            width: 100%;
            object-fit: contain;
        }

        @media (min-width: 992px) {
            .car-thumb { height: 180px; }
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .img-hero-animated {
            animation: floating 5s ease-in-out infinite;
            filter: drop-shadow(0 30px 40px rgba(0,0,0,0.15));
        }
        /* --- VIDEO INTEGRATION --- */
.img-container {
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

.car-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0; /* Sembunyikan video secara default */
    transition: opacity 0.5s ease;
    border-radius: 20px;
}

.card-mobil:hover .car-video {
    opacity: 1; /* Tampilkan video saat kartu di-hover */
}

.card-mobil:hover .car-thumb {
    opacity: 0; /* Sembunyikan gambar saat video muncul */
}

.video-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(5px);
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    font-size: 12px;
    color: var(--ice-secondary);
}
    </style>
</head>
<body>

    <div class="bg-liquid"></div>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-snowflake text-info mr-2"></i>MOBI<span class="text-info">ICE</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
                <i class="fas fa-bars text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ml-auto align-items-center">
                    <a href="#" class="nav-link-auth">Home</a>
                    <a href="#about" class="nav-link-auth">About Us</a>
                    <a href="#katalog" class="nav-link-auth">Fleet</a>
                    <a href="{{ route('login') }}" class="nav-link-auth">Login</a>
                    <a href="{{ route('register') }}" class="nav-link-auth btn-signup shadow-sm">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="hero-card">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center text-lg-left">
                        <span class="badge badge-premium mb-3">Premium Rental 2026</span>
                        <h1 class="hero-title">
                            ELITE <br> <span class="text-ice-gradient">DRIVING.</span>
                        </h1>
                        <p class="lead mb-4 mx-auto mx-lg-0 text-muted" style="max-width: 450px;">
                            Jelajahi kenyamanan berkendara dengan armada pilihan. Kondisi unit yang dingin, bersih, dan berkelas.
                        </p>
                        <div class="d-flex flex-column flex-md-row justify-content-center justify-content-lg-start align-items-center">
                            <a href="#katalog" class="btn btn-dark btn-lg px-5 py-3 rounded-pill font-weight-bold mb-3 mb-md-0 mr-md-3 shadow-lg">Explore Fleet</a>
                            <a href="#about" class="text-dark font-weight-bold">Learn More <i class="fas fa-chevron-right ml-2" style="font-size: 12px;"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <img src="https://www.pngplay.com/wp-content/uploads/13/Toyota-Fortuner-Transparent-PNG.png" class="img-fluid img-hero-animated" alt="Hero Car">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section" id="about">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-12">
                    <h6 class="text-info font-weight-bold text-uppercase">Why MobiIce?</h6>
                    <h2 class="display-5 font-weight-bold text-dark">Layanan Kristal Kami</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="glass-box shadow-sm">
                        <i class="fas fa-shield-alt fa-3x text-info mb-4"></i>
                        <h5 class="font-weight-bold text-dark">Proteksi Penuh</h5>
                        <p class="small text-muted">Setiap perjalanan dilindungi asuransi premium dan layanan darurat 24 jam.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="glass-box shadow-sm">
                        <i class="fas fa-gem fa-3x text-info mb-4"></i>
                        <h5 class="font-weight-bold text-dark">Unit Premium</h5>
                        <p class="small text-muted">Kami hanya menyediakan mobil tahun terbaru dengan perawatan rutin standar pabrik.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="glass-box shadow-sm">
                        <i class="fas fa-snowflake fa-3x text-info mb-4"></i>
                        <h5 class="font-weight-bold text-dark">Ice Clean</h5>
                        <p class="small text-muted">Mobil dikirim dalam kondisi sterilisasi penuh dan AC yang sangat dingin menyegarkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5" id="katalog">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-info font-weight-bold text-uppercase" style="letter-spacing: 2px;">Premium Collection</h6>
                <h2 class="display-4 font-weight-bold text-dark">Armada <span class="text-info">Pilihan</span></h2>
            </div>

            <div class="row">
                @foreach($mobils as $mobil)
                <div class="col-lg-4 col-md-6">
    <div class="card-mobil">
        <div class="img-container p-4">
            @if($mobil->video)
                <div class="video-badge shadow-sm">
                    <i class="fas fa-play"></i>
                </div>
            @endif

            @if($mobil->gambar)
                <img src="{{ asset('storage/' . $mobil->gambar) }}" class="car-thumb" style="transition: 0.5s;" alt="{{ $mobil->model }}">
            @else
                <img src="https://via.placeholder.com/300x160?text=Premium+Unit" class="car-thumb" alt="Default">
            @endif

           @if($mobil->video)
    <video class="car-video" muted loop playsinline onmouseenter="enableSound(this)" onmouseleave="disableSound(this)">
        <source src="{{ asset('storage/' . $mobil->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@endif
        </div>

        <div class="p-4 pt-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="font-weight-bold text-dark mb-1">{{ $mobil->merek }}</h5>
                    <p class="text-muted small mb-0">{{ $mobil->model }} • {{ $mobil->transmisi }}</p>
                </div>
                <span class="badge badge-light border rounded-pill px-3 py-2 text-info">{{ $mobil->bahan_bakarnya }}</span>
            </div>

            <div class="bg-white rounded-pill p-3 d-flex justify-content-between align-items-center shadow-sm">
                <div>
                    <small class="text-muted d-block" style="font-size: 9px; font-weight: 800;">PER DAY</small>
                    <span class="h6 font-weight-bold text-dark mb-0">Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('login') }}" class="btn btn-dark btn-sm rounded-circle" style="width:35px; height:35px; display:flex; align-items:center; justify-content:center;">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="py-4 text-center">
        <p class="small text-muted">© 2026 MobiIce Premium Rental. All Rights Reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });

        // Smooth scroll
        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top - 80
            }, 500);
        });
        // Fungsi untuk menyalakan video dan suara saat kursor masuk
function enableSound(video) {
    video.muted = false; // Mematikan mode bisu
    video.volume = 0.5;  // Set volume sedang
    
    // Memastikan video berputar
    const playPromise = video.play();
    
    if (playPromise !== undefined) {
        playPromise.then(_ => {
            // Suara berhasil menyala
        }).catch(error => {
            // Jika browser memblokir, tetap putar tanpa suara (muted)
            video.muted = true;
            video.play();
        });
    }
}

// Fungsi untuk menghentikan video dan mematikan suara saat kursor keluar
function disableSound(video) {
    video.pause();
    video.currentTime = 0;
    video.muted = true; // Balikkan ke mode bisu
}
    </script>
</body>
</html>
