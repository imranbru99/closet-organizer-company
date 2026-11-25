@extends('layouts.app')

@section('title', $article->title.' | Knowledge Base')

@section('content')
<article class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
    <a href="{{ route('knowledge') }}" class="text-sm text-[color:var(--nl-teal)]">← Knowledge base</a>
    <h1 class="mt-4 font-display text-4xl font-extrabold text-[color:var(--nl-teal-dark)]">{{ $article->title }}</h1>
    <p class="mt-2 text-xs uppercase tracking-wide text-[color:var(--nl-slate)]">{{ str_replace('-', ' ', $article->category) }}</p>
    <div class="mt-8 whitespace-pre-line text-[color:var(--nl-ink)]">{{ $article->body }}</div>
</article>
@endsection
