<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Añadir Libro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Añade Bootstrap Icons -->
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
                    <a class="nav-link active" aria-current="page" href="{{ route('libro.index') }}">Inicio</a>
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

        <div class="container pt-4">
            <ul>
            @foreach ($errors->all() as $error)
                <li  class="text-danger">{{ $error }}</li>
            @endforeach
            </ul>

            @if($datos['exito'])
            <p class="alert alert-success"> {{ $datos['exito'] }} </p>
            @endif

            <!-- ALTA LIBRO -->
            <form action="/libro/alta" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="idtitulo" class="@error('titulo') text-danger @enderror form-label">Título</label>
                    <input value="{{ old('titulo') }}" type="text" name="titulo" class="@error('titulo') is-invalid @enderror form-control" id="idtitulo" aria-describedby="libroHelp">
                    @error('titulo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div id="libroHelp" class="form-text">El título del libro.</div>
                </div>

                <div class="mb-3">
                    <label for="idautor" class="@error('autor') text-danger @enderror form-label">Autor</label>
                    <input  value="{{ old('autor') }}" type="text"  name="autor" class="@error('autor') is-invalid @enderror form-control" id="idautor" aria-describedby="autorHelp">
                    @error('autor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div id="autorHelp" class="form-text">El autor del libro.</div>
                </div>

                <div class="mb-3">
                    <label for="idanho" class="@error('anho') text-danger @enderror form-label">Año publicación</label>
                    <select class="@error('anho') is-invalid @enderror form-select" aria-label="2026" id="idanho" name="anho" aria-describedby="anhoHelp">
                        <option></option>
                        <option value="1813">1813</option>
                        <option value="1949">1949</option>
                        <option value="1967">1967</option>
                        <option value="2001">2001</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                    </select>
                    @error('anho')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div id="anhoHelp" class="form-text">El año en que se publicó el libro.</div>
                </div>

                <div class="mb-3">
                    <label for="idgenero" class="@error('genero') text-danger @enderror form-label">Género</label>
                    <select class="@error('genero') is-invalid @enderror form-select" aria-label="Horror" id="idgenero" name="genero" aria-describedby="generoHelp">
                        <option></option>
                        <option value="NV">Novela</option>
                        <option value="SP">Suspense</option>
                        <option value="DT">Distopia</option>
                    </select>
                    @error('genero')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div id="generoHelp" class="form-text">El género literario.</div>
                </div>

                <div class="mb-3">
                    <label for="iddescripcion" class="@error('descripcion') text-danger @enderror form-label">Descripción</label>
                    <textarea class="@error('descripcion') is-invalid @enderror form-control" name="descripcion" id="iddescripcion" rows="3">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <!-- Botón Enviar/Guardar -->
                    <button type="submit" class="btn btn-outline-primary btn-sm me-2">
                        <i class="bi bi-check-circle"></i>
                    </button>
                    
                    <!-- Botón Volver -->
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('libro.index') }}">
                        <i class="bi bi-arrow-bar-left"></i>
                    </a>
                </div>
            </form>
        </div>
    </body>
</html>