<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;

class HeaderSearch extends Component
{
    public string $search = '';

    public function submit()
    {
        $constituency = Constituency::where('name', $this->search)->first();

        if ($constituency !== null) {
            return redirect()->route('constituency', $constituency);
        }

        return redirect()->route('index', ['search' => $this->search]);
    }

    public function render()
    {
        return view('livewire.header-search');
    }
}
