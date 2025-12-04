<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $eventos = Evento::where('estado', '!=', 'finalizado')
                        ->orderByDesc('fecha_inicio')
                        ->take(6)
                        ->get();

        return view('welcome', compact('eventos'));
    }
}