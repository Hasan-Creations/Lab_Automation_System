@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-0">Quality Standard Definitions</h2>
        <p class="text-secondary mb-0">Establish and govern laboratory test protocols.</p>
    </div>
    <button class="btn btn-primary d-flex align-items-center gap-2 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addTestTypeModal">
        <i class="fas fa-plus"></i> <span>Define Protocol</span>
    </button>
</div>

<div class="card data-card shadow-sm overflow-hidden" style="border-radius: 16px; border: 1px solid #e2e8f0;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Protocol Code</th>
                    <th>Test Identity</th>
                    <th>Standard Department</th>
                    <th>Criteria Summary</th>
                    <th class="text-end pe-4">Control</th>
                </tr>
            </thead>
            <tbody>
                @forelse($list as $testType)
                <tr>
                    <td class="ps-4"><code>{{ $testType->test_code }}</code></td>
                    <td><span class="fw-bold">{{ $testType->test_name }}</span></td>
                    <td>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3">
                            {{ $testType->department }}
                        </span>
                    </td>
                    <td><small class="text-secondary">{{ substr($testType->criteria, 0, 60) }}...</small></td>
                    <td class="text-end pe-4">
                        <button class="btn btn-sm btn-light border" title="Edit Protocol"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted small">No standards defined yet. Click "Define Protocol" to start.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Test Type Modal -->
<div class="modal fade" id="addTestTypeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <form method="POST" action="{{ route('admin.test-types.store') }}">
                @csrf
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold mb-0">New Quality Protocol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Internal Reference Code</label>
                            <input type="text" class="form-control" name="test_code" placeholder="e.g. VIS-01" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Department</label>
                            <select class="form-select" name="department" required>
                                @foreach($depts as $dept)
                                <option value="{{ $dept->name }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Test Nomenclature</label>
                            <input type="text" class="form-control" name="test_name" placeholder="Visual Integrity Inspection" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Protocol Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Brief summary of the test's purpose..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Governance Criteria</label>
                            <textarea class="form-control" name="criteria" rows="3" placeholder="Specific technical requirements to pass..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Register Standard</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection