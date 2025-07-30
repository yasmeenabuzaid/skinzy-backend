@extends('layouts.dashboard_master')

@section('content')




    <section style="margin-top: 40px">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Orders Overview </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </nav>
                </div>
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
                    <br>
                    {{-- <h4 class="card-title">Data table</h4> --}}
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
                                                    <th>User Name</th>
                                                    <th>Mobile</th>
                                                    <th>final Price</th>
                                                    <th>Order Status</th>
                                                    <th>Shipping Method</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($orders->isEmpty())
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Data Available</td>
                                                    </tr>
                                                @else
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td>{{ $order->id }}</td>

                                                            <td title="view">
                                                                <a href="{{ route('order.show', $order->id) }}"
                                                                    style="color:#000000;"
                                                                    onmouseover="this.style.color='#10db8c';"
                                                                    onmouseout="this.style.color='#000000';" title="View">
                                                                    {{ $order->user->Fname }} {{ $order->user->Lname }}
                                                                </a>
                                                            </td>

                                                            <td>{{ $order->mobile }}</td>

                                                            <td>{{ $order->final_price }} JOD</td>

                                                            <td>
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
                                                                        <i class="bi bi-bag-check me-1"></i> Ready for
                                                                        Pickup
                                                                    @elseif($order->order_status == 'shipped')
                                                                        <i class="bi bi-truck me-1"></i> Shipped
                                                                    @elseif($order->order_status == 'completed')
                                                                        <i class="bi bi-check-circle me-1"></i> Completed
                                                                    @else
                                                                        <i class="bi bi-x-circle me-1"></i> Cancelled
                                                                    @endif
                                                                </span>
                                                            </td>




                                                            <td>
                                                                @if ($order->shipping_method == 'home_delivery')
                                                                    <span><i class="bi bi-truck me-1"></i> Home
                                                                        Delivery</span>
                                                                @elseif($order->shipping_method == 'pickup')
                                                                    <span><i class="bi bi-box me-1"></i> Pickup</span>
                                                                @else
                                                                    <span> N/A</span>
                                                                @endif
                                                            </td>

                                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                                            <td>
                                                                <a href="{{ route('order.show', $order->id) }}"
                                                                    class="btn btn-outline-primary btn-sm"
                                                                    title="View Order">
                                                                    <i class="bi bi-eye"></i> Show
                                                                </a>

                                                                <form action="{{ route('order.destroy', $order->id) }}"
                                                                    method="POST" style="display:inline;" title="Delete">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-sm"
                                                                        title="Delete Order"
                                                                        onclick="confirmDeletion(event, '{{ route('order.destroy', $order->id) }}')">
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

                    <!-- Custom Confirmation Modal -->
                    <div id="confirmationModal"
                        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
                        <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                            <p>Are you sure you want to delete this order?</p>
                            <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
                            <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
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
                            confirmButton.onclick = function() {
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
                            cancelButton.onclick = function() {
                                modal.style.display = 'none';
                            };
                        }
                    </script>

                @endsection
