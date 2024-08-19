<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Hospitals extends Component
{
    public Constituency $constituency;

    public $search = '';

    #[Computed()]
    public function hospitals()
    {
        return $this->constituency->hospitals()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.hospitals');
    }
}
