<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

// Llama a las rutas de un solo golpe
Route::resource('tareas', TareaController::class);

// Toggle
Route::patch('/tareas/{id}/toggle', [TareaController::class, 'toggle'])->name('tareas.toggle');