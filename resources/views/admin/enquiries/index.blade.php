@extends('layouts.admin')

@section('title', 'Enquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Admission enquiries</h1>
    <a class="btn-yellow" href="{{ route('admin.enquiries.export', request()->query()) }}">Export CSV</a>
</div>
<div class="admin-card">
    <form class="row g-2 mb-3" method="GET">
        <div class="col-md-4">
            <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name or mobile">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="status">
                <option value="">All statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn-navy" type="submit">Filter</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Received</th>
                    <th>Parent / Student</th>
                    <th>Class</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th>CRM</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enquiries as $enquiry)
                    <tr>
                        <td>{{ $enquiry->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <strong>{{ $enquiry->parent_name }}</strong>
                            <div>{{ $enquiry->student_name }}</div>
                            <div class="small text-muted">{{ $enquiry->email ?: 'No email' }}</div>
                            @if ($enquiry->message)
                                <div class="small">{{ $enquiry->message }}</div>
                            @endif
                        </td>
                        <td>{{ $enquiry->class_applying_for }}</td>
                        <td>{{ $enquiry->mobile }}</td>
                        <td>
                            <select class="status-select" data-id="{{ $enquiry->id }}">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected($enquiry->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <span class="badge {{ $enquiry->crm_status === 'sent' ? 'bg-success' : ($enquiry->crm_status === 'failed' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                {{ ucfirst($enquiry->crm_status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">No enquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $enquiries->links() }}
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.status-select').forEach((select) => {
    select.addEventListener('change', async () => {
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const response = await fetch(`/admin/enquiries/${select.dataset.id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ status: select.value }),
        });
        if (!response.ok) {
            alert('Could not update status.');
        }
    });
});
</script>
@endpush
