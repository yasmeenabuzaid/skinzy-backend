@extends('layouts.dashboard_master')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="page-title mb-1">Products Overview</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('products.create') }}">
            <button type="button" class="btn btn-primary btn-sm shadow-sm">
                <i class="bi bi-plus-circle"></i> Add Product
            </button>
        </a>
    </div>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

<a href="{{ route('products.bulk.create') }}" class="btn btn-success mb-3 ml-2">Add Bulk Products</a>
    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Product Cards --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($mainProducts as $mainProduct)
            <div class="col">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold text-dark mb-3">{{ $mainProduct->name }}</h5>

                        @if($mainProduct->images->isNotEmpty())
                            <img src="{{ asset($mainProduct->images[0]->image) }}"
                                 alt="{{ $mainProduct->name }}"
                                 class="img-fluid mb-3 mx-auto d-block"
                                 style="max-height: 160px; object-fit: contain; border-radius: 8px;">
                        @endif

                        <p class="card-text text-secondary mb-3">
                            <strong>Price:</strong> ${{ number_format($mainProduct->price, 2) }}<br>
                            <strong>Code:</strong> {{ $mainProduct->code }}<br>
                            <strong>SubCategory:</strong> {{ $mainProduct->subCategory->name ?? 'N/A' }}
                        </p>

                        @if($mainProduct->variations->count())
                            <h6 class="fw-semibold text-primary mb-2">Variations:</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach ($mainProduct->variations as $variation)
                                    <div class="card border-light" style="width: 90px; border-radius: 8px;">
                                        <a href="{{ route('products.show', $variation->id) }}"
                                           class="btn btn-sm p-0"
                                           style="border-radius: 8px; overflow: hidden; display: block;">
                                            @if($variation->images->isNotEmpty())
                                                <img src="{{ asset($variation->images[0]->image) }}"
                                                     alt="{{ $variation->name }}"
                                                     class="img-fluid"
                                                     style="max-height: 60px; object-fit: contain;">
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-auto d-flex justify-content-between gap-2">
                            <a href="{{ route('products.show', $mainProduct->id) }}"
                               class="btn btn-sm btn-outline-primary flex-grow-1">View</a>

                            <a href="{{ route('products.edit', $mainProduct->id) }}"
                               class="btn btn-sm btn-outline-info flex-grow-1">Edit</a>

                            <form action="{{ route('products.destroy', $mainProduct->id) }}"
                                  method="POST"
                                  class="d-inline-flex flex-grow-1">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger w-100"
                                        onclick="confirmDeletion(event, '{{ route('products.destroy', $mainProduct->id) }}')">
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

{{-- Confirmation Modal --}}
<div id="confirmationModal"
     style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
     background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 8px; text-align: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 400px;">
        <p class="mb-3">Are you sure you want to delete this product?</p>
        <button id="confirmButton" class="btn btn-danger w-100 mb-2">Delete</button>
        <button id="cancelButton" class="btn btn-secondary w-100">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault();
        const modal = document.getElementById('confirmationModal');
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');

        modal.style.display = 'flex';

        confirmButton.onclick = () => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            form.innerHTML = `
                <input type="hidden" name="_token" value='{{ csrf_token() }}'>
                <input type="hidden" name="_method" value="DELETE">
            `;

            document.body.appendChild(form);
            form.submit();
        };

        cancelButton.onclick = () => {
            modal.style.display = 'none';
        };
    }
</script>

@endsection
