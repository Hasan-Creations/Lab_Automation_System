@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Record Search</h2>
            <p class="text-secondary mb-0">Search through historical test results across all batches.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route(Auth::user()->user_type == 'admin' ? 'admin.search' : 'user.search') }}" method="GET"
                class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Keyword</label>
                    <input type="text" name="search" class="form-control" placeholder="Batch code, tester, or test name..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Result</label>
                    <select name="status" class="form-select">
                        <option value="">All Results</option>
                        <option value="PASS" {{ request('status') == 'PASS' ? 'selected' : '' }}>PASS</option>
                        <option value="FAIL" {{ request('status') == 'FAIL' ? 'selected' : '' }}>FAIL</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Batch / Rev</th>
                        <th>Test Name</th>
                        <th>Tester</th>
                        <th>Result</th>
                        <th class="text-end pe-4">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $row)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold text-dark">{{ $row->revision->batch->batch_code }}</span>
                                <div class="small text-primary fw-bold" style="font-size: 0.7rem;">PID:
                                    {{ $row->revision->batch->srs_product_id }}</div>
                                <div class="small text-secondary">{{ $row->revision->revision_number }}</div>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $row->testType->test_name }}</span>
                                <div class="small text-primary fw-bold" style="font-size: 0.7rem;">TID:
                                    {{ $row->test_id ?? 'N/A' }}</div>
                                <div class="small text-secondary">{{ $row->testType->test_code }}</div>
                            </td>
                            <td>{{ $row->tester->full_name }}</td>
                            <td>
                                <span class="badge bg-{{ $row->result == 'PASS' ? 'success' : 'danger' }} px-3">
                                    {{ $row->result }}
                                </span>
                            </td>
                            <td class="text-end pe-4 text-secondary small">
                                {{ $row->tested_at->format('M d, Y') }}<br>
                                {{ $row->tested_at->format('H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No results found matching your criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $list->appends(request()->input())->links() }}
        </div>
    </div>
@endsection