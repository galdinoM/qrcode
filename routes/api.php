<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
});
Route::middleware('auth:sanctum')->get('/data', [DataController::class, 'index']);
