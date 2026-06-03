@extends('layouts.app')

@section('content')
    <div class="page-container space-y-8">
        <section class="site-card px-6 py-10 lg:px-10 lg:py-14">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-500">Inquiry Review</p>
            <h1 class="section-title mt-4">Review saved vehicle inquiries.</h1>
            <p class="section-copy mt-4 max-w-3xl">
                This page reads directly from public/formSubmission.json so you can inspect the leads collected by the demo inquiry form
                without introducing a database.
            </p>
        </section>

        @if ($inquiries->isEmpty())
            <section class="site-card px-6 py-10 text-center lg:px-10">
                <h2 class="text-2xl font-semibold text-slate-900">No inquiries have been saved yet.</h2>
                <p class="mt-3 text-sm leading-7 text-slate-600">Submit the vehicle inquiry form from any details page to populate this review screen.</p>
            </section>
        @else
            <section class="grid gap-6 lg:grid-cols-2">
                @foreach ($inquiries as $inquiry)
                    {{-- Each card shows one saved JSON submission in a readable format. --}}
                    <article class="vehicle-card">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Vehicle inquiry</p>
                                <h2 class="mt-2 text-xl font-semibold text-slate-900">{{ $inquiry['vehicle_name'] }}</h2>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.15em] text-slate-600">
                                {{ \Illuminate\Support\Carbon::parse($inquiry['submitted_at'])->format('M d, Y h:i A') }}
                            </span>
                        </div>

                        <div class="mt-5 grid gap-3 text-sm text-slate-600 sm:grid-cols-2">
                            <p><span class="font-semibold text-slate-800">Name:</span> {{ $inquiry['name'] }}</p>
                            <p><span class="font-semibold text-slate-800">Contact:</span> {{ $inquiry['contact'] }}</p>
                            <p class="sm:col-span-2"><span class="font-semibold text-slate-800">Email:</span> {{ $inquiry['email'] }}</p>
                            <p class="sm:col-span-2"><span class="font-semibold text-slate-800">Message:</span> {{ $inquiry['message'] }}</p>
                        </div>
                    </article>
                @endforeach
            </section>
        @endif
    </div>
@endsection