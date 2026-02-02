@extends('layout')
@section('title', 
    $oper == 'create' ? 'Crear profesor' : 
    ($oper == 'edit' ? 'Editar profesor' : 
    ($oper == 'show' ? 'Ver profesor' : 'Eliminar profesor')))
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
            Crear Nuevo Profesor
        @elseif($oper == 'edit')
            Editar Profesor
        @elseif($oper == 'show')
            Ver Profesor
        @elseif($oper == 'destroy')
            Eliminar Profesor
        @endif
    </h2>

    <form method="POST" 
          action="{{ 
            $oper == 'create' ? route('profesor.create') : 
            ($oper == 'edit' ? route('profesor.edit', $profesor->id) : 
            ($oper == 'destroy' ? route('profesor.destroy', $profesor->id) : '#')) 
          }}"
          id="profesorForm">
        
        @csrf
        
        @if($oper == 'edit' || $oper == 'destroy')
            <input type="hidden" name="id" value="{{ $profesor->id }}">
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="idnombre" class="form-label">Nombre *</label>
                <input {{ $disabled }} 
                       value="{{ old('nombre', $profesor->nombre ?? '') }}" 
                       type="text" 
                       name="nombre" 
                       class="form-control" 
                       id="idnombre">
            </div>
            
            <div class="col-md-6">
                <label for="idapellidos" class="form-label">Apellidos *</label>
                <input {{ $disabled }} 
                       value="{{ old('apellidos', $profesor->apellidos ?? '') }}" 
                       type="text" 
                       name="apellidos" 
                       class="form-control" 
                       id="idapellidos">
            </div>
        </div>

        <div class="mb-3">
            <label for="idemail" class="form-label">Email *</label>
            <input {{ $disabled }} 
                   value="{{ old('email', $profesor->email ?? '') }}" 
                   type="email" 
                   name="email" 
                   class="form-control" 
                   id="idemail"
                   placeholder="ejemplo@instituto.com">
        </div>

        <div class="mb-3">
            <label class="form-label">Antigüedad (Año de inicio) *</label>
            <div class="mt-2">
                @foreach ($anios_antiguedad as $anio)
                    <div class="form-check form-check-inline">
                        <input {{ $disabled }} 
                               class="form-check-input" 
                               type="radio" 
                               name="antiguedad" 
                               id="antiguedad{{ $anio }}" 
                               value="{{ $anio }}"
                               {{ (old('antiguedad', $profesor->antiguedad ?? '') == $anio) ? 'checked' : '' }}>
                        <label class="form-check-label" for="antiguedad{{ $anio }}">
                            {{ $anio }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" 
                       type="checkbox" 
                       name="es_tutor" 
                       id="es_tutor" 
                       value="1"
                       {{ (old('es_tutor', $profesor->es_tutor ?? false)) ? 'checked' : '' }}
                       {{ $disabled }}
                       onchange="toggleCursoSelect()">
                <label class="form-check-label" for="es_tutor">
                    ¿Es tutor de algún curso?
                </label>
            </div>
        </div>

        <div class="mb-3" id="curso_tutor_container" 
             style="display: {{ (old('es_tutor', $profesor->es_tutor ?? false)) ? 'block' : 'none' }};">
            <label for="curso_tutor_id" class="form-label">Curso asignado como tutor *</label>
            <select {{ $disabled }} 
                    class="form-select" 
                    id="curso_tutor_id" 
                    name="curso_tutor_id">
                <option value="">Seleccione un curso</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}"
                            {{ (old('curso_tutor_id', $profesor->curso_tutor_id ?? '') == $curso->id) ? 'selected' : '' }}>
                        {{ $curso->nombre_grado }} {{ $curso->curso_numero }}{{ $curso->letra }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mt-4">
            <div class="mb-3">
                @if($oper == 'create' || $oper == 'edit')
                    <button type="submit" class="btn btn-outline-primary">
                        {{ $oper == 'create' ? 'Crear Profesor' : 'Actualizar Profesor' }}
                    </button>
                @endif
                
                @if($oper == 'destroy')
                    <button type="submit" class="btn btn-outline-danger">
                        Confirmar Eliminación
                    </button>
                @endif
            </div>
            
            <div>
                <a href="{{ route('profesor.index') }}" class="btn btn-outline-info">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>
    </form>

</div>

@push('scripts')
<script>
function toggleCursoSelect() {
    const esTutorCheckbox = document.getElementById('es_tutor');
    const cursoContainer = document.getElementById('curso_tutor_container');
    const cursoSelect = document.getElementById('curso_tutor_id');
    
    if (esTutorCheckbox.checked) {
        cursoContainer.style.display = 'block';
        cursoSelect.required = true;
    } else {
        cursoContainer.style.display = 'none';
        cursoSelect.required = false;
        cursoSelect.value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleCursoSelect();
});
</script>
@endpush

@endsection