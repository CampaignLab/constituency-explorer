<x-layouts.app>
    <div x-data="{
        tab: 'overview',
        init() {
            this.$watch('tab', () => {
                this.$dispatch('tab:changed');
            })
        }
    }">
        <div class="py-7 px-6 md:px-10 2xl:px-24">
            <h1 class="text-4xl font-bold tracking-tight">
                {{ $constituency->name }}
            </h1>

            <div class="flex justify-between gap-x-6 mt-9">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 md:gap-4 lg:gap-6 w-full lg:w-1/2">
                    <x-constituency.overview-stat-card size="sm" class="bg-white" label="GSS Code" :value="$constituency->gss_code" />
                    <x-constituency.overview-stat-card size="sm" class="bg-white" label="Nation" :value="$constituency->nation" />
                    <x-constituency.overview-stat-card size="sm" class="bg-white" label="Region" :value="$constituency->region" />
                    <x-constituency.overview-stat-card size="sm" class="bg-white" label="Electorate" :value="number_format($constituency->electorate)" />
                    <x-constituency.overview-stat-card size="sm" class="bg-white" label="Area" :value="number_format($constituency->area, 2)" />
                    <x-constituency.overview-stat-card size="sm" class="bg-white" label="Density" :value="number_format($constituency->density, 2)" />
                </div>

                <img src="{{ $constituency->getMapBoxImageUrl() }}" alt="" class="w-1/2 hidden lg:block h-[300px] object-center object-cover rounded-lg border border-primary-border">
            </div>
        </div>

        <div class="bg-white py-7 px-6 md:px-10 2xl:px-24">
            <x-tabs.host>
                <x-tabs.tab i="overview" active>
                    Overview
                </x-tabs.tab>

                <x-tabs.tab i="towns">
                    Towns
                </x-tabs.tab>

                <x-tabs.tab i="charities">
                    Charities
                </x-tabs.tab>

                @if($constituency->dentists->isNotEmpty())
                    <x-tabs.tab i="dentists">
                        Dentists
                    </x-tabs.tab>
                @endif

                @if($constituency->hospitals->isNotEmpty())
                    <x-tabs.tab i="hospitals">
                        Hospitals
                    </x-tabs.tab>
                @endif

                @if($constituency->schools->isNotEmpty())
                    <x-tabs.tab i="schools">
                        Schools
                    </x-tabs.tab>
                @endif

                @if($constituency->communityCentres->isNotEmpty())
                    <x-tabs.tab i="community-centres">
                        Community Centres
                    </x-tabs.tab>
                @endif

                @if($constituency->placesOfWorship->isNotEmpty())
                    <x-tabs.tab i="places-of-worship">
                        Places of Worship
                    </x-tabs.tab>
                @endif
            </x-tabs.host>

            <div class="flex flex-col mt-10">
                <div x-show="tab === 'overview'">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <x-constituency.overview-stat-card label="Local Authorities" :value="number_format($constituency->localAuthorities->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'la'])" />
                        <x-constituency.overview-stat-card label="Towns" :value="number_format($constituency->towns->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'towns'])" />
                        <x-constituency.overview-stat-card label="Charities" :value="number_format($constituency->charities->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'charities'])" />
                        <x-constituency.overview-stat-card label="Dentists" :value="number_format($constituency->dentists->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'dentists'])" />
                        <x-constituency.overview-stat-card label="Hospitals" :value="number_format($constituency->hospitals->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'hospitals'])" />
                        <x-constituency.overview-stat-card label="Schools" :value="number_format($constituency->schools->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'schools'])" />
                    </div>

                    <div class="mt-10">
                        <div class="flex items-center gap-x-4">
                            <x-constituency.subheading>
                                Local Authorities
                            </x-constituency.subheading>

                            <x-constituency.counter>
                                {{ $constituency->localAuthorities->count() }}
                            </x-constituency.counter>
                        </div>

                        <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'la'])" class="mt-6" target="_blank" />

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                            @foreach($constituency->localAuthorities->sortByDesc('percentage_overlap_pop') as $authority)
                                <x-constituency.overview-entity-card
                                    :name="$authority->name"
                                    :code="$authority->gss_code"
                                    :populationOverlap="$authority->pivot->overlap_pop"
                                    :areaOverlap="$authority->pivot->overlap_area"
                                    :populationOverlapPercentage="$authority->pivot->percentage_overlap_pop * 100"
                                    :areaOverlapPercentage="$authority->pivot->percentage_overlap_area * 100"
                                />
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-10">
                        <div class="flex items-center gap-x-4">
                            <x-constituency.subheading>
                                Old Constituencies
                            </x-constituency.subheading>

                            <x-constituency.counter>
                                {{ $constituency->oldConstituencies->count() }}
                            </x-constituency.counter>
                        </div>

                        <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'old'])" class="mt-6" target="_blank" />

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                            @foreach($constituency->oldConstituencies->sortByDesc('percentage_overlap_pop') as $oldConstituency)
                                <x-constituency.overview-entity-card
                                    :name="$oldConstituency->name"
                                    :code="$oldConstituency->gss_code"
                                    :populationOverlap="$oldConstituency->pivot->overlap_pop"
                                    :areaOverlap="$oldConstituency->pivot->overlap_area"
                                    :populationOverlapPercentage="$oldConstituency->pivot->percentage_overlap_pop * 100"
                                    :areaOverlapPercentage="$oldConstituency->pivot->percentage_overlap_area * 100"
                                />
                            @endforeach
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'towns'" x-cloak>
                    <div class="flex items-center gap-x-4">
                        <x-constituency.subheading>
                            Towns
                        </x-constituency.subheading>

                        <x-constituency.counter>
                            {{ $constituency->towns->count() }}
                        </x-constituency.counter>
                    </div>

                    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'towns'])" target="_blank" class="mt-6" />

                    <div class="lg:max-w-[50%] w-full rounded-lg border border-primary-border mt-6 divide-y divide-primary-border">
                        @foreach($constituency->towns->sortBy('name', SORT_NATURAL) as $town)
                            <div class="p-4">
                                <p class="font-bold">
                                    {{ $town->name }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-show="tab === 'charities'" x-cloak>
                    <div class="flex items-center gap-x-4">
                        <x-constituency.subheading>
                            Charities
                        </x-constituency.subheading>

                        <x-constituency.counter>
                            {{ $constituency->charities->count() }}
                        </x-constituency.counter>
                    </div>

                    {{-- FIXME: Add in Charity search here. --}}

                    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'charities'])" target="_blank" class="mt-6" />

                    <div class="mt-6 space-y-6">
                        @foreach($constituency->charities->sortBy('name', SORT_NATURAL) as $charity)
                            <button
                                x-data="{ open: false }"
                                type="button"
                                class="border border-primary-border p-5 rounded-lg text-sm block w-full text-left transition-colors ease-in-out duration-150"
                                x-on:click="open = !open"
                                x-bind:class="{
                                    'bg-primary-slate/50': open,
                                }"
                            >
                                <div class="flex flex-col gap-y-4 lg:flex-row lg:items-center lg:justify-between">
                                    <div class="lg:w-1/2">
                                        <p class="font-bold">
                                            {{ $charity->name }}
                                        </p>

                                        <div class="flex items-start gap-x-1 mt-2.5">
                                            <x-icons.location class="mt-px flex-shrink-0" />

                                            <p>
                                                {{ $charity->formattedAddress() }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex-1 grid gap-y-4 grid-cols-2 lg:grid-cols-3 gap-x-6">
                                        <div class="space-y-2.5">
                                            <p>
                                                Volunteers
                                            </p>

                                            <p class="font-bold">
                                                {{ $charity->volunteers ? number_format($charity->volunteers) : App\mdash() }}
                                            </p>
                                        </div>

                                        <div class="space-y-2.5">
                                            <p>
                                                Income (£)
                                            </p>

                                            <p class="font-bold">
                                                {{ $charity->income ? number_format($charity->income) : App\mdash() }}
                                            </p>
                                        </div>

                                        <div class="space-y-2.5">
                                            <p>
                                                Spending (£)
                                            </p>

                                            <p class="font-bold">
                                                {{ $charity->spending ? number_format($charity->spending) : App\mdash() }}
                                            </p>
                                        </div>
                                    </div>

                                    <x-icons.chevron-down class="transition-transform ease-in-out duration-150 self-end lg:self-auto" x-bind:class="{ 'rotate-180': open }" />
                                </div>

                                <div class="mt-6" x-show="open" x-collapse x-cloak>
                                    <div class="flex items-center justify-between">
                                        <div class="hidden lg:block w-1/2"></div>

                                        <div class="flex-1 grid grid-cols-2 gap-y-4 lg:grid-cols-3 gap-x-6">
                                            <div class="space-y-2.5">
                                                <p>
                                                    Ward
                                                </p>

                                                <p class="font-bold">
                                                    {{ $charity->ward }}
                                                </p>
                                            </div>

                                            <div class="space-y-2.5">
                                                <p>
                                                    Registered Date
                                                </p>

                                                <p class="font-bold">
                                                    {{ $charity->registered->format('d/m/Y') }}
                                                </p>
                                            </div>

                                            <div class="space-y-2.5">
                                                <p>
                                                    Funders
                                                </p>

                                                <p class="font-bold">
                                                    {{ $charity->funders ? number_format($charity->funders) : App\mdash() }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="w-2.5 h-1.5"></div>
                                    </div>

                                    <hr class="border-primary-border mt-8">

                                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @if($charity->website)
                                            <div class="flex items-center gap-x-2.5">
                                                <x-icons.earth />
                                                <a href="{{ $charity->website }}" target="_blank" class="hover:underline">
                                                    {{ $charity->website }}
                                                </a>
                                            </div>
                                        @endif

                                        @if($charity->twitter)
                                            <div class="flex items-center gap-x-2.5">
                                                <x-icons.x />
                                                <a href="https://x.com/{{ $charity->twitter }}" target="_blank" class="hover:underline">
                                                    {{ '@' . ltrim($charity->twitter, '@') }}
                                                </a>
                                            </div>
                                        @endif

                                        @if($charity->phone)
                                            <div class="flex items-center gap-x-2.5">
                                                <x-icons.phone />
                                                <a href="tel:{{ $charity->phone }}" target="_blank" class="hover:underline">
                                                    {{ $charity->phone }}
                                                </a>
                                            </div>
                                        @endif

                                        @if($charity->instagram)
                                            <div class="flex items-center gap-x-2.5">
                                                <x-icons.instagram />
                                                <a href="https://instagram.com/{{ $charity->instagram }}" target="_blank" class="hover:underline">
                                                    {{ $charity->instagram }}
                                                </a>
                                            </div>
                                        @endif

                                        @if($charity->facebook)
                                            <div class="flex items-center gap-x-2.5">
                                                <x-icons.facebook />
                                                <a href="https://facebook.com/{{ $charity->facebook }}" target="_blank" class="hover:underline">
                                                    {{ $charity->facebook }}
                                                </a>
                                            </div>
                                        @endif

                                        @if($charity->email)
                                            <div class="flex items-center gap-x-2.5">
                                                <x-icons.email />
                                                <a href="mailto:{{ $charity->email }}" target="_blank" class="hover:underline">
                                                    {{ $charity->email }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div x-show="tab === 'dentists'" x-cloak>
                    <div class="flex items-center gap-x-4">
                        <x-constituency.subheading>
                            Dentists
                        </x-constituency.subheading>

                        <x-constituency.counter>
                            {{ number_format($constituency->dentists->count()) }}
                        </x-constituency.counter>
                    </div>

                    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'dentists'])" target="_blank" class="mt-6" />

                    <div x-data="constituencyMap({
                        token: @js(config('services.mapbox.token')),
                        geometry: @js($constituency->geojson),
                        center: @js([$constituency->center_lon, $constituency->center_lat]),
                        markers: @js($constituency->dentists->map(fn ($dentist) => [
                            'id' => $dentist->id,
                            'name' => $dentist->name,
                            'longitude' => $dentist->longitude,
                            'latitude' => $dentist->latitude,
                            'address' => implode(', ', array_filter($dentist->address)),
                        ])->all()),
                    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-y-6 gap-x-6">
                        <div class="space-y-6 flex flex-col">
                            @foreach($constituency->dentists->sortBy('name', SORT_NATURAL) as $dentist)
                                <button type="button" x-on:click="focusMarker(@js($dentist->id))" class="border border-primary-border bg-white text-left rounded-lg p-5 text-sm">
                                    <p class="font-bold">
                                        {{ $dentist->name }}
                                    </p>

                                    <div class="flex items-start gap-x-1.5 mt-2.5">
                                        <x-icons.location class="mt-px" />
                                        <p>{{ $dentist->formattedAddress() }}</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>

                        <div class="w-full hidden lg:block h-[500px] rounded-lg overflow-hidden border border-primary-border sticky top-10">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'hospitals'" x-cloak>
                    <div class="flex items-center gap-x-4">
                        <x-constituency.subheading>
                            Hospitals
                        </x-constituency.subheading>

                        <x-constituency.counter>
                            {{ number_format($constituency->hospitals->count()) }}
                        </x-constituency.counter>
                    </div>

                    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'hospitals'])" target="_blank" class="mt-6" />

                    <div x-data="constituencyMap({
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
                    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-x-6">
                        <div class="space-y-6 flex flex-col">
                            @foreach($constituency->hospitals->sortBy('name', SORT_NATURAL) as $hospital)
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

                        <div class="w-full hidden lg:block h-[500px] rounded-lg overflow-hidden border border-primary-border sticky top-10">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'schools'" x-cloak>
                    <div class="flex items-center gap-x-4">
                        <x-constituency.subheading>
                            Schools
                        </x-constituency.subheading>

                        <x-constituency.counter>
                            {{ number_format($constituency->schools->count()) }}
                        </x-constituency.counter>
                    </div>

                    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'schools'])" target="_blank" class="mt-6" />

                    <div x-data="constituencyMap({
                        token: @js(config('services.mapbox.token')),
                        geometry: @js($constituency->geojson),
                        center: @js([$constituency->center_lon, $constituency->center_lat]),
                        markers: @js($constituency->schools->map(fn ($school) => [
                            'id' => $school->id,
                            'name' => mb_convert_encoding($school->name, 'UTF-8'),
                            'longitude' => $school->longitude,
                            'latitude' => $school->latitude,
                        ])->all()),
                    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-x-6">
                        <div class="space-y-6 flex flex-col">
                            @foreach($constituency->schools->sortBy('name', SORT_NATURAL) as $school)
                                <button type="button" x-on:click="focusMarker(@js($school->id))" class="border border-primary-border bg-white text-left rounded-lg p-5 text-sm">
                                    <p class="font-bold">
                                        {{ $school->name }}
                                    </p>

                                    <hr class="my-5 border-primary-border">

                                    <div class="grid grid-cols-2 lg:grid-cols-3">
                                        <div class="space-y-2.5">
                                            <p>
                                                Phase of Education
                                            </p>

                                            <p class="font-semibold">
                                                {{ $school->phase_of_education?->getLabel() ?? App\mdash() }}
                                            </p>
                                        </div>

                                        <div class="space-y-2.5">
                                            <p>
                                                Gender
                                            </p>

                                            <p class="font-semibold">
                                                {{ $school->gender?->getLabel() ?? App\mdash() }}
                                            </p>
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </div>

                        <div class="w-full hidden lg:block h-[500px] rounded-lg overflow-hidden border border-primary-border sticky top-10">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'community-centres'" x-cloak>
                    <div class="flex items-center gap-x-4">
                        <x-constituency.subheading>
                            Community Centres
                        </x-constituency.subheading>

                        <x-constituency.counter>
                            {{ number_format($constituency->communityCentres->count()) }}
                        </x-constituency.counter>
                    </div>

                    {{-- FIXME: Add in download link here. --}}
                    {{-- <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'schools'])" target="_blank" class="mt-6" /> --}}

                    <div x-data="constituencyMap({
                        token: @js(config('services.mapbox.token')),
                        geometry: @js($constituency->geojson),
                        center: @js([$constituency->center_lon, $constituency->center_lat]),
                        markers: @js($constituency->communityCentres->map(fn ($centre) => [
                            'id' => $centre->id,
                            'name' => mb_convert_encoding($centre->name, 'UTF-8'),
                            'longitude' => $centre->longitude,
                            'latitude' => $centre->latitude,
                        ])->all()),
                    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-x-6">
                        <div class="space-y-6 flex flex-col">
                            @foreach($constituency->communityCentres->sortBy('name', SORT_NATURAL) as $centre)
                                <button type="button" x-on:click="focusMarker(@js($centre->id))" class="border border-primary-border bg-white text-left rounded-lg p-5 text-sm">
                                    <p class="font-bold">
                                        {{ $centre->name }}
                                    </p>
                                </button>
                            @endforeach
                        </div>

                        <div class="w-full hidden lg:block h-[500px] rounded-lg overflow-hidden border border-primary-border sticky top-10">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'places-of-worship'" x-cloak>
                    <div class="flex items-center gap-x-4">
                        <x-constituency.subheading>
                            Places of Worship
                        </x-constituency.subheading>

                        <x-constituency.counter>
                            {{ number_format($constituency->placesOfWorship->count()) }}
                        </x-constituency.counter>
                    </div>

                    {{-- FIXME: Add in download link here. --}}
                    {{-- <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'schools'])" target="_blank" class="mt-6" /> --}}

                    <div x-data="constituencyMap({
                        token: @js(config('services.mapbox.token')),
                        geometry: @js($constituency->geojson),
                        center: @js([$constituency->center_lon, $constituency->center_lat]),
                        markers: @js($constituency->placesOfWorship->map(fn ($place) => [
                            'id' => $place->id,
                            'name' => mb_convert_encoding($place->name, 'UTF-8'),
                            'longitude' => $place->longitude,
                            'latitude' => $place->latitude,
                        ])->all()),
                    })" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-x-6">
                        <div class="space-y-6 flex flex-col">
                            @foreach($constituency->placesOfWorship->sortBy('name', SORT_NATURAL) as $place)
                                <button type="button" x-on:click="focusMarker(@js($place->id))" class="border border-primary-border bg-white text-left rounded-lg p-5 text-sm">
                                    <p class="font-bold">
                                        {{ $place->name }}
                                    </p>

                                    <hr class="my-5 border-primary-border">

                                    <div class="grid grid-cols-2 lg:grid-cols-3">
                                        <div class="space-y-2.5">
                                            <p>
                                                Religion
                                            </p>

                                            <p class="font-semibold">
                                                {{ $place->religion ?? App\mdash() }}
                                            </p>
                                        </div>

                                        <div class="space-y-2.5">
                                            <p>
                                                Denomination
                                            </p>

                                            <p class="font-semibold">
                                                {{ $place->denomination ?? App\mdash() }}
                                            </p>
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </div>

                        <div class="w-full hidden lg:block h-[500px] rounded-lg overflow-hidden border border-primary-border sticky top-10">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
