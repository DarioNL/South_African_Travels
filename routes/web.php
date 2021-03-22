<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:web,admin']], function () {

});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('/bestemmingen', [App\Http\Controllers\DestinationController::class, 'index'])->name('index');
    Route::get('/bestemmingen/toevoegen', [App\Http\Controllers\DestinationController::class, 'create'])->name('create');
    Route::post('/bestemmingen/toevoegen', [App\Http\Controllers\DestinationController::class, 'store'])->name('store');
    Route::get('/bestemmingen/{id}', [App\Http\Controllers\DestinationController::class, 'show'])->name('show');
    Route::get('/bestemmingen/{id}/bijwerken', [App\Http\Controllers\DestinationController::class, 'edit'])->name('update');
    Route::get('/bestemmingen/{id}/verwijderen', [App\Http\Controllers\DestinationController::class, 'destroy'])->name('destroy');
    Route::post('/bestemmingen/{id}/wijzigen', [App\Http\Controllers\DestinationController::class, 'update'])->name('update');
    Route::post('/bestemmingen/{id}/verwijderen', [App\Http\Controllers\DestinationController::class, 'postDestroy'])->name('postDestroy');
    Route::get('/accommodaties/{id}', [App\Http\Controllers\AccommodationController::class, 'show'])->name('show');
    Route::get('/accommodaties/{id}/bijwerken', [App\Http\Controllers\AccommodationController::class, 'edit'])->name('edit');
    Route::get('/accommodaties/{id}/verwijderen', [App\Http\Controllers\AccommodationController::class, 'destroy'])->name('destroy');
    Route::post('/accommodaties/{id}/wijzigen', [App\Http\Controllers\AccommodationController::class, 'update'])->name('update');
    Route::post('/accommodaties/{id}/verwijderen', [App\Http\Controllers\AccommodationController::class, 'postDestroy'])->name('postDestroy');
});
