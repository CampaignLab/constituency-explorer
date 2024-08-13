@props([
    'label',
    'value',
    'download' => null,
])

<div {{ $attributes->class('border border-primary-border p-6 rounded-lg') }}>
    <p class="text-sm font-medium">
        {{ $label }}
    </p>

    <p class="text-primary-blue text-3xl font-bold mt-4">
        {{ $value }}
    </p>

    {{-- FIXME: Add in the "Download data" button here. --}}
</div>
