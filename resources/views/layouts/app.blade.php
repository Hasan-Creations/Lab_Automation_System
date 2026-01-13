<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Lab Automation') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --srs-primary: #2563eb;
            --srs-primary-hover: #1d4ed8;
            --srs-bg: #f1f5f9;
            --srs-surface: #ffffff;
            --srs-border: #e2e8f0;
            --srs-dark: #0f172a;
            --srs-gray-500: #64748b;
            --srs-gray-600: #475569;
            --srs-card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--srs-bg);
            color: var(--srs-dark);
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .display-font {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.02em;
            color: var(--srs-dark);
        }

        .card-modern {
            background: var(--srs-surface);
            border-radius: 12px;
            border: 1px solid var(--srs-border);
            box-shadow: var(--srs-card-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-modern:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .main-content {
            margin-left: 260px;
            padding: 100px 40px 40px 40px;
            min-height: 100vh;
        }

        /* Technical Typography */
        .text-technical {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.65rem;
            color: var(--srs-gray-500);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
                padding: 90px 20px 20px 20px;
            }
        }
    </style>
</head>

<body>
    @include('partials.sidebar')

    <nav class="navbar fixed-top bg-white shadow-sm" style="margin-left: 260px; height: 80px; z-index: 900;">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center gap-2">
                <div style="background: var(--nexus-indigo, #2563eb); padding: 5px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;">
                    <i class="fas fa-layer-group text-white" style="font-size: 0.9rem;"></i>
                </div>
                <h5 class="mb-0 fw-bold text-dark">SRS Lab Automation</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end d-none d-sm-block">
                        <small class="d-block text-secondary" style="font-size: 0.75rem;">Signed in as</small>
                        <span class="fw-bold text-dark display-font" style="font-size: 0.95rem;">{{ Auth::user()->full_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>