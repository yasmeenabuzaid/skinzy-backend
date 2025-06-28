@extends('layouts.dashboard_master')

@section('content')
<div class="card shadow-sm">
    <div class="card-body" style="border: 1px solid #e7dee9; border-radius: 10px; padding: 30px; background-color: #f9f9f9;">
        <div class="text-start mb-4">
            <h3><strong>{{ $product->name }} ({{ $product->id }})</strong></h3>
        </div>
        {{-- Product Images --}}
        <div class="form-group mb-3">
            <p><strong>Product Images:</strong></p>
            <div class="row">
                @foreach ($productImages as $productImage)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset($productImage->image) }}" class="img-fluid rounded" alt="Product Image"
                             style="height: 200px; object-fit: cover; width: 100%;">
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Product Details Table --}}
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Attribute</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fas fa-pencil-alt"></i> <strong>Small Description</strong></td>
                        <td>{{ $product->small_description }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-align-left"></i> <strong>Description</strong></td>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-dollar-sign"></i> <strong>Old Price</strong></td>
                        <td><span class="text-muted text-decoration-line-through">{{ $product->old_price }}</span></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-tag"></i> <strong>Price</strong></td>
                        <td><span class="text-success">{{ $product->price }}</span></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-percentage"></i> <strong>Discount</strong></td>
                        <td>
                            @if($product->discount)
                                <span class="badge bg-danger">{{ $product->discount }}%</span>
                            @else
                                <span class="text-secondary">No Discount</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-cogs"></i> <strong>Quantity</strong></td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-sitemap"></i> <strong>Sub Category</strong></td>
                        <td>{{ $product->subCategory->category->name }} - {{ $product->subCategory->name }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-weight-hanging"></i> <strong>Weight</strong></td>
                        <td>{{ optional($product_details)->weight ?? 'N/A' }} grams</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-leaf"></i> <strong>Ingredients</strong></td>
                        <td>{{ optional($product_details)->ingredients ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-exclamation-triangle"></i> <strong>Allergens</strong></td>
                        <td>{{ optional($product_details)->allergens ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-flag"></i> <strong>Origin Country</strong></td>
                        <td>{{ optional($product_details)->origin_country ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-leaf"></i> <strong>Is Organic?</strong></td>
                        <td>
                            @if(optional($product_details)->is_organic)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-sugar"></i> <strong>Is Sugar Free?</strong></td>
                        <td>
                            @if(optional($product_details)->is_sugar_free)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-gluten-free"></i> <strong>Is Gluten Free?</strong></td>
                        <td>
                            @if(optional($product_details)->is_gluten_free)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        {{-- Back Button --}}
        <div class="text-end">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" class="d-inline-block" title="Delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDeletion(event, '{{ route('products.destroy', $product->id) }}')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>

                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-info btn-sm">Edit product</a>

            <a href="{{ route('products.index') }}" class="btn btn-info btn-fw">Back to List</a>
        </div>
    </div>
</div>





<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
     style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 400px;">
        <p class="mb-3">Are you sure you want to delete this product?</p>
        <button id="confirmButton" class="btn btn-danger w-100 mb-2">Delete</button>
        <button id="cancelButton" class="btn btn-secondary w-100">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function () {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // Laravel CSRF token
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        };

        // Set up the cancel button to hide the modal
        cancelButton.onclick = function () {
            modal.style.display = 'none';
        };
    }
</script>
@endsection
