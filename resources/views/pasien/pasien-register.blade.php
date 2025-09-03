<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 text-dark mb-1">Register</h1>
                    <p class="text-muted mb-0">Silahkan register sebagai pasien.</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ date('l, d F Y') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success">
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<form action="{{ route('action-register-pasien') }}" method="POST">
    @csrf

    <!-- Data Pasien Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" name="kota_pasien" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat_pasien" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-end">
                    <a href="{{ route('data-pasien') }}" class="btn btn-secondary me-2">
                        <i class='bx bx-arrow-back'></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-save'></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>