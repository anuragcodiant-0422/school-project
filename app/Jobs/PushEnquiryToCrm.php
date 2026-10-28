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
        $apiKey = config('services.crm.api_key');
        info('Pushing enquiry to CRM', [
            'enquiry_id' => $this->enquiry->id,
            'url' => $url,
        ]);

        if (! $url || ! $apiKey) {
            $missingSetting = ! $url ? 'CRM_WEBHOOK_URL' : 'HUBSPOT_API_KEY';
            $this->enquiry->update([
                'crm_status' => 'failed',
                'crm_response' => $missingSetting.' is not configured.',
            ]);

            Log::warning('HubSpot contact sync skipped: configuration missing.', [
                'enquiry_id' => $this->enquiry->id,
                'setting' => $missingSetting,
            ]);

            return;
        }

        try {
            $parentName = preg_split('/\s+/', trim($this->enquiry->parent_name), 2);
            $properties = array_filter([
                'firstname' => $parentName[0] ?? '',
                'lastname' => $parentName[1] ?? '',
                'email' => $this->enquiry->email,
                'phone' => $this->enquiry->mobile,
            ], static fn (?string $value): bool => $value !== null && $value !== '');

            $response = Http::withToken($apiKey)
                ->timeout(5)
                ->acceptJson()
                ->asJson()
                ->post($url, ['properties' => $properties]);

            if ($response->successful()) {
                info('CRM webhook request successful.', [
                    'enquiry_id' => $this->enquiry->id,
                    'response' => $response->json(),
                ]);

                $this->enquiry->update([
                    'crm_status' => 'sent',
                    'crm_response' => mb_substr((string) $response->json('id'), 0, 2000),
                ]);

                return;
            }

            Log::error('CRM webhook returned an error response.', [
                'enquiry_id' => $this->enquiry->id,
                'status' => $response->status(),
            ]);

            throw new \RuntimeException('HubSpot contact sync failed with HTTP '.$response->status());
        } catch (Throwable $exception) {
            Log::error('HubSpot contact sync request failed.', [
                'enquiry_id' => $this->enquiry->id,
                'error' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }

    public function failed(?Throwable $exception): void
    {
        $this->enquiry->update([
            'crm_status' => 'failed',
            'crm_response' => mb_substr($exception?->getMessage() ?: 'Unknown CRM failure', 0, 2000),
        ]);
    }
}
