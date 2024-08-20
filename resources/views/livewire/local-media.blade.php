<div>
<div class="flex items-start justify-between">
        <div class="flex items-center gap-x-4">
            <x-constituency.subheading id="local-media">
                Local Media
            </x-constituency.subheading>

            <x-constituency.counter>
                {{ $constituency->localMedia->count() }}
            </x-constituency.counter>
        </div>

        <x-input type="search" wire:model.live.debounce.500ms="search" placeholder="Search by name..." />
    </div>

    <x-constituency.download-data-link :href="route('constituency.export', ['constituency' => $constituency, 'export' => 'local-media'])" target="_blank" class="mt-6" />

    <div class="mt-6 space-y-6">
        @foreach ($this->localMedia as $localMedia)
            <button x-data="{ open: false }" type="button"
                class="border border-primary-border p-5 rounded-lg text-sm block w-full text-left transition-colors ease-in-out duration-150"
                x-on:click="open = !open"
                x-bind:class="{
                    'bg-primary-slate/50': open,
                }">
                <div class="flex flex-col gap-y-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="lg:w-1/2">
                        <p class="font-bold">
                            {{ $localMedia->name }}
                        </p>

                        @if($address = $localMedia->formattedAddress())
                            <div class="flex items-start gap-x-1 mt-2.5">
                                <x-icons.location class="mt-px flex-shrink-0" />

                                <p>
                                    {{ $address }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 grid gap-y-4 grid-cols-2 lg:grid-cols-3 gap-x-6">
                        <div class="space-y-2.5">
                            <p>
                                Type of Owner
                            </p>

                            <p class="font-bold">
                                {{ $localMedia->type_of_owner ?? App\mdash() }}
                            </p>
                        </div>

                        <div class="space-y-2.5">
                            <p>
                                Frequency
                            </p>

                            <p class="font-bold">
                                {{ $localMedia->frequency ?? App\mdash() }}
                            </p>
                        </div>

                        <div class="space-y-2.5">
                            <p>
                                Media Type
                            </p>

                            <p class="font-bold">
                                {{ $localMedia->media_type ?? App\mdash() }}
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
                                    Cost
                                </p>

                                <p class="font-bold">
                                    {{ $localMedia->cost ?? App\mdash() }}
                                </p>
                            </div>

                            <div class="space-y-2.5">
                                <p>
                                    Twitter
                                </p>

                                <p class="font-bold">
                                    {{ $localMedia->twitter ?? App\mdash() }}
                                </p>
                            </div>

                            <div class="space-y-2.5">
                                <p>
                                    Website
                                </p>

                                <p class="font-bold break-words">
                                    {{ $localMedia->website ?? App\mdash() }}
                                </p>
                            </div>
                        </div>

                        <div class="w-2.5 h-1.5"></div>
                    </div>
                </div>
            </button>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $this->localMedia->links(data: ['scrollTo' => '#local-media']) }}
    </div>
</div>
