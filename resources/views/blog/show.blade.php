@extends('layouts.app')

@section('title', $post->title.' | Nestline Closet Studio')

@section('content')
<article class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
    @if($post->cover_image)
        <img src="{{ $post->cover_image }}" alt="" class="mb-8 h-72 w-full object-cover">
    @endif
    <h1 class="font-display text-4xl font-extrabold text-[color:var(--nl-teal-dark)]">{{ $post->title }}</h1>
    <p class="mt-2 text-sm text-[color:var(--nl-slate)]">{{ optional($post->published_at)->format('F j, Y') }}</p>
    <div class="prose mt-8 max-w-none whitespace-pre-line text-[color:var(--nl-ink)]">{{ $post->body }}</div>
</article>
@endsection
