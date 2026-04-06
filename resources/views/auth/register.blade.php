<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Join the Fleet ❄️</title>

    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        :root {
            --ice-gradient: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 50%, #fbcfe8 100%);
            --crystal-glass: rgba(255, 255, 255, 0.4);
            --ice-border: rgba(255, 255, 255, 0.8);
            --deep-ice: #0ea5e9;
            --soft-text: #1e293b;
        }

        body {
            background: var(--ice-gradient) !important;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Quicksand', sans-serif;
            overflow: hidden;
            margin: 0;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('https://www.transparenttextures.com/patterns/frozen-wall.png');
            opacity: 0.1;
            z-index: -1;
        }

        /* Salju */
        .snow-particle {
            position: absolute;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(1px);
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; }
            20% { opacity: 0.8; }
            100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
        }

        /* Card Crystal */
        .card {
            border-radius: 30px !important;
            border: 1px solid var(--ice-border) !important;
            background: var(--crystal-glass) !important;
            backdrop-filter: blur(25px) saturate(180%);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Box Gambar Kiri */
        .bg-register-image {
            background: url("assets/img/register-bg.jpg") center/cover no-repeat !important;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }

        .bg-register-image::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(14, 165, 233, 0.2), rgba(30, 41, 59, 0.6));
        }

        .register-image-content {
            position: relative;
            z-index: 10;
            color: white;
        }

        /* Form Styling */
        .form-control-user {
            border-radius: 15px !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            background: rgba(255, 255, 255, 0.6) !important;
            height: 45px !important;
            padding: 10px 20px !important;
            color: var(--soft-text) !important;
            font-weight: 600;
            font-size: 0.8rem !important;
        }

        .form-control-user:focus {
            background: white !important;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.2) !important;
        }

        /* Presisi Toggle Password */
        .password-field-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-password-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #64748b;
            z-index: 10;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.2s;
        }

        .toggle-password-btn:hover {
            color: var(--deep-ice);
            background: white;
            transform: translateY(-50%) scale(1.05);
        }

        .btn-ice {
            background: var(--deep-ice) !important;
            color: white !important;
            border-radius: 15px !important;
            font-weight: 700 !important;
            height: 45px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: none !important;
            font-size: 0.8rem;
        }

        .btn-ice:hover {
            background: #0284c7 !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.3) !important;
        }

        label {
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: 10px;
            color: var(--soft-text);
        }

        .form-group { margin-bottom: 0.8rem !important; }
    </style>
</head>

<body>
    <div id="snow-container"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-5 d-none d-lg-flex bg-register-image">
                                <div class="register-image-content">
                                    <i class="fas fa-snowflake fa-4x mb-4 text-white"></i>
                                    <h2 class="font-weight-bold text-uppercase" style="letter-spacing: 4px;">
                                        Mobi<span style="color: #7dd3fc;">Rent</span>
                                    </h2>
                                    <p class="small text-white-50">Kenyamanan Berkelas dalam Genggaman</p>
                                    <div style="width: 50px; height: 3px; background: #7dd3fc; margin: 20px auto;"></div>
                                </div>
                            </div>

                            <div class="col-lg-7 bg-white shadow-sm">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 font-weight-bold text-gray-900">Join the Fleet ❄️</h1>
                                        <p class="text-muted small">Daftar sekarang untuk akses unit eksklusif</p>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('register.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control form-control-user" placeholder="Nama Lengkap" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control form-control-user" placeholder="nama@email.com" required>
                                            @error('email')
                                                <span class="small text-danger ml-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <div class="password-field-wrapper">
                                                        <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="••••••••" required>
                                                        <div class="toggle-password-btn" onclick="togglePass('password', 'eye1')">
                                                            <i class="fas fa-eye" id="eye1"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm</label>
                                                    <div class="password-field-wrapper">
                                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-user" placeholder="••••••••" required>
                                                        <div class="toggle-password-btn" onclick="togglePass('password_confirmation', 'eye2')">
                                                            <i class="fas fa-eye" id="eye2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-ice btn-block mt-4">
                                            BUAT AKUN SEKARANG
                                        </button>
                                    </form>

                                    <hr class="my-4">

                                    <div class="text-center">
                                        <p class="small text-muted mb-1">Sudah punya akun MobiRent?</p>
                                        <a class="small font-weight-bold text-primary" href="{{ route('login') }}">Masuk Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate Salju
        function createSnow() {
            const container = document.getElementById('snow-container');
            const particleCount = 50;
            for (let i = 0; i < particleCount; i++) {
                const snow = document.createElement('div');
                snow.className = 'snow-particle';
                const size = Math.random() * 4 + 2 + 'px';
                snow.style.width = size;
                snow.style.height = size;
                snow.style.left = Math.random() * 100 + 'vw';
                snow.style.top = '-' + (Math.random() * 20) + 'vh';
                snow.style.animationDuration = Math.random() * 3 + 5 + 's';
                snow.style.animationDelay = Math.random() * 5 + 's';
                snow.style.opacity = Math.random();
                container.appendChild(snow);
            }
        }
        createSnow();

        // Toggle Password Reusable
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
</body>
</html>