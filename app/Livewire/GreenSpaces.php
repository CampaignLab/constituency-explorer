<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GreenSpaces extends Component
{
    public Constituency $constituency;

    public $search = '';
    public $hideUnknown = true;

    #[Computed()]
    public function greenSpaces()
    {
        $query = $this->constituency->greenSpaces()
            ->where('name', 'like', "%{$this->search}%");
            
        if ($this->hideUnknown) {
            $query->where('name', '!=', 'Unknown');
        }
        
        return $query->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.green-spaces');
    }
}
