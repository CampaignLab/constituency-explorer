@props([
    'title',
    'subtitle' => null,
])

<div {{ $attributes->class('border border-neutral-300 rounded-lg overflow-hidden divide-y divide-neutral-300') }}>
    <div class="bg-neutral-50 px-4 py-2.5">
        <h3 class="font-semibold tracking-tight">
            {{ $title }}
        </h3>

        @isset($subtitle)
            <p class="text-neutral-500 text-sm">
                {{ $subtitle }}
            </p>
        @endisset
    </div>

    <div class="bg-white px-4">
        {{ $slot }}
    </div>
</div>
