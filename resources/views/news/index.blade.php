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
        <div class="filter-row" id="newsFilters">
            <a class="{{ $category === '' ? 'active' : '' }}" href="{{ route('news-events.index') }}" @if ($category === '') aria-current="true" @endif>All</a>
            @foreach ($categories as $cat)
                <a class="{{ $category === $cat ? 'active' : '' }}" href="{{ route('news-events.index', ['category' => $cat]) }}" @if ($category === $cat) aria-current="true" @endif>{{ $cat }}</a>
            @endforeach
        </div>
        <div id="newsListing" aria-busy="false">
            @include('news.partials.listing', ['items' => $items])
        </div>
        <p id="newsListingStatus" class="news-listing-status" role="status" aria-live="polite" hidden></p>
    </div>
</section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endpush
