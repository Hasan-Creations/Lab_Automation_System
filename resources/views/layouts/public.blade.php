<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SRS Lab Automation') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --srs-primary: #2563eb;
            --srs-dark: #0f172a;
            --srs-gray: #64748b;
            --srs-bg: #ffffff;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--srs-bg); 
            color: var(--srs-dark);
            line-height: 1.6;
        }

        .navbar { 
            background: #ffffff !important;
            padding: 1.25rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-brand { 
            font-family: 'Outfit', sans-serif; 
            font-weight: 700; 
            font-size: 1.4rem;
            color: var(--srs-dark) !important;
            letter-spacing: -0.5px;
        }

        .navbar-brand i {
            color: var(--srs-primary);
        }

        .nav-link { 
            color: var(--srs-gray) !important; 
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .nav-link:hover { 
            color: var(--srs-primary) !important; 
        }

        .btn-login { 
            background: var(--srs-primary); 
            color: white !important; 
            border-radius: 8px; 
            padding: 0.6rem 1.75rem; 
            font-weight: 600; 
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
        }

        .btn-login:hover { 
            background: #1d4ed8; 
            transform: translateY(-1px);
        }

        footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 5rem 0 3rem;
        }

        .footer-logo {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: var(--srs-dark);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <i class="fas fa-layer-group"></i>
                SRS Lab Automation
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-4">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/#') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
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
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <h5 class="footer-logo mb-3">SRS Lab Automation</h5>
                    <p class="text-secondary small pr-lg-5">A practical tool designed for electronics labs to keep testing data organized, accurate, and easy to find.</p>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h6 class="fw-bold mb-3 small text-muted text-uppercase">Navigation</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#features" class="text-secondary text-decoration-none">Features</a></li>
                        <li class="mb-2"><a href="#about" class="text-secondary text-decoration-none">About</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h6 class="fw-bold mb-3 small text-muted text-uppercase">Support</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Documentation</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Help Desk</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 border-secondary opacity-10">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="text-muted small mb-0">&copy; {{ date('Y') }} SRS Lab Automation. All rights reserved.</p>
                <div class="d-flex gap-4">
                    <a href="#" class="text-muted"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-muted"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
