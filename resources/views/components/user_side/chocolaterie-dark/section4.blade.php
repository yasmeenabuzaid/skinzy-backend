<section
class="elementor-section elementor-top-section elementor-element elementor-element-63f3e84 qodef-elementor-content-grid elementor-section-boxed elementor-section-height-default elementor-section-height-default"
data-id="63f3e84" data-element_type="section"
data-settings="{"background_background":"classic"}">
<div class="elementor-container elementor-column-gap-default">
    <div class="elementor-row">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4cfb036"
            data-id="4cfb036" data-element_type="column">
            <div class="elementor-column-wrap elementor-element-populated">
                <div class="elementor-widget-wrap">
                    <div class="elementor-element elementor-element-aa251b0 elementor-widget elementor-widget-swissdelight_core_product_list"
                        data-id="aa251b0" data-element_type="widget"
                        data-widget_type="swissdelight_core_product_list.default">
                        <div class="elementor-widget-container">
                            <div class="qodef-shortcode qodef-m  qodef-woo-shortcode qodef-woo-product-list qodef-item-layout--info-below qodef-item-skin--light qodef-button-position--bottom  qodef-line-separator qodef-appear-animation--enabled qodef-hover--none qodef-grid qodef-layout--columns  qodef-gutter--huge qodef-col-num--4 qodef-item-layout--info-below qodef--no-bottom-space qodef-pagination--off qodef-responsive--custom qodef-col-num--1440--4 qodef-col-num--1366--4 qodef-col-num--1024--2 qodef-col-num--768--2 qodef-col-num--680--1 qodef-col-num--480--1"
                                data-options="{"plugin":"swissdelight_core","module":"plugins/woocommerce/shortcodes","shortcode":"product-list","post_type":"product","next_page":"2","max_pages_num":1,"behavior":"columns","images_proportion":"full","columns":"4","columns_responsive":"custom","columns_1440":"4","columns_1366":"4","columns_1024":"2","columns_768":"2","columns_680":"1","columns_480":"1","space":"huge","uneven_layout":"no","enable_line":"yes","add_to_cart_position":"bottom","skin":"light","posts_per_page":"4","orderby":"date","order":"ASC","additional_params":"tax","tax":"product_cat","tax_slug":"Candy","product_list_enable_filter_order_by":"no","product_list_enable_filter_category":"no","layout":"info-below","title_tag":"h5","enable_excerpt":"yes","excerpt_length":"26","enable_category":"no","appear_animation":"yes","hover_animation":"none","pagination_type":"no-pagination","object_class_name":"SwissDelightCore_Product_List_Shortcode","taxonomy_filter":"product_cat","additional_query_args":{"tax_query":[{"taxonomy":"product_cat","field":"slug","terms":"Candy"}]},"space_value":40}">
                                <div class="qodef-filter-holder">
                                </div>
                                <div class="qodef-grid-inner clear">

                                    @php
                                        $isLoggedIn = auth()->check();
                                    @endphp

                                    @foreach($products as $product)
                                        <div class="qodef-e qodef-grid-item qodef-item--full product type-product post-5554 status-publish last instock product_cat-candy product_tag-cocoa product_tag-milky has-post-thumbnail shipping-taxable purchasable product-type-simple">
                                            <div class="qodef-woo-product-inner">
                                                <div class="qodef-woo-product-image">
                                                    <a href="{{ route('product_details', $product->id) }}">
                                                        @if($product->product_images->isNotEmpty())
                                                            <img loading="lazy" decoding="async" src="{{ asset($product->product_images[0]->image) }}" alt="{{ $product->name }}" width="500" height="500" />
                                                        @else
                                                            <span>No image available</span>
                                                        @endif
                                                    </a>
                                                    <div class="qodef-woo-product-image-inner">
                                                        <form class="pd-detail__form" action="{{ $isLoggedIn ? route('cart.add') : route('login') }}" method="POST" enctype="multipart/form-data" onsubmit="return handleCartSubmit(event, {{ $isLoggedIn ? 'true' : 'false' }})">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                                            <input type="hidden" name="discount" value="{{ $product->discount }}">
                                                            <input type="hidden" name="final_price" value="{{ $product->discount > 0 ? $product->price * (1 - $product->discount / 100) : $product->price }}">
                                                            <input type="hidden" name="small_description" value="{{ $product->small_description }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="submit" class="button product_type_simple add_to_cart_button">
                                                                + Add
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="qodef-woo-product-content">
                                                    <h5 itemprop="name" class="qodef-woo-product-title entry-title">
                                                        <a itemprop="url" class="qodef-woo-product-title-link" href="{{ route('product_details', $product->id) }}">
                                                            {{ $product->name }}
                                                        </a>
                                                    </h5>
                                                    <p itemprop="description" class="qodef-woo-product-excerpt">
                                                        {{ $product->small_description }}
                                                    </p>
                                                    <div class="qodef-woo-product-price price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>{{ $product->price }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <a href="{{ route('product_details', $product->id) }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <svg class="qodef-m-pagination-spinner" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                    <path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path>
                                </svg>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>



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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7B4DzFt8Q6U1yV9gjbOWg2NLjz/3rZ0p4MwvOQKlChXJk1N2a8kQDQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        color: #ffffff;

    padding: 8px 13px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.qodef-woo-product-inner .add_to_cart_button:hover {
    background-color: #f5f5f5;
    color: #ffffff;
}
</style>
