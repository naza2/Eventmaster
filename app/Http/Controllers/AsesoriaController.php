<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class AsesoriaController extends Controller
{
    public function solicitar(Request $request, Equipo $equipo)
    {
        $this->authorize('update', $equipo);

        $request->validate([
            'asesor_id' => 'required|exists:users,id',
            'mensaje' => 'nullable|string|max:1000'
        ]);

        // Verificar que el asesor no esté ya asignado
        if ($equipo->asesorias()->where('user_id', $request->asesor_id)->exists()) {
            return back()->withErrors(['asesor_id' => 'Este asesor ya tiene una solicitud pendiente']);
        }

        $equipo->asesorias()->create([
            'user_id' => $request->asesor_id,
            'comentarios' => $request->mensaje
        ]);

        return redirect()->route('equipos.show', $equipo)
                        ->with('success', '¡Solicitud enviada! El asesor recibirá una notificación');
    }

    public function misSolicitudes()
    {
        $solicitudes = auth()->user()
            ->asesoriasRecibidas()
            ->with(['equipo.evento', 'equipo.participantes.user'])
            ->latest()
            ->get();

        return view('asesorias.mis-solicitudes', compact('solicitudes'));
    }

    public function aceptar($id)
    {
        $asesoria = \App\Models\Asesoria::findOrFail($id);
        $this->authorize('update', $asesoria->equipo);
        $asesoria->update(['aprobado' => true]);

        return back()->with('success', 'Asesoría aceptada');
    }
}