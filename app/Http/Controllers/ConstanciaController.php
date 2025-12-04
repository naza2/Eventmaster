<?php

namespace App\Http\Controllers;

use App\Models\Ganador;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ConstanciaController extends Controller
{
    public function generar(Ganador $ganador)
    {
        $this->authorize('view', $ganador);

        $pdf = Pdf::loadView('pdf.constancia', compact('ganador'))
                   ->setPaper('a4', 'landscape');

        return $pdf->download('Constancia-'.$ganador->equipo->nombre_equipo.'.pdf');
    }
}