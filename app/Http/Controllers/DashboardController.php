<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategorias = Categoria::count();
        $totalProductos = Producto::count();

        $ultimosProductos = Producto::with('categoria')
                                    ->latest()
                                    ->take(5)
                                    ->get();

        return view('dashboard', compact(
            'totalCategorias',
            'totalProductos',
            'ultimosProductos'
        ));
        $productos = Producto::where('estado', 1)
        ->whereNotNull('imagen')
        ->get();

    return view('dashboard', compact('productos'));
    }
}