@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Data Dokter</h1>
                            <p class="text-muted mb-0">Data dokter yang ada.</p>
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
                        <a href="{{ route('operator-add-data-dokter-view') }}" class="btn btn-primary">
                            + Tambah Dokter
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
                                        <th style="width:12%;" class="text-center">ID Dokter</th>
                                        <th style="width:20%;" class="text-center">Nama Dokter</th>
                                        <th style="width:13%;" class="text-center">Tanggal Lahir</th>
                                        <th style="width:13%;" class="text-center">Jenis Kelamin</th>
                                        <th style="width:13%;" class="text-center">Spesialisasi</th>
                                        <th style="width:13%;" class="text-center">Jam Praktik</th>
                                        <th style="width:16%;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dokter as $d)
                                        <tr>
                                            <td>{{ $d->idDokter ?? '-' }}</td>
                                            <td>{{ $d->namaDokter ?? '-' }}</td>
                                            <td>{{ $d->tanggalLahir ?? '-' }}</td>
                                            <td>
                                                {{ $d->jenisKelamin ? ($d->jenisKelamin == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                                            </td>
                                            <td>{{ $d->spesialisasi ?? '-' }}</td>
                                            <td class="text-center">
                                                {{ $d->jamPraktik ? \Carbon\Carbon::parse($d->jamPraktik)->format('h:i A') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('operator-edit-data-dokter-view', $d->id) }}"
                                                    class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit Dokter">
                                                    <i class='bx bx-edit'></i>
                                                </a>

                                                <!-- Tombol Hapus Dokter -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusDokterModal{{ $d->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Hapus Dokter">
                                                    <i class='bx bx-trash'></i>
                                                </button>

                                                <!-- Modal Hapus Dokter -->
                                                <div class="modal fade" id="hapusDokterModal{{ $d->id }}" tabindex="-1"
                                                    aria-labelledby="hapusDokterLabel{{ $d->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title" id="hapusDokterLabel{{ $d->id }}">Hapus
                                                                    Dokter</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus dokter
                                                                <br><b>{{ $d->namaDokter}}</b>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('operator-delete-data-dokter', $d->id) }}"
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
                                                    data-bs-target="#hapusAllDataModal{{ $d->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Hapus Semua Data">
                                                    <i class='bx  bx-trash-x'></i>
                                                </button>

                                                <!-- Modal Hapus Semua Data -->
                                                <div class="modal fade" id="hapusAllDataModal{{ $d->id }}" tabindex="-1"
                                                    aria-labelledby="hapusAllDataLabel{{ $d->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-dark text-white">
                                                                <h5 class="modal-title" id="hapusAllDataLabel{{ $d->id }}">Hapus
                                                                    Semua Data Dokter</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ⚠️ Tindakan ini akan menghapus <b>seluruh data
                                                                    dokter</b><br><b>{{ $d->namaDokter}}</b><br>
                                                                termasuk riwayat praktik.
                                                                Apakah Anda yakin?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('operator-delete-all-data-dokter', $d->id) }}"
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
                        {!! $dokter->links() !!}
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