@extends('layouts.app')

<?php
/** @var \Illuminate\Pagination\LengthAwarePaginator $products */
?>

@section('content')
<style>
    .card-box {
        background: white;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Products</h4>
        <p class="text-muted small mb-0">Manage all products in the lab inventory.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="fas fa-plus me-2"></i>Add Product
    </button>
</div>

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger mb-4">{{ session('error') }}</div>
@endif

<div class="card-box">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Product ID</th>
                <th>Type</th>
                <th>Code</th>
                <th>Rev</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><strong>{{ $product->product_id }}</strong></td>
                <td>{{ $product->product_type }}</td>
                <td><code>{{ $product->product_code }}</code></td>
                <td>{{ $product->revision }}</td>
                <td>
                    @php
                    $colors = [
                    'Pending' => 'warning',
                    'Pass' => 'success',
                    'Fail' => 'danger',
                    'Remaking' => 'info',
                    'CPRI_Pending' => 'primary',
                    'CPRI_Approved' => 'success'
                    ];
                    $color = $colors[$product->status] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $color }}">{{ $product->status }}</span>
                </td>
                <td>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($products->isEmpty())
            <tr>
                <td colspan="6" class="text-center text-muted py-4">No products yet. Add your first one!</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="mt-3">
        {{ $products->links() }}
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Product Type</label>
                        <select name="product_type" class="form-select">
                            <option value="Switch Gear">Switch Gear</option>
                            <option value="Fuse">Fuse</option>
                            <option value="Capacitor">Capacitor</option>
                            <option value="Resistor">Resistor</option>
                            <option value="General">General</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Code</label>
                        <input type="text" name="product_code" class="form-control" maxlength="4" placeholder="e.g., 0001" required>
                        <small class="text-muted">4-digit internal code</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Revision</label>
                        <input type="text" name="revision" class="form-control" maxlength="2" placeholder="e.g., 01" required>
                        <small class="text-muted">2-digit revision number</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Manufacturing Number</label>
                        <input type="text" name="mfg_number" class="form-control" maxlength="4" placeholder="e.g., 0001" required>
                        <small class="text-muted">4-digit batch/manufacturing number</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection