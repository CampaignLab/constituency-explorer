@props([
    'label',
    'value',
    'tab' => null,
    'download' => null,
    'size' => 'md',
])

@php
    $tag = isset($tab) ? 'button' : 'div';
@endphp

<{{ $tag }}
    @isset($tab)
        x-on:click="if (document.querySelector(`[data-tab-target=@js($tab)]`)) { tab = @js($tab) }"
    @endisset
    {{ $attributes->class(['border border-primary-border rounded-lg flex flex-col text-left']) }}
>
    <div @class([
        'flex-1 w-full',
        'p-6' => $size === 'md',
        'p-4' => $size === 'sm',
    ])>
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
    </div>

    @isset($download)
        <a href="{{ $download }}" target="_blank" @class([
            'flex items-center gap-x-2.5 text-xs border-t border-primary-border w-full',
            'px-6 py-2.5' => $size === 'md',
            'px-4 py-2.5' => $size === 'sm',
        ])>
            <x-icons.download />
            <span>Download data</span>
        </a>
    @endisset
</{{ $tag }}>
