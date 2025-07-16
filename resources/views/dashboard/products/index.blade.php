@extends('layouts.dashboard_master')

@section('content')





        <div class="d-flex justify-content-between align-items-center mb-4"  style="margin: 20px 0px">
                    <div class="page-header">
                        <h3 class="page-title"> Products Overview </h3>
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                            </nav>
                        </div>

                        <a href="{{ route('products.create') }}" style="margin-top: 30px;">
                            <button type="button" class="btn btn-primary btn-sm shadow-sm">
                                <i class="bi bi-plus-circle"></i> Add Product
                            </button>
                        </a>
                    </div>
                    <h5 class="card-title"></h5>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
<div class="container my-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($mainProducts as $mainProduct)
            <div class="col">
<div class="card h-100 shadow-sm" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 1px solid #ddd;">
                    <div class="card-body d-flex flex-column" style="padding: 1.5rem;">
                        <h4 class="card-title mb-3" style="font-weight: 600; color: #2c3e50;">{{ $mainProduct->name }}</h4>
                        <p class="card-text mb-3" style="font-size: 1rem; color: #34495e;">
                            <strong>Price:</strong> ${{ number_format($mainProduct->price, 2) }} <br>
                            <strong>Quantity:</strong> {{ $mainProduct->quantity }} <br>
<strong>category:</strong> {{ $mainProduct->category->name ?? 'N/A' }}
                        </p>

                        @if($mainProduct->images->isNotEmpty())
                            <img src="{{ asset($mainProduct->images[0]->image) }}" alt="{{ $mainProduct->name }}"
                                 class="img-fluid mb-3 mx-auto d-block" style="max-height: 160px; object-fit: contain; border-radius: 8px;">
                        @endif

                        @if($mainProduct->variations && $mainProduct->variations->count() > 0)
                            <h6 class="mb-2" style="font-weight: 600; color: #2980b9;">Variations:</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach ($mainProduct->variations as $variation)
                                    <div class="card border-secondary" style="width: 100px; border-radius: 8px;">
                                        <a href="{{ route('products.show', $variation->id) }}" class="btn btn-sm btn-outline-primary p-0" style="border-radius: 8px; overflow: hidden; display: block;">
                                            @if($variation->product_images->isNotEmpty())
                                                <img src="{{ asset($variation->product_images[0]->image) }}" alt="{{ $variation->name }}" class="img-fluid" style="max-height: 60px; object-fit: contain;">
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-auto d-flex justify-content-between gap-2">
                            <a href="{{ route('products.show', $mainProduct->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1">View</a>

                            <a href="{{ route('products.edit', $mainProduct->id) }}" class="btn btn-sm btn-outline-info flex-grow-1">Edit Main</a>

                            <form action="{{ route('products.destroy', $mainProduct->id) }}" method="POST" class="d-inline-flex flex-grow-1" title="Delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="confirmDeletion(event, '{{ route('products.destroy', $mainProduct->id) }}')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    </div>
</section>

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
     style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 400px;">
        <p class="mb-3">Are you sure you want to delete this product?</p>
        <button id="confirmButton" class="btn btn-danger w-100 mb-2">Delete</button>
        <button id="cancelButton" class="btn btn-secondary w-100">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission
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
