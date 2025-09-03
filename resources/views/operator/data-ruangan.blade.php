@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Data Ruangan</h1>
                            <p class="text-muted mb-0">Data ruangan yang ada.</p>
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
                        <a href="{{ route('operator-add-data-ruangan-view') }}" class="btn btn-primary">
                            + Tambah Ruangan
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
                                        <th style="width:3%;" class="text-center">Id</th>
                                        <th style="width:15%;" class="text-center">Kode Ruangan</th>
                                        <th style="width:25%;" class="text-center">Nama Ruangan</th>
                                        <th style="width:15%;" class="text-center">Daya Tampung</th>
                                        <th style="width:25%;" class="text-center">Lokasi</th>
                                        <th style="width:12%;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ruangan as $r)
                                        <tr>
                                            <td class="text-center">{{ $r->id ?? '-' }}</td>
                                            <td>{{ $r->kodeRuangan ?? '-' }}</td>
                                            <td>{{ $r->namaRuangan ?? '-' }}</td>
                                            <td>{{ $r->dayaTampung ?? '-' }}</td>
                                            <td>{{ $r->lokasi ?? '-' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('operator-edit-data-ruangan-view', $r->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class='bx bx-edit'></i>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusRuanganModal{{ $r->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Hapus Ruangan">
                                                    <i class='bx bx-trash'></i>
                                                </button>

                                                <!-- Modal Hapus Ruangan -->
                                                <div class="modal fade" id="hapusRuanganModal{{ $r->id }}" tabindex="-1"
                                                    aria-labelledby="hapusRuanganLabel{{ $r->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title" id="hapusRuanganLabel{{ $r->id }}">Hapus
                                                                    Ruangan</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus ruangan
                                                                <br><b>{{ $r->namaRuangan ?? '-' }}</b>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('operator-delete-data-ruangan', $r->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger">Hapus</button>
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
                        {!! $ruangan->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection