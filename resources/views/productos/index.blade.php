@extends('layouts.app')

@section('title', 'Productos')

@section('content')

<h1>Productos</h1>

<a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">
    Nuevo Producto
</a>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->nombre }}</td>
            <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->categoria->nombre ?? '' }}</td>
            <td>
                <span class="badge bg-{{ $producto->estado ? 'success' : 'secondary' }}">
                    {{ $producto->estado ? 'Activo' : 'Inactivo' }}
                </span>
            </td>
            <td>
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection