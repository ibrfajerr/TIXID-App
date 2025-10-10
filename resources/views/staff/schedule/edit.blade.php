@extends('templates.app')

@section('content')
    <div class="container my-5">
        <form method="post" action="{{ route('staff.schedules.update', $schedule['id']) }}">
            @csrf
            @method('PATCH')
            <div class="modal-body">
                <div class="mb-3">
                    <label for="cinema_id" class="col-form-label">Bioskop:</label>
                    <input type="text" name="cinema_id" id="cinema_id" value="{{ $schedule['cinema']['name'] }}"
                        class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="movie_id" class="col-form-label">Film:</label>
                    <input type="text" name="movie_id" id="movie_id" value="{{ $schedule['movie']['title'] }}"
                        class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga:</label>
                    <input type="number" name="price" id="price"
                        class="form-control @error('price') is-invalid
                                @enderror"
                        value="{{ $schedule['price'] }}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="hours" class="form-label">Jam Tayang:</label>
                    @foreach ($schedule['hours'] as $index => $hours)
                        <div class="d-flex align-content-center hour-time w-25 gap-2 mb-2">
                            <input type="time" name="hours[]" id="hours" lang="id" class="form-control"
                                value="{{ $hours }}">
                            @if ($index > 0)
                                <i class="fa-solid fa-circle-xmark text-danger align-content-center"
                                    style="font-size: 1.5rem; cursor: pointer;"
                                    onclick="this.closest('.hour-item').remove()"></i>
                            @endif
                        </div>
                    @endforeach
                    <div id="additionalInput"></div>
                    <span class="text-primary my-3" style="cursor: pointer" onclick="addInput()">+ Tambah Jam</span>
                    @if ($errors->has('hours.*'))
                        <br>
                        <small class="text-danger">{{ $errors->first('hours.*') }}</small>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
@endsection

@push('script')
    <script>
        function addInput() {
            let content = `<div class="d-flex align-content-center hour-additionalInput w-25 gap-2 mb-2">
                            <input type="time" name="hours[]" id="hours" lang="id" class="form-control"
                                value="{{ $hours }}">
                            @if ($index > 0)
                                <i class="fa-solid fa-circle-xmark text-danger align-content-center"
                                    style="font-size: 1.5rem; cursor: pointer;"
                                    onclick="this.closest('.hour-additionalInput').remove()"></i>
                            @endif
                        </div>`;
            document.querySelector('#additionalInput').innerHTML += content;
        }
    </script>
@endpush
