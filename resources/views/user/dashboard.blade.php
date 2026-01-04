@extends('layouts.app')

@section('content')
<div class="row mb-5 align-items-end">
    <div class="col-md-8">
        <h1 class="fw-bold text-dark mb-1 display-font" style="letter-spacing: -0.03em;">Tester Console</h1>
        <p class="text-secondary fs-6 mb-0">{{ Auth::user()->dept->name ?? 'Quality Control' }} Department Yard</p>
    </div>
    <div class="col-md-4 text-end">
        <div class="card-modern d-inline-block p-3 px-4 text-start" style="min-width: 200px; border-left: 4px solid var(--bs-primary);">
            <div class="small fw-medium text-secondary text-uppercase mb-1" style="letter-spacing: 0.05em; font-size: 0.7rem;">Session Activity</div>
            <div class="d-flex align-items-center gap-3">
                <div class="h2 fw-bold mb-0 display-font text-primary">{{ $info['today'] ?? 0 }}</div>
                <div class="small text-muted leading-tight">Tests Verified<br>Today</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card-modern h-100 p-4 border-0">
            <div class="icon-circle bg-primary bg-opacity-10 text-primary mb-4 p-3 rounded-4 d-inline-flex">
                <i class="fas fa-file-signature fa-2xl"></i>
            </div>
            <h5 class="fw-bold display-font">Record Results</h5>
            <p class="text-secondary small mb-4">Log pass/fail metrics for batches pending verification in your yard.</p>
            <a href="{{ route('user.tests.create') }}" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Start Test Entry</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-modern h-100 p-4 border-0">
            <div class="icon-circle bg-success bg-opacity-10 text-success mb-4 p-3 rounded-4 d-inline-flex">
                <i class="fas fa-clipboard-list fa-2xl"></i>
            </div>
            <h5 class="fw-bold display-font">Audit History</h5>
            <p class="text-secondary small mb-4">Access detailed logs and historical records for all past revisions.</p>
            <a href="{{ route('user.search') }}" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold">Open Records</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-modern h-100 p-4 border-0">
            <div class="icon-circle bg-info bg-opacity-10 text-info mb-4 p-3 rounded-4 d-inline-flex">
                <i class="fas fa-layer-group fa-2xl"></i>
            </div>
            <h5 class="fw-bold display-font">Batch Tracker</h5>
            <p class="text-secondary small mb-4">Investigate real-time status and lifecycle progress of active batches.</p>
            <a href="{{ route('user.view-status') }}" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold">Track Status</a>
        </div>
    </div>
</div>

<div class="card-modern overflow-hidden mt-5">
    <div class="card-header bg-white p-4 border-0">
        <h4 class="fw-bold mb-0 display-font" style="letter-spacing: -0.01em;">My Recent Activity</h4>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light bg-opacity-50">
                <tr class="small text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <th class="ps-4 py-3 fw-semibold">Batch Identity</th>
                    <th class="py-3 fw-semibold">Test Performed</th>
                    <th class="py-3 fw-semibold text-center">Outcome</th>
                    <th class="text-end pe-4 py-3 fw-semibold">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent as $test)
                <tr>
                    <td><strong>{{ $test->revision->batch->batch_code }}</strong> <small class="text-muted">({{ $test->revision->revision_number }})</small></td>
                    <td>{{ $test->testType->test_name }}</td>
                    <td>
                        <span class="badge bg-{{ $test->result == 'PASS' ? 'success' : 'danger' }} px-3">
                            {{ $test->result }}
                        </span>
                    </td>
                    <td class="text-end text-secondary small">{{ $test->tested_at->format('M d, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No tests recorded in your session yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>

<style>
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-card {
        transition: transform 0.2s;
    }

    .action-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection