<?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\LibroController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        // Rutas para libros (solo accesibles por usuarios autenticados)
        Route::prefix('libro')->group(function () {
            Route::get('/', [LibroController::class, 'index'])->name('libro.index');
            Route::get('/create', [LibroController::class, 'create'])->name('libro.create');
            Route::post('/', [LibroController::class, 'store'])->name('libro.store'); // Cambiado
            Route::get('/{libro}/edit', [LibroController::class, 'edit'])->name('libro.edit');
            Route::put('/{libro}', [LibroController::class, 'update'])->name('libro.update'); // Cambiado
            Route::get('/{libro}', [LibroController::class, 'show'])->name('libro.show');
            Route::delete('/{libro}', [LibroController::class, 'destroy'])->name('libro.destroy'); // Cambiado
        });
        
        Route::get('/admin', function () {
            return view('admin.dashboard');
        });
    });

    require __DIR__.'/auth.php';