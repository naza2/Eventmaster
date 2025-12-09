<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalificacionStoreRequest extends FormRequest
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
            'calificaciones' => 'required|array',
            'calificaciones.*.criterio_id' => 'required|exists:criterios,id',
            'calificaciones.*.puntaje' => 'required|numeric|min:0',
            'calificaciones.*.comentario' => 'nullable|string|max:1000',
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
            'calificaciones.required' => 'Debe proporcionar al menos una calificación.',
            'calificaciones.array' => 'El formato de las calificaciones no es válido.',
            'calificaciones.*.criterio_id.required' => 'El criterio es obligatorio.',
            'calificaciones.*.criterio_id.exists' => 'El criterio seleccionado no es válido.',
            'calificaciones.*.puntaje.required' => 'El puntaje es obligatorio.',
            'calificaciones.*.puntaje.numeric' => 'El puntaje debe ser un número.',
            'calificaciones.*.puntaje.min' => 'El puntaje debe ser mayor o igual a 0.',
            'calificaciones.*.comentario.max' => 'El comentario no puede exceder 1000 caracteres.',
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
            'calificaciones.*.criterio_id' => 'criterio',
            'calificaciones.*.puntaje' => 'puntaje',
            'calificaciones.*.comentario' => 'comentario',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Validar que el puntaje no exceda el máximo del criterio
            if ($this->has('calificaciones')) {
                foreach ($this->calificaciones as $index => $calificacion) {
                    if (isset($calificacion['criterio_id']) && isset($calificacion['puntaje'])) {
                        $criterio = \App\Models\Criterio::find($calificacion['criterio_id']);
                        if ($criterio && $calificacion['puntaje'] > $criterio->puntaje_maximo) {
                            $validator->errors()->add(
                                "calificaciones.{$index}.puntaje",
                                "El puntaje no puede exceder {$criterio->puntaje_maximo} puntos para este criterio."
                            );
                        }
                    }
                }
            }
        });
    }
}
