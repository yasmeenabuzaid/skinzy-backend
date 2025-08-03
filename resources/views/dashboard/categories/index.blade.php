@extends('layouts.dashboard_master')

@section('content')
    <section style="margin-top: 40px">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="page-header">
                <h3 class="page-title"> <i class="bi bi-grid"></i> Categories Overview </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>

            <a href="{{ route('categories.create') }}" style="margin-top: 30px;">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add new category
                </button>
            </a>

        </div>




        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>

                            <!-- Table with stripped rows -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>ِArabic Name</th>
                                        <th>Image</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>

                                            <td title="view">
                                                {{ $category->name }}
                                            </td>
                                            <td title="view">
                                                {{ $category->name_ar }}
                                            </td>

                                            <td>
                                                @if ($category->image)
                                                    <img src="{{ asset($category->image) }}" alt="Category Image"
                                                        style="width: 50px; height: 40px;">
                                            </td>
                                        @else
                                            <span> - </span>
                                    @endif
                                    <td>





                                        <a href="{{ route('categories.edit', $category->id) }}" title="Edit">
                                            <button type="button" class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('categories.softDelete', $category->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger" title="Mark as Deleted">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>


                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>








        <!-- Custom Confirmation Modal -->
        <div id="confirmationModal"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
            <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                <p>Are you sure you want to delete this category?</p>
                <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
                <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
            </div>
        </div>
    @endsection
