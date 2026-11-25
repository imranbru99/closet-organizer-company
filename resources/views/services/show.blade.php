@extends('layouts.app')

@section('title', $service['title'].' | Nestline Closet Studio')

@section('content')
<section class="relative">
    <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" class="h-[42vh] w-full object-cover">
    <div class="absolute inset-0 bg-[color:var(--nl-ink)]/35"></div>
    <div class="absolute inset-x-0 bottom-0 mx-auto max-w-6xl px-4 pb-10 sm:px-6">
        <h1 class="font-display text-4xl font-extrabold text-white sm:text-5xl">{{ $service['title'] }}</h1>
    </div>
</section>
<section class="mx-auto max-w-3xl px-4 py-14 sm:px-6">
    <p class="text-lg text-[color:var(--nl-slate)]">{{ $service['body'] }}</p>
    <a href="{{ route('contact') }}" class="mt-8 inline-flex rounded-full bg-[color:var(--nl-teal)] px-6 py-3 text-sm font-semibold text-white">Request this system</a>
</section>
@endsection
