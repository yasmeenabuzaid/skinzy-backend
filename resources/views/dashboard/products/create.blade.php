@extends('layouts.dashboard_master')

@section('content')
<section style="margin-top: 40px">
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"><i class="bi bi-bag"></i> Add New Product</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
          <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
      </nav>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="card">
      <div class="card-body">
        <form class="row g-3" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- ========== Section: Type ========== -->
          <h5 class="mt-4">Product Type</h5>
          <div class="col-md-6">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type" required>
              <option value="main" {{ old('type') == 'main' ? 'selected' : '' }}>Main Product</option>
              <option value="variation" {{ old('type') == 'variation' ? 'selected' : '' }}>Variation</option>
            </select>
          </div>

          <div class="col-md-6" id="parentProductContainer" style="display: none;">
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

          <!-- ========== Section: Basic Info ========== -->
          <h5 class="mt-4">Basic Information</h5>
          <div class="col-md-6">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          </div>

          <div class="col-md-6">
            <label for="image" class="form-label">Product Images</label>
            <input type="file" name="image[]" class="form-control" multiple>
          </div>

          <div class="col-md-6">
            <label for="price" class="form-label">Current Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
            <small class="text-muted">Price after discount if applicable</small>
          </div>

          <div class="col-md-6">
            <label for="price_after_discount" class="form-label">price after discount </label>
            <input type="text" name="price_after_discount" class="form-control" value="{{ old('price_after_discount') }}">
          </div>

          <div class="col-md-6">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" value="{{ old('quantity') }}">
          </div>

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
            <label for="small_description" class="form-label">Short Description</label>
            <input type="text" name="small_description" class="form-control" value="{{ old('small_description') }}">
          </div>

          <div class="col-md-6">
            <label for="description" class="form-label">Full Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
          </div>

        <!-- ========== Section: Product Details (From product_details table) ========== -->
<h5 class="mt-4">Product Characteristics</h5>

<div class="col-md-6">
    <label for="brand" class="form-label">Brand</label>
    <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
</div>

<div class="col-md-6">
    <label for="shade" class="form-label">Shade</label>
    <input type="text" name="shade" class="form-control" value="{{ old('shade') }}">
</div>

<div class="col-md-6">
    <label for="finish" class="form-label">Finish</label>
    <select name="finish" class="form-control">
        <option value="">-- Select Finish --</option>
        @foreach(['matte', 'glossy', 'satin', 'shimmer'] as $finish)
            <option value="{{ $finish }}" {{ old('finish') == $finish ? 'selected' : '' }}>{{ ucfirst($finish) }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-6">
    <label for="skin_type" class="form-label">Skin Type</label>
    <select name="skin_type" class="form-control">
        <option value="">-- Select Skin Type --</option>
        @foreach(['oily', 'dry', 'combination', 'sensitive'] as $type)
            <option value="{{ $type }}" {{ old('skin_type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-6">
    <label for="ingredients" class="form-label">Ingredients</label>
    <textarea name="ingredients" class="form-control">{{ old('ingredients') }}</textarea>
</div>



<div class="col-md-6">
    <label for="volume" class="form-label">Volume (e.g. 30ml)</label>
    <input type="text" name="volume" class="form-control" value="{{ old('volume') }}">
</div>

<div class="col-md-6">
    <label for="usage_instructions" class="form-label">Usage Instructions</label>
    <textarea name="usage_instructions" class="form-control">{{ old('usage_instructions') }}</textarea>
</div>


          <!-- ========== Actions ========== -->
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-info">Create</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
</section>

<!-- Show/Hide Parent Product -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const typeSelect = document.getElementById('type');
  const parentContainer = document.getElementById('parentProductContainer');

  function toggleParentProduct() {
    parentContainer.style.display = (typeSelect.value === 'variation') ? 'block' : 'none';
  }

  typeSelect.addEventListener('change', toggleParentProduct);
  toggleParentProduct();
});
</script>
@endsection
