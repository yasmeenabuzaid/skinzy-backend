<body class="wp-singular page-template-default page wp-theme-swissdelight">
    <a class="skip-link screen-reader-text" href="#qodef-page-content">Skip to the content</a>
    <div id="qodef-page-wrapper">
        <div id="qodef-page-outer">
            <div class="qodef-page-title qodef-m">
                <div class="qodef-m-inner">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="qodef-m-content qodef-content-grid">
                <h1 style="margin-top: 40px">Checkout</h1>
                <div class="button-control mt-4 d-flex justify-content-end">
                    <a href="{{ route('cart.index') }}">
                        <i class="fa fa-arrow-left me-2"></i> Back to Cart
                    </a>
                </div>
            </div>

            <div id="qodef-page-inner" class="qodef-content-grid">
                <main id="qodef-page-content" class="qodef-grid">
                    <div class="qodef-grid-inner clear">
                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 g-4">
                            <div class="col">
                                <div class="your-order shadow-sm p-4 bg-white rounded">
                                    <h3 class="mb-4 text-dark fw-bold border-bottom pb-2">Your Order</h3>

                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-end">Price</th>
                                                    <th class="text-end">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = 0; @endphp
                                                @foreach ($cart as $item)
                                                    @php
                                                        $product = \App\Models\Product::find($item['product_id']);
                                                        $final_price = $product->price;
                                                        $subtotal = $final_price * $item['quantity'];
                                                        $total += $subtotal;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}"
                                                                     alt="img" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                                                <a href="{{ route('product_details', $product->id) }}" class="text-dark">
                                                                    {{ $product->name }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">{{ $item['quantity'] }}</td>
                                                        <td class="text-end">{{ number_format($final_price, 2) }} JOD</td>
                                                        <td class="text-end">{{ number_format($subtotal, 2) }} JOD</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" class="text-end">Total</th>
                                                    <th class="text-end text-danger">{{ number_format($total, 2) }} JOD</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .custom-back-btn {
                                    margin-top: 20px;
                                    background-color: #ffffff;
                                    color: #212529;
                                    border: 1px solid #212529;
                                    font-weight: 600;
                                    padding: 12px 20px;
                                    text-align: center;
                                    transition: all 0.3s ease-in-out;
                                }

                                .custom-back-btn:hover {
                                    background-color: #212529;
                                    color: #ffffff;
                                    text-decoration: none;
                                }

                                .custom-back-btn i {
                                    transition: transform 0.3s ease;
                                }

                                .custom-back-btn:hover i {
                                    transform: translateX(-4px);
                                }
                            </style>

                            @php
                                $productIds = collect($cart)->pluck('product_id')->toArray();
                                $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');

                                $total = collect($cart)->sum(function($item) use ($products) {
                                    $product = $products[$item['product_id']];
                                    $final_price = $product->price;
                                    return $final_price * $item['quantity'];
                                });
                            @endphp

                            <div class="order-total" style="margin-top: 18px;">
                                <span class="title">Total Price:</span>
                                <span class="total-price">{{ number_format($total, 2) }} JOD</span>
                            </div>
                        </div>
                    </div>

                    @if (Session::get('success') || Session::get('error'))
                    <div id="customModal" class="custom-modal-overlay">
                        <div class="custom-modal">
                            <div class="modal-header">
                                <div class="icon-container">
                                    @if(Session::get('success'))
                                        <i class="fa fa-check-circle success-icon"></i>
                                    @else
                                        <i class="fa fa-exclamation-circle error-icon"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-body">
                                <h2>{{ Session::get('success') ? 'Success' : 'Error' }}</h2>
                                <p id="modalMessage">{{ Session::get('success') ?? Session::get('error') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button class="close-modal-btn">OK</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#customModal').fadeIn();

                            $('.close-modal-btn').click(function() {
                                $('#customModal').fadeOut();
                            });

                            setTimeout(function() {
                                $('#customModal').fadeOut();
                            }, 5000);
                        });
                    </script>
                    @endif

                    <style>
                        .custom-modal-overlay {
                            position: fixed;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: rgba(0, 0, 0, 0.5);
                            display: none;
                            justify-content: center;
                            align-items: center;
                            z-index: 9999;
                        }

                        .custom-modal {
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 8px;
                            width: 300px;
                            text-align: center;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                        }

                        .modal-header {
                            display: flex;
                            justify-content: center;
                            margin-bottom: 15px;
                        }

                        .icon-container {
                            font-size: 40px;
                            color: #28a745;
                        }

                        .success-icon {
                            color: #28a745;
                        }

                        .error-icon {
                            color: #dc3545;
                        }

                        .modal-body h2 {
                            margin: 10px 0;
                        }

                        .modal-body p {
                            font-size: 16px;
                            color: #555;
                        }

                        .close-modal-btn {
                            background-color: #28a745;
                            color: white;
                            border: none;
                            padding: 10px 20px;
                            border-radius: 5px;
                            cursor: pointer;
                        }

                        .close-modal-btn:hover {
                            background-color: #218838;
                        }
                    </style>




