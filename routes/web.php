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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('administrator')->group(function () {
    Route::prefix('master-option')->group(function () {
        Route::get('list', [App\Http\Controllers\MasterOptionController::class, 'index'])
             ->name('masteroptionlist');
        Route::post('table', [App\Http\Controllers\MasterOptionController::class, 'dt'])
             ->name('masteroptiontable');
        Route::post('select-tipe', [App\Http\Controllers\MasterOptionController::class, 'selectTipe'])
             ->name('masteroptionselecttipe');
        Route::post('save', [App\Http\Controllers\MasterOptionController::class, 'store'])
            ->name('masteroptionsave');
        Route::post('delete', [App\Http\Controllers\MasterOptionController::class, 'destroy'])
            ->name('masteroptiondelete');
    });
});

Route::get('/test', [App\Http\Controllers\HomeController::class, 'index'])->name('homie');
