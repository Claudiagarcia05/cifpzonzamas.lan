<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de Datos</title>
    </head>
    <body>
        <h1>Formulario Datos</h1>
        
        @if($errors->any())
            <div style="background: #f8d7da; padding: 10px; margin: 10px 0; color: #721c24;">
                <h3>Errores:</h3>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('resultado'))
            <div style="background: #d4edda; padding: 10px; margin: 10px 0; color: #155724;">
                <h3>Resultado:</h3>
                <p>{{ session('resultado') }}</p>
            </div>
        @endif
        
        <form action="/procesar-datos" method="POST">
            @csrf
            
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" 
                value="{{ old('nombre') }}"><br><br>
            
            <label for="edad">Edad:</label><br>
            <input type="number" id="edad" name="edad" 
                value="{{ old('edad') }}"><br><br>
            
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>