<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\TailwickController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\JobController;
use App\Http\Controllers\Web\ProspetController;
use App\Http\Controllers\Web\UserController;
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

Route::get('/access-denied', function () {
    return view('denied.show');
})->name('access-denied');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])->group(function () {
    Route::resource('customers', ClientController::class);
    Route::get("/", [RouteController::class, 'index'])->name('dashboard');
    Route::get("{any}", [RouteController::class, 'routes']);
});


