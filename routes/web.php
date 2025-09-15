<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// http method route
// 1. get -> menampilkan halaman
// 2. post -> mengambil data menambahkan data
// 3. patch / put -> mengubah data
// 4. delete -> menghapus data

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/sign-up', function () {
    return view('signup');
})->name('sign_up');

// path : kebab, name : snack

// route - controller - model - view : memerlukan data
// route - view : tanpa data

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/schedules', function () {
    return view('schedule.detail-film');
})->name('schedules.detail');

Route::post('/sign-up', [UserController::class, 'signUp'])->name('sign_up.add');
Route::post('/login', [UserController::class,'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class,'logout'])->name('logout');

// prefix() : awalan, menulis /admin satu kali untuk 16 route CRUD
// name('admin.') : pakai titik krna nnti akan digabungkan
// middleware('idAdmin') : memanggil middleware yg akan digunakan
// middleware : authorization, pengaturan hak akses pengguna

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

    // bioskop
    Route::prefix('/cinemas')->name('cinemas.')->group(function () {
        Route::get('/', [CinemaController::class, 'index'])->name('index');

        Route::get('/create', function() {
            return view('admin.cinema.create');
        })->name('create');

        Route::post('/store', [CinemaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CinemaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CinemaController::class,'update'])->name('update');
        Route::delete('/delete/{id}', [CinemaController::class,'destroy'])->name('delete');
    });

    // staff
    Route::prefix('/staffs')->name('staffs.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');

        Route::get('/create', function() {
            return view('admin.staff.create');
        })->name('create');

        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class,'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class,'destroy'])->name('delete');

    });
});
