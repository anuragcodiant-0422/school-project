<?php

use App\Http\Controllers\Api\NewsEventApiController;
use Illuminate\Support\Facades\Route;

Route::get('/news-events', [NewsEventApiController::class, 'index'])->name('api.news-events.index');
Route::get('/news-events/{slug}', [NewsEventApiController::class, 'show'])->name('api.news-events.show');
