@extends('layouts.dashboard_master')

@section('content')

<div class="pagetitle mt-4 mb-3 d-flex justify-content-between align-items-center">
    <h1><i class="bi bi-grid"></i> Add New Category</h1>
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

<div class="card shadow-sm">
    <div class="card-body p-4">
        <h5 class="card-title mb-4">Category Details</h5>

        <form class="row g-3" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-md-12">
                <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       name="name"
                       placeholder="Enter category name"
                       value="{{ old('name') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="name" class="form-label">Category Name In Arabic<span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('name_ar') is-invalid @enderror"
                       id="name_ar"
                       name="name_ar"
                       placeholder="Enter category name in arabic"
                       value="{{ old('name_ar') }}"
                       required>
                @error('name_ar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="image" class="form-label">Category Image</label>
                <input type="file"
                       name="image"
                       id="image"
                       class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-plus-circle me-1"></i> Create
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
