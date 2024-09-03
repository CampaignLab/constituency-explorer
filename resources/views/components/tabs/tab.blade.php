@props([
    'i',
    'active' => false,
])

@php
    $activeClasses = 'bg-white rounded shadow';
@endphp

<button type="button" x-on:click="tab = @js($i)" {{ $attributes->class([
    'px-6 py-2 font-medium text-sm flex-1 lg:flex-initial cursor-pointer',
    $activeClasses => $active,
]) }} data-tab-target="{{ $i }}" x-bind:class="{
    @js($activeClasses): tab === @js($i),
}">
    {{ $slot }}
</button>
