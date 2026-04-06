<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Peminjaman Mobil - Ice Edition">
    <title>MobiRent - Dashboard Ice</title>

    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    :root {
        --ice-bg: #f0f7ff;
        --ice-primary: #a2d2ff;
        --ice-primary-dark: #7eb6eb;
        --ice-accent: #caf0f8;
        --ice-gradient: linear-gradient(135deg, #a2d2ff 0%, #dcf2ff 100%);
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.9);
        --text-ice: #4a6d88;
        --shadow-ice: rgba(162, 210, 255, 0.25);
    }

    body {
        background-color: var(--ice-bg) !important;
        font-family: 'Nunito', sans-serif;
        color: var(--text-ice);
    }

   /* --- Sidebar Premium Frosted --- */
    #accordionSidebar {
        background: rgba(255, 255, 255, 0.4) !important;
        backdrop-filter: blur(15px) saturate(150%);
        border-right: 1px solid var(--glass-border);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar .nav-item .nav-link {
        color: var(--text-ice) !important;
        margin: 8px 15px;
        border-radius: 15px;
        padding: 12px 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    /* Hover State */
    .sidebar .nav-item .nav-link:hover {
        background: rgba(255, 255, 255, 0.5);
        transform: translateX(5px);
        color: var(--ice-primary-dark) !important;
    }

    /* Active State */
    .sidebar .nav-item.active .nav-link {
        background: white !important;
        color: #4a90e2 !important;
        box-shadow: 0 8px 20px var(--shadow-ice);
        font-weight: 700;
    }

    /* Logo & Branding */
    .sidebar-brand {
        height: auto !important;
        padding: 1.5rem 1rem !important;
    }
    
    .sidebar-brand-text {
        color: var(--text-ice) !important;
        font-weight: 800 !important;
        text-transform: none !important;
    }

    .sidebar-heading {
        color: var(--ice-primary-dark) !important;
        font-weight: 800 !important;
        opacity: 0.8;
        letter-spacing: 1px;
    }

    /* Snowflake Animation */
    .snowflake-icon-brand {
        color: var(--ice-primary);
        animation: rotateAndGlow 4s linear infinite;
        display: inline-block;
    }

    @keyframes rotateAndGlow {
        0% { transform: rotate(0deg); text-shadow: 0 0 0px #fff; }
        50% { text-shadow: 0 0 10px var(--ice-primary); }
        100% { transform: rotate(360deg); text-shadow: 0 0 0px #fff; }
    }

    /* Sidebar Toggler */
    #sidebarToggle {
        background-color: white !important;
        box-shadow: 0 4px 10px var(--shadow-ice);
    }
    #sidebarToggle::after {
        color: var(--ice-primary-dark);
    }
    /* --- Welcome Banner Fix --- */
    .welcome-banner {
        background: var(--ice-gradient);
        border-radius: 30px;
        border: 4px solid white; /* Frame putih bikin efek ice lebih kuat */
        box-shadow: 0 15px 35px var(--shadow-ice);
    }

    /* --- Icy Card Glassmorphism --- */
    .card {
        border: 1px solid var(--glass-border) !important;
        background: var(--glass-bg) !important;
        backdrop-filter: blur(10px);
        border-radius: 25px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03) !important;
    }

    .icon-circle-ice {
        width: 50px; height: 50px;
        background: white;
        border-radius: 15px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 5px 15px var(--shadow-ice);
    }

    /* --- Pulse & Floating Animation --- */
    .pulse-button {
        transition: all 0.3s ease;
        border: none !important;
        box-shadow: 0 8px 20px rgba(74, 144, 226, 0.2);
    }

    .pulse-button:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 25px rgba(74, 144, 226, 0.3);
    }
    /* Animasi putar pelan untuk ikon salju di footer */
 .footer-minimal {
        padding: 20px 0;
    }

    .copyright-text {
        color: var(--text-ice);
        font-weight: 600;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    /* Animasi Snowflake Berputar & Glow */
    .snowflake-icon {
        color: var(--ice-primary);
        font-size: 0.8rem;
        animation: rotateAndGlow 4s linear infinite;
    }

    @keyframes rotateAndGlow {
        0% { transform: rotate(0deg); text-shadow: 0 0 0px #fff; }
        50% { text-shadow: 0 0 10px var(--ice-primary); }
        100% { transform: rotate(360deg); text-shadow: 0 0 0px #fff; }
    }

    /* Animasi Teks Muncul Pelan (Fade In Up) */
    .footer-content {
        animation: fadeInUp 1.5s ease-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Gaya untuk Teks Edisi */
    .edition-text {
        background: var(--ice-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    /* Animasi Dash Berkedip */
    .animated-dash {
        color: var(--ice-primary);
        animation: blink 1.5s infinite;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    /* Efek Mengetik Sederhana */
    .status-text {
        font-size: 0.75rem;
        color: var(--text-ice);
        opacity: 0.6;
        font-style: italic;
    }
    .badge-glass-white {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
    }
    .shadow-hover:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .gap-2 { gap: 0.5rem; }
    .gap-3 { gap: 1rem; }
    .promo-card:hover {
        border-color: #0f172a !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    
    .badge-soft-danger {
        border: 1px solid #fee2e2;
    }
</style>
</head>

<body id="page-top">
    <div class="snow-container" id="snow"></div>

    <div id="wrapper">
 <ul class="navbar-nav sidebar accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-4" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-snowflake text-info"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mobi<sup>Ice</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <?php if(auth()->user()->hasRole('admin')): ?>
        <div class="sidebar-heading">Administrator</div>
        
        <li class="nav-item <?php echo e(Request::is('mobil*') ? 'active' : ''); ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCars">
                <i class="fas fa-fw fa-car"></i> <span>Armada Mobil</span>
            </a>
            <div id="collapseCars" class="collapse <?php echo e(Request::is('mobil*') ? 'show' : ''); ?>">
                <div class="bg-white py-2 collapse-inner rounded shadow-sm">
                    <a class="collapse-item font-weight-bold" href="/mobil">Daftar Mobil</a>
                    <a class="collapse-item font-weight-bold" href="/mobil/create">Tambah Unit</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?php echo e(Request::is('users*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/users">
                <i class="fas fa-fw fa-user-friends"></i> <span>Manajemen User</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('promo*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/promo">
                <i class="fas fa-fw fa-tags"></i> <span>Promo & Diskon</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('statistik*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/statistik">
                <i class="fas fa-fw fa-chart-line"></i> <span>Statistik</span>
            </a>
        </li>
    <?php endif; ?>

    <?php if(auth()->user()->hasRole('teknisi')): ?>
        <div class="sidebar-heading">Workshop Area</div>
        
        <li class="nav-item <?php echo e(Request::is('transaksi*') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('teknisi.verifikasi')); ?>">
                <i class="fas fa-fw fa-clipboard-check"></i> <span>Verifikasi Unit</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('servis*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/servis">
                <i class="fas fa-fw fa-tools"></i> <span>Jadwal Servis</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('riwayat-servis*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/riwayat-servis">
                <i class="fas fa-fw fa-history"></i> <span>Riwayat Kerja</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('lapor-kerusakan*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/lapor-kerusakan">
                <i class="fas fa-fw fa-exclamation-triangle"></i> <span>Lapor Kerusakan</span>
            </a>
        </li>
    <?php endif; ?>

    <?php if(auth()->user()->hasRole('peminjam')): ?>
        <div class="sidebar-heading">Layanan</div>
        
        <li class="nav-item <?php echo e(Request::is('katalog*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/katalog">
                <i class="fas fa-fw fa-search"></i> <span>Cari Mobil</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('booking*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/booking">
                <i class="fas fa-fw fa-calendar-check"></i> <span>Booking Saya</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('my-bookings*') ? 'active' : ''); ?>">
            <a class="nav-link" href="/my-bookings">
                <i class="fas fa-fw fa-history"></i> <span>Riwayat Sewa</span>
            </a>
        </li>

        <li class="nav-item <?php echo e(Request::is('peminjam*') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('peminjam.booking')); ?>">
                <i class="fas fa-fw fa-undo-alt"></i> <span>Pengembalian</span>
            </a>
        </li>

       <li class="nav-item <?php echo e(Request::is('redeem*') ? 'active' : ''); ?>">
    <a class="nav-link" href="<?php echo e(route('booking.redeem')); ?>">
        <i class="fas fa-fw fa-ticket-alt"></i> <span>Redeem Code</span>
    </a>
</li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline mt-4">
        <button class="rounded-circle border-0 shadow-sm" id="sidebarToggle" style="background: #edf2f7; color: #36b9cc;"></button>
    </div>
</ul>

              <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
              <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow-none">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-flex flex-column align-items-end mr-3 d-none d-lg-flex">
                    <span class="text-gray-800 small font-weight-bold"><?php echo e(auth()->user()->name); ?></span>
                    <span class="small font-weight-bold text-uppercase" style="font-size: 9px; letter-spacing: 1px;">
    <?php switch(auth()->user()->role_id):
        case (1): ?>
            <span class="text-warning">Admin 🛡️</span>
            <?php break; ?>
        <?php case (2): ?>
            <span class="text-success">Teknisi 🔧</span>
            <?php break; ?>
        <?php case (3): ?>
            <span class="text-info">Peminjam ❄️</span>
            <?php break; ?>
    <?php endswitch; ?>
</span>
                </div>

                <div class="position-relative">
                    <?php if(auth()->user()->avatar): ?>
                        <img class="img-profile rounded-circle border border-info shadow-sm" src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" style="width: 40px; height: 40px; object-fit: cover;">
                    <?php else: ?>
                        <img class="img-profile rounded-circle border border-info shadow-sm" src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>&background=a2d2ff&color=fff" style="width: 40px; height: 40px;">
                    <?php endif; ?>
                    <div class="status-indicator bg-success shadow-sm" style="position: absolute; bottom: 0; right: 0; width: 11px; height: 11px; border-radius: 50%; border: 2px solid white;"></div>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow border-0 animated--grow-in mt-3" style="border-radius: 15px; overflow: hidden;" aria-labelledby="userDropdown">
                <div class="dropdown-header text-info font-weight-bold py-2">Manajemen Akun</div>
                <a class="dropdown-item py-2 px-4" href="<?php echo e(route('profile.edit')); ?>">
                    <i class="fas fa-user-cog fa-sm fa-fw mr-3 text-gray-400"></i>
                    Pengaturan Profil
                </a>
                <a class="dropdown-item py-2 px-4" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-3 text-gray-400"></i>
                    Riwayat Sewa
                </a>
                <div class="dropdown-divider mx-3"></div>
                <a class="dropdown-item py-2 px-4 text-danger font-weight-bold" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-power-off fa-sm fa-fw mr-3 text-danger"></i>
                    Keluar Aplikasi
                </a>
            </div>
        </li>
    </ul>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-info" style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center px-4 pt-0">
                <div class="mb-4">
                    <div class="d-inline-block bg-light rounded-circle p-4">
                        <i class="fas fa-sign-out-alt fa-3x text-info shadow-sm" style="opacity: 0.5;"></i>
                    </div>
                </div>
                <h4 class="font-weight-bold text-dark mb-2" id="logoutLabel">Sesi Berakhir?</h4>
                <p class="text-muted small">Apakah Anda yakin ingin keluar? Anda perlu masuk kembali untuk mengakses panel armada MobiRent.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-5">
                <button class="btn btn-light px-4 mr-2" type="button" data-dismiss="modal" style="border-radius: 12px; font-weight: 700; color: #888;">Batal</button>
                
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-info px-4 shadow-sm" style="border-radius: 12px; font-weight: 700;">
                        Ya, Keluar <i class="fas fa-chevron-right ml-1 small"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
                </nav>

              <div class="container-fluid">
    <div class="welcome-banner mb-4 p-4 p-lg-5 position-relative overflow-hidden">
        
        <i class="fas fa-snowflake position-absolute" style="top: -20px; right: -20px; font-size: 200px; opacity: 0.1; transform: rotate(15deg);"></i>
        
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-7 mb-4 mb-lg-0 text-white">
                <div class="d-inline-flex align-items-center mb-3 px-3 py-2" 
                     style="background: rgba(255,255,255,0.2); border-radius: 12px; backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.3);">
                    
                    <?php if(auth()->user()->role_id == 1): ?>
                        <i class="fas fa-user-crown mr-2 blink-animation text-warning"></i>
                        <span class="small font-weight-bold letter-spacing-1">ADMINISTRATOR ACCESS</span>
                    <?php elseif(auth()->user()->role_id == 2): ?>
                        <i class="fas fa-tools mr-2 blink-animation"></i>
                        <span class="small font-weight-bold letter-spacing-1">TECHNICAL FLEET PASS</span>
                    <?php else: ?>
                        <i class="fas fa-snowboarding mr-2 blink-animation"></i>
                        <span class="small font-weight-bold letter-spacing-1">ICE PASS MEMBER</span>
                    <?php endif; ?>
                </div>
                
                <h1 class="font-weight-bold mb-2" style="font-size: 3rem; letter-spacing: -2px; line-height: 1;">
                    <?php if(auth()->user()->role_id == 1): ?>
                        Control Panel, <span style="color: #ffe5b4; text-shadow: 0 0 15px rgba(255,229,180,0.4);">Admin</span>! ⚙️
                    <?php elseif(auth()->user()->role_id == 2): ?>
                        Ready to Fix, <span style="color: #b4f8ff; text-shadow: 0 0 15px rgba(180,248,255,0.4);">Technician</span>? 🛠️
                    <?php else: ?>
                        Hello, <span style="color: #ffe5b4; text-shadow: 0 0 15px rgba(255,229,180,0.4);"><?php echo e(explode(' ', auth()->user()->name)[0]); ?></span>! ❄️
                    <?php endif; ?>
                </h1>
                
                <p class="mb-4 opacity-90 font-weight-light" style="font-size: 1.1rem; max-width: 500px;">
                    <?php if(auth()->user()->role_id == 1): ?>
                        Pantau seluruh pergerakan armada dan performa bisnis MobiRent hari ini dalam satu genggaman.
                    <?php elseif(auth()->user()->role_id == 2): ?>
                        Pastikan setiap armada dalam kondisi prima dan siap tempur. Cek jadwal maintenance sekarang.
                    <?php else: ?>
                        Jelajahi kota dengan kenyamanan ekstra. Koleksi mobil kami siap menemanimu di segala cuaca.
                    <?php endif; ?>
                </p>
                
                <?php if(auth()->user()->role_id == 1): ?>
                    <a href="<?php echo e(url('/laporan')); ?>" class="btn btn-white bg-white px-5 py-3 font-weight-bold rounded-pill shadow-lg pulse-button" style="color: #4a90e2; border: none;">
                        Lihat Laporan <i class="fas fa-chart-line ml-2"></i>
                    </a>
                <?php elseif(auth()->user()->role_id == 2): ?>
                    <a href="<?php echo e(url('/maintenance')); ?>" class="btn btn-white bg-white px-5 py-3 font-weight-bold rounded-pill shadow-lg pulse-button" style="color: #4a90e2; border: none;">
                        Cek Unit <i class="fas fa-wrench ml-2"></i>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(url('/katalog')); ?>" class="btn btn-white bg-white px-5 py-3 font-weight-bold rounded-pill shadow-lg pulse-button" style="color: #4a90e2; border: none;">
                        Booking Sekarang <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                <?php endif; ?>
            </div>

            <div class="col-lg-5">
                <div class="row no-gutters">
                    <?php if(auth()->user()->role_id == 1): ?> 
                        <div class="col-6 p-2">
                            <div class="card border-0 p-4 text-center h-100 justify-content-center shadow-sm">
                                <div class="icon-circle-ice mb-3 mx-auto" style="background: #fff4e5;">
                                    <i class="fas fa-users text-warning fa-lg"></i>
                                </div>
                                <div class="small text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem;">Total User</div>
                                <div class="h3 font-weight-bold text-dark mb-0 mt-1"><?php echo e($stats['total_user'] ?? '0'); ?></div>
                            </div>
                        </div>
                       <div class="col-6 p-2">
    <div class="card border-0 p-4 text-center h-100 justify-content-center shadow-sm" style="border-radius: 20px; background: rgba(255,255,255,0.8); backdrop-filter: blur(10px);">
        <div class="icon-circle-ice mb-3 mx-auto" style="background: #e3f2fd; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 15px;">
            <i class="fas fa-check-double text-primary fa-lg"></i>
        </div>
        <div class="small text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Unit Kembali</div>
        <div class="h3 font-weight-bold text-primary mb-0 mt-1">
            <?php echo e($stats['transaksi_hari_ini'] ?? '0'); ?>

        </div>
        <div class="text-xs text-success font-weight-bold mt-1">Hari Ini</div>
    </div>
</div>
                    <?php elseif(auth()->user()->role_id == 2): ?> 
                        <div class="col-6 p-2">
                            <div class="card border-0 p-4 text-center h-100 justify-content-center shadow-sm">
                                <div class="icon-circle-ice mb-3 mx-auto" style="background: #ffebee;">
                                    <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                                </div>
                                <div class="small text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem;">Perlu Cek</div>
                                <div class="h3 font-weight-bold text-danger mb-0 mt-1"><?php echo e($stats['butuh_maintenance'] ?? '0'); ?></div>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="card border-0 p-4 text-center h-100 justify-content-center shadow-sm">
                                <div class="icon-circle-ice mb-3 mx-auto" style="background: #e3f9e5;">
                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                </div>
                                <div class="small text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem;">Unit Ready</div>
                                <div class="h3 font-weight-bold text-success mb-0 mt-1"><?php echo e($stats['mobil_tersedia'] ?? '0'); ?></div>
                            </div>
                        </div>
                    <?php else: ?> 
                        <div class="col-6 p-2">
                            <div class="card border-0 p-4 text-center h-100 justify-content-center shadow-sm">
                                <div class="icon-circle-ice mb-3 mx-auto">
                                    <i class="fas fa-calendar-alt text-info fa-lg"></i>
                                </div>
                                <div class="small text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem;">Total Sewa</div>
                                <div class="h3 font-weight-bold text-dark mb-0 mt-1"><?php echo e($stats['total_sewa_anda']); ?></div>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="card border-0 p-4 text-center h-100 justify-content-center shadow-sm">
                                <div class="icon-circle-ice mb-3 mx-auto" style="background: #e3f9e5;">
                                    <i class="fas fa-user-shield text-success fa-lg"></i>
                                </div>
                                <div class="small text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem;">Status</div>
                                <div class="h6 font-weight-bold text-success mb-0 mt-1">Verified</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
   <?php if(auth()->user()->hasRole('admin')): ?>
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100 overflow-hidden transition-up" style="border-radius: 25px; background: #ffffff;">
           <div class="card-body p-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-xs font-weight-bold text-uppercase text-info" style="letter-spacing: 1.2px;">
            Monthly Revenue ❄️
        </div>
        <div class="p-2 bg-info-soft rounded-circle" style="background: rgba(13, 202, 240, 0.1);">
            <i class="fas fa-wallet text-info"></i>
        </div>
    </div>
    
    <h2 class="font-weight-bold text-dark mb-1">
        Rp <?php echo e(number_format($revenueMonth, 0, ',', '.')); ?>

    </h2>
    <p class="text-muted small mb-3">
        Total dari transaksi selesai bulan ini
    </p> 

    <div class="progress mb-2" style="height: 8px; border-radius: 10px; background: #f1f5f9;">
        <div class="progress-bar <?php echo e($displayPercentage >= 100 ? 'bg-success' : 'bg-info'); ?> progress-bar-striped progress-bar-animated" 
             role="progressbar" 
             style="width: <?php echo e($barPercentage); ?>%; border-radius: 10px;">
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center small mt-3">
        <div class="text-muted font-weight-bold">
            Target: <span class="text-dark">Rp <?php echo e(number_format($target/1000000, 1, ',', '.')); ?> Jt</span>
        </div>
        <div class="<?php echo e($displayPercentage >= 100 ? 'text-success' : 'text-info'); ?> font-weight-bold badge badge-light rounded-pill px-2 border">
            <?php echo e(number_format($displayPercentage, 1)); ?>% Achieved
        </div>
    </div>
</div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100 overflow-hidden transition-up" style="border-radius: 25px; background: #fff; border-bottom: 5px solid #f6c23e;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-circle bg-warning text-white mr-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border-radius: 12px;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h6 class="text-xs font-weight-bold text-warning text-uppercase mb-0" style="letter-spacing: 1px;">Action Center</h6>
                        <span class="small text-muted font-weight-bold">Persetujuan Pending</span>
                    </div>
                </div>
                
                <div class="row text-center mb-4 no-gutters bg-light rounded-lg py-3">
                    <div class="col-6 border-right">
                        <div class="h3 font-weight-bold text-dark mb-0"><?php echo e($stats['transaksi_pending'] ?? '3'); ?></div>
                        <small class="text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem;">Sewa Baru</small>
                    </div>
                    <div class="col-6">
                        <div class="h3 font-weight-bold text-danger mb-0"><?php echo e($stats['kyc_pending'] ?? '18'); ?></div>
                        <small class="text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem;">KYC User</small>
                    </div>
                </div>
                
                <a href="#" class="btn btn-warning btn-block rounded-pill font-weight-bold text-white shadow-sm py-2">
                    Review Sekarang <i class="fas fa-arrow-right ml-2" style="font-size: 0.8rem;"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-0 shadow-lg h-100 transition-up" style="border-radius: 25px; background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);">
            <div class="card-body p-4 position-relative overflow-hidden d-flex flex-column">
                <i class="fas fa-snowflake position-absolute" style="top: -10px; right: -10px; font-size: 6rem; opacity: 0.05; color: #0ea5e9;"></i>
                
                <h6 class="font-weight-bold mb-3 text-dark d-flex align-items-center">
                    <div class="p-1 bg-info rounded mr-2"><i class="fas fa-robot text-white fa-xs"></i></div>
                    Smart Insight
                </h6>

                <div class="p-3 mb-auto border-left border-info" style="background: rgba(255,255,255,0.8); border-radius: 0 15px 15px 0;">
                    <p class="small mb-0 font-weight-bold text-secondary" style="line-height: 1.6;">
                        <i class="fas fa-lightbulb text-warning mr-1"></i>
                        Permintaan sewa <span class="text-info">SUV</span> naik 40%. Ingat servis unit 
                        <span class="text-primary font-italic">Fortuner [B 1234 ABC]</span> segera!
                    </p>
                </div>

                <div class="mt-4 d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-outline-info rounded-pill px-4 font-weight-bold flex-grow-1">Lihat Forecast</button>
                    <button class="btn btn-sm btn-light rounded-circle shadow-sm text-info"><i class="fas fa-cog"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-lg" style="border-radius: 30px; background: #ffffff;">
            <div class="card-header bg-white border-0 py-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="font-weight-bold text-dark mb-0">Occupancy Armada 📈</h5>
                    <p class="text-muted small mb-0">Aktivitas armada 7 hari terakhir</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge badge-light text-primary px-3 py-2 rounded-pill border mr-2">
                        <i class="fas fa-sync-alt fa-spin mr-1"></i> Realtime
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 350px;">
                    <canvas id="myOccupancyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 30px; background: #fdfdff;">
            <div class="card-header bg-transparent border-0 py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-comment-dots text-info mr-2"></i>Kru Reports
                    </h6>
                    <span class="badge badge-pill badge-danger shadow-sm px-3 animated-pulse">LIVE</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="px-4 pb-4" style="max-height: 420px; overflow-y: auto; scrollbar-width: none;">
                    <?php $__empty_1 = true; $__currentLoopData = $allLaporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-3 mb-3 transition-up border" 
                         style="background: #ffffff; border-radius: 20px; border-color: #f1f5f9 !important;">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge badge-light text-info rounded-pill px-2" style="font-size: 10px;">
                                #<?php echo e(strtoupper($lp->topik)); ?>

                            </span>
                            <small class="text-muted"><?php echo e($lp->created_at->diffForHumans()); ?></small>
                        </div>
                        <p class="mb-3 text-dark font-weight-medium" style="font-size: 0.85rem; line-height: 1.4;">
                            "<?php echo e($lp->pesan); ?>"
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($lp->user->name ?? 'S')); ?>&background=0ea5e9&color=fff" 
                                     class="rounded-circle mr-2" style="width: 24px; height: 24px;">
                                <small class="text-secondary font-weight-bold"><?php echo e($lp->user->name ?? 'Staff'); ?></small>
                            </div>
                            <?php if($lp->status == 'pending'): ?>
                                <button onclick="openReplyModal(<?php echo e($lp->id); ?>, '<?php echo e($lp->pesan); ?>')" 
                                        class="btn btn-sm btn-info rounded-pill px-3 font-weight-bold">Bahas</button>
                            <?php else: ?>
                                <span class="badge badge-success-soft text-success px-2 py-1 rounded-pill" style="font-size: 10px;">
                                    <i class="fas fa-check mr-1"></i>Selesai
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-5">
                        <img src="https://illustrations.popsy.co/blue/shaking-hands.svg" style="width: 80px; opacity: 0.5;">
                        <p class="small text-muted font-weight-bold mt-3">Tidak ada laporan kru.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php endif; ?>


    <?php if(auth()->user()->hasRole('teknisi')): ?>
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
        <div class="card border-0 shadow-sm h-100 transition-hover" style="border-radius: 20px; background: #fff; border-left: 5px solid #e53e3e !important;">
            <div class="card-body p-4">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-2" style="letter-spacing: 1px;">Butuh Perbaikan</div>
                <div class="d-flex align-items-end justify-content-between">
                    <h2 class="font-weight-bold text-dark mb-0"><?php echo e(\App\Models\Mobil::where('status', 'rusak')->count()); ?> <small class="h6 text-muted">Unit</small></h2>
                    <div class="badge badge-danger px-3 py-1 animated-pulse" style="border-radius: 8px;">
                         Priority
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: #fff; border-left: 5px solid #3182ce !important;">
            <div class="card-body p-4">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2" style="letter-spacing: 1px;">Kesehatan Armada</div>
                <h2 class="font-weight-bold text-dark mb-0">92%</h2>
                <div class="progress progress-sm mt-2" style="height: 6px; background: #ebf8ff; border-radius: 10px;">
                    <div class="progress-bar bg-primary" style="width: 92%; border-radius: 10px;"></div>
                </div>
                <small class="text-primary font-weight-bold mt-2 d-block">Sangat Layak ❄️</small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: #fff; border-left: 5px solid #d69e2e !important;">
            <div class="card-body p-4">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-2" style="letter-spacing: 1px;">Logistik Workshop</div>
                <div class="d-flex align-items-center mt-2 justify-content-between">
                    <div class="text-left">
                        <i class="fas fa-oil-can text-warning mr-1"></i>
                        <small class="font-weight-bold text-dark">Oli: Aman</small>
                    </div>
                    <div class="text-left border-left pl-3">
                        <i class="fas fa-compact-disc text-danger mr-1"></i>
                        <small class="font-weight-bold text-danger">Ban: Limit</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: #2d3748;">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="mr-3 position-relative">
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(auth()->user()->name); ?>&background=4a5568&color=fff" class="rounded-circle border border-light" width="50">
                    <span class="position-absolute rounded-circle bg-success border border-dark" style="bottom: 2px; right: 2px; width: 12px; height: 12px;"></span>
                </div>
                <div>
                    <div class="text-light opacity-75 small font-weight-bold">Teknisi On Duty</div>
                    <div class="text-white font-weight-bold mb-0"><?php echo e(explode(' ', auth()->user()->name)[0]); ?>!</div>
                    <span class="badge badge-light mt-1" style="font-size: 8px; letter-spacing: 1px;">MASTER LEVEL</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4 d-flex align-items-center justify-content-between" style="border-radius: 20px 20px 0 0;">
                <div>
                    <h5 class="font-weight-bold text-dark mb-0">Antrean Workshop</h5>
                    <small class="text-muted">Kelola tugas perbaikan hari ini</small>
                </div>
                <div class="badge badge-light p-2 rounded-pill px-3">
                    <i class="fas fa-calendar-day text-info mr-2"></i> <?php echo e(date('d M Y')); ?>

                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-secondary small font-weight-bold text-uppercase" style="background: #f8fafc;">
                                <th class="pl-4 border-0 py-3">Unit Info</th>
                                <th class="border-0 py-3">Diagnosa</th>
                                <th class="border-0 text-right pr-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $tugasPerbaikan = \App\Models\Mobil::whereIn('status', ['rusak', 'servis'])->get(); ?>
                            <?php $__empty_1 = true; $__currentLoopData = $tugasPerbaikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tugas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="pl-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3 p-2 bg-light rounded-lg text-primary shadow-sm"><i class="fas fa-car-side"></i></div>
                                        <div>
                                            <div class="font-weight-bold text-dark"><?php echo e($tugas->merek); ?></div>
                                            <span class="text-muted small font-weight-bold"><?php echo e($tugas->no_polisi); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if($tugas->status == 'rusak'): ?>
                                        <span class="badge badge-soft-danger px-3 py-1"><i class="fas fa-bolt mr-1"></i> Heavy Repair</span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-warning px-3 py-1"><i class="fas fa-sync mr-1"></i> Maintenance</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right pr-4">
                                    <a href="/mobil/<?php echo e($tugas->id); ?>/edit" class="btn btn-outline-dark btn-sm rounded-pill px-3 font-weight-bold transition-hover">
                                        Check In <i class="fas fa-chevron-right ml-1" style="font-size: 8px;"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/blue/manager-explaining-work.svg" style="width: 120px;" class="mb-3">
                                    <h6 class="text-dark font-weight-bold">Bengkel Kosong!</h6>
                                    <p class="text-muted small">Semua unit dalam kondisi prima.</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
            <div class="card-body p-0">
                <div class="d-flex align-items-center" style="background: #e6fffa;">
                    <div class="p-4" style="background: #b2f5ea; color: #2c7a7b;">
                        <i class="fas fa-lightbulb fa-2x"></i>
                    </div>
                    <div class="p-3">
                        <h6 class="font-weight-bold mb-1" style="color: #2c7a7b;">Tips Mekanik Harian:</h6>
                        <p class="small mb-0 text-dark opacity-75">Selalu lumasi engsel pintu unit Alphard agar tidak berdecit saat digunakan klien.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex align-items-center" style="background: linear-gradient(45deg, #4e73df, #224abe);">
                <i class="fas fa-paper-plane text-white-50 fa-2x mr-3"></i>
                <div>
                    <h6 class="font-weight-bold text-white mb-0">Lapor Progres</h6>
                    <small class="text-white-50">Update ke Admin Workshop</small>
                </div>
            </div>
            <div class="card-body p-4">
                <form id="formLaporAdmin">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <select name="topik" class="form-control border-0 bg-light font-weight-bold text-dark rounded-lg shadow-none">
                            <option value="Update Perbaikan">🔧 Update Perbaikan</option>
                            <option value="Permintaan Suku Cadang">📦 Minta Sparepart</option>
                            <option value="Unit Selesai & Ready">✅ Unit Ready</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="pesan" id="pesanLaporan" class="form-control border-0 bg-light p-3 small rounded-lg shadow-none" rows="4" style="resize: none;" placeholder="Detail laporan..."></textarea>
                    </div>
                    <button type="submit" id="btnKirimLaporan" class="btn btn-primary btn-block shadow font-weight-bold rounded-pill py-2">
                        Kirim Laporan
                    </button>
                </form>
                <div class="mt-3 text-center last-report-status" style="display: none;">
                    <small class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> Terkirim!</small>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-4 text-center">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-xs font-weight-bold text-muted text-uppercase">Beban Kerja</span>
                    <span class="badge badge-dark rounded-pill px-3">75% Busy</span>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <svg width="120" height="120" viewBox="0 0 36 36">
                        <path stroke="#edf2f7" stroke-width="3" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path stroke="#4e73df" stroke-width="3" stroke-dasharray="75, 100" stroke-linecap="round" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="21" class="font-weight-bold" style="font-size: 6px; text-anchor: middle; fill: #2d3748;">3/4 Stall</text>
                    </svg>
                </div>
                <p class="small text-muted mb-0">Hanya tersisa <strong>1 slot</strong> perbaikan hari ini.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .badge-soft-danger { background: #fff5f5; color: #c53030; }
    .badge-soft-warning { background: #fffaf0; color: #975a16; }
    .transition-hover:hover { transform: translateY(-3px); transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .animated-pulse { animation: pulse-red 2s infinite; }
    @keyframes pulse-red {
        0% { box-shadow: 0 0 0 0 rgba(229, 62, 62, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(229, 62, 62, 0); }
        100% { box-shadow: 0 0 0 0 rgba(229, 62, 62, 0); }
    }
</style>
<?php endif; ?>

<?php if(auth()->user()->hasRole('peminjam')): ?>
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 20px; background: #fff;">
            <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.05; transform: rotate(15deg); pointer-events: none;">
                <i class="fas fa-car fa-10x text-primary"></i>
            </div>
            <div class="card-body position-relative">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-xs font-weight-bold text-primary text-uppercase" style="letter-spacing: 1px;">
                        <i class="fas fa-circle text-success mr-1 blink-animation"></i> Status Kendaraan
                    </div>
                    <?php if($sewaAktif): ?>
                        <span class="badge badge-primary rounded-pill px-3 py-1 shadow-sm">Sedang Disewa</span>
                    <?php else: ?>
                        <span class="badge badge-light border rounded-pill px-3 py-1">Tersedia</span>
                    <?php endif; ?>
                </div>

                <?php if($sewaAktif): ?>
                    <h5 class="font-weight-bold text-dark mb-1"><?php echo e($sewaAktif->mobil->merek); ?> <?php echo e($sewaAktif->mobil->model); ?></h5>
                    <div class="badge badge-dark mb-3 px-2 py-1"><?php echo e($sewaAktif->mobil->no_polisi); ?></div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span class="text-muted"><i class="fas fa-calendar-alt mr-1"></i> Sisa Waktu</span>
                        <span class="font-weight-bold text-primary">2 Hari Lagi</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px; border-radius: 10px; background: #eaecf4;">
                        <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 60%; border-radius: 10px;"></div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-3">
                        <img src="https://illustrations.popsy.co/blue/surr-car.svg" style="height: 85px;" class="mb-2">
                        <p class="small text-muted mb-3">Ingin jalan-jalan hari ini? <br> Kendaraan kami sudah siap!</p>
                        <a href="<?php echo e(url('/katalog')); ?>" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm pulse-button">Cek Katalog</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%);">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="p-2 bg-warning rounded-circle mr-3 shadow-sm">
                        <i class="fas fa-crown text-white fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-muted text-uppercase">Loyalty Level</div>
                        <h6 class="font-weight-bold text-dark mb-0">Silver Member ❄️</h6>
                    </div>
                    <div class="ml-auto text-right">
                         <h4 class="font-weight-bold text-primary mb-0">2.450</h4>
                         <small class="text-muted font-weight-bold">Poin</small>
                    </div>
                </div>
                <div class="progress mt-4 shadow-sm" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%"></div>
                </div>
                <div class="mt-4 p-2 text-center" style="border: 1px dashed #f6c23e; border-radius: 12px; background: rgba(246, 194, 62, 0.05);">
                    <span class="small text-dark font-weight-bold"><i class="fas fa-bolt text-warning mr-1"></i> Kumpulkan 550 poin lagi!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-0 shadow-lg h-100 overflow-hidden" style="border-radius: 20px; background: #e3f2fd; border: 1px solid #36b9cc !important;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-cloud-sun fa-3x mr-3 text-warning"></i>
                    <div>
                        <h3 class="font-weight-bold mb-0 text-dark">28°C</h3>
                        <p class="mb-0 font-weight-bold text-dark small">Cerah Berawan</p>
                    </div>
                </div>
               <div class="promo-section mt-4">
    <?php
        // Mengambil promo terbaru yang masih aktif (disesuaikan dengan logic database Anda)
        $latestPromo = \App\Models\Promo::latest()->first();
    ?>

    <?php if($latestPromo): ?>
        <div class="promo-card d-flex align-items-center p-3 shadow-sm" style="background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease;">
            <div class="promo-icon mr-3 d-flex align-items-center justify-content-center" style="background: #0f172a; color: #fbbf24; width: 45px; height: 45px; border-radius: 14px;">
                <i class="fas fa-percentage"></i>
            </div>
            
            <div class="flex-grow-1">
                <small class="text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Kupon Tersedia</small>
                <div class="d-flex align-items-center">
                    <span class="font-weight-bold text-dark mr-2" id="promoCode" style="font-size: 1rem; letter-spacing: 0.5px;"><?php echo e($latestPromo->code); ?></span>
                    <span class="badge badge-soft-danger px-2" style="background: #fef2f2; color: #ef4444; border-radius: 6px; font-size: 0.7rem;">-<?php echo e($latestPromo->discount_percent); ?>%</span>
                </div>
            </div>

            <button class="btn btn-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                    onclick="copyCode('<?php echo e($latestPromo->code); ?>')" 
                    style="width: 38px; height: 38px; transition: transform 0.2s;"
                    onmouseover="this.style.transform='scale(1.1)'" 
                    onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-copy" style="font-size: 0.8rem;"></i>
            </button>
        </div>
    <?php else: ?>
        <div class="empty-promo-card text-center p-3" style="background: rgba(248, 250, 252, 0.5); border-radius: 20px; border: 1.5px dashed #cbd5e1;">
            <div class="text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-ticket-alt mr-2 opacity-50"></i>
                Belum ada promo aktif saat ini.
            </div>
            <small class="text-muted-50" style="font-size: 0.75rem;">Pantau terus untuk penawaran menarik!</small>
        </div>
    <?php endif; ?>
</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4 px-2">
            <div>
                <h5 class="font-weight-bold text-dark mb-0">Armada Pilihan 🧊</h5>
                <p class="text-muted small mb-0">Pilihan terbaik untuk kenyamanan Anda</p>
            </div>
            <button class="btn btn-white btn-sm shadow-sm rounded-pill border-0"><i class="fas fa-filter text-info mr-1"></i> Filter</button>
        </div>

        <div class="row" id="mobilContainer">
            <?php $__empty_1 = true; $__currentLoopData = $allMobils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $hasDiscount = $mobil->diskon > 0;
                    $hargaAsli = $mobil->harga_sewa;
                    $hargaFinal = $hasDiscount ? $hargaAsli - ($hargaAsli * ($mobil->diskon / 100)) : $hargaAsli;
                ?>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden shadow-hover" style="border-radius: 24px; transition: 0.3s;">
                        <div class="position-relative">
                           <img src="<?php echo e(asset('storage/' . $mobil->gambar)); ?>" 
     class="card-img-top" 
     style="height: 180px; object-fit: cover;"
     onerror="this.src='https://placehold.co/600x400?text=Gambar+Tidak+Ditemukan'">
                            
                            <div class="position-absolute d-flex flex-column gap-2" style="top: 15px; left: 15px;">
                                <span class="badge bg-white text-dark shadow-sm rounded-pill px-3 py-2 small font-weight-bold">
                                    <?php echo e($mobil->category->nama_kategori); ?>

                                </span>
                                <?php if($hasDiscount): ?>
                                    <span class="badge bg-danger text-white shadow-sm rounded-pill px-3 py-2 small font-weight-bold">
                                        <i class="fas fa-fire mr-1"></i> Hemat <?php echo e($mobil->diskon); ?>%
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold text-dark mb-3"><?php echo e($mobil->merek); ?> <?php echo e($mobil->model); ?></h6>
                            <div class="d-flex gap-2 mb-4">
                                <span class="badge badge-light text-muted border-0"><i class="fas fa-cog text-info mr-1"></i> <?php echo e($mobil->transmisi); ?></span>
                                <span class="badge badge-light text-muted border-0"><i class="fas fa-users text-info mr-1"></i> <?php echo e($mobil->kursi); ?> Seats</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <div>
                                    <?php if($hasDiscount): ?>
                                        <del class="text-muted small">Rp<?php echo e(number_format($hargaAsli, 0, ',', '.')); ?></del>
                                        <div class="text-info font-weight-bold h5 mb-0">Rp<?php echo e(number_format($hargaFinal, 0, ',', '.')); ?></div>
                                    <?php else: ?>
                                        <div class="text-info font-weight-bold h5 mb-0">Rp<?php echo e(number_format($hargaAsli, 0, ',', '.')); ?></div>
                                    <?php endif; ?>
                                </div>
                                <a href="/booking/<?php echo e($mobil->id); ?>" class="btn btn-info rounded-pill px-3 shadow-sm btn-sm font-weight-bold">Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Tidak ada armada tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-shield mr-2 text-info"></i>Verifikasi Akun</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="progress mb-2" style="height: 10px; border-radius: 10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 75%"></div>
                    </div>
                    <small class="text-muted">Kelengkapan Profil: **75%**</small>
                </div>
                <button class="btn btn-outline-info btn-block btn-sm rounded-pill mt-3">Update Berkas</button>
            </div>
        </div>

        <div class="card border-0 shadow-sm text-center p-4" style="border-radius: 20px; background: #f8faff;">
            <img src="https://illustrations.popsy.co/blue/customer-support.svg" style="height: 100px;" class="mx-auto mb-3">
            <h6 class="font-weight-bold">Butuh Bantuan?</h6>
            <a href="#" class="btn btn-info btn-block rounded-pill shadow-sm mt-3"><i class="fab fa-whatsapp mr-2"></i>Hubungi Kami</a>
        </div>
    </div>
</div>
<?php endif; ?>

<style>
    .shadow-hover:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
    .gap-2 { gap: 0.5rem; }
    .blink-animation { animation: blink 1.5s infinite; }
    @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }
</style>
            </div>
            
            
        </div>
    </div>

   <script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/sb-admin-2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- 1. Global Chart Configuration ---
    Chart.defaults.font.family = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.color = '#858796';

    // --- 2. Inisialisasi Occupancy Chart (Grafik Utama) ---
   var ctx = document.getElementById("myOccupancyChart").getContext('2d');
    
    // Membuat gradasi warna untuk area di bawah garis
    var gradientFill = ctx.createLinearGradient(0, 0, 0, 350);
    gradientFill.addColorStop(0, "rgba(162, 210, 255, 0.5)");
    gradientFill.addColorStop(1, "rgba(162, 210, 255, 0)");

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>, // Data dari Controller
            datasets: [{
                label: "Unit Kembali",
                lineTension: 0.4, // Membuat garis melengkung (smooth)
                backgroundColor: gradientFill,
                borderColor: "#a2d2ff",
                borderWidth: 4,
                pointRadius: 5,
                pointBackgroundColor: "#fff",
                pointBorderColor: "#a2d2ff",
                pointHoverRadius: 7,
                pointHoverBackgroundColor: "#a2d2ff",
                pointHoverBorderColor: "#fff",
                pointHitRadius: 10,
                pointBorderWidth: 3,
                data: <?php echo json_encode($dataSewa); ?>, // Data dari Controller
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: { left: 10, right: 25, top: 25, bottom: 0 }
            },
            scales: {
                xAxes: [{
                    gridLines: { display: false, drawBorder: false },
                    ticks: { maxTicksLimit: 7, fontColor: "#858796", fontSize: 11 }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // Karena jumlah transaksi biasanya bulat
                        fontColor: "#858796",
                        padding: 10,
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: { display: false },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretSize: 6,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        return tooltipItem.yLabel + " Unit Kembali";
                    }
                }
            }
        }
    });

    // --- 3. Handler Laporan Admin (Ajax) ---
    $(document).ready(function() {
    $('#formLaporAdmin').on('submit', function(e) {
        e.preventDefault();

        let btn = $('#btnKirimLaporan');
        let form = $(this);
        let statusMsg = $('.last-report-status');

        // Validasi Sederhana
        if($('#pesanLaporan').val().trim() === "") {
            alert("Silakan tulis pesan terlebih dahulu.");
            return;
        }

        // Animasi Loading
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...');

        $.ajax({
            url: "<?php echo e(route('laporan.admin.store')); ?>", // Ganti dengan route POST kamu
            type: "POST",
            data: form.serialize(), // Mengambil semua input berdasarkan atribut 'name'
            success: function(response) {
                // Notifikasi Sukses visual
                statusMsg.fadeIn().delay(3000).fadeOut();
                
                // Reset Form
                form[0].reset();
                
                // Jika ingin update daftar laporan di samping secara otomatis:
                // location.reload(); // atau panggil fungsi load data
            },
            error: function(xhr) {
                alert('Gagal mengirim: ' + xhr.statusText);
            },
            complete: function() {
                btn.prop('disabled', false).html('Kirim Laporan <i class="fas fa-paper-plane ml-2"></i>');
            }
        });
    });
});

    // --- 4. Fungsi Copy Promo ---
    function copyCode() {
        const text = document.getElementById('codeText').innerText;
        navigator.clipboard.writeText(text);
        alert("❄️ Kode Promo " + text + " Berhasil Disalin!");
    }
    function copyCode(code) {
    navigator.clipboard.writeText(code).then(() => {
        // Efek feedback sederhana (opsional: bisa ganti dengan SweetAlert atau Toast)
        const btn = event.currentTarget;
        const originalIcon = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check text-success"></i>';
        btn.classList.replace('btn-dark', 'btn-light');
        
        setTimeout(() => {
            btn.innerHTML = originalIcon;
            btn.classList.replace('btn-light', 'btn-dark');
        }, 2000);
    });
}
</script>
   <footer class="footer-minimal mt-5">
    <div class="container text-center pb-4">
        <div class="footer-content">
            <p class="mb-0 copyright-text">
                <i class="fas fa-snowflake snowflake-icon"></i>
                <span>Copyright &copy; <?php echo e(date('Y')); ?> <strong>MobiRent</strong>.</span>
                <span class="animated-dash">—</span>
                <span class="edition-text">Ice Aesthetics Edition</span>
                <i class="fas fa-snowflake snowflake-icon"></i>
            </p>
            <div class="mt-2 status-text">
                <span class="typing-animation">System Status: Optimal & Freezing...</span>
            </div>
        </div>
    </div>
</footer>
</body>
</html><?php /**PATH C:\yujimin\karina\resources\views/dashboard/index.blade.php ENDPATH**/ ?>