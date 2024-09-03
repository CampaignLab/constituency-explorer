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

                <div class="w-1/2 hidden lg:block h-[300px] object-center object-cover rounded-lg border border-primary-border" x-data="constituencyStaticMap({
                    token: @js(config('services.mapbox.token')),
                    geometry: @js($constituency->geojson),
                    center: @js([$constituency->center_lon, $constituency->center_lat]),
                })"></div>
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

                @if($constituency->localMedia->isNotEmpty())
                    <x-tabs.tab i="local-media">
                        Local Media
                    </x-tabs.tab>
                @endif

                @if($constituency->greenSpaces->isNotEmpty())
                    <x-tabs.tab i="green-spaces">
                        Green Spaces
                    </x-tabs.tab>
                @endif
            </x-tabs.host>

            <div class="flex flex-col mt-10">
                <div x-show="tab === 'overview'">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <x-constituency.overview-stat-card label="Local Authorities" :value="number_format($constituency->localAuthorities->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'la'])" />
                        <x-constituency.overview-stat-card tab="towns" label="Towns" :value="number_format($constituency->towns->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'towns'])" />
                        <x-constituency.overview-stat-card tab="charities" label="Charities" :value="number_format($constituency->charities->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'charities'])" />
                        <x-constituency.overview-stat-card tab="dentists" label="Dentists" :value="number_format($constituency->dentists->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'dentists'])" />
                        <x-constituency.overview-stat-card tab="hospitals" label="Hospitals" :value="number_format($constituency->hospitals->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'hospitals'])" />
                        <x-constituency.overview-stat-card tab="schools" label="Schools" :value="number_format($constituency->schools->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'schools'])" />
                        <x-constituency.overview-stat-card tab="community-centres" label="Community Centres" :value="number_format($constituency->communityCentres->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'community-centres'])" />
                        <x-constituency.overview-stat-card tab="places-of-worship" label="Places of Worship" :value="number_format($constituency->placesOfWorship->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'places-of-worship'])" />
                        <x-constituency.overview-stat-card tab="local-media" label="Local Media" :value="number_format($constituency->localMedia->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'local-media'])" />
                        <x-constituency.overview-stat-card tab="green-spaces" label="Green Spaces" :value="number_format($constituency->greenSpaces->count())" :download="route('constituency.export', ['constituency' => $constituency, 'export' => 'green-spaces'])" />
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
                            @foreach($constituency->localAuthorities->sortByDesc('pivot.percentage_overlap_pop') as $authority)
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
                            @foreach($constituency->oldConstituencies->sortByDesc('pivot.percentage_overlap_pop') as $oldConstituency)
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
                    <livewire:charities :$constituency />
                </div>

                <div x-show="tab === 'dentists'" x-cloak>
                    <livewire:dentists :$constituency />
                </div>

                <div x-show="tab === 'hospitals'" x-cloak>
                    <livewire:hospitals :$constituency />
                </div>

                <div x-show="tab === 'schools'" x-cloak>
                    <livewire:schools :$constituency />
                </div>

                <div x-show="tab === 'community-centres'" x-cloak>
                    <livewire:community-centres :$constituency />
                </div>

                <div x-show="tab === 'places-of-worship'" x-cloak>
                    <livewire:places-of-worship :$constituency />
                </div>

                <div x-show="tab === 'local-media'" x-cloak>
                    <livewire:local-media :$constituency />
                </div>

                <div x-show="tab === 'green-spaces'" x-cloak>
                    <livewire:green-spaces :$constituency />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
