@extends('layouts.dashboard_master')

@section('content')
<section style="margin-top: 40px">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="page-header">
        <h3 class="page-title"> <i class="bi bi-grid"></i> Brands Overview </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Brands</li>
          </ol>
        </nav>
    </div>

    <a href="{{ route('brands.create') }}" style="margin-top: 30px;">
        <button type="button" class="btn btn-primary btn-sm shadow-sm">
            <i class="bi bi-plus-circle"></i> Add new brand
        </button>
    </a>
</div>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="bi bi-exclamation-octagon me-1"></i>
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success'))
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

          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($brands as $brand)
              <tr>
                <td>{{$brand->id}}</td>
                <td title="view">
                  <a href="#"
                     class="view-brand"
                     data-bs-toggle="modal"
                     data-bs-target="#brandDetailsModal"
                     data-name="{{ $brand->name }}"
                     data-image="{{ asset('uploads/brand/' . $brand->image) }}"
                     style="color:#000000;"
                     onmouseover="this.style.color='#10db8c';"
                     onmouseout="this.style.color='#000000';">
                      {{$brand->name}}
                  </a>
                </td>
                <td>
@if($brand->image)
  <img src="{{ $brand->image }}" alt="Brand Image" style="width: 50px; height: 40px;">
@else
  <span> - </span>
@endif

                </td>
                <td>
                  <a href="{{ route('brands.edit', $brand->id) }}" title="Edit">
                    <button type="button" class="btn  btn-primary">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </a>

                  <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;" title="Delete">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('brands.destroy', $brand->id) }}')">
                      <i class="bi bi-trash"></i>
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

<!-- View modal -->
<div class="modal fade" id="brandDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="brandModalTitle">Brand Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Brand Name:</strong> <span id="brandName"></span></p>
        <div id="brandImageContainer">
          <img id="brandImage" src="" alt="No image" style="width: 100%; border-radius: 8px;height:400px;">
        </div>
        <span id="noImageText" style="color: #666; font-style: italic; display: none;">No image</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- JS to populate modal -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.view-brand').forEach(link => {
          link.addEventListener('click', function () {
              const name = this.getAttribute('data-name');
              const image = this.getAttribute('data-image');

              document.getElementById('brandName').textContent = name;

              const brandImage = document.getElementById('brandImage');
              const noImageText = document.getElementById('noImageText');
              const brandImageContainer = document.getElementById('brandImageContainer');

              if (image && !image.includes('No image')) {
                  brandImage.src = image;
                  brandImageContainer.style.display = 'block';
                  noImageText.style.display = 'none';
              } else {
                  brandImageContainer.style.display = 'none';
                  noImageText.style.display = 'block';
              }
          });
      });
  });
</script>

<!-- Confirmation Modal -->
<div id="confirmationModal"
     style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
  <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
    <p>Are you sure you want to delete this brand?</p>
    <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
    <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
  </div>
</div>

<script>
  function confirmDeletion(event, url) {
      event.preventDefault();
      var modal = document.getElementById('confirmationModal');
      var confirmButton = document.getElementById('confirmButton');
      var cancelButton = document.getElementById('cancelButton');

      modal.style.display = 'flex';

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

      cancelButton.onclick = function () {
          modal.style.display = 'none';
      };
  }
</script>
@endsection
