@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4" style="margin-top: 40px">
    <div class="d-flex justify-content-between align-items-center mb-4"  >
        <div class="page-header">
            <h3 class="page-title"> Users Overview </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
              </ol>
            </nav>
        </div>
        </div>


        <a href="{{ route('users.create') }}" style="margin-top: 30px;">
            <button type="button"  class="btn btn-primary btn-sm shadow-sm">
                <i class="bi bi-plus-circle"></i> Add new user
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
          <table class="table ">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone number</th>
                          <th>role</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>{{$user->id}}</td>

                          <td title="view">
                            <a href="#"
                            class="view-user"
                            data-bs-toggle="modal"
                            data-bs-target="#userDetailsModal"
                            data-id="{{ $user->id }}"
                            data-fname="{{ $user->Fname }}"
                            data-lname="{{ $user->Lname }}"
                            data-email="{{ $user->email }}"
                            data-mobile="{{ $user->mobile }}"
                            data-role="{{ $user->role }}"
                            style="color:#000000;"
                            onmouseover="this.style.color='#10db8c';"
                            onmouseout="this.style.color='#000000';">
                             {{$user->Fname}} {{$user->Lname}}
                         </a>
                          </td>




                          <td>{{$user->email}}</td>
                          <td>{{$user->mobile}}</td>



                          <td>
                            <span
                                class="badge"
                                style="background-color:
                                    {{ $user->role == 'user' ? '#FFA500' :
                                       ($user->role == 'employee' ? '#28A745' : '#000') }};
                                    color: white;
                                    padding: 5px 10px;
                                    border-radius: 5px;"
                            >
                                {{ $user->role }}
                            </span>
                        </td>


                          <td>

                          <a href="{{ route('users.edit', $user->id) }}"  title="Edit">
                          <button type="button" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                          </a>

                          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm"  onclick="confirmDeletion(event, '{{ route('users.destroy', $user->id) }}')">
                                                    <i class="bi bi-trash"></i> Delete
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
<div class="modal fade" id="userDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>First Name:</strong> <span id="userFname"></span></p>
                <p><strong>Last Name:</strong> <span id="userLname"></span></p>
                <p><strong>Email:</strong> <span id="userEmail"></span></p>
                <p><strong>Phone Number:</strong> <span id="userMobile"></span></p>
                <p><strong>Role:</strong> <span id="userRole"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Attach event listeners to user links
      document.querySelectorAll('.view-user').forEach(link => {
          link.addEventListener('click', function () {
              // Get user data from data attributes
              const fname = this.getAttribute('data-fname');
              const lname = this.getAttribute('data-lname');
              const email = this.getAttribute('data-email');
              const mobile = this.getAttribute('data-mobile');
              const role = this.getAttribute('data-role');

              // Populate modal with user data
              document.getElementById('userFname').textContent = fname;
              document.getElementById('userLname').textContent = lname;
              document.getElementById('userEmail').textContent = email;
              document.getElementById('userMobile').textContent = mobile;
              document.getElementById('userRole').textContent = role;
          });
      });
  });
</script>





<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this user?</p>
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
