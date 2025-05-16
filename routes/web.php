<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\Admin\MembreController;
use App\Http\Controllers\Admin\PaiementController;
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
    Route::get("/", [RouteController::class, 'index'])->name('dashboard');
    Route::resource('members', MembreController::class);
    Route::resource('paiements', PaiementController::class);
    Route::get('/search-membre', [PaiementController::class, 'search'])->name('membre.search');
    Route::get('/admin/register', [RouteController::class, 'register'])->name('admin.register');
    Route::post('/admin/store', [RouteController::class, 'store'])->name('admin.store');
    Route::get("{any}", [RouteController::class, 'routes']);
});


