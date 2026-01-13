<div class="sidebar">
    <div class="sidebar-header d-flex align-items-center gap-3">
        <div style="background: var(--srs-primary); padding: 8px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; box-shadow: 0 0 20px rgba(37, 99, 235, 0.2);">
            <i class="fas fa-microchip text-white fs-5"></i>
        </div>
        <div class="brand-text-container">
            <h5 class="mb-0 fw-bold text-white font-outfit" style="font-size: 1.1rem; letter-spacing: -0.5px;">SRS</h5>
            <div class="text-primary fw-bold" style="font-size: 0.6rem; text-transform: uppercase; letter-spacing: 1px;">Control Console</div>
        </div>
    </div>

    <div class="sidebar-label"></div>
    <ul class="nav flex-column">
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
        padding: 0;
        z-index: 1000;
        font-family: 'Inter', sans-serif;
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    .sidebar-header {
        padding: 30px 24px;
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 20px;
    }

    .sidebar .nav-link {
        color: #94a3b8;
        padding: 12px 24px;
        margin: 0 12px 4px 12px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        border: 1px solid transparent;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.03);
        color: white;
        border-color: rgba(255, 255, 255, 0.05);
    }

    .sidebar .nav-link.active {
        background: var(--srs-primary);
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .sidebar .nav-link i {
        width: 20px;
        margin-right: 12px;
        font-size: 1rem;
        opacity: 0.7;
    }

    .sidebar .nav-link.active i {
        opacity: 1;
    }

    .sidebar-label {
        padding: 20px 24px 10px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #475569;
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