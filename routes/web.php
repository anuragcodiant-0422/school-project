<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EnquiryAdminController;
use App\Http\Controllers\Admin\NewsEventAdminController;
use App\Http\Controllers\AdmissionEnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/news-events', [NewsEventController::class, 'index'])->name('news-events.index');
Route::get('/news-events/{slug}', [NewsEventController::class, 'show'])->name('news-events.show');

Route::post('/admission-enquiry', [AdmissionEnquiryController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('admission-enquiry.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])
            ->middleware('throttle:8,1')
            ->name('login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::redirect('/', '/admin/news-events');

        Route::resource('news-events', NewsEventAdminController::class)
            ->except('show')
            ->parameters(['news-events' => 'news_event']);

        Route::get('enquiries', [EnquiryAdminController::class, 'index'])->name('enquiries.index');
        Route::get('enquiries/export', [EnquiryAdminController::class, 'export'])->name('enquiries.export');
        Route::patch('enquiries/{enquiry}/status', [EnquiryAdminController::class, 'updateStatus'])->name('enquiries.status');
    });
});
