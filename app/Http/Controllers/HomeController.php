<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $latestItems = Schema::hasTable('news_events')
            ? NewsEvent::query()
                ->published()
                ->orderByDesc('item_date')
                ->orderByDesc('id')
                ->limit(3)
                ->get()
            : collect();

        return view('home', compact('latestItems'));
    }
}
