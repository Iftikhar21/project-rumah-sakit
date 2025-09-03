@extends('template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Tambah Ruangan Baru</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('ruangan.index') }}"> Kembali</a>
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
    <form action="{{ route('ruangan.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Ruangan:</strong>
                    <input type="text" name="kodeRuangan" class="form-control" placeholder="ID Ruangan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Ruangan:</strong>
                    <input type="text" name="namaRuangan" class="form-control" placeholder="Nama Ruangan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kapasitas:</strong>
                    <input type="number" name="dayaTampung" class="form-control" placeholder="Kapasitas">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>lokasi</strong>
                    <select name="lokasi" class="form-control">
                        <option> - Jenis Ruangan - </option>
                        <option value="IGD">IGD</option>
                        <option value="Ruang 1">Ruang 1</option>
                        <option value="Ruang 2">Ruang 2</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan !</button>
            </div>
        </div>
    </form>
@endsection