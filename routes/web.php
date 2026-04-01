<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;

Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);

// ✅ Ruta toggle (CORRECTA)
Route::patch('productos/{producto}/toggle', [ProductoController::class, 'toggleEstado'])
    ->name('productos.toggle');



Route::resource('dashboard', dashboardController::class);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');    

Route::get('/', function () {
    return view('welcome');


Route::prefix('productos')->group(function () {



});

});

