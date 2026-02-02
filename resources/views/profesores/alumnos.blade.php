@extends('layout')
@section('title', 'Alumnos del tutor')
@section('contenido')

<div class="container pt-4">
    
    <h2 class="mb-4">Alumnos de {{ $profesor->nombre }} {{ $profesor->apellidos }}</h2>
    
    @if($curso)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-people"></i> 
                Curso: {{ $curso->nombre_grado }} {{ $curso->curso_numero }}{{ $curso->letra }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tutor:</strong> {{ $profesor->nombre }} {{ $profesor->apellidos }}
                    </div>
                    <div class="col-md-6">
                        <strong>Total de alumnos:</strong> {{ $alumnos->count() }}
                    </div>
                </div>
            </div>
        </div>
        
        @if($alumnos->count() > 0)
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Matriculado en</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $index => $alumno)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellidos }}</td>
                            <td>{{ $alumno->email }}</td>
                            <td>
                                @php
                                    $matricula = $alumno->matriculas()
                                        ->where('id_curso', $curso->id)
                                        ->where('anio_escolar', date('Y'))
                                        ->first();
                                @endphp
                                {{ $matricula->anio_escolar ?? date('Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i>
                No hay alumnos matriculados en este curso para el año actual.
            </div>
        @endif
    @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i>
            Este profesor no es tutor de ningún curso o el curso no existe.
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('profesor.index') }}" class="btn btn-outline-info">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>

</div>

@endsection