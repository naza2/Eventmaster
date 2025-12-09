<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitacionEnviarRequest extends FormRequest
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
            'invitado_id' => 'required|exists:users,id',
            'mensaje' => 'nullable|string|max:500',
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
            'invitado_id.required' => 'Debe seleccionar un usuario para invitar.',
            'invitado_id.exists' => 'El usuario seleccionado no es válido.',
            'mensaje.max' => 'El mensaje no puede exceder 500 caracteres.',
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
            'invitado_id' => 'usuario invitado',
        ];
    }
}
