<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoStoreRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:2000',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'max_miembros' => 'nullable|integer|min:1|max:20',
            'estado' => 'required|in:inscripcion,en_curso,calificacion,finalizado',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'banner_url' => 'nullable|url|starts_with:https://,http://',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del evento es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'max_miembros.min' => 'El máximo de miembros debe ser al menos 1.',
            'max_miembros.max' => 'El máximo de miembros no puede exceder 20.',
            'estado.required' => 'El estado del evento es obligatorio.',
            'estado.in' => 'El estado debe ser: inscripcion, en_curso, calificacion o finalizado.',
            'banner.image' => 'El banner debe ser una imagen.',
            'banner.max' => 'El banner no puede ser mayor a 4MB.',
            'banner_url.url' => 'La URL del banner debe ser válida.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'max_miembros' => 'máximo de miembros',
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de fin',
        ];
    }
}
