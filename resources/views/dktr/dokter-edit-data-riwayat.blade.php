@extends('template-dokter')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Edit Data Pasien</h1>
                            <p class="text-muted mb-0">Edit data pasien dari kunjungan.</p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">{{ date('l, d F Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 text-primary">Informasi Kunjungan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p class="mb-1"><strong>ID Kunjungan:</strong> {{ $kunjungan->id }}</p>
                                <p class="mb-1"><strong>No Rekam Medis:</strong> {{ $kunjungan->no_rekam_medis }}</p>
                                <p class="mb-1"><strong>Jenis Perawatan:</strong> {{ $kunjungan->jenis_perawatan }}</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="mb-1"><strong>Nama Pasien:</strong> {{ $kunjungan->pasien->nama_pasien }}</p>
                                <p class="mb-1"><strong>Jenis Kelamin:</strong>
                                    {{ $kunjungan->pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </p>
                                <p class="mb-1"><strong>Keluhan:</strong> {{ $kunjungan->keluhan }}</p>
                            </div>
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

        <form action="{{ route('dokter-edit-data-riwayat', $riwayat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-primary">Pemeriksaan Pasien</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Pilih Jenis Perawatan -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Perawatan</label>
                                    <select name="jenis_perawatan" id="jenisPerawatan" class="form-select" required>
                                        <option value="">-- Pilih Jenis Perawatan --</option>
                                        <option value="Rawat Jalan" {{ $kunjungan->jenis_perawatan === 'Rawat Jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                                        <option value="Rawat Inap" {{ $kunjungan->jenis_perawatan === 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
                                    </select>
                                </div>

                                <div id="rawatInapFields" class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Ruangan</label>
                                        <select name="ruangan_id" class="form-select">
                                            <option value="">-- Pilih Ruangan --</option>
                                            @foreach($ruangan as $r)
                                                <option value="{{ $r->id }}" {{ $riwayat->ruangan_id == $r->id ? 'selected' : '' }}>
                                                    {{ $r->namaRuangan }} - {{ $r->dayaTampung }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Tanggal Masuk</label>
                                        <input type="date" name="tanggal_masuk" class="form-control"
                                            value="{{ $riwayat->tanggal_masuk }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Tanggal Keluar</label>
                                        <input type="date" name="tanggal_keluar" class="form-control"
                                            value="{{ $riwayat->tanggal_keluar }}">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Diagnosa Penyakit</label>
                                    <input type="text" name="penyakit" class="form-control"
                                        value="{{ $riwayat->penyakit }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Obat</label>
                                    <input type="text" name="obat" class="form-control" value="{{ $riwayat->obat }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Dosis</label>
                                    <select name="dosis" class="form-select" required>
                                        <option value="1x Sehari" {{ $riwayat->dosis === '1x Sehari' ? 'selected' : '' }}>1x
                                            Sehari</option>
                                        <option value="2x Sehari" {{ $riwayat->dosis === '2x Sehari' ? 'selected' : '' }}>2x
                                            Sehari</option>
                                        <option value="3x Sehari" {{ $riwayat->dosis === '3x Sehari' ? 'selected' : '' }}>3x
                                            Sehari</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Pasien</label>
                                    <select name="status_pasien" class="form-select" required>
                                        <option value="Masih Sakit" {{ $riwayat->status_pasien === 'Masih Sakit' ? 'selected' : '' }}>Masih Sakit</option>
                                        <option value="Sudah Sembuh" {{ $riwayat->status_pasien === 'Sudah Sembuh' ? 'selected' : '' }}>Sudah Sembuh</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisPerawatan = document.getElementById('jenisPerawatan');
            const rawatInapFields = document.getElementById('rawatInapFields');

            function toggleFields() {
                if (jenisPerawatan.value === 'Rawat Inap') {
                    rawatInapFields.style.display = 'flex';
                } else {
                    rawatInapFields.style.display = 'none';
                }
            }

            toggleFields(); // Jalan saat halaman pertama kali load
            jenisPerawatan.addEventListener('change', toggleFields);
        });
    </script>
@endsection