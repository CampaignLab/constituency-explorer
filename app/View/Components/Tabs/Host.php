<?php

namespace App\View\Components\Tabs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Host extends Component
{
    public int $i = 0;

    public function i(): int
    {
        return $this->i++;
    }

    public function render(): View|Closure|string
    {
        return view('components.tabs.host');
    }
}
