<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class DatosController extends Controller {
        public function procesar(Request $request) {
            $validated = $request->validate([
                'nombre' => 'required|string|min:2',
                'edad' => 'required|integer|min:1|max:120'
            ]);

            $mensaje = "Hola, {$validated['nombre']}. Tienes {$validated['edad']} años.";
            
            session()->flash('resultado', $mensaje);
            
            return redirect('/procesar-datos');
        }
    }