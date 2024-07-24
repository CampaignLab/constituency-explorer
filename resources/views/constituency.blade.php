<x-layouts.app>
    <div x-data="{ tab: 0 }">
        <div class="bg-white pt-12 px-24 constituency-tabs">
            <h1 class="text-4xl font-bold tracking-tight">
                {{ $constituency->name }}
            </h1>

            <p class="uppercase text-black/50 text-sm mt-4 font-bold tracking-tight">
                Westminster Parliamentary Constituency
            </p>

            <div class="mt-12 flex items-center gap-x-2.5">
                <button type="button" class="constituency-tab constituency-tab-active" x-bind:class="{
                    'constituency-tab-active': tab === 0,
                    'constituency-tab-inactive': tab !== 0
                }" x-on:click="tab = 0">
                    Overview
                </button>

                <button type="button" class="constituency-tab" x-bind:class="{
                    'constituency-tab-active': tab === 1,
                    'constituency-tab-inactive': tab !== 1
                }" x-on:click="tab = 1">
                    Local Authorities
                </button>

                <button type="button" class="constituency-tab" x-bind:class="{
                    'constituency-tab-active': tab === 2,
                    'constituency-tab-inactive': tab !== 2
                }" x-on:click="tab = 2">
                    Towns
                </button>

                <button type="button" class="constituency-tab" x-bind:class="{
                    'constituency-tab-active': tab === 3,
                    'constituency-tab-inactive': tab !== 3
                }" x-on:click="tab = 3">
                    Charities
                </button>

                @if($constituency->dentists->isNotEmpty())
                    <button type="button" class="constituency-tab" x-bind:class="{
                        'constituency-tab-active': tab === 4,
                        'constituency-tab-inactive': tab !== 4
                    }" x-on:click="tab = 4">
                        Dentists
                    </button>
                @endif

                @if($constituency->hospitals->isNotEmpty())
                    <button type="button" class="constituency-tab" x-bind:class="{
                        'constituency-tab-active': tab === 5,
                        'constituency-tab-inactive': tab !== 5
                    }" x-on:click="tab = 5">
                        Hospitals
                    </button>
                @endif

                @if($constituency->schools->isNotEmpty())
                    <button type="button" class="constituency-tab" x-bind:class="{
                        'constituency-tab-active': tab === 6,
                        'constituency-tab-inactive': tab !== 6
                    }" x-on:click="tab = 6">
                        Schools
                    </button>
                @endif
            </div>
        </div>

        <div class="flex flex-col py-12 px-24 [&_div]:prose [&_div]:max-w-none">
            <div x-show="tab === 0">
                <section class="bg-white p-4 border">
                    <ul>
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
                    <section class="bg-white p-4 mb-4 border">
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
                    <section class="bg-white p-4 mb-4 border">
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
