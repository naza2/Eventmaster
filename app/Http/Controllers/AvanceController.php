<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevoAvanceMail;

class AvanceController extends Controller
{
    /**
     * Mostrar formulario para crear un nuevo avance
     */
    public function create(Equipo $equipo)
    {
        $this->authorize('update', $equipo);

        // Si no hay proyecto, redirigir con mensaje claro
        if (!$equipo->proyecto) {
            return redirect()->route('equipos.proyecto', $equipo)
                ->with('error', 'Primero debes completar la información del proyecto');
        }

        return view('avances.create', compact('equipo'));
    }

    /**
     * Guardar el nuevo avance + subir imágenes + enviar correo
     */
    public function store(Request $request, Equipo $equipo)
    {
        $this->authorize('update', $equipo);

        if (!$equipo->proyecto) {
            return back()->with('error', 'El proyecto no está definido');
        }

        $request->validate([
            'titulo'            => 'required|string|max:255',
            'descripcion'       => 'required|string',
            'porcentaje_avance' => 'required|integer|min:0|max:100',
            'evidencias.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp,mp4|max:10240', // hasta 10MB
        ]);

        // Guardar evidencias
        $evidencias = [];
        if ($request->hasFile('evidencias')) {
            foreach ($request->file('evidencias') as $file) {
                $evidencias[] = $file->store('avances', 'public');
            }
        }

        // Crear el avance
        $avance = $equipo->proyecto->avances()->create([
            'user_id'           => auth()->id(),
            'titulo'            => $request->titulo,
            'descripcion'       => $request->descripcion,
            'porcentaje_avance' => $request->porcentaje_avance,
            'evidencias'        => $evidencias,
        ]);

        // Enviar notificación por correo a todos los miembros (excepto al autor)
        try {
            $equipo->loadMissing('participantes.user');

            foreach ($equipo->participantes as $participante) {
                if (
                    $participante->user &&
                    $participante->user->id !== auth()->id() &&
                    $participante->user->email
                ) {
                    Mail::to($participante->user->email)->queue(new NuevoAvanceMail($avance));
                }
            }
        } catch (\Exception $e) {
            \Log::warning('Error al enviar notificaciones de avance: ' . $e->getMessage());
            // No rompemos el flujo si falla el correo
        }

        return redirect()
            ->route('equipos.avances', $equipo)
            ->with('success', '¡Avance publicado y equipo notificado!');
    }
}