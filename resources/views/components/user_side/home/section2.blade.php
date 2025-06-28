    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <section class="elementor-section elementor-top-section elementor-element elementor-element-c7e6cc1 qodef-elementor-content-grid elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="c7e6cc1" data-element_type="section">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-02f65b9" data-id="02f65b9" data-element_type="column">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-element-a0a128c elementor-widget__width-initial elementor-widget elementor-widget-swissdelight_core_section_title" data-id="a0a128c" data-element_type="widget" data-widget_type="swissdelight_core_section_title.default">
                                <div class="elementor-widget-container">
                                    <div class="qodef-shortcode qodef-m  qodef-section-title qodef-alignment--center  qodef-appear-animation--enabled">
                                        <span class="qodef-m-tagline">chocolate ganache</span>
                                        <h2 class="qodef-m-title">
                                            WE CREATE Lovely <span class="qodef-subtitle-wrapper">MEMORIES<span class="qodef-m-subtitle">Choco</span></span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="elementor-section elementor-top-section elementor-element elementor-element-1547466 qodef-elementor-content-grid elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="1547466" data-element_type="section">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-722f994" data-id="722f994" data-element_type="column">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-element-dd27b17 elementor-widget elementor-widget-swissdelight_core_product_list" data-id="dd27b17" data-element_type="widget" data-widget_type="swissdelight_core_product_list.default">
                                <div class="elementor-widget-container">
                                    <div class="qodef-shortcode qodef-m  qodef-woo-shortcode qodef-woo-product-list qodef-item-layout--info-below  qodef-button-position--bottom qodef-uneven-layout qodef-line-separator qodef-appear-animation--enabled qodef-hover--move qodef-grid qodef-layout--columns  qodef-gutter--normal qodef-col-num--4 qodef-item-layout--info-below qodef--no-bottom-space qodef-pagination--off qodef-responsive--custom qodef-col-num--1440--4 qodef-col-num--1366--4 qodef-col-num--1024--2 qodef-col-num--768--2 qodef-col-num--680--1 qodef-col-num--480--1">

                                        <div class="qodef-filter-holder"></div>
                                        <div class="qodef-grid-inner clear">

                                            @php
                                                $isLoggedIn = auth()->check();
                                            @endphp

                                            @foreach ($products->take(4) as $index => $product)
                                                <div class="qodef-e qodef-grid-item qodef-item--full product type-product {{ $index % 2 != 0 ? 'post-4425' : '' }}">
                                                    <div class="qodef-woo-product-inner">
                                                        <div class="qodef-woo-product-image">
                                                            @if ($product->product_images->isNotEmpty())
                                                                <a href="{{ route('product_details', $product->id) }}">
                                                                    <img src="{{ asset($product->product_images[0]->image) }}" alt="{{ $product->name }}" width="800" height="1126" />
                                                                </a>
                                                            @else
                                                                <span>No image available</span>
                                                            @endif

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
                                                            <h5 class="qodef-woo-product-title entry-title">
                                                                <a href="{{ route('product_details', $product->id) }}">
                                                                    {{ $product->name }}
                                                                </a>
                                                            </h5>
                                                            <div class="qodef-woo-product-price price">
                                                                ${{ $product->price }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <!-- Spinner Icon -->
                                        <svg class="qodef-m-pagination-spinner" xmlns="http://www.w3.org/2000/svg"
                                            width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z" />
                                        </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    // Handle Cart Submit with SweetAlert
    function handleCartSubmit(event, isLoggedIn) {
        if (!isLoggedIn) {
            event.preventDefault();  // Prevent form submission
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

    // SweetAlert for success message after adding to cart
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


