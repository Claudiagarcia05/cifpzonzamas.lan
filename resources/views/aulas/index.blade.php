@extends('layout')
@section('title', 'Listado de aulas')
@section('contenido')

<div class="container pt-4">
    @if(session('exito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('exito') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">Acciones</th>
                <th scope="col">Nombre</th>
                <th scope="col">Letra</th>
                <th scope="col">Número</th>
                <th scope="col">Planta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aulas as $aula)
                <tr>
                    <td>
                        <a href="{{ route('aula.show', $aula->id) }}" class="btn btn-outline-warning">
                            <i class="bi bi-search"></i>
                        </a>
                        <a href="{{ route('aula.edit', $aula->id) }}" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="{{ route('aula.destroy.view', $aula->id) }}" class="btn btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                    <td>{{ $aula->nombre }}</td>
                    <td>{{ $letras[$aula->letra] ?? $aula->letra }}</td>
                    <td>{{ $aula->numero }}</td>
                    <td>{{ $plantas[$aula->planta] ?? $aula->planta }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $aulas->links() }}

    <div class="mt-3">
        <a class="btn btn-outline-primary" href="{{ route('aula.create') }}">
            <i class="bi bi-plus-circle"></i> Nueva Aula
        </a>
    </div>

</div>

@endsection