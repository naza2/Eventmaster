<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;
use Livewire\WithPagination;

class EventosSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public string $estado = ''; // '' = todos

    // Mantener parámetros en la URL
    protected $queryString = [
        'search' => ['except' => ''],
        'estado' => ['except' => ''],
    ];

    // Resetear página al cambiar búsqueda o filtro
    public function updatingSearch()   { $this->resetPage(); }
    public function updatingEstado()   { $this->resetPage(); }

    public function render()
    {
        $query = Evento::query();

        if ($this->search !== '') {
            $query->where('nombre', 'like', "%{$this->search}%");
        }

        if ($this->estado !== '' && in_array($this->estado, ['inscripcion', 'en_curso', 'finalizado'])) {
            $query->where('estado', $this->estado);
        }

        $eventos = $query->withCount('equipos')
                         ->latest('fecha_inicio')
                         ->paginate(12);

        return view('livewire.eventos-search', [
            'eventos' => $eventos
        ]);
    }
}