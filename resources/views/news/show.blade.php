@extends('layouts.app')

@section('title', $item->page_title)
@section('meta_description', $item->page_description)

@section('content')
<section class="page-hero">
    <div class="container-site">
        <span class="badge">{{ $item->category }}</span>
        <h1 class="section-title mt-3">{{ $item->title }}</h1>
        <p>{{ $item->item_date->format('d F Y') }}</p>
    </div>
</section>
<article class="container-site article">
    <img class="cover" src="{{ $item->image_url }}" alt="{{ $item->title }}">
    <p class="lead">{{ $item->short_description }}</p>
    <div class="content">{!! $item->content !!}</div>
    <a class="btn-ghost mt-4" href="{{ route('news-events.index') }}">Back to diary</a>
</article>
@if ($related->isNotEmpty())
<section class="section section-soft">
    <div class="container-site">
        <h2 class="section-title">More from campus</h2>
        <div class="card-grid">
            @foreach ($related as $other)
                <a class="photo-card" href="{{ route('news-events.show', $other->slug) }}">
                    <img src="{{ $other->image_url }}" alt="{{ $other->title }}">
                    <div class="body">
                        <div class="event-meta">{{ $other->category }}</div>
                        <h4>{{ $other->title }}</h4>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
