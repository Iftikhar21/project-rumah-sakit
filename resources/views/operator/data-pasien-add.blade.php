@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Tambah Pasien</h1>
                            <p class="text-muted mb-0">Tambah data pasien baru beserta akun user.</p>
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

        <form action="{{ route('operator-add-data-pasien') }}" method="POST">
            @csrf

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-success">Akun User</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Tipe User</label>
                                <select name="user_option" id="user_option" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="new">Buat User Baru</option>
                                    <option value="existing">Gunakan User yang Ada</option>
                                </select>
                            </div>

                            {{-- Jika buat user baru --}}
                            <div id="new-user-fields" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            {{-- Jika pilih user yang sudah ada --}}
                            <div id="existing-user-fields" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label">Pilih User</label>
                                    <select name="user_id" class="form-select">
                                        <option value="">-- Pilih User --</option>
                                        @foreach(\App\Models\User::where('role', 'user')
                                            ->whereDoesntHave('pasien') // hanya user yang belum punya pasien
                                            ->get() as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pasien Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-primary">Data Pasien</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pasien</label>
                                    <input type="text" name="nama_pasien" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="nomor_telepon" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota</label>
                                    <input type="text" name="kota_pasien" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat_pasien" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('user_option').addEventListener('change', function () {
                    if (this.value === 'new') {
                        document.getElementById('new-user-fields').style.display = 'block';
                        document.getElementById('existing-user-fields').style.display = 'none';
                    } else if (this.value === 'existing') {
                        document.getElementById('new-user-fields').style.display = 'none';
                        document.getElementById('existing-user-fields').style.display = 'block';
                    } else {
                        document.getElementById('new-user-fields').style.display = 'none';
                        document.getElementById('existing-user-fields').style.display = 'none';
                    }
                });
            </script>

            <!-- Action Buttons -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-end">
                            <a href="{{ route('data-pasien') }}" class="btn btn-secondary me-2">
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