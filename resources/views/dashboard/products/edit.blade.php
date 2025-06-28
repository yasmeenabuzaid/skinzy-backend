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
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$product->name}}" required>
                      </div>


                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Small Description</label>
                        <input type="text" class="form-control" id="small_description" placeholder="Small Description" name="small_description" value="{{$product->small_description}}" required>
                      </div>



                      <div class="col-12">
                        <label for="exampleInputEmail3" class="form-label">Description</label>
                        <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ $product->description }}</textarea>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Old price</label>
                        <input type="text" class="form-control" id="old_price" placeholder="Old price" name="old_price" value="{{$product->old_price}}">
                      </div>


                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Price with discount</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{$product->price}}" required>
                      </div>



                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="quantity" name="quantity" value="{{$product->quantity}}" min="1" step="1">
                      </div>




                      <div class="col-12">
                        <label for="exampleSelectGender" class="form-label">categoty-sub category</label>
                        <select  class="form-control form-control-sm" id="subCategory_id" name="subCategory_id">
                            @foreach ($SubCategories as $SubCategory)
                            <option @selected($SubCategory->id == $product->subCategory_id) value="{{$SubCategory->id}}">{{ $SubCategory->category->name ?? 'No Category' }} - {{$SubCategory->name}}</option>
                            @endforeach


                        </select>
                      </div>
                      <br>
                      <!-- Note -->
                      <div class="col-12">
                          <small class="form-text text-muted">
                              Note: These edititional product details (such as weight, ingredients, allergens, etc.) can be added later if needed.
                          </small>
                      </div>

                      <hr>

                      <!-- Row for Additional Product Details -->
                      <div class="col-12 col-md-6">
                          <label for="weight" class="form-label">Weight</label>
                          <input type="text" class="form-control" id="weight" placeholder="Weight (in grams)" name="weight"  value="{{$product_details->weight ?? ' '}}"/>
                      </div>
                      <div class="col-12 col-md-6">
                          <label for="ingredients" class="form-label">Ingredients</label>
                          <textarea class="form-control" id="ingredients" placeholder="Ingredients" name="ingredients">{{$product_details->ingredients ?? ' '}}</textarea>
                      </div>

                      <!-- Row for Allergens and Origin Country -->
                      <div class="col-12 col-md-6">
                          <label for="allergens" class="form-label">Allergens</label>
                          <input type="text" class="form-control" id="allergens" placeholder="Allergens" name="allergens" value="{{$product_details->allergens ?? ' '}}"/>
                      </div>
                      <div class="col-12 col-md-6">
                          <label for="origin_country" class="form-label">Origin Country</label>
                          <input type="text" class="form-control" id="origin_country" placeholder="Origin Country" name="origin_country" value="{{$product_details->origin_country ?? ' '}}"/>
                      </div>

                      <!-- Row for Checkboxes (Is Organic, Sugar Free, Gluten Free) -->
                      <div class="col-12 col-md-4">
                          <label for="is_organic" class="form-label">Is Organic?</label>
                          <input type="checkbox" id="is_organic" name="is_organic" value="1" {{ $product_details->is_organic ?? false ? 'checked' : '' }} />
                                                </div>
                      <div class="col-12 col-md-4">
                          <label for="is_sugar_free" class="form-label">Is Sugar Free?</label>
                          <input type="checkbox" id="is_sugar_free" name="is_sugar_free" value="1" {{ $product_details->is_sugar_free ?? false ? 'checked' : '' }} />
                      </div>
                      <div class="col-12 col-md-4">
                          <label for="is_gluten_free" class="form-label">Is Gluten Free?</label>
                          <input type="checkbox" id="is_gluten_free" name="is_gluten_free" value="1" {{ $product_details->is_gluten_free ?? false ? 'checked' : '' }} />
                      </div>

                      <div class="text-end">
                      <button type="button" id="editButton"  class="btn btn-info">Edit</button>
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


@endsection
