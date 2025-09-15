@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container mt-3">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        <div class="d-flex justify-content-end mb-3 mt-4">
            <a href="{{ route('admin.cinemas.create') }}" class="btn btn-success">Tambah Data</a>
        </div>
        <h5>Data Bioskop</h5>
        <table class="table my-3 table-bordered">
            <tr>
                <th></th>
                <th class="text-center">Nama Bioskop</th>
                <th class="text-center">Lokasi</th>
                <th class="text-center">Aksi</th>
            </tr>
            {{-- mengubah array multidimensi menjadi array assosiatif --}}
            @foreach ($cinemas as $key => $cinema)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $cinema->name }}</td>
                    <td>{{ $cinema->location }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.cinemas.edit', $cinema->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('admin.cinemas.delete', $cinema->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
