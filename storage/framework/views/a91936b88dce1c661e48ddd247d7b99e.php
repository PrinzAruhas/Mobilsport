<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Berkas & Unit - MobiRent ❄️</title>
    
    <link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --ice-bg: #f4f7fa;
            --primary-blue: #3b71ca;
            --accent-blue: #14397a;
            --glass: rgba(255, 255, 255, 0.98);
        }

        body {
            background-color: var(--ice-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1a1c1e;
        }

        .glass-card {
            background: var(--glass);
            border-radius: 20px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        }

        .table > :not(caption) > * > * {
            padding: 1rem 1rem;
            background-color: transparent;
            border-bottom-width: 1px;
        }

        .table thead th {
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        .img-preview {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }

        .img-preview:hover {
            transform: scale(1.05);
            border-color: var(--primary-blue);
        }

        .badge-status {
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.65rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pending { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
        .status-approved { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }

        .btn-action {
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: 700;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .btn-primary-custom {
            background-color: var(--primary-blue);
            color: white;
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: var(--accent-blue);
            color: white;
        }
        
        .fw-800 { font-weight: 800; }
        .modal-content { border-radius: 24px; }
        
        /* Indikator Warna Berdasarkan Text di DB */
        .color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            border: 1px solid rgba(0,0,0,0.1);
        }
        .color-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.1);
}

.glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}
    </style>
</head>
<body>

<div class="container py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-7">
            <h1 class="fw-800 mb-1">Verifikasi Transaksi 🧊</h1>
            <p class="text-secondary">Pusat validasi dokumen dan konfirmasi unit armada.</p>
        </div>
        <div class="col-md-5 text-md-end">
            <div class="glass-card d-inline-flex align-items-center px-4 py-3">
                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                    <i class="fas fa-file-invoice text-primary"></i>
                </div>
                <div class="text-start">
                    <div class="small text-muted fw-bold">Perlu Verifikasi</div>
                    <div class="h5 fw-bold mb-0 text-primary"><?php echo e($transaksi->where('status', 'menunggu_verifikasi')->count()); ?> Order</div>
                </div>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4">
            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="glass-card overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Customer</th>
                        <th>Unit Armada (Plat)</th>
                        <th>Pembayaran</th>
                        <th>Dokumen</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" style="width: 40px; height: 40px; font-size: 1rem;">
                                    <?php echo e(substr($t->user->name ?? 'C', 0, 1)); ?>

                                </div>
                                <div>
                                    <div class="fw-bold text-dark"><?php echo e($t->user->name ?? 'Guest'); ?></div>
                                    <span class="text-muted" style="font-size: 0.75rem;">ID: #TRX-<?php echo e($t->id); ?></span>
                                </div>
                            </div>
                        </td>
                      
<td class="align-top">
    <div class="fw-bold text-dark small mb-2">
        <?php echo e($t->mobil->merek ?? 'Mobil'); ?>

    </div>
    
    <div class="d-flex flex-wrap gap-1">
        <?php $__empty_2 = true; $__currentLoopData = $t->mobil_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
            <span class="badge bg-white text-primary border px-2 py-1 shadow-sm">
                <span class="color-dot me-1" style="background-color: <?php echo e(strtolower($unit->warna) == 'white' ? '#e2e8f0' : (strtolower($unit->warna) == 'silver' ? '#a0aec0' : $unit->warna)); ?>;"></span>
                <?php echo e($unit->no_polisi); ?>

            </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
            <span class="text-muted small">Tidak ada unit</span>
        <?php endif; ?>
    </div>
</td>
<div class="bg-light rounded-4 p-3 mb-4 border">
    <label class="small fw-bold text-secondary mb-2 d-block">DETAIL UNIT TERPILIH:</label>
    <div class="d-flex align-items-center mb-2">
        <div class="rounded-3 border bg-white p-2 d-flex align-items-center w-100">
            <div class="ms-2">
                
                <div class="fw-bold small">
                    <?php echo e($t->mobil->merek ?? 'Data'); ?> <?php echo e($t->mobil->model ?? 'Mobil'); ?>

                </div>
               <?php $__currentLoopData = $t->mobil_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="text-primary fw-bold" style="font-size:0.85rem;font-family:monospace;">
    <?php echo e($unit->no_polisi); ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
                        </td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1 mb-1" style="font-size: 0.65rem;">
                                <?php echo e(strtoupper(str_replace('_', ' ', $t->metode_pembayaran))); ?>

                            </span>
                            <br>
                            <?php if($t->struk_pembayaran === 'simulasi'): ?>
                                <div class="badge bg-warning text-dark rounded-3 p-2" style="font-size: 0.65rem;">
                                    <i class="fas fa-magic me-1"></i> SIMULASI
                                </div>
                            <?php elseif($t->struk_pembayaran): ?>
                                <img src="<?php echo e(asset('storage/' . $t->struk_pembayaran)); ?>" class="img-preview" onclick="viewImage('<?php echo e(asset('storage/' . $t->struk_pembayaran)); ?>', 'Bukti Transfer')">
                            <?php else: ?>
                                <span class="text-muted small italic">COD / Belum Bayar</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <img src="<?php echo e(asset('storage/' . $t->foto_ktp)); ?>" class="img-preview" onclick="viewImage('<?php echo e(asset('storage/' . $t->foto_ktp)); ?>', 'KTP Customer')">
                                <img src="<?php echo e(asset('storage/' . $t->foto_sim)); ?>" class="img-preview" onclick="viewImage('<?php echo e(asset('storage/' . $t->foto_sim)); ?>', 'SIM Customer')">
                            </div>
                        </td>
                        <td>
                            <?php if($t->status == 'menunggu_verifikasi'): ?>
                                <span class="badge-status status-pending">
                                    <i class="fas fa-spinner fa-spin"></i> REVIEW
                                </span>
                            <?php elseif($t->status == 'disetujui'): ?>
                                <span class="badge-status status-approved">
                                    <i class="fas fa-check-circle"></i> VERIFIED
                                </span>
                            <?php else: ?>
                                <span class="badge-status bg-danger bg-opacity-10 text-danger border-danger">
                                    <i class="fas fa-times-circle"></i> <?php echo e(strtoupper($t->status)); ?>

                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($t->status == 'menunggu_verifikasi'): ?>
                                <button class="btn btn-action btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalVerifikasi<?php echo e($t->id); ?>">
                                    <i class="fas fa-tasks me-1"></i> Kelola
                                </button>
                            <?php else: ?>
                                <button class="btn btn-action btn-light border" disabled>
                                    <i class="fas fa-check"></i> Selesai
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted fw-bold">Belum ada transaksi masuk.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="modalVerifikasi<?php echo e($t->id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form action="<?php echo e(route('teknisi.verifikasi.update', $t->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                            <i class="fas fa-car-side fa-2x text-primary"></i>
                        </div>
                        <h4 class="fw-800 mb-1">Verifikasi Order #<?php echo e($t->id); ?></h4>
                        <p class="text-muted small">Customer: <strong><?php echo e($t->user->name ?? 'Guest'); ?></strong></p>
                    </div>

                  <div class="bg-light rounded-4 p-3 mb-4 border">
    <label class="small fw-bold text-secondary mb-2 d-block">DETAIL UNIT TERPILIH:</label>
    <?php $__empty_1 = true; $__currentLoopData = $t->mobil_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="rounded-3 border bg-white p-2 mb-2 d-flex align-items-center">
        <div class="color-dot me-3" style="background-color: <?php echo e(strtolower($unit->warna) == 'white' ? '#e2e8f0' : (strtolower($unit->warna) == 'silver' ? '#a0aec0' : $unit->warna)); ?>; border: 1px solid #ccc;"></div>
        
        <div>
            <div class="fw-bold small">
                <?php echo e($t->mobil->merek ?? 'Mobil'); ?> - <?php echo e($unit->warna); ?>

            </div>
            <div class="text-primary fw-bold" style="font-size: 0.85rem; font-family: monospace;">
                <?php echo e($unit->no_polisi); ?>

            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="text-muted small">Tidak ada unit terkait.</div>
    <?php endif; ?>
</div>
                    
                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="status" id="setuju<?php echo e($t->id); ?>" value="disetujui" checked>
                            <label class="btn btn-outline-success w-100 py-3 rounded-4 fw-bold" for="setuju<?php echo e($t->id); ?>">
                                <i class="fas fa-check-circle fa-2x d-block mb-2"></i> SETUJU
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="status" id="tolak<?php echo e($t->id); ?>" value="ditolak">
                            <label class="btn btn-outline-danger w-100 py-3 rounded-4 fw-bold" for="tolak<?php echo e($t->id); ?>">
                                <i class="fas fa-times-circle fa-2x d-block mb-2"></i> TOLAK
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Catatan (Opsional)</label>
                        <textarea name="catatan" class="form-control rounded-4 border-0 bg-light p-3" rows="2" placeholder="Contoh: Unit siap di pool utama"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 py-3 rounded-4 fw-bold shadow-sm">
                        KONFIRMASI
                    </button>
                    <button type="button" class="btn btn-link w-100 text-muted text-decoration-none mt-2 small" data-bs-dismiss="modal">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="modal fade" id="modalZoom" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0">
                <img src="" id="zoomImg" class="img-fluid rounded-4 shadow-lg border border-4 border-white">
                <h6 class="text-white mt-3 fw-bold" id="zoomTitle"></h6>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function viewImage(url, title) {
        document.getElementById('zoomImg').src = url;
        document.getElementById('zoomTitle').innerText = title;
        new bootstrap.Modal(document.getElementById('modalZoom')).show();
    }
</script>

</body>
</html><?php /**PATH C:\yujimin\karina\resources\views/teknisi/verifikasi.blade.php ENDPATH**/ ?>