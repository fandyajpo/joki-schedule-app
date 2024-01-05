<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JadwalController;

Route::get('/', [Controller::class, 'JadwalPage']);
Route::post('/jadwal', [JadwalController::class, 'Create']);
Route::patch('/jadwal/{id}', [JadwalController::class, 'Update']);
Route::delete('/jadwal/{id}', [JadwalController::class, 'Delete']);
