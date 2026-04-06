<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e($mobil->merek); ?> - Detail Premium ❄️</title>
    
    <link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,700,800" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/sb-admin-2.min.css')); ?>" rel="stylesheet">

    <style>
        :root {
            --ice-bg: #f0f8ff;
            --ice-primary: #00a8ff;
            --ice-gradient: linear-gradient(135deg, #a2d2ff 0%, #7db9f0 100%);
            --glass: rgba(255, 255, 255, 0.8);
            --text-dark: #2d3436;
        }

        body { 
            background-color: var(--ice-bg); 
            font-family: 'Nunito', sans-serif; 
            color: var(--text-dark);
            overflow-x: hidden;
        }

        #snow-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .container { position: relative; z-index: 1; }

        /* Glass Card Effect */
        .glass-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 20px 50px rgba(162, 210, 255, 0.15);
        }

        /* Image Styling */
        .img-detail-wrapper {
            width: 100%;
            height: 450px;
            border-radius: 25px;
            overflow: hidden;
            background: #fff;
            margin-bottom: 25px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }

        .img-detail-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .img-detail-wrapper:hover img {
            transform: scale(1.05);
        }

        /* Specs Grid */
        .spec-item {
            background: rgba(255,255,255,0.6);
            border-radius: 20px;
            padding: 20px 10px;
            text-align: center;
            border: 1px solid white;
            transition: all 0.3s ease;
            height: 100%;
        }

        .spec-item:hover {
            background: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(162, 210, 255, 0.2);
        }

        .spec-item i {
            font-size: 1.5rem;
            background: var(--ice-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        /* Langkah Sewa Styling */
        .step-card {
            padding: 20px 10px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            border: 1px solid white;
            transition: 0.3s;
            height: 100%;
        }
        .step-card:hover {
            background: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(162, 210, 255, 0.1);
        }
        .step-icon {
            width: 40px;
            height: 40px;
            background: var(--ice-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 10px;
            font-size: 0.9rem;
            box-shadow: 0 5px 10px rgba(162, 210, 255, 0.3);
        }

        /* Price Section */
        .price-badge {
            background: var(--ice-gradient);
            color: white;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(125, 185, 240, 0.4);
        }

        /* Form Controls */
        .form-control {
            border-radius: 12px;
            border: 2px solid #e1eefb;
            padding: 12px 15px;
            height: auto;
            font-weight: 700;
        }

        .form-control:focus {
            border-color: var(--ice-primary);
            box-shadow: 0 0 0 4px rgba(0, 168, 255, 0.1);
        }

        /* Unit Selection Card */
        .unit-card {
            transition: all 0.2s ease;
        }
        .unit-card:hover {
            background: #f0f8ff !important;
            border-color: var(--ice-primary) !important;
        }
        .unit-card.selected {
            background: #e6f3ff !important;
            border-color: var(--ice-primary) !important;
            box-shadow: 0 4px 10px rgba(0, 168, 255, 0.1);
        }

        /* Tombol Booking Premium */
        .btn-booking {
            position: relative;
            background: linear-gradient(135deg, #0984e3 0%, #00a8ff 100%);
            border: none;
            border-radius: 20px;
            height: 75px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: white !important;
        }

        .btn-booking:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 168, 255, 0.4);
        }

        .btn-shine {
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.6s;
        }

        .btn-booking:hover .btn-shine { left: 100%; }

        .btn-icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .summary-card {
            background: rgba(255, 255, 255, 0.6);
            border: 2px solid #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: inset 0 0 15px rgba(162, 210, 255, 0.1);
        }

        .total-amount {
            font-weight: 900;
            color: var(--ice-primary);
            font-size: 1.75rem;
        }

        .sticky-sidebar { position: -webkit-sticky; position: sticky; top: 30px; }
        .description-text { line-height: 1.8; color: #636e72; font-size: 1.05rem; }
        
        /* Media Switcher Styling */
        .media-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            padding: 5px;
            border-radius: 15px;
            border: 1px solid white;
        }

        .btn-switch {
            border: none;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.85rem;
            transition: all 0.3s;
            background: transparent;
            color: var(--text-dark);
        }

        .btn-switch.active {
            background: var(--ice-gradient);
            color: white;
            box-shadow: 0 5px 15px rgba(125, 185, 240, 0.4);
        }

        .video-container {
            background: #000;
            width: 100%;
            height: 100%;
            display: none;
        }
      /* Revamped Comment Section */
.comment-section {
    margin-top: 80px;
    padding-top: 40px;
    position: relative;
}

/* Judul dengan aksen line */
.section-title-wrapper {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
}
.section-line {
    flex-grow: 1;
    height: 2px;
    background: linear-gradient(to right, var(--ice-primary), transparent);
    margin-left: 20px;
    border-radius: 2px;
}

/* Form Input Mewah */
.comment-form-box {
    background: white;
    border-radius: 25px;
    padding: 25px;
    border: 1px solid rgba(162, 210, 255, 0.3);
    box-shadow: 0 15px 35px rgba(162, 210, 255, 0.1);
    transition: all 0.3s ease;
}
.comment-form-box:focus-within {
    box-shadow: 0 15px 40px rgba(0, 168, 255, 0.15);
    transform: translateY(-2px);
}

/* Card Komentar */
.comment-card {
    background: white;
    border-radius: 22px;
    padding: 25px;
    border: 1px solid #f0f5fa;
    box-shadow: 0 10px 25px rgba(0,0,0,0.02);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    margin-bottom: 20px;
}
.comment-card:hover {
    box-shadow: 0 15px 35px rgba(162, 210, 255, 0.2);
    border-color: var(--ice-primary);
}

/* Avatar yang lebih stylish */
.user-avatar {
    width: 50px;
    height: 50px;
    background: var(--ice-gradient);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 800;
    font-size: 1.3rem;
    box-shadow: 0 8px 15px rgba(125, 185, 240, 0.3);
    flex-shrink: 0;
}

/* Balasan (Replies) */
.reply-wrapper {
    margin-left: 60px;
    border-left: 3px solid #e1eefb;
    padding-left: 25px;
    margin-top: -10px;
    margin-bottom: 30px;
}

.reply-card {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 18px;
    padding: 18px;
    margin-bottom: 12px;
    border: 1px solid white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.01);
}

/* Badge Peran (Optional: Jika ingin membedakan Admin/User) */
.badge-role {
    font-size: 0.65rem;
    padding: 2px 8px;
    border-radius: 50px;
    background: #eef7fb;
    color: var(--ice-primary);
    margin-left: 8px;
    vertical-align: middle;
}

.btn-reply-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    color: #a0a0a0;
    font-size: 0.8rem;
    font-weight: 700;
    transition: 0.3s;
    margin-top: 10px;
}
.btn-reply-link:hover {
    color: var(--ice-primary);
    transform: translateX(3px);
}
    </style>
</head>
<body>

    <canvas id="snow-canvas"></canvas>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <a href="<?php echo e(route('mobil.katalog')); ?>" class="btn btn-white shadow-sm px-4 py-2" style="border-radius: 50px; background: white; font-weight: 700;">
                <i class="fas fa-arrow-left mr-2 text-info"></i> Kembali ke Katalog
            </a>
            <div class="d-flex align-items-center bg-white px-3 py-2 rounded-pill shadow-sm">
                <div class="bg-success rounded-circle mr-2" style="width: 10px; height: 10px;"></div>
                <span class="small font-weight-bold text-dark">Tersedia Sekarang</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="glass-card p-4 p-md-5 mb-4">
                    <div class="position-relative">
                        <div class="media-switcher d-flex">
                            <button type="button" class="btn-switch active" id="btn-foto" onclick="toggleMedia('foto')">
                                <i class="fas fa-camera mr-2"></i>FOTO
                            </button>
                            <button type="button" class="btn-switch" id="btn-video" onclick="toggleMedia('video')">
                                <i class="fas fa-play mr-2"></i>VIDEO
                            </button>
                        </div>

                        <div class="img-detail-wrapper">
                            <div id="display-foto" class="h-100">
                              <?php if($mobil->gambar): ?>
<img src="<?php echo e(asset('storage/' . $mobil->gambar)); ?>" 
     alt="<?php echo e($mobil->merek); ?>"
     onerror="this.onerror=null;this.src='https://placehold.co/600x400/eef7fb/a2d2ff?text=No+Image';">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                        <i class="fas fa-car-side fa-5x text-white"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div id="display-video" class="video-container">
                               <?php if($mobil->video): ?>
<video id="player-video" width="100%" height="100%" controls style="object-fit: cover;">
    <source src="<?php echo e(asset('storage/' . $mobil->video)); ?>" type="video/mp4">
</video>

                                <?php else: ?>
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-white p-5 text-center">
                                        <i class="fas fa-video-slash fa-3x mb-3 text-info"></i>
                                        <p class="small font-weight-bold">Video review belum tersedia untuk unit ini ❄️</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-4">
                            <div class="spec-item">
                                <i class="fas fa-users"></i>
                                <p class="small mb-1 text-uppercase font-weight-bold text-muted">Kapasitas</p>
                                <h6 class="font-weight-bold mb-0 text-dark"><?php echo e($mobil->kapasitas ?? '5'); ?> Kursi</h6>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="spec-item">
                                <i class="fas fa-cog"></i>
                                <p class="small mb-1 text-uppercase font-weight-bold text-muted">Transmisi</p>
                                <h6 class="font-weight-bold mb-0 text-dark"><?php echo e($mobil->transmisi ?? 'Automatic'); ?></h6>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="spec-item">
                                <i class="fas fa-gas-pump"></i>
                                <p class="small mb-1 text-uppercase font-weight-bold text-muted">Bahan Bakar</p>
                                <h6 class="font-weight-bold mb-0 text-dark"><?php echo e($mobil->bahan_bakarnya ?? 'Bensin'); ?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="font-weight-bold text-dark mb-4">
                            <i class="fas fa-align-left mr-2 text-info"></i> Deskripsi & Keunggulan
                        </h4>
                        <div class="description-text p-4 rounded-lg" style="background: rgba(255,255,255,0.4); border-left: 5px solid var(--ice-primary);">
                            <?php echo e($mobil->deskripsi ?? 'Setiap armada telah melalui proses sanitasi kristal sebelum diserahkan kepada Anda. Nikmati kenyamanan berkendara dengan performa mesin tangguh.'); ?>

                        </div>
                    </div>

                    <div class="mt-5 pt-4" style="border-top: 2px dashed rgba(162, 210, 255, 0.3);">
                        <h5 class="font-weight-bold mb-4 text-dark text-center">3 LANGKAH MUDAH SEWA ❄️</h5>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="step-card">
                                    <div class="step-icon"><i class="fas fa-mouse-pointer"></i></div>
                                    <p class="small font-weight-bold mb-0">1. Booking</p>
                                    <small class="text-muted">Pilih tanggal & unit</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="step-card">
                                    <div class="step-icon"><i class="fas fa-file-upload"></i></div>
                                    <p class="small font-weight-bold mb-0">2. Verifikasi</p>
                                    <small class="text-muted">Upload KTP/SIM</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="step-card">
                                    <div class="step-icon"><i class="fas fa-key"></i></div>
                                    <p class="small font-weight-bold mb-0">3. Gas!</p>
                                    <small class="text-muted">Ambil kunci & jalan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card p-4 sticky-sidebar shadow-lg">
                    <div class="mb-4">
                        <h2 class="font-weight-extrabold text-dark mb-1"><?php echo e($mobil->merek); ?></h2>
                        <h5 class="text-info font-weight-bold"><?php echo e($mobil->model); ?></h5>
                    </div>

        <div class="price-badge mb-4">
    <span class="small font-weight-bold text-uppercase opacity-75">Tarif Sewa</span>
    <div class="d-flex flex-column align-items-center">
        <?php
            // 1. Ambil data promo dari session
            $promo = session('applied_promo');
            $diskonRedeem = 0;

            if ($promo) {
                $pType = $promo['type'] ?? 'all';
                $pTargetId = $promo['target_id'] ?? null;
                $valPromo = $promo['discount'] ?? 0; 

                if ($pType == 'all') {
                    $diskonRedeem = (int)$valPromo;
                } elseif ($pType == 'category' && (int)$mobil->category_id === (int)$pTargetId) {
                    $diskonRedeem = (int)$valPromo;
                } elseif ($pType == 'unit' && (int)$mobil->id === (int)$pTargetId) {
                    $diskonRedeem = (int)$valPromo;
                }
            }

            // 2. Hitung Harga
            $hargaAwal = $mobil->harga_sewa;
            $potonganUnit = $hargaAwal * ($mobil->diskon / 100);
            $hargaSetelahUnit = $hargaAwal - $potonganUnit;

            $potonganRedeem = $hargaSetelahUnit * ($diskonRedeem / 100);
            $hargaAkhir = $hargaSetelahUnit - $potonganRedeem;
        ?>

        
        <?php if($mobil->diskon > 0 || $diskonRedeem > 0): ?>
            <small class="text-white-50" style="text-decoration: line-through; font-size: 0.9rem;">
                Rp<?php echo e(number_format($hargaAwal, 0, ',', '.')); ?>

            </small>
            <div class="d-flex align-items-baseline">
                <span class="h2 mb-0 font-weight-extrabold text-white">Rp<?php echo e(number_format($hargaAkhir, 0, ',', '.')); ?></span>
                <span class="ml-1 font-weight-bold opacity-75 text-white">/hari</span>
            </div>
            
            <div class="d-flex flex-column align-items-center mt-1" style="gap: 4px;">
                
                <?php if($mobil->diskon > 0): ?>
                    <span class="badge badge-warning px-3 py-1 shadow-sm" style="border-radius: 50px; font-size: 0.7rem;">
                        <i class="fas fa-fire mr-1"></i> UNIT DISKON <?php echo e($mobil->diskon); ?>%
                    </span>
                <?php endif; ?>
                
                
                <?php if($diskonRedeem > 0): ?>
                    <span class="badge badge-success px-3 py-1 shadow-sm" style="border-radius: 50px; font-size: 0.7rem;">
                        <i class="fas fa-ticket-alt mr-1"></i> PROMO REDEEM <?php echo e($diskonRedeem); ?>%
                    </span>
                <?php endif; ?>
            </div>
        <?php else: ?>
            
            <div class="d-flex align-items-baseline mt-1">
                <span class="h2 mb-0 font-weight-extrabold text-white">Rp<?php echo e(number_format($hargaAwal, 0, ',', '.')); ?></span>
                <span class="ml-1 font-weight-bold opacity-75 text-white">/hari</span>
            </div>
        <?php endif; ?>
    </div>
</div>

                    <form action="<?php echo e(route('sewa.create')); ?>" method="GET" id="bookingForm">
                        <input type="hidden" name="mobil_id" value="<?php echo e($mobil->id); ?>">
                        
                        <div class="form-group mb-4">
                            <label class="small font-weight-bold text-dark ml-1 text-uppercase">Pilih Unit (Bisa Lebih Dari 1)</label>
                            
                            <div class="p-2" style="max-height: 250px; overflow-y: auto; border: 2px solid #e1eefb; border-radius: 12px; background: rgba(255,255,255,0.5);">
                                <?php $__empty_1 = true; $__currentLoopData = $mobil->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <label class="unit-card d-flex align-items-center p-2 mb-2 rounded shadow-sm m-0" style="background: white; cursor: pointer; border: 1px solid #e1eefb;">
                                    <input type="checkbox" name="unit_ids[]" value="<?php echo e($unit->id); ?>" class="unit-checkbox mr-3" style="width: 20px; height: 20px; accent-color: var(--ice-primary);">
                                    
                                <?php if($unit->foto_unit): ?>
<img src="<?php echo e(asset('storage/' . $unit->foto_unit)); ?>"
     class="rounded mr-3"
     style="width: 70px; height: 50px; object-fit: cover;"
     onclick="showZoom('<?php echo e(asset('storage/' . $unit->foto_unit)); ?>')">
<?php else: ?>
<div class="rounded mr-3 d-flex align-items-center justify-content-center bg-light" style="width: 70px; height: 50px;">
    <i class="fas fa-car text-muted"></i>
</div>
<?php endif; ?>
                                    
                                    <div class="flex-grow-1">
                                        <span class="d-block font-weight-bold text-dark" style="font-size: 0.95rem;"><?php echo e($unit->no_polisi); ?></span>
                                        <span class="badge badge-info" style="background: var(--ice-gradient);"><?php echo e($unit->warna); ?></span>
                                    </div>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center p-3 text-muted small font-weight-bold">
                                    Maaf, unit sedang tidak tersedia di garasi.
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-dark ml-1 text-uppercase">Mulai Sewa</label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required 
                                   value="<?php echo e(date('Y-m-d')); ?>" min="<?php echo e(date('Y-m-d')); ?>">
                        </div>

                        <div class="form-group mb-4">
                            <label class="small font-weight-bold text-dark ml-1 text-uppercase">Kembali Pada</label>
                            <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" required 
                                   value="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>" min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>">
                            
                            <div class="mt-2 p-2 bg-light rounded text-center" style="border: 1px dashed #a2d2ff;">
                                <small class="text-primary font-weight-bold">
                                    <i class="fas fa-clock mr-1"></i> Durasi: <span id="display-durasi">1</span> Hari
                                </small>
                            </div>
                        </div>

                        <input type="hidden" name="durasi" id="durasi_hidden" value="1">

                        <div class="summary-card mb-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small font-weight-bold">Harga Satuan</span>
        <span class="text-dark small font-weight-bold">Rp<?php echo e(number_format($mobil->harga_sewa, 0, ',', '.')); ?></span>
    </div>

    <?php if($mobil->diskon > 0): ?>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small font-weight-bold">Diskon Unit</span>
        <span class="text-danger small font-weight-bold">-<?php echo e($mobil->diskon); ?>%</span>
    </div>
    <?php endif; ?>

    <?php if(isset($diskonRedeem) && $diskonRedeem > 0): ?>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small font-weight-bold">Kode Promo (<?php echo e(session('applied_promo')['code'] ?? 'Aktif'); ?>)</span>
        <span class="text-success small font-weight-bold">-<?php echo e($diskonRedeem); ?>%</span>
    </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small font-weight-bold">Unit Terpilih</span>
        <span class="text-dark small font-weight-bold"><span id="jml-unit">0</span> Mobil</span>
    </div>

   

    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted small font-weight-bold">Pajak</span>
        <span class="text-success small font-weight-bold">Termasuk</span>
    </div>

    <div style="border-top: 2px dashed #d1e3f5; margin: 15px 0;"></div>

    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span class="d-block text-dark font-weight-bold small">Total Estimasi</span>
            <small class="text-muted" style="font-size: 0.7rem;">Sudah termasuk semua potongan</small>
        </div>
        <div class="text-right">
            <h3 class="total-amount mb-0 text-primary" id="totalEstimasi" style="font-weight: 800;">Rp0</h3>
        </div>
    </div>
</div>

                        <button type="submit" class="btn btn-booking btn-block shadow-lg" id="btnSubmit">
                            <div class="btn-shine"></div>
                            <div class="d-flex justify-content-center align-items-center position-relative">
                                <div class="btn-icon-wrapper"><i class="fas fa-calendar-check"></i></div>
                                <div class="text-left ml-3">
                                    <span class="d-block text-uppercase font-weight-extrabold" style="font-size: 0.9rem; line-height: 1.2; letter-spacing: 1px;">Konfirmasi Booking</span>
                                    <small class="opacity-75 font-weight-bold">Amankan Unit Sekarang</small>
                                </div>
                            </div>
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <div class="d-flex justify-content-center mb-2 text-warning">
                            <i class="fas fa-certificate mx-1"></i><i class="fas fa-certificate mx-1"></i><i class="fas fa-certificate mx-1"></i><i class="fas fa-certificate mx-1"></i><i class="fas fa-certificate mx-1"></i>
                        </div>
                        <p class="small text-muted font-weight-bold mb-0">Jaminan Layanan Kristal 5 Bintang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="comment-section">
    <div class="section-title-wrapper">
        <h4 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
            <span class="bg-info p-2 rounded-lg mr-3 shadow-sm">
                <i class="fas fa-comments text-white"></i>
            </span> 
            Diskusi Peminjam
        </h4>
        <div class="section-line"></div>
    </div>

    <?php if(Auth::check()): ?>
    <div class="comment-form-box mb-5">
        <form action="<?php echo e(route('komentar.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="mobil_id" value="<?php echo e($mobil->id); ?>">
            <div class="d-flex gap-3">
                <div class="user-avatar d-none d-md-flex mr-3" style="width: 40px; height: 40px; font-size: 1rem;">
                    <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                </div>
                <div class="flex-grow-1">
                    <textarea name="isi_komentar" class="form-control border-0 bg-light" rows="3" 
                        placeholder="Bagikan pengalaman atau tanya sesuatu..." 
                        style="border-radius: 15px; resize: none; padding: 15px;" required></textarea>
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-info rounded-pill px-4 font-weight-bold shadow-sm">
                            Kirim Diskusi <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <div class="comments-list">
        <?php $__empty_1 = true; $__currentLoopData = $mobil->comments()->whereNull('parent_id')->orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="comment-group mb-4">
                <div class="comment-card">
                    <div class="d-flex">
                        <div class="user-avatar mr-3">
                            <?php echo e(substr($comment->user->name, 0, 1)); ?>

                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="font-weight-bold mb-0 text-dark">
                                        <?php echo e($comment->user->name); ?>

                                        <?php if($comment->user->role_id == 1): ?> <span class="badge-role">Admin</span> <?php endif; ?>
                                    </h6>
<span class="comment-date">
    <i class="far fa-clock mr-1"></i> 
    <?php if($comment->created_at->diffInSeconds() < 60): ?>
        Baru saja
    <?php else: ?>
        <?php echo e($comment->created_at->diffForHumans()); ?>

    <?php endif; ?>
</span>
                                </div>
                            </div>
                            <p class="comment-text mt-3 mb-0"><?php echo e($comment->isi_komentar); ?></p>
                            
                            <?php if(Auth::check()): ?>
                            <a href="javascript:void(0)" class="btn-reply-link" onclick="showReplyForm(<?php echo e($comment->id); ?>)">
                                <i class="fas fa-comment-dots"></i> Balas Tanggapan
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div id="reply-form-<?php echo e($comment->id); ?>" class="mt-4 d-none">
                        <form action="<?php echo e(route('komentar.store')); ?>" method="POST" class="p-3 rounded-lg" style="background: #f8fbff; border: 1px solid #e1eefb;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="mobil_id" value="<?php echo e($mobil->id); ?>">
                            <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                            <textarea name="isi_komentar" class="form-control border-0 mb-2" rows="2" placeholder="Tulis balasan..." style="background: transparent;"></textarea>
                            <div class="text-right">
                                <button type="button" class="btn btn-sm text-muted mr-2" onclick="showReplyForm(<?php echo e($comment->id); ?>)">Batal</button>
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">Balas</button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if($comment->replies->count() > 0): ?>
                <div class="reply-wrapper">
                    <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reply-card">
                            <div class="d-flex align-items-start">
                                <div class="user-avatar mr-3" style="width: 35px; height: 35px; font-size: 0.9rem; border-radius: 12px;">
                                    <?php echo e(substr($reply->user->name, 0, 1)); ?>

                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <span class="font-weight-bold small text-dark">
                                            <?php echo e($reply->user->name); ?>

                                            <?php if($reply->user->role_id == 1): ?> <span class="badge-role">Admin</span> <?php endif; ?>
                                        </span>
                                        <span class="comment-date" style="font-size: 0.65rem;"><?php echo e($reply->created_at->diffForHumans()); ?></span>
                                    </div>
                                    <p class="comment-text mb-0 mt-1 small text-secondary"><?php echo e($reply->isi_komentar); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5 glass-card border-0">
                <div class="mb-3">
                    <i class="far fa-comments fa-4x text-info opacity-25"></i>
                </div>
                <h6 class="text-muted font-weight-bold">Belum ada diskusi seputar unit ini.</h6>
                <p class="small text-muted">Jadilah yang pertama memberikan pertanyaan atau review!</p>
            </div>
        <?php endif; ?>
    </div>
</div>
    <script src="<?php echo e(asset('assets/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script>
        // 1. ANIMASI SALJU (Tetap)
        const canvas = document.getElementById('snow-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        let isSnowing = true;
        function resize() { canvas.width = window.innerWidth; canvas.height = window.innerHeight; }
        window.addEventListener('resize', resize); resize();
        class Particle {
            constructor() { this.reset(); }
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height - canvas.height;
                this.size = Math.random() * 2 + 1;
                this.speed = Math.random() * 0.8 + 0.3;
                this.velX = Math.random() * 0.4 - 0.2;
                this.opacity = Math.random() * 0.5 + 0.2;
            }
            update() {
                this.y += this.speed; this.x += this.velX;
                if (this.y > canvas.height) this.reset();
            }
            draw() {
                ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2); ctx.fill();
            }
        }
        function init() { for (let i = 0; i < 50; i++) particles.push(new Particle()); }
        function animate() {
            if (!isSnowing) { requestAnimationFrame(animate); return; }
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(animate);
        }
        init(); animate();

        // 2. FUNGSI MEDIA SWITCHER (Tetap)
        function toggleMedia(type) {
            const foto = document.getElementById('display-foto');
            const video = document.getElementById('display-video');
            const btnFoto = document.getElementById('btn-foto');
            const btnVideo = document.getElementById('btn-video');
            const player = document.getElementById('player-video');
            const canvasSnow = document.getElementById('snow-canvas');

            if (type === 'foto') {
                foto.style.display = 'block'; video.style.display = 'none';
                btnFoto.classList.add('active'); btnVideo.classList.remove('active');
                if(player) player.pause();
                isSnowing = true; canvasSnow.style.opacity = "1"; 
            } else {
                foto.style.display = 'none'; video.style.display = 'block';
                btnFoto.classList.remove('active'); btnVideo.classList.add('active');
                if(player) {
                    player.currentTime = 0;
                    player.play().catch(e => console.log("Autoplay blocked"));
                }
                isSnowing = false; canvasSnow.style.opacity = "0"; 
            }
        }

     // 3. LOGIKA KALKULASI HARGA DINAMIS (VERSI LENGKAP)
$(document).ready(function() {
    const tglMulai = $('#tgl_mulai');
    const tglSelesai = $('#tgl_selesai');
    const displayDurasi = $('#display-durasi');
    const durasiHidden = $('#durasi_hidden');
    const totalEstimasi = $('#totalEstimasi');
    const jmlUnitDisplay = $('#jml-unit');
    
    // DATA HARGA DARI DATABASE
    const hargaAsli = <?php echo e($mobil->harga_sewa); ?>;
    const persenDiskonUnit = <?php echo e($mobil->diskon ?? 0); ?>;
    // Mengambil diskon redeem dari session/variabel PHP
    const persenDiskonRedeem = <?php echo e($diskonRedeem ?? 0); ?>;

    function hitungTotalDinamis() {
        const start = new Date(tglMulai.val());
        const end = new Date(tglSelesai.val());

        // Proteksi jika tanggal selesai sebelum/sama dengan tanggal mulai
        if (end <= start) {
            const nextDay = new Date(start);
            nextDay.setDate(start.getDate() + 1);
            tglSelesai.val(nextDay.toISOString().split('T')[0]);
            return hitungTotalDinamis();
        }

        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        const checkedUnits = $('.unit-checkbox:checked').length;
        
        // --- PROSES PERHITUNGAN HARGA ---

        // 1. Harga Dasar setelah diskon unit (Flash Sale)
        let hargaHarian = hargaAsli - (hargaAsli * (persenDiskonUnit / 100));

        // 2. POTONGAN EXTRA: Diskon Redeem (Jika ada kode promo aktif)
        // Dipotong dari harga yang sudah kena diskon unit
        if (persenDiskonRedeem > 0) {
            hargaHarian = hargaHarian - (hargaHarian * (persenDiskonRedeem / 100));
        }

        // 3. Kalkulasi berdasarkan durasi hari
        let totalSewaSatuMobil = hargaHarian * diffDays;

        // 4. Diskon Long-term (Contoh: sewa >= 7 hari diskon lagi 5%)
        if (diffDays >= 7) {
            totalSewaSatuMobil = totalSewaSatuMobil * 0.95;
        }

        // 5. Grand Total (Harga per mobil x jumlah unit yang dicentang)
        const grandTotal = totalSewaSatuMobil * checkedUnits;

        // --- UPDATE TAMPILAN ---
        jmlUnitDisplay.text(checkedUnits);
        displayDurasi.text(diffDays);
        durasiHidden.val(diffDays);
        
        if(checkedUnits === 0) {
            totalEstimasi.text('Pilih Unit Dulu');
        } else {
            // Gunakan Math.round agar tidak ada desimal dan format ke Rupiah
            totalEstimasi.text('Rp' + Math.round(grandTotal).toLocaleString('id-ID'));
        }
    }

    // Event listener untuk checkbox unit
    $(document).on('change', '.unit-checkbox', function() {
        if($(this).is(':checked')) {
            $(this).closest('.unit-card').addClass('selected');
        } else {
            $(this).closest('.unit-card').removeClass('selected');
        }
        hitungTotalDinamis();
    });

    // Event listener untuk perubahan tanggal
    tglMulai.on('change', hitungTotalDinamis);
    tglSelesai.on('change', hitungTotalDinamis);

    // Jalankan kalkulasi pertama kali saat halaman dimuat
    hitungTotalDinamis();

    // Validasi saat Submit
    $('#bookingForm').on('submit', function(e) {
        if($('.unit-checkbox:checked').length === 0) {
            e.preventDefault();
            alert('Silakan pilih minimal 1 unit mobil terlebih dahulu! ❄️');
        }
    });

    tglMulai.on('change', function() {
        const minDate = new Date(this.value);
        minDate.setDate(minDate.getDate() + 1);
        tglSelesai.attr('min', minDate.toISOString().split('T')[0]);
        hitungTotalDinamis();
    });

    tglSelesai.on('change', hitungTotalDinamis);

    // Jalankan sekali saat halaman pertama kali dimuat
    hitungTotalDinamis();
});
            // Jalankan saat load
            
        function showZoom(src) {
    const modal = $('#zoomModal');
    const img = $('#zoomImage');
    img.attr('src', src);
    modal.modal('show');
}
function showReplyForm(id) {
    let form = document.getElementById('reply-form-' + id);
    if (form.classList.contains('d-none')) {
        form.classList.remove('d-none');
    } else {
        form.classList.add('d-none');
    }
}
    </script>
    <div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 25px; border: none;">
            <div class="modal-body p-2">
                <button type="button" class="close" data-dismiss="modal" style="position: absolute; right: 20px; top: 10px; z-index: 1000; color: #00a8ff; opacity: 1;">&times;</button>
                <img src="" id="zoomImage" class="img-fluid" style="border-radius: 20px; width: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            </div>
        </div>
    </div>
</div>
</body>
</html><?php /**PATH C:\yujimin\karina\resources\views/mobil/show.blade.php ENDPATH**/ ?>