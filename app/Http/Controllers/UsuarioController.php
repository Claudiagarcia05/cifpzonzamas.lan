<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Models\Usuario;

    class UsuarioController extends Controller {
        public function index() {
            return "Página principal de usuarios - Listado";
        }

        function show($id) {
            $url = route('usuario.show', ['id' => 5]);
            return "Hola listado 11" . $url;
        }

        function store(Request $request) {
            $usuario = new Usuario();
            $usuario->create(['nombre'=>'Andrés', 'email' => 'andres_calamaro@gmail.com']);
        }
    }