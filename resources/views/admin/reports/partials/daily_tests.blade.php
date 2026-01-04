<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th>Timestamp</th>
                <th>Batch Code</th>
                <th>Rev</th>
                <th>Test Type</th>
                <th>Analyst</th>
                <th>Verdict</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr>
                <td><small>{{ $row->tested_at->format('M d, H:i') }}</small></td>
                <td><span class="fw-bold text-dark">{{ $row->revision->batch->batch_code }}</span></td>
                <td><span class="badge bg-light text-dark border">{{ $row->revision->revision_number }}</span></td>
                <td>{{ $row->testType->test_name }}</td>
                <td>{{ $row->tester->full_name }}</td>
                <td>
                    <span class="badge bg-{{ $row->result == 'PASS' ? 'success' : 'danger' }} px-3">
                        {{ $row->result }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted small">No records found for the specified period.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>