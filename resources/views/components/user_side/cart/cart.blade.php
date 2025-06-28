@extends('layouts.user_side_master')

@section('content')

    <div class="container mt-5" style="margin:40px">

        @if (is_array($cart) && count($cart) == 0)
            <div class="text-center py-5">
                <h1 class="mb-4">Your cart is currently empty.</h1>
                <p class="return-to-shop">
                    <a href="{{ route('shop') }}" class="btn btn-outline-dark px-4 py-2">
                        <i class="fa fa-arrow-left me-2"></i> Return to Shop
                    </a>
                </p>
            </div>
        @else
            <div class="container mt-5" style="margin:40px">

                <h3 class="text-center text-danger mb-4">Shopping Cart</h3>
                <div class="shopping-cart-table">
                    <form action="#" class="cart-form mb-4">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
                                @foreach ($cart as $item)
                                    @php
                                        $product = \App\Models\Product::find($item['product_id']);
                                        $price = $product->price;
                                        $subtotal = $price * $item['quantity'];
                                    @endphp
                                    <tr data-product-id="{{ $product->id }}">
                                        <td>
                                            <a href="{{ route('product_details', $product->id) }}">
                                                <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }} "
                                                    alt="Product Image" width="70" height="70">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('product_details', $product->id) }}">
                                                <strong>{{ $product->name }}</strong>
                                            </a>
                                            <p class="small text-muted">{{ $product->small_description }}</p>
                                        </td>
                                        <td class="price-column">
                                            @if ($product->price)
                                                {{ number_format($product->price, 2) }} JOD<br>
                                            @else
                                                <span>{{ number_format($product->price, 2) }} JOD</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="form-control text-center" style="width: 60px;">
                                                {{ $item['quantity'] }}
                                            </span>

                                        </td>




                                        <td class="subtotal-column">{{ number_format($subtotal, 2) }} JOD</td>
                                        <td>
                                            <form action="{{ route('cart.delete', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @php
                                    $total = collect($cart)->sum(function ($item) {
                                        $product = \App\Models\Product::find($item['product_id']);
                                        $price = $product->price;
                                        return $price * $item['quantity'];
                                    });
                                @endphp

                                <tr class="table-secondary">
                                    <td colspan="5" class="text-end fw-bold">Total:</td>
                                    <td class="fw-bold text-danger" id="cart-total">{{ number_format($total, 2) }} JOD</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <br>
                    <br>

                    <div class="d-flex justify-content-end mt-4" style="margin-left: 700px">
                            <div style="display: flex ; gap:10px">
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <button type="submit" id="clear-cart"
                                    class="btn btn-danger px-4 py-2 d-flex align-items-center">
                                    <i class="fa fa-trash me-2"></i> Delete all products
                                </button>
                            </form>

                            <form action="{{ route('order.create') }}" method="GET" class="ml-3">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fa fa-arrow-right me-2"></i> Proceed to Checkout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    <script>
        $(document).ready(function() {
            $('#customModal').fadeIn();
            $('.close-modal-btn').click(function() {
                $('#customModal').fadeOut();
            });
        });
    </script>


@endsection
