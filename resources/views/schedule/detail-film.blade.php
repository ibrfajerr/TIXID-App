@extends('templates.app')

@section('content')
    <div class="container pt-5">
        <div class="w-75 d-block m-auto">
            {{-- Poster + Detail Film --}}
            <div class="d-flex">
                <div style="width: 150px; height: 200px;">
                    <img src="https://upload.wikimedia.org/wikipedia/id/4/4a/Oppenheimer_%28film%29.jpg"
                        alt="Poster Oppenheimer" class="w-100 rounded">
                </div>
                <div class="ms-5 mt-4">
                    <h5 class="fw-bold">Oppenheimer</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><b class="text-secondary">Genre</b></td>
                            <td class="ps-3">Drama, History</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Durasi</b></td>
                            <td class="ps-3">180 menit 9 detik</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Sutradara</b></td>
                            <td class="ps-3">Christopher Nolan</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Rating</b></td>
                            <td class="ps-3"><span class="badge bg-danger">17+</span></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
