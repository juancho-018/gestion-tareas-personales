<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tarea;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::orderBy('created_at', 'desc')->get();
        return view('index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|min:3|max:100',
            'descripcion' => 'nullable|string|max:500',
            'prioridad' => 'required|in:baja,media,alta',
            'fecha_limite' => 'nullable|date',
        ], [
            'titulo.required' => "El título es obligatorio y debe tener entre 3 y 100 caracteres.",
            'titulo.min' => "El título es obligatorio y debe tener entre 3 y 100 caracteres.",
            'titulo.max' => "El título es obligatorio y debe tener entre 3 y 100 caracteres.",
            'descripcion.max' => "La descripción no puede superar los 500 caracteres.",
            'prioridad.required' => "La prioridad debe ser baja, media o alta.",
            'fecha_limite.date' => "La fecha límite debe ser hoy o una fecha futura.",
        ]);

        Tarea::create($validated);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Alternar el estado de completada de una tarea.
     */
    public function toggle($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->completada = !$tarea->completada;
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Estado de la tarea actualizado.');
    }
}