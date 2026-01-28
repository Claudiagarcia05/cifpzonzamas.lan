<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Libro;

    class LibroController extends Controller {
        public function index() {
            $libros = Libro::paginate(10);

            return view('libros.index',['libros' => $libros,'cods_genero' => Libro::$cods_genero]);
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
                
                $libro->titulo      = $request->input('titulo');;
                $libro->autor       = $request->input('autor');;
                $libro->anho        = $request->input('anho');;
                $libro->genero      = $request->input('genero');;
                $libro->descripcion = $request->input('descripcion');

                $libro->save();   
                
                $data['exito'] = 'Operación realiza correctamente';
            }

            $libro = new Libro();

            return view('libros.create',['datos' => $data,'libro' => $libro,'cods_genero' => Libro::$cods_genero, 'disabled' => '','oper' => 'create']);
        }

        public function store(Request $request) {
        
        }

        public function show(string $id) {
            $datos = ['exito' => ''];
            $libro = Libro::find($id);

            return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'show']);
        }

        public function edit(Request $request,string $id='') {
            if ($request->isMethod('post')) {   

                $validated = $request->validate([
                    'titulo'      => 'required|string|max:255',
                    'autor'       => 'required|string|max:255',
                    'anho'        => 'required|integer',
                    'genero'      => 'required|string|max:255',
                    'descripcion' => 'required|string|max:1255',
                ]);

                $libro = Libro::find($request->input('id'));

                $libro->titulo      = $request->input('titulo');;
                $libro->autor       = $request->input('autor');;
                $libro->anho        = $request->input('anho');;
                $libro->genero      = $request->input('genero');;
                $libro->descripcion = $request->input('descripcion');

                $libro->save();   
                
                $datos['exito'] = 'Operación realiza correctamente';
                
                $disabled = 'disabled';
            } else {
                $datos = ['exito' => ''];
                $libro = Libro::find($id);
                $disabled = '';
            }

            return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled,'oper' => 'edit']);
        }

        public function update(Request $request, string $id) {

        }

        public function destroy(Request $request,string $id='') {
        if ($request->isMethod('post')) {   
                $libro = Libro::find($request->input('id'));

                $libro->delete();
                
                return redirect()->route('libro.index');
                
            } else {
                $datos = ['exito' => ''];
                $libro = Libro::find($id);
                $disabled = 'disabled';

                return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled,'oper' => 'destroy']);
            }
        }
    }