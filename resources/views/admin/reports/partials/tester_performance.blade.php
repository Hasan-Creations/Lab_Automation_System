<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Analyst Name</th>
                <th>Primary Department</th>
                <th>Tests Logged</th>
                <th>Batches Handled</th>
                <th class="text-end pe-4">Activity Index</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr>
                <td class="ps-4 fw-bold text-dark">{{ $row->tester->full_name }}</td>
                <td><span class="badge bg-info bg-opacity-10 text-info px-3">{{ $row->tester->dept->name ?? 'N/A' }}</span></td>
                <td>{{ $row->total_tests }}</td>
                <td>{{ $row->unique_revisions }}</td>
                <td class="text-end pe-4">
                    <span class="badge bg-light text-primary border px-3">
                        {{ round($row->total_tests / max($row->unique_revisions, 1), 1) }} tests/batch
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted small">No performance data found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>