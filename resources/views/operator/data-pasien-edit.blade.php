@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Edit Pasien</h1>
                            <p class="text-muted mb-0">Edit data pasien dan akun user.</p>
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

        <form action="{{ route('operator-edit-data-pasien', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Data Pasien Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-primary">Data Pasien</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ID Pasien</label>
                                    <input type="text" name="id_pasien" value="{{ $pasien->id_pasien }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pasien</label>
                                    <input type="text" name="nama_pasien"
                                        value="{{ old('nama_pasien', $pasien->nama_pasien) }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="nomor_telepon"
                                        value="{{ old('nomor_telepon', $pasien->nomor_telepon) }}" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota</label>
                                    <input type="text" name="kota_pasien"
                                        value="{{ old('kota_pasien', $pasien->kota_pasien) }}" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat_pasien" class="form-control"
                                        rows="3">{{ old('alamat_pasien', $pasien->alamat_pasien) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Akun User Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-success">Akun User</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $pasien->user->email ?? '') }}"
                                        class="form-control" required>
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
                                <i class='bx bx-save'></i> Simpan Perubahan
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection