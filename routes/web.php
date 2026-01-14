<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DatosController;

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