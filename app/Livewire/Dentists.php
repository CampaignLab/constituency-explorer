<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dentists extends Component
{
    public Constituency $constituency;

    public $search = '';

    #[Computed()]
    public function dentists()
    {
        return $this->constituency->dentists()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.dentists');
    }
}
