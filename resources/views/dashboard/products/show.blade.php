@extends('layouts.dashboard_master')

@section('content')

<div class="container-fluid">
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body p-4">

            <div class="row">

                {{-- القسم الأول: معرض صور المنتج --}}
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="text-center">
                        @if($productImages->count() > 0)
                            <img src="{{ asset($productImages->first()->image) }}" id="mainProductImage" class="img-fluid rounded-lg shadow-sm w-100"
                                 style="height: 450px; object-fit: cover; border: 1px solid #eee;" alt="{{ $product->name }}">

                            <div class="d-flex justify-content-center mt-3">
                                @foreach ($productImages as $image)
                                    <img src="{{ asset($image->image) }}" class="img-thumbnail mx-1"
                                         style="width: 70px; height: 70px; object-fit: cover; cursor: pointer; border-width: 2px;"
                                         alt="Product Thumbnail" onclick="document.getElementById('mainProductImage').src='{{ asset($image->image) }}'">
                                @endforeach
                            </div>
                        @else
                            {{-- Placeholder in case no images exist --}}
                            <div class="d-flex align-items-center justify-content-center bg-light rounded-lg" style="height: 450px; border: 1px solid #eee;">
                                <i class="fas fa-image fa-4x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- القسم الثاني: تفاصيل المنتج --}}
                <div class="col-lg-7">

                    {{-- 1. عنوان المنتج وحالته --}}
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h2 class="fw-bold mb-1">{{ $product->name }}</h2>
                            <h4 class="fw-normal text-muted mb-2">{{ $product->name_ar }}</h4>
                            <span class="badge bg-light text-dark border">ID: {{ $product->id }}</span>
                        </div>
                        <span class="badge fs-6 rounded-pill {{ $product->quantity > 0 ? 'bg-success-subtle text-success-emphasis' : 'bg-danger-subtle text-danger-emphasis' }}">
                            <i class="fas {{ $product->quantity > 0 ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                            {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>

                    {{-- 2. السعر --}}
                    <div class="mb-4">
                        @if($product->price_after_discount)
                            <span class="h2 fw-bold text-success">{{ $product->price_after_discount }} JOD</span>
                            <small class="text-muted text-decoration-line-through ms-2">{{ $product->price }} JOD</small>
                        @else
                            <span class="h2 fw-bold text-primary">{{ $product->price }} JOD</span>
                        @endif
                    </div>

                    {{-- 3. الوصف --}}
                    <div class="mb-4">
                        <p class="text-muted">{{ $product->small_description }}</p>
                        <p class="text-muted" dir="rtl">{{ $product->small_description_ar }}</p>
                    </div>

                    {{-- 4. جدول التفاصيل الأساسية --}}
                    <h5 class="mb-3 fw-bold">Key Details</h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-striped" style="font-size: 0.9rem;">
                            <tbody>
                                <tr>
                                    <th class="w-25 bg-light"><i class="fas fa-copyright text-muted me-2"></i>Brand</th>
                                    <td>{{ optional($product->brand)->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25 bg-light"><i class="fas fa-sitemap text-muted me-2"></i>Category</th>
                                    <td>{{ optional($product->subCategory)->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25 bg-light"><i class="fas fa-box-open text-muted me-2"></i>Quantity</th>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25 bg-light"><i class="fas fa-info-circle text-muted me-2"></i>Type</th>
                                    <td>{{ ucfirst($product->type) }}</td>
                                </tr>
                                @if($product->type == 'variation')
                                <tr>
                                    <th class="w-25 bg-light"><i class="fas fa-link text-muted me-2"></i>Parent Product</th>
                                    <td>{{ optional($product->parent)->name ?? 'N/A' }} (ID: {{ $product->parent_product_id }})</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- 5. جدول المواصفات الإضافية --}}
                    @if($product->specifications && $product->specifications->count() > 0)
                        <h5 class="mb-3 fw-bold">Additional Specifications</h5>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered" style="font-size: 0.9rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Key</th>
                                        <th>Value</th>
                                        <th class="text-end">المفتاح</th>
                                        <th class="text-end">القيمة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->specifications as $spec)
                                        <tr>
                                            <td>{{ $spec->key }}</td>
                                            <td>{{ $spec->value }}</td>
                                            <td class="text-end">{{ $spec->key_ar }}</td>
                                            <td class="text-end">{{ $spec->value_ar }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{-- 6. أزرار الإجراءات --}}
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

{{-- Modal for Deletion Confirmation --}}
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
        document.getElementById('deleteForm').action = url;

        // Show the Bootstrap modal
        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
    }
</script>
@endpush
