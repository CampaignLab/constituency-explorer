<div x-disclosure {{ $attributes->class('mb-2 border') }}>
    <button
        x-disclosure:button
        class="flex w-full items-center justify-between px-6 py-4 text-xl font-semibold"
    >
        <span>{{ $title }}</span>

        <span x-show="$disclosure.isOpen" x-cloak aria-hidden="true" class="ml-4">&minus;</span>
        <span x-show="! $disclosure.isOpen" aria-hidden="true" class="ml-4">&plus;</span>
    </button>

    <div x-disclosure:panel x-cloak x-collapse>
        <div class="px-6 pb-4">
            {{ $slot }}
        </div>
    </div>
</div>
