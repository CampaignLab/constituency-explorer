<x-layouts.app>
    <div x-data="{
        tab: -1,
        init() {
            this.$watch('tab', () => {
                this.$dispatch('tab:changed');
            })
        }
    }">
        <div class="bg-white pt-12 px-24 constituency-tabs">
            <div class="flex items-start justify-between gap-x-12">
                <div class="flex-1">
                    <h1 class="text-4xl font-bold tracking-tight">
                        {{ $constituency->name }}
                    </h1>

                    <p class="uppercase text-black/50 text-sm mt-4 font-bold tracking-tight">
                        Westminster Parliamentary Constituency
                    </p>

                    <div class="grid grid-cols-6 gap-x-2.5 gap-y-5 [&_p]:not-prose mt-8 bg-neutral-50/50 rounded border border-neutral-300 divide-x divide-neutral-300">
                        <div class="py-4 px-6">
                            <p class="font-semibold text-sm !my-0">GSS Code</p>
                            <p class="text-sm !mb-0 !mt-2">{{ $constituency->gss_code }}</p>
                        </div>

                        <div class="py-4 px-6">
                            <p class="font-semibold text-sm !my-0">Nation</p>
                            <p class="text-sm !mb-0 !mt-2">{{ $constituency->nation }}</p>
                        </div>

                        <div class="py-4 px-6">
                            <p class="font-semibold text-sm !my-0">Region</p>
                            <p class="text-sm !mb-0 !mt-2">{{ $constituency->region }}</p>
                        </div>

                        <div class="py-4 px-6">
                            <p class="font-semibold text-sm !my-0">Electorate</p>
                            <p class="text-sm !mb-0 !mt-2">{{ number_format($constituency->electorate) }}</p>
                        </div>

                        <div class="py-4 px-6">
                            <p class="font-semibold text-sm !my-0">Area</p>
                            <p class="text-sm !mb-0 !mt-2">{{ number_format($constituency->area, 2) }}</p>
                        </div>

                        <div class="py-4 px-6">
                            <p class="font-semibold text-sm !my-0">Density</p>
                            <p class="text-sm !mb-0 !mt-2">{{ number_format($constituency->density, 2) }}</p>
                        </div>
                    </div>
                </div>

                <img src="{{ $constituency->getMapBoxImageUrl() }}" alt="" class="w-[500px] h-[300px] object-center object-cover rounded-lg border border-neutral-300">
            </div>

            <x-tabs.host class="mt-12">
                <x-tabs.tab :i="-1" active>
                    Overview
                </x-tabs.tab>

                <x-tabs.tab :i="1">
                    Local Authorities
                </x-tabs.tab>

                <x-tabs.tab :i="7">
                    Old Constituencies
                </x-tabs.tab>

                <x-tabs.tab :i="2">
                    Towns
                </x-tabs.tab>

                <x-tabs.tab :i="3">
                    Charities
                </x-tabs.tab>

                @if($constituency->dentists->isNotEmpty())
                    <x-tabs.tab :i="4">
                        Dentists
                    </x-tabs.tab>
                @endif

                @if($constituency->hospitals->isNotEmpty())
                    <x-tabs.tab :i="5">
                        Hospitals
                    </x-tabs.tab>
                @endif

                @if($constituency->schools->isNotEmpty())
                    <x-tabs.tab :i="6">
                        Schools
                    </x-tabs.tab>
                @endif
            </x-tabs.host>
        </div>

        <div class="flex flex-col py-12 px-24 [&_div]:prose [&_div]:max-w-none">
            <div x-show="tab === -1" class="not-prose">
                <x-stats.wrapper>
                    <x-stats.simple label="No. Local Authorities">
                        {{ $constituency->localAuthorities->count() }}
                    </x-stats.simple>

                    <x-stats.simple label="No. Towns">
                        {{ $constituency->towns->count() }}
                    </x-stats.simple>

                    <x-stats.simple label="No. Charities">
                        {{ $constituency->charities->count() }}
                    </x-stats.simple>

                    <x-stats.simple label="No. Dentists">
                        {{ $constituency->dentists->count() }}
                    </x-stats.simple>

                    <x-stats.simple label="No. Schools">
                        {{ $constituency->schools->count() }}
                    </x-stats.simple>
                </x-stats.wrapper>
            </div>

            <div x-show="tab === 1" class="not-prose gap-8 grid grid-cols-4" x-cloak>
                @foreach ($constituency->localAuthorities as $localAuthority)
                    <x-description-list-card
                        :title="$localAuthority->name"
                        :subtitle="$localAuthority->gss_code"
                    >
                        <dl class="divide-y divide-neutral-200">
                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Population Overlap</dt>
                                <dd class="text-sm">{{ number_format($localAuthority->pivot->overlap_pop) }}</dd>
                            </div>

                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Area Overlap</dt>
                                <dd class="text-sm">{{ number_format($localAuthority->pivot->overlap_area) }}</dd>
                            </div>

                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Population Overlap (%)</dt>
                                <dd class="text-sm">
                                    <x-pill :scalePercentage="$localAuthority->pivot->percentage_overlap_pop * 100">
                                        {{ $localAuthority->pivot->percentage_overlap_pop * 100 }}%
                                    </x-pill>
                                </dd>
                            </div>

                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Area Overlap (%)</dt>
                                <dd class="text-sm">
                                    <x-pill :scalePercentage="$localAuthority->pivot->percentage_overlap_area * 100">
                                        {{ $localAuthority->pivot->percentage_overlap_area * 100 }}%
                                    </x-pill>
                                </dd>
                            </div>
                        </dl>
                    </x-description-list-card>
                @endforeach
            </div>

            <div x-show="tab === 7" class="not-prose grid gap-8 grid-cols-4" x-cloak>
                @foreach ($constituency->oldConstituencies as $oldConstituency)
                    <x-description-list-card
                        :title="$oldConstituency->name"
                        :subtitle="$oldConstituency->gss_code"
                    >
                        <dl class="divide-y divide-neutral-200">
                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Population Overlap</dt>
                                <dd class="text-sm">{{ number_format($oldConstituency->pivot->overlap_pop) }}</dd>
                            </div>

                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Area Overlap</dt>
                                <dd class="text-sm">{{ number_format($oldConstituency->pivot->overlap_area) }}</dd>
                            </div>

                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Population Overlap (%)</dt>
                                <dd class="text-sm">
                                    <x-pill :scalePercentage="$oldConstituency->pivot->percentage_overlap_pop * 100">
                                        {{ $oldConstituency->pivot->percentage_overlap_pop * 100 }}%
                                    </x-pill>
                                </dd>
                            </div>

                            <div class="flex items-center justify-between py-2.5">
                                <dt class="text-sm font-medium">Area Overlap (%)</dt>
                                <dd class="text-sm">
                                    <x-pill :scalePercentage="$oldConstituency->pivot->percentage_overlap_area * 100">
                                        {{ $oldConstituency->pivot->percentage_overlap_area * 100 }}%
                                    </x-pill>
                                </dd>
                            </div>
                        </dl>
                    </x-description-list-card>
                @endforeach
            </div>

            <div x-show="tab === 2" x-cloak>
                <x-button :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'towns'])" target="_blank">
                    Export
                </x-button>

                <div class="rounded-lg border border-neutral-300 overflow-hidden mt-6">
                    <table class="bg-white">
                        <thead>
                            <tr class="[&_th]:text-left [&_th]:px-4 [&_th]:whitespace-nowrap [&_th]:py-2.5">
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody class="[&_td]:px-4">
                            @foreach($constituency->towns->sortBy('name', SORT_NATURAL) as $i => $town)
                                <tr class="cursor-pointer hover:bg-neutral-50/50 [&_td]:align-middle">
                                    <td class="font-medium">{{ $town->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="tab === 3" x-cloak>
                <x-button :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'charities'])" target="_blank">
                    Export
                </x-button>

                <div class="rounded-lg border border-neutral-300 overflow-hidden mt-6">
                    <table class="bg-white">
                        <thead>
                            <tr class="[&_th]:text-left [&_th]:px-4 [&_th]:whitespace-nowrap [&_th]:py-2.5">
                                <th>Name</th>
                                <th>No. volunteers</th>
                                <th>Income (£)</th>
                                <th>Spending (£)</th>
                                <th>Address</th>
                                <th class="w-[40px]"></th>
                            </tr>
                        </thead>
                        <tbody x-data="{
                            state: {},
                            toggle(i) {
                                this.state[i] = !this.state[i];
                            }
                        }" class="[&_td]:px-4">
                            @foreach($constituency->charities->sortBy('name', SORT_NATURAL) as $i => $charity)
                                <tr class="cursor-pointer hover:bg-neutral-50/50 [&_td]:align-middle" x-on:click="toggle(@js($i))" title="{{ $charity->name }}">
                                    <td class="font-medium">{{ $charity->name }}</td>
                                    <td>{{ $charity->volunteers ? number_format($charity->volunteers) : App\mdash() }}</td>
                                    <td>{{ number_format($charity->income) }}</td>
                                    <td>{{ number_format($charity->spending) }}</td>
                                    <td>{{ $charity->formattedAddress() }}</td>
                                    <td>
                                        <button type="button" class="h-full flex items-center" x-on:click.stop="toggle(@js($i))" x-bind:class="{ '-rotate-90': !!state[@js($i)] }">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>

                                <tr x-show="!!state[@js($i)]" class="bg-neutral-50/75" x-cloak>
                                    <td colspan="6">
                                        <div class="grid grid-cols-5 gap-x-2.5 gap-y-5 [&_p]:not-prose py-2.5">
                                            <div>
                                                <p class="font-medium text-sm !my-0">Ward</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->ward }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Registered Date</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->registered?->format('d/m/Y') ?? App\mdash() }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Funders</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->funders ? number_format($charity->funders) : App\mdash() }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Email</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->email ?? App\mdash() }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Phone</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->phone ?? App\mdash() }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Website</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->website ?? App\mdash() }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Facebook</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->facebook ?? App\mdash() }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Instagram</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->instagram ?? App\mdash() }}</p>
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm !my-0">Twitter / X</p>
                                                <p class="text-sm !mb-0 !mt-2">{{ $charity->twitter ?? App\mdash() }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="tab === 4" x-cloak>
                <x-button :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'dentists'])" target="_blank">
                    Export
                </x-button>

                <div class="border border-neutral-300 rounded-lg mt-6">
                    <div
                        x-data="constituencyMap({
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
                        })"
                        class="w-full h-[800px] flex rounded-lg overflow-hidden divide-x divide-neutral-300"
                    >
                        <div class="bg-white w-[450px] overflow-y-auto divide-y divide-neutral-200">
                            @foreach($constituency->dentists->sortBy('name', SORT_NATURAL) as $dentist)
                                <button type="button" x-on:click="focusMarker(@js($dentist->id))" class="text-left px-4 py-2.5 w-full leading-tight font-semibold cursor-pointer">
                                    {{ $dentist->name }}
                                </button>
                            @endforeach
                        </div>
                        <div class="w-full h-full relative">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="tab === 5" x-cloak>
                <x-button :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'hospitals'])" target="_blank">
                    Export
                </x-button>

                <div class="border border-neutral-300 rounded-lg mt-6">
                    <div
                        x-data="constituencyMap({
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
                        })"
                        class="w-full h-[800px] flex rounded-lg overflow-hidden divide-x divide-neutral-300"
                    >
                        <div class="bg-white w-[450px] overflow-y-auto divide-y divide-neutral-200">
                            @foreach($constituency->hospitals->sortBy('name', SORT_NATURAL) as $hospital)
                                <button type="button" x-on:click="focusMarker(@js($hospital->id))" class="text-left px-4 py-2.5 w-full leading-tight font-semibold cursor-pointer">
                                    {{ $hospital->name }}
                                </button>
                            @endforeach
                        </div>
                        <div class="w-full h-full relative">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="tab === 6" x-cloak>
                <x-button :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'schools'])" target="_blank">
                    Export
                </x-button>

                <div class="border border-neutral-300 rounded-lg mt-6">
                    <div
                        x-data="constituencyMap({
                            token: @js(config('services.mapbox.token')),
                            geometry: @js($constituency->geojson),
                            center: @js([$constituency->center_lon, $constituency->center_lat]),
                            markers: @js($constituency->schools->map(fn ($school) => [
                                'id' => $school->id,
                                'name' => mb_convert_encoding($school->name, 'UTF-8'),
                                'longitude' => $school->longitude,
                                'latitude' => $school->latitude,
                            ])->all()),
                        })"
                        class="w-full h-[800px] flex rounded-lg overflow-hidden divide-x divide-neutral-300"
                    >
                        <div class="bg-white w-[450px] overflow-y-auto divide-y divide-neutral-200">
                            @foreach($constituency->schools->sortBy('name', SORT_NATURAL) as $school)
                                <button type="button" x-on:click="focusMarker(@js($school->id))" class="text-left px-4 py-2.5 w-full leading-tight font-semibold cursor-pointer">
                                    {{ $school->name }}
                                </button>
                            @endforeach
                        </div>
                        <div class="w-full h-full relative">
                            <div x-ref="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
