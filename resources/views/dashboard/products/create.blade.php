@extends('layouts.dashboard_master')

@section('content')
<style>
    /* --- Tab Navigation Styling --- */
    .form-wizard-nav .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        color: var(--secondary-text);
        font-weight: 500;
        padding: 1rem;
    }
    .form-wizard-nav .nav-link.active {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background-color: transparent;
    }
    .tab-content {
        padding: 2rem 0;
    }
    .tab-pane {
        animation: slideUpFade 0.4s ease-out;
    }
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- Image Uploader & Preview --- */
    #imagePreviewContainer {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
    }
    .img-preview-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
    }
    .img-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .remove-img-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 24px;
        height: 24px;
        background-color: var(--danger-color);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        line-height: 1;
    }
</style>
<section style="margin-top: 40px">

    <div class="page-header">
        <h3 class="page-title"><i class="bi bi-box-seam-fill"></i> Add New Product</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops! Please correct the errors in the highlighted tabs.</strong>
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="card">
        <div class="card-body" style="padding: 30px;">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-tabs form-wizard-nav" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab">1. Basic Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">2. Details & Pricing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab">3. Organization & Media</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">4. Specifications</button>
                    </li>
                </ul>

                <div class="tab-content" id="productTabContent">

                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel">
                        <div class="row g-3">
                             {{-- ===================== الكود الجديد يبدأ هنا ===================== --}}

        <div class="col-md-6">
            <label for="productType" class="form-label">Product Type</label>
            <select name="type" id="productType" class="form-control">
                <option value="main" selected>Main Product</option>
                <option value="variation">Variation</option>
            </select>
        </div>

        {{-- هذا الحقل سيظهر بشكل شرطي --}}
        <div class="col-md-6" id="parentProductContainer" style="display: none;">
            <label for="parent_product_id" class="form-label">Parent Product</label>
            <select name="parent_product_id" id="parentProductSelect" class="form-control">
                <option value="">-- Select Parent Product --</option>
                @foreach($mainProducts as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- ===================== الكود الجديد ينتهي هنا ===================== --}}
                            <div class="col-md-6">
                                <label for="name" class="form-label">Product Name (English)</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name_ar" class="form-label">Product Name (Arabic)</label>
                                <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="small_description" class="form-label">Short Description (English)</label>
                                <textarea name="small_description" class="form-control" rows="3">{{ old('small_description') }}</textarea>
                            </div>
                             <div class="col-md-12">
                                <label for="small_description_ar" class="form-label">Short Description (Arabic)</label>
                                <textarea name="small_description_ar" class="form-control" rows="3">{{ old('small_description_ar') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="details" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Original Price</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="price_after_discount" class="form-label">Price After Discount (Optional)</label>
                                <input type="number" step="0.01" name="price_after_discount" class="form-control" value="{{ old('price_after_discount') }}">
                            </div>
                             {{-- <div class="col-md-6">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" min="0" value="{{ old('quantity') }}">
                            </div> --}}
                            <div class="col-md-12">
                                <label for="description" class="form-label">Full Description (English)</label>
                                <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                            </div>
<div class="col-md-12">
    <label for="code" class="form-label">Product Code</label>
    <input type="text" name="code" class="form-control" value="{{ old('code') }}">
</div>

                            <div class="col-md-12">
                                <label for="description_ar" class="form-label">Full Description (Arabic)</label>
                                <textarea name="description_ar" class="form-control" rows="5">{{ old('description_ar') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="media" role="tabpanel">
                         <div class="row g-3">
                            <div class="col-md-6">
                                <label for="sub_category_id" class="form-label">Category</label>
                                <select name="sub_category_id" class="form-control">
                                    @foreach ($SubCategories as $SubCategory)
                                        <option value="{{ $SubCategory->id }}" {{ old('sub_category_id') == $SubCategory->id ? 'selected' : '' }}>
                                            {{ $SubCategory->name }}
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
                            <div class="col-12">
                                <label for="image" class="form-label">Product Images</label>
                                <input type="file" name="image[]" id="imageInput" class="form-control" multiple accept="image/*">
                                <div id="imagePreviewContainer"></div>
                            </div>
                         </div>
                    </div>

                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <div id="specifications-container">
                            </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-specification">
                            <i class="bi bi-plus-circle"></i> Add Specification
                        </button>
                    </div>

                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">Previous</button>
                    <div>
                        <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                        <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">Create Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


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
    nextBtn.addEventListener('click', () => {
        const activeTab = document.querySelector('.form-wizard-nav .nav-link.active');
        const nextTabEl = activeTab.parentElement.nextElementSibling?.querySelector('.nav-link');
        if (nextTabEl) {
            const tab = new bootstrap.Tab(nextTabEl);
            tab.show();
        }
    });

    // Event listener for the "Previous" button
    prevBtn.addEventListener('click', () => {
        const activeTab = document.querySelector('.form-wizard-nav .nav-link.active');
        const prevTabEl = activeTab.parentElement.previousElementSibling?.querySelector('.nav-link');
        if (prevTabEl) {
            const tab = new bootstrap.Tab(prevTabEl);
            tab.show();
        }
    });

    // Update buttons whenever a new tab is shown
    tabElms.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', updateButtonStates);
    });

    // Set initial button states on page load
    updateButtonStates();

    // --- Image preview logic (No changes needed) ---
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    let files = [];

    imageInput.addEventListener('change', () => {
        for(const file of imageInput.files) {
            if (!files.some(f => f.name === file.name && f.size === file.size)) {
                files.push(file);
            }
        }
        updateImagePreview();
    });

    function updateImagePreview() {
        previewContainer.innerHTML = '';
        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = e => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('img-preview-wrapper');
                wrapper.innerHTML = `
                    <img src="${e.target.result}" class="img-preview">
                    <button type="button" class="remove-img-btn" data-index="${index}">&times;</button>
                `;
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
        updateFileInput();
    }

    previewContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-img-btn')) {
            const indexToRemove = parseInt(e.target.getAttribute('data-index'));
            files.splice(indexToRemove, 1);
            updateImagePreview();
        }
    });

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
    }

    // --- Specifications Repeater Logic (Corrected) ---
    const specsContainer = document.getElementById('specifications-container');
    const addSpecBtn = document.getElementById('add-specification');
    let specIndex = 0;

    function addSpecificationRow() {
        const newGroup = document.createElement('div');
        newGroup.classList.add('row', 'g-3', 'mb-3', 'align-items-center');
        // Added 'required' to ensure fields are not submitted empty
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

    // Event listener for the "Add Specification" button
    addSpecBtn.addEventListener('click', addSpecificationRow);

    // Event listener for removing a specification row
    specsContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-specification')) {
            e.target.closest('.row').remove();
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ... الكود السابق الخاص بالتبويبات والصور والمواصفات ...

    // --- Logic for Product Type selection ---
    const productTypeSelect = document.getElementById('productType');
    const parentProductContainer = document.getElementById('parentProductContainer');
    const parentProductSelect = document.getElementById('parentProductSelect');

    productTypeSelect.addEventListener('change', function() {
        if (this.value === 'variation') {
            parentProductContainer.style.display = 'block'; // إظهار حقل المنتج الأب
            parentProductSelect.required = true; // جعله حقلاً مطلوباً
        } else {
            parentProductContainer.style.display = 'none'; // إخفاء الحقل
            parentProductSelect.required = false; // جعله غير مطلوب
            parentProductSelect.value = ''; // تفريغ القيمة عند الإخفاء
        }
    });

});
</script>
@endsection
