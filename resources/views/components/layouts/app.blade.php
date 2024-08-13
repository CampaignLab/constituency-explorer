<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

        <x-layouts.meta />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <script defer src="https://unpkg.com/@alpinejs/ui@3.14.1-beta.0/dist/cdn.min.js"></script>
        {{-- <script defer src="https://unpkg.com/@alpinejs/collapse@3.14.1/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script> --}}

        <x-bunny-fonts />
        @livewireStyles()
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        class="bg-primary-background flex flex-col min-h-screen"
        x-data="{ modal: null }"
        x-bind:class="{
            'overflow-hidden': modal !== null,
        }"
    >
        <header class="bg-white py-6">
            <nav class="w-full px-24 flex items-center justify-between">
                <a href="{{ route('index') }}" class="font-medium text-black text-xl flex items-center gap-x-6">
                    <x-icon />
                    <p class="font-bold text-sm">Constituency Explorer</p>
                </a>

                <div class="flex items-center gap-x-2.5">
                    <button
                        type="button"
                        class="appearance-none text-black font-medium hover:bg-black/5 px-4 py-2 rounded-lg transition-colors ease-in-out duration-200"
                        x-on:click="modal = 'about'"
                    >
                        About
                    </button>

                    <button type="button" class="appearance-none text-black font-medium hover:bg-black/5 px-4 py-2 rounded-lg transition-colors ease-in-out duration-200" x-on:click="modal = 'download'">
                        Download
                    </button>
                </div>
            </nav>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="bg-white py-6 px-24">
            <p class="text-sm text-neutral-700">Constituency Explorer is a collaborative project between Campaign Lab and C6 Digital.</p>
        </footer>

        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="modal !== null" x-cloak>
            <div
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-show="modal !== null"
            ></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <x-modal id="about" class="max-w-lg">
                        <h3 class="font-semibold tracking-tight text-xl">
                            About
                        </h3>

                        <div class="mt-4 space-y-2.5 text-sm text-neutral-700">
                            <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Proin inceptos dignissim sagittis himenaeos ipsum pulvinar facilisi porttitor? Tempor nec ex nostra pretium aenean eget metus. Orci facilisis malesuada; lacus pulvinar lacinia venenatis. Leo placerat non lacus montes gravida sodales elit ultrices hac. Vehicula aptent hac aliquam, sagittis accumsan risus. Iaculis placerat vivamus convallis rhoncus cursus magnis eu. Maximus primis molestie consectetur orci pretium egestas.</p>

                            <p>Magna lectus maecenas ac enim dignissim hendrerit hendrerit egestas duis. Per eget consectetur proin mus venenatis libero donec imperdiet. Curabitur rutrum tempus class pretium magnis cursus torquent. Eleifend sodales nam taciti netus pulvinar cras purus. Sociosqu quisque nisi laoreet purus elementum pellentesque. Molestie at class dignissim nullam duis odio fermentum. Rhoncus dui ullamcorper natoque ornare natoque diam.</p>
                        </div>
                    </x-modal>

                    <x-modal id="download" class="max-w-lg">
                        <h3 class="font-semibold tracking-tight text-xl">
                            Download
                        </h3>

                        <div class="mt-4 space-y-2.5 text-sm text-neutral-700">
                            <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Proin inceptos dignissim sagittis himenaeos ipsum pulvinar facilisi porttitor? Tempor nec ex nostra pretium aenean eget metus. Orci facilisis malesuada; lacus pulvinar lacinia venenatis. Leo placerat non lacus montes gravida sodales elit ultrices hac. Vehicula aptent hac aliquam, sagittis accumsan risus. Iaculis placerat vivamus convallis rhoncus cursus magnis eu. Maximus primis molestie consectetur orci pretium egestas.</p>

                            <p>Magna lectus maecenas ac enim dignissim hendrerit hendrerit egestas duis. Per eget consectetur proin mus venenatis libero donec imperdiet. Curabitur rutrum tempus class pretium magnis cursus torquent. Eleifend sodales nam taciti netus pulvinar cras purus. Sociosqu quisque nisi laoreet purus elementum pellentesque. Molestie at class dignissim nullam duis odio fermentum. Rhoncus dui ullamcorper natoque ornare natoque diam.</p>
                        </div>
                    </x-modal>
                </div>
            </div>
        </div>

        @livewireScriptConfig()
    </body>
</html>
