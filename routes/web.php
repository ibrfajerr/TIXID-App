<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

// http method route
// 1. get -> menampilkan halaman
// 2. post -> mengambil data menambahkan data
// 3. patch / put -> mengubah data
// 4. delete -> menghapus data

// path : kebab, name : snack

// route - controller - model - view : memerlukan data
// route - view : tanpa data

// prefix() : awalan, menulstaff satu kali untuk 16 route CRUD
// name('admin.') : pakai titik krna nnti akan digabungkan
// middleware('idAdmin') : memanggil middleware yg akan digunakan
// middleware : authorization, pengaturan hak akses pengguna

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/schedules', function () {
    return view('schedule.detail-film');
})->name('schedules.detail');

Route::post('/sign-up', [UserController::class, 'signUp'])->name('sign_up.add');
Route::post('/login', [UserController::class,'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class,'logout'])->name('logout');

// Beranda
Route::get('/', [MovieController::class,'home'])->name('home');

Route::get('/home/movies', [MovieController::class, 'homeAllMovies'])->name('home.movies');

// Middleware Guest
Route::middleware('isGuest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');

    Route::get('/signup', function () {
        return view('signup');
    })->name('sign_up');

    Route::post('/signup', [UserController::class,'signUp'])->name('signup.add');

});

// Middleware Admin
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');

    // Bioskop
    Route::prefix('/cinemas')->name('cinemas.')->group(function () {
        Route::get('/', [CinemaController::class, 'index'])->name('index');

        Route::get('/create', function() {
            return view('admin.cinema.create');
        })->name('create');

        Route::post('/store', [CinemaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CinemaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CinemaController::class,'update'])->name('update');
        Route::delete('/delete/{id}', [CinemaController::class,'destroy'])->name('delete');
        Route::get('/export', [CinemaController::class, 'export'])->name('export');
    });

    // Staff
    Route::prefix('/staffs')->name('staffs.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');

        Route::get('/create', function() {
            return view('admin.staff.create');
        })->name('create');

        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class,'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class,'destroy'])->name('delete');
        Route::get('/export', [UserController::class, 'export'])->name('export');

    });

    // Movie
    Route::prefix('/movies')->name('movies.')->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('index');
        Route::get('/create', [MovieController::class, 'create'])->name('create');
        Route::post('/store', [MovieController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MovieController::class,'edit'])->name('edit');
        Route::put('/update/{id}', [MovieController::class,'update'])->name('update');
        Route::delete('/delete/{id}', [MovieController::class,'destroy'])->name('delete');
        Route::get('/inactive/{id}', [MovieController::class,'inactive'])->name('inactive');
        Route::get('/export', [MovieController::class, 'export'])->name('export');
    });
});

// Middleware Staff
Route::middleware('isStaff')->prefix('/staff')->name('staff.')->group(function () {
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');

    // Promo
    Route::prefix('/promos')->name('promos.')->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('index');
        Route::get('/create', [PromoController::class,'create'])->name('create');
        Route::post('/store', [PromoController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PromoController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PromoController::class,'update'])->name('update');
        Route::delete('/delete/{id}', [PromoController::class,'destroy'])->name('delete');
        Route::get('/inactive/{id}', [PromoController::class,'inactive'])->name('inactive');
        Route::get('/export', [PromoController::class, 'export'])->name('export');
    });

    Route::prefix('/schedules')->name('schedules.')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::post('/store', [ScheduleController::class, 'store'])->name('store');
    });
});
