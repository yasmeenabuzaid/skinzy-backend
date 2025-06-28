<div id="qodef-page-inner" class="qodef-content-grid qodef-content--fullscreen">

    <main id="qodef-page-content" class="qodef-grid qodef-layout--template qodef--no-bottom-space ">
        <div class="qodef-grid-inner clear">
            <div id="qodef-woo-page"
                class="qodef-grid-item qodef--single qodef-popup--magnific-popup qodef-magnific-popup qodef-popup-gallery">

                <div class="woocommerce-notices-wrapper"></div>
                <div id="product-4075"
                    class="product type-product post-4075 status-publish first instock product_cat-chocolate product_cat-hot-choco product_tag-cakes product_tag-cannoli has-post-thumbnail shipping-taxable purchasable product-type-simple">

                    <div class="qodef-content-grid">


                        <div class="qodef-woo-single-inner">
                            <div class="qodef-woo-single-image">
                                <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images qodef-position--left"
                                    data-columns="4" style="opacity: 0; transition: opacity .25s ease-in-out;">
                                    <figure class="woocommerce-product-gallery__wrapper">


                                        <div class="woocommerce-product-gallery__image"
                                            data-thumb="{{ asset($productImages->first()->image ?? 'default-image.jpg') }}">
                                            <a
                                                href="{{ asset($productImages->first()->image ?? 'default-image.jpg') }}">
                                                <img width="706" height="794"
                                                    src="{{ asset($productImages->first()->image ?? 'default-image.jpg') }}"
                                                    alt="Product Image" title="Product Image" data-caption=""
                                                    data-src="{{ asset($productImages->first()->image ?? 'default-image.jpg') }}"
                                                    data-large_image="{{ asset($productImages->first()->image ?? 'default-image.jpg') }}"
                                                    data-large_image_width="800" data-large_image_height="900"
                                                    decoding="async" loading="lazy" class="wp-post-image" />
                                            </a>
                                        </div>



                                        <div class="qodef-woo-thumbnails-wrapper">
                                            <div class="qodef-woo-thumbnails-wrapper">
                                                @foreach ($productImages->skip(1) as $image)
                                                    <div class="woocommerce-product-gallery__image"
                                                        data-thumb="{{ asset($image->image) }}">
                                                        <a href="{{ asset($image->image) }}">
                                                            <img width="600" height="644"
                                                                src="{{ asset($image->image) }}" alt="Thumbnail"
                                                                title="Product Thumbnail" data-caption=""
                                                                data-src="{{ asset($image->image) }}"
                                                                data-large_image="{{ asset($image->image) }}"
                                                                data-large_image_width="600"
                                                                data-large_image_height="644" decoding="async"
                                                                loading="lazy" />
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                            </div>



                            <div class="summary entry-summary">
                                <h1 class="qodef-woo-product-title product_title entry-title">{{ $product->name }}
                                </h1>
                                <p class="price"><span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">&#36;</span>{{ $product->price }}
                                        </bdi></span>
                                </p>

                                <div class="woocommerce-product-rating">
                                    <div class="qodef-woo-ratings qodef-m">
                                        <div class="qodef-m-inner">
                                            <div class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($averageRating))
                                                        <span style="color: gold;">&#9733;</span> {{-- نجمة ممتلئة --}}
                                                    @else
                                                        <span style="color: lightgray;">&#9734;</span> {{-- نجمة فارغة --}}
                                                    @endif
                                                @endfor
                                                <span>({{ number_format($averageRating, 1) }} / 5)</span>
                                            </div>

                                        </div>
                                    </div> <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span
                                            class="count">{{ $totalFeedbacks }}</span> customer
                                        review)</a>
                                </div>

                                <div class="woocommerce-product-details__short-description">
                                    <p>{{ $product->small_description }} </p>
                                </div>
                                {{-- <div class="woocommerce-product-details__short-description">
                                                <p>{{ $product->description }} </p>
                                            </div> --}}


                                            @php
                                            $isLoggedIn = auth()->check();
                                        @endphp

                                        <form class="pd-detail__form"
                                              action="{{ $isLoggedIn ? route('cart.add') : '#' }}"
                                              method="POST"
                                              enctype="multipart/form-data"
                                              onsubmit="return handleCartSubmit(event, {{ $isLoggedIn ? 'true' : 'false' }})">

                                            @csrf

                                            <input type="hidden" name="product_id" value="{{$product->id}}" >
                                                <input type="hidden" name="name" value="{{$product->name}}">
                                                <input type="hidden" name="final_price" value="{{$product->price}}">

                                                <input type="hidden" name="small_description" value="{{$product->small_description}}">


                                    <div class="qodef-quantity-buttons quantity">
                                        <label class="screen-reader-text" for="quantity_67fffc62d7060">Mimosa
                                            quantity</label>
                                        <span class="qodef-quantity-minus"></span>
                                        <input type="text" id="quantity_67fffc62d7060"
                                            class="input-text qty text qodef-quantity-input" data-step="1"
                                            data-min="1" data-max="{{ $product->quantity }}" name="quantity"
                                            value=" 1" title="Qty" size="4" placeholder=""
                                            inputmode="numeric" />
                                        <span class="qodef-quantity-plus"></span>
                                    </div>

                                    <button type="submit" name="add-to-cart" class="single_add_to_cart_button button alt">Add to cart</button>

                                </form>



                                <div class="yith-wcwl-add-to-wishlist add-to-wishlist-4075  wishlist-fragment on-first-load"
                                    data-fragment-ref="4075"
                                    data-fragment-options="{&quot;base_url&quot;:&quot;&quot;,&quot;in_default_wishlist&quot;:false,&quot;is_single&quot;:true,&quot;show_exists&quot;:false,&quot;product_id&quot;:4075,&quot;parent_product_id&quot;:4075,&quot;product_type&quot;:&quot;simple&quot;,&quot;show_view&quot;:true,&quot;browse_wishlist_text&quot;:&quot;Browse wishlist&quot;,&quot;already_in_wishslist_text&quot;:&quot;The product is already in your wishlist!&quot;,&quot;product_added_text&quot;:&quot;Product added!&quot;,&quot;heading_icon&quot;:&quot;fa-heart-o&quot;,&quot;available_multi_wishlist&quot;:false,&quot;disable_wishlist&quot;:false,&quot;show_count&quot;:false,&quot;ajax_loading&quot;:false,&quot;loop_position&quot;:&quot;after_add_to_cart&quot;,&quot;item&quot;:&quot;add_to_wishlist&quot;}">

                                    <!-- ADD TO WISHLIST -->

                                    <!-- COUNT TEXT -->

                                </div>
                                <div class="product_meta">

                                    {{-- <span class="sku_wrapper">
                                                    <span class="qodef-woo-meta-label">SKU:</span>
                                                    <span class="sku qodef-woo-meta-value">02</span>
                                                </span> --}}

                                    <span class="posted_in"><span class="qodef-woo-meta-label">Categories:</span><span
                                            class="qodef-woo-meta-value"><a
                                                href="https://swissdelight.qodeinteractive.com/product-category/chocolate/"
                                                rel="tag">{{ $product->subCategory->category->name }}</a></span></span>
                                    <span class="tagged_as"><span class="qodef-woo-meta-label">Sub Category:</span><span
                                            class="qodef-woo-meta-value"><a
                                                href="https://swissdelight.qodeinteractive.com/product-tag/cakes/"
                                                rel="tag">{{ $product->subCategory->name }}</a></span></span>
                                </div>

<div class="container py-4">
    <div>
        @if ($product->type == 'variation')
        <p>Product Variation</p>
            <div class="card mb-4">
                <div class="card-body text-center">
                    <a href="{{ route('product_details', $mainProduct->id) }}">
                        <img src="{{ asset($mainProduct->product_images->first()->image ?? 'default-image.jpg') }}"
                             alt="{{ $mainProduct->name }}" class="img-fluid rounded" style="max-height: 200px;" />
                    </a>
                </div>
            </div>
        @endif

        <div class="row">
            <p>Product Variation :</p>
            @foreach ($variations as $variation)

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card text-center w-100" style="height: 200px;"> {{-- ارتفاع ثابت --}}
                        <div class="card-body d-flex flex-column justify-content-between p-3 h-100">
                            <a href="{{ route('product_details', $variation->id) }}" class="flex-grow-1 d-flex align-items-center justify-content-center">
                                <div style="width: 100%; height: 150px; overflow: hidden;">
                                    <img src="{{ asset($variation->product_images->first()->image ?? 'default-image.jpg') }}"
                                         alt="{{ $variation->name }}"
                                         class="img-fluid rounded object-fit-cover w-100 h-100" />
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>




                            </div>
                            </div>

                        </div>
                    </div>
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
                            // Else, let the form submit normally
                            return true;
                        }
                    </script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Added to cart!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>

@endif
