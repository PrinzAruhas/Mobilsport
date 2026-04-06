<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MobiRent - Premium Directory ❄️</title>

    <link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --ice-bg: #f0f4f8;
            --ice-primary: #a2d2ff;
            --ice-secondary: #bde0fe;
        }

        body { 
            background-color: var(--ice-bg) !important; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2d3436;
        }

        .snow-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999; }

        /* Card Styling */
        .user-card {
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
            background: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(20px);
            border-radius: 32px !important;
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: visible;
        }

        .user-card:hover { 
            transform: translateY(-12px) scale(1.02); 
            box-shadow: 0 30px 60px rgba(162, 210, 255, 0.25) !important;
            background: rgba(255, 255, 255, 0.9) !important;
        }

        .profile-banner {
            height: 110px;
            background: linear-gradient(135deg, var(--ice-primary), var(--ice-secondary), #ccd5ff);
            background-size: 200% 200%;
            animation: gradientMove 6s ease infinite;
            border-radius: 30px 30px 20% 20%;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .avatar-wrapper {
            position: absolute;
            left: 50%;
            top: 60px;
            transform: translateX(-50%);
            z-index: 10;
        }

        .user-avatar-main {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            border: 6px solid white;
            object-fit: cover;
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .user-name { font-weight: 800; color: #1a1a1a; letter-spacing: -0.5px; margin-top: 55px; }
        .user-email { font-size: 0.8rem; color: #636e72; font-weight: 500; }

        /* Premium Badge Styling */
        .custom-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 800;
            margin: 15px 0;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: 0.3s;
        }

        .badge-admin { background: rgba(255, 133, 133, 0.15) !important; color: #ff5e5e !important; }
        .badge-teknisi { background: rgba(255, 201, 113, 0.15) !important; color: #f39c12 !important; }
        .badge-peminjam { background: rgba(142, 208, 129, 0.15) !important; color: #27ae60 !important; }
        .badge-default { background: #f0f4f8 !important; color: #95a5a6 !important; }

        /* Action Buttons */
        .btn-group-custom {
            background: rgba(240, 244, 248, 0.8);
            padding: 8px;
            border-radius: 20px;
            display: inline-flex;
            gap: 10px;
        }

        .btn-circle-action {
            width: 42px;
            height: 42px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: 0.3s;
            background: white;
            color: #636e72;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        .btn-edit:hover { background: var(--ice-primary); color: white; transform: rotate(-10deg); }
        .btn-delete:hover { background: #ff7675; color: white; transform: rotate(10deg); }

        .header-title {
            font-weight: 800;
            background: linear-gradient(to right, #2d3436, var(--ice-primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        <>
    /* ... (style sebelumnya tetap ada) ... */

    .avatar-edit-container {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .avatar-preview-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 10px 20px rgba(162, 210, 255, 0.3);
        object-fit: cover;
        background: white;
    }

    .btn-upload-overlay {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--ice-primary);
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-upload-overlay:hover {
        transform: scale(1.1);
        background: #00b894;
    }

    .banner-preview-small {
        height: 60px;
        width: 100%;
        border-radius: 15px;
        background: linear-gradient(135deg, var(--ice-primary), var(--ice-secondary));
        margin-bottom: -30px;
        position: relative;
        z-index: 0;
    }

    /* Animasi Loading saat Submit */
.btn-loading {
    position: relative;
    color: transparent !important;
}
.btn-loading::after {
    content: "";
    position: absolute;
    width: 20px;
    height: 20px;
    top: 50%;
    left: 50%;
    margin: -10px 0 0 -10px;
    border: 3px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.8s linear infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Animasi Masuk Modal */
.modal.fade .modal-dialog {
    transform: scale(0.8);
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.modal.show .modal-dialog {
    transform: scale(1);
}

/* Hover Effect pada Pilihan Role */
.role-option:hover {
    background: var(--ice-secondary) !important;
    transform: translateX(5px);
    transition: 0.3s;
}

    </style>
</head>

<body>
    <div class="snow-container" id="snow"></div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5 bg-white p-4 shadow-sm" style="border-radius: 25px;">
            <div>
                <h2 class="header-title mb-1">MobiRent Network ❄️</h2>
                <p class="text-muted mb-0 font-weight-bold">Total Anggota: <?php echo e(count($users)); ?></p>
            </div>
            <a href="/dashboard" class="btn btn-light px-4 py-2" style="border-radius: 14px; font-weight: 700; border: 1px solid #ddd;">
                <i class="fas fa-th-large mr-2 text-primary"></i> Dashboard
            </a>
        </div>

        <div class="row">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $roleId = is_object($user->role) ? $user->role->id : $user->role_id;
                $roleName = is_object($user->role) ? $user->role->name : 'User';

                $roleConfig = match ((int)$roleId) {
                    1 => ['class' => 'badge-admin', 'icon' => 'fa-crown', 'label' => 'Admin'],
                    2 => ['class' => 'badge-teknisi', 'icon' => 'fa-tools', 'label' => 'Teknisi'],
                    3 => ['class' => 'badge-peminjam', 'icon' => 'fa-user-tag', 'label' => 'Peminjam'],
                    default => ['class' => 'badge-default', 'icon' => 'fa-user', 'label' => $roleName],
                };
            ?>

            <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                <div class="card user-card h-100 shadow-sm">
                    <div class="profile-banner"></div>

                    <div class="avatar-wrapper">
                        <?php if($user->avatar): ?>
                            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="user-avatar-main shadow">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=a2d2ff&color=fff&bold=true" class="user-avatar-main shadow">
                        <?php endif; ?>
                    </div>

                    <div class="card-body text-center">
                        <h5 class="user-name mb-1 text-truncate"><?php echo e($user->name); ?></h5>
                        <p class="user-email text-truncate mb-0"><?php echo e($user->email); ?></p>

                        <div class="custom-badge <?php echo e($roleConfig['class']); ?>">
                            <i class="fas <?php echo e($roleConfig['icon']); ?> mr-2"></i> <?php echo e(strtoupper($roleConfig['label'])); ?>

                        </div>

                        <hr style="border-top: 1px dashed #eee; width: 80%;">
                        
                        <div class="btn-group-custom">
                            <button class="btn-circle-action btn-edit" title="Ubah Akses" data-toggle="modal" data-target="#modalEdit<?php echo e($user->id); ?>">
                                <i class="fas fa-shield-alt"></i>
                            </button>
                            <button class="btn-circle-action btn-delete" title="Hapus User" onclick="confirmDelete('<?php echo e($user->id); ?>')">
                                <i class="fas fa-user-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalEdit<?php echo e($user->id); ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 28px; overflow: hidden;">
                            <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #a2d2ff, #bde0fe);">
                                <h5 class="modal-title font-weight-bold text-white">
                                    <i class="fas fa-shield-alt mr-2"></i> Pengaturan Akses
                                </h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <form action="<?php echo e(route('users.update', $user->id)); ?>" method="POST" class="role-update-form">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="modal-body p-4 text-center">
        <div class="role-icon-preview mb-3" style="font-size: 3rem; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
            <i class="fas <?php echo e($roleConfig['icon']); ?> text-primary animate__animated animate__bounceIn"></i>
        </div>

        <div class="mb-4">
            <h6 class="font-weight-bold mb-0"><?php echo e($user->name); ?></h6>
            <span class="text-muted small">ID Anggota: #<?php echo e($user->id); ?></span>
        </div>

        <div class="form-group text-left">
            <label class="small font-weight-bold text-uppercase text-muted">Pilih Level Akses Baru</label>
            <select name="role_id" class="form-control border-0 bg-light role-select" 
                    style="border-radius: 15px; height: 55px; font-weight: 600; cursor: pointer;">
                <option value="1" <?php echo e($roleId == 1 ? 'selected' : ''); ?>>🛡️ ADMINISTRATOR</option>
                <option value="2" <?php echo e($roleId == 2 ? 'selected' : ''); ?>>🔧 STAFF TEKNIS</option>
                <option value="3" <?php echo e($roleId == 3 ? 'selected' : ''); ?>>👥 PEMINJAM / USER</option>
            </select>
        </div>
    </div>

    <div class="modal-footer border-0 p-4 bg-light" style="border-radius: 0 0 28px 28px;">
        <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary px-5 btn-save-role" 
                style="border-radius: 15px; background: linear-gradient(135deg, #a2d2ff, #74b9ff); border: none; font-weight: 700; height: 50px;">
            Simpan Perubahan
        </button>
    </div>
</form>

<?php if(session('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "<?php echo e(session('success')); ?>",
        showConfirmButton: false,
        timer: 2500,
        background: '#fff',
        borderRadius: '25px'
    });
<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <script src="<?php echo e(asset('assets/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Putuskan Akses?',
                text: "User ini akan dihapus dari direktori.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#a2d2ff',
                cancelButtonColor: '#ff8585',
                confirmButtonText: 'Ya, Hapus',
                borderRadius: '25px'
            }).then((result) => { 
                if (result.isConfirmed) {
                    // Pastikan ada form delete dengan ID ini di halaman
                    // document.getElementById('delete-form-' + id).submit(); 
                }
            });
        }

        function createSnowflake() {
            const snow = document.getElementById('snow');
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
            snow.appendChild(flake);
            setTimeout(() => {
                flake.style.transform = `translateY(100vh) translateX(${Math.random() * 20 - 10}px)`;
                flake.style.opacity = '0';
            }, 100);
            setTimeout(() => flake.remove(), 6000);
        }
        setInterval(createSnowflake, 150);
    </script>
</body>
</html><?php /**PATH C:\yujimin\karina\resources\views/users/index.blade.php ENDPATH**/ ?>