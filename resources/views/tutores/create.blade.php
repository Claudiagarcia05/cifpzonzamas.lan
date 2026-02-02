@extends('layout')
@section('title', 
    $oper == 'create' ? 'Crear tutor' : 
    ($oper == 'edit' ? 'Editar tutor' : 
    ($oper == 'show' ? 'Ver tutor' : 'Eliminar tutor')))
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
            Crear Nuevo Tutor
        @elseif($oper == 'edit')
            Editar Tutor
        @elseif($oper == 'show')
            Ver Tutor
        @elseif($oper == 'destroy')
            Eliminar Tutor
        @endif
    </h2>

    <form method="POST" 
          action="{{ 
            $oper == 'create' ? route('tutor.create') : 
            ($oper == 'edit' ? route('tutor.edit', $tutor->id) : 
            ($oper == 'destroy' ? route('tutor.destroy', $tutor->id) : '#')) 
          }}">
        
        @csrf
        
        @if($oper == 'edit' || $oper == 'destroy')
            <input type="hidden" name="id" value="{{ $tutor->id }}">
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="idnombre" class="form-label">Nombre *</label>
                <input {{ $disabled }} 
                       value="{{ old('nombre', $tutor->nombre ?? '') }}" 
                       type="text" 
                       name="nombre" 
                       class="form-control" 
                       id="idnombre">
            </div>
            
            <div class="col-md-6">
                <label for="idapellidos" class="form-label">Apellidos *</label>
                <input {{ $disabled }} 
                       value="{{ old('apellidos', $tutor->apellidos ?? '') }}" 
                       type="text" 
                       name="apellidos" 
                       class="form-control" 
                       id="idapellidos">
            </div>
        </div>

        <div class="mb-3">
            <label for="idemail" class="form-label">Email *</label>
            <input {{ $disabled }} 
                   value="{{ old('email', $tutor->email ?? '') }}" 
                   type="email" 
                   name="email" 
                   class="form-control" 
                   id="idemail"
                   placeholder="ejemplo@instituto.com">
        </div>

        <div class="mb-3">
            <label class="form-label">Antigüedad (Año de inicio) *</label>
            <div>
                @foreach ($anios_antiguedad as $anio => $texto)
                    <div class="form-check form-check-inline">
                        <input {{ $disabled }} 
                               class="form-check-input" 
                               type="radio" 
                               name="antiguedad" 
                               id="antiguedad{{ $anio }}" 
                               value="{{ $anio }}"
                               {{ (old('antiguedad', $tutor->antiguedad ?? '') == $anio) ? 'checked' : '' }}>
                        <label class="form-check-label" for="antiguedad{{ $anio }}">
                            {{ $texto }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4 text-righ">
            <div class="mb-3">
                @if($oper == 'create' || $oper == 'edit')
                    <button type="submit" class="btn btn-outline-primary">{{ $oper == 'create' ? 'Crear Tutor' : 'Actualizar Tutor' }}</button>
                @endif
                
            @if($oper == 'destroy')
                <button type="submit" class="btn btn-outline-danger">Confirmar Eliminación</button>
            @endif
            </div>
            
            <div>
                <a href="{{ route('tutor.index') }}" class="btn btn-outline-info"><i class="bi bi-arrow-left"></i></a>
            </div>
        </div>
    </form>
</div>

@endsection