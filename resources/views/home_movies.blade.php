@extends('templates.app')

@section('content')
    <div class="container my-5">
        <div class="mt-1 d-flex flex-wrap justify-content-center container gap-2">

            @foreach ($movies as $movie)
                <div class="card shadow-sm" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $movie['poster']) }}" class="card-img-top"
                        style="object-fit: cover; object-position: bottom" alt="{{ $movie['title'] }}" height="450" />
                    {{-- !important : memprioritaskan jika ada style padding dari bootstrap akan dibaca yang di style ( diutamakan ) --}}
                    <div class="card-body text-center p-2" style="padding: 0 !important">
                        <p class="card-text text-center bg-primary py-2">
                            <a href="{{ route('schedules.detail') }}"
                                class="btn btn-primary w-100 text-warning text-center fw-bold ">
                                <b>Beli Tiket</b>
                            </a>
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
