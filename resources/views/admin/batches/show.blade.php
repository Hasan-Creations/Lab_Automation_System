@extends('layouts.app')

@section('content')
<div class="mb-5">
    <a href="{{ route('admin.batches.index') }}" class="btn btn-light btn-sm mb-3">
        <i class="fas fa-arrow-left me-1"></i> Back to Batches
    </a>

    <div class="d-flex justify-content-between align-items-end">
        <div>
            <span class="badge bg-primary px-3 mb-2 fw-medium">
                {{ $item->productType->name }}
            </span>

            <h2 class="mb-1" style="font-weight: 600; letter-spacing: -0.02em;">
                Batch History
                <span class="text-muted">· {{ $item->batch_code }}</span>
            </h2>

            <p class="text-muted small mb-0">
                Record of revisions and associated test cycles
            </p>
        </div>

        <div class="text-end">
            <div style="font-weight: 500;">
                Quantity: {{ $item->quantity }} units
            </div>
            <p class="text-muted small mb-0">
                Created {{ $item->created_at->format('M d, Y') }}
            </p>
        </div>
    </div>
</div>

@foreach($item->revisions as $revision)
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1" style="font-weight: 600; letter-spacing: -0.015em;">
                Revision {{ $revision->revision_number }}
            </h5>
            <small class="text-muted">
                Started by {{ $revision->creator->full_name ?? 'System' }},
                {{ $revision->created_at->format('M d, H:i') }}
            </small>
        </div>

        @php
        $color = 'warning';
        if ($revision->status == 'APPROVED' || $revision->status == 'CPRI_APPROVED') {
        $color = 'success';
        } else if ($revision->status == 'FAILED' || $revision->status == 'CPRI_REJECTED') {
        $color = 'danger';
        } else if ($revision->status == 'CPRI_PENDING') {
        $color = 'info';
        }
        @endphp

        <span class="badge bg-{{ $color }} px-4 py-2 fw-medium">
            {{ str_replace('_', ' ', $revision->status) }}
        </span>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="bg-light bg-opacity-50">
                <tr class="small text-muted">
                    <th class="ps-4 fw-normal">Test Type</th>
                    <th class="fw-normal">Tester</th>
                    <th class="fw-normal">Department</th>
                    <th class="fw-normal">Result</th>
                    <th class="fw-normal">Observed Value</th>
                    <th class="text-end pe-4 fw-normal">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($revision->testResults as $result)
                <tr>
                    <td class="ps-4">
                        <div style="font-weight: 500;">
                            {{ $result->testType->test_name }}
                        </div>
                        <div class="small text-muted">
                            {{ $result->testType->test_code }}
                        </div>
                    </td>

                    <td>{{ $result->tester->full_name }}</td>

                    <td>
                        <span class="badge bg-light text-dark border fw-normal">
                            {{ $result->tester->department }}
                        </span>
                    </td>

                    <td>
                        <span class="badge bg-{{ $result->result == 'PASS' ? 'success' : 'danger' }} px-3 fw-medium">
                            {{ $result->result }}
                        </span>
                    </td>

                    <td>
                        <div class="small text-muted text-truncate" style="max-width: 200px;" title="{{ $result->observed_value }}">
                            {{ $result->observed_value ?? 'N/A' }}
                        </div>
                    </td>

                    <td class="text-end pe-4 small text-muted">
                        {{ $result->tested_at->format('M d, H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted small">
                        No tests logged for this revision
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($revision->status == 'FAILED' && $revision->failed_at)
    <div class="p-4" style="background: #fffafa; border-top: 1px solid #fee2e2;">
        <div class="d-flex align-items-start gap-4">
            <div class="p-3 bg-danger bg-opacity-10 rounded-4">
                <i class="fas fa-microscope text-danger"></i>
            </div>

            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-danger" style="font-weight: 600;">
                        Failure Diagnostics
                    </h6>
                    <span class="badge bg-danger bg-opacity-10 text-danger border fw-normal px-3 py-2">
                        Log #{{ $revision->id }}-F
                    </span>
                </div>

                <div class="p-3 bg-white border border-danger border-opacity-10 rounded-3">
                    <p class="mb-0 text-muted small">
                        This revision failed automated verification on
                        <span class="text-dark fw-medium">{{ $revision->failed_at->format('M d, Y') }}</span>
                        at
                        <span class="text-dark fw-medium">{{ $revision->failed_at->format('H:i') }}</span>.
                        Remanufacturing of all units is required.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endforeach
@endsection