@php
$cartItems = json_decode(Cookie::get('cart', json_encode([])), true);
$cartCount = array_reduce($cartItems, function ($carry, $item) {
    return $carry + $item['quantity'];
}, 0);
@endphp
<header id="qodef-page-header" role="banner">
    <div id="qodef-page-header-inner" class=" qodef-skin--light">
        <a itemprop="url" class="qodef-header-logo-link qodef-height--set" href="https://swissdelight.qodeinteractive.com/"
            style="height:92px" rel="home">
            <img width="300" height="184"
                src="{{asset('assets/img/new_logo2.png')}}"
                class="qodef-header-logo-image qodef--main" alt="logo main" itemprop="image" /><img src="http://8269"
                class="qodef-header-logo-image qodef--dark" itemprop="image" alt="logo dark" /><img width="300"
                height="154"
                src="{{asset('assets/img/new_logo2.png')}}"
                class="qodef-header-logo-image qodef--light" alt="logo light" itemprop="image" /></a>
        <nav class="qodef-header-navigation" role="navigation" aria-label="Top Menu">
            <ul id="menu-main-menu-1" class="menu">
                <li
                    class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-3220 qodef--hide-link qodef-menu-item--narrow">
                    <a href="{{ route('home') }}" style="cursor: pointer;">
                        <span class="qodef-menu-item-text">Home
                            <svg class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                height="11.75px" viewBox="0 0 7.76 11.75" enable-background="new 0 0 7.76 11.75"
                                xml:space="preserve">
                                <path fill="#63605A"
                                    d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                            </svg>
                        </span>
                    </a>
                </li>




                {{-- <li
                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3225 qodef--hide-link qodef-menu-item--narrow">
                    <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Who We Are<svg
                                class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                height="11.75px" viewBox="0 0 7.76 11.75" enable-background="new 0 0 7.76 11.75"
                                xml:space="preserve">
                                <path fill="#63605A"
                                    d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                            </svg></span></a>
                    <div class="qodef-drop-down-second">
                        <div class="qodef-drop-down-second-inner">
                            <ul class="sub-menu">
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6204"><a
                                        href="https://swissdelight.qodeinteractive.com/about-us/"><span
                                            class="qodef-menu-item-text">About Us</span></a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6212"><a
                                        href="https://swissdelight.qodeinteractive.com/who-we-are/"><span
                                            class="qodef-menu-item-text">Who We Are</span></a></li>

                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6210"><a
                                        href="https://swissdelight.qodeinteractive.com/our-menu/"><span
                                            class="qodef-menu-item-text">Our Menu</span></a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6207"><a
                                        href="https://swissdelight.qodeinteractive.com/contact-us/"><span
                                            class="qodef-menu-item-text">Contact Us</span></a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6208"><a
                                        href="https://swissdelight.qodeinteractive.com/get-in-touch/"><span
                                            class="qodef-menu-item-text">Get In Touch</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li> --}}



            </ul>
        </nav>
        <div class="qodef-widget-holder qodef--one">
            <div class="widget widget_swissdelight_core_button" data-area="home-2-custom-header"><a
                    class="qodef-shortcode qodef-m  qodef-button qodef-layout--textual  qodef-html--link  "
                    href="{{ route('shop') }}" target="_self"
                    style="padding: 0px 5px 0px 0px">
                    <span class="qodef-m-text">online order </span>
                </a>
            </div>
            <div class="widget widget_swissdelight_core_woo_dropdown_cart" data-area="home-2-custom-header">
                <div class="qodef-woo-dropdown-cart qodef-m">
                    <div class="qodef-woo-dropdown-cart-inner qodef-m-inner">
                        <a itemprop="url" class="qodef-m-opener"
                        href="{{ route('cart.index')}} ">
                            <span class="qodef-m-opener-label">cart</span>
                            <span class="qodef-m-opener-count">
                                {{ $cartCount }}<svg class="qodef-m-svg-icon" xmlns="http://www.w3.org/2000/svg">
                                    <circle stroke-miterlimit="10" cx="18.66" cy="18.66" r="15.5" />
                                    <circle stroke-miterlimit="10" cx="18.66" cy="18.66" r="15.5" />
                                </svg> </span>
                        </a>
                        <div class="qodef-m-dropdown">
                            <div class="qodef-m-dropdown-inner">
                                @if($cartCount != 0)
                                <ul class="qodef-cart-items-list">
                                    @foreach ($cartItems as $item)
                                        @php
                                            $product = \App\Models\Product::find($item['product_id']);
                                            $price =  $product->price;
                                        @endphp
                                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                            <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}" width="50" style="border-radius: 6px;">
                                            <div>
                                                <div style="font-weight: bold; color: #333;">{{ $product->name }}</div>
                                                <div style="font-size: 14px; color: #333;">{{ $item['quantity'] }} × {{ number_format($price, 2) }} $</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <p class="text-end fw-bold mt-2" style="margin-top: 15px;">
                                    Total: {{ number_format(collect($cartItems)->sum(function($item) {
                                        $product = \App\Models\Product::find($item['product_id']);
                                        $price = $product->price;
                                        return $price * $item['quantity'];
                                    }), 2) }} $
                                </p>

                                <!-- Buttons -->
                                <div style="display: flex; justify-content: space-between; gap: 10px; margin-top: 15px;">
                                    <a href="{{ route('cart.index') }}"
                                       style="flex: 1; padding: 10px; text-align: center; border: 1px solid #333; color: #333; background: #fff; border-radius: 5px; font-weight: 500;">
                                        Go to Cart
                                    </a>
                                    <a href="{{ route('order.create') }}"
                                       style="flex: 1; padding: 10px; text-align: center; border: none; color: #fff; background: #212529; border-radius: 5px; font-weight: 500;">
                                        Checkout
                                    </a>
                                </div>

                            @else
                                <p class="text-center" style="padding: 20px 0;">No products in the cart.</p>
                            @endif                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget widget_swissdelight_core_side_area_opener" data-area="home-2-custom-header"><a
                    href="javascript:void(0)"
                    class="qodef-opener-icon qodef-m qodef-source--svg-path qodef-side-area-opener"
                    style="margin: 0px 0px 0px 6px">
                    <span class="qodef-m-icon qodef--open">
                        <svg class="qodef-side-area--svg-open" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="34px" height="9px"
                            viewBox="0 0 34 9" enable-background="new 0 0 34 9" xml:space="preserve">
                            <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="0"
                                y1="8.295" x2="34" y2="8.295" />
                            <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="0"
                                y1="0.705" x2="34" y2="0.705" />
                        </svg> </span>
                </a>
            </div>
        </div>
    </div>
    <div class="qodef-header-sticky qodef-custom-header-layout qodef-skin--light qodef-appearance--down">
        <div class="qodef-header-sticky-inner ">
            <a itemprop="url" class="qodef-header-logo-link qodef-height--set"
                href="https://swissdelight.qodeinteractive.com/" style="height:92px" rel="home">
                <img width="150" height="71"
                    src="{{asset('assets/img/new_logo2.png')}}"
                    class="qodef-header-logo-image qodef--main" alt="logo main" itemprop="image" /></a>
            <nav class="qodef-header-navigation" role="navigation" aria-label="Top Menu">
                <ul id="menu-main-menu-2" class="menu">
                    <li
                        class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-3220 qodef--hide-link qodef-menu-item--narrow">
                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Home<svg
                                    class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                    height="11.75px" viewBox="0 0 7.76 11.75" enable-background="new 0 0 7.76 11.75"
                                    xml:space="preserve">
                                    <path fill="#63605A"
                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                </svg></span></a>
                        <div class="qodef-drop-down-second">
                            <div class="qodef-drop-down-second-inner">
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-3221">
                                        <a href="{{ route('home') }}"><span
                                                class="qodef-menu-item-text">Main Home</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1605 current_page_item menu-item-3222">
                                        <a href="{{ route('dark') }}"><span
                                                class="qodef-menu-item-text">Chocolaterie Dark</span></a></li>


                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3223">
                                        <a href="{{ route('light') }}"><span
                                                class="qodef-menu-item-text">Chocolaterie Light</span></a></li>


                                </ul>
                            </div>
                        </div>
                    </li>
                    {{-- <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3225 qodef--hide-link qodef-menu-item--narrow">
                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Pages<svg
                                    class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                    height="11.75px" viewBox="0 0 7.76 11.75" enable-background="new 0 0 7.76 11.75"
                                    xml:space="preserve">
                                    <path fill="#63605A"
                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                </svg></span></a>
                        <div class="qodef-drop-down-second">
                            <div class="qodef-drop-down-second-inner">
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6204">
                                        <a href="https://swissdelight.qodeinteractive.com/about-us/"><span
                                                class="qodef-menu-item-text">About Us</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6212">
                                        <a href="https://swissdelight.qodeinteractive.com/who-we-are/"><span
                                                class="qodef-menu-item-text">Who We Are</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6205">
                                        <a href="https://swissdelight.qodeinteractive.com/our-chef/"><span
                                                class="qodef-menu-item-text">Our Chef</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6209">
                                        <a href="https://swissdelight.qodeinteractive.com/our-history/"><span
                                                class="qodef-menu-item-text">Our History</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6210">
                                        <a href="https://swissdelight.qodeinteractive.com/our-menu/"><span
                                                class="qodef-menu-item-text">Our Menu</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6211">
                                        <a href="https://swissdelight.qodeinteractive.com/pricing-plans/"><span
                                                class="qodef-menu-item-text">Pricing Plans</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6207">
                                        <a href="https://swissdelight.qodeinteractive.com/contact-us/"><span
                                                class="qodef-menu-item-text">Contact Us</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6208">
                                        <a href="https://swissdelight.qodeinteractive.com/get-in-touch/"><span
                                                class="qodef-menu-item-text">Get In Touch</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3227 qodef--hide-link qodef-menu-item--narrow">
                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Shop<svg
                                    class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                    height="11.75px" viewBox="0 0 7.76 11.75" enable-background="new 0 0 7.76 11.75"
                                    xml:space="preserve">
                                    <path fill="#63605A"
                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                </svg></span></a>
                        <div class="qodef-drop-down-second">
                            <div class="qodef-drop-down-second-inner">
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5139">
                                        <a href="https://swissdelight.qodeinteractive.com/shop/"><span
                                                class="qodef-menu-item-text">Right Sidebar</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9176">
                                        <a href="https://swissdelight.qodeinteractive.com/shop-left-sidebar/"><span
                                                class="qodef-menu-item-text">Left Sidebar</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9177">
                                        <a href="https://swissdelight.qodeinteractive.com/shop/with-filter/"><span
                                                class="qodef-menu-item-text">With Filter</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9178">
                                        <a href="https://swissdelight.qodeinteractive.com/shop/uneven/"><span
                                                class="qodef-menu-item-text">Uneven</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9179">
                                        <a href="https://swissdelight.qodeinteractive.com/shop/minimal/"><span
                                                class="qodef-menu-item-text">Minimal</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9180 qodef--hide-link">
                                        <a href="#" onclick="JavaScript: return false;"><span
                                                class="qodef-menu-item-text">Shop Single<svg
                                                    class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="7.76px" height="11.75px" viewBox="0 0 7.76 11.75"
                                                    enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                                    <path fill="#63605A"
                                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                                </svg></span></a>
                                        <ul class="sub-menu">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-product menu-item-5141">
                                                <a href="https://swissdelight.qodeinteractive.com/product/pralines/"><span
                                                        class="qodef-menu-item-text">Custom Single</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-product menu-item-7134">
                                                <a href="https://swissdelight.qodeinteractive.com/product/mimosa/"><span
                                                        class="qodef-menu-item-text">Standard Single</span></a></li>
                                        </ul>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-5142 qodef--hide-link">
                                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Shop
                                                Layouts<svg class="qodef-menu-item-arrow"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="7.76px" height="11.75px" viewBox="0 0 7.76 11.75"
                                                    enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                                    <path fill="#63605A"
                                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                                </svg></span></a>
                                        <ul class="sub-menu">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9182">
                                                <a href="https://swissdelight.qodeinteractive.com/shop/two-columns/"><span
                                                        class="qodef-menu-item-text">Two Columns</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5155">
                                                <a href="https://swissdelight.qodeinteractive.com/shop/three-columns/"><span
                                                        class="qodef-menu-item-text">Three Columns</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5154">
                                                <a href="https://swissdelight.qodeinteractive.com/shop/four-columns/"><span
                                                        class="qodef-menu-item-text">Four Columns</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9184">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/shop/four-columns-wide/"><span
                                                        class="qodef-menu-item-text">Four Columns Wide</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5382">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/shop/five-columns-wide/"><span
                                                        class="qodef-menu-item-text">Five Columns Wide</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9186">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/shop/six-columns-wide/"><span
                                                        class="qodef-menu-item-text">Six Columns Wide</span></a></li>
                                        </ul>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-5156 qodef--hide-link">
                                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Shop
                                                Pages<svg class="qodef-menu-item-arrow"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="7.76px" height="11.75px" viewBox="0 0 7.76 11.75"
                                                    enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                                    <path fill="#63605A"
                                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                                </svg></span></a>
                                        <ul class="sub-menu">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5159">
                                                <a href="https://swissdelight.qodeinteractive.com/my-account/"><span
                                                        class="qodef-menu-item-text">My Account</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6924">
                                                <a href="https://swissdelight.qodeinteractive.com/wishlist/"><span
                                                        class="qodef-menu-item-text">Wishlist</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5158">
                                                <a href="https://swissdelight.qodeinteractive.com/checkout/"><span
                                                        class="qodef-menu-item-text">Checkout</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5157">
                                                <a href="https://swissdelight.qodeinteractive.com/cart/"><span
                                                        class="qodef-menu-item-text">Cart</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3228 qodef--hide-link qodef-menu-item--narrow">
                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Portfolio<svg
                                    class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                    height="11.75px" viewBox="0 0 7.76 11.75" enable-background="new 0 0 7.76 11.75"
                                    xml:space="preserve">
                                    <path fill="#63605A"
                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                </svg></span></a>
                        <div class="qodef-drop-down-second">
                            <div class="qodef-drop-down-second-inner">
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4698">
                                        <a href="https://swissdelight.qodeinteractive.com/portfolio/standard/"><span
                                                class="qodef-menu-item-text">Standard List</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4690">
                                        <a href="https://swissdelight.qodeinteractive.com/portfolio/gallery/"><span
                                                class="qodef-menu-item-text">Gallery List</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4691">
                                        <a href="https://swissdelight.qodeinteractive.com/portfolio/masonry/"><span
                                                class="qodef-menu-item-text">Masonry List</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4689">
                                        <a
                                            href="https://swissdelight.qodeinteractive.com/portfolio/fullscreen-slider/"><span
                                                class="qodef-menu-item-text">Fullscreen Slider</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4050 qodef--hide-link">
                                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">List
                                                Layouts<svg class="qodef-menu-item-arrow"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="7.76px" height="11.75px" viewBox="0 0 7.76 11.75"
                                                    enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                                    <path fill="#63605A"
                                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                                </svg></span></a>
                                        <ul class="sub-menu">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4057">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio/two-columns/"><span
                                                        class="qodef-menu-item-text">Two Columns</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4055">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio/three-columns/"><span
                                                        class="qodef-menu-item-text">Three Columns</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4056">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio/three-columns-wide/"><span
                                                        class="qodef-menu-item-text">Three Columns Wide</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4052">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio/four-columns/"><span
                                                        class="qodef-menu-item-text">Four Columns</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4053">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio/four-columns-wide/"><span
                                                        class="qodef-menu-item-text">Four Columns Wide</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4051">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio/five-columns-wide/"><span
                                                        class="qodef-menu-item-text">Five Columns Wide</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4054">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio/six-columns-wide/"><span
                                                        class="qodef-menu-item-text">Six Columns Wide</span></a></li>
                                        </ul>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4040 qodef--hide-link">
                                        <a onclick="JavaScript: return false;"><span
                                                class="qodef-menu-item-text">Single Types<svg
                                                    class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="7.76px" height="11.75px" viewBox="0 0 7.76 11.75"
                                                    enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                                    <path fill="#63605A"
                                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                                </svg></span></a>
                                        <ul class="sub-menu">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4041">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/milk-praline/"><span
                                                        class="qodef-menu-item-text">Big Images</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4042">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/almond-bars/"><span
                                                        class="qodef-menu-item-text">Small Images</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4043">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/choco-waffle/"><span
                                                        class="qodef-menu-item-text">Big Gallery</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4044">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/cocoa-butter/"><span
                                                        class="qodef-menu-item-text">Small Gallery</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4045">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/nougat-cream/"><span
                                                        class="qodef-menu-item-text">Big Masonry</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4046">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/mousee/"><span
                                                        class="qodef-menu-item-text">Small Masonry</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4048">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/choco-cakes/"><span
                                                        class="qodef-menu-item-text">Big Slider</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio-item menu-item-4049">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/portfolio-item/cherry-cake/"><span
                                                        class="qodef-menu-item-text">Small Slider</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3226 qodef--hide-link qodef-menu-item--narrow">
                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Blog<svg
                                    class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                    height="11.75px" viewBox="0 0 7.76 11.75" enable-background="new 0 0 7.76 11.75"
                                    xml:space="preserve">
                                    <path fill="#63605A"
                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                </svg></span></a>
                        <div class="qodef-drop-down-second">
                            <div class="qodef-drop-down-second-inner">
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3231">
                                        <a href="https://swissdelight.qodeinteractive.com/blog/right-sidebar/"><span
                                                class="qodef-menu-item-text">Right Sidebar</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3229">
                                        <a href="https://swissdelight.qodeinteractive.com/blog/left-sidebar/"><span
                                                class="qodef-menu-item-text">Left Sidebar</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3230">
                                        <a href="https://swissdelight.qodeinteractive.com/blog/no-sidebar/"><span
                                                class="qodef-menu-item-text">No Sidebar</span></a></li>
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3768 qodef--hide-link">
                                        <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Post
                                                Types<svg class="qodef-menu-item-arrow"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="7.76px" height="11.75px" viewBox="0 0 7.76 11.75"
                                                    enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                                    <path fill="#63605A"
                                                        d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                                </svg></span></a>
                                        <ul class="sub-menu">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3775">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/tradition-in-every-delicacy-ever/"><span
                                                        class="qodef-menu-item-text">Standard Post</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3773">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/supreme-cocoa-flavour/"><span
                                                        class="qodef-menu-item-text">Gallery Post</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3774">
                                                <a href="https://swissdelight.qodeinteractive.com/coffee-chocolate/"><span
                                                        class="qodef-menu-item-text">Quote Post</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3772">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/choco-mousse-delight/"><span
                                                        class="qodef-menu-item-text">Link Post</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3770">
                                                <a href="https://swissdelight.qodeinteractive.com/creamy-choco-latte/"><span
                                                        class="qodef-menu-item-text">Audio Post</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3769">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/choco-caramel-ganache/"><span
                                                        class="qodef-menu-item-text">Video Post</span></a></li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-post menu-item-3771">
                                                <a
                                                    href="https://swissdelight.qodeinteractive.com/brownies-to-die-for/"><span
                                                        class="qodef-menu-item-text">No Sidebar Post</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}
                </ul>
            </nav>
            <div class="qodef-widget-holder qodef--one">
                <div class="widget widget_swissdelight_core_button" data-area="home-2-custom-header"><a
                        class="qodef-shortcode qodef-m  qodef-button qodef-layout--textual  qodef-html--link  "
                        href="{{ route('shop') }}" target="_self"
                        style="padding: 0px 5px 0px 0px">
                        <span class="qodef-m-text">online order </span>
                    </a>
                </div>
                <div class="widget widget_swissdelight_core_woo_dropdown_cart" data-area="home-2-custom-header">
                    <div class="qodef-woo-dropdown-cart qodef-m">
                        <div class="qodef-woo-dropdown-cart-inner qodef-m-inner">
                            <a itemprop="url" class="qodef-m-opener"
                            href="{{ route('cart.index')}} ">
                                <span class="qodef-m-opener-label">cart</span>
                                <span class="qodef-m-opener-count">
                                    {{ $cartCount }}<svg class="qodef-m-svg-icon" xmlns="http://www.w3.org/2000/svg">
                                        <circle stroke-miterlimit="10" cx="18.66" cy="18.66" r="15.5" />
                                        <circle stroke-miterlimit="10" cx="18.66" cy="18.66" r="15.5" />
                                    </svg> </span>
                            </a>
                            <div class="qodef-m-dropdown">
                                <div class="qodef-m-dropdown-inner">
                                    @if($cartCount != 0)
                                    <ul class="qodef-cart-items-list">
                                        @foreach ($cartItems as $item)
                                            @php
                                                $product = \App\Models\Product::find($item['product_id']);
                                                $price = $product->discount
                                                    ? $product->price * (1 - $product->discount / 100)
                                                    : $product->price;
                                            @endphp
                                            <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                                <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}" width="50" style="border-radius: 6px;">
                                                <div>
                                                    <div style="font-weight: bold; color: #333;">{{ $product->name }}</div>
                                                    <div style="font-size: 14px; color: #333;">{{ $item['quantity'] }} × {{ number_format($price, 2) }} $</div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <p class="text-end fw-bold mt-2" style="margin-top: 15px;">
                                        Total: {{ number_format(collect($cartItems)->sum(function($item) {
                                            $product = \App\Models\Product::find($item['product_id']);
                                            $price = $product->discount
                                                ? $product->price * (1 - $product->discount / 100)
                                                : $product->price;
                                            return $price * $item['quantity'];
                                        }), 2) }} $
                                    </p>

                                    <!-- Buttons -->
                                    <div style="display: flex; justify-content: space-between; gap: 10px; margin-top: 15px;">
                                        <a href="{{ route('cart.index') }}"
                                           style="flex: 1; padding: 10px; text-align: center; border: 1px solid #333; color: #333; background: #fff; border-radius: 5px; font-weight: 500;">
                                            Go to Cart
                                        </a>
                                        <a href="{{ route('order.create') }}"
                                           style="flex: 1; padding: 10px; text-align: center; border: none; color: #fff; background: #212529; border-radius: 5px; font-weight: 500;">
                                            Checkout
                                        </a>
                                    </div>

                                @else
                                    <p class="text-center" style="padding: 20px 0;">No products in the cart.</p>
                                @endif                           </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</header>
