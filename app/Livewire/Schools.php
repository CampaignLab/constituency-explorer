<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Schools extends Component
{
    public Constituency $constituency;

    public $search = '';

    #[Computed()]
    public function schools()
    {
        return $this->constituency->schools()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.schools');
    }
}
