<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Tarea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen font-sans antialiased">
    <div class="max-w-2xl mx-auto px-4 py-16">
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('tareas.index') }}" class="p-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-3xl font-extrabold tracking-tight">Crear Nueva Tarea</h1>
        </div>

        <div class="bg-white dark:bg-gray-900 shadow-2xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 rounded-3xl p-10">
            <form action="{{ route('tareas.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div>
                    <label for="titulo" class="block text-sm font-black uppercase tracking-widest text-gray-500 mb-3" required>Título de la Tarea</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" placeholder="Escribe un título" required
                           class="w-full px-5 py-4 rounded-2xl border @error('titulo') border-rose-500 bg-rose-50/30 @else border-gray-200 dark:border-gray-800 @enderror focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 bg-white dark:bg-gray-800 transition-all outline-none text-lg font-medium">
                    @error('titulo')
                        <p class="mt-3 text-sm text-rose-500 font-bold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="descripcion" class="block text-sm font-black uppercase tracking-widest text-gray-500 mb-3">Descripción <span class="text-gray-300 dark:text-gray-700 font-normal">(Opcional)</span></label>
                    <textarea name="descripcion" id="descripcion" rows="4" placeholder="Detalla los pasos o notas adicionales..."
                              class="w-full px-5 py-4 rounded-2xl border @error('descripcion') border-rose-500 bg-rose-50/30 @else border-gray-200 dark:border-gray-800 @enderror focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 bg-white dark:bg-gray-800 transition-all outline-none resize-none">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="mt-3 text-sm text-rose-500 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="prioridad" class="block text-sm font-black uppercase tracking-widest text-gray-500 mb-3" required>Prioridad</label>
                        <select name="prioridad" id="prioridad" 
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 dark:border-gray-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 bg-white dark:bg-gray-800 transition-all outline-none font-bold">
                            <option value="baja" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>🟢 Baja</option>
                            <option value="media" {{ old('prioridad', 'media') == 'media' ? 'selected' : '' }}>🟡 Media</option>
                            <option value="alta" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>🔴 Alta</option>
                        </select>
                        @error('prioridad')
                            <p class="mt-3 text-sm text-rose-500 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_limite" class="block text-sm font-black uppercase tracking-widest text-gray-500 mb-3">Fecha Límite</label>
                        <input type="date" name="fecha_limite" id="fecha_limite" value="{{ old('fecha_limite') }}"
                               class="w-full px-5 py-4 rounded-2xl border border-gray-200 dark:border-gray-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 bg-white dark:bg-gray-800 transition-all outline-none font-medium">
                        @error('fecha_limite')
                            <p class="mt-3 text-sm text-rose-500 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl hover:shadow-indigo-500/25 active:scale-[0.98] text-lg uppercase tracking-widest">
                        Guardar Tarea
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
