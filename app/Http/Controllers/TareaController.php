<?php

namespace App\Http\Controllers;

use App\Http\Requests\TareaRequest;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Muestra la lista de tareas.
     */
    public function index()
    {
        $tareas = Tarea::orderBy('created_at', 'desc')->get();
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Guarda una nueva tarea en la base de datos.
     */
    public function store(TareaRequest $request)
    {
        Tarea::create($request->validated());

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Muestra el formulario para editar una tarea existente.
     */
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Actualiza una tarea en la base de datos.
     */
    public function update(TareaRequest $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->validated());

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Elimina una tarea de la base de datos.
     */
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.'); // Mensaje exacto
    }

    /**
     * Alternar el estado de completada de una tarea.
     */
    public function toggle($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->completada = !$tarea->completada;
        $tarea->save();

        return redirect()->route('tareas.index'); // Redirección sin mensaje
    }

}