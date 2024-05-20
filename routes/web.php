<?php

use App\Http\Controllers\CalledController;
use Illuminate\Support\Facades\Route;


Route::get('/chamados', [CalledController::class, 'index']);
Route::get('/chamados/criar', [CalledController::class, 'create']);
Route::post('/chamados/salvar', [CalledController::class, 'store']);
Route::get('/chamados/{id}', [CalledController::class, 'show'])->name('calleds.show');

