<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisSoalController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\DataPanitiaController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::group(['middleware' => 'auth'], function(){
    //Jenis Soal
    Route::resource('jenis', JenisSoalController::class)->middleware('auth');
    Route::post('/jenis/update', 'JenisSoalController@update');
    Route::get('/jenis/delete/{id}', [JenisSoalController::class, 'delete'])->middleware('auth');

    //Biodata
    Route::resource('biodata', BiodataController::class);

    //Lowongan
    Route::resource('lowongan', LowonganController::class)->middleware('auth');
    Route::post('/lowongan/update', 'LowonganController@update');
    Route::get('/lowongan/delete/{id}', [LowonganController::class, 'delete'])->middleware('auth');

    //Data Panitia
    Route::resource('datapanitia', DataPanitiaController::class)->middleware('auth');
    Route::post('/datapanitia/update', 'DataPanitiaController@update');
    Route::get('/datapanitia/delete/{id}', [DataPanitiaController::class, 'delete'])->middleware('auth');

    //Soal
    Route::resource('soals', SoalController::class)->except([
        'show'
    ]);
    Route::get('/soal/delete/{id}', [SoalController::class, 'delete'])->middleware('auth');

    //Gambar
    Route::resource('gambars', GambarController::class)->except([
        'show'
    ]);
    Route::get('/gambar/delete/{id}', [GambarController::class, 'delete'])->middleware('auth');

    //Ujian
    Route::resource('ujians', UjianController::class);
        Route::post('/ujian/update/{id}', [UjianController::class, 'update'])->middleware('auth');
        Route::get('/ujian/delete/{id}', [UjianController::class, 'delete'])->middleware('auth');
        Route::get('/ujians/result/{score}/{user_id}/{ujian_id}', [UjianController::class, 'result'])->name('ujians.result');
        Route::get('/ujian/start/{id}', [UjianController::class, 'start'])->name('ujians.start');
        Route::get('ujians/student/{id}', [UjianController::class, 'student'])->name('ujians.student');
        Route::put('ujians/assign/{id}', [UjianController::class, 'assign'])->name('ujians.assign');
        Route::get('/ujians/review/{user_id}/{ujian_id}', [UjianController::class, 'review'])->name('ujians.review');

    //Permission
    Route::resource('permissions', PermissionController::class);

    //roles
    Route::resource('roles', RoleController::class);

    //users
    Route::resource('users', UserController::class);
});