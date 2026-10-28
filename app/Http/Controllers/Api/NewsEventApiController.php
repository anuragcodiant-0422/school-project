<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsEventResource;
use App\Models\NewsEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsEventApiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
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
            ->paginate(10)
            ->withQueryString();

        return NewsEventResource::collection($items);
    }

    public function show(string $slug): NewsEventResource
    {
        $item = NewsEvent::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return new NewsEventResource($item);
    }
}
