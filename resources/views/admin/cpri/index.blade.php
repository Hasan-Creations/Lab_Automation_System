@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">External Submission Portal</h2>
        <p class="text-secondary mb-0">Management of CPRI (Central Power Research Institute) tracking for approved revisions.</p>
    </div>
</div>

<div class="row g-4">
    {{-- Submission Form --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">New External Submission</h5>
                <form action="{{ route('admin.cpri.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Target Approved Batch</label>
                        <select name="batch_revision_id" class="form-select" required>
                            <option value="">Select a batch...</option>
                            @foreach($ready as $revision)
                            <option value="{{ $revision->id }}">
                                {{ $revision->batch->batch_code }} ({{ $revision->revision_number }}) - {{ $revision->batch->productType->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Formal Remarks</label>
                        <textarea name="remarks" class="form-control" rows="3" placeholder="Reference notes for the submission portal..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                        Execute Submission
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Submissions List --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Identifier / Rev</th>
                            <th>Sub. Date</th>
                            <th>Portal Status</th>
                            <th>External Ref</th>
                            <th class="text-end pe-4">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $submission)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold">{{ $submission->revision->batch->batch_code }}</span>
                                <div class="small text-secondary">
                                    {{ $submission->revision->revision_number }} &bull; {{ $submission->revision->batch->productType->name }}
                                </div>
                            </td>
                            <td>{{ $submission->submission_date->format('M d, Y') }}</td>
                            <td>
                                @php
                                $c_status = $submission->status;
                                $c_color = 'warning';
                                if ($c_status == 'approved') {
                                $c_color = 'success';
                                } else if ($c_status == 'rejected') {
                                $c_color = 'danger';
                                }
                                @endphp
                                <span class="badge bg-{{ $c_color }} px-3 py-2 rounded-pill">
                                    {{ ucfirst($c_status) }}
                                </span>
                            </td>
                            <td>
                                <code class="small text-primary fw-bold">
                                    {{ $submission->cpri_reference ?? 'Awaiting Reference' }}
                                </code>
                            </td>
                            <td class="text-end pe-4">
                                @if($submission->status == 'pending')
                                <button class="btn btn-sm btn-outline-primary px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#updateModal{{ $submission->id }}">
                                    Update Outcome
                                </button>
                                @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1 border border-secondary border-opacity-25" style="font-size: 0.7rem;">
                                    <i class="fas fa-lock me-1"></i> FINALIZED
                                </span>
                                @endif
                            </td>
                        </tr>

                        <!-- Update Status Modal -->
                        <div class="modal fade" id="updateModal{{ $submission->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="{{ route('admin.cpri.update', $submission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content border-0 rounded-4 shadow-lg">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Update Tracking Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="mb-4 text-center bg-light p-3 rounded-4">
                                                <h6 class="fw-bold mb-1">{{ $submission->revision->batch->batch_code }}</h6>
                                                <small class="text-secondary">Revision {{ $submission->revision->revision_number }}</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-bold text-secondary">Final Outcome Selection</label>
                                                <div class="alert alert-warning small p-2 mb-3 border-0" style="font-size: 0.75rem;">
                                                    <i class="fas fa-exclamation-triangle me-1"></i> <strong>Critical:</strong> Setting this outcome is <strong>permanent</strong>. It cannot be reversed or edited once saved.
                                                </div>
                                                <select name="status" class="form-select border-warning" required>
                                                    <option value="" disabled selected>Select final status...</option>
                                                    <option value="approved">Final Approval</option>
                                                    <option value="rejected">Formal Rejection</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-bold text-secondary">CPRI Reference Number</label>
                                                <input type="text" name="cpri_reference" class="form-control" value="{{ $submission->cpri_reference }}" placeholder="e.g. CPRI/CERT/2025/101">
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-link text-secondary text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-4 rounded-pill">Save Outcome</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-light mb-3 d-block"></i>
                                <span class="text-muted">No external submissions have been recorded yet.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection