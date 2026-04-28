<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

// Listar y Crear
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::get('/tareas/crear', [TareaController::class, 'create'])->name('tareas.create');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');

// Toggle
Route::patch('/tareas/{id}/toggle', [TareaController::class, 'toggle'])->name('tareas.toggle');

// Redirección inicial
Route::get('/', function () {
    return redirect()->route('tareas.index');
});