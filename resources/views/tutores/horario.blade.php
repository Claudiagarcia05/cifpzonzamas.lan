@extends('layout')
@section('title', 'Horario del tutor')
@section('contenido')

<div class="container pt-4">
    
    <h2 class="mb-4">Horario de {{ $tutor->nombre }} {{ $tutor->apellidos }}</h2>
    
    <!-- Información del tutor (mismo que antes) -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <i class="bi bi-person-vcard"></i> Información del Tutor
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <strong>Email:</strong> {{ $tutor->email }}
                </div>
                <div class="col-md-4">
                    <strong>Antigüedad:</strong> {{ $tutor->antiguedad ?? 'No especificada' }}
                </div>
                <div class="col-md-4">
                    <strong>Módulos que imparte:</strong> {{ $tutor->modulos->count() }}
                </div>
            </div>
        </div>
    </div>

    @if($horarios->count() > 0)
        @php
            // Organizar horarios por día
            $dias = [
                'L' => ['nombre' => 'LUNES', 'horarios' => []],
                'M' => ['nombre' => 'MARTES', 'horarios' => []],
                'X' => ['nombre' => 'MIÉRCOLES', 'horarios' => []],
                'J' => ['nombre' => 'JUEVES', 'horarios' => []],
                'V' => ['nombre' => 'VIERNES', 'horarios' => []]
            ];
            
            foreach ($horarios as $horario) {
                if (isset($dias[$horario->dia])) {
                    $dias[$horario->dia]['horarios'][] = $horario;
                }
            }
            
            // Ordenar horarios por hora de inicio
            foreach ($dias as &$dia) {
                usort($dia['horarios'], function($a, $b) {
                    return strcmp($a->hora_inicio, $b->hora_inicio);
                });
            }
            
            // Horas fijas para mostrar
            $horasFijas = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];
        @endphp
        
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 12%">HORA</th>
                        @foreach ($dias as $dia)
                            <th>{{ $dia['nombre'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horasFijas as $hora)
                        <tr>
                            <td class="fw-bold bg-light">{{ $hora }}H</td>
                            
                            @foreach ($dias as $codigo => $dia)
                                @php
                                    $horarioEnEstaHora = null;
                                    foreach ($dia['horarios'] as $horario) {
                                        $horaInicio = substr($horario->hora_inicio, 0, 5);
                                        if ($horaInicio == $hora) {
                                            $horarioEnEstaHora = $horario;
                                            break;
                                        }
                                    }
                                @endphp
                                
                                <td style="min-height: 80px; vertical-align: middle;">
                                    @if ($horarioEnEstaHora)
                                        @php
                                            $horaFin = substr($horarioEnEstaHora->hora_fin, 0, 5);
                                            $duracion = (strtotime($horaFin) - strtotime($hora)) / 3600;
                                        @endphp
                                        
                                        <div class="p-1 rounded" 
                                             style="background-color: {{ $horarioEnEstaHora->modulo->color ?? '#6c757d' }}; color: white;">
                                            <strong>{{ $horarioEnEstaHora->modulo->siglas ?? 'N/A' }}</strong><br>
                                            <small>{{ $hora }}-{{ $horaFin }}</small>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    @else
        <div class="alert alert-warning">
            Este tutor no tiene horarios asignados.
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('tutor.index') }}" class="btn btn-outline-info"> <i class="bi bi-arrow-left"></i> Volver al listado de tutores</a>
        <a href="{{ route('profesor.index') }}" class="btn btn-outline-info"> <i class="bi bi-arrow-left"></i> Volver al listado de profesores</a>
    </div>

</div>

@endsection