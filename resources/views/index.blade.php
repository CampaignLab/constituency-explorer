<x-layouts.base class="bg-gradient-to-tr from-[#FE6F08] to-[#FF2E79]">
    <header class="py-6">
        <nav class="w-full px-24 flex items-center justify-between">
            <a href="{{ route('index') }}" class="font-medium text-white text-xl tracking-tight">
                <x-logo class="h-10 w-auto" />
            </a>

            <div class="flex items-center gap-x-2.5">
                <button
                    type="button"
                    class="appearance-none text-white font-medium text-lg hover:bg-white/20 px-4 py-2 rounded-lg transition-colors ease-in-out duration-200"
                    x-on:click="modal = 'about'"
                >
                    About
                </button>

                <button type="button" class="appearance-none text-white font-medium text-lg hover:bg-white/20 px-4 py-2 rounded-lg transition-colors ease-in-out duration-200" x-on:click="modal = 'download'">
                    Download
                </button>
            </div>
        </nav>
    </header>

    <div class="px-24 py-12 flex items-center gap-x-24">
        <x-index-map class="w-[600px] h-auto" />

        <div>
            <x-logo />

            <p class="text-white text-4xl font-medium mt-12">
                A tool to help you run local<br>campaigns with local data.
            </p>
            
            <button type="button" x-on:click="$dispatch('search-palette')" class="bg-white w-max px-4 py-2.5 inline-block text-xl font-semibold tracking-tight mt-8 rounded-lg">
                <div class="bg-gradient-to-tr from-[#FE6F08] to-[#FF2E79] bg-clip-text">
                    <p class="text-transparent">Search for a constituency</p>
                </div>
            </button>
        </div>
    </div>

    <div class="bg-white mt-12 px-24 py-24">
        <div>
            <h2 class="text-4xl font-semibold tracking-tight">
                Data Download
            </h2>

            <div class="max-w-6xl">
                <p class="text-lg mt-8">Lorem ipsum odor amet, consectetuer adipiscing elit. Sapien fermentum natoque ut; penatibus sollicitudin libero. Arcu parturient sem augue diam; curae fusce eget dapibus. Maximus curae bibendum lacus id metus conubia. Cras finibus et congue ultricies pulvinar odio. Sit egestas litora aliquet tempus libero augue pretium. Pretium inceptos porttitor ante, auctor torquent nostra himenaeos dignissim. Dolor feugiat vestibulum habitant elit in.</p>

                <p class="mt-8 text-lg">Primis in ut risus tellus eget, blandit mi. Quam blandit libero aptent maximus ullamcorper penatibus sollicitudin et. Vehicula mus diam integer inceptos efficitur etiam. Laoreet ad fringilla maecenas vulputate lacus tortor venenatis accumsan. Netus nisl fermentum sem turpis ac non elit himenaeos. Maecenas quisque vitae pharetra leo netus. Aliquet viverra ultricies vitae netus dis aenean. Luctus vestibulum lorem diam enim primis curabitur dapibus ac. Cras finibus hac volutpat efficitur quis ultrices nisi suspendisse phasellus.</p>
            </div>

            <div class="flex flex-col max-w-[600px] border-y border-neutral-300 divide-y divide-neutral-300 mt-8">
                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituency to single Local Authority
                        </p>

                        <p class="text-sm text-neutral-600 font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.constituency-with-highest-overlaps') }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituency to all Local Authorities
                        </p>

                        <p class="text-sm text-neutral-600 font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.all-la') }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </a>
                </div>

                <div class="py-4 px-4 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="font-semibold">
                            Constituency to all Old Constituencies
                        </p>

                        <p class="text-sm text-neutral-600 font-medium uppercase">
                            CSV
                        </p>
                    </div>

                    <a href="{{ route('exports.all-pcon23') }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <livewire:search-palette />
</x-layouts.base>
