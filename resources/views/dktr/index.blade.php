@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>CRUD DOKTER</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('dktr.create') }}" class="btn btn-success">Input Dokter</a>
                <a href="/" class="btn btn-success">Home</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('succes'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th width="20px" class="text-center">Id</th>
            <th>ID Dokter</th>
            <th width="20%" class="text-center">Nama Dokter</th>
            <th width="280px" class="text-center">Tanggal Lahir</th>
            <th width="280px" class="text-center">Spesialisasi</th>
            <th width="20%" class="text-center">Action</th>
        </tr>
        @foreach ($dktr as $dokter)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $dokter->idDokter }}</td>
            <td>{{ $dokter->namaDokter }}</td>
            <td>{{ $dokter->tanggalLahir }}</td>
            <td>{{ $dokter->spesialisasi }}</td>
            <td class="text-center">
                <form action="{{ route('dktr.destroy', $dokter->id) }}" method="post">
                    <a href="{{ route('dktr.show', $dokter->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('dktr.edit', $dokter->id) }}" class="btn btn-prrimary btn-sm">Edit</a>

                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $dktr->links() !!}
    
@endsection