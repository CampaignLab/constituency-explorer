<div>
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-x-4">
            <x-constituency.subheading id="charities">
                Charities
            </x-constituency.subheading>

            <x-constituency.counter>
                {{ $constituency->charities->count() }}
            </x-constituency.counter>
        </div>

        <x-input type="search" wire:model.live.debounce.500ms="search" placeholder="Search by name..." />
    </div>

    {{-- FIXME: Add in Charity search here. --}}

    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'charities'])" target="_blank" class="mt-6" />

    <div class="mt-6 space-y-6">
        @foreach ($this->charities as $charity)
            <button x-data="{ open: false }" type="button"
                class="border border-primary-border p-5 rounded-lg text-sm block w-full text-left transition-colors ease-in-out duration-150"
                x-on:click="open = !open"
                x-bind:class="{
                    'bg-primary-slate/50': open,
                }">
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

                    <x-icons.chevron-down class="transition-transform ease-in-out duration-150 self-end lg:self-auto"
                        x-bind:class="{ 'rotate-180': open }" />
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
                        @if ($charity->website)
                            <div class="flex items-center gap-x-2.5">
                                <x-icons.earth />
                                <a href="{{ $charity->website }}" target="_blank" class="hover:underline">
                                    {{ $charity->website }}
                                </a>
                            </div>
                        @endif

                        @if ($charity->twitter)
                            <div class="flex items-center gap-x-2.5">
                                <x-icons.x />
                                <a href="https://x.com/{{ $charity->twitter }}" target="_blank"
                                    class="hover:underline">
                                    {{ '@' . ltrim($charity->twitter, '@') }}
                                </a>
                            </div>
                        @endif

                        @if ($charity->phone)
                            <div class="flex items-center gap-x-2.5">
                                <x-icons.phone />
                                <a href="tel:{{ $charity->phone }}" target="_blank" class="hover:underline">
                                    {{ $charity->phone }}
                                </a>
                            </div>
                        @endif

                        @if ($charity->instagram)
                            <div class="flex items-center gap-x-2.5">
                                <x-icons.instagram />
                                <a href="https://instagram.com/{{ $charity->instagram }}" target="_blank"
                                    class="hover:underline">
                                    {{ $charity->instagram }}
                                </a>
                            </div>
                        @endif

                        @if ($charity->facebook)
                            <div class="flex items-center gap-x-2.5">
                                <x-icons.facebook />
                                <a href="https://facebook.com/{{ $charity->facebook }}" target="_blank"
                                    class="hover:underline">
                                    {{ $charity->facebook }}
                                </a>
                            </div>
                        @endif

                        @if ($charity->email)
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

    <div class="mt-6">
        {{ $this->charities->links(data: ['scrollTo' => '#charities']) }}
    </div>
</div>
