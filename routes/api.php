<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerTeamController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/teams', [TeamController::class, 'index']);
Route::get('/players', [PlayerController::class, 'index']);

Route::post('save-teams-players', [PlayerTeamController::class, 'updateOrder']);

