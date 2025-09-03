@extends('template-pasien')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Request Kunjungan</h1>
                            <p class="text-muted mb-0">Selamat datang <span
                                    class="fw-bold">{{ $pasien->nama_pasien ?? '-' }}</span>! Ajukan request kunjungan Anda.
                            </p>
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

        <form action="{{ route('pasien-add-data-kunjungan') }}" method="POST">
            @csrf

            <!-- Data Kunjungan Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-primary">Data Kunjungan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Keluhan</label>
                                    <textarea name="keluhan" class="form-control" required></textarea>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Request Perawatan</label>
                                    <select name="jenis_perawatan" class="form-control" required>
                                        <option value="" disabled selected>-- Pilih Perawatan --</option>
                                        <option value="Rawat Jalan">Rawat Jalan</option>
                                        <option value="Rawat Inap">Rawat Inap</option>
                                    </select>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Kunjungan</label>
                                    <input type="date" name="tanggal_kunjungan" class="form-control" required>
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
                            <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">
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