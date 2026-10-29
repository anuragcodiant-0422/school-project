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
                        <select class="status-select" data-id="{{ $enquiry->id }}" data-original-status="{{ $enquiry->status }}">
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
                <tr><td colspan="6">No enquiries found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $enquiries->links() }}
