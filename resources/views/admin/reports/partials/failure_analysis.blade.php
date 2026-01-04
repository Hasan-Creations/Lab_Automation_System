<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Test Protocol</th>
                <th>Total Failures</th>
                <th>Primary Failure Reasons</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr>
                <td class="ps-4">
                    <span class="fw-bold">{{ $row->testType->test_name }}</span>
                    <div class="smaller text-secondary">{{ $row->testType->test_code }}</div>
                </td>
                <td><span class="badge bg-danger px-3 py-2 fs-6">{{ $row->total_failures }}</span></td>
                <td>
                    <div class="small text-secondary text-truncate" style="max-width: 400px;" title="{{ $row->common_remarks }}">
                        {{ $row->common_remarks ?? 'No remarks provided.' }}
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-5 text-secondary small">Excellent! No failures recorded in this period.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>