<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // La autorización se maneja en el controller con Policy
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
            'nombre_equipo' => 'required|string|max:255|unique:equipos,nombre_equipo',
            'nombre_proyecto' => 'required|string|max:255',
            'descripcion_proyecto' => 'required|string|max:1000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
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
            'nombre_equipo.required' => 'El nombre del equipo es obligatorio.',
            'nombre_equipo.unique' => 'Ya existe un equipo con este nombre.',
            'nombre_proyecto.required' => 'El nombre del proyecto es obligatorio.',
            'descripcion_proyecto.required' => 'La descripción del proyecto es obligatoria.',
            'descripcion_proyecto.max' => 'La descripción no puede exceder 1000 caracteres.',
            'logo.image' => 'El logo debe ser una imagen.',
            'logo.mimes' => 'El logo debe ser un archivo JPG, PNG, WebP o GIF.',
            'logo.max' => 'El logo no puede ser mayor a 2MB.',
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
            'nombre_equipo' => 'nombre del equipo',
            'nombre_proyecto' => 'nombre del proyecto',
            'descripcion_proyecto' => 'descripción del proyecto',
        ];
    }
}
