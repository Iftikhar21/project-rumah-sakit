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
                    <input type="text" name="idDokter" class="form-control" placeholder="ID Dokter" value="{{ $dktr->idDokter }}">
                </div>   
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Dokter:</strong>
                    <input type="text" name="namaDokter" class="form-control" placeholder="Nama Dokter" value="{{ $dktr->namaDokter }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Lahir:</strong>
                    <input type="date" name="tanggalLahir" class="form-control" placeholder="Tanggal Lahir" value="{{ $dktr->tanggalLahir }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Spesialisasi:</strong>
                    <input type="text" name="spesialisasi" class="form-control" placeholder="Spesialisasi" value="{{ $dktr->spesialisasi }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jam Praktik:</strong>
                    <input type="time" name="jamPraktik" class="form-control" placeholder="Jam Praktik" value="{{ $dktr->jamPraktik }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lokasi Praktik:</strong>
                    <input type="text" name="lokasiPraktik" class="form-control" placeholder="Lokasi Praktik" value="{{ $dktr->lokasiPraktik }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan !</button>
            </div>
        </div>
    </form>
@endsection