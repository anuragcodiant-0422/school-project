<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\View\View;

class NewsEventController extends Controller
{
    public function index(Request $request): View|HttpResponse
    {
        $category = $request->string('category')->toString();

        $items = NewsEvent::query()
            ->published()
            ->when(
                $category && in_array($category, NewsEvent::CATEGORIES, true),
                fn ($query) => $query->where('category', $category)
            )
            ->orderByDesc('item_date')
            ->orderByDesc('id')
            ->paginate(6)
            ->withQueryString();

        $data = [
            'items' => $items,
            'category' => $category,
            'categories' => NewsEvent::CATEGORIES,
        ];

        if ($request->ajax()) {
            return response()->view('news.partials.listing', $data);
        }

        return view('news.index', $data);
    }

    public function show(string $slug): View
    {
        $item = NewsEvent::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $related = NewsEvent::query()
            ->published()
            ->where('id', '!=', $item->id)
            ->orderByDesc('item_date')
            ->limit(3)
            ->get();

        return view('news.show', compact('item', 'related'));
    }
}
