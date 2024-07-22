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
        <script defer src="https://unpkg.com/@alpinejs/collapse@3.14.1/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.14.1/dist/cdn.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 p-5 prose">

        <div class="flex flex-col space-y-4">

            <div>
                <h1>{{$constituency->name}}</h1>

                <section class="bg-white p-4 border">
                    <ul>
                        @foreach ($constituency->getAttributes() as $key => $value)
                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <div>
                <h2>Local Authorities</h2>

                @foreach ($constituency->localAuthorities as $localAuthority)
                <section class="bg-white p-4 mb-4 border">

                    <h3 class="mt-0">{{$localAuthority->name}}</h3>

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


            <div>
                <h2>Charities</h2>
                <section x-data class="bg-white p-4 mb-4 border">
                @foreach ($constituency->charities as $charity)
                    <x-disclosure-accordion title="{{$charity->name}}">
                        <ul>
                            @foreach ($charity->getAttributes() as $key => $value)
                                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </x-disclosure-accordion>
                @endforeach
            </section>
            </div>

        </div>
    </body>
</html>
