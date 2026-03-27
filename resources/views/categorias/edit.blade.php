@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Editar Categoría</h4>
    </div>

    <div class="card-body">

        <!-- Errores -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input 
                    type="text" 
                    name="nombre" 
                    class="form-control"
                    value="{{ old('nombre', $categoria->nombre) }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="1" {{ $categoria->estado ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$categoria->estado ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

@endsection