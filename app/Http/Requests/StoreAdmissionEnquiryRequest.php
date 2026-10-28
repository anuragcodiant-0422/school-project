<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmissionEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_name' => ['required', 'string', 'max:120'],
            'student_name' => ['required', 'string', 'max:120'],
            'class_applying_for' => ['required', 'string', 'in:'.implode(',', config('school.classes'))],
            'mobile' => ['required', 'string', 'regex:/^[6-9][0-9]{9}$/'],
            'email' => ['nullable', 'email', 'max:150'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'mobile.regex' => 'Enter a valid 10-digit Indian mobile number starting with 6, 7, 8 or 9.',
            'class_applying_for.in' => 'Please choose a valid class.',
        ];
    }

    public function attributes(): array
    {
        return [
            'parent_name' => 'parent name',
            'student_name' => 'student name',
            'class_applying_for' => 'class applying for',
        ];
    }
}
