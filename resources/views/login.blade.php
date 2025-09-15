@extends('templates.app')

@section('content')
    <div class="w-50 d-block mx-auto my-5">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error')}}</div>
        @endif
        <form method="post" action="{{ route('login.auth') }}">
            @csrf
            <!-- Email input -->
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form2Example1" class="form-control @error('email') is-invalid
                @enderror" name="email" />
                <label class="form-label" for="form2Example1">Email address</label>
            </div>

            <!-- Password input -->
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form2Example2" class="form-control @error('password') is-invalid
                @enderror" name="password" />
                <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example34" checked />
                        <label class="form-check-label" for="form2Example34"> Remember me </label>
                    </div>
                </div>

                <div class="col">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Login</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a href="#!">Register</a></p>
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
