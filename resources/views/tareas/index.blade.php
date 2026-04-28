@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="max-w-[100rem] mx-auto">
    <!-- Encabezado de Sección -->
    <div class="mb-10">
        <h2 class="text-8xl font-black text-gray-900 dark:text-white tracking-tighter">Panel de Control</h2>
        <p class="text-gray-500 dark:text-gray-400 mt-4 text-2xl font-medium">Organiza tus prioridades y alcanza tus metas diarias.</p>
    </div>


    <!-- Contenedor Principal (Grid de Tarjetas) -->
    <div>
        @if($tareas->isEmpty())
            <div class="bg-white dark:bg-gray-900 shadow-xl border border-gray-100 dark:border-gray-800 rounded-[2.5rem] py-32 text-center px-6">
                <div class="bg-gray-50 dark:bg-gray-800 w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 transform -rotate-6 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-4">No tienes tareas pendientes</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2 max-w-md mx-auto text-xl leading-relaxed">Tu agenda está despejada. Es un buen momento para planificar algo nuevo.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($tareas as $tarea)
                    <div style="border-radius: 2.5rem;" class="group flex flex-col bg-white dark:bg-gray-900 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-800 p-6 relative overflow-hidden {{ $tarea->completada ? 'opacity-80' : '' }}">
                        
                        <!-- Barra de estado lateral (opcional para dar color) -->
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $tarea->completada ? 'bg-emerald-500' : 'bg-indigo-500' }}"></div>

                        <!-- Cabecera de la Tarjeta: Toggle + Prioridad -->
                        <div class="flex justify-between items-center mb-4 pl-2">
                            <form action="{{ route('tareas.toggle', $tarea->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-8 h-8 rounded-xl border-2 flex items-center justify-center transition-all duration-300 {{ $tarea->completada ? 'bg-emerald-500 border-emerald-500 text-white shadow-lg shadow-emerald-500/30' : 'border-gray-300 dark:border-gray-700 hover:border-emerald-400' }}" title="{{ $tarea->completada ? 'Marcar como pendiente' : 'Marcar como completada' }}">
                                    @if($tarea->completada)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </button>
                            </form>

                            @php
                                $styles = [
                                    'alta' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
                                    'media' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                    'baja' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'
                                ];
                            @endphp
                            <span class="px-3 py-1 {{ $styles[$tarea->prioridad] }} rounded-lg text-xs font-black uppercase tracking-widest">
                                {{ $tarea->prioridad }}
                            </span>
                        </div>

                        <!-- Cuerpo de la Tarjeta: Título + Descripción -->
                        <div class="flex-1 pl-2">
                            <h3 class="text-lg font-bold mb-1.5 {{ $tarea->completada ? 'line-through text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-white' }} leading-tight">
                                {{ $tarea->titulo }}
                            </h3>
                            @if($tarea->descripcion)
                                <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 mb-4 leading-relaxed">
                                    {{ $tarea->descripcion }}
                                </p>
                            @endif
                        </div>

                        <!-- Pie de la Tarjeta: Fecha + Acciones -->
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center pl-2">
                            <div class="flex items-center gap-2 text-sm font-bold text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $tarea->fecha_limite ? $tarea->fecha_limite->format('d M, Y') : 'Sin fecha' }}
                            </div>

                            <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('tareas.edit', $tarea->id) }}" class="p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors" title="Editar Tarea">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg transition-colors" title="Eliminar Tarea">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
