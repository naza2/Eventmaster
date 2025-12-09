<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevoAvanceMail;

class AvanceController extends Controller
{
    public function store(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto->equipo);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'porcentaje_avance' => 'required|integer|min:0|max:100',
            'evidencias.*' => 'nullable|file|image|mimes:jpg,png,gif,webp,mp4|max:10240'
        ]);

        $evidencias = [];
        if ($request->hasFile('evidencias')) {
            foreach ($request->file('evidencias') as $file) {
                $evidencias[] = $file->store('avances', 'public');
            }
        }

        $avance = $proyecto->avances()->create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'evidencias' => $evidencias,
            'porcentaje_avance' => $request->porcentaje_avance
        ]);

        // Enviar correo a todos los miembros del equipo (excepto quien lo publicó)
        try {
            $equipo = $proyecto->equipo;
            $equipo->load('participantes.user');
            
            foreach ($equipo->participantes as $participante) {
                // No enviar correo al autor del avance
                if ($participante->user && $participante->user->id !== auth()->id() && $participante->user->email) {
                    Mail::to($participante->user->email)->send(new NuevoAvanceMail($avance));
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error enviando correos de nuevo avance: ' . $e->getMessage());
        }

        return redirect()->route('equipos.show', $proyecto->equipo)
                        ->with('success', '¡Avance publicado y equipo notificado!');
    }
}