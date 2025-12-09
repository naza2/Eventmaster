<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\AsesoriaController;
use App\Http\Controllers\JuezController;
use App\Http\Controllers\JuezPanelController;
use App\Http\Controllers\VotoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\GanadorController;
use App\Http\Controllers\ConstanciaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvitacionController;
use App\Http\Controllers\EspecialidadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PÁGINAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contacto', function () {
    return view('contact');
})->name('contact');

Route::post('/contacto', function (Request $request) {
    $request->validate([
        'nombre'  => 'required|string|max:255',
        'email'   => 'required|email',
        'asunto'  => 'required|string|max:255',
    ]);

    // Aquí puedes conectar con Mail, guardar en BD, etc.
    return back()->with('success', '¡Mensaje enviado! Te responderemos pronto');
})->name('contact.store');

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN + DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | SELECCIÓN DE ESPECIALIDAD (JUECES)
    |--------------------------------------------------------------------------
    */
    Route::get('/especialidad/seleccionar', [EspecialidadController::class, 'select'])
        ->name('especialidad.select');
    Route::post('/especialidad/guardar', [EspecialidadController::class, 'store'])
        ->name('especialidad.store');

    /*
    |--------------------------------------------------------------------------
    | INVITACIONES
    |--------------------------------------------------------------------------
    */
    Route::get('/invitaciones', [InvitacionController::class, 'index'])
        ->name('invitaciones.index');
    Route::get('/equipos/{equipo}/invitar', [InvitacionController::class, 'create'])
        ->name('equipos.invitar')
        ->middleware('permission:invite-members');
    Route::post('/equipos/{equipo}/invitar', [InvitacionController::class, 'enviar'])
        ->name('invitaciones.enviar')
        ->middleware('permission:invite-members');
    Route::post('/invitaciones/{invitacion}/aceptar', [InvitacionController::class, 'aceptar'])
        ->name('invitaciones.aceptar');
    Route::post('/invitaciones/{invitacion}/rechazar', [InvitacionController::class, 'rechazar'])
        ->name('invitaciones.rechazar');

    /*
    |--------------------------------------------------------------------------
    | EVENTOS (públicos para todos los autenticados)
    |--------------------------------------------------------------------------
    */
    Route::get('/eventos', [EventController::class, 'index'])->name('eventos.index');
    Route::get('/eventos/{evento}', [EventController::class, 'show'])->name('eventos.show');
    // Rutas para creación de eventos (solo administradores)
    Route::get('/dashboard/eventos/create', [EventController::class, 'create'])
        ->name('eventos.create')
        ->middleware('role:administrador');

    Route::post('/dashboard/eventos', [EventController::class, 'store'])
        ->name('eventos.store')
        ->middleware('role:administrador');

    /*
    |--------------------------------------------------------------------------
    | EQUIPOS Y PROYECTOS (solo usuarios autenticados)
    |--------------------------------------------------------------------------
    */
    Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');

    Route::prefix('eventos/{evento}')->group(function () {
        Route::get('equipo/create', [EquipoController::class, 'create'])->name('equipo.create');
        Route::post('equipo', [EquipoController::class, 'store'])->name('equipo.store');
    });

    Route::get('/equipos/{equipo}', [EquipoController::class, 'show'])->name('equipos.show');

    Route::put('/proyecto/{proyecto}', [ProyectoController::class, 'update'])
        ->name('proyecto.update');

    Route::post('/avances/{proyecto}', [AvanceController::class, 'store'])
        ->name('avances.store');

    Route::post('/equipos/{equipo}/miembros', [ParticipanteController::class, 'store'])
        ->name('miembros.store');

    Route::post('/equipos/{equipo}/asesoria', [AsesoriaController::class, 'solicitar'])
        ->name('asesoria.solicitar');
    Route::patch('/asesoria/{asesoria}/aceptar', [AsesoriaController::class, 'aceptar'])
        ->name('asesoria.aceptar');

    /*
    |--------------------------------------------------------------------------
    | JUECES Y CALIFICACIONES (solo jueces o admin)
    |--------------------------------------------------------------------------
    */
    // Panel del juez
    Route::get('/juez/panel', [JuezPanelController::class, 'index'])
        ->name('juez.panel')
        ->middleware('role:juez');

    // Calificaciones por criterios
    Route::get('/calificar/{equipo}', [CalificacionController::class, 'create'])
        ->name('calificar.create')
        ->middleware('can:calificar,equipo');

    Route::post('/calificar/{equipo}', [CalificacionController::class, 'store'])
        ->name('calificar.store')
        ->middleware('can:calificar,equipo');

    // Votación por puestos (1°, 2°, 3°)
    Route::get('/evento/{evento}/votar', [VotoController::class, 'create'])
        ->name('votos.create')
        ->middleware('role:juez');

    Route::post('/evento/{evento}/votar', [VotoController::class, 'store'])
        ->name('votos.store')
        ->middleware('role:juez');

    /*
    |-------------------------------------------------------------------------
    | GANADORES Y CONSTANCIAS (solo admin)
    |-------------------------------------------------------------------------
    */
    Route::get('/evento/{evento}/ganadores', [GanadorController::class, 'create'])
        ->name('ganadores.create')
        ->middleware('role:admin');

    Route::post('/evento/{evento}/ganadores', [GanadorController::class, 'store'])
        ->name('ganadores.store')
        ->middleware('role:admin');

    Route::get('/constancia/{ganador}', [ConstanciaController::class, 'generar'])
        ->name('constancia.descargar')
        ->middleware('can:view,ganador');
});

/*
|--------------------------------------------------------------------------
| PANEL ADMINISTRATIVO
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:administrador'])->prefix('admin')->name('admin.')->group(function () {
    // Gestión de usuarios
    Route::get('/usuarios', [AdminController::class, 'usuariosIndex'])->name('usuarios.index');
    Route::get('/usuarios/crear', [AdminController::class, 'usuariosCreate'])->name('usuarios.create');
    Route::post('/usuarios', [AdminController::class, 'usuariosStore'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}', [AdminController::class, 'usuariosShow'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/editar', [AdminController::class, 'usuariosEdit'])->name('usuarios.edit');
    Route::patch('/usuarios/{usuario}', [AdminController::class, 'usuariosUpdate'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [AdminController::class, 'usuariosDestroy'])->name('usuarios.destroy');

    // Gestión de eventos
    Route::get('/eventos', [AdminController::class, 'eventosIndex'])->name('eventos.index');
    Route::get('/eventos/{evento}', [AdminController::class, 'eventosShow'])->name('eventos.show');
    Route::get('/eventos/{evento}/editar', [AdminController::class, 'eventosEdit'])->name('eventos.edit');
    Route::patch('/eventos/{evento}', [AdminController::class, 'eventosUpdate'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [AdminController::class, 'eventosDestroy'])->name('eventos.destroy');
});

require __DIR__.'/auth.php';