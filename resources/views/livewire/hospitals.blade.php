<div>
    <div class="flex items-center gap-x-4">
        <x-constituency.subheading>
            Hospitals
        </x-constituency.subheading>

        <x-constituency.counter>
            {{ number_format($constituency->hospitals->count()) }}
        </x-constituency.counter>
    </div>

    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'hospitals'])" target="_blank" class="mt-6" />

    <div wire:ignore.self x-data="constituencyMap({
        token: @js(config('services.mapbox.token')),
        geometry: @js($constituency->geojson),
        center: @js([$constituency->center_lon, $constituency->center_lat]),
        markers: @js($constituency->hospitals->map(fn ($hospital) => [
            'id' => $hospital->id,
            'name' => $hospital->name,
            'longitude' => $hospital->longitude,
            'latitude' => $hospital->latitude,
            'address' => implode(', ', array_filter($hospital->address)),
        ])->all()),
    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-y-6 gap-x-6">
        <div class="space-y-6 flex flex-col">
            <x-input type="search" wire:model.live.debounce.500ms="search" placeholder="Search by name..." />

            @foreach($this->hospitals as $hospital)
                <button type="button" x-on:click="focusMarker(@js($hospital->id))" class="border border-primary-border bg-white text-left rounded-lg p-5 text-sm">
                    <p class="font-bold">
                        {{ $hospital->name }}
                    </p>

                    <div class="flex items-start gap-x-1.5 mt-2.5">
                        <x-icons.location class="mt-px" />
                        <p>{{ $hospital->formattedAddress() }}</p>
                    </div>
                </button>
            @endforeach
        </div>

        <div
            class="w-full hidden lg:block h-[500px] rounded-lg overflow-hidden border border-primary-border sticky top-10" wire:ignore>
            <div x-ref="map"></div>
        </div>
    </div>
</div>
