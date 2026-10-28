<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AdmissionEnquiry extends Model
{
    public const STATUSES = ['new', 'contacted', 'closed'];

    public const CRM_STATUSES = ['pending', 'sent', 'failed'];

    protected $fillable = [
        'parent_name',
        'student_name',
        'class_applying_for',
        'mobile',
        'email',
        'message',
        'status',
        'crm_status',
        'crm_response',
    ];

    public function scopeDuplicateWithinDay(Builder $query, string $mobile, string $class): Builder
    {
        return $query
            ->where('mobile', $mobile)
            ->where('class_applying_for', $class)
            ->where('created_at', '>=', now()->subDay());
    }
}
