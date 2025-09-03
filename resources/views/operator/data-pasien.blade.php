@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Data Pasien</h1>
                            <p class="text-muted mb-0">Data pasien yang ada.</p>
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
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                        <a href="{{ route('operator-add-data-pasien-view') }}" class="btn btn-primary">
                            + Tambah Pasien
                        </a>
                    </div>
                    <div class="card-body px-2">
                        @if ($message = Session::get('succes'))
                            <div class="alert alert-success m-3">
                                <p class="mb-0">{{ $message }}</p>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:10%;" class="text-center">ID Pasien</th>
                                        <th style="width:20%;" class="text-center">Nama Pasien</th>
                                        <th style="width:10%;" class="text-center">Tanggal Lahir</th>
                                        <th style="width:12%;" class="text-center">Jenis Kelamin</th>
                                        <th style="width:15%;" class="text-center">Alamat</th>
                                        <th style="width:6%;" class="text-center">Kota</th>
                                        <th style="width:10%;" class="text-center">No Telepon</th>
                                        <th style="width:4%;" class="text-center">Usia</th>
                                        <th style="width:10%;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasien as $p)
                                        <tr>
                                            <td>{{ $p->id_pasien ?? '-' }}</td>
                                            <td>{{ $p->nama_pasien ?? '-' }}</td>
                                            <td>{{ $p->tanggal_lahir ?? '-' }}</td>
                                            <td>
                                                {{ $p->jenis_kelamin ? ($p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                                            </td>
                                            <td>{{ $p->alamat_pasien ?? '-' }}</td>
                                            <td>{{ $p->kota_pasien ?? '-' }}</td>
                                            <td>{{ $p->nomor_telepon ?? '-' }}</td>
                                            <td class="text-center">{{ $p->usia_pasien ?? '-' }}</td>
                                            <td class="text-center">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('operator-edit-data-pasien-view', $p->id) }}"
                                                    class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit Pasien">
                                                    <i class='bx bx-edit'></i>
                                                </a>

                                                <!-- Tombol Hapus Pasien -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusPasienModal{{ $p->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Hapus Pasien">
                                                    <i class='bx bx-trash'></i>
                                                </button>

                                                <!-- Modal Hapus Pasien -->
                                                <div class="modal fade" id="hapusPasienModal{{ $p->id }}" tabindex="-1"
                                                    aria-labelledby="hapusPasienLabel{{ $p->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title" id="hapusPasienLabel{{ $p->id }}">Hapus
                                                                    Pasien</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus pasien
                                                                <br><b>{{ $p->nama_pasien}}</b>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('operator-delete-data-pasien', $p->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tombol Hapus Semua Data -->
                                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusAllDataModal{{ $p->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Hapus Semua Data">
                                                    <i class='bx bx-trash-x'></i>
                                                </button>

                                                <!-- Modal Hapus Semua Data -->
                                                <div class="modal fade" id="hapusAllDataModal{{ $p->id }}" tabindex="-1"
                                                    aria-labelledby="hapusAllDataLabel{{ $p->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-dark text-white">
                                                                <h5 class="modal-title" id="hapusAllDataLabel{{ $p->id }}">Hapus
                                                                    Semua Data Pasien</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ⚠️ Tindakan ini akan menghapus <b>seluruh data
                                                                    pasien</b><br><b>{{ $p->nama_pasien}}</b><br>
                                                                termasuk riwayat kunjungan.
                                                                Apakah Anda yakin?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('operator-delete-all-data-pasien', $p->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-dark">Hapus Semua</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! $pasien->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endsection