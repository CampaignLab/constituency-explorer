<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GreenSpaces extends Component
{
    public Constituency $constituency;

    public $search = '';

    #[Computed()]
    public function greenSpaces()
    {
        return $this->constituency->greenSpaces()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.green-spaces');
    }
}
