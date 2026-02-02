<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\FamiliaProfesional;

    class FamiliaProfesionalController extends Controller {
        public function index() {
            $familias = FamiliaProfesional::paginate(10);

            return view('familias_profesionales.index', ['familias' => $familias]);
        }

        public function create() {
            $familia = new FamiliaProfesional();
            
            return view('familias_profesionales.create', [
                'familia' => $familia, 
                'disabled' => '', 
                'oper' => 'create'
            ]);
        }

        public function store(Request $request) {
            $validated = $request->validate([
                'nombre'      => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'imagen'      => 'nullable|string|max:255',
            ]);

            $familia = new FamiliaProfesional();
            $familia->nombre      = $request->input('nombre');
            $familia->descripcion = $request->input('descripcion');
            $familia->imagen      = $request->input('imagen');
            $familia->save();

            return redirect()->route('familias_profesionales.index')
                            ->with('success', 'Familia profesional creada correctamente.');
        }

        public function show(string $id) {
            $familia = FamiliaProfesional::findOrFail($id);

            return view('familias_profesionales.create', [
                'familia' => $familia, 
                'disabled' => 'disabled', 
                'oper' => 'show'
            ]);
        }

        public function edit(string $id) {
            $familia = FamiliaProfesional::findOrFail($id);

            return view('familias_profesionales.create', [
                'familia' => $familia, 
                'disabled' => '', 
                'oper' => 'edit'
            ]);
        }

        public function update(Request $request, string $id) {
            $validated = $request->validate([
                'nombre'      => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'imagen'      => 'nullable|string|max:255',
            ]);

            $familia = FamiliaProfesional::findOrFail($id);
            $familia->nombre      = $request->input('nombre');
            $familia->descripcion = $request->input('descripcion');
            $familia->imagen      = $request->input('imagen');
            $familia->save();

            return redirect()->route('familias_profesionales.index')
                            ->with('success', 'Familia profesional actualizada correctamente.');
        }

        public function destroy(Request $request, string $id) {
            $familia = FamiliaProfesional::findOrFail($id);
            $familia->delete();

            return redirect()->route('familias_profesionales.index')
                            ->with('success', 'Familia profesional eliminada correctamente.');
        }
    }