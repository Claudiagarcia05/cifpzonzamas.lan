<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar Libro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('libro.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('libro.create') }}">Alta Libro</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>

        <!-- ELIMINAR LIBRO -->
        <div class="container pt-4">
            @if($datos['exito'])
            <div class="alert alert-success">
                <h4 class="alert-heading">¡Eliminado correctamente!</h4>
                <p>{{ $datos['exito'] }}</p>
                <hr>
                <h5>Detalles del libro eliminado:</h5>
                <ul class="mb-0">
                    <li><strong>Título:</strong> {{ $libro->titulo }}</li>
                    <li><strong>Autor:</strong> {{ $libro->autor }}</li>
                    <li><strong>Género:</strong> {{ $libro->genero }}</li>
                    <li><strong>Año:</strong> {{ $libro->anho }}</li>
                    <li><strong>Descripción:</strong> {{ $libro->descripcion }}</li>
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Libro eliminado</h5>
                    <p class="card-text">El libro ha sido eliminado de la base de datos correctamente.</p>
                </div>
            </div>

            <div class="mt-3">
                <a class="btn btn-primary" href="{{ route('libro.index') }}">Volver a la lista</a>
                <a class="btn btn-success" href="{{ route('libro.create') }}">Crear nuevo libro</a>
            </div>
        </div>
    </body>
</html>