<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiTokenController;
use App\Http\Controllers\Api\ApiGenerationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [ApiAuthController::class, 'user']); // Example protected route
Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']); // Example protected route
Route::post('/tokens', [ApiTokenController::class, 'store'])
    ->middleware('auth:sanctum')
    ->name('api.tokens.store');
Route::middleware('auth:sanctum')->get('/get-token', [ApiTokenController::class, 'getToken'])
    ->name('api.tokens.get');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/log-generation', [ApiGenerationController::class, 'logGeneration']);
});