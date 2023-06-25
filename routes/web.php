<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisSoalController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\DataPanitiaController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\GambarController;

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


//Jenis Soal
Route::resource('jenis', JenisSoalController::class)->middleware('auth');
Route::post('/jenis/update', 'JenisSoalController@update');
Route::get('/jenis/delete/{id}', [JenisSoalController::class, 'delete'])->middleware('auth');


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

//Gambar
Route::resource('gambars', GambarController::class)->except([
    'show'
]);