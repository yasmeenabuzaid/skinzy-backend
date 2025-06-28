@extends('layouts.dashboard_master')

@section('content')

<section class="section" style="margin-top: 40px">

        <div class="main-panel">
            <div class="content-wrapper">
              <div class="page-header">
                <h3 class="page-title"> Feedbacks Overview </h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Feedbacks</li>
                  </ol>
                </nav>
              </div>
                <thead>
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
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Product Number</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($feedbacks->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">No Data Available</td>
                                </tr>
                            @else
                                @foreach($feedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->id }}</td>
                                    <td>{{ optional($feedback->user)->Fname }} {{ optional($feedback->user)->Lname }}</td>
                                    <td>
                                        @php
                                            $rating = $feedback->rating;
                                            $fullStars = floor($rating);
                                            $halfStar = ($rating - $fullStars) >= 0.5 ? true : false;
                                        @endphp

                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="bi bi-star-fill" style="color: gold;"></i>
                                        @endfor

                                        @if ($halfStar)
                                        <i class="bi bi-star-half" style="color: gold; border: 1px solid rgb(56, 56, 56);"></i>
                                        @endif

                                        @for ($i = 0; $i < (5 - ceil($rating)); $i++)
                                            <i class="bi bi-star" style="color: gold;"></i>
                                        @endfor
                                    </td>

                                    <td>{{ $feedback->comment }}</td>
                                    <td>
                                        <a href="{{ route('products.show', $feedback->product_id) }}" title="View Product">
                                            View Product
                                        </a>
                                    </td>

                                    <td>{{ optional($feedback->created_at)->format('Y-m-d') ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;" title="Delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDeletion(event, '{{ route('feedback.destroy', $feedback->id) }}')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this contact?</p>
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
