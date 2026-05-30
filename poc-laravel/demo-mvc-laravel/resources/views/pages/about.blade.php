@extends('layouts.app')

@section('content')
    <div class="page-container">
        <section class="site-card px-6 py-10 lg:px-10 lg:py-14">
            {{-- Dummy dealership content so the about page feels realistic. --}}
            <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr]">
                <div class="space-y-4">
                    <p class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-500">About Northstar Auto Gallery</p>
                    <h1 class="section-title">A neighborhood dealership with a showroom mindset.</h1>
                    <p class="section-copy">
                        Founded in this demo as a family-owned dealership, Northstar Auto Gallery focuses on premium pre-owned vehicles,
                        honest pricing, and a low-pressure buying process. Every vehicle is presented with clear details so shoppers know
                        exactly what they are considering.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="stat-card">
                        <h2 class="text-lg font-semibold text-slate-900">What we value</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Transparency, clean presentation, and consistent follow-up from the first inquiry to delivery day.</p>
                    </div>
                    <div class="stat-card">
                        <h2 class="text-lg font-semibold text-slate-900">Who we serve</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Drivers looking for dependable daily commuters, well-kept family SUVs, and luxury sedans with documented history.</p>
                    </div>
                    <div class="stat-card sm:col-span-2">
                        <h2 class="text-lg font-semibold text-slate-900">Our process</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            This demo dealership starts with curated inventory, highlights useful specs, and lets shoppers submit a vehicle-specific
                            inquiry form. In a production system that would hit a database, but here it is intentionally writing to JSON so you can
                            focus on understanding the Laravel MVC flow.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection