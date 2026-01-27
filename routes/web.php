<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DatosController;
    use App\Http\Controllers\LibroController;

    // Ruta básic: URL base (/) que devuelve la vista welcome
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
    Route::get('/libro/alta', [LibroController::class, 'create'])->name('libro.create');
    Route::post('/libro/alta', [LibroController::class, 'create'])->name('libro.create.store');

    Route::get('/libro/modi/{id}', [LibroController::class, 'edit'])->name('libro.edit');
    Route::put('/libro/modi/{id}', [LibroController::class, 'update'])->name('libro.update');

    Route::get('/libro/ver/{id}', [LibroController::class, 'ver'])->name('libro.ver');

    Route::get('/libro/delete/{id}', [LibroController::class, 'destroy'])->name('libro.destroy');