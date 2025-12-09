<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitudAsesoriaMail;

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

        $asesoria = $equipo->asesorias()->create([
            'user_id' => $request->asesor_id,
            'comentarios' => $request->mensaje
        ]);

        // Enviar correo al asesor
        try {
            $asesor = User::find($request->asesor_id);
            if ($asesor && $asesor->email) {
                Mail::to($asesor->email)->send(new SolicitudAsesoriaMail($asesoria));
            }
        } catch (\Exception $e) {
            \Log::error('Error enviando correo de solicitud de asesoría: ' . $e->getMessage());
        }

        return redirect()->route('equipos.show', $equipo)
                        ->with('success', '¡Solicitud enviada! El asesor recibirá una notificación por correo');
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