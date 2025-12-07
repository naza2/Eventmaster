<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialidadController extends Controller
{
    /**
     * Mostrar formulario de selección de especialidad
     */
    public function select()
    {
        $user = Auth::user();

        // Solo jueces sin especialidad pueden acceder
        if (!$user->hasRole('juez') || $user->especialidad) {
            return redirect()->route('dashboard');
        }

        $especialidades = [
            'sistemas' => 'Ingeniería en Sistemas Computacionales', 
            'quimica' => 'Ingeniería Química',
            'civil' => 'Ingeniería Civil',
            'licenciatura' => 'Licenciatura',
            'fisica' => 'Física',
            'gestion_proyectos' => 'Gestión de Proyectos',
        ];

        return view('especialidad.select', compact('especialidades'));
    }

    /**
     * Guardar la especialidad seleccionada
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validar que sea juez y no tenga especialidad
        if (!$user->hasRole('juez') || $user->especialidad) {
            return redirect()->route('dashboard');
        }

        $request->validate([
            'especialidad' => 'required|in:sistemas,quimica,civil,licenciatura,fisica,gestion_proyectos',
        ]);

        $user->update([
            'especialidad' => $request->especialidad,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Especialidad guardada exitosamente.');
    }
}
