@php
    $cartItems = json_decode(Cookie::get('cart', json_encode([])), true);
    $cartCount = array_reduce(
        $cartItems,
        function ($carry, $item) {
            return $carry + $item['quantity'];
        },
        0,
    );
@endphp
<link rel='stylesheet' id='font-awesome-css'
    href='https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/inc/icons/font-awesome/assets/css/all.min.css?ver=6.8'
    type='text/css' media='all' />

<body
    class="home wp-singular page-template page-template-page-full-width page-template-page-full-width-php page page-id-60 wp-theme-swissdelight theme-swissdelight qode-framework-1.1.5 woocommerce-no-js qodef-qi--no-touch qi-addons-for-elementor-1.2.2 qodef-age-verification--opened qodef-back-to-top--enabled  qodef-content-behind-header qodef-header--divided qodef-header-appearance--sticky qodef-header--transparent qodef-content--behind-header qodef-mobile-header--standard qodef-drop-down-second--full-width qodef-drop-down-second--default swissdelight-core-1.0 swissdelight-membership-1.0 swissdelight-1.0.1 qodef-content-grid-1400 qodef-post-custom-style qodef-search--covers-header elementor-default elementor-kit-11 elementor-page elementor-page-60"
    itemscope itemtype="https://schema.org/WebPage">
    <a class="skip-link screen-reader-text" href="#qodef-page-content">Skip to the content</a>
    <div id="qodef-page-wrapper" class="">
        <header id="qodef-page-header" role="banner">
            <div id="qodef-page-header-inner" class="">
                <div class="qodef-divided-header-left-wrapper">
                    <nav class="qodef-header-navigation" role="navigation" aria-label="Divided Left Menu">
                        <ul id="menu-left-divided-menu" class="menu">
                            <li id="menu-item-3063"
                                class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-3063 qodef--hide-link qodef-menu-item--narrow">
                                <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Home<svg
                                            class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                            height="11.75px" viewBox="0 0 7.76 11.75"
                                            enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                            <path fill="#63605A"
                                                d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                        </svg></span></a>
                                <div class="qodef-drop-down-second">
                                    <div class="qodef-drop-down-second-inner">
                                        <ul class="sub-menu">
                                            <li id="menu-item-3069"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-60 current_page_item menu-item-3069">
                                                <a href="{{ route('home') }}"><span class="qodef-menu-item-text">Main
                                                        Home</span></a>
                                            </li>
                                            <li id="menu-item-3070"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3070">
                                                <a href="{{ route('dark') }}"><span
                                                        class="qodef-menu-item-text">Chocolaterie Dark</span></a>
                                            </li>
                                            <li id="menu-item-3071"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3071">
                                                <a href="{{ route('light') }}"><span
                                                        class="qodef-menu-item-text">Chocolaterie Light</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>

                            <li id="menu-item-3065"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3065 qodef-menu-item--narrow">
                                <a href="{{ route('shop') }}">
                                    <span class="qodef-menu-item-text">
                                        Shop
                                        <svg class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                            height="11.75px" viewBox="0 0 7.76 11.75"
                                            enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                            <path fill="#63605A"
                                                d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <li id="menu-item-3068"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3068">
                                <a href="{{route('profile')}}">
                                    <span class="qodef-menu-item-text">My Account</span>
                                </a>
                            </li>


                        </ul>
                    </nav>
                </div>
                <a itemprop="url" class="qodef-header-logo-link qodef-height--set"
                    href="https://swissdelight.qodeinteractive.com/" style="height:92px" rel="home">
                    <img width="300" height="184"
                        src="{{asset('assets/img/new_logo2.png')}}"
                        class="qodef-header-logo-image qodef--main" alt="logo main" itemprop="image" /><img
                        width="300" height="184"
                        src="{{asset('assets/img/new_logo2.png')}}"
                        class="qodef-header-logo-image qodef--dark" alt="logo dark" itemprop="image" /><img
                        width="300" height="184"
                        src="{{asset('assets/img/new_logo2.png')}}"
                        class="qodef-header-logo-image qodef--light" alt="logo light" itemprop="image" /></a>
                <div class="qodef-divided-header-right-wrapper">
                    <div class="qodef-widget-holder qodef--one">

                        <div id="swissdelight_membership_login_opener-2"
                        class="widget widget_swissdelight_membership_login_opener qodef-header-widget-area-one"
                        data-area="header-widget-one">
                        <div class="qodef-login-opener-widget" style="margin: 0px 5px 0px 7px">
                            @if (Auth::guest())
                                <a href="{{ route('login') }}">
                                    <span class="qodef-login-opener-text">Login</span>
                                    <i class="fas fa-sign-in-alt" style="margin-left: 5px;"></i>
                                </a>
                            @else
                                @if (Auth::user()->role == 'manager')
                                    <a href="{{ route('dashboard') }}">
                                        <span class="qodef-login-opener-text">Dashboard</span>
                                        <i class="fas fa-tachometer-alt" style="margin-left: 5px;"></i>
                                    </a>
                                @else
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="qodef-login-opener-text">Logout</span>
                                        <i class="fas fa-sign-out-alt" style="margin-left: 5px;"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                        <div id="swissdelight_core_woo_dropdown_cart-2"
                            class="widget widget_swissdelight_core_woo_dropdown_cart qodef-header-widget-area-one"
                            data-area="header-widget-one">
                            <div class="qodef-woo-dropdown-cart qodef-m" style="padding: 0px 5px 0px 7px">
                                <div class="qodef-woo-dropdown-cart-inner qodef-m-inner">
                                    <a itemprop="url" class="qodef-m-opener" href="{{ route('cart.index') }} ">
                                        <span class="qodef-m-opener-label">cart</span>
                                        <span class="qodef-m-opener-count">
                                            {{ $cartCount }} <svg class="qodef-m-svg-icon"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle stroke-miterlimit="10" cx="18.66" cy="18.66"
                                                    r="15.5" />
                                                <circle stroke-miterlimit="10" cx="18.66" cy="18.66"
                                                    r="15.5" />
                                            </svg> </span>
                                    </a>
                                    <div class="qodef-m-dropdown">
                                        <div class="qodef-m-dropdown-inner">
                                            @if ($cartCount != 0)
                                                <ul class="qodef-cart-items-list">
                                                    @foreach ($cartItems as $item)
                                                        @php
                                                            $product = \App\Models\Product::find($item['product_id']);
                                                            $price = $product->price;
                                                        @endphp
                                                        <li
                                                            style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                                            <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}"
                                                                width="50" style="border-radius: 6px;">
                                                            <div>
                                                                <div style="font-weight: bold;">{{ $product->name }}
                                                                </div>
                                                                <div style="font-size: 14px;">{{ $item['quantity'] }} ×
                                                                    {{ number_format($price, 2) }} $</div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <p class="text-end fw-bold mt-2" style="margin-top: 15px;">
                                                    Total:
                                                    {{ number_format(
                                                        collect($cartItems)->sum(function ($item) {
                                                            $product = \App\Models\Product::find($item['product_id']);
                                                            $price = $product->price;
                                                            return $price * $item['quantity'];
                                                        }),
                                                        2,
                                                    ) }}
                                                    $
                                                </p>

                                                <!-- Buttons -->
                                                <div
                                                    style="display: flex; justify-content: space-between; gap: 10px; margin-top: 15px;">
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
                                                <p class="text-center" style="padding: 20px 0;">No products in the
                                                    cart.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="swissdelight_core_side_area_opener-2"
                            class="widget widget_swissdelight_core_side_area_opener qodef-header-widget-area-one"
                            data-area="header-widget-one"><a href="javascript:void(0)"
                                class="qodef-opener-icon qodef-m qodef-source--svg-path qodef-side-area-opener"
                                style="margin: 0px 0px 0px 6px">
                                <span class="qodef-m-icon qodef--open">
                                    <svg class="qodef-side-area--svg-open" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="34px"
                                        height="9px" viewBox="0 0 34 9" enable-background="new 0 0 34 9"
                                        xml:space="preserve">
                                        <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="0"
                                            y1="8.295" x2="34" y2="8.295" />
                                        <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="0"
                                            y1="0.705" x2="34" y2="0.705" />
                                    </svg> </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="qodef-header-sticky">
                <div class="qodef-header-sticky-inner">
                    <div class="qodef-divided-header-left-wrapper">
                        <nav class="qodef-header-navigation" role="navigation" aria-label="Divided Left Menu">
                            <ul id="menu-left-divided-menu-1" class="menu">
                                <li
                                    class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-3063 qodef--hide-link qodef-menu-item--narrow">
                                    <a onclick="JavaScript: return false;"><span class="qodef-menu-item-text">Home<svg
                                                class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                width="7.76px" height="11.75px" viewBox="0 0 7.76 11.75"
                                                enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                                <path fill="#63605A"
                                                    d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                            </svg></span></a>
                                    <div class="qodef-drop-down-second">
                                        <div class="qodef-drop-down-second-inner">
                                            <ul class="sub-menu">
                                                <li
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-60 current_page_item menu-item-3069">
                                                    <a href="{{ route('home') }}"><span
                                                            class="qodef-menu-item-text">Main Home</span></a>
                                                </li>
                                                <li
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3070">
                                                    <a href="{{ route('dark') }}"><span
                                                            class="qodef-menu-item-text">Chocolaterie Dark</span></a>
                                                </li>

                                                <li
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3071">
                                                    <a href="{{ route('light') }}"><span
                                                            class="qodef-menu-item-text">Chocolaterie Light</span></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li id="menu-item-3065"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3065 qodef-menu-item--narrow">
                                <a href="{{ route('shop') }}">
                                    <span class="qodef-menu-item-text">
                                        Shop
                                        <svg class="qodef-menu-item-arrow" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.76px"
                                            height="11.75px" viewBox="0 0 7.76 11.75"
                                            enable-background="new 0 0 7.76 11.75" xml:space="preserve">
                                            <path fill="#63605A"
                                                d="M1.618,1.341l0.195-0.196l4.621,4.586v0.403l-4.621,4.586l-0.404-0.405l4.383-4.383L1.408,1.55L1.618,1.341z" />
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <li id="menu-item-3068"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3068">
                            <a href="{{route('profile')}}">
                                <span class="qodef-menu-item-text">My Account</span>
                            </a>
                        </li>

                            </ul>
                        </nav>
                    </div>
                    <a itemprop="url" class="qodef-header-logo-link qodef-height--set"
                        href="{{asset('assets/img/new_logo2.png')}}" style="height:92px" rel="home">
                        <img width="150" height="71"
                            src="{{asset('assets/img/new_logo2.png')}}"
                            class="qodef-header-logo-image qodef--main" alt="logo main" itemprop="image" /></a>
                    <div class="qodef-divided-header-right-wrapper">
                        <div class="qodef-widget-holder qodef--one">
                            <div id="swissdelight_core_button-4"
                                class="widget widget_swissdelight_core_button qodef-sticky-right">
                            </div>
                            <div id="swissdelight_membership_login_opener-4"
                                class="widget widget_swissdelight_membership_login_opener qodef-sticky-right">
                                <div class="qodef-login-opener-widget" style="margin: 0px 5px 0px 7px">
                                    <div class="qodef-login-opener-widget" style="margin: 0px 5px 0px 7px">
                                        @if (Auth::guest())
                                            <a href="{{ route('login') }}">
                                                <span class="qodef-login-opener-text">Login</span>
                                                <i class="fas fa-sign-in-alt" style="margin-left: 5px;"></i>
                                            </a>
                                        @else
                                            @if (Auth::user()->role == 'manager')
                                                <a href="{{ route('dashboard') }}">
                                                    <span class="qodef-login-opener-text">Dashboard</span>
                                                    <i class="fas fa-tachometer-alt" style="margin-left: 5px;"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <span class="qodef-login-opener-text">Logout</span>
                                                    <i class="fas fa-sign-out-alt" style="margin-left: 5px;"></i>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div id="swissdelight_core_woo_dropdown_cart-4"
                                class="widget widget_swissdelight_core_woo_dropdown_cart qodef-sticky-right">
                                <div class="qodef-woo-dropdown-cart qodef-m" style="padding: 1px 5px 0px 7px">
                                    <div class="qodef-woo-dropdown-cart-inner qodef-m-inner">
                                        <a itemprop="url" class="qodef-m-opener" href="{{ route('cart.index') }} ">
                                            <span class="qodef-m-opener-label">cart</span>
                                            <span class="qodef-m-opener-count">
                                                {{ $cartCount }} <svg class="qodef-m-svg-icon"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle stroke-miterlimit="10" cx="18.66" cy="18.66"
                                                        r="15.5" />
                                                    <circle stroke-miterlimit="10" cx="18.66" cy="18.66"
                                                        r="15.5" />
                                                </svg> </span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
