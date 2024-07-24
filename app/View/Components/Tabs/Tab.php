<?php

namespace App\View\Components\Tabs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tab extends Component
{
    public function __construct(
        public int $i,
        public bool $active = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.tabs.tab');
    }
}
