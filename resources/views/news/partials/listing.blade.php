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
