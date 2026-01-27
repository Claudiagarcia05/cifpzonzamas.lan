<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Libro;

    class LibroController extends Controller {
        public function index() {
            $libros = Libro::all();

            return view('libros.index',['libros' => $libros]);
        }

        public function create(Request $request) {
            $data = ['exito' =>''];

            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'titulo'      => 'required|string|max:255',
                    'autor'       => 'required|string|max:255',
                    'anho'        => 'required|integer',
                    'genero'      => 'required|string|max:255',
                    'descripcion' => 'required|string|max:1255',
                ]);

                $libro = new Libro();
                $libro->titulo      = $request->input('titulo');
                $libro->autor       = $request->input('autor');
                $libro->anho        = $request->input('anho');
                $libro->genero      = $request->input('genero');
                $libro->descripcion = $request->input('descripcion');
                $libro->save();   
                
                $data['exito'] = 'Operación realizada correctamente';
            }

            return view('libros.create',['datos' => $data]);
        }

        public function edit(string $id) {
            $libro = Libro::findOrFail($id);

            return view('libros.modi', ['libro' => $libro, 'datos' => ['exito' => '']]);
        }

        public function update(Request $request, string $id) {
            $data = ['exito' => ''];
            
            $validated = $request->validate([
                'titulo'      => 'required|string|max:255',
                'autor'       => 'required|string|max:255',
                'anho'        => 'required|integer',
                'genero'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1255',
            ]);

            $libro = Libro::findOrFail($id);
            $libro->titulo      = $request->input('titulo');
            $libro->autor       = $request->input('autor');
            $libro->anho        = $request->input('anho');
            $libro->genero      = $request->input('genero');
            $libro->descripcion = $request->input('descripcion');
            $libro->save();   
            
            $data['exito'] = 'Libro modificado correctamente';
            
            return view('libros.modi', ['libro' => $libro, 'datos' => $data]);
        }

        public function ver(string $id) {
            $libro = Libro::findOrFail($id);
            return view('libros.consul', ['libro' => $libro]);
        }

        public function destroy(string $id) {
            $libro = Libro::findOrFail($id);
            
            $datosLibro = $libro->toArray();
            
            $libro->delete();
            
            return view('libros.delete', [
                'datos' => ['exito' => 'Libro eliminado correctamente'],
                'libro' => (object) $datosLibro
            ]);
        }
    }