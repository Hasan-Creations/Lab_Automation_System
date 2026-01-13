<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SRS Lab Automation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --srs-primary: #2563eb;
            --srs-dark: #0f172a;
            --srs-border: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            border: 1px solid var(--srs-border);
            width: 100%;
            max-width: 400px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header i {
            color: var(--srs-primary);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .login-header h2 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--srs-dark);
            margin-bottom: 0.25rem;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
        }

        .form-control {
            padding: 0.625rem 0.75rem;
            border-radius: 6px;
            border-color: var(--srs-border);
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--srs-primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-primary {
            background-color: var(--srs-primary);
            border: none;
            padding: 0.625rem;
            font-weight: 600;
            border-radius: 6px;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .alert {
            font-size: 0.875rem;
            border-radius: 6px;
            padding: 0.75rem 1rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-layer-group"></i>
            <h2>SRS Lab Automation</h2>
            <p class="text-secondary small">Enter your credentials to continue</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ url('/') }}" class="text-secondary small text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Back to Home
            </a>
        </div>
    </div>
</body>
</html>