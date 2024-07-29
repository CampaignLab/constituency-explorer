@props([
    'scalePercentage' => null,
])

<span {{ $attributes->class([
    'inline-block px-2.5 py-1 text-xs font-medium rounded-full',
    match (true) {
        $scalePercentage > 0 && $scalePercentage < 20 => 'bg-scale-20 text-black',
        $scalePercentage >= 20 && $scalePercentage < 40 => 'bg-scale-40 text-black',
        $scalePercentage >= 40 && $scalePercentage < 60 => 'bg-scale-60 text-white',
        $scalePercentage >= 60 && $scalePercentage < 80 => 'bg-scale-80 text-white',
        $scalePercentage >= 80 => 'bg-scale-100 text-white',
        default => null,
    },
]) }}>
    {{ $slot }}
</span>
