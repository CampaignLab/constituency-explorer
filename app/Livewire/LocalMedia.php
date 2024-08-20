<?php

namespace App\Livewire;

use App\Models\Constituency;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class LocalMedia extends Component
{
    use WithPagination;

    public Constituency $constituency;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage('local-media');
    }

    #[Computed()]
    public function localMedia()
    {
        return $this->constituency->localMedia()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->paginate(pageName: 'local-media');
    }

    public function render()
    {
        return view('livewire.local-media');
    }
}
