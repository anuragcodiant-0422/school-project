<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdmissionEnquiryRequest;
use App\Jobs\PushEnquiryToCrm;
use App\Mail\NewEnquiryAlert;
use App\Models\AdmissionEnquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AdmissionEnquiryController extends Controller
{
    public function store(StoreAdmissionEnquiryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $duplicate = AdmissionEnquiry::query()
            ->duplicateWithinDay($data['mobile'], $data['class_applying_for'])
            ->exists();

        if ($duplicate) {
            return response()->json([
                'message' => 'We have already received your enquiry.',
            ], 409);
        }

        $enquiry = AdmissionEnquiry::query()->create([
            ...$data,
            'status' => 'new',
            'crm_status' => 'pending',
        ]);

      //  PushEnquiryToCrm::dispatch($enquiry);

        try {
            Mail::to(config('school.admissions_email'))->queue(new NewEnquiryAlert($enquiry));
        } catch (Throwable $exception) {
            Log::error('Admission enquiry email could not be queued.', [
                'enquiry_id' => $enquiry->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'message' => 'Thank you. Our admissions team will contact you shortly.',
        ], 201);
    }
}
