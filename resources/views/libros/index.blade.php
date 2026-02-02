@extends('layout')
@section('title', 'Listado de libros')
@section('contenido')

<div class="container pt-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Género</th>
                <th scope="col">Año</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($libros as $libro)       
                <tr>
                    <th>
                        <a href="{{ route('libro.edit', $libro->id) }}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="{{ route('libro.show', $libro->id) }}" class="btn btn-outline-warning"><i class="bi bi-search"></i></a>
                        <a href="{{ route('libro.destroy.view', $libro->id) }}" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
                    </th>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $cods_genero[$libro->genero] }}</td>
                    <td>{{ $libro->anho }}</td>
                </tr>
            @endforeach

            {{ $libros->links() }}
        </tbody>
    </table>

    <a class="btn btn-outline-primary" href="{{ route('libro.create') }}"><i class="bi bi-plus-circle"></i> Nuevo Libro</a>
</div>

@endsection