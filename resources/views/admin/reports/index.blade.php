@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-0">Laboratory Intelligence</h2>
        <p class="text-secondary mb-0">Aggregate data into actionable insights and compliance reports.</p>
    </div>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-light border px-4 h-100"><i class="fas fa-print me-2"></i> Print View</button>
        <button onclick="alert('Export functionality coming soon.')" class="btn btn-success px-4 h-100"><i class="fas fa-file-excel me-2"></i> Export Data</button>
    </div>
</div>

<!-- Intelligence Filters -->
<div class="card shadow-sm mb-4" style="border-radius: 16px; border: 1px solid #e2e8f0;">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3 align-items-end">
            <input type="hidden" name="report" value="{{ $type }}">
            <div class="col-lg-4">
                <label class="form-label small fw-bold text-uppercase text-secondary">Analytical Perspective</label>
                <div class="dropdown">
                    <button class="btn btn-light border w-100 text-start d-flex align-items-center justify-content-between py-2" type="button" data-bs-toggle="dropdown">
                        <span><i class="fas {{ $names[$type]['icon'] }} me-2 text-primary"></i> {{ $names[$type]['title'] }}</span>
                        <i class="fas fa-chevron-down small"></i>
                    </button>
                    <ul class="dropdown-menu w-100 shadow-sm border-0" style="border-radius: 12px;">
                        @foreach ($names as $key => $row)
                        <li><a class="dropdown-item py-2 {{ $type == $key ? 'active' : '' }}" href="{{ route('admin.reports.index', ['report' => $key, 'date_from' => $from, 'date_to' => $to]) }}">
                                <i class="fas {{ $row['icon'] }} me-2"></i> {{ $row['title'] }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-3">
                <label class="form-label small fw-bold text-uppercase text-secondary">Window Start</label>
                <input type="date" name="date_from" class="form-control" value="{{ $from }}">
            </div>

            <div class="col-lg-3">
                <label class="form-label small fw-bold text-uppercase text-secondary">Window End</label>
                <input type="date" name="date_to" class="form-control" value="{{ $to }}">
            </div>

            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">Refresh View</button>
            </div>
        </form>
    </div>
</div>

<!-- Primary Analytical View -->
<div class="card data-card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header border-0 d-flex align-items-center gap-3 bg-white p-4" style="border-bottom: 1px solid #e2e8f0;">
        <div class="d-flex align-items-center justify-content-center bg-light text-primary rounded-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
            <i class="fas {{ $names[$type]['icon'] }}"></i>
        </div>
        <div>
            <h5 class="mb-0 fw-bold">{{ $names[$type]['title'] }}</h5>
            <small class="text-secondary">{{ date('M d, Y', strtotime($from)) }} &mdash; {{ date('M d, Y', strtotime($to)) }}</small>
        </div>
    </div>
    <div class="card-body p-0">
        @include('admin.reports.partials.' . $type)
    </div>
</div>
@endsection