<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;

Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('dashboard', dashboardController::class);
//Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



Route::get('/', function () {
    return view('welcome');
});

