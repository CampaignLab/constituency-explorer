<div>
    <div class="flex items-center gap-x-4">
        <x-constituency.subheading>
            Community Centres
        </x-constituency.subheading>

        <x-constituency.counter>
            {{ number_format($constituency->communityCentres->count()) }}
        </x-constituency.counter>
    </div>

    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'community-centres'])" target="_blank" class="mt-6" />

    <div wire:ignore.self x-data="constituencyMap({
        token: @js(config('services.mapbox.token')),
        geometry: @js($constituency->geojson),
        center: @js([$constituency->center_lon, $constituency->center_lat]),
        markers: @js($constituency->communityCentres->map(fn ($centre) => [
            'id' => $centre->id,
            'name' => mb_convert_encoding($centre->name, 'UTF-8'),
            'longitude' => $centre->longitude,
            'latitude' => $centre->latitude,
        ])->all()),
    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-y-6 gap-x-6">
        <div class="space-y-6 flex flex-col">
            <x-input type="search" wire:model.live.debounce.500ms="search" placeholder="Search by name..." />

            @foreach($this->communityCentres as $centre)
                <button type="button" x-on:click="focusMarker(@js($centre->id))" class="border border-primary-border bg-white text-left rounded-lg p-5 text-sm">
                    <p class="font-bold">
                        {{ $centre->name }}
                    </p>
                </button>
            @endforeach
        </div>

        <div
            class="w-full hidden lg:block h-[500px] rounded-lg overflow-hidden border border-primary-border sticky top-10" wire:ignore>
            <div x-ref="map"></div>
        </div>
    </div>
</div>
