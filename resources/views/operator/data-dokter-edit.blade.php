@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Edit Dokter</h1>
                            <p class="text-muted mb-0">Edit data dokter dan akun user.</p>
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

        <form action="{{ route('operator-edit-data-dokter', $dokter->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Data Dokter Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-primary">Data Dokter</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ID Dokter</label>
                                    <input type="text" name="idDokter" value="{{ $dokter->idDokter }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Dokter</label>
                                    <input type="text" name="namaDokter"
                                        value="{{ old('namaDokter', $dokter->namaDokter) }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggalLahir"
                                        value="{{ old('tanggalLahir', $dokter->tanggalLahir) }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenisKelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenisKelamin', $dokter->jenisKelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenisKelamin', $dokter->jenisKelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Spesialisasi</label>
                                    <input type="text" name="spesialisasi"
                                        value="{{ old('spesialisasi', $dokter->spesialisasi) }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jam Praktik</label>
                                    <input type="time" name="jamPraktik"
                                        value="{{ old('jamPraktik', $dokter->jamPraktik) }}" class="form-control"
                                        required>
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
                                    <input type="email" name="email" value="{{ old('email', $dokter->user->email ?? '') }}"
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
                            <a href="{{ route('data-dokter') }}" class="btn btn-secondary me-2">
                                <i class='bx bx-arrow-back'></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-save'></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection