<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Northstar Auto Gallery' }}</title>

        {{-- Vite compiles the shared CSS and jQuery-powered JavaScript. --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="site-shell">
            {{-- Shared site navigation so each page stays consistent. --}}
            <header class="border-b border-white/60 bg-white/80 backdrop-blur">
                <div class="page-container flex flex-wrap items-center justify-between gap-4 py-4">
                    <a href="{{ route('home') }}" class="text-lg font-semibold tracking-[0.2em] text-slate-900 uppercase">
                        Northstar Auto Gallery
                    </a>

                    <button
                        type="button"
                        class="inline-flex rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 md:hidden"
                        data-nav-toggle
                    >
                        Menu
                    </button>

                    <nav class="hidden w-full md:block md:w-auto" data-nav-menu>
                        <ul class="flex flex-col gap-3 text-sm font-medium text-slate-600 md:flex-row md:items-center md:gap-8">
                            <li><a href="{{ route('home') }}" class="hover:text-slate-900">Home</a></li>
                            <li><a href="{{ route('about') }}" class="hover:text-slate-900">About</a></li>
                            <li><a href="{{ route('vehicles.index') }}" class="hover:text-slate-900">Inventory</a></li>
                        </ul>
                    </nav>
                </div>
            </header>

            <main class="py-10 sm:py-14">
                @yield('content')
            </main>
        </div>
    </body>
</html>