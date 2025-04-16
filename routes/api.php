<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DokumentController;
use App\Http\Controllers\Auth\LoginController;

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

Route::post('login', [LoginController::class, 'login']);

  Route::middleware(['api.key'])->group(function () {
//   Route::middleware(['api.key', 'auth:api'])->group(function () {
    Route::get('dokument', [DokumentController::class, 'index']);
    Route::get('dokument/{id}', [DokumentController::class, 'show']);
    Route::post('dokument', [DokumentController::class, 'store']);
    Route::put('dokument/{id}', [DokumentController::class, 'update']);
    Route::delete('dokument/{id}', [DokumentController::class, 'destroy']);
});

