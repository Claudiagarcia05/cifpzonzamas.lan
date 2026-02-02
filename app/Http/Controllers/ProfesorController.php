<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Profesor;
    use App\Models\Curso;
    use App\Models\Horario;
    use App\Models\Persona;
    use App\Models\Matricula;
    use Illuminate\Support\Facades\Auth;

    class ProfesorController extends Controller {
        public function index() {
            $profesores = Profesor::orderBy('apellidos')->paginate(10);
            $cursos = Curso::all()->keyBy('id');
            
            return view('profesores.index', [
                'profesores' => $profesores,
                'cursos' => $cursos,
                'anios_antiguedad' => Profesor::$anios_antiguedad
            ]);
        }

        public function create(Request $request) {
            $data = ['exito' => ''];
            $cursos = Curso::orderBy('nombre_grado')->orderBy('curso_numero')->get();

            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'apellidos' => 'required|string|max:100',
                    'email' => 'required|email|unique:personas,email',
                    'es_tutor' => 'sometimes|boolean',
                    'curso_tutor_id' => 'nullable|exists:cursos,id',
                    'antiguedad' => 'required|in:2018,2019,2020,2021,2022,2023,2024,2025',
                ]);

                $profesor = new Profesor();
                $profesor->nombre = $request->input('nombre');
                $profesor->apellidos = $request->input('apellidos');
                $profesor->email = $request->input('email');
                $profesor->tipo = 'P';
                $profesor->es_tutor = $request->boolean('es_tutor');
                $profesor->curso_tutor_id = $request->boolean('es_tutor') ? $request->input('curso_tutor_id') : null;
                $profesor->antiguedad = $request->input('antiguedad');
                
                $profesor->usuario_alta = Auth::user()->name ?? 'Sistema';
                $profesor->ip_alta = $request->ip();
                $profesor->fecha_sis_alta = now();
                
                $profesor->save();

                return redirect()->route('profesor.index')
                    ->with('exito', 'Profesor creado correctamente');
            }

            $profesor = new Profesor();
            return view('profesores.create', [
                'datos' => $data,
                'profesor' => $profesor,
                'cursos' => $cursos,
                'anios_antiguedad' => Profesor::$anios_antiguedad,
                'disabled' => '',
                'oper' => 'create'
            ]);
        }

        public function show(string $id) {
            $profesor = Profesor::with('cursoTutor')->findOrFail($id);
            $cursos = Curso::orderBy('nombre_grado')->orderBy('curso_numero')->get();
            
            return view('profesores.create', [
                'profesor' => $profesor,
                'datos' => ['exito' => ''],
                'cursos' => $cursos,
                'anios_antiguedad' => Profesor::$anios_antiguedad,
                'disabled' => 'disabled',
                'oper' => 'show'
            ]);
        }

        public function alumnos(string $id) {
            $profesor = Profesor::with('cursoTutor')->findOrFail($id);
            
            if (!$profesor->es_tutor || !$profesor->curso_tutor_id) {
                return view('profesores.alumnos', [
                    'profesor' => $profesor,
                    'alumnos' => collect(),
                    'curso' => null
                ]);
            }
            
            $curso = Curso::find($profesor->curso_tutor_id);
            
            if (!$curso) {
                return view('profesores.alumnos', [
                    'profesor' => $profesor,
                    'alumnos' => collect(),
                    'curso' => null
                ]);
            }
            
            $alumnos = Persona::where('tipo', 'A')
                ->whereHas('matriculas', function($query) use ($profesor) {
                    $query->where('id_curso', $profesor->curso_tutor_id)
                        ->where('anio_escolar', date('Y'));
                })
                ->orderBy('apellidos')
                ->orderBy('nombre')
                ->get();
            
            return view('profesores.alumnos', [
                'profesor' => $profesor,
                'alumnos' => $alumnos,
                'curso' => $curso
            ]);
        }

        public function horario(string $id) {
            $profesor = Profesor::findOrFail($id);
            
            $horarios = Horario::where('id_profesor', $id)
                ->with(['modulo', 'aula'])
                ->orderByRaw("FIELD(dia, 'L', 'M', 'X', 'J', 'V')")
                ->orderBy('hora_inicio')
                ->get();
            
            return view('tutores.horario', [
                'tutor' => $profesor,
                'horarios' => $horarios
            ]);
        }

        public function edit(Request $request, string $id = '') {
            $cursos = Curso::orderBy('nombre_grado')->orderBy('curso_numero')->get();
            
            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'nombre' => 'required|string|max:100',
                    'apellidos' => 'required|string|max:100',
                    'email' => 'required|email|unique:personas,email,' . $request->input('id'),
                    'es_tutor' => 'sometimes|boolean',
                    'curso_tutor_id' => 'nullable|exists:cursos,id',
                    'antiguedad' => 'required|in:2018,2019,2020,2021,2022,2023,2024,2025',
                ]);

                $profesor = Profesor::findOrFail($request->input('id'));
                $profesor->nombre = $request->input('nombre');
                $profesor->apellidos = $request->input('apellidos');
                $profesor->email = $request->input('email');
                $profesor->es_tutor = $request->boolean('es_tutor');
                $profesor->curso_tutor_id = $request->boolean('es_tutor') ? $request->input('curso_tutor_id') : null;
                $profesor->antiguedad = $request->input('antiguedad');
                
                $profesor->usuario_modi = Auth::user()->name ?? 'Sistema';
                $profesor->ip_modi = $request->ip();
                $profesor->fecha_modi = now();
                
                $profesor->save();

                return redirect()->route('profesor.index')
                    ->with('exito', 'Profesor actualizado correctamente');
            } else {
                $profesor = Profesor::findOrFail($id);
                
                return view('profesores.create', [
                    'profesor' => $profesor,
                    'datos' => ['exito' => ''],
                    'cursos' => $cursos,
                    'anios_antiguedad' => Profesor::$anios_antiguedad,
                    'disabled' => '',
                    'oper' => 'edit'
                ]);
            }
        }

        public function destroy(Request $request, string $id = '') {
            if ($request->isMethod('post')) {
                $profesor = Profesor::findOrFail($request->input('id'));
                $profesor->tipo = 'I';
                $profesor->save();
                
                return redirect()->route('profesor.index')
                    ->with('exito', 'Profesor desactivado correctamente');
            } else {
                $profesor = Profesor::findOrFail($id);
                $cursos = Curso::all();
                
                return view('profesores.create', [
                    'profesor' => $profesor,
                    'datos' => ['exito' => ''],
                    'cursos' => $cursos,
                    'anios_antiguedad' => Profesor::$anios_antiguedad,
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