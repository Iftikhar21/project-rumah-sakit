@extends('template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Dokter</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('dktr.index') }}"> Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Input gagal.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dktr.update', $dktr->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Dokter:</strong>
                    <input type="text" name="idDokter" class="form-control" placeholder="ID Dokter"
                        value="{{ $dktr->idDokter }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Dokter:</strong>
                    <input type="text" name="namaDokter" class="form-control" placeholder="Nama Dokter"
                        value="{{ $dktr->namaDokter }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Lahir:</strong>
                    <input type="date" name="tanggalLahir" class="form-control" placeholder="Tanggal Lahir"
                        value="{{ $dktr->tanggalLahir }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Spesialisasi:</strong>
                    <select name="spesialisasi" class="form-control">
                        <option> - Spesialisasi - </option>
                        <option value="Poli Umum" {{ $dktr->spesialisasi == 'Poli Umum' ? 'selected' : '' }}>Poli Umum
                        </option>
                        <option value="Poli Anak" {{ $dktr->spesialisasi == 'Poli Anak' ? 'selected' : '' }}>Poli Anak
                        </option>
                        <option value="Poli Gigi" {{ $dktr->spesialisasi == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi
                        </option>
                        <option value="Poli Mata" {{ $dktr->spesialisasi == 'Poli Mata' ? 'selected' : '' }}>Poli Mata
                        </option>
                        <option value="Poli Kulit" {{ $dktr->spesialisasi == 'Poli Kulit' ? 'selected' : '' }}>Poli Kulit
                        </option>
                        <option value="Poli Penyakit Dalam" {{ $dktr->spesialisasi == 'Poli Penyakit Dalam' ? 'selected' : '' }}>Poli Penyakit Dalam</option>
                        <option value="Poli Konseling" {{ $dktr->spesialisasi == 'Poli Konseling' ? 'selected' : '' }}>Poli
                            Konseling</option>
                        <option value="Poli Saraf" {{ $dktr->spesialisasi == 'Poli Saraf' ? 'selected' : '' }}>Poli Saraf
                        </option>
                        <option value="Poli THT" {{ $dktr->spesialisasi == 'Poli THT' ? 'selected' : '' }}>Poli THT</option>
                        <option value="Poli Bedah" {{ $dktr->spesialisasi == 'Poli Bedah' ? 'selected' : '' }}>Poli Bedah
                        </option>
                        <option value="Poli Paru" {{ $dktr->spesialisasi == 'Poli Paru' ? 'selected' : '' }}>Poli Paru
                        </option>
                        <option value="Poli Jantung" {{ $dktr->spesialisasi == 'Poli Jantung' ? 'selected' : '' }}>Poli
                            Jantung</option>
                        <option value="Poli Gizi Klinik" {{ $dktr->spesialisasi == 'Poli Gizi Klinik' ? 'selected' : '' }}>
                            Poli Gizi Klinik</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lokasi Praktik:</strong>
                    <select name="lokasiPraktik" class="form-control">
                        <option> - Lokasi - </option>
                        <option value="Jatiwaringin" {{ $dktr->lokasiPraktik == 'Jatiwaringin' ? 'selected' : '' }}>
                            Jatiwaringin</option>
                        <option value="Cipayung" {{ $dktr->lokasiPraktik == 'Cipayung' ? 'selected' : '' }}>Cipayung</option>
                        <option value="Cilangkap" {{ $dktr->lokasiPraktik == 'Cilangkap' ? 'selected' : '' }}>Cilangkap
                        </option>
                        <option value="Munjul" {{ $dktr->lokasiPraktik == 'Munjul' ? 'selected' : '' }}>Munjul</option>
                        <option value="Cibubur" {{ $dktr->lokasiPraktik == 'Cibubur' ? 'selected' : '' }}>Cibubur</option>
                        <option value="Jatinegara" {{ $dktr->lokasiPraktik == 'Jatinegara' ? 'selected' : '' }}>Jatinegara
                        </option>
                        <option value="Matraman" {{ $dktr->lokasiPraktik == 'Matraman' ? 'selected' : '' }}>Matraman</option>
                        <option value="Kebon Jeruk" {{ $dktr->lokasiPraktik == 'Kebon Jeruk' ? 'selected' : '' }}>Kebon Jeruk
                        </option>
                        <option value="Tangerang" {{ $dktr->lokasiPraktik == 'Tangerang' ? 'selected' : '' }}>Tangerang
                        </option>
                        <option value="Bekasi" {{ $dktr->lokasiPraktik == 'Bekasi' ? 'selected' : '' }}>Bekasi</option>
                        <option value="Depok" {{ $dktr->lokasiPraktik == 'Depok' ? 'selected' : '' }}>Depok</option>
                        <option value="Tambun" {{ $dktr->lokasiPraktik == 'Tambun' ? 'selected' : '' }}>Tambun</option>
                        <option value="Cikarang" {{ $dktr->lokasiPraktik == 'Cikarang' ? 'selected' : '' }}>Cikarang</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jam Praktik:</strong>
                    <input type="time" name="jamPraktik" class="form-control" placeholder="Jam Praktik"
                        value="{{ $dktr->jamPraktik }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan !</button>
            </div>
        </div>
    </form>
@endsection