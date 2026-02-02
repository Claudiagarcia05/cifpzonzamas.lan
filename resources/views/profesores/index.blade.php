@extends('layout')
@section('title', 'Listado de profesores')
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
                <th scope="col">Tutor</th>
                <th scope="col">Curso</th>
                <th scope="col">Alumnos</th>
                <th scope="col">Horario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profesores as $profesor)
                <tr>
                    <td>
                        <a href="{{ route('profesor.show', $profesor->id) }}" class="btn btn-outline-warning"><i class="bi bi-search"></i></a>
                        <a href="{{ route('profesor.edit', $profesor->id) }}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="{{ route('profesor.destroy.view', $profesor->id) }}" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
                    </td>
                    <td>{{ $profesor->nombre }}</td>
                    <td>{{ $profesor->apellidos }}</td>
                    <td>{{ $profesor->email }}</td>
                    <td>
                        @if($profesor->es_tutor)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        @if($profesor->es_tutor && $profesor->curso_tutor_id && isset($cursos[$profesor->curso_tutor_id]))
                            {{ $cursos[$profesor->curso_tutor_id]->nombre_grado }}
                            {{ $cursos[$profesor->curso_tutor_id]->curso_numero }}
                            {{ $cursos[$profesor->curso_tutor_id]->letra }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($profesor->es_tutor && $profesor->curso_tutor_id)
                            <a href="{{ route('profesor.alumnos', $profesor->id) }}" 
                               class="btn btn-outline-info">
                                <i class="bi bi-people"></i>
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profesor.horario', $profesor->id) }}" class="btn btn-outline-info"><i class="bi bi-calendar-week"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $profesores->links() }}

    <div class="mt-3">
        <a class="btn btn-outline-primary" href="{{ route('profesor.create') }}">
            <i class="bi bi-person-plus"></i> Nuevo Profesor
        </a>
    </div>

</div>

@endsection