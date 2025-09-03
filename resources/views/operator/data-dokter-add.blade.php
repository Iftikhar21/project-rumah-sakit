@extends('template-operator')

@section('content')
    <div class="container-fluid px-4" style="padding-top: 60px;">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Tambah Dokter</h1>
                            <p class="text-muted mb-0">Tambah data dokter baru beserta akun user.</p>
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

        <form action="{{ route('operator-add-data-dokter') }}" method="POST">
            @csrf

            <!-- Akun User Card -->
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
                                            ->whereDoesntHave('dokter')
                                            ->whereDoesntHave('pasien')
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

            <!-- Data Dokter Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-primary">Data Dokter</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Dokter</label>
                                    <input type="text" name="namaDokter" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggalLahir" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenisKelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jam Praktik</label>
                                    <input type="time" name="jamPraktik" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Spesialisasi</label>
                                    <input type="text" name="spesialisasi" class="form-control" required>
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
                            <a href="{{ route('data-dokter') }}" class="btn btn-secondary me-2">
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