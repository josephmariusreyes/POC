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

            {{-- These controls let jQuery filter the vehicles shown on the current page. --}}
            <div class="mt-8 grid gap-4 lg:grid-cols-[1.4fr_0.8fr_auto]" data-vehicle-filter>
                <div>
                    <label for="vehicle-search" class="mb-2 block text-sm font-semibold text-slate-700">Search inventory</label>
                    <input
                        id="vehicle-search"
                        type="text"
                        class="field-input"
                        placeholder="Search by make, model, year, color, or body style"
                        data-filter-search
                    >
                </div>
                <div>
                    <label for="body-style-filter" class="mb-2 block text-sm font-semibold text-slate-700">Body style</label>
                    <select id="body-style-filter" class="field-input" data-filter-style>
                        <option value="">All body styles</option>
                        @foreach ($bodyStyles as $bodyStyle)
                            <option value="{{ strtolower($bodyStyle) }}">{{ $bodyStyle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="self-end">
                    <button type="button" class="button-secondary w-full lg:w-auto" data-filter-reset>Reset filters</button>
                </div>
            </div>

            <p class="mt-4 text-sm text-slate-500" data-filter-summary>
                Showing <span data-filter-visible-count>{{ $vehicles->count() }}</span> of {{ $vehicles->count() }} vehicles on this page.
            </p>
        </section>

        <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3" data-vehicle-results>
            @foreach ($vehicles as $vehicle)
                {{-- Each card exposes a quick summary and links to the full details page. --}}
                <article
                    class="vehicle-card"
                    data-vehicle-card
                    data-filter-text="{{ strtolower(implode(' ', [$vehicle['year'], $vehicle['make'], $vehicle['model'], $vehicle['body_style'], $vehicle['color'], $vehicle['fuel_type'], $vehicle['transmission']])) }}"
                    data-body-style="{{ strtolower($vehicle['body_style']) }}"
                >
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

        <section class="site-card hidden px-6 py-8 text-center" data-filter-empty-state>
            <h2 class="text-2xl font-semibold text-slate-900">No vehicles match the current filters.</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">Try clearing the search or choosing a different body style.</p>
        </section>

        <section class="site-card px-6 py-5">
            {{-- Laravel renders the page links from the manual paginator object. --}}
            {{ $vehicles->links() }}
        </section>
    </div>
@endsection