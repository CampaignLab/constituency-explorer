<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Component;

class SearchPalette extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search-palette', [
            'constituencies' => Constituency::search('name', $this->search)->orderBy('name')->get(),
        ]);
    }
}
