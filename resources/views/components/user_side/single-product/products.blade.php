<div class="qodef-content-grid">
    <section class="related products">

        <h2>Related products</h2>

        <div class="qodef-woo-product-list qodef-item-layout--info-below qodef-hover--move">
            <ul class="products columns-4">
                @php
                $isLoggedIn = auth()->check();
            @endphp
                @foreach ($allproducts->take(4) as $product)
    <li class="product type-product post-4126 status-publish first instock product_cat-chocolate product_cat-hot-choco product_tag-cakes product_tag-cannoli has-post-thumbnail shipping-taxable purchasable product-type-simple">
        <div class="qodef-woo-product-inner">
            <div class="qodef-woo-product-image">
                <a href="{{ route('product_details', $product->id) }}">
                    @if ($product->product_images->isNotEmpty())
                        <img width="800" height="800"
                            src="{{ asset($product->product_images[0]->image) }}" alt="{{ $product->name }}"
                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                            decoding="async" loading="lazy" style="object-fit: cover; border-radius: 6px;" />
                    @else
                        <img width="800" height="800" src="{{ asset('images/default-image.jpg') }}"
                            alt="No image available"
                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                            decoding="async" loading="lazy" />
                    @endif
                </a>
                <div class="qodef-woo-product-image-inner">
                    <form class="pd-detail__form"
                    action="{{ $isLoggedIn ? route('cart.add') : '#' }}"
                    method="POST" enctype="multipart/form-data"
                    onsubmit="return handleCartSubmit(event, {{ $isLoggedIn ? 'true' : 'false' }})">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="discount" value="{{ $product->discount }}">
                    <input type="hidden" name="final_price" value="{{ $product->discount > 0 ? $product->price * (1 - $product->discount / 100) : $product->price }}">
                    <input type="hidden" name="small_description" value="{{ $product->small_description }}">
                    <input type="hidden" name="quantity" value="1">

                    <button type="submit" class="button product_type_simple add_to_cart_button">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </form>
                </div>
            </div>
            <div class="qodef-woo-product-content">
                <h4 class="qodef-woo-product-title woocommerce-loop-product__title">
                    <a href="{{ route('product_details', $product->id) }}" class="qodef-woo-product-title-link">
                        {{ $product->name }}
                    </a>
                </h4>
                <div class="qodef-woo-product-categories">
                    <a href="https://swissdelight.qodeinteractive.com/product-category/chocolate/" rel="tag">Chocolate</a>
                    <span class="qodef-category-separator"></span>
                    <a href="https://swissdelight.qodeinteractive.com/product-category/hot-choco/" rel="tag">Hot choco</a>
                </div>
                <span class="price">
                    <span class="woocommerce-Price-amount amount">
                        <bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>{{ $product->price }}</bdi>
                    </span>
                </span>
            </div>
            <a href="{{ route('product_details', $product->id) }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>
        </div>
    </li>
@endforeach




            </ul>
        </div>
    </section>
</div>
</div>



</div>
</div>
</main>

</div><!-- close #qodef-page-inner div from header.php -->
</div><!-- close #qodef-page-outer div from header.php -->
 <!-- Handle Cart Submit -->
 <script>
    function handleCartSubmit(event, isLoggedIn) {
        if (!isLoggedIn) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Login Required',
                text: 'You must be logged in to add items to the cart.',
                confirmButtonText: 'Login',
                showCancelButton: true,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
            return false;
        }
        return true;
    }
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function handleCartSubmit(event, isLoggedIn) {
    if (!isLoggedIn) {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Login Required',
            text: 'You must be logged in to add items to the cart.',
            confirmButtonText: 'Login',
            showCancelButton: true,
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
        return false;
    }
    return true;
}

@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Added to cart!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
@endif
</script>

<style>
.qodef-woo-product-inner .add_to_cart_button {
padding: 8px 13px;
font-size: 14px;
transition: all 0.3s ease;
}

.qodef-woo-product-inner .add_to_cart_button:hover {
background-color: #f5f5f5;
color: #333;
}
</style>


