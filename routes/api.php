<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::post('/links', [LinkController::class, 'store']);
Route::middleware('cors')->group(function () {
    Route::post('/link', 'LinkController@create');
    // inne trasy
});