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

            <p>As well as looking up constituencies, you can also download all of the data that is available in this tool, mapped to the new constituencies.</p>

            <div class="flex flex-col max-w-[800px] border-y border-primary-border divide-y divide-primary-border mt-6 text-sm">
                <div class="py-4 px-4 flex items-center justify-between gap-x-12">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituencies mapped to single Local Authority & previous Constituency
                        </p>

                        <p class="text-muted-foreground">Using population overlap to map constituencies to their biggest Local Authority & biggest previous Constituency</p>

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.constituency-with-highest-overlaps') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between gap-x-12">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituencies mapped to all Local Authorities
                        </p>

                        <p class="text-muted-foreground">One row per mapping (e.g. if a constituency has 2 local authorities - then there are 2 rows - 1 for each local authority)</p>

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.all-la') }}" target="_blank">
                        <x-icons.download />
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between gap-x-12">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituencies mapped to all previous constituencies
                        </p>

                        <p class="text-muted-foreground">One row per mapping (e.g. if a constituency has 2 previous constituencies - then there are 2 rows - 1 for each previous constituency)</p>

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
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

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
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

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
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

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
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

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
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

                        <p class="text-xs text-muted-foreground/75 font-medium uppercase">
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
