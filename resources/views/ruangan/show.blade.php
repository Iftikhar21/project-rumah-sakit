@extends('template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Show Ruangan</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('ruangan.index') }}">Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Ruangan:</strong>
                {{ $ruangan->kodeRuangan }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Ruangan:</strong>
                {{ $ruangan->namaRuangan }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kapasitas:</strong>
                {{ $ruangan->dayaTampung }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>lokasi:</strong>
                {{ $ruangan->lokasi }}
            </div>
        </div>
    </div>
@endsection