<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Aula;
    use Illuminate\Support\Facades\Auth;

    class AulaController extends Controller {
        public function index() {
            $aulas = Aula::orderBy('numero')->paginate(10);
            return view('aulas.index', [
                'aulas' => $aulas,
                'letras' => Aula::$letras,
                'plantas' => Aula::$plantas
            ]);
        }

        public function create(Request $request) {
            $data = ['exito' => ''];

            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'letra'  => 'required|in:A,B,C,D',
                    'numero' => 'required|integer|unique:aulas,numero',
                    'planta' => 'required|in:P,S,T',
                ]);

                $aula = new Aula();
                $aula->nombre = $request->input('nombre');
                $aula->letra  = $request->input('letra');
                $aula->numero = $request->input('numero');
                $aula->planta = $request->input('planta');
                
                $aula->usuario_alta = Auth::user()->name ?? 'Sistema';
                $aula->ip_alta = $request->ip();
                $aula->fecha_sis_alta = now();
                
                $aula->save();

                return redirect()->route('aula.index')
                    ->with('exito', 'Aula creada correctamente');
            }

            $aula = new Aula();
            return view('aulas.create', [
                'datos' => $data,
                'aula' => $aula,
                'letras' => Aula::$letras,
                'plantas' => Aula::$plantas,
                'disabled' => '',
                'oper' => 'create'
            ]);
        }

        public function show(string $id) {
            $aula = Aula::findOrFail($id);
            
            return view('aulas.create', [
                'aula' => $aula,
                'datos' => ['exito' => ''],
                'letras' => Aula::$letras,
                'plantas' => Aula::$plantas,
                'disabled' => 'disabled',
                'oper' => 'show'
            ]);
        }

        public function edit(Request $request, string $id = '') {
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'letra'  => 'required|in:A,B,C,D',
                    'numero' => 'required|integer|unique:aulas,numero,' . $request->input('id'),
                    'planta' => 'required|in:P,S,T',
                ]);

                $aula = Aula::findOrFail($request->input('id'));
                $aula->nombre = $request->input('nombre');
                $aula->letra  = $request->input('letra');
                $aula->numero = $request->input('numero');
                $aula->planta = $request->input('planta');
                
                $aula->usuario_modi = Auth::user()->name ?? 'Sistema';
                $aula->ip_modi = $request->ip();
                $aula->fecha_modi = now();
                
                $aula->save();

                return redirect()->route('aula.index')
                    ->with('exito', 'Aula actualizada correctamente');
            } else {
                $aula = Aula::findOrFail($id);
                
                return view('aulas.create', [
                    'aula' => $aula,
                    'datos' => ['exito' => ''],
                    'letras' => Aula::$letras,
                    'plantas' => Aula::$plantas,
                    'disabled' => '',
                    'oper' => 'edit'
                ]);
            }
        }

        public function destroy(Request $request, string $id = '') {
            if ($request->isMethod('post')) {
                $aula = Aula::findOrFail($request->input('id'));
                $aula->delete();
                
                return redirect()->route('aula.index')
                    ->with('exito', 'Aula eliminada correctamente');
            } else {
                $aula = Aula::findOrFail($id);
                
                return view('aulas.create', [
                    'aula' => $aula,
                    'datos' => ['exito' => ''],
                    'letras' => Aula::$letras,
                    'plantas' => Aula::$plantas,
                    'disabled' => 'disabled',
                    'oper' => 'destroy'
                ]);
            }
        }

        public function store(Request $request) {

        }

        public function update(Request $request, string $id) {
            
        }
    }