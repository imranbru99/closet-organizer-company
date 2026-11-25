@extends('layouts.app')

@section('title', 'Closet Services | Nestline Closet Studio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
    <h1 class="font-display text-4xl font-extrabold text-[color:var(--nl-teal-dark)]">Closet services</h1>
    <p class="mt-3 max-w-2xl text-[color:var(--nl-slate)]">Four focused offerings—each with one job: turn wasted volume into storage that feels intentional.</p>
    <div class="mt-12 grid gap-10 md:grid-cols-2">
        @foreach($services as $slug => $service)
            <a href="{{ route('services.show', $slug) }}" class="group">
                <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" class="h-56 w-full object-cover transition duration-500 group-hover:scale-[1.02]">
                <h2 class="mt-4 font-display text-2xl font-bold">{{ $service['title'] }}</h2>
                <p class="mt-2 text-sm text-[color:var(--nl-slate)]">{{ $service['summary'] }}</p>
            </a>
        @endforeach
    </div>
</section>
@endsection
