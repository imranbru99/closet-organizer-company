@extends('layouts.app')

@section('title', 'Journal | Nestline Closet Studio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
    <h1 class="font-display text-4xl font-extrabold text-[color:var(--nl-teal-dark)]">Nestline journal</h1>
    <p class="mt-3 text-[color:var(--nl-slate)]">Guides and ideas for closet organization that lasts.</p>
    <div class="mt-10 grid gap-8 md:grid-cols-3">
        @foreach($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}">
                @if($post->cover_image)
                    <img src="{{ $post->cover_image }}" alt="" class="h-44 w-full object-cover">
                @endif
                <h2 class="mt-3 font-display text-xl font-bold">{{ $post->title }}</h2>
                <p class="mt-1 text-sm text-[color:var(--nl-slate)]">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>
    <div class="mt-10">{{ $posts->links() }}</div>
</section>
@endsection
