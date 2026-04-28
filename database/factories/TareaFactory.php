<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'descripcion' => fake()->paragraph(),
            'prioridad' => fake()->randomElement(['baja', 'media', 'alta']),
            'completada' => fake()->boolean(),
            'fecha_limite' => fake()->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
