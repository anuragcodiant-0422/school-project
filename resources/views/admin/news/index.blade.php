@extends('layouts.admin')

@section('title', 'News & Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">News & Events</h1>
    <a class="btn-main" href="{{ route('admin.news-events.create') }}">Add item</a>
</div>
<div class="admin-card">
    <form class="row g-2 mb-3" method="GET">
        <div class="col-md-4">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Published</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td><img class="thumb" src="{{ $item->image_url }}" alt=""></td>
                        <td>
                            <strong>{{ $item->title }}</strong>
                            <div class="text-muted small">{{ $item->slug }}</div>
                        </td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->item_date->format('d M Y') }}</td>
                        <td>{{ $item->is_published ? 'Yes' : 'No' }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.news-events.edit', $item) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.news-events.destroy', $item) }}" onsubmit="return confirm('Delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">No items yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $items->links() }}
</div>
@endsection
