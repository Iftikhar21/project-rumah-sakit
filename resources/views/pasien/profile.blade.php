@extends('template-pasien')

@section('content')
    <div class="container-fluid" style="padding-top: 60px;">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($pasien)
            <form action="{{ route('pasien.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_pasien" class="form-label">ID Pasien</label>
                    <input type="text" name="id_pasien" value="{{ $pasien->id_pasien }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" name="nama_pasien" value="{{ old('nama_pasien', $pasien->nama_pasien) }}"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat_pasien" class="form-label">Alamat</label>
                    <textarea name="alamat_pasien"
                        class="form-control">{{ old('alamat_pasien', $pasien->alamat_pasien) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="kota_pasien" class="form-label">Kota</label>
                    <input type="text" name="kota_pasien" value="{{ old('kota_pasien', $pasien->kota_pasien) }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $pasien->nomor_telepon) }}"
                        class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        @else
            {{-- Jika belum register -> tampilkan form register --}}
            @include('pasien.pasien-register')
        @endif
    </div>
@endsection