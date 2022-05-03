<?php

use App\Http\Controllers\MessageController;

use Illuminate\Support\Facades\Route;

Route::get('/app/logs', [MessageController::class, 'show']);
Route::get('/app/logs/clear', [MessageController::class, 'clear']);
Route::get('/app/start', [MessageController::class,'start']);
Route::get('/app/total', [MessageController::class,'total']);
