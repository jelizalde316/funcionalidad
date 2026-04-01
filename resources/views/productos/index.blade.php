@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <th>Imagen</th>
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


                <form action="{{ route('productos.toggle', $producto->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-sm {{ $producto->estado ? 'btn-success' : 'btn-secondary' }}">
                        {{ $producto->estado ? 'Activo' : 'Inactivo' }}
                    </button>
                </form>


            </td>
            <td>
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>

<!--uso básico -->

                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button 
                        type="submit" 
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Estás seguro de eliminar este producto?')"
                    >
                        Eliminar
                    </button>
                </form>
<!--uso avanzado -->

                <button onclick="confirmDelete({{ $producto->id }})" class="btn btn-danger btn-sm">
                    Eliminar
                </button>

                <form id="deleteForm-{{ $producto->id }}" action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

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


<script>
function mostrarImagen(ruta) {
    document.getElementById('imagenModalSrc').src = ruta;
}
</script>


<script>
function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm-' + id).submit();
        }
    });
}
</script>
@endsection