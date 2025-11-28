<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/contacto', function (Request $request) {
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Aquí puedes mandar correo, guardar en BD, etc.
    // Ejemplo rápido con Mail (opcional):
    // Mail::raw($data['message'], function ($m) use ($data) {
    //     $m->to('hola@eventmaster.edu.mx')->subject($data['subject']);
    // });

    return redirect('/#contacto')->with('success', '¡Mensaje enviado correctamente! Te responderemos pronto');
})->name('contact.store');

require __DIR__.'/auth.php';
