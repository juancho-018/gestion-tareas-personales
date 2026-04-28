<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

// Listar y Crear
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::get('/tareas/crear', [TareaController::class, 'create'])->name('tareas.create');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');

// Editar y Actualizar
Route::get('/tareas/{id}/editar', [TareaController::class, 'edit'])->name('tareas.edit');
Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');

// Eliminar
Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');

// Toggle
Route::patch('/tareas/{id}/toggle', [TareaController::class, 'toggle'])->name('tareas.toggle');

// Redirección inicial
Route::get('/', function () {
    return redirect()->route('tareas.index');
});