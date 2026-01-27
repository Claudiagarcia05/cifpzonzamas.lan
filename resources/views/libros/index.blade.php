<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    </head>
    
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Gestión de Libros</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('libro.index') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('libro.create') }}">Alta Libro</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="container pt-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Acciones</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Género</th>
                        <th scope="col">Año</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($libros as $libro)                   
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <!-- Botón Modificar -->
                                <a class="btn btn-outline-success btn-sm me-2" href="{{ route('libro.edit', $libro->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Botón Consultar -->
                                <a class="btn btn-outline-warning btn-sm me-2" href="{{ route('libro.edit', $libro->id) }}">
                                    <i class="bi bi-search"></i>
                                </a>

                                <!-- Botón Eliminar -->
                                <a class="btn btn-outline-danger btn-sm" href="{{ route('libro.destroy', $libro->id) }}" onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                            <td>{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>
                                @if($libro->genero == 'NV')
                                    Novela
                                @elseif($libro->genero == 'SP')
                                    Suspense
                                @else
                                    {{ $libro->genero }}
                                @endif
                            </td>
                            <td>{{ $libro->anho }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-outline-primary" href="{{ route('libro.create') }}"> <i class="bi bi-plus-circle"></i> Nuevo Libro</a>
        </div>
    </body>
</html>