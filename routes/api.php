<?php

use App\Http\Controllers\QueueController;

use Illuminate\Support\Facades\Route;

Route::get('/logs', [QueueController::class, 'show']);
Route::get('/logs/clear', [QueueController::class, 'clear']);
Route::get('/start', [QueueController::class,'start']);
Route::get('/total', [QueueController::class,'total']);
