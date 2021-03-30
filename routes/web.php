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

Route::get('/reizen', [App\Http\Controllers\TravelsController::class, 'index'])->name('index');
Route::get('/reizen/{id}', [App\Http\Controllers\TravelsController::class, 'show'])->name('show');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reizen/{id}/boeken', [App\Http\Controllers\TravelsController::class, 'notLoggedIn'])->name('notLoggedIn');

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/reizen/{id}/boeken', [App\Http\Controllers\TravelsController::class, 'book'])->name('book');
    Route::post('/reizen/{id}/boeken', [App\Http\Controllers\TravelsController::class, 'postBook'])->name('postBook');
    Route::get('/boekingen', [App\Http\Controllers\BookingsController::class, 'index'])->name('index');
});
Route::group(['middleware' => ['auth:web,admin']], function () {
    Route::get('/boekingen', [App\Http\Controllers\BookingsController::class, 'index'])->name('index');
    Route::get('/boekingen/{id}', [App\Http\Controllers\BookingsController::class, 'show'])->name('show');
    Route::get('/boekingen/{id}/annuleer', [App\Http\Controllers\BookingsController::class, 'cancel'])->name('cancel');
    Route::post('/boekingen/{id}/annuleer', [App\Http\Controllers\BookingsController::class, 'postCancel'])->name('postCancel');

});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('/reizen/{id}', [App\Http\Controllers\TravelsController::class, 'create'])->name('create');
    Route::get('/bestemmingen/{id}/bijwerken', [App\Http\Controllers\DestinationController::class, 'edit'])->name('update');
    Route::post('/reizen/toevoegen', [App\Http\Controllers\TravelsController::class, 'store'])->name('store');
    Route::get('/reizen/{id}/verwijderen', [App\Http\Controllers\TravelsController::class, 'destroy'])->name('destroy');
    Route::post('/reizen/{id}/bijwerken', [App\Http\Controllers\TravelsController::class, 'update'])->name('update');
    Route::get('/reizen/{id}/bijwerken', [App\Http\Controllers\TravelsController::class, 'edit'])->name('edit');
    Route::post('/reizen/{id}/verwijderen', [App\Http\Controllers\TravelsController::class, 'postDestroy'])->name('postDestroy');
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
    Route::get('/boekingen/{id}/betaald', [App\Http\Controllers\BookingsController::class, 'isPayed'])->name('isPayed');
    Route::post('/boekingen/{id}/betaald', [App\Http\Controllers\BookingsController::class, 'postIsPayed'])->name('postIsPayed');
    Route::get('/boekingen/{id}/betaald/annuleer', [App\Http\Controllers\BookingsController::class, 'isNotPayed'])->name('isNotPayed');
    Route::post('/boekingen/{id}/betaald/annuleer', [App\Http\Controllers\BookingsController::class, 'postIsNotPayed'])->name('postIsNotPayed');
});
