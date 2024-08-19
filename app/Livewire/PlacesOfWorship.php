<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PlacesOfWorship extends Component
{
    public Constituency $constituency;

    public $search = '';

    #[Computed()]
    public function placesOfWorship()
    {
        return $this->constituency->placesOfWorship()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.places-of-worship');
    }
}
