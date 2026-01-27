<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consultar Libro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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

        <!-- CONSULTAR LIBRO (SOLO LECTURA) -->
        <div class="container pt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-book"></i> Información del Libro
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Mostrar datos como texto en lugar de inputs -->
                    <div class="row mb-3">
                        <div class="col-md-2 fw-bold">Título:</div>
                        <div class="col-md-10">{{ $libro->titulo }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2 fw-bold">Autor:</div>
                        <div class="col-md-10">{{ $libro->autor }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2 fw-bold">Año de publicación:</div>
                        <div class="col-md-10">{{ $libro->anho }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2 fw-bold">Género:</div>
                        <div class="col-md-10">
                            @php
                                $generos = [
                                    'NV' => 'Novela',
                                    'SP' => 'Suspense',
                                    'DT' => 'Distopía'
                                ];
                            @endphp
                            {{ $generos[$libro->genero] ?? $libro->genero }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2 fw-bold">Descripción:</div>
                        <div class="col-md-10">
                            @if($libro->descripcion)
                                <div class="border p-3 bg-light rounded">
                                    {{ $libro->descripcion }}
                                </div>
                            @else
                                <span class="text-muted fst-italic">Sin descripción</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2 fw-bold">Fecha de creación:</div>
                        <div class="col-md-10">
                            {{ $libro->created_at->format('d/m/Y H:i:s') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2 fw-bold">Última actualización:</div>
                        <div class="col-md-10">
                            {{ $libro->updated_at->format('d/m/Y H:i:s') }}
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <!-- Botón Volver -->
                        <a class="btn btn-outline-secondary" href="{{ route('libro.index') }}">
                            <i class="bi bi-arrow-left"></i> Volver al listado
                        </a>
                        
                        <!-- Opcional: Botón para editar si lo necesitas -->
                        <a class="btn btn-primary" href="{{ route('libro.edit', $libro->id) }}">
                            <i class="bi bi-pencil"></i> Editar Libro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>