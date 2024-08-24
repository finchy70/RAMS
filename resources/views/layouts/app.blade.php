<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
{{--        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/my.css') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Scripts -->
{{--        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>--}}
{{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}
        <script src="{{asset('/js/trix.js')}}"></script>
        <script src="{{ asset('js/attachments.js') }}"></script>
        @livewireStyles
        @yield('scripts')
    </head>
    <body class="font-sans antialiased bg-gray-50">
        @include('layouts.navigation')
        <x-notification></x-notification>
        <div>
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-6 sm:px-6 lg:px-8">
                    {{ $header ?? '' }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-6 sm:px-6 lg:px-8">
                <div>
                    {{ $slot }}
                </div>
            </main>
        </div>
    @livewireScripts
    </body>
</html>
