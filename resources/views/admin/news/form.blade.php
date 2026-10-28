@extends('layouts.admin')

@section('title', $item->exists ? 'Edit item' : 'Add item')

@section('content')
<h1 class="h3 mb-3">{{ $item->exists ? 'Edit news / event' : 'Add news / event' }}</h1>
<div class="admin-card">
    <form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.news-events.update', $item) : route('admin.news-events.store') }}">
        @csrf
        @if ($item->exists)
            @method('PUT')
        @endif
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Title</label>
                <input class="form-control" name="title" value="{{ old('title', $item->title) }}" required>
                @error('title')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Category</label>
                <select class="form-select" name="category" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" @selected(old('category', $item->category) === $category)>{{ $category }}</option>
                    @endforeach
                </select>
                @error('category')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Date</label>
                <input class="form-control" type="date" name="item_date" value="{{ old('item_date', optional($item->item_date)->format('Y-m-d')) }}" required>
                @error('item_date')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-8">
                <label class="form-label">Image (JPG, PNG or WebP, max 2 MB)</label>
                <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
                @error('image')<div class="field-error">{{ $message }}</div>@enderror
                @if ($item->image)
                    <img class="mt-2" src="{{ $item->image_url }}" alt="" style="height:80px;border-radius:10px;object-fit:cover;">
                @endif
            </div>
            <div class="col-12">
                <label class="form-label">Short description</label>
                <textarea class="form-control" name="short_description" rows="2" required>{{ old('short_description', $item->short_description) }}</textarea>
                @error('short_description')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="8" required>{{ old('content', $item->content) }}</textarea>
                @error('content')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Page title (optional)</label>
                <input class="form-control" name="meta_title" value="{{ old('meta_title', $item->meta_title) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Meta description (optional)</label>
                <input class="form-control" name="meta_description" value="{{ old('meta_description', $item->meta_description) }}">
            </div>
            <div class="col-12">
                <label>
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item->is_published))>
                    Published
                </label>
            </div>
        </div>
        <button class="btn-main mt-3" type="submit">Save</button>
        <a class="btn-ghost mt-3" href="{{ route('admin.news-events.index') }}">Cancel</a>
    </form>
</div>
@endsection
