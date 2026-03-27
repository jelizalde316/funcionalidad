@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">

    <!-- Categorías -->
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Categorías</h5>
                <p class="card-text fs-4">{{ $totalCategorias }}</p>
                <a href="{{ route('categorias.index') }}" class="btn btn-light">
                    Administrar Categorías
                </a>
            </div>
        </div>
    </div>

    <!-- Productos -->
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Productos</h5>
                <p class="card-text fs-4">{{ $totalProductos }}</p>
                <a href="{{ route('productos.index') }}" class="btn btn-light">
                    Administrar Productos
                </a>
            </div>
        </div>
    </div>

</div>

<hr>

<div class="row">

    <!-- Últimos productos -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Últimos Productos
            </div>
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ultimosProductos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                            <td>{{ $producto->categoria->nombre ?? '' }}</td>
                            <td>
                                <span class="badge bg-{{ $producto->estado ? 'success' : 'secondary' }}">
                                    {{ $producto->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

@endsection