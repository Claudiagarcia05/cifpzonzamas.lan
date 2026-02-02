@extends('layout')
@section('title', 
    $oper == 'create' ? 'Crear aula' : 
    ($oper == 'edit' ? 'Editar aula' : 
    ($oper == 'show' ? 'Ver aula' : 'Eliminar aula')))
@section('contenido')

<div class="container pt-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($datos['exito']) && $datos['exito'])
        <div class="alert alert-success">
            {{ $datos['exito'] }}
        </div>
    @endif

    <h2 class="mb-4">
        @if($oper == 'create')
            Crear Nueva Aula
        @elseif($oper == 'edit')
            Editar Aula
        @elseif($oper == 'show')
            Ver Aula
        @elseif($oper == 'destroy')
            Eliminar Aula
        @endif
    </h2>

    <form method="POST" 
          action="{{ 
            $oper == 'create' ? route('aula.create') : 
            ($oper == 'edit' ? route('aula.edit', $aula->id) : 
            ($oper == 'destroy' ? route('aula.destroy', $aula->id) : '#')) 
          }}">
        
        @csrf
        
        @if($oper == 'edit' || $oper == 'destroy')
            <input type="hidden" name="id" value="{{ $aula->id }}">
        @endif

        <div class="mb-3">
            <label for="idnombre" class="form-label">Nombre del aula *</label>
            <input {{ $disabled }} 
                   value="{{ old('nombre', $aula->nombre ?? '') }}" 
                   type="text" 
                   name="nombre" 
                   class="form-control" 
                   id="idnombre"
                   placeholder="Ej: 1DAW, Ateka, Medusa">
        </div>

        <div class="mb-3">
            <label for="idletra" class="form-label">Letra del aula *</label>
            <select {{ $disabled }} 
                    class="form-select" 
                    id="idletra" 
                    name="letra">
                <option value="">Seleccione una opción</option>
                @foreach ($letras as $clave => $texto)
                    @php
                        $selected = (old('letra', $aula->letra ?? '') == $clave) ? 'selected' : '';
                    @endphp
                    <option value="{{ $clave }}" {{ $selected }}>
                        {{ $texto }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="idnumero" class="form-label">Número del aula *</label>
            <input {{ $disabled }} 
                   value="{{ old('numero', $aula->numero ?? '') }}" 
                   type="number" 
                   name="numero" 
                   class="form-control" 
                   id="idnumero"
                   placeholder="Número único">
        </div>

        <div class="mb-3">
            <label for="idplanta" class="form-label">Planta *</label>
            <select {{ $disabled }} 
                    class="form-select" 
                    id="idplanta" 
                    name="planta">
                <option value="">Seleccione una planta</option>
                @foreach ($plantas as $clave => $texto)
                    @php
                        $selected = (old('planta', $aula->planta ?? '') == $clave) ? 'selected' : '';
                    @endphp
                    <option value="{{ $clave }}" {{ $selected }}>
                        {{ $texto }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mt-4 text-righ">
            <div class="mb-3">
                @if($oper == 'create' || $oper == 'edit')
                    <button type="submit" class="btn btn-outline-primary">{{ $oper == 'create' ? 'Crear Aula' : 'Actualizar Aula' }}</button>
                @endif
                
                @if($oper == 'destroy')
                    <button type="submit" class="btn btn-outline-danger">Confirmar Eliminación</button>
                @endif
            </div>
            
            <div>
                <a href="{{ route('aula.index') }}" class="btn btn-outline-info"><i class="bi bi-arrow-left"></i></a>
            </div>
        </div>
    </form>
</div>

@endsection