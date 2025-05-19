<?php

namespace App\Livewire\Stays;

use App\Models\Stay;
use Livewire\Component;
use Livewire\WithPagination;

class StayIndex extends Component
{
    use WithPagination;

    public $query = null;
    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    public $check_in;
    public $check_out;


    public function search()
    {
        $this->resetPage();
    }

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            // Altera a direção
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Clicar em outro coluna , seta a coluna e reseta a direção para asc
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function render()
    {
        $stays = Stay::with('user')
            ->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->query . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.stays.stay-index', [
            'stays' => $stays,
        ]);
    }

    public function edit($id)
    {
        $stay = Stay::findOrFail($id);

        $this->check_in = $stay->check_in;
        $this->check_out = $stay->check_out;
    }

    public function update() {}

    public function destroy(string $id)
    {
        $stay = Stay::findOrFail($id);
        $stay->delete();

        session()->flash('message', 'Estádia deletada com sucesso');
    }
}
