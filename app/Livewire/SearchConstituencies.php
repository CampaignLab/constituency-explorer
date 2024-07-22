<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Component;


class SearchConstituencies extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search-constituencies', [
            'constituencies' => Constituency::search('name', $this->search)->orderBy('name')->get(),
        ]);
    }
}
