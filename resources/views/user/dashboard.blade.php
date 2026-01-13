@extends('layouts.app')

@section('content')
<div class="row mb-5 align-items-center">
    <div class="col-md-8">
        <h1 class="fw-bold text-dark mb-1">Laboratory Terminal</h1>
        <p class="text-secondary mb-0 small"><i class="fas fa-microscope me-1"></i> Connected to <strong>{{ Auth::user()->dept->name ?? 'Quality Control' }}</strong> Division</p>
    </div>
    <div class="col-md-4 text-end">
        <div class="card-modern d-inline-block p-3 px-4 text-start border-start border-4 border-primary">
            <div class="text-technical mb-1">Session Throughput</div>
            <div class="d-flex align-items-center gap-3">
                <div class="h2 fw-bold mb-0 text-primary">{{ $info['today'] ?? 0 }}</div>
                <div class="small text-muted fw-bold">Verified<br>Today</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card-modern h-100 p-4 action-card border-bottom border-4 border-primary">
            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-4" style="width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-pencil-alt fs-5"></i>
            </div>
            <h5 class="fw-bold mb-2">New Test Entry</h5>
            <p class="text-secondary small mb-4">Initialize a new quality verification procedure for a pending batch.</p>
            <a href="{{ route('user.tests.create') }}" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                <i class="fas fa-plus me-2"></i> Start Procedure
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-modern h-100 p-4 action-card border-bottom border-4 border-success">
            <div class="icon-circle bg-success bg-opacity-10 text-success mb-4" style="width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-database fs-5"></i>
            </div>
            <h5 class="fw-bold mb-2">Archive Search</h5>
            <p class="text-secondary small mb-4">Locate and review historical test data and procedural logs.</p>
            <a href="{{ route('user.search') }}" class="btn btn-outline-primary w-100 py-2 fw-bold">
                <i class="fas fa-search me-2"></i> Access Records
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-modern h-100 p-4 action-card border-bottom border-4 border-info">
            <div class="icon-circle bg-info bg-opacity-10 text-info mb-4" style="width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-wave-square fs-5"></i>
            </div>
            <h5 class="fw-bold mb-2">Batch Monitor</h5>
            <p class="text-secondary small mb-4">Real-time tracking of active batch lifecycles and revision states.</p>
            <a href="{{ route('user.view-status') }}" class="btn btn-outline-primary w-100 py-2 fw-bold">
                <i class="fas fa-eye me-2"></i> Track Live Status
            </a>
        </div>
    </div>
</div>

<div class="card-modern overflow-hidden mt-5">
    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Personal Activity Log</h5>
        <span class="text-technical"><i class="fas fa-history me-1"></i> Sync: Active</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr class="text-technical">
                    <th class="ps-4 py-3 border-0">Batch Reference</th>
                    <th class="py-3 border-0">Procedure Type</th>
                    <th class="py-3 border-0 text-center">Status</th>
                    <th class="text-end pe-4 py-3 border-0">Recorded At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent as $test)
                <tr>
                    <td class="ps-4">
                        <span class="fw-bold text-dark">{{ $test->revision->batch->batch_code }}</span>
                        <span class="text-muted small ms-1">({{ $test->revision->revision_number }})</span>
                    </td>
                    <td>{{ $test->testType->test_name }}</td>
                    <td class="text-center">
                        @if($test->result == 'PASS')
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 rounded-2 small fw-bold">
                                <i class="fas fa-check-circle me-1"></i> PASS
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-3 py-2 rounded-2 small fw-bold">
                                <i class="fas fa-times-circle me-1"></i> FAIL
                            </span>
                        @endif
                    </td>
                    <td class="text-end text-secondary small fw-medium pe-4">{{ $test->tested_at->format('M d, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-2x mb-2 opacity-25"></i>
                        <p class="mb-0">No procedures logged in the current session.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .action-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .action-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection