@extends('layouts.dashboard_master')

@section('content')

<div class="container-fluid">
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body p-4">

            <div class="row">
                {{-- Product Images Gallery --}}
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="text-center">
                        @if($productImages->count() > 0)
                            <img src="{{ asset($productImages->first()->image) }}" id="mainProductImage" class="img-fluid rounded-lg shadow-sm w-100"
                                 style="height: 400px; object-fit: cover; border: 1px solid #eee;" alt="{{ $product->name }}">
                            <div class="d-flex justify-content-center mt-3">
                                @foreach ($productImages as $image)
                                    <img src="{{ asset($image->image) }}" class="img-thumbnail rounded-circle mx-1"
                                         style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; border-width: 2px;"
                                         alt="Product Thumbnail" onclick="document.getElementById('mainProductImage').src='{{ asset($image->image) }}'">
                                @endforeach
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light rounded-lg" style="height: 400px; border: 1px solid #eee;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Product Details --}}
                <div class="col-lg-7">
                    {{-- Product Title --}}
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="fw-bold mb-1">{{ $product->name }}</h2>
                            <span class="badge bg-light text-dark">ID: {{ $product->id }}</span>
                        </div>
                        <span class="badge {{ $product->quantity > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                            {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>

                    {{-- Pricing and Category --}}
                    <div class="card bg-light border-0 mb-3" style="border-radius: 10px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0"><i class="fas fa-sitemap text-muted me-2"></i><strong>Category:</strong> {{ $product->category->name }}</h5>
                                </div>
                                <div class="text-end">
                                    @if($product->price_after_discount)
                                        <h3 class="fw-bold text-success mb-0">{{ $product->price_after_discount }} JOD</h3>
                                        <small class="text-muted text-decoration-line-through">{{ $product->price }} JOD</small>
                                    @else
                                        <h3 class="fw-bold text-primary mb-0">{{ $product->price }} JOD</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Descriptions --}}
                    <div class="mb-4">
                        <p class="text-muted"><strong><i class="fas fa-pencil-alt me-2"></i>Short Description:</strong></p>
                        <p>{{ $product->small_description }}</p>
                        <hr>
                        <p class="text-muted"><strong><i class="fas fa-align-left me-2"></i>Full Description:</strong></p>
                        <p>{{ $product->description }}</p>
                    </div>

                    {{-- Additional Details Table --}}
                    <h5 class="mb-3"><strong>Product Specifications</strong></h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" style="font-size: 0.9rem;">
                            <tbody>
                                <tr>
                                    <td class="w-25"><strong><i class="fas fa-copyright text-muted me-2"></i>Brand</strong></td>
                                    <td>{{ optional($product_details)->brand ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-palette text-muted me-2"></i>Shade</strong></td>
                                    <td>{{ optional($product_details)->shade ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-paint-brush text-muted me-2"></i>Finish</strong></td>
                                    <td>{{ optional($product_details)->finish ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-user-check text-muted me-2"></i>Skin Type</strong></td>
                                    <td>{{ optional($product_details)->skin_type ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-ruler-vertical text-muted me-2"></i>Volume</strong></td>
                                    <td>{{ optional($product_details)->volume ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-info-circle text-muted me-2"></i>Usage</strong></td>
                                    <td>{{ optional($product_details)->usage_instructions ?? 'N/A' }}</td>
                                </tr>
                                 <tr>
                                    <td><strong><i class="fas fa-box-open text-muted me-2"></i>Quantity</strong></td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="text-end mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back to List</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info"><i class="fas fa-edit me-1"></i> Edit</a>
                        <button type="button" class="btn btn-danger" onclick="showConfirmDeletionModal('{{ route('products.destroy', $product->id) }}')">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showConfirmDeletionModal(url) {
        // Set the form action dynamically
        var form = document.getElementById('deleteForm');
        form.action = url;

        // Show the Bootstrap modal
        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
    }
</script>
@endpush
