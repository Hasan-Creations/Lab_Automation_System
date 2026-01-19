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
                        <div class="small fw-medium text-truncate" style="max-width: 200px;">{{ $user->email }}</div>
                        <div class="small text-secondary">
                            @if($user->user_type == 'admin')
                                <span class="text-primary fw-bold"><i class="fas fa-globe me-1"></i> Global Access</span>
                            @else
                                {{ $user->dept->name ?? 'Unassigned' }}
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="badge rounded-pill {{ $user->user_type == 'admin' ? 'bg-primary' : 'bg-secondary' }} px-3">
                            {{ strtoupper($user->user_type) }}
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-light px-3 fw-bold rounded-2 edit-user-btn" 
                                    data-user="{{ json_encode($user) }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editUserModal">
                                <i class="fas fa-edit me-1"></i> Edit
                            </button>

                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.settings.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger px-2 border-0" onclick="return confirm('Permanently delete this user account?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @endif
                        </div>
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
                    <h5 class="fw-bold"><i class="fas fa-user-plus text-primary me-2"></i>Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Username</label>
                            <input type="text" name="username" class="form-control bg-light border-0" placeholder="Unique ID" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Password</label>
                            <input type="password" name="password" class="form-control bg-light border-0" placeholder="Security key" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary">Full Name</label>
                            <input type="text" name="full_name" class="form-control bg-light border-0" placeholder="Operator legal name" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" class="form-control bg-light border-0" placeholder="user@srs.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Role</label>
                            <select name="user_type" id="add_user_type" class="form-select bg-light border-0" required>
                                <option value="tester">Tester</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="add_dept_container">
                            <label class="form-label small fw-bold text-secondary">Department</label>
                            <select name="department_id" id="add_department_id" class="form-select bg-light border-0" required>
                                <option value="">-- Select Dept --</option>
                                @foreach($depts as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="fas fa-user-edit text-primary me-2"></i>Edit User Credentials</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Username</label>
                            <input type="text" name="username" id="edit_username" class="form-control bg-light border-0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">New Password</label>
                            <input type="password" name="password" class="form-control bg-light border-0" placeholder="Leave blank to keep current">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary">Full Name</label>
                            <input type="text" name="full_name" id="edit_full_name" class="form-control bg-light border-0" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" id="edit_email" class="form-control bg-light border-0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Role</label>
                            <select name="user_type" id="edit_user_type" class="form-select bg-light border-0" required>
                                <option value="tester">Tester</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="edit_dept_container">
                            <label class="form-label small fw-bold text-secondary">Department</label>
                            <select name="department_id" id="edit_department_id" class="form-select bg-light border-0" required>
                                <option value="">-- Select Dept --</option>
                                @foreach($depts as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit logic
    const editBtns = document.querySelectorAll('.edit-user-btn');
    const editForm = document.getElementById('editUserForm');
    const editRole = document.getElementById('edit_user_type');
    const editDeptBox = document.getElementById('edit_dept_container');
    const editDeptSelect = document.getElementById('edit_department_id');

    function toggleDeptVisibility(role, box, select) {
        if (role === 'admin') {
            box.style.display = 'none';
            select.removeAttribute('required');
            select.value = '';
        } else {
            box.style.display = 'block';
            select.setAttribute('required', 'required');
        }
    }

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const user = JSON.parse(this.dataset.user);
            editForm.action = `/admin/settings/user/${user.id}`;
            document.getElementById('edit_username').value = user.username;
            document.getElementById('edit_full_name').value = user.full_name;
            document.getElementById('edit_email').value = user.email || '';
            editRole.value = user.user_type;
            editDeptSelect.value = user.department_id || '';
            toggleDeptVisibility(user.user_type, editDeptBox, editDeptSelect);
        });
    });

    editRole.addEventListener('change', function() {
        toggleDeptVisibility(this.value, editDeptBox, editDeptSelect);
    });

    // Add logic
    const addRole = document.getElementById('add_user_type');
    const addDeptBox = document.getElementById('add_dept_container');
    const addDeptSelect = document.getElementById('add_department_id');

    addRole.addEventListener('change', function() {
        toggleDeptVisibility(this.value, addDeptBox, addDeptSelect);
    });
});
</script>
@endsection