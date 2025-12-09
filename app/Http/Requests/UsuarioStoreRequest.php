<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'matricula' => 'nullable|string|max:20|unique:users,matricula',
            'telefono' => 'nullable|string|max:20',
            'carrera_id' => 'required|exists:carreras,id',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,name',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'sexo' => 'nullable|in:M,F,Otro',
            'verificado' => 'sometimes|boolean',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'foto_url' => 'nullable|url|starts_with:https://,http://',
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
            'name.required' => 'El nombre completo es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'matricula.unique' => 'Esta matrícula ya está registrada.',
            'carrera_id.required' => 'La carrera es obligatoria.',
            'carrera_id.exists' => 'La carrera seleccionada no es válida.',
            'roles.required' => 'Debe seleccionar al menos un rol.',
            'roles.min' => 'Debe seleccionar al menos un rol.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'sexo.in' => 'El sexo debe ser M, F u Otro.',
            'foto_perfil.image' => 'El archivo debe ser una imagen.',
            'foto_perfil.max' => 'La foto de perfil no puede ser mayor a 5MB.',
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
            'name' => 'nombre completo',
            'carrera_id' => 'carrera',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'foto_perfil' => 'foto de perfil',
        ];
    }
}
