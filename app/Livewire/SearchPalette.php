<?php

namespace App\Livewire;

use App\Models\Constituency;
use App\Services\Postcodes;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchPalette extends Component
{
    public $search = '';

    #[Computed()]
    public function constituencies(): Collection
    {
        $constituencies = Constituency::search('name', $this->search)->orderBy('name')->get();

        if ($constituencies->isNotEmpty()) {
            return $constituencies;
        }

        $postcodes = app(Postcodes::class);

        try {
            $postcode = $postcodes->get($this->search);

            if (empty($postcode)) {
                return Collection::make();
            }

            $constituency = Constituency::where('gss_code', $postcode['codes']['parliamentary_constituency_2024'])->first();

            if ($constituency) {
                return Collection::make([$constituency]);
            }
        } catch (Exception) {
            return Collection::make();
        }

        return Collection::make();
    }

    public function render()
    {
        return view('livewire.search-palette');
    }
}
