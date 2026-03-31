@extends('layouts.app')

@section('title', 'Detalle Producto')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Detalle del Producto</h4>
    </div>

    <div class="card-body">

        <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
        <p><strong>Precio:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
        <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
        <p><strong>Stock:</strong> {{ $producto->stock }}</p>
        <p><strong>SKU:</strong> {{ $producto->sku }}</p>
        <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? '' }}</p>

        <p><strong>Estado:</strong>
            <span class="badge bg-{{ $producto->estado ? 'success' : 'secondary' }}">
                {{ $producto->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>

        @if($producto->imagen)
            <p><strong>Imagen:</strong></p>
            <img src="{{ asset('storage/' . $producto->imagen) }}" width="150">
        @endif

        <a href="{{ route('productos.index') }}" class="btn btn-secondary mt-3">Volver</a>

    </div>
</div>

@endsection