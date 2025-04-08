<div>
    <div class="flex items-center gap-x-4">
        <x-constituency.subheading>
            Green Spaces
        </x-constituency.subheading>

        <x-constituency.counter>
            {{ number_format($constituency->greenSpaces->count()) }}
        </x-constituency.counter>
    </div>

    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'green-spaces'])" target="_blank" class="mt-6" />

    <div wire:ignore.self x-data="constituencyMap({
        token: @js(config('services.mapbox.token')),
        geometry: @js($constituency->geojson),
        center: @js([$constituency->center_lon, $constituency->center_lat]),
        markers: @js($constituency->greenSpaces->map(fn ($place) => [
            'id' => $place->id,
            'name' => mb_convert_encoding($place->name, 'UTF-8'),
            'longitude' => $place->longitude,
            'latitude' => $place->latitude,
        ])->all()),
    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-y-6 gap-x-6">
        <div class="space-y-6 flex flex-col">
            <div class="flex flex-col space-y-3 mt-2">
                <x-input type="search" wire:model.live.debounce.500ms="search" placeholder="Search by name..." />
                
                <div class="flex items-center">
                    <input type="checkbox" id="hide-unknown" wire:model.live="hideUnknown" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-primary-300 rounded">
                    <label for="hide-unknown" class="ml-2 block text-sm text-gray-700">Hide missing names ("Unknown")</label>
                </div>
            </div>

            @foreach($this->greenSpaces as $place)
                <button type="button" x-on:click="focusMarker(@js($place->id))" class="border border-primary-border bg-white text-left rounded-lg p-5 text-sm">
                    <p class="font-bold">
                        {{ $place->name }}
                    </p>

                    <hr class="my-5 border-primary-border">

                    <div class="grid grid-cols-2 lg:grid-cols-3">
                        <div class="space-y-2.5">
                            <p>
                                Opening Hours
                            </p>

                            <p class="font-semibold">
                                {{ $place->opening_hours ?? App\mdash() }}
                            </p>
                        </div>
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
