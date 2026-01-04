<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Product Category</th>
                <th>Total Tests</th>
                <th>Passed</th>
                <th>Failed</th>
                <th>Success Rate</th>
                <th class="pe-4">Health</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            @php
            $rate = $row->total_tests > 0 ? round(($row->passed / $row->total_tests) * 100, 1) : 0;
            @endphp
            <tr>
                <td class="ps-4 fw-bold text-dark">{{ $row->product_type }}</td>
                <td>{{ $row->total_tests }}</td>
                <td class="text-success fw-medium">{{ $row->passed }}</td>
                <td class="text-danger fw-medium">{{ $row->failed }}</td>
                <td>{{ $rate }}%</td>
                <td class="pe-4">
                    <div class="progress" style="height: 6px; width: 100px;">
                        @php
                        $color = 'danger';
                        if ($rate > 80) {
                        $color = 'success';
                        } else if ($rate > 50) {
                        $color = 'warning';
                        }
                        @endphp
                        <div class="progress-bar bg-{{ $color }}" @style(['width'=> $width])></div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted small">No product data available for this range.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>