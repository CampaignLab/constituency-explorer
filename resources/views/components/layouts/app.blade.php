<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Constituency Explorer</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=ibm-plex-mono:500,600|poppins:400,600,700" rel="stylesheet" />

        <script defer src="https://unpkg.com/@alpinejs/ui@3.14.1-beta.0/dist/cdn.min.js"></script>
        {{-- <script defer src="https://unpkg.com/@alpinejs/collapse@3.14.1/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script> --}}

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50">
        <header class="bg-red-500 py-4">
            <nav class="w-full px-24 flex items-center justify-between">
                <a href="{{ route('index') }}" class="font-medium text-white text-xl tracking-tight">
                    Constituency Explorer
                </a>

                <livewire:header-search />
            </nav>
        </header>

        <main>
            {{ $slot }}
        </main>
    </body>
</html>
