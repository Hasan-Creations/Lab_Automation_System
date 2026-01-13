<div class="sidebar">
    <div class="sidebar-header px-4 py-4 d-flex align-items-center gap-3">
        <div style="background: var(--srs-primary, #2563eb); padding: 8px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
            <i class="fas fa-layer-group text-white fs-5"></i>
        </div>
        <div class="brand-text-container">
            <h5 class="mb-0 fw-bold font-outfit text-white tracking-widest" style="font-size: 1.1rem;">SRS</h5>
            <small class="text-secondary tracking-widest" style="font-size: 0.65rem; text-uppercase;">Lab Automation</small>
        </div>
    </div>
    <ul class="nav flex-column mt-2">
        @if(auth()->user()->user_type == 'admin')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-th-large me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.batches.*') ? 'active' : '' }}" href="{{ route('admin.batches.index') }}">
                <i class="fas fa-boxes me-2"></i> Batches
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.cpri.*') ? 'active' : '' }}" href="{{ route('admin.cpri.index') }}">
                <i class="fas fa-certificate me-2"></i> CPRI Tracking
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.product-types.*') ? 'active' : '' }}" href="{{ route('admin.product-types.index') }}">
                <i class="fas fa-tags me-2"></i> Product Types
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.requirements.*') ? 'active' : '' }}" href="{{ route('admin.requirements.index') }}">
                <i class="fas fa-project-diagram me-2"></i> Test Mapping
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.test-types.*') ? 'active' : '' }}" href="{{ route('admin.test-types.index') }}">
        <i class="fas fa-file-contract me-2"></i> Protocols
        </a>
        </li> --}}
        <!-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                <i class="fas fa-chart-bar me-2"></i> Reports
            </a>
        </li> -->
        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
            <i class="fas fa-cog me-2"></i> Settings
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.search') ? 'active' : '' }}" href="{{ route('admin.search') }}">
                <i class="fas fa-search me-2"></i> Search
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.view-status') ? 'active' : '' }}" href="{{ route('admin.view-status') }}">
                <i class="fas fa-eye me-2"></i> View Status
            </a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                <i class="fas fa-th-large me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.tests.*') ? 'active' : '' }}" href="{{ route('user.tests.create') }}">
                <i class="fas fa-edit me-2"></i> New Test
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.search') ? 'active' : '' }}" href="{{ route('user.search') }}">
                <i class="fas fa-search me-2"></i> Search
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.view-status') ? 'active' : '' }}" href="{{ route('user.view-status') }}">
                <i class="fas fa-eye me-2"></i> View Status
            </a>
        </li>
        @endif

        <li class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start" style="padding: 12px 15px;">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>

<style>
    .sidebar {
        width: 260px;
        height: 100vh;
        background: #0f172a;
        color: white;
        position: fixed;
        left: 0;
        top: 0;
        padding: 20px 20px 20px 20px;
        z-index: 1000;
        font-family: 'Inter', sans-serif;
    }

    .sidebar .nav-link {
        color: #94a3b8;
        padding: 12px 18px;
        border-radius: 12px;
        margin-bottom: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        letter-spacing: -0.01em;
    }

    .sidebar h6,
    .sidebar .brand-text {
        font-family: 'Outfit', sans-serif;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.1em;
        color: #475569;
        margin: 20px 0 10px 15px;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
        color: white;
    }

    .sidebar .nav-link.active {
        background: #3b82f6;
        color: white;
    }

    .sidebar .nav-link i {
        width: 24px;
    }

    .main-content {
        margin-left: 260px;
        padding: 100px 40px 40px 40px;
        min-height: 100vh;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .main-content {
            margin-left: 0;
            padding: 90px 20px 20px 20px;
        }
    }

    /* Status Badges */
    .badge-Pending,
    .badge-pending {
        background-color: #f59e0b !important;
        color: white !important;
    }

    .badge-Pass {
        background-color: #10b981 !important;
        color: white !important;
    }

    .badge-Fail,
    .badge-rejected {
        background-color: #ef4444 !important;
        color: white !important;
    }

    .badge-CPRI_Pending {
        background-color: #6366f1 !important;
        color: white !important;
    }

    .badge-CPRI_Approved,
    .badge-approved {
        background-color: #059669 !important;
        color: white !important;
    }

    .badge-Remaking {
        background-color: #8b5cf6 !important;
        color: white !important;
    }
</style>