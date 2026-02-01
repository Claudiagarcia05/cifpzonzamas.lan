@extends('layout')
@section('title', 'Listado de tutores')
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
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Antigüedad</th>
                <th scope="col">Horario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tutores as $tutor)
                <tr>
                    <td>
                        <a href="{{ route('tutor.show', $tutor->id) }}" class="btn btn-outline-warning"><i class="bi bi-search"></i></a>
                        <a href="{{ route('tutor.edit', $tutor->id) }}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="{{ route('tutor.destroy.view', $tutor->id) }}" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
                    </td>
                    <td>{{ $tutor->nombre }}</td>
                    <td>{{ $tutor->apellidos }}</td>
                    <td>{{ $tutor->email }}</td>
                    <td>{{ $tutor->antiguedad ?? 'No especificado' }}</td>
                    <td>
                        <a href="{{ route('tutor.horario', $tutor->id) }}" class="btn btn-outline-info"><i class="bi bi-calendar-week"></i></a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tutores->links() }}

    <div class="mt-3">
        <a class="btn btn-outline-primary" href="{{ route('tutor.create') }}"><i class="bi bi-person-plus"></i> Nuevo Tutor</a>
    </div>

</div>

@endsection