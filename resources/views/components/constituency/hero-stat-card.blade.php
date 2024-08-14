@props([
    'label',
    'value',
])

<div {{ $attributes }}>
    <div class="h-0.5 lg:h-1 w-full bg-black rounded-full"></div>

    <div class="p-4 lg:p-6 space-y-2 lg:space-y-3">
        <p class="text-sm font-medium">
            {{ $label }}
        </p>

        <p class="font-semibold text-2xl">
            {{ $value }}
        </p>
    </div>
</div>
