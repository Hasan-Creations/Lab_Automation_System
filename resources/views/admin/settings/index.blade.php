@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-0">User Settings</h2>
        <p class="text-secondary mb-0">Manage system users and specific roles.</p>
    </div>
    <button class="btn btn-primary px-4 fw-bold rounded-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fas fa-user-plus me-2"></i> Add New User
    </button>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
@endif
@if($errors->any())
<div class="alert alert-danger border-0 shadow-sm mb-4">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow-sm border-0 rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">User</th>
                    <th>Email / Department</th>
                    <th>Role</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_users as $user)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center fw-bold text-primary" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($user->full_name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $user->full_name }}</div>
                                <small class="text-secondary text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">{{ $user->username }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="small fw-medium">{{ $user->email }}</div>
                        <div class="small text-secondary">{{ $user->dept->name ?? 'None' }}</div>
                    </td>
                    <td>
                        <span class="badge rounded-pill bg-secondary px-3">
                            {{ strtoupper($user->user_type) }}
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        @if(auth()->id() !== $user->id)
                        <form action="{{ route('admin.settings.update', $user->id) }}" method="POST" class="d-inline-flex gap-2">
                            @csrf
                            @method('PUT')
                            <select name="department_id" class="form-select form-select-sm border-0 bg-light" style="width: 140px;">
                                @foreach($depts as $dept)
                                <option value="{{ $dept->id }}" {{ $user->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            <select name="user_type" class="form-select form-select-sm border-0 bg-light" style="width: 100px;">
                                <option value="tester" {{ $user->user_type == 'tester' ? 'selected' : '' }}>Tester</option>
                                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary px-3 fw-bold">Update</button>
                        </form>

                        <form action="{{ route('admin.settings.update', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-2 border-0" onclick="return confirm('Permanently delete this user account?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @else
                        <!-- <span class="badge bg-light text-secondary">Logged In</span> -->
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <form action="{{ route('admin.settings.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Unique system identifier" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Security credentials" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Full Name</label>
                        <input type="text" name="full_name" class="form-control" placeholder="Legal name of operator" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Contact endpoint" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Department</label>
                        <select name="department_id" class="form-select" required>
                            @foreach($depts as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Role</label>
                        <select name="user_type" class="form-select" required>
                            <option value="tester">Tester</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection