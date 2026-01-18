<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SRS Lab Automation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b35; /* Khansa Orange */
            --secondary-color: #1a1a2e; /* Khansa Navy */
            --accent-color: #0f3460;
            --text-dark: #1e293b;
            --humane-radius: 20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background: #fff;
            color: var(--text-dark);
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        /* Left Banner - Industrial Precision */
        .login-banner {
            flex: 1;
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .login-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .banner-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 60px;
            max-width: 550px;
        }

        .banner-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), #ff8c42);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            margin: 0 auto 30px;
            box-shadow: 0 20px 40px rgba(255, 107, 53, 0.2);
        }

        .banner-content h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: -0.02em;
        }

        .banner-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .feature-list {
            text-align: left;
            display: inline-block;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .feature-item i {
            color: var(--primary-color);
            margin-right: 15px;
            font-size: 1.25rem;
        }

        /* Right Login Form - Humane & Clean */
        .login-section {
            flex: 0.8;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 40px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--secondary-color);
            margin-bottom: 12px;
            letter-spacing: -0.01em;
        }

        .login-header p {
            color: #64748b;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            padding: 14px 20px;
            border-radius: 14px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
            outline: none;
        }

        .btn-login {
            background: var(--primary-color);
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-weight: 700;
            width: 100%;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            font-size: 1.1rem;
            box-shadow: 0 10px 20px rgba(255, 107, 53, 0.2);
        }

        .btn-login:hover {
            background: #ff8c42;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(255, 107, 53, 0.3);
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: #fff;
            padding: 0 20px;
            position: relative;
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .back-link {
            text-align: center;
        }

        .back-link a {
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            font-size: 0.95rem;
        }

        .back-link a:hover {
            color: var(--primary-color);
        }

        @media (max-width: 992px) {
            .login-banner { display: none; }
            .login-section { flex: 1; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Banner -->
        <div class="login-banner">
            <div class="banner-content">
                <div class="banner-logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1>Engineering Integrity.</h1>
                <p>Ensuring every batch meets the highest standards of safety and functional excellence through rigorous digital validation.</p>

                <div class="feature-list">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Precision Batch Validation</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Transparent Audit History</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Safety Compliance Monitoring</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Technician Accountability</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Login Form -->
        <div class="login-section">
            <div class="login-card">
                <div class="login-header text-center">
                    <h2>Lab Console Access</h2>
                    <p>Enter your credentials to manage testing</p>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <span class="small fw-semibold">{{ $errors->first() }}</span>
                    </div>
                </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">System Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Enter your username" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Security Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="btn btn-login">
                        Sign In to Console <i class="fas fa-sign-in-alt ms-2"></i>
                    </button>
                </form>

                <div class="divider">
                    <span>Navigation</span>
                </div>

                <div class="back-link">
                    <a href="/">
                        <i class="fas fa-arrow-left me-2"></i> Return to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>