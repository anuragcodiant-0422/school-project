<?php

namespace App\Http\Requests;

use App\Models\AdmissionEnquiry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnquiryStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(AdmissionEnquiry::STATUSES)],
        ];
    }
}
