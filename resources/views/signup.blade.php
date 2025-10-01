@extends('templates.app')

@section('content')
    <div class="w-50 d-block mx-auto my-5">
        <form method="post" action="{{ route('sign_up.add') }}">
            {{-- kunci yang diminta server agar formulir bisa mengirim data ke server / ke controller --}}
            @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" name="first_name" id="form3Example1"
                            class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" />
                        <label class="form-label" for="form3Example1">First name</label>
                    </div>

                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" name="last_name" id="form3Example2"
                            class="form-control @error('first_name') is-invalid @enderror" value="{{ old('last_name') }}" />
                        <label class="form-label" for="form3Example2">Last name</label>
                    </div>

                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Email input -->
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" name="email" id="form3Example3"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                <label class="form-label" for="form3Example3">Email address</label>
            </div>

            <!-- Password input -->
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="password" id="form3Example4"
                    class="form-control @error('password') is-invalid @enderror" />
                <label class="form-label" for="form3Example4">Password</label>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-start mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                <label class="form-check-label" for="form2Example33">
                    Subscribe to our newsletter
                </label>
            </div>

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>or sign up with:</p>
                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                </button>

                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </button>

                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                </button>

                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-github"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
