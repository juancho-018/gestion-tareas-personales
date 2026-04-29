<?php

namespace App\Http\Controllers;

use App\Http\Requests\TareaRequest;
use App\Http\Resources\TareaCollection;
use App\Http\Resources\TareaResource;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Muestra la lista de tareas.
     * - JSON (Postman/API): retorna TareaCollection con metadatos.
     * - Web (navegador):    retorna la vista Blade index.
     */
    public function index(Request $request)
    {
        $tareas = Tarea::orderBy('created_at', 'desc')->get();

        if ($request->expectsJson()) {
            return new TareaCollection($tareas);
        }

        return view('index', compact('tareas'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Guarda una nueva tarea en la base de datos.
     * - JSON (Postman/API): retorna TareaResource con HTTP 201 Created.
     * - Web (navegador):    redirige al índice con mensaje de éxito.
     */
    public function store(TareaRequest $request)
    {
        $tarea = Tarea::create($request->validated());

        if ($request->expectsJson()) {
            return (new TareaResource($tarea))
                ->response()
                ->setStatusCode(201);
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Muestra el formulario para editar una tarea existente.
     */
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('edit', compact('tarea'));
    }

    /**
     * Actualiza una tarea en la base de datos.
     * - JSON (Postman/API): retorna TareaResource con HTTP 200 OK.
     * - Web (navegador):    redirige al índice con mensaje de éxito.
     */
    public function update(TareaRequest $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->validated());

        // El campo 'completada' viene del checkbox del formulario web
        // y no pasa por validated() porque no está en las reglas del Request.
        if ($request->has('completada')) {
            $tarea->completada = (bool) $request->input('completada');
            $tarea->save();
        }

        if ($request->expectsJson()) {
            return new TareaResource($tarea->fresh());
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Elimina una tarea de la base de datos.
     * - JSON (Postman/API): retorna HTTP 204 No Content.
     * - Web (navegador):    redirige al índice con mensaje de éxito.
     */
    public function destroy(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }

    /**
     * Alterna el estado de completada de una tarea.
     * - JSON (Postman/API): retorna TareaResource con el nuevo estado.
     * - Web (navegador):    redirige al índice con mensaje de éxito.
     */
    public function toggle(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->completada = !$tarea->completada;
        $tarea->save();

        if ($request->expectsJson()) {
            return new TareaResource($tarea);
        }

        return redirect()->route('tareas.index');
    }
}