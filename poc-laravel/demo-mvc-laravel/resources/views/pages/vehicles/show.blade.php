@extends('layouts.app')

@section('content')
    <div class="page-container space-y-8">
        <section class="site-card px-6 py-10 lg:px-10 lg:py-14">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="space-y-6">
                    {{-- The detail area explains one vehicle and keeps the specs visible. --}}
                    <div class="flex flex-wrap items-center gap-3 text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">
                        <span>{{ $vehicle['body_style'] }}</span>
                        <span class="h-1 w-1 rounded-full bg-slate-400"></span>
                        <span>Stock #{{ str_pad($vehicle['id'], 4, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <h1 class="section-title">{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}</h1>
                            <p class="mt-3 text-lg text-slate-600">{{ $vehicle['summary'] }}</p>
                        </div>
                        <p class="rounded-full bg-slate-900 px-5 py-3 text-lg font-semibold text-white">${{ number_format($vehicle['price']) }}</p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        <div class="stat-card"><p class="text-sm text-slate-500">Mileage</p><p class="mt-2 text-lg font-semibold text-slate-900">{{ number_format($vehicle['mileage']) }} miles</p></div>
                        <div class="stat-card"><p class="text-sm text-slate-500">Exterior</p><p class="mt-2 text-lg font-semibold text-slate-900">{{ $vehicle['color'] }}</p></div>
                        <div class="stat-card"><p class="text-sm text-slate-500">Transmission</p><p class="mt-2 text-lg font-semibold text-slate-900">{{ $vehicle['transmission'] }}</p></div>
                        <div class="stat-card"><p class="text-sm text-slate-500">Fuel Type</p><p class="mt-2 text-lg font-semibold text-slate-900">{{ $vehicle['fuel_type'] }}</p></div>
                        <div class="stat-card"><p class="text-sm text-slate-500">Drive Type</p><p class="mt-2 text-lg font-semibold text-slate-900">{{ $vehicle['drive_type'] }}</p></div>
                        <div class="stat-card"><p class="text-sm text-slate-500">VIN</p><p class="mt-2 text-lg font-semibold text-slate-900">{{ $vehicle['vin'] }}</p></div>
                    </div>
                </div>

                <div class="site-card border-slate-200 px-6 py-6 shadow-none">
                    {{-- The inquiry form posts back to Laravel and stores the entry in JSON. --}}
                    <h2 class="text-2xl font-semibold text-slate-900">Send an inquiry</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Submit this form to save a vehicle inquiry into public/formSubmission.json.</p>

                    @if (session('status'))
                        <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            Please fix the form fields and submit again.
                        </div>
                    @endif

                    <form action="{{ route('vehicles.inquiry.store', $vehicle['id']) }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="field-input" required>
                        </div>
                        <div>
                            <label for="contact" class="mb-2 block text-sm font-semibold text-slate-700">Contact</label>
                            <input id="contact" name="contact" type="text" value="{{ old('contact') }}" class="field-input" required>
                        </div>
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="field-input" required>
                        </div>
                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label for="message" class="block text-sm font-semibold text-slate-700">Message</label>
                                <span class="text-xs text-slate-500"><span data-message-count>0</span>/1000</span>
                            </div>
                            <textarea id="message" name="message" rows="5" class="field-input" data-message-input required>{{ old('message', 'I would like to know more about this vehicle.') }}</textarea>
                        </div>
                        <button type="submit" class="button-primary w-full">Send vehicle inquiry</button>
                    </form>
                </div>
            </div>
        </section>

        <section>
            <h2 class="mb-4 text-2xl font-semibold text-slate-900">You may also like</h2>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($relatedVehicles as $relatedVehicle)
                    <article class="vehicle-card" data-vehicle-card>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $relatedVehicle['body_style'] }}</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $relatedVehicle['year'] }} {{ $relatedVehicle['make'] }} {{ $relatedVehicle['model'] }}</h3>
                        <p class="mt-3 text-sm text-slate-600">${{ number_format($relatedVehicle['price']) }} • {{ number_format($relatedVehicle['mileage']) }} miles</p>
                        <a href="{{ route('vehicles.show', $relatedVehicle['id']) }}" class="mt-5 inline-flex text-sm font-semibold text-slate-900 hover:text-slate-600">View details</a>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@endsection