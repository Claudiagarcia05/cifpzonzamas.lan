<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DatosController;
    use App\Http\Controllers\LibroController;
    use App\Http\Controllers\UsuarioController;

    // Ruta basica
    Route::get('/', function () {
        
        return view('welcome');
    });


    // Ruta con parámetros
    Route::get('/usuario/{id}', function ($id) {
        
        return "El ID del usuario es: $id";
    });


    // Ruta con nombre
    Route::get('/contacto', function () {
        
        return "Página de contacto";
    })->name('contacto');


    // Agrupación de rutas
    Route::prefix('admin')->group(function () {
        Route::get('/usuarios', function () {
            
            return "Gestión de usuarios";
        });
        
        Route::get('/configuracion', function () {
            
            return "Configuración del sistema";
        });
    });

    Route::get('/login', function () {
        
        return "Página de login";
    })->name('login');


    // Ruta DatosController
    Route::get('/procesar-datos', function() {
        
        return view('formulario');
    });

    Route::post('/procesar-datos', [DatosController::class, 'procesar']);


    // Ruta LibroController
    Route::get('/libro', [LibroController::class, 'index'])->name('libro.index');
    Route::get('/libro/create', [LibroController::class, 'create'])->name('libro.create');
    Route::post('/libro/create', [LibroController::class, 'create'])->name('libro.create');

    Route::get('/libro/edit/{i}', [LibroController::class, 'edit'])->name('libro.edit');
    Route::post('/libro/edit', [LibroController::class, 'edit'])->name('libro.edit');

    Route::get('/libro/show/{i}', [LibroController::class, 'show'])->name('libro.show');

    Route::get('/libro/destroy/{i}', [LibroController::class, 'destroy'])->name('libro.destroy');
    Route::post('/libro/destroy', [LibroController::class, 'destroy'])->name('libro.destroy');


    // NO SE VE
    Route::get('/usuario', [UsuarioController::class, 'index']);

    Route::get('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');