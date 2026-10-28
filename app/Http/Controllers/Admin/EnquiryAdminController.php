<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEnquiryStatusRequest;
use App\Models\AdmissionEnquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EnquiryAdminController extends Controller
{
    public function index(Request $request): View
    {
        $enquiries = $this->filteredQuery($request)
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.enquiries.index', [
            'enquiries' => $enquiries,
            'statuses' => AdmissionEnquiry::STATUSES,
        ]);
    }

    public function updateStatus(UpdateEnquiryStatusRequest $request, AdmissionEnquiry $enquiry): JsonResponse
    {
        $enquiry->update(['status' => $request->validated('status')]);

        return response()->json([
            'message' => 'Status updated.',
            'status' => $enquiry->status,
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        $filename = 'admission-enquiries-'.now()->format('Y-m-d').'.csv';
        $rows = $this->filteredQuery($request)->orderByDesc('created_at')->get();

        return response()->streamDownload(function () use ($rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'ID', 'Parent', 'Student', 'Class', 'Mobile', 'Email', 'Message',
                'Status', 'CRM', 'Submitted at',
            ]);

            foreach ($rows as $row) {
                fputcsv($handle, [
                    $row->id,
                    $row->parent_name,
                    $row->student_name,
                    $row->class_applying_for,
                    $row->mobile,
                    $row->email,
                    $row->message,
                    $row->status,
                    $row->crm_status,
                    $row->created_at,
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    protected function filteredQuery(Request $request)
    {
        $search = trim($request->string('q')->toString());

        return AdmissionEnquiry::query()
            ->when(
                $request->filled('status') && in_array($request->string('status')->toString(), AdmissionEnquiry::STATUSES, true),
                fn ($query) => $query->where('status', $request->string('status'))
            )
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('parent_name', 'like', '%'.$search.'%')
                        ->orWhere('student_name', 'like', '%'.$search.'%')
                        ->orWhere('mobile', 'like', '%'.$search.'%');
                });
            });
    }
}
