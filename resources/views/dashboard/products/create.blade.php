@extends('layouts.dashboard_master')

@section('content')
<style>
    /* --- Tab Navigation Styling --- */
    .form-wizard-nav .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        color: #6c757d; /* Softer text color */
        font-weight: 500;
        padding: 1rem;
    }
    .form-wizard-nav .nav-link.active {
        border-color: #0d6efd;
        color: #0d6efd;
        background-color: transparent;
    }
    /* Style for tabs with errors */
    .form-wizard-nav .nav-link.has-error {
        color: #dc3545 !important;
        border-bottom-color: #dc3545 !important;
    }

    .tab-content { padding: 2rem 0; }
    .tab-pane { animation: slideUpFade 0.4s ease-out; }
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- Image Uploader & Preview --- */
    #imagePreviewContainer { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 15px; }
    .img-preview-wrapper { position: relative; width: 120px; height: 120px; }
    .img-preview { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6; }
    .remove-img-btn {
        position: absolute; top: -5px; right: -5px; width: 24px; height: 24px;
        background-color: #dc3545; color: white; border: none; border-radius: 50%;
        cursor: pointer; display: flex; align-items: center; justify-content: center;
        font-size: 14px; line-height: 1;
    }
</style>

<section class="container-fluid mt-4">
    <div class="page-header d-flex justify-content-between align-items-center">
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
    <div class="alert alert-danger mt-3">
        <strong>Whoops! Please correct the errors in the highlighted tabs.</strong>
    </div>
    @endif

    <div class="card mt-3">
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
                    {{-- TAB 1: BASIC INFO --}}
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="productType" class="form-label">Product Type</label>
                                <select name="type" id="productType" class="form-select @error('type') is-invalid @enderror">
                                    <option value="main" {{ old('type', 'main') == 'main' ? 'selected' : '' }}>Main Product</option>
                                    <option value="variation" {{ old('type') == 'variation' ? 'selected' : '' }}>Variation</option>
                                </select>
                                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6" id="parentProductContainer" style="{{ old('type') == 'variation' ? 'display: block;' : 'display: none;' }}">
                                <label for="parent_product_id" class="form-label">Parent Product</label>
                                <select name="parent_product_id" id="parentProductSelect" class="form-select @error('parent_product_id') is-invalid @enderror">
                                    <option value="">-- Select Parent Product --</option>
                                    @foreach($mainProducts as $product)
                                        <option value="{{ $product->id }}" {{ old('parent_product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label">Product Name (English)</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name_ar" class="form-label">Product Name (Arabic)</label>
                                <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror" value="{{ old('name_ar') }}">
                                @error('name_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="small_description" class="form-label">Short Description (English)</label>
                                <textarea name="small_description" class="form-control @error('small_description') is-invalid @enderror" rows="3">{{ old('small_description') }}</textarea>
                                @error('small_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="small_description_ar" class="form-label">Short Description (Arabic)</label>
                                <textarea name="small_description_ar" class="form-control @error('small_description_ar') is-invalid @enderror" rows="3">{{ old('small_description_ar') }}</textarea>
                                @error('small_description_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- TAB 2: DETAILS & PRICING --}}
                    <div class="tab-pane fade" id="details" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Original Price</label>
                                <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price_after_discount" class="form-label">Price After Discount (Optional)</label>
                                <input type="number" step="0.01" name="price_after_discount" class="form-control @error('price_after_discount') is-invalid @enderror" value="{{ old('price_after_discount') }}">
                                @error('price_after_discount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="code" class="form-label">Product Code</label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
                                @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Full Description (English)</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="description_ar" class="form-label">Full Description (Arabic)</label>
                                <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror" rows="5">{{ old('description_ar') }}</textarea>
                                @error('description_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- TAB 3: ORGANIZATION & MEDIA --}}
                    <div class="tab-pane fade" id="media" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="sub_category_id" class="form-label">Category</label>
                                <select name="sub_category_id" class="form-select @error('sub_category_id') is-invalid @enderror">
                                    @foreach ($SubCategories as $SubCategory)
                                        <option value="{{ $SubCategory->id }}" {{ old('sub_category_id') == $SubCategory->id ? 'selected' : '' }}>
                                            {{ $SubCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label">Product Images</label>
                                <input type="file" name="image[]" id="imageInput" class="form-control @error('image.*') is-invalid @enderror @error('image') is-invalid @enderror" multiple accept="image/*">
                                <div id="imagePreviewContainer"></div>
                                @error('image.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- TAB 4: SPECIFICATIONS --}}
                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <div id="specifications-container">
                            {{-- Rows will be added here by JS --}}
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-specification">
                            <i class="bi bi-plus-circle"></i> Add Specification
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
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
    // --- 1. SETUP & VARIABLE DECLARATION ---
    const tabButtons = document.querySelectorAll('.form-wizard-nav .nav-link');
    const tabPanes = document.querySelectorAll('.tab-content .tab-pane');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');

    // ✨ متغير لتتبع التاب النشط حاليًا، يبدأ من الصفر
    let currentTabIndex = 0;

    // --- 2. CORE TAB FUNCTION ---
    // ✨ دالة واحدة مركزية لتحديث كل شيء متعلق بالتابات
    const updateWizardState = () => {
        // تحديث أزرار التابات العلوية (إزالة وتعيين .active)
        tabButtons.forEach((btn, index) => {
            btn.classList.toggle('active', index === currentTabIndex);
            btn.setAttribute('aria-selected', index === currentTabIndex);
        });

        // تحديث محتوى التابات (إزالة وتعيين .show.active)
        tabPanes.forEach((pane, index) => {
            pane.classList.toggle('show', index === currentTabIndex);
            pane.classList.toggle('active', index === currentTabIndex);
        });

        // تحديث أزرار التنقل السفلية (Previous/Next/Submit)
        prevBtn.style.display = (currentTabIndex === 0) ? 'none' : 'inline-block';
        nextBtn.style.display = (currentTabIndex === tabButtons.length - 1) ? 'none' : 'inline-block';
        submitBtn.style.display = (currentTabIndex === tabButtons.length - 1) ? 'inline-block' : 'none';
    };

    // --- 3. EVENT LISTENERS ---

    // ✨ عند الضغط على زر "Next"
    nextBtn.addEventListener('click', () => {
        if (currentTabIndex < tabButtons.length - 1) {
            currentTabIndex++; // زد رقم التاب الحالي
            updateWizardState(); // قم بتحديث الواجهة
        }
    });

    // ✨ عند الضغط على زر "Previous"
    prevBtn.addEventListener('click', () => {
        if (currentTabIndex > 0) {
            currentTabIndex--; // انقص رقم التاب الحالي
            updateWizardState(); // قم بتحديث الواجهة
        }
    });

    // ✨ عند الضغط مباشرة على أزرار التابات في الأعلى
    tabButtons.forEach((button, index) => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // امنع السلوك الافتراضي
            currentTabIndex = index; // حدث رقم التاب الحالي
            updateWizardState(); // قم بتحديث الواجهة
        });
    });

    // --- 4. VALIDATION ERROR HANDLING ---
    const errorFields = document.querySelectorAll('.is-invalid');
    if (errorFields.length > 0) {
        const firstErrorPane = errorFields[0].closest('.tab-pane');
        if (firstErrorPane) {
            // حول nodeList إلى Array لاستخدام indexOf
            const panesArray = Array.from(tabPanes);
            currentTabIndex = panesArray.indexOf(firstErrorPane);

            // إضافة علامة الخطأ على التاب
            const errorTabButton = tabButtons[currentTabIndex];
            if(errorTabButton) {
                errorTabButton.classList.add('has-error');
            }
        }
    }

    // --- 5. INITIALIZE PAGE STATE ---
    updateWizardState(); // تهيئة الحالة عند تحميل الصفحة لأول مرة


    // =================================================================
    // باقي الأكواد الخاصة بالصور والمواصفات تبقى كما هي بدون تغيير
    // =================================================================
    const productTypeSelect = document.getElementById('productType');
    const parentProductContainer = document.getElementById('parentProductContainer');
    const parentProductSelect = document.getElementById('parentProductSelect');
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const specsContainer = document.getElementById('specifications-container');
    const addSpecBtn = document.getElementById('add-specification');
    let files = [];
    let specIndex = 0;

    // --- CONDITIONAL FIELD LOGIC ---
    productTypeSelect.addEventListener('change', function() {
        if (this.value === 'variation') {
            parentProductContainer.style.display = 'block';
            parentProductSelect.required = true;
        } else {
            parentProductContainer.style.display = 'none';
            parentProductSelect.required = false;
            parentProductSelect.value = '';
        }
    });

    // --- IMAGE PREVIEW LOGIC ---
    imageInput.addEventListener('change', () => {
        Array.from(imageInput.files).forEach(file => {
            if (!files.some(f => f.name === file.name && f.size === file.size)) {
                files.push(file);
            }
        });
        updateImagePreview();
    });
    function updateImagePreview() {
        previewContainer.innerHTML = '';
        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = e => {
                previewContainer.innerHTML += `
                    <div class="img-preview-wrapper">
                        <img src="${e.target.result}" class="img-preview">
                        <button type="button" class="remove-img-btn" data-index="${index}">&times;</button>
                    </div>`;
            };
            reader.readAsDataURL(file);
        });
        updateFileInput();
    }
    previewContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-img-btn')) {
            files.splice(parseInt(e.target.dataset.index), 1);
            updateImagePreview();
        }
    });
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
    }

    // --- SPECIFICATIONS REPEATER LOGIC ---
    addSpecBtn.addEventListener('click', () => {
        const newGroup = document.createElement('div');
        newGroup.className = 'row g-3 mb-3 align-items-center';
        newGroup.innerHTML = `
            <div class="col-md-3"><input type="text" name="specifications[${specIndex}][key]" class="form-control" placeholder="Key (e.g. Color)" required></div>
            <div class="col-md-3"><input type="text" name="specifications[${specIndex}][key_ar]" class="form-control" placeholder="Key (Arabic)" required></div>
            <div class="col-md-3"><input type="text" name="specifications[${specIndex}][value]" class="form-control" placeholder="Value (e.g. Red)" required></div>
            <div class="col-md-2"><input type="text" name="specifications[${specIndex}][value_ar]" class="form-control" placeholder="Value (Arabic)" required></div>
            <div class="col-md-1"><button type="button" class="btn btn-sm btn-danger remove-specification">×</button></div>
        `;
        specsContainer.appendChild(newGroup);
        specIndex++;
    });
    specsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-specification')) {
            e.target.closest('.row').remove();
        }
    });
});
</script>
@endsection
