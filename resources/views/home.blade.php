@extends('layouts.public')

@section('title', 'SRS Lab Automation')

@section('content')
<style>
    /* Khansa Design System - Replicated & Humanized */
    :root {
        --primary-color: #ff6b35; /* Khansa Orange */
        --secondary-color: #1a1a2e; /* Khansa Navy */
        --accent-color: #0f3460; /* Khansa Deep Blue */
        --light-bg: #f8f9fa;
        --text-dark: #333;
        --humane-radius: 20px;
        --humane-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
    }

    /* Fixed Navbar from Khansa */
    .navbar {
        background: var(--secondary-color) !important;
        padding: 1.25rem 0;
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        border-bottom: none;
    }

    .navbar-brand {
        font-family: 'Outfit', sans-serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff !important;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .logo-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-color), #ff8c42);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }

    .nav-link {
        color: rgba(255,255,255,0.85) !important;
        margin: 0 15px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .nav-link:hover {
        color: var(--primary-color) !important;
    }

    .btn-login-nav {
        background: var(--primary-color) !important;
        color: white !important;
        border-radius: 12px !important;
        padding: 0.6rem 1.5rem !important;
        margin-left: 15px;
        box-shadow: 0 4px 15px rgba(255,107,53,0.3);
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
        color: white;
        padding: 180px 0 120px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="rgba(255,107,53,0.1)"/></svg>');
        background-size: 200px;
        opacity: 0.3;
    }

    .hero-content h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 24px;
        line-height: 1.1;
        letter-spacing: -0.02em;
    }

    .hero-content h1 span {
        color: var(--primary-color);
    }

    .hero-content p {
        font-size: 1.35rem;
        margin-bottom: 40px;
        opacity: 0.9;
        max-width: 650px;
        line-height: 1.6;
    }

    .btn-primary-custom {
        background: var(--primary-color);
        color: white;
        padding: 16px 45px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1.1rem;
        border: none;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 10px 25px rgba(255,107,53,0.3);
    }

    .btn-primary-custom:hover {
        background: #ff8c42;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255,107,53,0.4);
    }

    /* Stats Section */
    .stats-section {
        background: white;
        padding: 0;
        margin-top: -60px;
        position: relative;
        z-index: 10;
    }

    .stat-card {
        text-align: center;
        padding: 40px 30px;
        border-radius: var(--humane-radius);
        background: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--humane-border);
        box-shadow: var(--humane-shadow);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary-color);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        opacity: 0.9;
    }

    .stat-number {
        font-family: 'Outfit', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--secondary-color);
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 0.9rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Capabilities Section */
    .services-section {
        padding: 120px 0;
        background: #fdfdfd;
    }

    .section-title {
        text-align: center;
        margin-bottom: 80px;
    }

    .section-title h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 2.75rem;
        font-weight: 800;
        color: var(--secondary-color);
        position: relative;
        display: inline-block;
        padding-bottom: 20px;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 5px;
        background: var(--primary-color);
        border-radius: 10px;
    }

    .service-card {
        background: white;
        padding: 48px 40px;
        border-radius: var(--humane-radius);
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid var(--humane-border);
        box-shadow: inset 0 0 0 1px transparent;
    }

    .service-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
    }

    .service-icon {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, var(--primary-color), #ff8c42);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 1.75rem;
        color: white;
        box-shadow: 0 10px 20px rgba(255,107,53,0.2);
    }

    .service-card h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 18px;
        color: var(--secondary-color);
    }

    .service-card p {
        color: #64748b;
        line-height: 1.7;
        font-size: 1rem;
    }

    /* About Section */
    .about-section {
        padding: 120px 0;
        background: white;
    }

    .about-img {
        border-radius: var(--humane-radius);
        overflow: hidden;
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.15);
    }

    .about-img img {
        width: 100%;
        height: auto;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .about-img:hover img {
        transform: scale(1.05);
    }

    .about-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 40px;
        padding: 0;
    }

    .about-list li {
        list-style: none;
        padding: 15px 20px;
        background: var(--light-bg);
        border-radius: 14px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .about-list li i {
        color: var(--primary-color);
        margin-right: 12px;
        font-size: 1.2rem;
    }

    .about-list li:hover {
        background: var(--primary-color);
        color: white;
    }

    .about-list li:hover i {
        color: white;
    }

    /* Footer */
    footer {
        background: var(--secondary-color) !important;
        color: white;
        padding: 60px 0 40px;
        text-align: center;
    }

    /* Mobile Refinements */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.75rem;
        }
        .about-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#home">
      <div class="logo-icon"><i class="fas fa-flask"></i></div>
      <span>SRS Lab Automation</span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#services">Testing Modules</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">Automation</a></li>
        <li class="nav-item"><a class="nav-link btn-login-nav" href="{{ route('login') }}">Lab Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<section id="home" class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 hero-content">
        <h1>Excellence in <span>Every Test.</span> Precision in Every Product.</h1>
        <p>Ensuring every component meets the highest standards of safety and compliance through digital excellence and mission-driven engineering.</p>
        <a href="{{ route('login') }}" class="btn-primary-custom">Access the Lab Portal <i class="fas fa-arrow-right ms-2"></i></a>
      </div>
    </div>
  </div>
</section>

<section class="stats-section">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-certificate"></i></div>
          <div class="stat-number">10k+</div>
          <div class="stat-label">Components Verified</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-shield-alt"></i></div>
          <div class="stat-number">100%</div>
          <div class="stat-label">Data Integrity</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
          <div class="stat-number">Elite</div>
          <div class="stat-label">Safety Standards</div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-clock"></i></div>
          <div class="stat-number">24/7</div>
          <div class="stat-label">Always Online</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="services" class="services-section">
  <div class="container">
    <div class="section-title">
      <h2>How We Ensure Quality</h2>
    </div>
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-project-diagram"></i></div>
          <h3>Lifecycle Tracking</h3>
          <p>Follow every product from the manufacturing floor through rigorous laboratory testing with total transparency.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-fingerprint"></i></div>
          <h3>Digital Certification</h3>
          <p>Secure, unique digital records for every component, ensuring verifiable quality and long-term reliability.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-lightbulb"></i></div>
          <h3>Instant Insights</h3>
          <p>Access comprehensive testing history and technical insights at your fingertips to make informed decisions.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-layer-group"></i></div>
          <h3>Specialized Validation</h3>
          <p>Custom-tailored testing protocols for switch gears, fuses, and resistors to guarantee peak performance.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-eye"></i></div>
          <h3>Expert Observation</h3>
          <p>Record nuanced technical observations and physical outputs for every single test cycle with high precision.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-chart-line"></i></div>
          <h3>Real-Time Assurance</h3>
          <p>Monitor quality status live as products move through our specialized departments towards final approval.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="about" class="about-section">
  <div class="container">
    <div class="section-title">
      <h2>Excellence in SRS Engineering</h2>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="about-img">
          <img src="https://images.unsplash.com/photo-1517420704952-d9f39e95b43e?auto=format&fit=crop&q=80&w=1200" alt="Lab Automation">
        </div>
      </div>
      <div class="col-lg-6 ps-lg-5">
        <h3 class="mb-4 fw-bold text-dark">A Tradition of Precision, Digitally Refined</h3>
        <p class="mb-4 text-secondary lead">By moving beyond legacy paper trails, we empower our technicians to focus on what matters most: the safety and reliability of SRS Electrical products.</p>
        <p class="mb-5 text-secondary">Our digital infrastructure ensures that every component is rigorously validated across all departments before achieving final market certification.</p>
        <ul class="about-list">
          <li><i class="fas fa-check-circle"></i> Digital Accountability</li>
          <li><i class="fas fa-check-circle"></i> Precision Validation</li>
          <li><i class="fas fa-check-circle"></i> Transparent Compliance</li>
          <li><i class="fas fa-check-circle"></i> Intelligent Management</li>
          <li><i class="fas fa-check-circle"></i> Heritage Meets Innovation</li>
          <li><i class="fas fa-check-circle"></i> CPRI Ready Outcomes</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <p class="mb-0 text-white-50 small">&copy; 2026 SRS Lab Automation System. All Rights Reserved.</p>
  </div>
</footer>
@endsection
