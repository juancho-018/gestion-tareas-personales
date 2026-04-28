@extends('layouts.app')

@section('title', 'Crear Nueva Tarea')

@section('content')
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
        @include('partials.form', [
            'action' => route('tareas.store'),
            'buttonText' => 'Guardar Tarea'
        ])
    </div>
</div>
@endsection
