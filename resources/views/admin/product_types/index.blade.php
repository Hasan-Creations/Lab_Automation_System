@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-0">Product Category Management</h2>
        <p class="text-secondary mb-0">Define and manage top-level product categories used in the lab.</p>
    </div>
    <button class="btn btn-primary d-flex align-items-center gap-2 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductTypeModal">
        <i class="fas fa-plus"></i> <span>Add Category</span>
    </button>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
@endif

<div class="card data-card shadow-sm overflow-hidden" style="border-radius: 16px; border: 1px solid #e2e8f0;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Product Name</th>
                    <th>ID Prefix</th>
                    <th>Description</th>
                    <th class="text-end pe-4">Control</th>
                </tr>
            </thead>
            <tbody>
                @forelse($list as $type)
                <tr>
                    <td class="ps-4"><span class="fw-bold text-dark">{{ $type->name }}</span></td>
                    <td><span class="badge bg-primary bg-opacity-10 text-primary border px-3">{{ $type->prefix }}</span></td>
                    <td><small class="text-secondary">{{ $type->description ?? 'No description' }}</small></td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#editModal{{ $type->id }}" title="Edit Category"><i class="fas fa-edit"></i></button>
                            <form action="{{ route('admin.product-types.destroy', $type->id) }}" method="POST" class="d-inline ms-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Delete this category? This will only work if no batches exist for it.')" title="Delete Category"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $type->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                            <form method="POST" action="{{ route('admin.product-types.update', $type->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header border-0 p-4 pb-0">
                                    <h5 class="fw-bold mb-0">Edit Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Category Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $type->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">ID Prefix (2-3 chars)</label>
                                        <input type="text" class="form-control" name="prefix" value="{{ $type->prefix }}" maxlength="3" required>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold">Description</label>
                                        <textarea class="form-control" name="description" rows="3">{{ $type->description }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 p-4 pt-0">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary px-4 fw-bold">Update Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted small">No product categories defined.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addProductTypeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <form method="POST" action="{{ route('admin.product-types.store') }}">
                @csrf
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0">New Product Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g. Transformer" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">ID Prefix (2-3 chars)</label>
                        <input type="text" class="form-control" name="prefix" placeholder="e.g. TR" maxlength="3" required>
                        <small class="text-muted">Used for generating SRS Product IDs.</small>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Brief summary..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection