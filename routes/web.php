<?php

use App\Http\Controllers\CalledController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Auth;

Route::get('/', function () {
  return redirect(('/chamados'));
})->middleware(Auth::class);


Route::controller(CalledController::class)->group(function () {
  Route::get('/chamados', 'index')->middleware(Auth::class);
  Route::get('/chamados/criar', 'create')->middleware(Auth::class);
  Route::post('/chamados/salvar', 'store')->middleware(Auth::class);
  Route::post('/chamados/atualizar', 'update')->middleware(Auth::class);
  Route::get('/chamados/{id}', 'show')->name('calleds.show')->middleware(Auth::class);
});

Route::controller((LoginController::class))->group(function () {
  Route::get('/login', 'index')->name('login');
  Route::post('/login', 'store');
  Route::get('/logout', 'destroy')->name('logout');
});

Route::get('/cadastrar', [RegisterController::class, 'index']);
Route::post('/cadastrar', [RegisterController::class, 'store']); 

Route::get('', [NotFoundController::class, 'index']); 


