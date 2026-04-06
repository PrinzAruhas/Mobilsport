<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MobiRent - Tambah Armada ❄️</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --ice-bg: #f0f8ff;
            --ice-primary: #74b9ff;
            --ice-secondary: #a2d2ff;
            --ice-gradient: linear-gradient(135deg, #74b9ff 0%, #a2d2ff 100%);
            --text-dark: #2d3436;
            --glass: rgba(255, 255, 255, 0.85);
        }

        body {
            background-color: var(--ice-bg) !important;
            font-family: 'Nunito', sans-serif;
            color: var(--text-dark);
        }

        #snow {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: 9999;
        }

        .card-main {
            border: none;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .btn-back {
            background: white;
            color: var(--ice-primary);
            border: 2px solid var(--ice-primary);
            border-radius: 50px;
            padding: 8px 25px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: var(--ice-primary);
            color: white;
            text-decoration: none;
            transform: translateX(-3px);
        }

        .form-control, .custom-select {
            border-radius: 10px;
            border: 1.5px solid #d1e3f8;
            transition: 0.3s;
        }

        label {
            font-weight: 700;
            color: #57606f;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .unit-card {
            background: white;
            border-left: 5px solid var(--ice-primary);
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .btn-save {
            background: var(--ice-gradient);
            border: none;
            border-radius: 12px;
            padding: 12px 35px;
            color: white;
            font-weight: 800;
            box-shadow: 0 4px 15px rgba(116, 185, 255, 0.4);
        }

        .preview-box {
            border: 2px dashed var(--ice-secondary);
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .unit-preview-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            display: none;
        }
    </style>
</head>

<body>
    <div id="snow"></div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold text-primary mb-0">Manajemen Armada 🧊</h2>
                <p class="text-muted">Kelola koleksi kendaraan terbaik Anda.</p>
            </div>
            <a href="/dashboard" class="btn-back">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>
        </div>

        <div class="card card-main">
            <div class="card-body p-4 p-lg-5">
                <form id="formTambahMobil" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Merek</label>
                                    <input type="text" name="merek" class="form-control" placeholder="Toyota" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Model / Seri</label>
                                    <input type="text" name="model" class="form-control" placeholder="Avanza Veloz" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Harga Sewa (Rp / Hari)</label>
                                    <input type="number" name="harga_sewa" class="form-control" placeholder="400000" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Kategori</label>
                                    <select name="category_id" class="form-control custom-select" required>
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                
                            </div>

                            <div class="row bg-light p-3 rounded-lg mb-4">
                                <div class="col-md-4 mb-3">
                                    <label><i class="fas fa-users mr-1"></i> Kapasitas</label>
                                    <select name="kapasitas" class="form-control custom-select">
                                        <option value="1">1 Kursi</option>
                                        <option value="2">2 Kursi</option>
                                        <option value="5" selected>5 Kursi</option>
                                        <option value="7">7 Kursi</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label><i class="fas fa-cog mr-1"></i> Transmisi</label>
                                    <select name="transmisi" class="form-control custom-select">
                                        <option value="Dual-clutch">Dual-clutch</option>
                                        <option value="Semiautomatic">Semiautomatic</option>
                                        <option value="Automatic">Automatic</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label><i class="fas fa-gas-pump mr-1"></i> Bahan Bakar</label>
                                    <select name="bahan_bakarnya" class="form-control custom-select">
                                        <option value="Bensin">Bensin</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
    <label>Jumlah Unit Tersedia</label>
    <input type="number" id="stockInput" class="form-control" value="1" min="1" placeholder="Masukkan jumlah unit">
</div>

<div id="unitInputs"></div>
                        </div>

                        <div class="col-lg-5">
                            <label>Foto Banner (Katalog)</label>
                            <div class="preview-box mb-2" id="imgBox">
                                <img id="imgPreview" style="display:none; width:100%; height:100%; object-fit:cover;">
                                <div id="imgPlaceholder">
                                    <i class="fas fa-camera fa-2x text-muted"></i>
                                </div>
                            </div>
                            <div class="custom-file mb-4">
                                <input type="file" name="gambar" class="custom-file-input" id="gambarInput" accept="image/*" required>
                                <label class="custom-file-label">Upload Foto Katalog</label>
                            </div>

                            <label>Video Preview (Opsional)</label>
                            <div class="preview-box mb-2" id="videoBox">
                                <video id="videoPreview" controls style="display:none; width:100%; height:100%;"></video>
                                <div id="videoPlaceholder">
                                    <i class="fas fa-video fa-2x text-muted"></i>
                                </div>
                            </div>
                            <div class="custom-file mb-3">
                                <input type="file" name="video" class="custom-file-input" id="videoInput" accept="video/mp4">
                                <label class="custom-file-label">Upload Video MP4</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label>Deskripsi & Fasilitas</label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Contoh: AC dingin, Sound System, dll"></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-save">
                            <span id="btnText"><i class="fas fa-check-circle mr-2"></i> Simpan Armada</span>
                            <span id="btnLoading" style="display:none;"><i class="fas fa-spinner fa-spin mr-2"></i> Memproses...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
    // 1. Snow Effect
    function startSnow() {
        const snow = $('#snow');
        setInterval(() => {
            const flake = $('<div/>').css({
                'position': 'absolute', 'background': 'white', 'border-radius': '50%',
                'width': '4px', 'height': '4px', 'top': '-10px', 'left': (Math.random() * 100) + 'vw',
                'opacity': Math.random(), 'transition': 'transform 5s linear, opacity 5s linear'
            }).appendTo(snow);
            setTimeout(() => flake.css({'transform': 'translateY(105vh)', 'opacity': 0}), 50);
            setTimeout(() => flake.remove(), 5000);
        }, 300);
    }
    startSnow();

    // 2. Render Units secara Dinamis
    function renderUnits() {
        // Mengambil nilai dari #stockInput
        const count = parseInt($('#stockInput').val()) || 1;
        const container = $('#unitInputs');
        container.empty();

        for (let i = 0; i < count; i++) {
            container.append(`
                <div class="unit-card p-3 mb-3 border shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-1"><span class="badge badge-primary">#${i + 1}</span></div>
                        <div class="col-md-3">
                            <label class="small">No. Polisi</label>
                            <input type="text" name="units[${i}][no_polisi]" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3">
                            <label class="small">Warna</label>
                            <input type="text" name="units[${i}][warna]" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-5">
                            <label class="small">Foto Unit</label>
                            <input type="file" name="units[${i}][foto_unit]" class="form-control-file small unit-img-input" accept="image/*">
                            <img class="unit-preview-img mt-2" style="display:none; width:50px; height:50px; object-fit:cover;">
                        </div>
                    </div>
                </div>`);
        }
    }

    // Panggil saat load & saat input berubah
    renderUnits();
    $('#stockInput').on('input change', renderUnits);

    // 3. Image/Video Previews
    $(document).on('change', '.unit-img-input', function() {
        const reader = new FileReader();
        const preview = $(this).next('img');
        reader.onload = e => preview.attr('src', e.target.result).show();
        if (this.files[0]) reader.readAsDataURL(this.files[0]);
    });

    $('#gambarInput').change(function() {
        if (this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { $('#imgPreview').attr('src', e.target.result).show(); $('#imgPlaceholder').hide(); }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#videoInput').change(function() {
        if (this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { $('#videoPreview').attr('src', e.target.result).show(); $('#videoPlaceholder').hide(); }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // 4. AJAX Submit
    $('#formTambahMobil').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $('#btnSubmit').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

        $.ajax({
            url: "{{ route('mobil.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                Swal.fire('Berhasil!', 'Armada disimpan!', 'success').then(() => location.reload());
            },
            error: function(xhr) {
                Swal.fire('Error!', 'Pastikan data sudah benar.', 'error');
                $('#btnSubmit').prop('disabled', false).html('Simpan Armada');
            }
        });
    });
});
    </script>
</body>
</html>