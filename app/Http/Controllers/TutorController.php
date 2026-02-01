<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Tutor;
    use App\Models\Modulo;
    use App\Models\Horario;
    use Illuminate\Support\Facades\Auth;

    class TutorController extends Controller {
        public function index() {
            $tutores = Tutor::orderBy('apellidos')->paginate(10);
            return view('tutores.index', [
                'tutores' => $tutores,
                'anios_antiguedad' => Tutor::$anios_antiguedad
            ]);
        }

        public function create(Request $request) {
            $data = ['exito' => ''];

            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'apellidos' => 'required|string|max:100',
                    'email' => 'required|email|unique:personas,email',
                    'antiguedad' => 'required|in:2018,2019,2020,2021,2022,2023,2024,2025',
                ]);

                $tutor = new Tutor();
                $tutor->nombre = $request->input('nombre');
                $tutor->apellidos = $request->input('apellidos');
                $tutor->email = $request->input('email');
                $tutor->tipo = 'P';
                $tutor->es_tutor = 1;
                $tutor->antiguedad = $request->input('antiguedad');
                
                $tutor->usuario_alta = Auth::user()->name ?? 'Sistema';
                $tutor->ip_alta = $request->ip();
                $tutor->fecha_sis_alta = now();
                
                $tutor->save();

                return redirect()->route('tutor.index')
                    ->with('exito', 'Tutor creado correctamente');
            }

            $tutor = new Tutor();
            return view('tutores.create', [
                'datos' => $data,
                'tutor' => $tutor,
                'anios_antiguedad' => Tutor::$anios_antiguedad,
                'disabled' => '',
                'oper' => 'create'
            ]);
        }

        public function show(string $id) {
            $tutor = Tutor::with('modulos')->findOrFail($id);
            
            return view('tutores.create', [
                'tutor' => $tutor,
                'datos' => ['exito' => ''],
                'anios_antiguedad' => Tutor::$anios_antiguedad,
                'disabled' => 'disabled',
                'oper' => 'show'
            ]);
        }

        public function horario(string $id) {
            $tutor = Tutor::with(['horarios.modulo', 'horarios.aula'])->findOrFail($id);
            $horarios = $tutor->horarios;
            
            return view('tutores.horario', [
                'tutor' => $tutor,
                'horarios' => $horarios
            ]);
        }

        public function edit(Request $request, string $id = '') {
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'apellidos' => 'required|string|max:100',
                    'email' => 'required|email|unique:personas,email,' . $request->input('id'),
                    'antiguedad' => 'required|in:2018,2019,2020,2021,2022,2023,2024,2025',
                ]);

                $tutor = Tutor::findOrFail($request->input('id'));
                $tutor->nombre = $request->input('nombre');
                $tutor->apellidos = $request->input('apellidos');
                $tutor->email = $request->input('email');
                $tutor->antiguedad = $request->input('antiguedad');
                
                $tutor->usuario_modi = Auth::user()->name ?? 'Sistema';
                $tutor->ip_modi = $request->ip();
                $tutor->fecha_modi = now();
                
                $tutor->save();

                return redirect()->route('tutor.index')
                    ->with('exito', 'Tutor actualizado correctamente');
            } else {
                $tutor = Tutor::findOrFail($id);
                
                return view('tutores.create', [
                    'tutor' => $tutor,
                    'datos' => ['exito' => ''],
                    'anios_antiguedad' => Tutor::$anios_antiguedad,
                    'disabled' => '',
                    'oper' => 'edit'
                ]);
            }
        }

        public function destroy(Request $request, string $id = '') {
            if ($request->isMethod('post')) {
                $tutor = Tutor::findOrFail($request->input('id'));
                // En lugar de eliminar, podríamos marcar como no tutor
                $tutor->es_tutor = 0;
                $tutor->save();
                
                return redirect()->route('tutor.index')
                    ->with('exito', 'Tutor desactivado correctamente');
            } else {
                $tutor = Tutor::findOrFail($id);
                
                return view('tutores.create', [
                    'tutor' => $tutor,
                    'datos' => ['exito' => ''],
                    'anios_antiguedad' => Tutor::$anios_antiguedad,
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