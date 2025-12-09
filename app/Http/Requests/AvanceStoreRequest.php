<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvanceStoreRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:2000',
            'porcentaje_avance' => 'required|integer|min:0|max:100',
            'evidencias' => 'nullable|array',
            'evidencias.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,pdf|max:10240',
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
            'titulo.required' => 'El título del avance es obligatorio.',
            'titulo.max' => 'El título no puede exceder 255 caracteres.',
            'descripcion.required' => 'La descripción del avance es obligatoria.',
            'descripcion.max' => 'La descripción no puede exceder 2000 caracteres.',
            'porcentaje_avance.required' => 'El porcentaje de avance es obligatorio.',
            'porcentaje_avance.min' => 'El porcentaje de avance debe ser al menos 0%.',
            'porcentaje_avance.max' => 'El porcentaje de avance no puede exceder 100%.',
            'evidencias.*.file' => 'Las evidencias deben ser archivos válidos.',
            'evidencias.*.mimes' => 'Las evidencias deben ser imágenes, videos MP4 o archivos PDF.',
            'evidencias.*.max' => 'Cada evidencia no puede ser mayor a 10MB.',
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
            'porcentaje_avance' => 'porcentaje de avance',
        ];
    }
}
