@props([
    'i',
    'active' => false,
])

@php
    $activeClasses = 'bg-white rounded shadow';
@endphp

<button type="button" x-on:click="tab = @js($i)" {{ $attributes->class([
    'px-6 py-2 font-medium text-sm',
    $activeClasses => $active,
]) }} x-bind:class="{
    @js($activeClasses): tab === @js($i),
}">
    {{ $slot }}
</button>
