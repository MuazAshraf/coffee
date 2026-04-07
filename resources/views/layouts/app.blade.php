<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BrewLog') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|fraunces:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-espresso-700">
        <div class="min-h-screen bg-cream-50 relative">
            <div class="absolute inset-0 bg-noise opacity-[0.18] mix-blend-multiply pointer-events-none"></div>

            @include('layouts.navigation')

            @isset($header)
                <header class="relative bg-cream-100/70 backdrop-blur-md border-b border-cream-200">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="relative">
                @if (session('status') && is_string(session('status')))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
                         x-transition.opacity
                         class="fixed top-6 right-6 z-50 px-5 py-3 rounded-2xl bg-espresso-600 text-cream-50 shadow-2xl border border-espresso-400/50">
                        {{ str_replace('-', ' ', session('status')) }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
