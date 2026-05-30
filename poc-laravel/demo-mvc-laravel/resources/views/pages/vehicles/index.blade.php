@extends('layouts.app')

@section('content')
    <div class="page-container space-y-8">
        <section class="site-card px-6 py-10 lg:px-10 lg:py-14">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-500">Vehicle Inventory</p>
            <h1 class="section-title mt-4">Browse the current dealership lineup.</h1>
            <p class="section-copy mt-4 max-w-3xl">
                This listing reads directly from public/vehicles.json and uses manual pagination so you can see how Laravel still handles
                the view layer cleanly without a database connection.
            </p>
        </section>

        <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($vehicles as $vehicle)
                {{-- Each card exposes a quick summary and links to the full details page. --}}
                <article class="vehicle-card" data-vehicle-card>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $vehicle['body_style'] }}</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-900">{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}</h2>
                        </div>
                        <p class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">${{ number_format($vehicle['price']) }}</p>
                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-3 text-sm text-slate-600">
                        <p><span class="font-semibold text-slate-800">Mileage:</span> {{ number_format($vehicle['mileage']) }}</p>
                        <p><span class="font-semibold text-slate-800">Color:</span> {{ $vehicle['color'] }}</p>
                        <p><span class="font-semibold text-slate-800">Transmission:</span> {{ $vehicle['transmission'] }}</p>
                        <p><span class="font-semibold text-slate-800">Fuel:</span> {{ $vehicle['fuel_type'] }}</p>
                    </div>

                    <p class="mt-5 text-sm leading-7 text-slate-600">{{ $vehicle['summary'] }}</p>

                    <a href="{{ route('vehicles.show', $vehicle['id']) }}" class="mt-6 inline-flex text-sm font-semibold text-slate-900 hover:text-slate-600">
                        View vehicle details
                    </a>
                </article>
            @endforeach
        </section>

        <section class="site-card px-6 py-5">
            {{-- Laravel renders the page links from the manual paginator object. --}}
            {{ $vehicles->links() }}
        </section>
    </div>
@endsection