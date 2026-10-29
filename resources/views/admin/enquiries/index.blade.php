@extends('layouts.admin')

@section('title', 'Enquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Admission enquiries</h1>
    <a class="btn-yellow" id="enquiryExport" href="{{ route('admin.enquiries.export', request()->query()) }}">Export CSV</a>
</div>
<div class="admin-card">
    <form class="row g-2 mb-3" id="enquiryFilters" method="GET" action="{{ route('admin.enquiries.index') }}">
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
    <div id="enquiryListing" aria-busy="false">
        @include('admin.enquiries.partials.listing', ['enquiries' => $enquiries, 'statuses' => $statuses])
    </div>
    <p id="enquiryListingStatus" class="enquiry-listing-status" role="status" aria-live="polite" hidden></p>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endpush
