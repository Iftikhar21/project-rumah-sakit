@extends('template-pasien')

@section('content')
    <div class="container-fluid px-4 py-1 min-vh-100">
        <div class="row mb-4" style="margin-top: 60px;">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Request Kunjungan</h1>
                            <p class="text-muted mb-0">Selamat datang <span
                                    class="fw-bold">{{ $pasien->nama_pasien ?? '-' }}</span> !</p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">{{ date('l, d F Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                        <a href="{{ route('pasien-add-data-kunjungan-view') }}" class="btn btn-primary">
                            + Tambah Kunjungan
                        </a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <table class="table table-bordered table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Rekam Medis</th>
                                    <th>ID Pasien</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Keluhan</th>
                                    <th class="text-center">Jenis Perawatan</th>
                                    <th class="text-center">Status</th>
                                    <th class="w-auto text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kunjungan as $index => $k)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $k->no_rekam_medis }}</td>
                                        <td>{{ $k->pasien->id_pasien }}</td>
                                        <td>{{ $k->tanggal_kunjungan }}</td>
                                        <td>{{ $k->keluhan }}</td>
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
                                                <span class="badge bg-info">Diterima</span>
                                            @elseif($k->status_kunjungan === 'selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-danger">{{ ucfirst($k->status_kunjungan) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @switch($k->status_kunjungan)
                                                @case('pending')
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <!-- Edit -->
                                                        <form action="{{ route('pasien-edit-data-kunjungan-view', $k->id) }}" method="GET">
                                                            <button class="btn btn-sm btn-warning"><i class='bx bx-edit'></i></button>
                                                        </form>
                                                        <!-- Batalkan -->
                                                        <form action="{{ route('pasien-batal-kunjungan', $k->id) }}" method="POST">
                                                            @csrf @method('PATCH')
                                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin batalkan?')">
                                                                <i class='bx bx-x-circle'></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @break
                                                @case('diproses')
                                                @case('diterima')
                                                @case('selesai')
                                                @case('dibatalkan')
                                                @case('ditolak')
                                                    <a href="{{ route('kunjungan-view-detail', $k->id) }}" class="btn btn-sm btn-info">
                                                        <i class="bx bx-eye text-white"></i>
                                                    </a>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada kunjungan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection