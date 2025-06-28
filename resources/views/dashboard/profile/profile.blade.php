@extends('layouts.dashboard_master')

@section('content')
<div class="pagetitle mt-4">
    <h1><i class="bi bi-person"></i> Profile</h1>
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

<section class="section profile">
        <!-- Profile Card -->

        <!-- Profile Edit Form -->
        <div class="col">
            <div class="card shadow">
            <div>
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">
                        <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('assets/img/abstract-user-flat-3.png') }}"
                             alt="Profile" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                        {{-- <h2>{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</h2>
                        <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Mobile:</strong> {{ auth()->user()->mobile }}</p> --}}
                    </div>
                </div>
                    <div class="card-body pt-3">
                        <h5>Edit Profile</h5>
                        <form id="profileForm" action="{{ route('profile_dash.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Fname">First Name</label>
                                <input type="text" class="form-control" id="Fname" name="Fname" value="{{ auth()->user()->Fname }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Lname">Last Name</label>
                                <input type="text" class="form-control" id="Lname" name="Lname" value="{{ auth()->user()->Lname }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="mobile">Phone Number</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ auth()->user()->mobile }}" required>
                            </div>
                        </div>

                        <!-- Optional: Add profile image upload -->
                        <!--
                        <div class="mb-3">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image" id="profile_image">
                        </div>
                        -->

                        <div class="text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
    </div>
</div>
</section>

<!-- Bootstrap Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Profile Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to update your profile?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-info" onclick="document.getElementById('profileForm').submit();">Confirm</button>
      </div>
    </div>
  </div>
</div>
@endsection
