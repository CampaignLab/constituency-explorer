@php
    $tag = $attributes->has('href') ? 'a' : 'button';
@endphp

<{{ $tag }}
    {{ $attributes->class('rounded-md bg-white px-4 py-1.5 font-medium text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 inline-block !no-underline') }}
>
    {{ $slot }}
</{{ $tag }}>
