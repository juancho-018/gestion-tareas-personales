<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TareaCollection extends ResourceCollection
{
    /**
     * El recurso individual que se usará para cada elemento de la colección.
     *
     * @var string
     */
    public $collects = TareaResource::class;

    /**
     * Transforma la colección de tareas en un array para la respuesta JSON.
     *
     * Agrega metadatos útiles como el total de tareas y cuántas
     * están completadas — información que un cliente API suele necesitar.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'  => $this->collection,
            'meta'  => [
                'total'      => $this->collection->count(),
                'completadas' => $this->collection->where('completada', true)->count(),
                'pendientes'  => $this->collection->where('completada', false)->count(),
            ],
        ];
    }
}
