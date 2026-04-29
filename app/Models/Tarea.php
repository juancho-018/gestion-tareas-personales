<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'prioridad',
        'fecha_limite',
    ];

    // Valor por defecto en PHP (complementa el default(false) de la migración)
    protected $attributes = [
        'completada' => false,
    ];

    protected $casts = [
        'completada' => 'boolean',
        'fecha_limite' => 'date',
    ];
}