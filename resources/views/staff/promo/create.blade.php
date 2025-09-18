@extends('templates.app')

@section('content')
    <div class="mt-5 w-75 d-block m-auto">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        <nav data-mdb-navbar-init class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('staff.promos.index') }}">Promo</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.promos.index') }}">Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Tambah</a></li>
                    </ol>
                </nav>
            </div>
        </nav>
    </div>
    <div class="card w-75 mx-auto my-5 p-4">
        <h5 class="text-center my-3">Buat Data Promo</h5>
        <form action="{{ route('staff.promos.store') }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-6">
                    <label for="discount" class="form-label">Jumlah Promo ( Hanya Angka )</label>
                    <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount"
                        name="discount">
                    @error('discount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="type" class="form-label">Tipe</label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                        <option value="" hidden>Pilih Tipe</option>
                        <option value="precent">Persen</option>
                        <option value="rupiah">Rupiah</option>
                    </select>
                    @error('type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buat</button>
        </form>
    </div>
@endsection
