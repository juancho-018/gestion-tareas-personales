<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TareaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|min:3|max:100',
            'descripcion' => 'nullable|string|max:500',
            'prioridad' => 'required|in:baja,media,alta',
            'fecha_limite' => 'nullable|date|after_or_equal:today',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'titulo.required' => "El título es obligatorio y debe tener entre 3 y 100 caracteres.",
            'titulo.min' => "El título es obligatorio y debe tener entre 3 y 100 caracteres.",
            'titulo.max' => "El título es obligatorio y debe tener entre 3 y 100 caracteres.",
            'descripcion.max' => "La descripción no puede superar los 500 caracteres.",
            'prioridad.required' => "La prioridad debe ser baja, media o alta.",
            'fecha_limite.date' => "La fecha límite debe ser una fecha válida.",
            'fecha_limite.after_or_equal' => "La fecha límite debe ser hoy o una fecha futura.",
        ];
    }
}
