@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Data Kunjungan</h1>
                            <p class="text-muted mb-0">Daftar request kunjungan pasien.</p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">{{ date('l, d F Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Daftar Request Kunjungan Pasien</h5>
                    </div>
                    <div class="card-body px-2">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p class="mb-0">{{ session('success') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <p class="mb-0">{{ session('error') }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">ID Pasien</th>
                                        <th class="text-center">Tanggal Kunjungan</th>
                                        <th class="text-center">Nama Pasien</th>
                                        <th class="text-center">Keluhan</th>
                                        <th class="text-center">Jenis Perawatan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Dokter</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kunjungan as $index => $k)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $k->pasien->id_pasien ?? '-' }}</td>
                                            <td>{{ $k->tanggal_kunjungan ?? '-' }}</td>
                                            <td>{{ $k->pasien->nama_pasien ?? '-' }}</td>
                                            <td>{{ $k->keluhan ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($k->jenis_perawatan === 'Rawat Inap')
                                                    <span class="badge bg-primary">Rawat Inap</span>
                                                @elseif ($k->jenis_perawatan === 'Rawat Jalan')
                                                    <span class="badge bg-success">Rawat Jalan</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $k->jenis_perawatan ?? '-' }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($k->status_kunjungan === 'pending')
                                                    <span class="badge bg-secondary">Pending</span>
                                                @elseif($k->status_kunjungan === 'diproses')
                                                    <span class="badge bg-warning">Diproses</span>
                                                @elseif($k->status_kunjungan === 'diterima')
                                                    <span class="badge bg-success">Diterima</span>
                                                @elseif($k->status_kunjungan === 'selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @elseif($k->status_kunjungan === 'ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @elseif($k->status_kunjungan === 'dibatalkan')
                                                    <span class="badge bg-danger">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td>{{ $k->dokter->namaDokter ?? '-' }} ({{ $k->dokter->spesialisasi ?? '-' }})</td>
                                            <td class="text-center">
                                                @switch($k->status_kunjungan)
                                                    @case('pending')
                                                        @if(!$k->dokter_id)
                                                            {{-- Tombol pilih dokter --}}
                                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#pilihDokterModal-{{ $k->id }}">
                                                                <i class='bx bx-user-plus'></i>
                                                            </button>
                                                        @else
                                                            {{-- Setujui --}}
                                                            <form action="{{ route('operator-setujui-kunjungan', $k->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success btn-sm d-inline-flex align-items-center">
                                                                    <i class='bx bx-check'></i>
                                                                </button>
                                                            </form>
                                                            {{-- Tolak --}}
                                                            <form action="{{ route('operator-tolak-kunjungan', $k->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger btn-sm d-inline-flex align-items-center">
                                                                    <i class='bx bx-x'></i>
                                                                </button>
                                                            </form>
                                                            {{-- Edit dokter hanya untuk pending --}}
                                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#editKunjunganModal-{{ $k->id }}">
                                                                <i class='bx bx-edit'></i>
                                                            </button>
                                                        @endif
                                                    @break

                                                    @case('diproses')
                                                    @case('diterima')
                                                    @case('selesai')
                                                    @case('ditolak')
                                                    @case('dibatalkan')
                                                        {{-- Hanya lihat detail --}}
                                                        <a href="{{ route('operator-kunjungan-view-detail', $k->id) }}" class="btn btn-info btn-sm text-white">
                                                            <i class='bx bx-eye'></i>
                                                        </a>
                                                    @break
                                                    @default
                                                        <span class="text-muted">Status tidak dikenal</span>
                                                @endswitch
                                            </td>
                                        </tr>

                                        {{-- Modal Pilih Dokter --}}
                                        @if($k->status_kunjungan === 'pending' && !$k->dokter_id)
                                            <div class="modal fade" id="pilihDokterModal-{{ $k->id }}" tabindex="-1"
                                                aria-labelledby="pilihDokterModalLabel-{{ $k->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="pilihDokterModalLabel-{{ $k->id }}">
                                                                <i class="bx bx-user-plus me-2"></i>
                                                                Pilih Dokter untuk Pasien
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-0">
                                                            <div class="list-group list-group-flush">
                                                                @forelse($dokter as $d)
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                                                style="width: 50px; height: 50px;">
                                                                                <strong>{{ strtoupper(substr($d->namaDokter, 0, 2)) }}</strong>
                                                                            </div>
                                                                            <div>
                                                                                <h6 class="mb-1 fw-bold">
                                                                                    <span class="badge bg-light text-primary me-2">{{ $d->idDokter }}</span>
                                                                                    {{ $d->namaDokter }}
                                                                                </h6>
                                                                                <small class="text-muted">
                                                                                    <i class="bx bx-briefcase-alt-2 me-1"></i>
                                                                                    {{ $d->spesialisasi ?? 'Umum' }}
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                        <form action="{{ route('operator-pilih-dokter-kunjungan', $k->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="dokter_id" value="{{ $d->id }}">
                                                                            <button type="submit" class="btn btn-outline-success btn-sm d-inline-flex align-items-center">
                                                                                <i class="bx bx-check me-1"></i>
                                                                                Pilih
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                @empty
                                                                    <div class="list-group-item text-center py-5">
                                                                        <i class="bx bx-user-x display-4 text-muted mb-3"></i>
                                                                        <h6 class="text-muted">Belum ada dokter terdaftar</h6>
                                                                        <small class="text-muted">Silakan tambahkan dokter terlebih dahulu</small>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-secondary d-inline-flex align-items-center" data-bs-dismiss="modal">
                                                                <i class="bx bx-x me-1"></i>
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Modal Edit Dokter --}}
                                        @if(in_array($k->status_kunjungan, ['pending', 'diproses']) && $k->dokter_id)
                                            <div class="modal fade" id="editKunjunganModal-{{ $k->id }}" tabindex="-1"
                                                aria-labelledby="editKunjunganModalLabel-{{ $k->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning text-white">
                                                            <h5 class="modal-title" id="editKunjunganModalLabel-{{ $k->id }}">
                                                                <i class="bx bx-edit-alt me-2"></i>
                                                                Edit Dokter Pasien
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-0">
                                                            <div class="list-group list-group-flush">
                                                                @forelse($dokter as $d)
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                                                style="width: 50px; height: 50px;">
                                                                                <strong>{{ strtoupper(substr($d->namaDokter, 0, 2)) }}</strong>
                                                                            </div>
                                                                            <div>
                                                                                <h6 class="mb-1 fw-bold">
                                                                                    <span class="badge bg-light text-warning me-2">{{ $d->idDokter }}</span>
                                                                                    {{ $d->namaDokter }}
                                                                                </h6>
                                                                                <small class="text-muted">
                                                                                    <i class="bx bx-briefcase-alt-2 me-1"></i>
                                                                                    {{ $d->spesialisasi ?? 'Umum' }}
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        @if($k->dokter_id == $d->id)
                                                                            <span class="badge bg-success d-inline-flex align-items-center p-2">
                                                                                <i class="bx bx-check-circle me-1"></i>
                                                                                Terpilih
                                                                            </span>
                                                                        @else
                                                                            <form action="{{ route('operator-edit-data-kunjungan', $k->id) }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="dokter_id" value="{{ $d->id }}">
                                                                                <button type="submit" class="btn btn-outline-warning btn-sm">
                                                                                    Pilih
                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                @empty
                                                                    <div class="list-group-item text-center py-5">
                                                                        <i class="bx bx-user-x display-4 text-muted mb-3"></i>
                                                                        <h6 class="text-muted">Belum ada dokter terdaftar</h6>
                                                                        <small class="text-muted">Silakan tambahkan dokter terlebih dahulu</small>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x me-1"></i>
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">Belum ada request kunjungan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{-- Pagination jika diperlukan --}}
                        {{-- {!! $kunjungan->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection