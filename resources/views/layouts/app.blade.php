<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema')</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Mi Sistema</a>

        <div>
            <a class="nav-link text-white d-inline" href="{{ route('categorias.index') }}">Categorías</a>
            <a class="nav-link text-white d-inline" href="{{ route('productos.index') }}">Productos</a>
            <a class="nav-link text-white d-inline" href="{{ route('dashboard.index') }}">Dashboard</a>
        </div>
    </div>
</nav>

<!-- Contenido -->
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>