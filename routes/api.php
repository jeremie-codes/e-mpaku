<?php

use App\Http\Controllers\Admin\MembreController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [RouteController::class, 'loginApi']);

Route::get('users', [RouteController::class, 'all']);

Route::middleware('auth:sanctum')->group(function () {
    // Store Membre Api
    Route::post('create', [MembreController::class, 'storeApi']);

    // Route::post('/logout', [AuthController::class, 'logout']);
});
