
<div class="qodef-grid-item qodef-page-content-section qodef-col--12">
    <div class="woocommerce">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <form id="checkoutForm" name="checkout" method="post" action="{{ route('order.store') }}" class="checkout woocommerce-checkout" enctype="multipart/form-data">
            @csrf

            <h3>Shipping Address</h3>

            <!-- Email -->
            <p class="form-row">
                <label>Email Address</label>
                <input name="email" type="email" class="input-text" placeholder="e.g. yasmeen@example.com" value="{{ old('email') }}" required>
            </p>

            <!-- Mobile -->
            <p class="form-row">
                <label>Mobile number <span style="color:red;">*</span></label>
                <input name="mobile" type="text" class="input-text" placeholder="e.g. 079XXXXXXX" value="{{ old('mobile') }}" required>
            </p>

            <!-- City -->
            <p class="form-row">
                <label>City <span style="color:red;">*</span></label>
                <input name="city" type="text" class="input-text" placeholder="e.g. Amman, Aqaba..." value="{{ old('city') }}" required>
            </p>

            <!-- Street -->
            <p class="form-row">
                <label>Street <span style="color:red;">*</span></label>
                <input name="street" type="text" class="input-text" placeholder="e.g. King Abdullah St." value="{{ old('street') }}" required>
            </p>

            <!-- Building Number -->
            <p class="form-row">
                <label>Building number <span style="color:red;">*</span></label>
                <input name="building_number" type="text" class="input-text" placeholder="e.g. 33B" value="{{ old('building_number') }}" required>
            </p>

            <!-- Note -->
            <p class="form-row">
                <label>Note</label>
                <input name="note" type="text" class="input-text" placeholder="Optional delivery note..." value="{{ old('note') }}">
            </p>

            <!-- Payment -->
            <p class="form-row">
                <label>payment method <span style="color:red;">*</span></label>
                <select name="payment_method" class="input-text" required>
                    <option value="">Select payment method</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                    <option value="stripe">Credit Card</option>
                </select>
            </p>

            <p class="form-row">
                <label>shipping method <span style="color:red;">*</span></label>
                <select name="shipping_method" class="input-text" required>
                    <option value="">Select shipping method</option>
                    <option value="home_delivery">home delivery</option>
                    <option value="pickup">pickup</option>
                </select>
            </p>
            <p class="form-row">
                <button type="button" onclick="confirmOrder()" class="btn btn-dark w-100 fw-bold">
                    Place Order
                </button>
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .input-text {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid rgb(172, 171, 171);
        border-radius: 5px;
    }

    .btn {
        padding: 12px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }

    .btn-dark {
        background-color: #212529;
        color: white;
    }

    .btn-dark:hover {
        background-color: #000;
    }

    label {
        font-weight: 500;
        display: block;
        margin-bottom: 5px;
    }

    .form-row {
        margin-bottom: 15px;
    }

    .swal2-rounded {
        border-radius: 15px !important;
        padding: 20px;
    }

    .swal2-title-custom {
        font-size: 22px;
        color: #333;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .swal2-text-custom {
        font-size: 15px;
        color: #555;
    }
</style>

<script>
 function confirmOrder() {
    const form = document.getElementById('checkoutForm');

    if (form.checkValidity()) {
        Swal.fire({
            title: 'Confirm Your Order',
            html: `
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <i class="fa-solid fa-circle-question" style="font-size: 48px; color: #6c757d; margin-bottom: 15px; opacity: 0.8;"></i>
                    <p style="font-size: 16px; color: #555; text-align: center; margin: 0;">
                        Are you sure you want to place this order?<br>Please double-check your shipping and payment details before continuing.
                    </p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: '<i class="fa fa-check"></i> Yes, place order',
            cancelButtonText: 'Cancel',
            background: '#fff',
            customClass: {
                popup: 'swal2-rounded',
                title: 'swal2-title-custom',
                htmlContainer: 'swal2-text-custom',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Incomplete Information',
            text: 'Please make sure you filled out all required fields correctly before placing your order.',
            confirmButtonColor: '#dc3545',
            background: '#fff',
            customClass: {
                popup: 'swal2-rounded',
                title: 'swal2-title-custom',
                htmlContainer: 'swal2-text-custom',
            }
        });
    }
}





    function successAlertAndRedirect() {
        Swal.fire({
            title: 'Order Placed Successfully!',
            icon: 'success',
            text: 'Your order has been placed successfully. You will be redirected shortly.',
            confirmButtonColor: '#28a745',
            background: '#fff',
            customClass: {
                popup: 'swal2-rounded',
                title: 'swal2-title-custom',
                htmlContainer: 'swal2-text-custom',
            }
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                setTimeout(() => {
                    window.location.href = '/';
                }, 5000);
            }
        });
    }

    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        event.preventDefault();
        successAlertAndRedirect();
    });
</script>

<!-- Font Awesome for icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7B4DzFt8Q6U1yV9gjbOWg2NLjz/3rZ0p4MwvOQKlChXJk1N2a8kQDQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@if(session('success'))
    <script>
        Swal.fire({
            title: 'Order Placed Successfully!',
            icon: 'success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#28a745',
            background: '#fff',
            customClass: {
                popup: 'swal2-rounded',
                title: 'swal2-title-custom',
                htmlContainer: 'swal2-text-custom',
            }
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                setTimeout(() => {
                    window.location.href = '/';
                }, 5000);
            }
        });
    </script>
@endif
