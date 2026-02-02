@extends('layout')
@section('title', 'Listado de Familias Profesionales')
@section('contenido')

<div class="container pt-4">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familias as $familia)       
                <tr>
                    <td>{{ $loop->iteration + (($familias->currentPage() - 1) * $familias->perPage()) }}</td>
                    <td>{{ $familia->nombre }}</td>
                    <td>
                        @if($familia->imagen)
                            <img src="{{ $familia->imagen }}" alt="{{ $familia->nombre }}" style="height: 50px;">
                        @else
                            No imagen
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('familias_profesionales.show', $familia->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-search"></i> Ver
                            </a>
                            <a href="{{ route('familias_profesionales.edit', $familia->id) }}" class="btn btn-success btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{ route('familias_profesionales.destroy', $familia->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('¿Está seguro de eliminar esta familia profesional?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $familias->links() }}

    <a class="btn btn-primary" href="{{ route('familias_profesionales.create') }}">
        <i class="bi bi-plus-circle"></i> Nueva Familia Profesional
    </a>

</div>

@endsection