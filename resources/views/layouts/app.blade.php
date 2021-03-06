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
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <style>[x-cloak]{ display:none }</style>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased" id="app">
        <div class="min-h-screen bg-gray-50">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="relative pl-64">
                <div class="w-full py-5 mx-auto sm:px-6">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="pl-64">
                {{ $slot }}
            </main>
        </div>
        @livewire('check-user-badges')

        @stack('modals')

        @livewireScripts
    </body>
</html>
