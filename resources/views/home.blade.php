@extends('layouts.public')

@section('content')

<!-- ======= HERO SECTION ======= -->
<section class="hero-section py-5 overflow-hidden border-bottom bg-light bg-opacity-50">
    <div class="container py-lg-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <div class="mb-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-2 small fw-bold">
                        Built for Electronics Labs
                    </span>
                </div>
                <h1 class="display-4 fw-bold mb-4" style="font-family: 'Outfit', sans-serif; color: #0f172a;">
                    Organize your lab testing with <span class="text-primary">SRS.</span>
                </h1>
                <p class="lead text-secondary mb-5" style="font-size: 1.2rem; max-width: 550px;">
                    Keep track of every resistor, capacitor, and circuit test. A straightforward tool for lab managers and technicians to record results and generate reports without the paperwork.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-3 fw-bold">
                        Open Control Panel
                    </a>
                    <a href="#features" class="btn btn-outline-secondary btn-lg px-4 py-3 fw-semibold">
                        Learn how it works
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="ps-lg-5">
                    <div class="card border-0 shadow-lg p-4 rounded-4" style="background: #ffffff;">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle">
                                <i class="fas fa-check"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Daily Test Summary</h6>
                        </div>
                        <div class="space-y-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-secondary small">Switch Gear Batch #42</span>
                                <span class="badge bg-success small">Passed</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-secondary small">Capacitor Batch #85</span>
                                <span class="badge bg-danger small">Failed</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary small">Fuse Batch #12</span>
                                <span class="badge bg-warning text-dark small">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= FEATURES SECTION ======= -->
<section id="features" class="py-5">
    <div class="container py-lg-5 text-center">
        <div class="max-w-700 mx-auto mb-5 pb-lg-4">
            <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif;">Everything you need to manage your lab.</h2>
            <p class="text-secondary">We focus on the essential tasks that take up your time every day.</p>
        </div>

        <div class="row g-4 text-start">
            <div class="col-md-4">
                <div class="p-4 h-100 rounded-4 border bg-white shadow-sm transition-hover">
                    <div class="icon-box-small mb-4 text-primary">
                        <i class="fas fa-edit fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Test Recording</h5>
                    <p class="text-secondary small">Quickly enter test results for different product categories. Record passes, fails, and specific measurements in seconds.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 h-100 rounded-4 border bg-white shadow-sm transition-hover">
                    <div class="icon-box-small mb-4 text-success">
                        <i class="fas fa-boxes fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Batch Management</h5>
                    <p class="text-secondary small">Organize your components into batches. Track the status of each revision and keep a clear history of what's been tested.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 h-100 rounded-4 border bg-white shadow-sm transition-hover">
                    <div class="icon-box-small mb-4 text-info">
                        <i class="fas fa-file-alt fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Quick Reporting</h5>
                    <p class="text-secondary small">Generate performance reports at the click of a button. Filter by date, product type, or technician to see how the lab is performing.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= PRACTICAL VALUES ======= -->
<section class="py-5 bg-light border-top border-bottom">
    <div class="container py-lg-5">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-4" style="font-family: 'Outfit', sans-serif;">Get rid of the confusion.</h3>
                <div class="d-flex gap-3 mb-4">
                    <div class="text-primary mt-1"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Clear Traceability</h6>
                        <p class="text-secondary small mb-0">Know exactly who tested what and when. No more searching through old paper logs or messy spreadsheets.</p>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div class="text-primary mt-1"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Standardized Workflow</h6>
                        <p class="text-secondary small mb-0">Ensure every technician follows the same testing protocols for every product type.</p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="text-primary mt-1"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Faster Turnaround</h6>
                        <p class="text-secondary small mb-0">Streamline the process from component arrival to final quality approval.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&q=80&w=1200" class="img-fluid rounded-4 shadow" alt="Electronic Lab Environment">
            </div>
        </div>
    </div>
</section>

<!-- ======= CTA SECTION ======= -->
<section class="py-5 text-center">
    <div class="container py-5">
        <div class="max-w-700 mx-auto">
            <h2 class="fw-bold mb-4" style="font-family: 'Outfit', sans-serif;">Ready to simplify your lab?</h2>
            <p class="text-secondary lead mb-5">Log in today to start organizing your testing workflow.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold rounded-3">Access Lab Console</a>
        </div>
    </div>
</section>

<style>
    .max-w-700 { max-width: 700px; }
    .transition-hover:hover {
        transform: translateY(-4px);
        border-color: #2563eb !important;
    }
    .transition-hover {
        transition: all 0.2s ease;
    }

    /* Scaling for 1280x1024 and similar desktop resolutions */
    @media (max-width: 1400px) {
        .display-4 {
            font-size: 2.75rem !important;
        }
        .hero-section .py-lg-5 {
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
        .hero-section .py-5 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }
        .hero-section p.lead {
            font-size: 1.1rem !important;
            margin-bottom: 2rem !important;
        }
    }

    /* General responsive padding adjustments */
    @media (max-width: 991px) {
        .hero-section {
            text-align: center;
        }
        .hero-section p.lead {
            margin-left: auto;
            margin-right: auto;
        }
        .hero-section .d-flex {
            justify-content: center;
        }
    }
</style>

@endsection
