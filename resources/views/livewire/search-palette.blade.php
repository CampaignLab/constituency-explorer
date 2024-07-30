<div
    x-data="{ open: false }"
    x-on:keydown.escape.window="open = false"
    x-on:search-palette.window="open = true"
    class="relative z-10" role="dialog"
    aria-modal="true"
    x-cloak
    x-show="open"
>
    <div
        class="fixed inset-0 bg-neutral-500 bg-opacity-50 transition-opacity"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
        <div
            class="mx-auto max-w-xl transform divide-y divide-neutral-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all"
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <div class="relative">
                <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-neutral-400" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                        clip-rule="evenodd" />
                </svg>
                <input type="text"
                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-neutral-900 placeholder:text-neutral-400 focus:ring-0 sm:text-sm"
                    placeholder="Search..." role="combobox" aria-expanded="false" aria-controls="options" wire:model.live.debounce.500ms="search">
            </div>

            @if($constituencies->isNotEmpty())
                <!-- Results, show/hide based on command palette state -->
                <ul class="max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-neutral-800" id="options" role="listbox">
                    @foreach($constituencies as $constituency)
                        <li class="cursor-default select-none px-4 py-2 hover:bg-neutral-50" id="option-1" role="option" tabindex="-1">
                            <a href="{{ route('constituency', $constituency) }}" class="block">{{ $constituency->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <!-- Empty state, show/hide based on command palette state -->
                <p class="p-4 text-sm text-neutral-500">No people found.</p>
            @endif
        </div>
    </div>
</div>
