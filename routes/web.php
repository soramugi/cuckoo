<?php

use App\Http\Controllers\ReminderController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\Route;

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

Route::get('setup', [SetupController::class, 'create'])->name('setup.create');
Route::post('setup', [SetupController::class, 'store'])->name('setup.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [TopController::class, 'index'])->name('top.index');

    Route::resource('reminders', ReminderController::class);
});
