<!-- Orders Tab -->
<div class="tab-pane" id="orders" style="border:1px solid #f1f1f1; padding: 25px 40px;">
    <h3 class="mb-4">Order History</h3>
    <p>You can cancel the order only if its status is <strong>processing</strong> or <strong>pending payment</strong>. Orders with other statuses cannot be canceled because they are already being prepared.</p>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @if ($orders->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>payment method</th>
                    <th>shopping method</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->shipping_method }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>{{ number_format($order->total_price, 2) }} JOD</td>
                        <td>
                            <span class="badge">{{ $order->order_status }}</span>
                        </td>
                        <td>
                            <a href="#"
                               class="btn btn-sm btn-primary view-order"
                               data-id="{{ $order->id }}"
                               data-date="{{ $order->created_at->format('Y-m-d') }}"
                               data-total-price="{{ number_format($order->total_price, 2) }}"
                               data-status="{{ $order->order_status }}"
                               data-products="{{ json_encode($order->orderDetails->map(function ($detail) {
                                   return [
                                       'product' => $detail->product->name,
                                       'quantity' => $detail->quantity,
                                       'price' => $detail->price,
                                       'discount' => $detail->discount,
                                       'total' => $detail->total_price,
                                   ];
                               })) }}">
                               View
                            </a>
                            <td>
                            @if(in_array($order->order_status, ['processing', 'pending_payment']))
                                <a href="{{ route('orders.cancel', $order->id) }}" class="btn btn-sm btn-danger"  data-id="{{ $order->id }}">
                                    <i class="fa fa-times-circle"></i> Cancel
                                </a>
                            @else
                                <button type="button" class="btn btn-sm btn-danger" disabled>
                                    <i class="fa fa-times-circle"></i> Cannot cancel
                                </button>
                            @endif
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your order history will be displayed here.</p>
    @endif
</div>

<!-- Custom Order Details Modal -->
<div id="orderDetailsModal" class="custom-modal-overlay" style="display: none;">
    <div class="custom-modal" style="padding: 30px">
        <h2>Order Details</h2>
        <div class="order-info">
            <p><strong>Order ID:</strong> <span id="orderId"></span></p>
            <p><strong>Order Date:</strong> <span id="orderDate"></span></p>
            <p><strong>Status:</strong> <span id="orderStatus"></span></p>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="orderDetailsTableBody"></tbody>
            </table>
            <p class="total-price"><strong>Total Price:</strong> <span id="totalPrice"></span> JOD</p>
        </div>
        <div class="modal-footer">
            <button class="close-modal-btn">Close</button>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .total-price {
        text-align: right;
        margin-top: 20px;
        font-weight: bold;
    }
    .order-info {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 0px;
        margin-top: 17px;
    }
    .order-info p {
        margin: 0;
        flex: 1;
    }
    .custom-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        display: none;
    }
    .custom-modal {
        background: white;
        border-radius: 8px;
        width: 70%;
        max-width: 900px;
        max-height: 80vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .custom-modal .modal-body {
        overflow-y: auto;
        max-height: calc(80vh - 120px);
    }
    .custom-modal .modal-header {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        font-size: 24px;
        font-weight: bold;
    }
    .custom-modal .modal-footer {
        padding: 10px;
        border-top: 1px solid #ddd;
        text-align: right;
    }
    .custom-modal .close-modal-btn {
        background-color: #900A07;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
    }
    .custom-modal .close-modal-btn:hover {
        background-color: #7a0805;
    }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-order').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const orderId = this.getAttribute('data-id');
            const orderDate = this.getAttribute('data-date');
            const totalPrice = this.getAttribute('data-total-price');
            const orderStatus = this.getAttribute('data-status');
            const products = JSON.parse(this.getAttribute('data-products'));

            document.getElementById('orderId').textContent = orderId;
            document.getElementById('orderDate').textContent = orderDate;
            document.getElementById('totalPrice').textContent = totalPrice;
            document.getElementById('orderStatus').textContent = orderStatus;

            const orderDetailsTableBody = document.getElementById('orderDetailsTableBody');
            orderDetailsTableBody.innerHTML = '';

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.product}</td>
                    <td>${product.quantity}</td>
                    <td>${product.price} JOD</td>
                    <td>${product.discount}%</td>
                    <td>${product.total} JOD</td>
                `;
                orderDetailsTableBody.appendChild(row);
            });

            document.getElementById('orderDetailsModal').style.display = 'flex';
        });
    });

    document.querySelector('.close-modal-btn').addEventListener('click', function () {
        document.getElementById('orderDetailsModal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('orderDetailsModal')) {
            document.getElementById('orderDetailsModal').style.display = 'none';
        }
    });
});
</script>

<script>
    $(document).ready(function () {
        $('a[data-target]').on('click', function (e) {
            e.preventDefault();

            const target = $(this).data('target');
            $('.tab-pane').removeClass('show active');
            $('a[data-target]').removeClass('active');
            $(target).addClass('show active');
            $(this).addClass('active');
        });

        $('#profile').addClass('show active');
        $('#profile-tab').addClass('active');
    });
</script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'success',
            text: '{{ session('success') }}',
        });
    </script>
@endif
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'success',
            text: '{{ session('success') }}',
        });
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.cancel-order-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const orderId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you really want to cancel this order?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/orders/cancel/${orderId}`;
                    }
                });
            });
        });
    });
    </script>
