<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CommunityCentres extends Component
{
    public Constituency $constituency;

    public $search = '';

    #[Computed()]
    public function communityCentres()
    {
        return $this->constituency->communityCentres()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.community-centres');
    }
}
