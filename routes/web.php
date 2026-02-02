<?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\LibroController;
    use App\Http\Controllers\AulaController;
    use App\Http\Controllers\TutorController;
    use App\Http\Controllers\ProfesorController;
    use App\Http\Controllers\FamiliaProfesionalController;
    

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
            Route::post('/create', [LibroController::class, 'create'])->name('libro.store');
            Route::get('/show/{id}', [LibroController::class, 'show'])->name('libro.show');
            Route::get('/edit/{id}', [LibroController::class, 'edit'])->name('libro.edit');
            Route::post('/edit/{id?}', [LibroController::class, 'edit'])->name('libro.update');
            Route::get('/destroy/{id}', [LibroController::class, 'destroy'])->name('libro.destroy.view');
            Route::post('/destroy/{id?}', [LibroController::class, 'destroy'])->name('libro.destroy');
        });

        // Rutas para Aulas
        Route::prefix('aula')->group(function () {
            Route::get('/', [AulaController::class, 'index'])->name('aula.index');
            Route::get('/create', [AulaController::class, 'create'])->name('aula.create');
            Route::post('/create', [AulaController::class, 'create'])->name('aula.store');
            Route::get('/show/{id}', [AulaController::class, 'show'])->name('aula.show');
            Route::get('/edit/{id}', [AulaController::class, 'edit'])->name('aula.edit');
            Route::post('/edit/{id?}', [AulaController::class, 'edit'])->name('aula.update');
            Route::get('/destroy/{id}', [AulaController::class, 'destroy'])->name('aula.destroy.view');
            Route::post('/destroy/{id?}', [AulaController::class, 'destroy'])->name('aula.destroy');
        });

        // Rutas para Tutor
        Route::prefix('tutor')->group(function () {
            Route::get('/', [TutorController::class, 'index'])->name('tutor.index');
            Route::get('/create', [TutorController::class, 'create'])->name('tutor.create');
            Route::post('/create', [TutorController::class, 'create'])->name('tutor.store');
            Route::get('/show/{id}', [TutorController::class, 'show'])->name('tutor.show');
            Route::get('/horario/{id}', [TutorController::class, 'horario'])->name('tutor.horario');
            Route::get('/edit/{id}', [TutorController::class, 'edit'])->name('tutor.edit');
            Route::post('/edit/{id?}', [TutorController::class, 'edit'])->name('tutor.update');
            Route::get('/destroy/{id}', [TutorController::class, 'destroy'])->name('tutor.destroy.view');
            Route::post('/destroy/{id?}', [TutorController::class, 'destroy'])->name('tutor.destroy');
        });

        // Rutas para Profesor
        Route::prefix('profesor')->group(function () {
            Route::get('/', [ProfesorController::class, 'index'])->name('profesor.index');
            Route::get('/create', [ProfesorController::class, 'create'])->name('profesor.create');
            Route::post('/create', [ProfesorController::class, 'create'])->name('profesor.store');
            Route::get('/show/{id}', [ProfesorController::class, 'show'])->name('profesor.show');
            Route::get('/alumnos/{id}', [ProfesorController::class, 'alumnos'])->name('profesor.alumnos');
            Route::get('/horario/{id}', [ProfesorController::class, 'horario'])->name('profesor.horario');
            Route::get('/edit/{id}', [ProfesorController::class, 'edit'])->name('profesor.edit');
            Route::post('/edit/{id?}', [ProfesorController::class, 'edit'])->name('profesor.update');
            Route::get('/destroy/{id}', [ProfesorController::class, 'destroy'])->name('profesor.destroy.view');
            Route::post('/destroy/{id?}', [ProfesorController::class, 'destroy'])->name('profesor.destroy');
        });

        // Rutas para Familias Profesionales
        Route::prefix('familias_profesionales')->group(function () {
            Route::get('/', [FamiliaProfesionalController::class, 'index'])->name('familias_profesionales.index');
            Route::get('/create', [FamiliaProfesionalController::class, 'create'])->name('familias_profesionales.create');
            Route::post('/', [FamiliaProfesionalController::class, 'store'])->name('familias_profesionales.store');
            Route::get('/{id}', [FamiliaProfesionalController::class, 'show'])->name('familias_profesionales.show');
            Route::get('/{id}/edit', [FamiliaProfesionalController::class, 'edit'])->name('familias_profesionales.edit');
            Route::put('/{id}', [FamiliaProfesionalController::class, 'update'])->name('familias_profesionales.update');
            Route::patch('/{id}', [FamiliaProfesionalController::class, 'update'])->name('familias_profesionales.update');
            Route::delete('/{id}', [FamiliaProfesionalController::class, 'destroy'])->name('familias_profesionales.destroy');
        });
        
        Route::get('/admin', function () {
            return view('admin.dashboard');
        });
    });

    require __DIR__.'/auth.php';