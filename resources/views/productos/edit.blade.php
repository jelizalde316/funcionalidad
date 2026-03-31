@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Editar Producto</h4>
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input 
                    type="text" 
                    name="nombre" 
                    class="form-control"
                    value="{{ old('nombre', $producto->nombre) }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input 
                    type="number" 
                    name="precio" 
                    class="form-control"
                    value="{{ old('precio', $producto->precio) }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input 
                    type="number" 
                    name="stock" 
                    class="form-control"
                    value="{{ old('stock', $producto->stock) }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">SKU</label>
                <input 
                    type="text" 
                    name="sku" 
                    class="form-control"
                    value="{{ old('sku', $producto->sku) }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="imagen" class="form-control">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" width="100">
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="categoria_id" class="form-select" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="1" {{ $producto->estado ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$producto->estado ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

@endsection