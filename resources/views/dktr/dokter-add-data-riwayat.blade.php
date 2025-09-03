@extends('template-dokter')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Keluhan Pasien</h1>
                            <p class="text-muted mb-0">Isi data riwayat pasien dari kunjungan.</p>
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
                                <p class="mb-1"><strong>Request Perawatan:</strong> {{ $kunjungan->jenis_perawatan }}</p>
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

        <form action="{{ route('dokter-add-data-riwayat', $kunjungan->id) }}" method="POST">
            @csrf

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
                                        <option value="Rawat Jalan">Rawat Jalan</option>
                                        <option value="Rawat Inap">Rawat Inap</option>
                                    </select>
                                </div>

                                <!-- Pilih Ruangan (hanya muncul jika Rawat Inap) -->
                                <div class="col-12" id="ruanganContainer" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Ruangan</label>
                                            <select name="ruangan_id" class="form-select">
                                                <option value="">-- Pilih Ruangan --</option>
                                                @foreach($ruangan as $r)
                                                    <option value="{{ $r->id }}">
                                                        {{ $r->namaRuangan }} - {{ $r->dayaTampung }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Tanggal Masuk</label>
                                            <input type="date" name="tanggal_masuk" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Tanggal Keluar</label>
                                            <input type="date" name="tanggal_keluar" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Diagnosa Penyakit</label>
                                    <input type="text" name="penyakit" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Obat</label>
                                    <input type="text" name="obat" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Dosis</label>
                                    <select name="dosis" class="form-select" required>
                                        <option value="1x Sehari">1x Sehari</option>
                                        <option value="2x Sehari">2x Sehari</option>
                                        <option value="3x Sehari">3x Sehari</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Pasien</label>
                                    <select name="status_pasien" class="form-select" required>
                                        <option value="Masih Sakit">Masih Sakit</option>
                                        <option value="Sudah Sembuh">Sudah Sembuh</option>
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

    <!-- Script untuk menampilkan ruangan hanya jika Rawat Inap -->
    <script>
        const jenisPerawatan = document.getElementById('jenisPerawatan');
        const ruanganContainer = document.getElementById('ruanganContainer');

        jenisPerawatan.addEventListener('change', function () {
            if (this.value === 'Rawat Inap') {
                ruanganContainer.style.display = 'block';
            } else {
                ruanganContainer.style.display = 'none';
                // Reset field jika bukan rawat inap
                ruanganContainer.querySelectorAll('input, select').forEach(el => el.value = '');
            }
        });
    </script>
@endsection