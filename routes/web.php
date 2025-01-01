<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('app');
// })->where('vue', '[\/\w\.-]*')->name('home')->middleware(['install', 'guest']);
