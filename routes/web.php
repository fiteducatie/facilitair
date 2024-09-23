<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\Boards;
use App\Livewire\Pages\BoardsDetail;
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


Route::get('/', [PinController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/pin/favorites', [PinController::class, 'favorites'])->name('pin.favorites');
    Route::get('/pins/my/', [PinController::class, 'myPins'])->name('pin.userpins');
    Route::get('/pin', [PinController::class, 'index'])->name('pin.index');
    Route::get('/boards', Boards::class)->name('boards');
    Route::get('/boards/{board}', BoardsDetail::class)->name('board.show');

});

Route::get('pin/{pin}', [PinController::class, 'show'])->name('pin.show');



require __DIR__.'/auth.php';
