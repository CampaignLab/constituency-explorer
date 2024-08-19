<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Charities extends Component
{
    use WithPagination;

    public Constituency $constituency;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage('charities');
    }

    #[Computed()]
    public function charities()
    {
        return $this->constituency->charities()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->paginate(pageName: 'charities');
    }

    public function render()
    {
        return view('livewire.charities');
    }
}
