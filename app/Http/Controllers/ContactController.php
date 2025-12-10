<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'asunto' => 'required|string|max:255',
        ]);

        // Datos del correo
        $data = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'asunto' => $request->asunto,
        ];

        // Enviar correo
        Mail::raw(
            "Mensaje enviado desde el formulario de contacto:\n\n" .
            "Nombre: {$data['nombre']}\n" .
            "Correo: {$data['email']}\n" .
            "Asunto: {$data['asunto']}\n",
            function ($message) use ($data) {
                $message->to('contactoeventmaster@gmail.com')
                        ->subject('Nuevo mensaje de contacto');
            }
        );

        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}
