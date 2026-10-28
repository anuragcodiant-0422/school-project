@extends('layouts.app')

@section('title', 'News & Events | '.config('school.name'))
@section('meta_description', 'Latest news, school events and student achievements from The Manthan School, Noida.')

@section('content')
<section class="page-hero">
    <div class="container-site center">
        <p class="kicker white">The Event Diary</p>
        <h1 class="section-title">News, events & achievements</h1>
        <p>Filter by category or open any story for the full update.</p>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <div class="filter-row">
            <a class="{{ $category === '' ? 'active' : '' }}" href="{{ route('news-events.index') }}">All</a>
            @foreach ($categories as $cat)
                <a class="{{ $category === $cat ? 'active' : '' }}" href="{{ route('news-events.index', ['category' => $cat]) }}">{{ $cat }}</a>
            @endforeach
        </div>
        <div class="card-grid">
            @forelse ($items as $item)
                <a class="photo-card" href="{{ route('news-events.show', $item->slug) }}">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                    <div class="body">
                        <div class="event-meta">{{ $item->category }} · {{ $item->item_date->format('d M Y') }}</div>
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->short_description }}</p>
                    </div>
                </a>
            @empty
                <p>No published items in this category yet.</p>
            @endforelse
        </div>
        <div class="mt-4 d-flex justify-content-center">{{ $items->links() }}</div>
    </div>
</section>
@endsection
