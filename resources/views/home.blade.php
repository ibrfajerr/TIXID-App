{{-- memanggil file template --}}
@extends('templates.app')

{{-- mengisi yield --}}
@section('content')
    @if (Session::get('success'))
        {{-- Auth::user : mengambil data pengguna yang login --}}
        {{-- format : Auth::user()->column_di_fillable --}}
        <div class="alert alert-success w-100">{{ Session::get('success') }} <b>
                Selamat Datang, {{ Auth::user()->name }}</b></div>
    @endif
    @if (Session::get('logout'))
        <div class="alert alert-warning w-100">{{ Session::get('logout') }}</div>
    @endif
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle w-100 d-flex align-items-center" type="button" id="dropdownMenuButton"
            data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false">
            <i class="fa-solid fa-location-dot me-2"></i> Bogor
        </button>
        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
        <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://occ-0-8407-90.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABfOrDRpUeFJs_T0vHOJjmPOnO1JDccNuHwGqt0BTQhrqcCfPzKtpVo17h3WjPIGEihevjcWsXzE5AclRrnjPcA-AhAeNIcEmsLna.jpg?r=023"
                    class="d-block w-100" style="height: 700px; object-fit: cover" alt="Wild Landscape" />
            </div>
            <div class="carousel-item">
                <img src="https://occ-0-8407-90.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABUZRetY0NwWkIBQ-9QF0PLIDcuUCPKgno_8riE_In9tHRgqqTTSG-vGiP5ctXrVMY4PESkV5-x1LE_MGn32QtUZfnoNR4Hx9GoRI.jpg?r=9fa"
                    class="d-block w-100" style="height: 700px; object-fit: cover"" alt="Camera" />
            </div>
            <div class="carousel-item">
                <img src="https://m.media-amazon.com/images/S/pv-target-images/d7973ef1aa81128b3d8d79b17d26941ded8b330db31f65405fd19625d40cd684.jpg"
                    class="d-block w-100" style="height: 700px; object-fit: cover" alt="Exotic Fruits" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="d-flex justify-content-between container mt-4">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-clapperboard"></i>
            <h5 class="mt-2">Sedang Tayang</h5>
        </div>
        <div>
            <a href="" class="btn btn-warning rounded-pill">Semua <i class="fa-solid fa-angle-right"></i></a>
        </div>
    </div>

    <div class="d-flex gap-2 container">
        <button type="button" class="btn btn-outline-primary rounded-pill" data-mdb-ripple-init
            data-mdb-ripple-color="dark">Semua Film</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-mdb-ripple-init
            data-mdb-ripple-color="dark">XXI</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-mdb-ripple-init
            data-mdb-ripple-color="dark">Cinepolis</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-mdb-ripple-init
            data-mdb-ripple-color="dark">IMAX</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-mdb-ripple-init
            data-mdb-ripple-color="dark">CGV</button>
    </div>

    <div class="mt-1 d-flex justify-content-center container gap-2">

        {{-- card 1 --}}
        <div class="card shadow-sm" style="width: 18rem;">
            <img src="https://upload.wikimedia.org/wikipedia/id/4/4a/Oppenheimer_%28film%29.jpg" class="card-img-top"
                style="object-fit: cover; object-position: bottom; height: 450px" alt="Poster Oppenheimer" />
            {{-- !important : memprioritaskan jika ada style padding dari bootstrap akan dibaca yang di style ( diutamakan ) --}}
            <div class="card-body text-center p-2" style="padding: 0 !important">
                <a href="{{ route('schedules.detail') }}"
                    class="btn btn-primary w-100 text-warning text-center fw-bold ">Beli</a>
            </div>
        </div>

        {{-- card 2 --}}
        <div class="card shadow-sm" style="width: 18rem;">
            <img src="https://m.media-amazon.com/images/M/MV5BNTc0YmQxMjEtODI5MC00NjFiLTlkMWUtOGQ5NjFmYWUyZGJhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
                class="card-img-top" style="object-fit: cover; object-position: bottom; height: 450px"
                alt="Poster Dune 2" />
            <div class="card-body text-center p-2" style="padding: 0 !important">
                <a href="{{ route('schedules.detail') }}" class="btn btn-primary w-100 text-warning  fw-bold">Beli</a>
            </div>
        </div>

        {{-- card 3 --}}
        <div class="card shadow-sm" style="width: 18rem;">
            <img src="https://m.media-amazon.com/images/M/MV5BYzk4MWZkMDgtN2UwZC00ZjVlLWE1M2ItYjY4NWEwN2YwOGYxXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
                class="card-img-top" style="object-fit: cover; object-position: bottom; height: 450px"
                alt="Poster Fallout" />
            <div class="card-body text-center p-2" style="padding:0 !important">
                <a href="{{ route('schedules.detail') }}" class="btn btn-primary w-100 text-warning fw-bold">Beli</a>
            </div>
        </div>

        {{-- card 4 --}}
        <div class="card shadow-sm" style="width: 18rem;">
            <img src="https://m.media-amazon.com/images/M/MV5BOGMwZGJiM2EtMzEwZC00YTYzLWIxNzYtMmJmZWNlZjgxZTMwXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
                class="card-img-top" style="object-fit: cover; object-position: bottom; height: 450px"
                alt="Poster Superman 2025" />
            <div class="card-body text-center p-2" style="padding: 0 !important">
                <a href="{{ route('schedules.detail') }}" class="btn btn-primary w-100 text-warning  fw-bold">Beli</a>
            </div>
        </div>
    </div>

    <footer class="bg-body-tertiary text-center text-lg-start mt-4">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2025 TIXID:
            <a class="text-body" href="https://mdbootstrap.com/">tixid.com</a>
        </div>
        <!-- Copyright -->
    </footer>
@endsection
