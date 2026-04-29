<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TareaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // En store (POST) los campos son obligatorios.
        // En update (PUT) usamos 'sometimes|required' para permitir
        // actualizaciones parciales sin romper la validación.
        $requerido = $this->isMethod('POST') ? 'required' : 'sometimes|required';

        return [
            'titulo'       => "$requerido|string|min:3|max:100",
            'descripcion'  => 'nullable|string|max:500',
            'prioridad'    => "$requerido|in:baja,media,alta",
            'fecha_limite' => 'nullable|date|after_or_equal:today',
        ];
    }

    /**
     * Obtiene los mensajes de error para las reglas de validación definidas.
     */
    public function messages(): array
    {
        return [
            'titulo.required'             => 'El título es obligatorio y debe tener entre 3 y 100 caracteres.',
            'titulo.min'                  => 'El título es obligatorio y debe tener entre 3 y 100 caracteres.',
            'titulo.max'                  => 'El título es obligatorio y debe tener entre 3 y 100 caracteres.',
            'descripcion.max'             => 'La descripción no puede superar los 500 caracteres.',
            'prioridad.required'          => 'La prioridad debe ser baja, media o alta.',
            'prioridad.in'                => 'La prioridad debe ser baja, media o alta.',
            'fecha_limite.date'           => 'La fecha límite debe ser hoy o una fecha futura.',
            'fecha_limite.after_or_equal' => 'La fecha límite debe ser hoy o una fecha futura.',
        ];
    }

    /**
     * Retorna JSON 422 para clientes API, redirect para el navegador.
     */
    protected function failedValidation(Validator $validator): void
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Los datos enviados no son válidos.',
                    'errors'  => $validator->errors(),
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
