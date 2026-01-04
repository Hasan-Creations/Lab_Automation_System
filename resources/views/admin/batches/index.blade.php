@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Batch Management</h2>
        <p class="text-secondary mb-0">Define batches and monitor their lifecycle.</p>
    </div>
    <button class="btn btn-primary px-4 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#createBatchModal">
        <i class="fas fa-plus me-2"></i>New Batch
    </button>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Batch Code</th>
                    <th>Product Type</th>
                    <th>Quantity</th>
                    <th>Revision</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($list as $batch)
                <tr>
                    <td class="ps-4">
                        <span class="fw-bold text-dark">{{ $batch->batch_code }}</span>
                        <div class="small text-secondary">Mfg: {{ $batch->manufacturing_number ?? 'N/A' }}</div>
                    </td>
                    <td><span class="badge bg-secondary bg-opacity-10 text-secondary px-3">{{ $batch->productType->name }}</span></td>
                    <td>{{ $batch->quantity }} units</td>
                    <td><span class="badge bg-info bg-opacity-10 text-info px-3">{{ $batch->currentRevision->revision_number ?? 'N/A' }}</span></td>
                    <td>
                        @php
                        $rev = $batch->currentRevision;
                        $color = 'secondary';
                        $label = 'Pending';

                        if ($rev != null) {
                        $label = str_replace('_', ' ', $rev->status);

                        if ($rev->status == 'APPROVED' || $rev->status == 'CPRI_APPROVED') {
                        $color = 'success';
                        } else if ($rev->status == 'FAILED' || $rev->status == 'CPRI_REJECTED') {
                        $color = 'danger';
                        } else if ($rev->status == 'CPRI_PENDING') {
                        $color = 'info';
                        } else {
                        $color = 'warning';
                        }
                        }
                        @endphp
                        <span class="badge bg-{{ $color }} px-3 py-2 rounded-pill">
                            {{ $label }}
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('admin.batches.show', $batch->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                <i class="fas fa-eye me-1"></i> Details
                            </a>
                            @if($batch->currentRevision && ($batch->currentRevision->status == 'FAILED' || $batch->currentRevision->status == 'CPRI_REJECTED'))
                            <form action="{{ route('admin.batches.remake', $batch->id) }}" method="POST" class="d-inline ms-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Send for remaking? This will increment revision.')">
                                    <i class="fas fa-redo me-1"></i> Remake
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No batches registered yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">
        {{ $list->links() }}
    </div>
</div>

<!-- Create Batch Modal -->
<div class="modal fade" id="createBatchModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4 shadow">
            <form action="{{ route('admin.batches.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Register New Batch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase" style="letter-spacing: 0.05em;">Manufacturing Product ID (Master ID)</label>
                        <input type="text" name="product_id" class="form-control font-monospace border-primary border-opacity-25" placeholder="e.g. 1020304050" maxlength="10" minlength="10" required>
                        <div class="form-text small">Enter the unique 10-digit code provided by the manufacturing unit.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Batch Code</label>
                        <input type="text" name="batch_code" class="form-control" placeholder="e.g. BATCH-2025-001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Product Type</label>
                        <select name="product_type_id" class="form-select" required>
                            <option value="">Select Product Type</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Mfg Number</label>
                            <input type="text" name="manufacturing_number" class="form-control" placeholder="M-1234">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Create Batch (Initial R01)</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection