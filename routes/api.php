<?php

use App\Http\Controllers\QueueController;

use Illuminate\Support\Facades\Route;

Route::get('/app/logs', [QueueController::class, 'show']);
Route::get('/app/logs/clear', [QueueController::class, 'clear']);
Route::get('/app/start', [QueueController::class,'start']);
Route::get('/app/total', [QueueController::class,'total']);
