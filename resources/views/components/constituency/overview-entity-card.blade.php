@props([
    'name',
    'code',
    'populationOverlap',
    'areaOverlap',
    'populationOverlapPercentage',
    'areaOverlapPercentage',
])

<div {{ $attributes->class('rounded-lg') }}>
    <div class="bg-primary-blue-background p-4 rounded-t-lg">
        <p class="font-bold text-xl">
            {{ $name }}
        </p>

        <p class="mt-1.5 text-sm text-muted-foreground">
            {{ $code }}
        </p>
    </div>

    <div class="border border-primary-border rounded-b-lg divide-y divide-primary-border text-sm">
        <div class="p-4 flex items-center justify-between">
            <p class="font-bold">Population Overlap</p>

            <div class="text-right">
                <p>{{ number_format($populationOverlapPercentage) }}%</p>
                <p class="text-xs text-muted-foreground">({{ number_format($populationOverlap) }})</p>
            </div>
        </div>

        <div class="p-4 flex items-center justify-between">
            <p class="font-bold">Area Overlap</p>

            <div class="text-right">
                <p>{{ number_format($areaOverlapPercentage) }}%</p>
                <p class="text-xs text-muted-foreground">({{ number_format($areaOverlap) }})</p>
            </div>
        </div>
    </div>
</div>
