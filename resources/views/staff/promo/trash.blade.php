@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <a href="{{ route('staff.promos.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <h5 class="my-4">Data Sampah Promo</h5>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Kode Promo</th>
                <th>Diskon</th>
                <th>Aksi</th>
            </tr>
            @foreach ($promoTrash as $key => $promo)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $promo->promo_code }}</td>
                    <td>{{ $promo->type == 'precent' ? $promo->discount . '%' : 'Rp. ' . $promo->discount }}</td>
                    <td class="d-flex align-items-center">
                        <form action="{{ route('staff.promos.restore', $promo['id']) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success ms-2" type="submit">Kembalikan</button>
                        </form>
                        <form action="{{ route('staff.promos.delete_permanent', $promo['id']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger ms-2" type="submit">Hapus Permanen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
