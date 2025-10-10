@extends('templates.app')

@section('content')
    <div class="container mt-5">
        <div class="w-75 d-block m-auto mb-5">
            {{-- Poster + Detail Film --}}
            <div class="d-flex">
                <div style="width: 150px; height: 200px;">
                    <img src="{{ asset('storage/' . $movie['poster']) }}" alt="Poster {{ $movie['title'] }}"
                        class="w-100 rounded">
                </div>
                <div class="ms-5 mt-4">
                    <h5 class="fw-bold">{{ $movie['title'] }}</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><b class="text-secondary">Genre</b></td>
                            <td class="">{{ $movie['genre'] }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Durasi</b></td>
                            <td class="">{{ $movie['duration'] }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Sutradara</b></td>
                            <td class="">{{ $movie['director'] }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Rating</b></td>
                            <td class=""><span class="badge bg-danger">{{ $movie['age_rating'] }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center flex-column align-items-center">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page"data-bs-toggle="tab"
                        data-bs-target="#sinopsis-tab-pane">Sinopsis</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#jadwal-tab-pane">Jadwal</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-2" id="sinopsis-tab-pane" role="tabpanel"
                    aria-labelledby="sinopsis-tab" tabindex="0">
                    <p class="mt-3 w-75 d-block mx-auto" style="text-align: justify">
                        {{ $movie['description'] }}
                    </p>
                </div>
                <div class="tab-pane fade mt-2" id="jadwal-tab-pane" role="tabpanel" aria-labelledby="jadwal-tab"
                    tabindex="0">
                    @foreach ($movie['schedules'] as $schedule)
                        <div class="d-flex">
                            <i class="fa-solid fa-building"><b> {{ $schedule['cinema']['name'] }}</b></i>
                        </div>
                        <p class="mt-2">{{ $schedule['cinema']['location'] }}</p>
                        <div class="d-flex flex-wrap mt-3">
                            @foreach ($schedule['hours'] as $hours)
                                <button class="btn btn-outline-secondary me-2">{{ $hours }}</button>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
