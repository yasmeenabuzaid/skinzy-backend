@extends('layouts.dashboard_master')



@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle" style="margin-top: 30px;">
    <h1><i class="bi bi-stack"></i> Add new sub category</h1>
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

                    <form class="row g-3" action="{{ route('subCategories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
                      </div>
                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Name In Arabic</label>
                        <input type="text" class="form-control" id="name_ar" placeholder="Name" name="name_ar" value="{{ old('name_ar') }}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleSelectGender" class="form-label">Category name</label>

                        <select class="form-control form-control-sm" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{$category->name}}</option>
                            @endforeach
                        </select>

                      </div>

                      <div class="text-end">
                      <button type="submit" class="btn btn-primary">Create</button>
                      <a href="{{route('subCategories.index')}}" class="btn btn-secondary">Cancel</a>
                      </div>
                    </form>
                  </div>
                </div>


@endsection
