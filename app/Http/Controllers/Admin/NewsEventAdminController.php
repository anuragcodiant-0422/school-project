<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsEventRequest;
use App\Http\Requests\UpdateNewsEventRequest;
use App\Models\NewsEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class NewsEventAdminController extends Controller
{
    public function index(Request $request): View
    {
        $items = NewsEvent::query()
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->orderByDesc('item_date')
            ->paginate(5)
            ->withQueryString();

        return view('admin.news.index', [
            'items' => $items,
            'categories' => NewsEvent::CATEGORIES,
        ]);
    }

    public function create(): View
    {
        return view('admin.news.form', [
            'item' => new NewsEvent(['is_published' => true, 'item_date' => now()]),
            'categories' => NewsEvent::CATEGORIES,
        ]);
    }

    public function store(StoreNewsEventRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['is_published'] = $request->boolean('is_published');
        $data['slug'] = NewsEvent::uniqueSlug($data['title']);
        $data['image'] = $this->storeImage($request->file('image'));

        NewsEvent::query()->create($data);

        return redirect()
            ->route('admin.news-events.index')
            ->with('success', 'News / event created successfully.');
    }

    public function edit(NewsEvent $news_event): View
    {
        return view('admin.news.form', [
            'item' => $news_event,
            'categories' => NewsEvent::CATEGORIES,
        ]);
    }

    public function update(UpdateNewsEventRequest $request, NewsEvent $news_event): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['is_published'] = $request->boolean('is_published');
        $data['slug'] = NewsEvent::uniqueSlug($data['title'], $news_event->id);
        $oldImage = $news_event->image;
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $this->storeImage($request->file('image'));
            $data['image'] = $newImage;
        }

        $news_event->update($data);

        if ($newImage && $oldImage && ! str_starts_with($oldImage, 'http')) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.news-events.index')
            ->with('success', 'News / event updated successfully.');
    }

    public function destroy(NewsEvent $news_event): RedirectResponse
    {
        if ($news_event->image && ! str_starts_with($news_event->image, 'http')) {
            Storage::disk('public')->delete($news_event->image);
        }

        $news_event->delete();

        return redirect()
            ->route('admin.news-events.index')
            ->with('success', 'Item deleted.');
    }

    private function storeImage(UploadedFile $image): string
    {
        $path = $image->store('news-events', 'public');

        if (! $path) {
            throw new RuntimeException('The uploaded image could not be saved.');
        }

        return $path;
    }
}
