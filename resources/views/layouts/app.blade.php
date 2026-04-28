<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Tareas')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen font-sans antialiased">
    <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-black uppercase tracking-tighter text-indigo-600">Mis Tareas</h1>
            <nav>
                <a href="{{ route('tareas.index') }}" class="text-sm font-bold hover:text-indigo-500 transition-colors">Inicio</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="py-10 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} - Sistema de Gestión de Tareas
    </footer>
</body>
</html>