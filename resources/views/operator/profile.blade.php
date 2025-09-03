@extends('template-operator')

@section('content')
<div class="container">
    <h4>Lengkapi Data Diri</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('operator.update') }}" method="POST" class="">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_operator" class="form-label">ID Operator</label>
            <input type="text" name="id_operator" value="{{ $operator->kode_operator }}" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="nama_operator" class="form-label">Nama Operator</label>
            <input type="text" name="nama_operator" value="{{ old('nama_operator', $operator->nama_operator) }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
