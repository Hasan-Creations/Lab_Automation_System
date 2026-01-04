@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-0">Test Compliance Mapping</h2>
        <p class="text-secondary mb-0">Assign required tests to product categories and departments.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Add Requirement</h5>
                <form action="{{ route('admin.requirements.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Product Category</label>
                        <select name="product_type_id" class="form-select" required>
                            @foreach($products as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Test Protocol</label>
                        <select name="test_type_id" class="form-select" required>
                            @foreach($tests as $test)
                            <option value="{{ $test->id }}">{{ $test->test_name }} ({{ $test->test_code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Assigning Department</label>
                        <select name="department_id" class="form-select" required>
                            @foreach($depts as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Link Requirement</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        @foreach($products as $type)
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">{{ $type->name }} <span class="badge bg-light text-primary border ms-2">{{ $type->requirements->count() }} Tests Required</span></h5>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="ps-4">Required Test</th>
                            <th>Responsible Department</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($type->requirements as $req)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">{{ $req->testType->test_name }}</div>
                                <code class="smaller">{{ $req->testType->test_code }}</code>
                            </td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1">
                                    {{ $req->department->name }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('admin.requirements.destroy', $req->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Remove this mandatory test?')">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted small">No mandatory tests defined for this category.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection