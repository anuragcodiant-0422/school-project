<?php

namespace App\Jobs;

use App\Models\AdmissionEnquiry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class PushEnquiryToCrm implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 20;

    public function __construct(public AdmissionEnquiry $enquiry) {}

    public function backoff(): array
    {
        return [10, 30, 60];
    }

    public function handle(): void
    {
        $url = config('services.crm.webhook_url');

        // if (! $url) {
        //     $this->enquiry->update([
        //         'crm_status' => 'failed',
        //         'crm_response' => 'CRM_WEBHOOK_URL is not configured.',
        //     ]);

        //     Log::warning('CRM webhook skipped: URL missing.', [
        //         'enquiry_id' => $this->enquiry->id,
        //     ]);

        //     return;
        // }

        // try {
        //     $response = Http::timeout(5)
        //         ->acceptJson()
        //         ->asJson()
        //         ->post($url, [
        //             'enquiry_id' => $this->enquiry->id,
        //             'parent_name' => $this->enquiry->parent_name,
        //             'student_name' => $this->enquiry->student_name,
        //             'class_applying_for' => $this->enquiry->class_applying_for,
        //             'mobile' => $this->enquiry->mobile,
        //             'email' => $this->enquiry->email,
        //             'message' => $this->enquiry->message,
        //             'submitted_at' => $this->enquiry->created_at?->toIso8601String(),
        //             'source' => 'school-website',
        //         ]);

        //     if ($response->successful()) {
        //         $this->enquiry->update([
        //             'crm_status' => 'sent',
        //             'crm_response' => mb_substr($response->body(), 0, 2000),
        //         ]);

        //         return;
        //     }

            // Log::error('CRM webhook returned an error response.', [
            //     'enquiry_id' => $this->enquiry->id,
            //     'status' => $response->status(),
            //     'body' => $response->body(),
            // ]);

        //    throw new \RuntimeException('CRM webhook failed with HTTP '.$response->status());
        // } catch (Throwable $exception) {
        //     Log::error('CRM webhook request failed.', [
        //         'enquiry_id' => $this->enquiry->id,
        //         'error' => $exception->getMessage(),
        //     ]);

        //     throw $exception;
        // }
    }

    public function failed(?Throwable $exception): void
    {
        $this->enquiry->update([
            'crm_status' => 'failed',
            'crm_response' => mb_substr($exception?->getMessage() ?: 'Unknown CRM failure', 0, 2000),
        ]);
    }
}
