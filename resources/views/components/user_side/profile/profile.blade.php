<div class="container mt-5" style="margin: 50px; margin-top: 50px;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4 mb-4" style="border:1px solid #f1f1f1; padding: 25px 40px;">
            <div class="card p-3">
                <div class="text-center mb-3">
                    <img src="{{ asset('/images/profile.jpg') }}" alt="User Photo" class="rounded-circle" width="100">
                </div>
                <h4 class="text-center">{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</h4>
                <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                <hr>
                <ul class="nav flex-column" id="profileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders">Order History</a>
                    </li>
                </ul>
            </div>

            <!-- Content -->
            <div class="col-lg-9 col-md-8 mb-4">
            <div class="tab-content" id="profileTabsContent">
                <!-- Profile Section -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h5>My Profile</h5>

                    <!-- Profile Form -->
                    <div class="card p-4">
                        <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- First Name -->
                                <div class="col-sm-6">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="Fname" value="{{ auth()->user()->Fname }}" required>
                                </div>

                                <!-- Last Name -->
                                <div class="col-sm-6">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="Lname" id="lname" value="{{ auth()->user()->Lname }}" required>
                                </div>

                                <!-- Email -->
                                <div class="col-sm-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-sm-6">
                                    <label for="mobile" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ auth()->user()->mobile ?? '' }}" required>
                                </div>

                                <!-- Current Password -->
                                <div class="col-sm-12">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                </div>

                                <!-- New Password -->
                                <div class="col-sm-6">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>

                                <!-- Confirm New Password -->
                                <div class="col-sm-6">
                                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                </div>

                                <!-- Save Button -->
                                <div class="col-12 text-center mt-3">

                                    <button type="button" onclick="showConfirmModal()" class="btn btn-success px-4 py-2" >Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order History Section -->
                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <h5>Order History</h5>
                    <p>Here you can display the user's order history.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Success & Error Modal -->
@if (Session::get('success'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Success!',
                text: '{{ Session::get("success") }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

@if (Session::get('error'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Error!',
                text: '{{ Session::get("error") }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showConfirmModal() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to update your profile? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                submitForm();
            }
        });
    }

    function submitForm() {
        document.getElementById('profileForm').submit();
    }
</script>
