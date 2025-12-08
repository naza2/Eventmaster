<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    public function asesoriasRecibidas()
    {
        return $this->hasMany(Asesoria::class, 'user_id');
    }
}