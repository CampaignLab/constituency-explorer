<x-layouts.app>
    <div class="bg-primary-light-blue-background flex-1">
        <div class="px-6 md:px-10 2xl:px-24 h-[300px] md:h-[600px] flex flex-col justify-center relative">
            <div>
                <div>
                    <div class="flex items-center gap-x-6">
                        <x-icon class="size-[60px]" />
                        <p class="font-bold text-2xl">
                            Constituency<br>
                            Explorer
                        </p>
                    </div>

                    <p class="text-lg font-medium mt-5">
                        A tool to help you run local campaigns<br>
                        with local data.
                    </p>
                </div>
            </div>

            <livewire:search-palette />

            <x-index-map class="absolute inset-y-0 hidden md:block right-0 lg:right-1/5 z-10 lg:translate-x-1/5 2xl:right-1/3 2xl:translate-x-1/3 h-full" />
        </div>
    </div>

    <div class="py-12 px-6 md:px-10 2xl:px-24 bg-white">
        <div>
            <x-constituency.subheading>
                Data Download
            </x-constituency.subheading>

            <div class="max-w-4xl text-sm mt-6 space-y-4">
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Sapien fermentum natoque ut; penatibus sollicitudin libero. Arcu parturient sem augue diam; curae fusce eget dapibus. Maximus curae bibendum lacus id metus conubia. Cras finibus et congue ultricies pulvinar odio. Sit egestas litora aliquet tempus libero augue pretium. Pretium inceptos porttitor ante, auctor torquent nostra himenaeos dignissim. Dolor feugiat vestibulum habitant elit in.</p>
                <p>Primis in ut risus tellus eget, blandit mi. Quam blandit libero aptent maximus ullamcorper penatibus sollicitudin et. Vehicula mus diam integer inceptos efficitur etiam. Laoreet ad fringilla maecenas vulputate lacus tortor venenatis accumsan. Netus nisl fermentum sem turpis ac non elit himenaeos. Maecenas quisque vitae pharetra leo netus. Aliquet viverra ultricies vitae netus dis aenean. Luctus vestibulum lorem diam enim primis curabitur dapibus ac. Cras finibus hac volutpat efficitur quis ultrices nisi suspendisse phasellus.</p>
            </div>

            <div class="flex flex-col max-w-[600px] border-y border-primary-border divide-y divide-primary-border mt-6 text-sm">
                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituency to single Local Authority
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.constituency-with-highest-overlaps') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituency to all Local Authorities
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.all-la') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituency to all Old Constituencies
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.all-pcon23') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            All Towns
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.constituency-towns') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            All Schools
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.constituency-schools') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            All Hospitals
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.constituency-hospitals') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            All Dentists
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.constituency-dentists') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            All Charities
                        </p>

                        <p class="text-xs text-muted-foreground font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="https://search.charitybase.uk/chc?download=f" target="_blank">
                        <x-icons.download />
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
