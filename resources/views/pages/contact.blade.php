@extends('layouts.app')

@section('title', 'Contact Nestline Closet Studio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
    <div class="grid gap-12 lg:grid-cols-2">
        <div>
            <h1 class="font-display text-4xl font-extrabold text-[color:var(--nl-teal-dark)]">Book a design visit</h1>
            <p class="mt-3 text-[color:var(--nl-slate)]">Tell us about your closets. We typically reply within one business day for Greater Austin appointments.</p>
            <div class="mt-8 space-y-2 text-sm text-[color:var(--nl-ink)]">
                <p>{{ $brand['address'] }}</p>
                <p>{{ $brand['phone'] }} · {{ $brand['email'] }}</p>
                <p>{{ $brand['service_area'] }}</p>
            </div>
        </div>
        <div class="bg-white/80 p-6 shadow-sm ring-1 ring-[color:var(--nl-ink)]/8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-[color:var(--nl-soft)] px-4 py-3 text-sm text-[color:var(--nl-teal-dark)]">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-medium">Name</label>
                    <input name="name" value="{{ old('name') }}" required class="mt-1 w-full border border-[color:var(--nl-ink)]/15 bg-white px-3 py-2">
                    @error('name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full border border-[color:var(--nl-ink)]/15 bg-white px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Phone</label>
                        <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full border border-[color:var(--nl-ink)]/15 bg-white px-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium">Subject</label>
                    <input name="subject" value="{{ old('subject') }}" class="mt-1 w-full border border-[color:var(--nl-ink)]/15 bg-white px-3 py-2">
                </div>
                <div>
                    <label class="text-sm font-medium">Message</label>
                    <textarea name="message" rows="5" required class="mt-1 w-full border border-[color:var(--nl-ink)]/15 bg-white px-3 py-2">{{ old('message') }}</textarea>
                </div>
                <button class="rounded-full bg-[color:var(--nl-teal)] px-6 py-3 text-sm font-semibold text-white">Send message</button>
            </form>
        </div>
    </div>
</section>
@endsection
