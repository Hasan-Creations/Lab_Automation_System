@extends('layouts.public')

@section('content')

<!-- Hero Section -->
<section class="py-5 bg-light border-bottom">
    <div class="container py-lg-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <header class="mb-5">
                    <span class="text-uppercase tracking-widest fw-bold text-primary small mb-3 d-block">Tools for Electronics Labs</span>
                    <h1 class="display-5 fw-bold mb-4" style="font-family: 'Outfit', sans-serif;">Manage your laboratory data efficiently.</h1>
                    <p class="lead text-secondary" style="max-width: 500px;">Record resistor and capacitor tests, track component batches, and generate standardized reports for your team.</p>
                </header>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-3 fw-bold shadow-sm">
                        Access Control Console
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="ps-lg-5 text-center">
                    <div class="p-5 bg-white border rounded-4 shadow-sm text-start" style="max-width: 450px; margin: auto;">
                        <h6 class="fw-bold mb-4 text-muted small text-uppercase">Recent Activity</h6>
                        <div class="list-group list-group-flush small">
                            <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0 fw-semibold">Batch #942 Completed</p>
                                    <small class="text-muted">Capacitor Testing</small>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Pass</span>
                            </div>
                            <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0 fw-semibold">Daily Report Exported</p>
                                    <small class="text-muted">Admin User</small>
                                </div>
                                <i class="fas fa-file-pdf text-muted"></i>
                            </div>
                            <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-0">
                                <div>
                                    <p class="mb-0 fw-semibold">Batch #941 Pending Review</p>
                                    <small class="text-muted">Station 4</small>
                                </div>
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Review</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Operations -->
<section id="features" class="py-5">
    <div class="container py-lg-5">
        <div class="mb-5">
            <h2 class="fw-bold" style="font-family: 'Outfit', sans-serif;">System Overview</h2>
            <p class="text-secondary">Straightforward operations for daily lab management.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded-3 h-100 bg-white shadow-sm">
                    <i class="fas fa-pencil-alt text-primary mb-3 fs-4"></i>
                    <h5 class="fw-bold mb-2">Test Recording</h5>
                    <p class="text-secondary small mb-0">Record results for resistors, capacitors, and complex components with standardized input fields to ensure data accuracy.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded-3 h-100 bg-white shadow-sm">
                    <i class="fas fa-layer-group text-primary mb-3 fs-4"></i>
                    <h5 class="fw-bold mb-2">Batch Tracking</h5>
                    <p class="text-secondary small mb-0">Monitor the lifecycle of every component batch. Track revisions, re-tests, and current status from a single view.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded-3 h-100 bg-white shadow-sm">
                    <i class="fas fa-clipboard-check text-primary mb-3 fs-4"></i>
                    <h5 class="fw-bold mb-2">Integrity Control</h5>
                    <p class="text-secondary small mb-0">Built-in safeguards and role-based access ensure that laboratory standards are maintained across all test results.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 border-top bg-light">
    <div class="container py-lg-4">
        <div class="row align-items-center justify-content-between py-5">
            <div class="col-lg-5">
                <h2 class="fw-bold mb-4" style="font-family: 'Outfit', sans-serif;">Built for technicians, by design.</h2>
                <ul class="list-unstyled space-y-4">
                    <li class="d-flex gap-3 align-items-start">
                        <i class="fas fa-check text-primary mt-1"></i>
                        <div>
                            <p class="mb-0 fw-semibold">Eliminate Manual Logs</p>
                            <p class="text-secondary small">Reduce paperwork and transcription errors with direct digital entry.</p>
                        </div>
                    </li>
                    <li class="d-flex gap-3 align-items-start mt-4">
                        <i class="fas fa-check text-primary mt-1"></i>
                        <div>
                            <p class="mb-0 fw-semibold">Instant Retrieval</p>
                            <p class="text-secondary small">Search and find any historical test result by batch ID or product type instantly.</p>
                        </div>
                    </li>
                    <li class="d-flex gap-3 align-items-start mt-4">
                        <i class="fas fa-check text-primary mt-1"></i>
                        <div>
                            <p class="mb-0 fw-semibold">Secure Reporting</p>
                            <p class="text-secondary small">Standardized PDF reports that are audit-ready and easy to share.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="rounded-4 overflow-hidden border shadow-sm">
                    <img src="https://images.unsplash.com/photo-1558494949-ef01091557d4?auto=format&fit=crop&q=80&w=1000" class="img-fluid" alt="Data Center Visualization">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final Call to Action -->
<section class="py-5 text-center bg-white border-top">
    <div class="container py-5">
        <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif;">Get started today.</h2>
        <p class="text-secondary mb-5">Login with your credentials to access the laboratory console.</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold rounded-3">Login to Dashboard</a>
    </div>
</section>

<style>
    .tracking-widest { letter-spacing: 0.1em; }
    .extra-small { font-size: 0.7rem; }
</style>

@endsection
