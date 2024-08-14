@props([
    'label',
    'value',
    'download' => null,
    'size' => 'md',
])

<div {{ $attributes->class(['border border-primary-border rounded-lg', 'p-6' => $size === 'md', 'p-4' => $size === 'sm']) }}>
    <p class="text-sm font-medium">
        {{ $label }}
    </p>

    <p @class([
        'text-primary-blue font-bold mt-4',
        'text-3xl ' => $size === 'md',
        'text-xl' => $size === 'sm',
    ])>
        {{ $value }}
    </p>

    {{-- FIXME: Add in the "Download data" button here. --}}
</div>
