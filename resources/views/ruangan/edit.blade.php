@extends('template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Ruangan</h2>
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

    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kode Ruangan:</strong>
                    <input type="text" name="kodeRuangan" class="form-control" placeholder="Kode Ruangan"
                        value="{{ $ruangan->kodeRuangan }}" readonly>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Ruangan:</strong>
                    <input type="text" name="namaRuangan" class="form-control" placeholder="Nama Ruangan"
                        value="{{ $ruangan->namaRuangan }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Daya Tampung:</strong>
                    <input type="text" name="dayaTampung" class="form-control" placeholder="Daya Tampung"
                        value="{{ $ruangan->dayaTampung }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lokasi:</strong>
                    <input type="text" name="lokasi" class="form-control" placeholder="lokasi"
                        value="{{ $ruangan->lokasi }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan !</button>
            </div>
        </div>
    </form>
@endsection