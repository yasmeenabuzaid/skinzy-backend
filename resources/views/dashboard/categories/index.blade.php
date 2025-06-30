@extends('layouts.dashboard_master')

@section('content')
<section style="margin-top: 40px">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="page-header">
        <h3 class="page-title"> <i class="bi bi-grid"></i> Categories Overview </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
          </ol>
        </nav>
    </div>

        <a href="{{ route('categories.create') }}" style="margin-top: 30px;">
            <button type="button" class="btn btn-primary btn-sm shadow-sm">
                <i class="bi bi-plus-circle"></i> Add new category
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
          <h5 class="card-title"></h5>

          <!-- Table with stripped rows -->
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
                        @foreach($categories as $category)
                        <tr>
                          <td>{{$category->id}}</td>

                          <td title="view">
                            <a href="#"
                               class="view-category"
                               data-bs-toggle="modal"
                               data-bs-target="#categoryDetailsModal"
                               data-name="{{ $category->name }}"
                               data-image="{{ asset('uploads/category/' . $category->image) }}"
                               style="color:#000000;"
                               onmouseover="this.style.color='#10db8c';"
                               onmouseout="this.style.color='#000000';">
                                {{$category->name}}
                            </a>
                        </td>

                          <td>
                          @if($category->image)

                            <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Category Image" style="width: 50px; height: 40px;"></td>
                          @else
                              <span> - </span>
                          @endif
                          <td>





                          <a href="{{ route('categories.edit', $category->id) }}"  title="Edit">
                          <button type="button"  class="btn btn-outline-info btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                          </a>
<form action="{{ route('categories.softDelete', $category->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-outline-warning btn-sm" title="Mark as Deleted">
        <i class="bi bi-x-circle"></i> Mark Deleted
    </button>
</form>

                          {{-- <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm"  onclick="confirmDeletion(event, '{{ route('categories.destroy', $category->id) }}')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form> --}}

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
<div class="modal fade" id="categoryDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="categoryModalTitle">Category Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p><strong>Category Name:</strong> <span id="categoryName"></span></p>
              <div id="categoryImageContainer">
                  <img id="categoryImage" src="" alt=" No image" style="width: 100%; border-radius: 8px;height:400px;">
              </div>
              <span id="noImageText" style="color: #666; font-style: italic; display: none;">No image</span>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.view-category').forEach(link => {
          link.addEventListener('click', function () {
              // Get category data
              const name = this.getAttribute('data-name');
              const image = this.getAttribute('data-image');

              // Populate modal fields
              document.getElementById('categoryName').textContent = name;

              const categoryImage = document.getElementById('categoryImage');
              const noImageText = document.getElementById('noImageText');
              const categoryImageContainer = document.getElementById('categoryImageContainer');

              if (image && !image.includes('No image')) {
                  categoryImage.src = image;
                  categoryImageContainer.style.display = 'block';
                  noImageText.style.display = 'none';
              } else {
                  categoryImageContainer.style.display = 'none';
                  noImageText.style.display = 'block';
              }
          });
      });
  });
</script>




<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this category?</p>
        <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission -. تريد منع نموذج من الإرسال عند النقر على زر الإرسال
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function () {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            // "hidden" يُستخدم للإشارة إلى طرق مختلفة لجعل العناصر غير مرئية أو مخفية
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // Laravel CSRF token
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
</script>

@endsection
