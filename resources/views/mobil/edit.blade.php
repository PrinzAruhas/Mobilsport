<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MobiRent - Edit Armada 🧊</title>

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

        .unit-card {
            background: white;
            border-left: 5px solid var(--ice-primary);
            transition: 0.3s;
        }
        .unit-card:hover {
            transform: scale(1.01);
        }
    </style>
</head>

<body>
    <div id="snow"></div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold text-primary mb-0">Edit Armada 🧊</h2>
                <p class="text-muted">Memperbarui data: <strong>{{ $mobil->merek }} {{ $mobil->model }}</strong></p>
            </div>
            <a href="{{ route('mobil.index') }}" class="btn-back">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="card card-main">
            <div class="card-body p-4 p-lg-5">
                <form id="formEditMobil" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Merek</label>
                                    <input type="text" name="merek" class="form-control" value="{{ $mobil->merek }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Model / Seri</label>
                                    <input type="text" name="model" class="form-control" value="{{ $mobil->model }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Harga Sewa (Rp / Hari)</label>
                                    <input type="number" name="harga_sewa" class="form-control" value="{{ $mobil->harga_sewa }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Kategori</label>
                                    <select name="category_id" class="form-control custom-select" required>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $mobil->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row bg-light p-3 rounded-lg mb-4">
                                <div class="col-md-4 mb-3">
                                    <label><i class="fas fa-users mr-1"></i> Kapasitas</label>
                                    <select name="kapasitas" class="form-control custom-select">
                                        @foreach([1,2,5,7] as $cap)
                                            <option value="{{ $cap }}" {{ $mobil->kapasitas == $cap ? 'selected' : '' }}>{{ $cap }} Kursi</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label><i class="fas fa-cog mr-1"></i> Transmisi</label>
                                    <select name="transmisi" class="form-control custom-select">
                                        @foreach(['Dual-Clutch Transmission', 'Semiautomatic', 'Automatic', 'Manual'] as $trans)
                                            <option value="{{ $trans }}" {{ $mobil->transmisi == $trans ? 'selected' : '' }}>{{ $trans }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label><i class="fas fa-gas-pump mr-1"></i> Bahan Bakar</label>
                                    <select name="bahan_bakarnya" class="form-control custom-select">
                                        @foreach(['Bensin', 'Diesel', 'Electric'] as $bbm)
                                            <option value="{{ $bbm }}" {{ $mobil->bahan_bakarnya == $bbm ? 'selected' : '' }}>{{ $bbm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="font-weight-bold text-primary mb-0">
        <i class="fas fa-layer-group mr-2"></i>Unit Armada Saat Ini
    </h6>
    <button type="button" id="addUnitBtn" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-plus"></i> Tambah Unit Baru
    </button>
</div>

                            <div id="unitInputs" class="mb-4">
                                </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="mb-4">
                                <label>Foto Utama</label>
                                <div class="preview-box mb-2" id="imgBox">
                                    <img id="imgPreview" src="{{ asset('storage/mobil/' . $mobil->gambar) }}" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input" id="gambarInput" accept="image/*">
                                    <label class="custom-file-label">Ganti Foto (Kosongkan jika tidak)...</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label>Video Preview</label>
                                <div class="preview-box mb-2" id="videoBox">
                                    @if($mobil->video)
                                        <video id="videoPreview" controls style="width:100%; height:100%;" src="{{ asset('storage/videos/' . $mobil->video) }}"></video>
                                    @else
                                        <p id="videoPlaceholder" class="small text-muted">Belum ada video</p>
                                        <video id="videoPreview" controls style="display:none; width:100%; height:100%;"></video>
                                    @endif
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="video" class="custom-file-input" id="videoInput" accept="video/mp4">
                                    <label class="custom-file-label">Ganti Video...</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label>Deskripsi & Fasilitas Tambahan</label>
                        <textarea name="deskripsi" class="form-control" rows="4">{{ $mobil->deskripsi }}</textarea>
                    </div>

                    <hr>

                    <div class="text-right">
                        <button type="submit" id="btnSubmit" class="btn btn-save">
                            <span id="btnText"><i class="fas fa-save mr-2"></i> Perbarui Armada</span>
                            <span id="btnLoading" style="display:none;"><i class="fas fa-circle-notch fa-spin mr-2"></i> Memproses...</span>
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
    // 0. Inisialisasi unit dari data database
    let units = @json($mobil->units);
    
    // Fungsi untuk merender ulang daftar unit
    function renderUnits() {
        const container = $('#unitInputs');
        
        // Simpan state input saat ini agar tidak hilang saat re-render
        const currentData = [];
        container.find('.unit-card').each(function(index) {
            currentData.push({
                id: $(this).find('input[name*="[id]"]').val(),
                no_polisi: $(this).find('input[name*="[no_polisi]"]').val(),
                warna: $(this).find('input[name*="[warna]"]').val()
            });
        });

        container.empty();
        
        units.forEach((unit, i) => {
            let valId = currentData[i]?.id || unit.id || '';
            let valNoPol = currentData[i]?.no_polisi || unit.no_polisi || '';
            let valWarna = currentData[i]?.warna || unit.warna || '';
            
            let fotoLamaHtml = unit.foto_unit ? 
                `<img src="{{ asset('storage/units/') }}/${unit.foto_unit}" class="rounded mr-2 shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">` : '';

            const html = `
                <div class="unit-card p-3 shadow-sm mb-3 border rounded">
                    <input type="hidden" name="units[${i}][id]" value="${valId}">
                    <div class="row align-items-center">
                        <div class="col-md-2 mb-2 mb-md-0">
                            <span class="badge badge-primary w-100 py-2">Unit #${i + 1}</span>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <input type="text" name="units[${i}][no_polisi]" class="form-control form-control-sm" placeholder="No. Polisi" value="${valNoPol}" required>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <input type="text" name="units[${i}][warna]" class="form-control form-control-sm" placeholder="Warna" value="${valWarna}" required>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                ${fotoLamaHtml}
                                <div class="custom-file" style="font-size: 0.85rem;">
                                    <input type="file" name="units[${i}][foto_unit]" class="custom-file-input unit-file-input" id="unitFile${i}" accept="image/*">
                                    <label class="custom-file-label" for="unitFile${i}">Ganti Foto...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            container.append(html);
        });

        $('.unit-file-input').on('change', function() {
            $(this).next('.custom-file-label').html($(this).val().split('\\').pop());
        });
    }

    // Panggil render saat pertama kali dimuat
    renderUnits();

    // Event untuk tombol tambah unit
    $('#addUnitBtn').on('click', function() {
        units.push({}); // Tambah objek kosong untuk unit baru
        renderUnits();
    });

            // 1. Snow Effect
            function startSnow() {
                const snow = $('#snow');
                setInterval(() => {
                    const flake = $('<div/>').css({
                        'position': 'absolute', 'background': 'white', 'border-radius': '50%',
                        'width': (Math.random() * 4 + 2) + 'px', 'height': (Math.random() * 4 + 2) + 'px',
                        'top': '-10px', 'left': (Math.random() * 100) + 'vw', 'opacity': Math.random(),
                        'transition': 'transform 5s linear, opacity 5s linear'
                    }).appendTo(snow);
                    setTimeout(() => { flake.css({'transform': `translateY(105vh) translateX(${Math.random() * 40 - 20}px)`, 'opacity': 0}); }, 50);
                    setTimeout(() => flake.remove(), 5000);
                }, 200);
            }
            startSnow();

            // 2. Media Preview (Foto & Video Utama)
            $('#gambarInput').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => $('#imgPreview').attr('src', e.target.result);
                    reader.readAsDataURL(file);
                    $(this).next('.custom-file-label').html(file.name);
                }
            });

            $('#videoInput').change(function() {
                const file = this.files[0];
                if (file) {
                    $('#videoPlaceholder').hide();
                    $('#videoPreview').attr('src', URL.createObjectURL(file)).show();
                    $(this).next('.custom-file-label').html(file.name);
                }
            });

            // 3. Submit AJAX
            $('#formEditMobil').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $('#btnText').hide();
                $('#btnLoading').show();
                $('#btnSubmit').prop('disabled', true);

                $.ajax({
                    url: "{{ route('mobil.update', $mobil->id) }}",
                    type: "POST", 
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        Swal.fire('Berhasil!', 'Data armada telah diperbarui ❄️', 'success')
                            .then(() => window.location.href = "{{ route('mobil.index') }}");
                    },
                    error: function(xhr) {
                        const err = xhr.responseJSON?.message || 'Gagal memperbarui data.';
                        Swal.fire('Error!', err, 'error');
                        $('#btnText').show();
                        $('#btnLoading').hide();
                        $('#btnSubmit').prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>