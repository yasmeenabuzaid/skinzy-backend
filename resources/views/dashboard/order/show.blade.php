@extends('layouts.dashboard_master')

@section('content')

    <div style="display: flex; justify-content: space-between;">
        <div class="pagetitle mt-4 mb-4">
            <h1>
                            <div class="main-panel">
                                <div class="content-wrapper">
                                    <div class="page-header">
                                        <h3 class="page-title">
                                            <i class="bi bi-cart"></i> Order #{{ $order->id }}
                                            <i class="bi bi-question-circle-fill ms-2" style="cursor: pointer; color: #959595;" data-bs-toggle="modal" data-bs-target="#statusHelpModal"></i>
                                        </h3>



                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Orders</li>
                                                <li class="breadcrumb-item active" aria-current="page"> Order
                                                    #{{ $order->id }}</li>
                                            </ol>
                                        </nav>
                                    </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="pagetitle">
                                                    <form action="{{ route('order.update', $order->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Show dropdown only if order status is not cancelled or pending_payment -->
                                                        @if ($order->order_status != 'Cancelled' && $order->order_status != 'Pending Payment')
                                                            <div class="form-group">
                                                                <!-- Home Delivery -->
                                                                @if ($order->shipping_method == 'home_delivery')
                                                                <select name="order_status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                                    <option selected disabled>{{ ucfirst(str_replace('_', ' ', $order->order_status)) }} (Current)</option>
                                                                        <option value="shipped"
                                                                            {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                                                            Shipped</option>
                                                                        <option value="completed"
                                                                            {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                                                            Completed</option>
                                                                        <option value="cancelled"
                                                                            {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                                                            Cancelled</option>
                                                                    </select>
                                                                    <!-- Pickup -->
                                                                @elseif($order->shipping_method == 'pickup')
                                                                <select name="order_status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                                    <option selected disabled>{{ ucfirst(str_replace('_', ' ', $order->order_status)) }} (Current)</option> <select name="order_status"
                                                                        class="form-select form-select-sm"
                                                                        onchange="this.form.submit()">
                                                                        <option value="ready_for_pickup"
                                                                            {{ $order->order_status == 'ready_for_pickup' ? 'selected' : '' }}>
                                                                            Ready for Pickup
                                                                        </option>
                                                                        <option value="completed"
                                                                            {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                                                            Completed</option>
                                                                        <option value="cancelled"
                                                                            {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                                                            Cancelled</option>
                                                                    </select>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <p class="text-danger">You cannot update the status because the
                                                                order is either cancelled or pending
                                                                payment.</p>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
            </h1>
        </div>
        <!-- Form to update order status -->
        </section>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Order Details Tabs -->
            <ul class="nav nav-tabs nav-justified mb-4 bg-light rounded p-2" id="orderTabs" role="tablist">
                <li class="nav-item" >
                    <button class="nav-link active" id="user-location-tab" data-bs-toggle="tab"
                        data-bs-target="#user-location-info" type="button" role="tab">
                        <i class="bi bi-person-circle me-1"></i> User & Location Info
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="order-info-tab" data-bs-toggle="tab" data-bs-target="#order-info"
                        type="button" role="tab">
                        <i class="bi bi-info-circle-fill me-1"></i> Order Info
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="order-items-tab" data-bs-toggle="tab" data-bs-target="#order-items"
                        type="button" role="tab">
                        <i class="bi bi-box-seam me-1"></i> Order Items
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="orderTabsContent">
                <!-- User & Location Info -->
                <div class="tab-pane fade show active" id="user-location-info" role="tabpanel">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="card border-0 bg-light p-3">
                                <h5><i class="bi bi-person-fill me-2"></i> User Info</h5>
                                <hr>
                                <p><strong>Name:</strong> {{ $order->user->Fname }} {{ $order->user->Lname }}</p>
                                <p><strong>Email:</strong> {{ $order->email }}</p>
                                <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card border-0 bg-light p-3">
                                <h5><i class="bi bi-geo-alt-fill me-2"></i> Location Info</h5>
                                <hr>
                                <p><strong>City:</strong> {{ $order->city }}</p>
                                <p><strong>Street:</strong> {{ $order->street }}</p>
                                <p><strong>Building #:</strong> {{ $order->building_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Info -->
                <div class="tab-pane fade" id="order-info" role="tabpanel">
                    <div class="custom-card bg-light" style="padding: 30px 40px; margin: 15px 0; border-radius: 8px;">
                        <p><strong>Order Number:</strong> {{ $order->id }}</p>
                        <p><strong>Note:</strong> {{ $order->note }}</p>
                        <p><strong>Total Price:</strong> {{ $order->total_price }} JOD</p>
                        <p><strong>Payment Method:</strong>
                            @if ($order->payment_method == 'cash_on_delivery')
                                <span><i class="bi bi-cash me-1"></i> Cash on Delivery</span>
                            @elseif($order->payment_method == 'stripe')
                                <span><i class="bi bi-credit-card me-1"></i> Stripe</span>
                            @else
                                <span> N/A</span>
                            @endif
                        </p>
                        <p><strong>Status:</strong>
                            <span
                                class="badge bg-{{ $order->order_status == 'pending_payment'
                                    ? 'warning text-dark'
                                    : ($order->order_status == 'processing'
                                        ? 'primary'
                                        : ($order->order_status == 'ready_for_pickup'
                                            ? 'info'
                                            : ($order->order_status == 'shipped'
                                                ? 'secondary'
                                                : ($order->order_status == 'completed'
                                                    ? 'success'
                                                    : 'danger')))) }}">
                                @if ($order->order_status == 'pending_payment')
                                    <i class="bi bi-clock me-1"></i> Pending Payment
                                @elseif($order->order_status == 'processing')
                                    <i class="bi bi-arrow-repeat me-1"></i> Processing
                                @elseif($order->order_status == 'ready_for_pickup')
                                    <i class="bi bi-bag-check me-1"></i> Ready for Pickup
                                @elseif($order->order_status == 'shipped')
                                    <i class="bi bi-truck me-1"></i> Shipped
                                @elseif($order->order_status == 'completed')
                                    <i class="bi bi-check-circle me-1"></i> Completed
                                @else
                                    <i class="bi bi-x-circle me-1"></i> Cancelled
                                @endif
                            </span>
                        </p>

                        <p><strong>Shipping Method:</strong>
                            @if ($order->shipping_method == 'home_delivery')
                                <span><i class="bi bi-truck me-1"></i> Home Delivery</span>
                            @elseif($order->shipping_method == 'pickup')
                                <span><i class="bi bi-box me-1"></i> Pickup</span>
                            @else
                                <span> N/A</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="tab-pane fade" id="order-items" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table align-middle text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Category- Sub Category</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    {{-- <th>Discount</th> --}}
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetails as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>
                                            @if ($detail->product->product_images->isNotEmpty())
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#imageModal{{ $detail->id }}">
                                                    <img src="{{ asset($detail->product->product_images[0]->image) }}"
                                                        class="shadow-sm" style="width: 70px; height: 70px;">
                                                </a>
                                            @else
                                                <span>No image</span>
                                            @endif
                                        </td>
                                        <td>{{ $detail->product->subCategory->category->name }} -
                                            {{ $detail->product->subCategory->name }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->price }} JOD</td>
                                        {{-- <td>{{ $detail->discount }}%</td> --}}
                                        <td>{{ $detail->total_price }} JOD</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Status Actions -->
            <div class="text-end mt-4">
                <a href="{{ route('order.index') }}" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left-circle"></i> Back to List
                </a>
            </div>
        </div>
    </div>
    <!-- المودال -->
    <div class="modal fade" id="statusHelpModal" tabindex="-1" aria-labelledby="statusHelpModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusHelpModalLabel">Order Status Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Here you can find information about the status of the order:</p>
                    <ul>
                        <li><strong>Pending Payment:</strong> The order is awaiting payment.</li>
                        <li><strong>Processing:</strong> The order is being processed.</li>
                        <li><strong>Ready for Pickup:</strong> The order is ready to be picked up.</li>
                        <li><strong>Shipped:</strong> The order has been shipped.</li>
                        <li><strong>Completed:</strong> The order has been successfully completed.</li>
                        <li><strong>Cancelled:</strong> The order has been cancelled.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- أيقونة السؤال لتفعيل المودال -->

@endsection
