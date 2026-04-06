<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Discount Management | Frosty App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.4);
            --ice-primary: #0ea5e9;
            --ice-secondary: #6366f1;
            --dark-blue: #0f172a;
        }

        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--dark-blue);
            min-height: 100vh;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        .premium-input {
            background: rgba(255, 255, 255, 0.5);
            border: 2px solid transparent; 
            border-radius: 12px;
            padding: 10px 16px; 
            height: 48px; 
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .premium-input:focus {
            background: white; 
            border-color: var(--ice-primary); 
            outline: none;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }

        /* Tabel Styling */
        .premium-table thead th {
            background: rgba(248, 250, 252, 0.5);
            border-bottom: 2px solid #e2e8f0;
            color: #64748b; 
            font-size: 0.65rem; 
            font-weight: 800;
            text-transform: uppercase; 
            letter-spacing: 1px; 
            padding: 15px 20px;
        }

        .badge-code {
            background: #1e293b; 
            color: #f8fafc;
            padding: 6px 12px; 
            border-radius: 8px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }

        .badge-target {
            background: #e0f2fe; 
            color: #0369a1;
            padding: 4px 10px; 
            border-radius: 6px; 
            font-size: 0.7rem; 
            font-weight: 700;
        }

        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        .expiry-date-input {
            font-size: 0.8rem !important;
            height: 38px !important;
            padding: 5px 10px !important;
        }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-md-5">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5">
        <div>
            <h1 class="font-weight-bold text-dark mb-1">Promo Center <span style="color: var(--ice-primary)">❄️</span></h1>
            <p class="text-muted mb-0">Kelola diskon unit dan kode voucher dalam satu dashboard eksklusif.</p>
        </div>
        <a href="/dashboard" class="btn glass-card px-4 py-2 font-weight-bold text-dark mt-3 mt-md-0">
            <i class="fas fa-arrow-left mr-2 text-primary"></i> Panel Utama
        </a>
    </div>

    <div class="row">
        <div class="col-xl-7">
            <div class="card glass-card border-0 mb-4 h-100">
                <div class="card-header bg-transparent border-0 px-4 pt-4 d-flex justify-content-between align-items-center">
                    <h5 class="font-weight-bold mb-0">Unit & Inventaris</h5>
                    <span class="badge badge-primary px-3 py-2" style="border-radius: 10px"><?php echo e(count($mobils)); ?> Unit Aktif</span>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive custom-scroll" style="max-height: 700px;">
                        <table class="table premium-table m-0">
                            <thead>
                                <tr>
                                    <th>Mobil / Unit</th>
                                    <th>Harga Dasar</th>
                                    <th width="100">Diskon (%)</th>
                                    <th width="160">Masa Berlaku</th>
                                    <th>Final</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $mobils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-4 align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 p-2 bg-white rounded-circle text-primary shadow-sm" style="width: 35px; height: 35px; display:flex; align-items:center; justify-content:center">
                                                <i class="fas fa-car-side"></i>
                                            </div>
                                            <div>
                                                <span class="d-block font-weight-bold text-dark mb-0" style="font-size: 0.9rem"><?php echo e($m->merek); ?></span>
                                                <small class="badge-target"><?php echo e($m->category->nama_kategori); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 align-middle harga-normal" data-harga="<?php echo e($m->harga_sewa); ?>" style="font-size: 0.85rem">
                                        Rp<?php echo e(number_format($m->harga_sewa, 0, ',', '.')); ?>

                                    </td>
                                    <form action="<?php echo e(route('promo.update')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="mobil_id" value="<?php echo e($m->id); ?>">
                                        <td class="align-middle">
                                            <input type="number" name="diskon_mobil" class="form-control premium-input input-diskon text-center w-100" value="<?php echo e($m->diskon); ?>" min="0" max="100">
                                        </td>
                                        <td class="align-middle">
                                            <input type="date" name="expired_at" class="form-control premium-input expiry-date-input input-expiry w-100" 
                                                   value="<?php echo e($m->expired_at ? \Carbon\Carbon::parse($m->expired_at)->format('Y-m-d') : ''); ?>"
                                                   min="2026-04-04">
                                            <small class="expiry-countdown d-block text-center mt-1" style="font-size: 0.65rem"></small>
                                        </td>
                                        <td class="px-4 align-middle harga-akhir-tampil font-weight-bold text-primary" style="font-size: 0.9rem">
                                            Rp<?php echo e(number_format($m->harga_sewa - ($m->harga_sewa * $m->diskon / 100), 0, ',', '.')); ?>

                                        </td>
                                        <td class="px-4 align-middle text-center">
                                            <button type="submit" class="btn btn-sm btn-white shadow-sm rounded-circle p-0" style="width:32px; height:32px">
                                                <i class="fas fa-save text-success"></i>
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card glass-card border-0 mb-4" style="background: rgba(255,255,255,0.4)">
                <div class="card-body">
                    <h6 class="font-weight-bold mb-3"><i class="fas fa-layer-group text-info mr-2"></i>Bulk Diskon Kategori</h6>
                    <form action="<?php echo e(route('promo.update')); ?>" method="POST" class="row no-gutters">
                        <?php echo csrf_field(); ?>
                        <div class="col-7 pr-2">
                            <select name="category_id" class="form-control premium-input shadow-none w-100" required>
                                <option value="">Pilih Kategori...</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->nama_kategori); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-3 pr-2">
                            <input type="number" name="diskon_kategori" class="form-control premium-input shadow-none w-100" placeholder="%" required>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info btn-block h-100 rounded-lg shadow-sm">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card glass-card border-0 mb-4 shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white;">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-4 text-warning"><i class="fas fa-plus-circle mr-2"></i>Rilis Kode Baru</h5>
                    <form action="<?php echo e(route('promo.store_code')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small font-weight-bold text-white-50">KODE KUPON</label>
                                <input type="text" name="code" class="form-control premium-input bg-dark border-0 text-white shadow-none w-100" placeholder="EX: FROST44" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small font-weight-bold text-white-50">DISKON (%)</label>
                                <input type="number" name="discount" class="form-control premium-input bg-dark border-0 text-white shadow-none w-100" placeholder="0" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <label class="small font-weight-bold text-white-50">TARGET PROMO</label>
                                <select name="type" class="premium-input bg-dark border-0 text-white shadow-none w-100" id="targetType" required>
                                    <option value="all">Global (Semua Unit)</option>
                                    <option value="category">Kategori Tertentu</option>
                                    <option value="unit">Mobil Spesifik</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="small font-weight-bold text-white-50">TGL EXPIRED</label>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control premium-input bg-dark border-0 text-white shadow-none w-100" 
                                       value="2026-04-06" min="2026-04-04" required>
                            </div>
                        </div>

                        <div id="targetSelectWrapper" class="mb-3 d-none">
                            <label class="small font-weight-bold text-white-50">PILIH ITEM TARGET</label>
                            <select name="target_id" class="form-control premium-input bg-dark border-0 text-white shadow-none w-100" id="targetId"></select>
                        </div>

                        <div class="mb-4 text-center">
                            <span id="coupon-days-info" class="badge badge-warning py-2 px-3 rounded-pill" style="font-size: 0.8rem">
                                <i class="fas fa-clock mr-1"></i> Aktif selama: <b id="days-count">2</b> hari
                            </span>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block py-3 font-weight-bold text-dark rounded-pill shadow-lg">
                            <i class="fas fa-bolt mr-2"></i> AKTIFKAN SEKARANG
                        </button>
                    </form>
                </div>
            </div>

            <div class="card glass-card border-0">
                <div class="card-header bg-transparent border-0 px-4 pt-4">
                    <h6 class="font-weight-bold mb-0">Voucher Terdaftar</h6>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive custom-scroll" style="max-height: 300px;">
                        <table class="table premium-table m-0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Diskon</th>
                                    <th>Target</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $activePromos = \App\Models\Promo::latest()->get(); ?>
                                <?php $__currentLoopData = $activePromos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-4 align-middle">
                                        <span class="badge-code"><?php echo e($promo->code); ?></span>
                                    </td>
                                    <td class="px-4 align-middle text-danger font-weight-bold"><?php echo e($promo->discount_percent); ?>%</td>
                                    <td class="px-4 align-middle">
                                        <small class="badge-target text-capitalize"><?php echo e($promo->type); ?></small>
                                    </td>
                                    <td class="px-4 align-middle text-center">
                                        <form action="<?php echo e(route('promo.delete_code', $promo->id)); ?>" method="POST" onsubmit="return confirm('Hapus voucher ini?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-link text-danger p-0"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Konfigurasi Tanggal Simulasi (Request: 4 April 2026)
    const TODAY_DATE = "2026-04-04";

    function calculateDays(inputDate) {
        const today = new Date(TODAY_DATE);
        const selected = new Date(inputDate);
        const diffTime = selected - today;
        return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    }

    // 1. Kalkulasi Harga Real-time
    document.querySelectorAll('.input-diskon').forEach(input => {
        input.addEventListener('input', function() {
            const row = this.closest('tr');
            const hargaAsli = parseFloat(row.querySelector('.harga-normal').getAttribute('data-harga'));
            let diskon = parseFloat(this.value) || 0;
            const hargaAkhir = hargaAsli - (hargaAsli * (diskon / 100));
            const display = row.querySelector('.harga-akhir-tampil');
            display.innerText = 'Rp' + Math.round(hargaAkhir).toLocaleString('id-ID');
            display.style.color = diskon > 0 ? '#ef4444' : '#0ea5e9';
        });
    });

    // 2. Countdown Expiry di Tabel
    document.querySelectorAll('.input-expiry').forEach(input => {
        const updateText = (el) => {
            const days = calculateDays(el.value);
            const display = el.parentNode.querySelector('.expiry-countdown');
            if (!el.value) return display.innerText = "";
            
            if (days > 0) {
                display.innerText = `⏳ ${days} hari lagi`;
                display.className = "expiry-countdown d-block text-center mt-1 text-success font-weight-bold";
            } else if (days === 0) {
                display.innerText = "⚠️ Habis hari ini";
                display.className = "expiry-countdown d-block text-center mt-1 text-warning font-weight-bold";
            } else {
                display.innerText = "❌ Kadaluarsa";
                display.className = "expiry-countdown d-block text-center mt-1 text-danger font-weight-bold";
            }
        };

        input.addEventListener('input', (e) => updateText(e.target));
        if(input.value) updateText(input); // Init on load
    });

    // 3. Countdown Expiry di Rilis Kode Baru
    document.getElementById('expiry_date').addEventListener('input', function() {
        const days = calculateDays(this.value);
        const infoBox = document.getElementById('coupon-days-info');
        const countSpan = document.getElementById('days-count');
        
        if (days >= 0) {
            countSpan.innerText = days;
            infoBox.className = "badge badge-warning py-2 px-3 rounded-pill";
        } else {
            countSpan.innerText = "Invalid";
            infoBox.className = "badge badge-danger py-2 px-3 rounded-pill";
        }
    });

    // 4. Dynamic Target Selector
    document.getElementById('targetType').addEventListener('change', function() {
        const wrapper = document.getElementById('targetSelectWrapper');
        const targetSelect = document.getElementById('targetId');
        const type = this.value;

        if (type === 'all') {
            wrapper.classList.add('d-none');
        } else {
            wrapper.classList.remove('d-none');
            targetSelect.innerHTML = '<option value="">-- Pilih Target --</option>';
            if (type === 'category') {
                targetSelect.innerHTML += `<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->nama_kategori); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>`;
            } else {
                targetSelect.innerHTML += `<?php $__currentLoopData = $mobils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($m->id); ?>"><?php echo e($m->merek); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>`;
            }
        }
    });
</script>
</body>
</html><?php /**PATH C:\yujimin\karina\resources\views/admin/promo.blade.php ENDPATH**/ ?>