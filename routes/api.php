<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerTeamController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/teams', [TeamController::class, 'index']);
Route::get('/players', [PlayerController::class, 'index']);

Route::post('save-player-team', [PlayerTeamController::class, 'store']);
Route::post('remove-player-team', [PlayerTeamController::class, 'remove']);


