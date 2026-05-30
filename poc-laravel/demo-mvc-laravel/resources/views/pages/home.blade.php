@extends('layouts.app')

@section('content')
    <div class="page-container space-y-10">
        {{-- Hero section keeps the landing page clean and dealership-focused. --}}
        <section class="site-card overflow-hidden">
            <div class="grid gap-8 px-6 py-10 lg:grid-cols-[1.2fr_0.8fr] lg:px-10 lg:py-14">
                <div class="space-y-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-500">Premium Pre-Owned Dealership</p>
                    <h1 class="section-title max-w-2xl">Drive home with confidence from a dealership built around trust, detail, and service.</h1>
                    <p class="section-copy max-w-2xl">
                        Northstar Auto Gallery is a fictional dealership created for this Laravel MVC demo. The site keeps the experience
                        polished and simple while showing how controllers, views, and JSON-backed models can work together.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('vehicles.index') }}" class="button-primary">Browse Inventory</a>
                        <a href="{{ route('about') }}" class="button-secondary">Learn About Us</a>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-3 lg:grid-cols-1">
                    <div class="stat-card">
                        <p class="text-3xl font-semibold text-slate-900">25</p>
                        <p class="mt-2 text-sm text-slate-600">Vehicles loaded from a local JSON file.</p>
                    </div>
                    <div class="stat-card">
                        <p class="text-3xl font-semibold text-slate-900">5</p>
                        <p class="mt-2 text-sm text-slate-600">Vehicles per inventory page with Laravel pagination.</p>
                    </div>
                    <div class="stat-card">
                        <p class="text-3xl font-semibold text-slate-900">1</p>
                        <p class="mt-2 text-sm text-slate-600">Inquiry form flow that writes straight to JSON.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-3">
            @foreach ($featuredVehicles as $vehicle)
                {{-- Featured cards pull a few recent vehicles into the homepage. --}}
                <article class="vehicle-card" data-vehicle-card>
                    <div class="mb-4 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Featured</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-900">{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}</h2>
                        </div>
                        <p class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">${{ number_format($vehicle['price']) }}</p>
                    </div>
                    <div class="space-y-2 text-sm text-slate-600">
                        <p>Mileage: {{ number_format($vehicle['mileage']) }} miles</p>
                        <p>Transmission: {{ $vehicle['transmission'] }}</p>
                        <p>Fuel Type: {{ $vehicle['fuel_type'] }}</p>
                    </div>
                    <a href="{{ route('vehicles.show', $vehicle['id']) }}" class="mt-6 inline-flex text-sm font-semibold text-slate-900 hover:text-slate-600">
                        View details
                    </a>
                </article>
            @endforeach
        </section>
    </div>
@endsection