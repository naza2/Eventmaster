<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Carrera;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $carreras = Carrera::all();
        return view('auth.register', compact('carreras'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'carrera_id' => ['required', 'exists:carreras,id'],
            'matricula' => ['required', 'string', 'max:20', 'unique:users,matricula'],
        ]);

        $fullName = $request->name . ($request->lastname ? ' ' . $request->lastname : '');

        $user = User::create([
            'name' => $fullName,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'carrera_id' => $request->carrera_id,
            'matricula' => $request->matricula,
        ]);

        // Asignar rol de participante por defecto
        $user->assignRole('participante');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('eventos.index', absolute: false));
    }
}
