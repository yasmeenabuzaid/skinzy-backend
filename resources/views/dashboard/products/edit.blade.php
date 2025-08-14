@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> <i class="bi bi-bag "></i> Edit product
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payments</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <section style="margin: 20px">
            <div class="main-panel">
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title"></h5>

                    <div class="col-12">
                        <label class="form-label">Current Product Images</label><br>
                        <div class="row">
                            @foreach ($productImages as $productImage)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ asset($productImage->image) }}" class="img-fluid rounded" alt="Product Image"
                                         style="height: 200px; object-fit: cover; width: 100%;">
                                    <form action="{{ route('product_images.destroy', $productImage->id) }}" method="POST"  title="Delete">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            onclick="confirmDeletion(event, '{{ route('product_images.destroy', $productImage->id) }}')"
                                            style="margin: 10px;">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <form id="profileForm" class="row g-3" action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-12">
                            <label for="image" class="form-label">Choose product images</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple/>
                        </div>

                        <div class="col-12">
                            <label for="exampleInputName1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name', $product->name) }}" required>
                        </div>
                        <div class="col-12">
                            <label for="exampleInputName1" class="form-label">Name In Arabic</label>
                            <input type="text" class="form-control" id="name_ar" placeholder="Name" name="name_ar" value="{{ old('name_ar', $product->name_ar) }}" required>
                        </div>

                        <div class="col-12">
                            <label for="exampleInputName1" class="form-label">Small Description </label>
                            <input type="text" class="form-control" id="small_description" placeholder="Small Description" name="small_description" value="{{ old('small_description', $product->small_description) }}" required>
                        </div>

                        <div class="col-12">
                            <label for="exampleInputEmail3" class="form-label">Description</label>
                            <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label for="exampleInputName1" class="form-label">Small Description  In Arabic</label>
                            <input type="text" class="form-control" id="small_description_ar" placeholder="Small Description" name="small_description_ar" value="{{ old('small_description_ar', $product->small_description_ar) }}" required>
                        </div>
                        <div class="col-12">
                            <label for="code" class="form-label">product code</label>
                            <input type="text" class="form-control" id="code" placeholder="product code" name="code" value="{{ old('code', $product->code) }}" required>
                        </div>

                        <div class="col-12">
                            <label for="exampleInputEmail3" class="form-label">Description  In Arabic</label>
                            <textarea class="form-control" id="description_ar" placeholder="Description" name="description_ar" required>{{ old('description_ar', $product->description_ar) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Current Price</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                            <small class="text-muted">Price after discount if applicable</small>
                        </div>

                        <div class="col-md-6">
                            <label for="price_after_discount" class="form-label">price after discount </label>
                            <input type="text" name="price_after_discount" class="form-control" value="{{ old('price_after_discount', $product->price_after_discount) }}">
                        </div>

                        {{-- <div class="col-12">
                            <label for="exampleInputName1" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" placeholder="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="1" step="1">
                        </div> --}}

                        <div class="col-12">
                            <label for="sub_category_id" class="form-label">Category - Sub Category</label>
                            <select class="form-control form-control-sm" id="sub_category_id" name="sub_category_id">
                                <option value="">-- Select Sub Category --</option>
                                @foreach ($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}"
                                        {{ old('sub_category_id', $product->sub_category_id) == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                                <div class="col-md-6">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select name="brand_id" class="form-control">
                                     @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        <br>

                  <br>
<h5>Specifications</h5>
<div id="specifications-container">
    @php
        $specIndex = 0;
    @endphp

    @foreach ($product->specifications as $spec)
        <div class="row g-3 mb-3 align-items-center">
            <div class="col-md-3">
                <input type="text" name="specifications[{{ $specIndex }}][key]" class="form-control" placeholder="Key (e.g. Color)" value="{{ old('specifications.'.$specIndex.'.key', $spec->key) }}" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="specifications[{{ $specIndex }}][key_ar]" class="form-control" placeholder="Key (Arabic)" value="{{ old('specifications.'.$specIndex.'.key_ar', $spec->key_ar) }}" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="specifications[{{ $specIndex }}][value]" class="form-control" placeholder="Value (e.g. Red)" value="{{ old('specifications.'.$specIndex.'.value', $spec->value) }}" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="specifications[{{ $specIndex }}][value_ar]" class="form-control" placeholder="Value (Arabic)" value="{{ old('specifications.'.$specIndex.'.value_ar', $spec->value_ar) }}" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-danger remove-specification">×</button>
            </div>
        </div>
        @php $specIndex++; @endphp
    @endforeach
</div>
<button type="button" class="btn btn-sm btn-secondary mt-2" id="add-specification">
    <i class="bi bi-plus-circle"></i> Add Specification
</button>

                        <div class="text-end mt-3">
                            <button type="button" id="editButton" class="btn btn-info">Edit</button>
                            <a href="{{route('products.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Image Deletion Confirmation Modal -->
            <div id="confirmationModalDelete"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                    <p>Are you sure you want to delete this image?</p>
                    <button id="confirmButtonDelete" class="btn btn-outline-danger">Delete</button>
                    <button id="cancelButtonDelete" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </div>

            <!-- Service Update Confirmation Modal -->
            <div id="confirmationModalUpdate"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                    <h5>Are you sure you want to edit this product?</h5>
                    <button id="confirmButtonUpdate" class="btn btn-info btn-fw">Edit</button>
                    <button id="cancelButtonUpdate" class="btn btn-secondary">Cancel</button>
                </div>
            </div>

<script>
// Function for Confirming Deletion of Image
function confirmDeletion(event, url) {
    event.preventDefault(); // Prevent the form submission
    var modal = document.getElementById('confirmationModalDelete');
    var confirmButton = document.getElementById('confirmButtonDelete');
    var cancelButton = document.getElementById('cancelButtonDelete');

    // Show the confirmation modal
    modal.style.display = 'flex';

    // Set up the confirm button to submit the form
    confirmButton.onclick = function () {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = url;

        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
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

// Function for Confirming Update of Service
document.getElementById('editButton').onclick = function (event) {
    event.preventDefault(); // Prevent the form submission
    var modal = document.getElementById('confirmationModalUpdate');
    modal.style.display = 'flex'; // Show the modal
};

document.getElementById('confirmButtonUpdate').onclick = function () {
    document.getElementById('profileForm').submit(); // Submit the form
};

document.getElementById('cancelButtonUpdate').onclick = function () {
    document.getElementById('confirmationModalUpdate').style.display = 'none'; // Hide the modal
};
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Check if bootstrap is loaded
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap JS is not loaded. Please make sure to include it in your master layout.');
        return; // Stop the script if bootstrap is not available
    }

    // --- Tab Navigation Logic (Improved) ---
    const tabElms = document.querySelectorAll('.form-wizard-nav .nav-link');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');

    // Function to update button visibility based on the active tab
    const updateButtonStates = () => {
        const activeTab = document.querySelector('.form-wizard-nav .nav-link.active');
        if (!activeTab) return;

        const activeLi = activeTab.parentElement;
        const allLis = Array.from(activeLi.parentElement.children);
        const currentIndex = allLis.indexOf(activeLi);

        prevBtn.style.display = (currentIndex === 0) ? 'none' : 'inline-block';
        nextBtn.style.display = (currentIndex === tabElms.length - 1) ? 'none' : 'inline-block';
        submitBtn.style.display = (currentIndex === tabElms.length - 1) ? 'inline-block' : 'none';
    };

    // Event listener for the "Next" button
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            const activeTab = document.querySelector('.form-wizard-nav .nav-link.active');
            const nextTabEl = activeTab.parentElement.nextElementSibling?.querySelector('.nav-link');
            if (nextTabEl) {
                const tab = new bootstrap.Tab(nextTabEl);
                tab.show();
            }
        });
    }

    // Event listener for the "Previous" button
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            const activeTab = document.querySelector('.form-wizard-nav .nav-link.active');
            const prevTabEl = activeTab.parentElement.previousElementSibling?.querySelector('.nav-link');
            if (prevTabEl) {
                const tab = new bootstrap.Tab(prevTabEl);
                tab.show();
            }
        });
    }

    // Update buttons whenever a new tab is shown
    tabElms.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', updateButtonStates);
    });

    // Set initial button states on page load
    updateButtonStates();

    // --- Specifications Repeater Logic ---
    const specsContainer = document.getElementById('specifications-container');
    const addSpecBtn = document.getElementById('add-specification');

    // Initialize specIndex from Blade variable
    let specIndex = {{ $specIndex ?? 0 }};

    function addSpecificationRow() {
        const newGroup = document.createElement('div');
        newGroup.classList.add('row', 'g-3', 'mb-3', 'align-items-center');

        newGroup.innerHTML = `
            <div class="col-md-3"><input type="text" name="specifications[${specIndex}][key]" class="form-control" placeholder="Key (e.g. Color)" required></div>
            <div class="col-md-3"><input type="text" name="specifications[${specIndex}][key_ar]" class="form-control" placeholder="Key (Arabic)" required></div>
            <div class="col-md-3"><input type="text" name="specifications[${specIndex}][value]" class="form-control" placeholder="Value (e.g. Red)" required></div>
            <div class="col-md-2"><input type="text" name="specifications[${specIndex}][value_ar]" class="form-control" placeholder="Value (Arabic)" required></div>
            <div class="col-md-1"><button type="button" class="btn btn-sm btn-danger remove-specification">×</button></div>
        `;

        specsContainer.appendChild(newGroup);
        specIndex++;
    }

    addSpecBtn.addEventListener('click', addSpecificationRow);

    specsContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-specification')) {
            e.target.closest('.row').remove();
        }
    });
});
</script>

@endsection
