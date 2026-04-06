<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Profil Pengguna ❄️</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --ice-bg: #eef7fb;
            --ice-primary: #a2d2ff;
            --ice-secondary: #bde0fe;
            --glass-white: rgba(255, 255, 255, 0.7);
        }

        body {
            background-color: var(--ice-bg) !important;
            font-family: 'Nunito', sans-serif;
        }

        /* Container Profil Glassmorphism */
        .profile-container {
            background: var(--glass-white);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(162, 210, 255, 0.2);
            padding: 40px;
            margin-top: 50px;
            overflow: hidden; /* Penting untuk banner */
            position: relative;
        }

        /* Banner di dalam Container */
        .profile-banner {
            height: 120px;
            background: linear-gradient(135deg, var(--ice-primary), var(--ice-secondary), #ccd5ff);
            background-size: 200% 200%;
            animation: gradientMove 6s ease infinite;
            border-radius: 25px 25px 0 0;
            margin: -40px -40px 0 -40px;
            z-index: 0;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Avatar Styling */
        .avatar-wrapper {
            position: relative;
            width: 160px;
            height: 160px;
            margin: -80px auto 20px auto; /* Menaikkan avatar ke atas banner */
            z-index: 1;
        }

        .avatar-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            background-color: white;
        }

        .upload-label {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--ice-primary);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 4px solid white;
            transition: all 0.3s ease;
        }

        .upload-label:hover {
            transform: scale(1.1);
            background: #8ec3f5;
        }

        /* Badge Role Styling */
        .custom-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 800;
            border: 1px solid rgba(255, 255, 255, 0.5);
            margin-bottom: 20px;
        }

        .badge-admin { background: rgba(255, 133, 133, 0.15); color: #ff5e5e; }
        .badge-teknisi { background: rgba(255, 201, 113, 0.15); color: #f39c12; }
        .badge-peminjam { background: rgba(142, 208, 129, 0.15); color: #27ae60; }
        .badge-default { background: #f0f4f8; color: #95a5a6; }

        /* Input Styling */
        .form-control-ice {
            border-radius: 15px;
            border: 1px solid transparent;
            background: rgba(255, 255, 255, 0.9) !important;
            padding: 25px 20px;
            transition: 0.3s;
        }

        .form-control-ice:focus {
            background: white !important;
            border-color: var(--ice-primary);
            box-shadow: 0 0 10px rgba(162, 210, 255, 0.3);
        }

        .btn-save {
            background: var(--ice-primary);
            border: none;
            border-radius: 15px;
            padding: 12px;
            font-weight: 800;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-save:hover {
            background: #8ec3f5;
            box-shadow: 0 5px 15px rgba(162, 210, 255, 0.4);
            color: white;
        }

        .snow-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: -1;
        }
    </style>
</head>

<body>
    <div id="snow-js" class="snow-bg"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                
                <div class="mb-4 mt-4">
                    <a href="/dashboard" class="text-decoration-none text-muted font-weight-bold">
                        <i class="fas fa-chevron-left mr-2 text-primary"></i> Kembali ke Dashboard
                    </a>
                </div>

                <div class="profile-container">
                    <div class="profile-banner"></div>

                    @php
                        $user = auth()->user();
                        $roleId = is_object($user->role) ? $user->role->id : $user->role_id;
                        $roleName = is_object($user->role) ? $user->role->name : 'User';

                        $roleConfig = match ((int)$roleId) {
                            1 => ['class' => 'badge-admin', 'icon' => 'fa-crown', 'label' => 'Admin'],
                            2 => ['class' => 'badge-teknisi', 'icon' => 'fa-tools', 'label' => 'Teknisi'],
                            3 => ['class' => 'badge-peminjam', 'icon' => 'fa-user-tag', 'label' => 'Peminjam'],
                            default => ['class' => 'badge-default', 'icon' => 'fa-user', 'label' => $roleName],
                        };
                    @endphp

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="avatar-wrapper">
                            <img id="preview-img" class="avatar-image" 
                                 src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=a2d2ff&color=fff&bold=true' }}" 
                                 alt="Foto Profil">
                            
                            <label for="avatar-input" class="upload-label shadow-sm">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" name="avatar" id="avatar-input" class="d-none" accept="image/*">
                        </div>

                        <div class="text-center">
                            <h3 class="font-weight-bold text-dark mb-1">{{ $user->name }}</h3>
                            
                            <div class="custom-badge {{ $roleConfig['class'] }}">
                                <i class="fas {{ $roleConfig['icon'] }} mr-2"></i> {{ strtoupper($roleConfig['label']) }}
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="small font-weight-bold ml-2 text-primary">NAMA LENGKAP</label>
                            <input type="text" name="name" class="form-control form-control-ice shadow-sm" 
                                   value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="small font-weight-bold ml-2 text-muted">ALAMAT EMAIL (Permanen)</label>
                            <input type="email" class="form-control form-control-ice" 
                                   value="{{ $user->email }}" disabled style="cursor: not-allowed; opacity: 0.6;">
                        </div>

                        <button type="submit" class="btn btn-save btn-block mt-4 shadow">
                            Simpan Perubahan 🧊
                        </button>
                    </form>
                </div>
                
                <p class="text-center mt-4 text-muted small">© 2026 MobiRent System • Versi 1.2</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Preview Foto Real-time
        document.getElementById('avatar-input').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById('preview-img').src = URL.createObjectURL(file);
            }
        };

        // Notifikasi Sukses/Gagal
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                background: '#fff',
                borderRadius: '25px'
            });
        @endif

        // Efek Salju
        function createSnow() {
            const container = document.getElementById('snow-js');
            if(!container) return;
            const flake = document.createElement('div');
            const size = Math.random() * 4 + 2 + 'px';
            flake.style.position = 'absolute';
            flake.style.backgroundColor = 'white';
            flake.style.borderRadius = '50%';
            flake.style.width = size; flake.style.height = size;
            flake.style.opacity = Math.random();
            flake.style.left = Math.random() * 100 + 'vw';
            flake.style.top = '-10px';
            flake.style.transition = 'transform 6s linear, opacity 6s linear';
            container.appendChild(flake);
            setTimeout(() => {
                flake.style.transform = `translateY(100vh) translateX(${Math.random() * 20 - 10}px)`;
                flake.style.opacity = '0';
            }, 100);
            setTimeout(() => flake.remove(), 6000);
        }
        setInterval(createSnow, 200);
    </script>
</body>
</html>