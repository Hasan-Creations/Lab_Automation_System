@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Batch Lifecyle Tracker</h2>
            <p class="text-secondary">Enter a batch code to view its current testing progress and revision history.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-5">
            <div class="card-body p-4">
                <form action="{{ route(Auth::user()->user_type == 'admin' ? 'admin.view-status' : 'user.view-status') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="batch_code" class="form-control form-control-lg border-0 bg-light px-4" placeholder="Enter Batch Code (e.g. BATCH-2025-001)" value="{{ request('batch_code') }}" required>
                    <button type="submit" class="btn btn-primary px-5 fw-bold">Track Status</button>
                </form>
            </div>
        </div>

        @if(request()->filled('batch_code'))
        @if($batch)
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="p-4 bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-0 text-white">{{ $batch->batch_code }}</h4>
                    <div class="small fw-bold opacity-75">Product ID: {{ $batch->srs_product_id }}</div>
                    <span class="opacity-75">{{ $batch->productType->name }} | {{ $batch->quantity }} Units</span>
                </div>
                <div class="text-end">
                    <span class="badge bg-white text-primary fs-6 px-4 py-2">
                        {{ str_replace('_', ' ', $batch->currentRevision->status) }}
                    </span>
                </div>
            </div>

            <div class="p-4 border-bottom">
                <h6 class="fw-bold text-secondary mb-4">Current Revision: {{ $batch->currentRevision->revision_number }}</h6>
                <div class="d-flex gap-2 flex-wrap">
                    @foreach($batch->productType->requirements as $req)
                    @php
                    $result = $batch->currentRevision->testResults->where('test_type_id', $req->test_type_id)->first();
                    $statusColor = $result ? ($result->result == 'PASS' ? 'success' : 'danger') : 'secondary';
                    $statusIcon = $result ? ($result->result == 'PASS' ? 'check' : 'times') : 'clock';
                    @endphp
                    <div class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} border border-{{ $statusColor }} border-opacity-25 p-3 rounded-4 d-flex align-items-center mb-2 me-2">
                        <i class="fas fa-{{ $statusIcon }} me-2"></i>
                        <div>
                            <div class="small fw-bold">{{ $req->testType->test_name }}</div>
                            <div class="smaller opacity-75">{{ $result ? $result->result : 'Pending' }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="p-4 bg-light">
                <h6 class="fw-bold text-secondary mb-3">Revision Timeline</h6>
                <div class="list-group list-group-flush bg-transparent">
                    @foreach($batch->revisions as $rev)
                    <div class="list-group-item bg-transparent px-0 border-0 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="fw-bold">Revision {{ $rev->revision_number }}</span>
                                <span class="badge bg-{{ $rev->status == 'APPROVED' ? 'success' : ($rev->status == 'FAILED' ? 'danger' : 'info') }} bg-opacity-10 text-{{ $rev->status == 'APPROVED' ? 'success' : ($rev->status == 'FAILED' ? 'danger' : 'info') }} ms-2 px-2 py-1">
                                    {{ $rev->status }}
                                </span>
                            </div>
                            <small class="text-secondary">{{ $rev->created_at->format('M d, Y') }}</small>
                        </div>
                        <p class="small text-secondary mb-0 mt-1">
                            Tests: {{ $rev->testResults->count() }} / {{ $batch->productType->requirements->count() }} completed.
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning border-0 shadow-sm rounded-4 p-4 text-center">
            <i class="fas fa-search-minus fa-3x mb-3 opacity-50"></i>
            <h5 class="fw-bold">Batch Not Found</h5>
            <p class="mb-0">We couldn't find any batch with code <strong>{{ request('batch_code') }}</strong>. Please check and try again.</p>
        </div>
        @endif
        @endif
    </div>
</div>
@endsection