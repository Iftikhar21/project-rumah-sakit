@extends('template-operator')

@section('content')
    <div class="container-fluid px-4 py-1 min-vh-100">
        {{-- Header Section --}}
        <div class="row mb-4" style="margin-top: 60px;">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Detail Kunjungan</h1>
                            <p class="text-muted mb-0">Informasi lengkap kunjungan dan perawatan</p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">{{ date('l, d F Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Informasi Kunjungan Card --}}
            <div class="col-md-12">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                        <div class="icon-shape bg-primary bg-gradient rounded-3 me-3 d-flex align-items-center justify-content-center"
                            style="width: 45px; height: 45px;">
                            <i class='bx bx-calendar-detail text-white' style="font-size: 18px;"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Informasi Kunjungan</h5>
                            <small class="text-muted">Data kunjungan dan keluhan pasien</small>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted small mb-1">Tanggal Kunjungan</label>
                                <p class="fw-semibold mb-0">
                                    <i class='bx bx-calendar-alt text-muted me-2'></i>
                                    {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d F Y') }}
                                </p>
                            </div>
                            {{-- Dokter Penanggung Jawab (muncul hanya jika status diterima/selesai) --}}
                            @if(in_array($kunjungan->status_kunjungan, ['diterima', 'selesai']))
                                <div class="col-md-6">
                                    <label class="form-label text-muted small mb-1">Dokter Penanggung Jawab</label>
                                    <p class="fw-semibold mb-0 d-flex align-items-center">
                                        <i class='bx bx-user-circle text-muted me-2'></i>
                                        {{ $kunjungan->dokter->namaDokter ?? '-' }}
                                    </p>
                                </div>
                            @endif

                            {{-- Operator yang Meng-Approve (muncul jika status sudah pending ke atas) --}}
                            @if(in_array($kunjungan->status_kunjungan, ['pending', 'diproses', 'diterima', 'selesai', 'ditolak']))
                                <div class="col-md-6">
                                    <label class="form-label text-muted small mb-1">Operator yang Meng-Approve</label>
                                    <p class="fw-semibold mb-0 d-flex align-items-center">
                                        <i class='bx bx-user-circle text-muted me-2'></i>
                                        {{ $kunjungan->operator->nama_operator ?? '-' }}
                                    </p>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">
                                    @if(in_array($kunjungan->status_kunjungan, ['diterima', 'selesai']))
                                        Jenis Perawatan
                                    @else
                                        Request Perawatan
                                    @endif
                                </label>
                                <p class="fw-semibold mb-0">
                                    @if($kunjungan->jenis_perawatan === 'Rawat Inap')
                                        <span class="badge bg-primary bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-bed me-1'></i>Rawat Inap
                                        </span>
                                    @elseif($kunjungan->jenis_perawatan === 'Rawat Jalan')
                                        <span class="badge bg-success bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-walking me-1'></i>Rawat Jalan
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-gradient d-inline-flex align-items-center">-</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">Status Kunjungan</label>
                                <p class="fw-semibold mb-0">
                                    @if($kunjungan->status_kunjungan === 'pending')
                                        <span class="badge bg-secondary bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-clock-8 me-1'></i>Pending
                                        </span>
                                    @elseif($kunjungan->status_kunjungan === 'diproses')
                                        <span class="badge bg-warning bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-timer me-1'></i>Diproses
                                        </span>
                                    @elseif($kunjungan->status_kunjungan === 'diterima')
                                        <span class="badge bg-info bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-check-circle me-1'></i>Diterima
                                        </span>
                                    @elseif($kunjungan->status_kunjungan === 'selesai')
                                        <span class="badge bg-success bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-checks me-1'></i>Selesai
                                        </span>
                                    @elseif($kunjungan->status_kunjungan === 'ditolak')
                                        <span class="badge bg-danger bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-x-circle me-1'></i>Ditolak
                                        </span>
                                    @elseif($kunjungan->status_kunjungan === 'dibatalkan')
                                        <span class="badge bg-dark bg-gradient d-inline-flex align-items-center">
                                            <i class='bx bx-block me-1'></i>Dibatalkan
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-gradient d-inline-flex align-items-center">
                                            {{ ucfirst($kunjungan->status_kunjungan) }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted small mb-1">Keluhan</label>
                                <p class="fw-semibold mb-0">{{ $kunjungan->keluhan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Perawatan Card --}}
            @if(!in_array($kunjungan->status_kunjungan, ['ditolak', 'dibatalkan', 'pending', 'diproses']))
                @if($kunjungan->riwayat)
                    <div class="col-md-12">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                                <div class="icon-shape bg-success bg-gradient rounded-3 me-3 d-flex align-items-center justify-content-center"
                                    style="width: 45px; height: 45px;">
                                    <i class='bx bx-medical-kit text-white' style="font-size: 18px;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Detail Perawatan</h5>
                                    <small class="text-muted">Diagnosa dan riwayat perawatan</small>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small mb-1">Penyakit/Diagnosa</label>
                                        <p class="fw-semibold mb-0 d-flex align-items-center">
                                            <i class='bx bx-search text-muted me-2'></i>
                                            {{ $kunjungan->riwayat->penyakit ?? '-' }}
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-muted small mb-1">Obat & Dosis</label>
                                        <p class="fw-semibold mb-0 d-flex align-items-center">
                                            <i class='bx bx-pill text-muted me-1'></i>
                                            {{ $kunjungan->riwayat->obat ?? '-' }}
                                            @if($kunjungan->riwayat->dosis)
                                                <span class="text-muted">({{ $kunjungan->riwayat->dosis }})</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label text-muted small mb-1">Status Pasien</label>
                                        <p class="fw-semibold mb-0">
                                            @if($kunjungan->riwayat->status_pasien === 'Sudah Sembuh')
                                                <span class="badge bg-success bg-gradient d-inline-flex align-items-center">
                                                    <i class='bx bx-heart me-1'></i>Sudah Sembuh
                                                </span>
                                            @else
                                                <span class="badge bg-danger bg-gradient d-inline-flex align-items-center">
                                                    <i class='bx bx-pulse me-1'></i>{{ $kunjungan->riwayat->status_pasien }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>

                                    {{-- Data Rawat Inap --}}
                                    @if($kunjungan->jenis_perawatan === 'Rawat Inap')
                                        <div class="col-md-4">
                                            <label class="form-label text-muted small mb-1">Ruangan</label>
                                            <p class="fw-semibold mb-0 d-flex align-items-center">
                                                <i class='bx bx-door-open text-muted me-2'></i>
                                                {{ $kunjungan->riwayat->ruangan->namaRuangan ?? '-' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-muted small mb-1">Tanggal Masuk</label>
                                            <p class="fw-semibold mb-0 d-flex align-items-center">
                                                <i class='bx bx-calendar-alt text-muted me-2'></i>
                                                @if($kunjungan->riwayat->tanggal_masuk)
                                                    {{ \Carbon\Carbon::parse($kunjungan->riwayat->tanggal_masuk)->format('d F Y') }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-muted small mb-1">Tanggal Keluar</label>
                                            <p class="fw-semibold mb-0 d-flex align-items-center">
                                                <i class='bx bx-calendar-alt text-muted me-2'></i>
                                                @if($kunjungan->riwayat->tanggal_keluar)
                                                    {{ \Carbon\Carbon::parse($kunjungan->riwayat->tanggal_keluar)->format('d F Y') }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                                <div class="icon-shape bg-warning bg-gradient rounded-3 me-3 d-flex align-items-center justify-content-center"
                                    style="width: 45px; height: 45px;">
                                    <i class="fas fa-exclamation-triangle text-white" style="font-size: 18px;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Detail Perawatan</h5>
                                    <small class="text-muted">Informasi perawatan belum tersedia</small>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-warning mb-0 d-flex align-items-center">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Belum ada riwayat perawatan untuk kunjungan ini. Data akan diperbarui setelah pemeriksaan
                                    selesai.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Action Buttons --}}
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex gap-2">
                            <a href="{{ route('kunjungan-operator-view') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button onclick="window.print()" class="btn btn-outline-primary">
                                <i class="fas fa-print me-2"></i>Cetak Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .icon-shape {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .alert {
            border-radius: 12px;
        }

        .badge {
            font-size: 0.75rem;
            padding: 6px 12px;
        }

        @media print {

            .btn,
            .card-header {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
@endsection