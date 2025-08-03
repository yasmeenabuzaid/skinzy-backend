@extends('layouts.dashboard_master')

@section('content')
<div class="pagetitle mt-4 mb-3">
  <h1><i class="bi bi-grid"></i> Edit Category</h1>
</div>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card">
  <div class="card-body">
    <form id="profileForm" class="row g-3 mt-3" action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="col-12">
        <label for="name" class="form-label fw-bold">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ $category->name }}" required>
      </div>
      <div class="col-12">
        <label for="name" class="form-label fw-bold">Category Name In Arabic</label>
        <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="Enter name in arabic" value="{{ $category->name_ar }}" required>
      </div>

      <div class="col-12">
        <label class="form-label fw-bold">Current Image</label><br>
        @if($category->image)
          <img src="{{ asset($category->image) }}" alt="Category Image" class="img-thumbnail" style="max-width: 150px;">
        @else
          <p class="text-muted">No image available</p>
        @endif
      </div>

      <div class="col-12">
        <label for="image" class="form-label fw-bold">Upload New Image</label>
        <input type="file" name="image" id="image" class="form-control">
      </div>

      <div class="col-12 text-end">
        <button type="button" id="editButton" class="btn btn-primary">Edit</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>

{{-- Confirmation Modal --}}
<div id="confirmationModal" class="d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center" style="z-index: 1050;">
  <div class="bg-white p-4 rounded shadow text-center" style="width: 300px;">
    <h5 class="mb-3">Are you sure you want to edit this category?</h5>
    <div class="d-flex justify-content-between">
      <button id="confirmButton" class="btn btn-primary w-50 me-2">Edit</button>
      <button id="cancelButton" class="btn btn-secondary w-50">Cancel</button>
    </div>
  </div>
</div>

{{-- Script --}}
<script>
  const modal = document.getElementById('confirmationModal');
  const form = document.getElementById('profileForm');
  const editBtn = document.getElementById('editButton');
  const confirmBtn = document.getElementById('confirmButton');
  const cancelBtn = document.getElementById('cancelButton');

  editBtn.onclick = function (e) {
    e.preventDefault();
    modal.classList.remove('d-none');
  };

  confirmBtn.onclick = function () {
    form.submit();
  };

  cancelBtn.onclick = function () {
    modal.classList.add('d-none');
  };
</script>
@endsection
