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
        <h2 class="fw-bold mb-1">Laboratory Command Center</h2>
        <p class="text-secondary mb-0 small">Real-time operational overview and testing analytics.</p>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="px-3 py-2 bg-white border rounded-3 small fw-bold shadow-sm">
            <i class="fas fa-calendar-alt me-2 text-primary"></i> {{ now()->format('F d, Y') }}
        </div>
        <div class="px-3 py-2 bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-3 small fw-bold">
            <i class="fas fa-signal me-2"></i> System Online
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card-modern p-4 border-top border-1 border-primary border-opacity-50">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3" style="width: 42px; height: 42px;">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="text-technical">Active Batches</div>
            </div>
            <div class="h2 fw-bold mb-0">{{ $info['active_batches'] }}</div>
            <div class="mt-2 small text-muted">Currently in system</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 border-top border-1 border-warning border-opacity-50">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-3" style="width: 42px; height: 42px;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="text-technical">Awaiting Review</div>
            </div>
            <div class="h2 fw-bold mb-0">{{ $info['pending_review'] }}</div>
            <div class="mt-2 small text-muted">Verification queue</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 border-top border-1 border-danger border-opacity-50">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-3" style="width: 42px; height: 42px;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="text-technical">Failed Results</div>
            </div>
            <div class="h2 fw-bold mb-0">{{ $info['failed_cycles'] }}</div>
            <div class="mt-2 small text-muted">NCR revisions active</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 border-top border-1 border-info border-opacity-50">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="icon-box bg-info bg-opacity-10 text-info rounded-3" style="width: 42px; height: 42px;">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="text-technical">External Logs</div>
            </div>
            <div class="h2 fw-bold mb-0">{{ $info['external_queue'] }}</div>
            <div class="mt-2 small text-muted">CPRI registry queue</div>
        </div>
    </div>
</div>

<div class="card-modern overflow-hidden">
    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Laboratory Activity Feed</h5>
        <button class="btn btn-light btn-sm fw-bold border text-technical">
            <i class="fas fa-download me-1"></i> Export Log
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr class="text-technical">
                    <th class="ps-4 py-3">Batch Identity</th>
                    <th class="py-3">Procedure</th>
                    <th class="py-3">Lead Inspector</th>
                    <th class="py-3 text-center">Outcome</th>
                    <th class="text-end pe-4 py-3">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recent as $activity)
                <tr>
                    <td class="ps-4">
                        <span class="fw-bold text-dark">{{ $activity->revision->batch->batch_code }}</span>
                        <span class="text-muted small ms-1">Rev. {{ $activity->revision->revision_number }}</span>
                    </td>
                    <td>{{ $activity->testType->test_name }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.7rem; font-weight: 700;">
                                {{ substr($activity->tester_name, 0, 2) }}
                            </div>
                            <span class="small fw-medium">{{ $activity->tester_name }}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        @if($activity->result == 'PASS')
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 rounded-2 small fw-bold">
                                <i class="fas fa-check-circle me-1"></i> PASS
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-3 py-2 rounded-2 small fw-bold">
                                <i class="fas fa-times-circle me-1"></i> FAIL
                            </span>
                        @endif
                    </td>
                    <td class="text-end pe-4 text-secondary small fw-medium">
                        {{ $activity->tested_at->diffForHumans() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection