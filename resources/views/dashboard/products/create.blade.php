@extends('layouts.dashboard_master')

@section('content')
<section style="margin-top: 40px">
<div class="d-flex justify-content-between align-items-center mb-4">

            <div class="main-panel">
                <div class="content-wrapper">
                  <div class="page-header">
                    <h3 class="page-title">   <i class="bi bi-bag "></i> Add new product
                    </h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="card">
                      <div class="row">
                        <div class="col-12">



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

    <form class="row g-3" action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
<div class="col-12 col-md-6">
    <label for="type" class="form-label">Product Type</label>
    <select class="form-control" id="type" name="type" required>
        <option value="main" {{ old('type') == 'main' ? 'selected' : '' }}>Main Product</option>
        <option value="variation" {{ old('type') == 'variation' ? 'selected' : '' }}>Variation</option>
    </select>
</div>

<div class="col-12 col-md-6" id="parentProductContainer" style="display: none;">
    <label for="parent_product_id" class="form-label">Parent Product</label>
    <select class="form-control" id="parent_product_id" name="parent_product_id">
        <option value="">-- Select Parent Product --</option>
        @foreach ($mainProducts as $mainProduct)
            <option value="{{ $mainProduct->id }}" {{ old('parent_product_id') == $mainProduct->id ? 'selected' : '' }}>
                {{ $mainProduct->name }}
            </option>
        @endforeach
    </select>
</div>






        <!-- Row for Name and Image -->
        <div class="col-12 col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="col-12 col-md-6">
            <label for="image" class="form-label">Choose product images</label>
            <input type="file" name="image[]" id="image" class="form-control" multiple/>
        </div>

        <!-- Row for Small Description and Price -->
        <div class="col-12 col-md-6">
            <label for="old_price">Old price</label>
            <input type="text" class="form-control" id="old_price" placeholder="Old price" name="old_price" value="{{ old('old_price') }}"/>
        </div>
        <div class="col-12 col-md-6">
            <label for="price">Price with discount</label>
            <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{ old('price') }}" required>
            <small class="form-text text-muted">
                Note: If you don't have a discount, please insert the original price.
            </small>
        </div>
        <div class="col-12 col-md-6">
            <label for="small_description" class="form-label">Small Description</label>
            <input type="text" class="form-control" id="small_description" placeholder="Small Description" name="small_description" value="{{ old('small_description') }}" required>
        </div>


        <!-- Row for Description and Old Price -->
        <div class="col-12 col-md-6">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ old('description') }}</textarea>
        </div>


        <div class="col-12 col-md-6">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" min="1" step="1"/>
        </div>

        <!-- Row for Brand (SubCategory) -->
        <div class="col-12 col-md-6">
            <label for="subCategory_id" class="form-label">Category - Sub Category </label>
            <select class="form-control form-control-sm" id="subCategory_id" name="subCategory_id">
                @foreach ($SubCategories as $SubCategory)
                    <option value="{{$SubCategory->id}}" {{ old('subCategory_id') == $SubCategory->id ? 'selected' : '' }}>{{ $SubCategory->category->name ?? 'No Category' }} - {{$SubCategory->name}}</option>
                @endforeach
            </select>
        </div>
<br>
        <!-- Note -->
        <div class="col-12">
            <small class="form-text text-muted">
                Note: These additional product details (such as weight, ingredients, allergens, etc.) can be added later if needed.
            </small>
        </div>

        <hr>

        <!-- Row for Additional Product Details -->
        <div class="col-12 col-md-6">
            <label for="weight" class="form-label">Weight</label>
            <input type="text" class="form-control" id="weight" placeholder="Weight (in grams)" name="weight" value="{{ old('weight') }}"/>
        </div>
        <div class="col-12 col-md-6">
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea class="form-control" id="ingredients" placeholder="Ingredients" name="ingredients">{{ old('ingredients') }}</textarea>
        </div>

        <!-- Row for Allergens and Origin Country -->
        <div class="col-12 col-md-6">
            <label for="allergens" class="form-label">Allergens</label>
            <input type="text" class="form-control" id="allergens" placeholder="Allergens" name="allergens" value="{{ old('allergens') }}"/>
        </div>
        <div class="col-12 col-md-6">
            <label for="origin_country" class="form-label">Origin Country</label>
            <input type="text" class="form-control" id="origin_country" placeholder="Origin Country" name="origin_country" value="{{ old('origin_country') }}"/>
        </div>

        <!-- Row for Checkboxes (Is Organic, Sugar Free, Gluten Free) -->
        <div class="col-12 col-md-4">
            <label for="is_organic" class="form-label">Is Organic?</label>
            <input type="checkbox" id="is_organic" name="is_organic" value="1" {{ old('is_organic') ? 'checked' : '' }}/>
        </div>
        <div class="col-12 col-md-4">
            <label for="is_sugar_free" class="form-label">Is Sugar Free?</label>
            <input type="checkbox" id="is_sugar_free" name="is_sugar_free" value="1" {{ old('is_sugar_free') ? 'checked' : '' }}/>
        </div>
        <div class="col-12 col-md-4">
            <label for="is_gluten_free" class="form-label">Is Gluten Free?</label>
            <input type="checkbox" id="is_gluten_free" name="is_gluten_free" value="1" {{ old('is_gluten_free') ? 'checked' : '' }}/>
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="text-end">
            <button type="submit" class="btn btn-info">Create</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const parentContainer = document.getElementById('parentProductContainer');

    function toggleParentProduct() {
        if (typeSelect.value === 'variation') {
            parentContainer.style.display = 'block';
        } else {
            parentContainer.style.display = 'none';
        }
    }

    typeSelect.addEventListener('change', toggleParentProduct);
    toggleParentProduct(); // initial check on page load
});
</script>


@endsection
