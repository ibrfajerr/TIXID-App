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
            <a href="{{ route('staff.promos.trash') }}" class="btn btn-secondary me-2">Data Sampah</a>
            <a href="{{ route('staff.promos.export') }}" class="btn btn-secondary me-2">Export (.xlsx)</a>
            <a href="{{ route('staff.promos.create') }}" class="btn btn-success">Tambah Data</a>
        </div>
        <h5>Data Promo</h5>
        <table class="table my-3 table-bordered">
            <tr>
                <th>#</th>
                <th class="text-center">Kode Promo</th>
                <th class="text-center">Diskon</th>
                <th class="text-center">Tipe</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
            @foreach ($promos as $key => $promo)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $promo->promo_code }}</td>
                    <td>{{ $promo->type == 'precent' ? $promo->discount . '%' : 'Rp. ' . $promo->discount }}</td>
                    <td>{{ $promo->type == 'precent' ? 'Persen' : 'Rupiah' }}</td>
                    <td>
                        @if ($promo->actived == 1)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Tidak aktif</span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="{{ route('staff.promos.edit', $promo->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('staff.promos.delete', $promo->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        @if ($promo->actived == 1)
                            <a href="{{ route('staff.promos.inactive', $promo->id) }}"
                                class="btn btn-warning">Non-Aktif</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
