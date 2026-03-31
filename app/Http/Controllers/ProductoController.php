<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
       // Producto::create($data);
        //dd($request->all());
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:productos,sku',
            'estado' => 'required|boolean',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')
                         ->with('success', 'Producto creado correctamente');
        
        $data = $request->all();
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:productos,sku,' . $producto->id,
            'estado' => 'required|boolean',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:50048',
        ]);

        $producto->update($request->all());

// ✅ Si sube nueva imagen
    if ($request->hasFile('imagen')) {

        // 🔥 Eliminar imagen anterior (PRO)
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        // 💾 Guardar nueva imagen
        $data['imagen'] = $request->file('imagen')->store('productos', 'public');
    } else {
        // 🚫 No tocar imagen si no se sube nueva
        $data = $request->all();
        unset($data['imagen']);
    }

    // ✅ Actualizar producto
    $producto->update($data);


        return redirect()->route('productos.index')
                         ->with('success', 'Producto actualizado');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
                         ->with('success', 'Producto eliminado');
    }
}