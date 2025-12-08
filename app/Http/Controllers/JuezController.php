<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\User;
use App\Models\Juez;
use Illuminate\Http\Request;

class JuezController extends Controller
{
    public function index(Evento $evento)
    {
        $this->authorize('viewAny', Juez::class);
        
        $evento->load(['jueces.user.carrera']);
        
        return view('jueces.index', compact('evento'));
    }

    public function store(Request $request, Evento $evento)
    {
        $this->authorize('create', Juez::class);

        $request->validate(['user_id' => 'required|exists:users,id']);
        $evento->jueces()->create(['user_id' => $request->user_id]);

        return back()->with('success', 'Juez agregado');
    }
}