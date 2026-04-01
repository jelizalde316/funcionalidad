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
                            <th>Imagen</th>
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
                                <img 
                                    src="{{ asset('storage/' . $producto->imagen) }}" 
                                    width="80"
                                    style="cursor:pointer"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#imagenModal"
                                    onclick="mostrarImagen('{{ asset('storage/' . $producto->imagen) }}')"
                                >
                            </td>
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

@isset($productos)
<div class="modal fade" id="imagenModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Imagen del producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <img id="imagenModalSrc" src="" class="img-fluid">
            </div>

        </div>
    </div>
</div>

<form action="{{ route('productos.toggle', $producto->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <button class="btn btn-sm {{ $producto->estado ? 'btn-success' : 'btn-secondary' }}">
        {{ $producto->estado ? 'Activo' : 'Inactivo' }}
    </button>
</form>

<!--inicio Carusel -->
@if($productos->count())

<div id="carouselProductos" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">

    <div class="carousel-inner">

        @foreach($productos as $key => $producto)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                <!-- Imagen fondo -->
                <div class="banner-image"
                    style="background-image: url('{{ asset('storage/' . $producto->imagen) }}');">

                    <!-- Overlay oscuro -->
                    <div class="overlay"></div>

                    <!-- Contenido -->
                    <div class="banner-content text-center text-white">

                        <h1 class="fw-bold display-4">
                            {{ $producto->nombre }}
                        </h1>

                        <p class="fs-4 mb-3">
                            ${{ number_format($producto->precio, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary btn-lg">
                            Ver producto
                        </a>

                    </div>
                </div>

            </div>
        @endforeach

    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

@endif

<!--Fin Carusel -->

<script>
function mostrarImagen(ruta) {
    document.getElementById('imagenModalSrc').src = ruta;
}
</script>



    {{-- tu carousel --}}
@endisset

@endsection

