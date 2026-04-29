<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen font-sans antialiased">
    <div class="max-w-5xl mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Mis Tareas</h1>
                <p class="text-gray-500 mt-1">Gestiona tus pendientes de forma eficiente.</p>
            </div>
            <a href="{{ route('tareas.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg hover:shadow-indigo-500/25 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Nueva Tarea
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-900 shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 rounded-3xl overflow-hidden">
            @if($tareas->isEmpty())
                <div class="p-20 text-center">
                    <div class="bg-gray-50 dark:bg-gray-800 w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">No hay tareas</h3>
                    <p class="text-gray-500 mt-2">Empieza creando una nueva tarea para organizar tu día.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Estado</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Tarea</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Prioridad</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Vence</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($tareas as $tarea)
                                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-800/30 transition-colors group">
                                    <td class="px-6 py-5">
                                        <form action="{{ route('tareas.toggle', $tarea->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                title="{{ $tarea->completada ? 'Marcar como pendiente' : 'Marcar como completada' }}"
                                                class="w-8 h-8 rounded-full border-2 flex items-center justify-center font-bold text-base transition-all
                                                    {{ $tarea->completada
                                                        ? 'bg-emerald-500 border-emerald-500 text-white shadow-lg shadow-emerald-500/30'
                                                        : 'border-gray-300 dark:border-gray-600 text-transparent hover:border-emerald-400 hover:text-emerald-400' }}">
                                                ✓
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="font-bold {{ $tarea->completada ? 'line-through text-gray-400' : 'text-gray-900 dark:text-gray-100' }}">
                                            {{ $tarea->titulo }}
                                        </div>
                                        @if($tarea->descripcion)
                                            <p class="text-sm text-gray-500 mt-0.5 line-clamp-1">{{ $tarea->descripcion }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-sm">
                                        @if($tarea->prioridad == 'alta')
                                            <span class="px-3 py-1 bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 rounded-full text-xs font-black uppercase tracking-widest">Alta</span>
                                        @elseif($tarea->prioridad == 'media')
                                            <span class="px-3 py-1 bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 rounded-full text-xs font-black uppercase tracking-widest">Media</span>
                                        @else
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full text-xs font-black uppercase tracking-widest">Baja</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-gray-500">
                                        {{ $tarea->fecha_limite ? $tarea->fecha_limite->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('tareas.edit', $tarea->id) }}" class="p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/30">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 dark:hover:text-rose-400 transition-colors rounded-lg hover:bg-rose-50 dark:hover:bg-rose-900/30">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
