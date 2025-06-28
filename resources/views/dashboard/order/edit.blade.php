@extends('layouts.dashboard_master')



@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle">
    <h1></h1>
  </div>
     
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
      
      <h5 class="card-title">Edit product</h5>

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
                                  <button type="button" class="btn btn-danger" 
                                      onclick="confirmDeletion(event, '{{ route('product_images.destroy', $productImage->id) }}')"
                                      style="margin: 10px;">
                                      <i class="bi bi-archive"></i>
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
                        <label for="exampleInputName1" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{$product->price}}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="discount" placeholder="Discount" name="discount" value="{{$product->discount}}" >
                      </div>


                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="quantity" name="quantity" value="{{$product->quantity}}" min="1" step="1">
                      </div>

                     

                      
                      <div class="col-12">
                        <label for="exampleSelectGender" class="form-label">Brand</label>
                        <select  class="form-control form-control-sm" id="subCategory_id" name="subCategory_id">
                            @foreach ($SubCategories as $SubCategory)
                            <option @selected($SubCategory->id == $product->subCategory_id) value="{{$SubCategory->id}}">{{ $SubCategory->category->name ?? 'No Category' }} - {{$SubCategory->name}}</option>
                            @endforeach
                           

                        </select>
                      </div>

                      <div class="text-center">
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