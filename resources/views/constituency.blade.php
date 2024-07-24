<x-layouts.app>
    <div x-data="{ tab: -1 }">
        <div class="bg-white pt-12 px-24 constituency-tabs">
            <h1 class="text-4xl font-bold tracking-tight">
                {{ $constituency->name }}
            </h1>

            <p class="uppercase text-black/50 text-sm mt-4 font-bold tracking-tight">
                Westminster Parliamentary Constituency
            </p>

            <x-tabs.host class="mt-12">
                <x-tabs.tab :i="-1" active>
                    Overview
                </x-tabs.tab>

                <x-tabs.tab :i="0">
                    General
                </x-tabs.tab>

                <x-tabs.tab :i="1">
                    Local Authorities
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

            <div x-show="tab === 0" x-cloak>
                <section class="bg-white p-4 border rounded-md border-neutral-300">
                    <ul class="!mt-0">
                        @foreach ($constituency->getAttributes() as $key => $value)
                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                        @endforeach
                    </ul>
                </section>

                @if($constituency->oldConstituencies->isNotEmpty())
                    <h2>
                        Old Constituency Overlaps
                    </h2>

                    @foreach($constituency->oldConstituencies as $oldConstituency)
                        <x-disclosure-accordion :title="$oldConstituency->name" class="bg-white">
                            <dl class="space-y-1">
                                @foreach($oldConstituency->pivot->getAttributes() as $key => $value)
                                    <div class="space-y-0">
                                        <dt>{{ $key }}</dt>
                                        <dd>{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </x-disclosure-accordion>
                    @endforeach
                @endif
            </div>

            <div x-show="tab === 1" x-cloak>
                @foreach ($constituency->localAuthorities as $localAuthority)
                    <section class="bg-white p-4 mb-4 border border-neutral-300 rounded-md">
                        <h3 class="!mt-0">{{$localAuthority->name}}</h3>
                        @foreach ($localAuthority->getAttributes() as $key => $value)
                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                        @endforeach
                        <h4>Relationship data:</h4>
                        @foreach ($localAuthority->pivot->getAttributes() as $key => $value)
                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                        @endforeach
                    </section>
                @endforeach
            </div>

            <div x-show="tab === 2" x-cloak>
                @foreach ($constituency->towns->sortBy('name', SORT_NATURAL) as $town)
                    <section class="bg-white p-4 mb-4 border border-neutral-300 rounded-md">
                        <h3 class="!my-0">{{ $town->name }}</h3>
                    </section>
                @endforeach
            </div>

            <div x-show="tab === 3" x-cloak>
                @foreach ($constituency->charities->sortBy('name', SORT_NATURAL) as $charity)
                    <x-disclosure-accordion title="{{$charity->name}}" class="bg-white">
                        <ul>
                            @foreach ($charity->getAttributes() as $key => $value)
                                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </x-disclosure-accordion>
                @endforeach
            </div>

            <div x-show="tab === 4" x-cloak>
                @foreach ($constituency->dentists->sortBy('name', SORT_NATURAL) as $dentist)
                    <x-disclosure-accordion title="{{ $dentist->name }}" class="bg-white">
                        <ul>
                            <li><strong>Address:</strong> {{ implode(', ', array_filter($dentist->address)) }}</li>
                        </ul>
                    </x-disclosure-accordion>
                @endforeach
            </div>

            <div x-show="tab === 5" x-cloak>
                @foreach ($constituency->hospitals->sortBy('name', SORT_NATURAL) as $hospital)
                    <x-disclosure-accordion title="{{ $hospital->name }}" class="bg-white">
                        <ul>
                            <li><strong>Address:</strong> {{ implode(', ', array_filter($hospital->address)) }}</li>
                        </ul>
                    </x-disclosure-accordion>
                @endforeach
            </div>

            <div x-show="tab === 6" x-cloak>
                @foreach ($constituency->schools->sortBy('name', SORT_NATURAL) as $school)
                    <x-disclosure-accordion title="{{ $school->name }}" class="bg-white">
                        <ul>
                            @foreach($school->getAttributes() as $key => $value)
                                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </x-disclosure-accordion>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
