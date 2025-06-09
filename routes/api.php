<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LayananApiController;
use App\Http\Controllers\Api\ArtikelController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Layanan API Routes
Route::prefix('v1')->group(function () {
    Route::get('/layanan', [LayananApiController::class, 'index']);
    Route::get('/layanan/{id}', [LayananApiController::class, 'show']);
});

Route::get('/artikel', [ArtikelController::class, 'index']); 