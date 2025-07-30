@extends('layouts.dashboard_master')

@section('content')

@php
    $statusStyles = [
        'pending_payment' => ['class' => 'warning text-dark', 'icon' => 'bi-clock', 'label' => 'Pending Payment'],
        'processing' => ['class' => 'primary', 'icon' => 'bi-arrow-repeat', 'label' => 'Processing'],
        'ready_for_pickup' => ['class' => 'info', 'icon' => 'bi-bag-check', 'label' => 'Ready for Pickup'],
        'shipped' => ['class' => 'secondary', 'icon' => 'bi-truck', 'label' => 'Shipped'],
        'completed' => ['class' => 'success', 'icon' => 'bi-check-circle', 'label' => 'Completed'],
        'cancelled' => ['class' => 'danger', 'icon' => 'bi-x-circle', 'label' => 'Cancelled'],
    ];
    $currentStatus = $statusStyles[$order->order_status] ?? ['class' => 'dark', 'icon' => 'bi-question-circle', 'label' => 'Unknown'];
@endphp

<div class="d-flex justify-content-between align-items-start mb-4">

    {{-- Left Side: Page Title and Breadcrumbs --}}
    <div class="pagetitle">
        <h1>
            <i class="bi bi-cart me-2"></i> Order #{{ $order->id }}
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->id }}</li>
            </ol>
        </nav>
    </div>

    {{-- Right Side: Change Status Form --}}
    <div>
        <form action="{{ route('order.update', $order->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="order_status" class="form-label fw-bold small">Change Status:</label>
                <select name="order_status" id="order_status" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 180px;">
                    @foreach ($statusStyles as $key => $details)
                        <option value="{{ $key }}" {{ $order->order_status === $key ? 'selected' : '' }}>
                            {{ $details['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

</div>
{{-- Session Alerts --}}
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

<div class="card shadow-sm">
    <div class="card-body">

        <ul class="nav nav-tabs nav-tabs-bordered nav-justified mb-4" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="user-location-tab" data-bs-toggle="tab" data-bs-target="#user-location-info" type="button" role="tab">
                    <i class="bi bi-person-circle me-1"></i> User & Location
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="order-info-tab" data-bs-toggle="tab" data-bs-target="#order-info" type="button" role="tab">
                    <i class="bi bi-info-circle-fill me-1"></i> Order Info
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="order-items-tab" data-bs-toggle="tab" data-bs-target="#order-items" type="button" role="tab">
                    <i class="bi bi-box-seam me-1"></i> Order Items
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="payment-info-tab" data-bs-toggle="tab" data-bs-target="#payment-info" type="button" role="tab">
                    <i class="bi bi-receipt me-1"></i> Payment Info
                </button>
            </li>
        </ul>

        <div class="tab-content pt-2" id="orderTabsContent">

            <div class="tab-pane fade show active" id="user-location-info" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 bg-light p-3 h-100">
                            <h5><i class="bi bi-person-fill me-2"></i> User Info</h5>
                            <hr>
                            <p><strong>Name:</strong> {{ $order->user->Fname }} {{ $order->user->Lname }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 bg-light p-3 h-100">
                            <h5><i class="bi bi-geo-alt-fill me-2"></i> Address Info</h5>
                            <hr>
                            @forelse ($order->user->addresses as $address)
                                <p><strong>Title:</strong> {{ $address->title ?? 'N/A' }}</p>
                                <p><strong>Full Address:</strong> {{ $address->full_address }}</p>
                                <p><strong>City:</strong> {{ $address->city?->name ?? $address->custom_city ?? 'N/A' }}</p>
                                @if (!$loop->last) <hr> @endif
                            @empty
                                <p class="text-muted">No address found for this user.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="order-info" role="tabpanel">
                <div class="card border-0 bg-light">
                    <div class="card-body">
                        <p><strong>Order Number:</strong> {{ $order->id }}</p>
<p><strong>Total Price (without delivery):</strong> {{ $order->total_price }} JOD</p>
<p><strong>Delivery Fee:</strong> {{ $order->final_price - $order->total_price }} JOD</p>
<p><strong>Final Price (with delivery):</strong> {{ $order->final_price }} JOD</p>

                        <p><strong>Payment Method:</strong>
                            @if ($order->payment_method == 'cash_on_delivery')
                                <span><i class="bi bi-cash me-1"></i> Cash on Delivery</span>
                            @elseif($order->payment_method == 'stripe')
                                <span><i class="bi bi-credit-card me-1"></i> Stripe</span>
                            @else
                                <span>N/A</span>
                            @endif
                        </p>
                        <p><strong>Shipping Method:</strong>
                             @if ($order->shipping_method == 'home_delivery')
                                <span><i class="bi bi-truck me-1"></i> Home Delivery</span>
                            @elseif($order->shipping_method == 'pickup')
                                <span><i class="bi bi-box me-1"></i> Pickup</span>
                            @else
                                <span>N/A</span>
                            @endif
                        </p>
                        <p><strong>Status:</strong>
                            <span class="badge bg-{{ $currentStatus['class'] }}">
                                <i class="bi {{ $currentStatus['icon'] }} me-1"></i> {{ $currentStatus['label'] }}
                            </span>
                            <i class="bi bi-question-circle-fill ms-2" style="cursor: pointer; color: #959595;" data-bs-toggle="modal" data-bs-target="#statusHelpModal"></i>
                        </p>
                        <p><strong>Note:</strong> {{ $order->note ?? 'No notes provided.' }}</p>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="order-items" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orderDetails as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>
                                        @if ($detail->product->images->isNotEmpty())
                                            <img src="{{ asset($detail->product->images[0]->image) }}" alt="{{ $detail->product->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $detail->product->subCategory->category->name }} / {{ $detail->product->subCategory->name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->price }} JOD</td>
                                    <td>{{ $detail->total_price }} JOD</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No items found in this order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="payment-info" role="tabpanel">
                 <div class="card border-0 bg-light">
                    <div class="card-body">
                        @if($paymentProof)
                            <h5><i class="bi bi-credit-card-2-front me-2"></i> Payment Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-7">
                                    <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $paymentProof->payment_method)) }}</p>
                                    <p><strong>Transaction ID:</strong> {{ $paymentProof->transaction_id ?? 'N/A' }}</p>
                                    <p><strong>Paid Amount:</strong> {{ $paymentProof->paid_amount ?? 'N/A' }} JOD</p>
                                    <p><strong>Bank Name:</strong> {{ $paymentProof->bank_name ?? 'N/A' }}</p>
                                    <p><strong>Account Number:</strong> {{ $paymentProof->account_number ?? 'N/A' }}</p>
                                    <p><strong>Note:</strong> {{ $paymentProof->note ?? 'No note provided' }}</p>
                                </div>
                                <div class="col-md-5">
                                     @if($paymentProof->image)
                                        <p><strong>Proof Image:</strong></p>
                                        <a href="{{ $paymentProof->image }}" target="_blank">
                                            <img src="{{ $paymentProof->image }}" alt="Proof" class="img-fluid img-thumbnail" style="max-height: 250px;">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-file-earmark-excel fs-2"></i>
                                <p class="mt-2">No payment proof found for this order.</p>
                            </div>
                        @endif
                    </div>
                 </div>
            </div>

        </div> <div class="text-end mt-4">
            <a href="{{ route('order.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
            </a>
        </div>

    </div>
</div>

<div class="modal fade" id="statusHelpModal" tabindex="-1" aria-labelledby="statusHelpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusHelpModalLabel">Order Status Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Definitions for each order status:</p>
                <ul>
                    @foreach($statusStyles as $details)
                        <li><strong>{{ $details['label'] }}:</strong> A description of what this status means.</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
