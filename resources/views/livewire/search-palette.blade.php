<div
    x-data="{ open: false }"
    class="max-w-lg z-20 transform divide-y divide-neutral-100 rounded-lg bg-white shadow-2xl ring-1 ring-primary-border transition-all mt-8 relative" x-bind:class="{ 'rounded-lg': !open, 'rounded-t-lg': open }"
    x-on:click.outside="open = false">

    <div class="relative">
        <svg class="pointer-events-none absolute left-3 top-3 h-4 w-4 text-neutral-400" viewBox="0 0 20 20"
            fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                clip-rule="evenodd" />
        </svg>
        <input type="text"
            class="h-10 w-full border-0 bg-transparent pl-10 pr-4 text-neutral-900 placeholder:text-neutral-400 focus:ring-0 sm:text-sm"
            placeholder="Search..." role="combobox" aria-expanded="false" aria-controls="options"
            wire:model.live.debounce.500ms="search" x-on:focus="open = true">
    </div>

    <div class="absolute top-10 z-20 bg-white w-full rounded-b-lg ring-1 ring-primary-border overflow-hidden" x-show="open" x-cloak>
        @if ($constituencies->isNotEmpty())
            <ul class="max-h-72 scroll-py-2 overflow-y-auto text-sm text-neutral-800" id="options" role="listbox">
                @foreach ($constituencies as $constituency)
                    <li class="cursor-default select-none px-4 py-2 hover:bg-neutral-50" id="option-1" role="option"
                        tabindex="-1">
                        <a href="{{ route('constituency', $constituency) }}" class="block">{{ $constituency->name }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="p-4 text-sm text-neutral-500">No constituencies found.</p>
        @endif
    </div>
</div>
