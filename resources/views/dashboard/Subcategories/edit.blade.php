@extends('layouts.dashboard_master')



@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle" style="margin-top: 30px;">
    <h1><i class="bi bi-stack"></i> Edit sub category</h1>
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

        <h5 class="card-title"></h5>

                    <form id="profileForm" class="row g-3" action="{{ route('subCategories.update',$subCategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$subCategory->name}}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleSelectGender" class="form-label">Category name</label>
                        <select  class="form-control form-control-sm" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                            <option @selected($category->id == $subCategory->category_id) value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                        </select>
                      </div>

                      <div class="col-12">
                    <label for="image" class="form-label">Current image</label><br>
                    @if($subCategory->image)
                        <img src="{{ asset('uploads/subcategory/' . $subCategory->image) }}" alt="Category image" style="width: 100px;">
                    @else
                        <span>No image available</span>
                    @endif
                </div>

                      <div class="col-12">
                            <label for="image" class="form-label">Upload new image</label>
                            <input type="file" name="image" id="image" class="form-control">
                      </div>

                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="discount" placeholder="Discount" name="discount" value="{{$subCategory->discount}}" >
                      </div>


                      <div class="text-end">
                      <button type="button" id="editButton" class="btn btn-info">Edit</button>
                      <a href="{{route('subCategories.index')}}" class="btn btn-secondary">Cancel</a>
                      </div>
                    </form>
                  </div>
                </div>



              <div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                    <h5>Are you sure you want to edit this sub category?</h5>
                    <button id="confirmButton" class="btn btn-info btn-fw">Edit</button>
                    <button id="cancelButton" class="btn btn-secondary">Cancel</button>
                </div>
            </div>


            <script>
              var modal = document.getElementById('confirmationModal');
              var form = document.getElementById('profileForm');

              document.getElementById('editButton').onclick = function (event) {
                  event.preventDefault();
                  modal.style.display = 'flex';
              };

              document.getElementById('confirmButton').onclick = function () {
                  form.submit();
              };

              // Set up the cancel button to close the modal
              document.getElementById('cancelButton').onclick = function () {
                  modal.style.display = 'none';
              };
          </script>

@endsection
