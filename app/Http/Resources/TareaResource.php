<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TareaResource extends JsonResource
{
    /**
     * Transforma el modelo Tarea en un array para la respuesta JSON.
     *
     * Este método define EXACTAMENTE qué campos se exponen al cliente
     * y con qué nombre/formato — independientemente de cómo se llamen
     * las columnas en la base de datos.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'titulo'      => $this->titulo,
            'descripcion' => $this->descripcion,
            'prioridad'   => $this->prioridad,
            'completada'  => $this->completada,
            'fecha_limite' => $this->fecha_limite?->format('Y-m-d'),
            'creada_en'   => $this->created_at->toDateTimeString(),
            'actualizada_en' => $this->updated_at->toDateTimeString(),
        ];
    }
}
