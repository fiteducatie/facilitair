<?php

use App\Http\Controllers\PinController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    $pins = \App\Models\Pin::all();
    return view('welcome', [
        'pins' => $pins
    ]);
})->name('welcome');

Route::get('pin/{pin}', [PinController::class, 'show'])->name('pin.show');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/pin', [PinController::class, 'index'])->name('pin.index');
    Route::get('/pin/create', [PinController::class, 'create'])->name('pin.create');
    Route::post('/pin', [PinController::class, 'store'])->name('pin.store');
    Route::get('/pin/{pin}/edit', [PinController::class, 'edit'])->name('pin.edit');
    Route::patch('/pin/{pin}', [PinController::class, 'update'])->name('pin.update');
    Route::delete('/pin/{pin}', [PinController::class, 'destroy'])->name('pin.destroy');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
