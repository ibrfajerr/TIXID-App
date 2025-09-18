@extends('templates.app')

@section('content')
    <div class="w-75 mx-auto my-5">
        <form action="{{ route('admin.movies.update', $movie['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">

                {{-- Judul Film --}}
                <div class="col-6">
                    <label for="" class="form-label">Judul Film</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $movie['title'] }}">
                </div>

                {{-- Durasi Film --}}
                <div class="col-6">
                    <label for="duration" class="form-label">Durasi Film</label>
                    <input type="time" class="form-control @error('duration') is invalid @enderror" name="duration"
                        id="duration" value="{{ $movie['duration'] }}">
                    @error('duration')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">

                {{-- Genre Film --}}
                <div class="col-6">
                    <label for="genre" class="form-label">Genre Film</label>
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre"
                        id="genre" placeholder="Romance, Comedy" value="{{ $movie['genre'] }}">
                    @error('genre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Sutradara --}}
                <div class="col-6">
                    <label for="director" class="form-label">Sutradara</label>
                    <input type="text" class="form-control @error('director') is-invalid @enderror" name="director"
                        id="director" value="{{ $movie['director'] }}">
                    @error('director')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">

                {{-- Rating Usia --}}
                <div class="col-6">
                    <label for="age_rating" class="form-label">Rating Usia</label>
                    <input type="number" class="form-control @error('age_rating') is-invalid @enderror" name="age_rating"
                        id="age_rating" value="{{ $movie['age_rating'] }}">
                    @error('age_rating')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Poster Film --}}
                <div class="col-6">
                    <label for="poster" class="form-label">Poster</label>
                    <img src="{{ asset('storage/' . $movie['poster']) }}" alt="Poster Film" width="120" class="d-block mx-auto my-2">
                    <input type="file" class="form-control @error('poster') is-invalid @enderror" name="poster"
                        id="poster">
                    @error('poster')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">

                {{-- Sinopsis --}}
                <div class="col-12">
                    <label for="description" class="form-label">Sinopsis</label>
                    <textarea name="description" id="description" rows="10" class="form-control @error('description') is-invalid @enderror">{{ $movie['description'] }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
@endsection
