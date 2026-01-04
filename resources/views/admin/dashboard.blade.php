@extends('layouts.app')

@section('content')
<style>
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="display-font fw-bold mb-0" style="letter-spacing: -0.03em;">Laboratory Overview</h2>
        <p class="text-secondary mb-0">Operational metrics and real-time batch analytics.</p>
    </div>
    <div class="badge bg-white text-dark border p-2 px-4 shadow-sm rounded-pill font-monospace">
        <i class="fas fa-clock me-2 text-primary opacity-75"></i> {{ now()->format('l, d M Y') }}
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card-modern p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-layer-group"></i>
                </div>
                <span class="badge bg-primary bg-opacity-10 text-primary fw-medium px-3">Total</span>
            </div>
            <div class="text-secondary small fw-medium mb-1">Batches Registered</div>
            <div class="h2 fw-bold mb-0 display-font">{{ $info['active_batches'] }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="icon-box bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-microscope"></i>
                </div>
                <span class="text-secondary small fw-medium">Queue</span>
            </div>
            <div class="text-secondary small fw-medium mb-1">Pending Testing</div>
            <div class="h2 fw-bold mb-0 display-font text-warning">{{ $info['pending_review'] }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 border-danger border-opacity-10">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="icon-box bg-danger bg-opacity-10 text-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-3">Failed</span>
            </div>
            <div class="text-secondary small fw-medium mb-1">NCR Revisions</div>
            <div class="h2 fw-bold mb-0 display-font text-danger">{{ $info['failed_cycles'] }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 border-info border-opacity-10">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="icon-box bg-info bg-opacity-10 text-info">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <span class="text-info small fw-bold">Active</span>
            </div>
            <div class="text-secondary small fw-medium mb-1">CPRI Registry</div>
            <div class="h2 fw-bold mb-0 display-font text-info">{{ $info['external_queue'] }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
    <div class="card-header bg-white p-4 border-0">
        <h5 class="fw-bold mb-0 display-font" style="letter-spacing: -0.01em;">Recent Laboratory Activity</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light bg-opacity-50">
                <tr class="small text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <th class="ps-4 fw-semibold py-3">Batch Reference</th>
                    <th class="fw-semibold py-3">Test Type</th>
                    <th class="fw-semibold py-3">Quality Inspector</th>
                    <th class="fw-semibold py-3">Outcome</th>
                    <th class="text-end pe-4 fw-semibold py-3">Completed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recent as $activity)
                <tr>
                    <td class="ps-4">
                        <span class="fw-bold">{{ $activity->revision->batch->batch_code }}</span>
                        <small class="text-muted ms-1">({{ $activity->revision->revision_number }})</small>
                    </td>
                    <td>{{ $activity->testType->test_name }}</td>
                    <td>
                        <span class="badge bg-light text-dark border fw-normal px-2">
                            {{ $activity->tester_name }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $activity->result == 'PASS' ? 'success' : 'danger' }} rounded-pill px-3">
                            {{ $activity->result }}
                        </span>
                    </td>
                    <td class="text-end pe-4 text-secondary small">
                        {{ $activity->tested_at->diffForHumans() }}
                    </td>
                </tr>
                @endforeach
                @if($recent->isEmpty())
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="fas fa-info-circle mb-2 d-block fa-2x opacity-25"></i>
                        No testing activity recorded in the current cycle.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection