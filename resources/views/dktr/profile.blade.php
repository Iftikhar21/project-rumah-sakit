@extends('template-dokter')

@section('content')
    <div class="container-fluid" style="padding-top: 60px;">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Update Profile</h1>
                            <p class="text-muted mb-0">Silahkan update profile sebagai dokter.</p>
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

        <form action="{{ route('dokter-update') }}" method="POST">
            @csrf

            <!-- Data Pasien Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Dokter</label>
                                    <input type="text" name="namaDokter" value="{{ old('namaDokter', $dokter->namaDokter) }}" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggalLahir" value="{{ old('tanggalLahir', $dokter->tanggalLahir) }}" class="form-control" required>
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
                                    <input type="text" name="spesialisasi" value="{{ old('spesialisasi', $dokter->spesialisasi) }}" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jam Praktik</label>
                                    <input type="time" name="jamPraktik" value="{{ old('jamPraktik', $dokter->jamPraktik) }}" class="form-control" required>
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
                            <a href="{{ route('dokter-view') }}" class="btn btn-secondary me-2">
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
    </div>
@endsection