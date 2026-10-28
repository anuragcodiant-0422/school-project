<?php

namespace Tests\Feature;

use App\Jobs\PushEnquiryToCrm;
use App\Models\AdmissionEnquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use RuntimeException;
use Tests\TestCase;

class PushEnquiryToCrmTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.crm.webhook_url' => 'https://api.hubapi.com/crm/v3/objects/contacts',
            'services.crm.api_key' => 'test-hubspot-token',
        ]);
    }

    public function test_it_creates_a_hubspot_contact_using_the_api_token(): void
    {
        Http::fake([
            'api.hubapi.com/*' => Http::response(['id' => 'contact-123'], 201),
        ]);

        $enquiry = $this->createEnquiry();

        (new PushEnquiryToCrm($enquiry))->handle();

        Http::assertSent(fn (Request $request): bool => $request->url() === config('services.crm.webhook_url')
            && $request->hasHeader('Authorization', 'Bearer test-hubspot-token')
            && $request->data() === [
                'properties' => [
                    'firstname' => 'Anura',
                    'lastname' => 'Sharma',
                    'email' => 'parent@example.com',
                    'phone' => '9876543210',
                ],
            ]);

        $this->assertDatabaseHas('admission_enquiries', [
            'id' => $enquiry->id,
            'crm_status' => 'sent',
            'crm_response' => 'contact-123',
        ]);
    }

    public function test_it_marks_the_enquiry_failed_when_hubspot_rejects_the_request(): void
    {
        Http::fake([
            'api.hubapi.com/*' => Http::response(['message' => 'Unauthorized'], 401),
        ]);

        $enquiry = $this->createEnquiry();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('HubSpot contact sync failed with HTTP 401');

        try {
            (new PushEnquiryToCrm($enquiry))->handle();
        } finally {
            $this->assertDatabaseHas('admission_enquiries', [
                'id' => $enquiry->id,
                'crm_status' => 'pending',
            ]);
        }
    }

    public function test_it_skips_the_request_when_the_api_key_is_missing(): void
    {
        config(['services.crm.api_key' => null]);
        Http::fake();

        $enquiry = $this->createEnquiry();

        (new PushEnquiryToCrm($enquiry))->handle();

        Http::assertNothingSent();
        $this->assertDatabaseHas('admission_enquiries', [
            'id' => $enquiry->id,
            'crm_status' => 'failed',
            'crm_response' => 'HUBSPOT_API_KEY is not configured.',
        ]);
    }

    public function test_submitting_an_enquiry_dispatches_the_crm_job(): void
    {
        Queue::fake();
        Mail::fake();

        $response = $this->postJson('/admission-enquiry', [
            'parent_name' => 'Anura Sharma',
            'student_name' => 'Riya Sharma',
            'class_applying_for' => 'Nursery',
            'mobile' => '9876543210',
            'email' => 'parent@example.com',
        ]);

        $response->assertCreated();

        $enquiry = AdmissionEnquiry::query()->firstOrFail();

        Queue::assertPushed(PushEnquiryToCrm::class, fn (PushEnquiryToCrm $job): bool => $job->enquiry->is($enquiry));
    }

    private function createEnquiry(): AdmissionEnquiry
    {
        return AdmissionEnquiry::query()->create([
            'parent_name' => 'Anura Sharma',
            'student_name' => 'Riya Sharma',
            'class_applying_for' => 'Nursery',
            'mobile' => '9876543210',
            'email' => 'parent@example.com',
            'message' => 'Please contact me about admissions.',
        ]);
    }
}
