<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SRS Lab Automation') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --srs-primary: #2563eb;
            --srs-dark: #0f172a;
            --srs-gray-600: #475569;
            --srs-gray-100: #f1f5f9;
            --srs-border: #e2e8f0;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background: #ffffff; 
            color: var(--srs-dark);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        .navbar { 
            background: #ffffff;
            padding: 1rem 0;
            border-bottom: 1px solid var(--srs-border);
        }

        .navbar-brand { 
            font-family: 'Outfit', sans-serif; 
            font-weight: 700; 
            font-size: 1.25rem;
            color: var(--srs-dark) !important;
        }

        .navbar-brand i {
            color: var(--srs-primary);
            margin-right: 8px;
        }

        .nav-link { 
            color: var(--srs-gray-600) !important; 
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.15s ease;
        }

        .nav-link:hover { 
            color: var(--srs-primary) !important; 
        }

        .btn-login { 
            background: var(--srs-primary); 
            color: white !important; 
            border-radius: 6px; 
            padding: 0.5rem 1.25rem; 
            font-weight: 600; 
            font-size: 0.9rem;
            transition: opacity 0.2s ease;
        }

        .btn-login:hover { 
            opacity: 0.9;
        }

        footer {
            background: var(--srs-gray-100);
            padding: 4rem 0 2rem;
            border-top: 1px solid var(--srs-border);
        }

        .footer-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            display: block;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-layer-group"></i>
                SRS Lab Automation
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-lg-4">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn-login" href="{{ route('login') }}">
                            Operator Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-5">
                    <span class="footer-brand">SRS Lab Automation</span>
                    <p class="text-secondary small">A professional management system designed specifically for electronics testing laboratories. Focused on data integrity and operational efficiency.</p>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <p class="text-secondary small mb-1">&copy; {{ date('Y') }} SRS Lab Automation</p>
                    <p class="text-muted extra-small">Internal Tooling &mdash; v2.4.0</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
