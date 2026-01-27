<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h1 class="text-3xl font-bold mb-4">{{ config('app.name', 'CIFP Zonzamas') }}</h1>
                                <p class="mb-4">Bienvenido al sistema Laravel del CIFP Zonzamas</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <h2 class="text-xl font-semibold mb-2">Proyecto Laravel</h2>
                                        <p>Sistema funcionando correctamente</p>
                                    </div>
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h2 class="text-xl font-semibold mb-2">Configuración</h2>
                                        <p>Apache + Laravel configurados</p>
                                    </div>
                                    <div class="bg-yellow-50 p-4 rounded-lg">
                                        <h2 class="text-xl font-semibold mb-2">Accesos</h2>
                                        <p>Disponible en: cifpzonzamas.lan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>