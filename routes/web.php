<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisSoalController;
use App\Http\Controllers\LowonganController;

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
