<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\NewsEvent */
class NewsEventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->category,
            'date' => $this->item_date?->toDateString(),
            'image' => $this->image_url,
            'short_description' => $this->short_description,
            'content' => $this->when($request->route('slug') !== null, $this->content),
            'meta_title' => $this->page_title,
            'meta_description' => $this->page_description,
            'url' => url('/news-events/'.$this->slug),
        ];
    }
}
