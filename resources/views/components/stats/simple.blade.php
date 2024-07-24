@props(['label'])

<div class="overflow-hidden rounded-md bg-white px-4 py-5 border border-neutral-300 sm:p-6">
    <dt class="truncate text-sm font-medium text-neutral-500">{{ $label }}</dt>
    <dd class="mt-1 text-3xl font-semibold tracking-tight text-neutral-900">{{ $slot }}</dd>
</div>
