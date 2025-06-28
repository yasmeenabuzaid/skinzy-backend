<footer id="qodef-page-footer" class="qodef-skin--none" role="contentinfo">
    <div id="qodef-page-footer-top-area">
        <div id="qodef-page-footer-top-area-inner" class="qodef-content-grid">
            <div
                class="qodef-grid qodef-layout--columns qodef-responsive--custom qodef-col-num--4 qodef-col-num--1024--2 qodef-col-num--768--2 qodef-col-num--680--1 qodef-col-num--480--1">
                <div class="qodef-grid-inner clear">
                    <div class="qodef-grid-item">
                        <div id="custom_html-3" class="widget_text widget widget_custom_html"
                            data-area="qodef-footer-top-area-column-1">
                            <div class="textwidget custom-html-widget"><a
                                href="{{route('home')}}"><img
                                    style="display:inline-block; margin-top:12px"
                                    src="{{asset('assets/img/new_logo2.png')}}"
                                    alt="asd" width="150" height="62" /></a></div>
                        </div>
                        <div id="swissdelight_core_separator-7" class="widget widget_swissdelight_core_separator"
                            data-area="qodef-footer-top-area-column-1">
                            <div class="qodef-shortcode qodef-m  qodef-separator clear ">
                                <div class="qodef-m-line" style="border-bottom-width: 0px;margin-bottom: 40px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="qodef-grid-item">
                        <div id="nav_menu-2" class="widget widget_nav_menu" data-area="qodef-footer-top-area-column-2">
                            <h4 class="qodef-widget-title">Useful Links</h4>
                            <div class="menu-footer-column-2-container">
                                <ul id="menu-footer-column-2" class="menu">
                                    <li id="menu-item-3632"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3632">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li id="menu-item-3633"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3633">
                                        <a href="{{ route('dark') }}">Chocolaterie Dark</a>
                                    </li>
                                    <li id="menu-item-3634"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3634">
                                        <a href="{{ route('light') }}">Chocolaterie Light</a>
                                    </li>
                                    <li id="menu-item-3635"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3635">
                                        <a href="{{ route('shop') }}">Shop</a>
                                    </li>
                                    {{-- <li id="menu-item-3636"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3636">
                                        <a href="{{route('profile')}}">My Account</a>
                                    </li>
                                    <li id="menu-item-3637"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3637">
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
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                        <div id="swissdelight_core_separator-8" class="widget widget_swissdelight_core_separator"
                            data-area="qodef-footer-top-area-column-2">
                            <div class="qodef-shortcode qodef-m  qodef-separator clear ">
                                <div class="qodef-m-line" style="border-bottom-width: 0px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="qodef-grid-item">
                        <div id="nav_menu-2" class="widget widget_nav_menu" data-area="qodef-footer-top-area-column-2">
                            {{-- <h4 class="qodef-widget-title">Useful Links</h4> --}}
                            <div class="menu-footer-column-2-container">
                                <ul id="menu-footer-column-2" class="menu">
                                    {{-- <li id="menu-item-3632"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3632">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li id="menu-item-3633"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3633">
                                        <a href="{{ route('dark') }}">Chocolaterie Dark</a>
                                    </li>
                                    <li id="menu-item-3634"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3634">
                                        <a href="{{ route('light') }}">Chocolaterie Light</a>
                                    </li>
                                    <li id="menu-item-3635"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3635">
                                        <a href="{{ route('shop') }}">Shop</a>
                                    </li> --}}
                                    <li id="menu-item-3636"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3636">
                                        <a href="{{route('profile')}}">My Account</a>
                                    </li>
                                    <li id="menu-item-3637"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3637">
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
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="swissdelight_core_separator-8" class="widget widget_swissdelight_core_separator"
                            data-area="qodef-footer-top-area-column-2">
                            <div class="qodef-shortcode qodef-m  qodef-separator clear ">
                                <div class="qodef-m-line" style="border-bottom-width: 0px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="qodef-grid-item">
                        <div class="widget widget_swissdelight_core_contact_form_7"
                            data-area="footer-top-area-column-4-light">
                            <h4 class="qodef-widget-title">Newsletter</h4>
                            <div class="qodef-contact-form-7">

                                <div class="wpcf7 no-js" id="wpcf7-f3484-o1" lang="en-US" dir="ltr">
                                    <div class="screen-reader-response">
                                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                                        <ul></ul>
                                    </div>
                                    <form action="/chocolaterie-dark/#wpcf7-f3484-o1" method="post"
                                        class="wpcf7-form init demo" aria-label="Contact form" novalidate="novalidate"
                                        data-status="init">
                                        <div style="display: none;">
                                            <input type="hidden" name="_wpcf7" value="3484" />
                                            <input type="hidden" name="_wpcf7_version" value="5.9.6" />
                                            <input type="hidden" name="_wpcf7_locale" value="en_US" />
                                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f3484-o1" />
                                            <input type="hidden" name="_wpcf7_container_post" value="0" />
                                            <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                                        </div>
                                        <p style="margin:0">Subscribe to get special offers, free gifts and
                                            once-in-a-lifetime deals.</p>
                                        <div class="qodef-newsletter">
                                            {{-- <span class="wpcf7-form-control-wrap" data-name="your-email"><input
                                                    size="40" maxlength="80"
                                                    class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter your email" value="" type="email"
                                                    name="your-email" /></span><button
                                                class="wpcf7-form-control wpcf7-submit qodef-button qodef-size--normal qodef-layout--filled qodef-m"
                                                type="submit"><span class="qodef-m-text">Send</span></button> --}}
                                        </div>
                                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <div id="qodef-page-footer-bottom-area">
        <div id="qodef-page-footer-bottom-area-inner" class="qodef-content-grid">
            <div
                class="qodef-grid qodef-layout--columns qodef-responsive--custom qodef-col-num--1 qodef-alignment--center">
                <div class="qodef-grid-inner clear">
                    <div class="qodef-grid-item">
                        <div id="custom_html-2" class="widget_text widget widget_custom_html"
                            data-area="qodef-footer-bottom-area-column-1">
                            <div class="textwidget custom-html-widget"><img
                                    style="display:inline-block; margin-right:11px"
                                    src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/03/footer-img-1.png"
                                    alt="asd" width="34" height="27" /><img
                                    style="display:inline-block; margin-right:11px"
                                    src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/03/footer-img-2.png"
                                    alt="asd" width="42" height="27" /><img
                                    style="display:inline-block; margin-right:11px"
                                    src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/03/footer-img-3.png"
                                    alt="asd" width="42" height="27" /><img
                                    style="display:inline-block; margin-right:11px"
                                    src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/03/footer-img-4.png"
                                    alt="asd" width="42" height="27" /><img
                                    style="display:inline-block; margin-right:11px"
                                    src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/03/footer-img-5.png"
                                    alt="asd" width="42" height="27" /><img
                                    style="display:inline-block"
                                    src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/03/footer-img-6.png"
                                    alt="asd" width="34" height="27" /></div>
                        </div>
                        <div id="text-5" class="widget widget_text"
                            data-area="qodef-footer-bottom-area-column-1">
                            <div class="textwidget">
                                © 2025 | Developed by
                                <a href="https://www.a-tech.dev/" target="_blank" rel="noopener noreferrer" style="color: #007bff; text-decoration: none;">
                                    A-tech
                                </a>. All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a id="qodef-back-to-top" href="#" class="qodef--predefined">
    <span class="qodef-back-to-top-line"></span>
    <span class="qodef-back-to-top-text">Top</span>
</a>
<div id="qodef-side-area">
    <a href="javascript:void(0)" id="qodef-side-area-close"
        class="qodef-opener-icon qodef-m qodef-source--svg-path">
        <span class="qodef-m-icon qodef--open">
            <svg class="qodef-side-area--svg-close" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="17.209px" height="17.006px"
                viewBox="0 0 17.209 17.006" enable-background="new 0 0 17.209 17.006" xml:space="preserve">
                <line fill="none" stroke="#241C10" stroke-miterlimit="10" x1="16.539" y1="16.241"
                    x2="1.092" y2="0.795" />
                <line fill="none" stroke="#241C10" stroke-miterlimit="10" x1="1.092" y1="16.241"
                    x2="16.539" y2="0.795" />
            </svg>
        </span>
    </a>
    <div id="qodef-side-area-inner">
        <div id="custom_html-6" class="widget_text widget widget_custom_html" data-area="side-area">
            <div class="textwidget custom-html-widget"><a href="https://swissdelight.qodeinteractive.com/"><img
                        style="display:inline-block"
                        src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/04/logo-side-area.png"

                        alt="asd" width="150" height="62" /></a></div>
        </div>
        {{-- -------------------------------------- --}}
        <div id="text-9" class="widget widget_text" data-area="side-area">
            <div class="textwidget">
                <p style="margin-bottom: -7px;"><a class="qodef-custom-side-area-link"
                        href="https://www.google.com/maps/place/11+Boulevard+Montmartre,+75002+Paris,+France/@48.8715144,2.3397153,17z/data=!3m1!4b1!4m5!3m4!1s0x47e66e3e9dcfbb4b:0x2e1abb8593859a8c!8m2!3d48.8715109!4d2.341904"
                        target="_blank" rel="noopener">11 Boulevard Montmartre, 75002 Paris, France</a></p>
                <p><a class="qodef-custom-side-area-link" href="tel:+336921548654">+33 69 21 548 654</a>, <a
                        class="qodef-custom-side-area-link" href="tel:+36985695496">+369 856 954 96</a></p>
                <p style="margin-bottom: -2px;"><a class="qodef-custom-side-area-link"
                        href="/cdn-cgi/l/email-protection#7d0e0a140e0e191811141a15093d0c121918141309180f1c1e09140b18531e1210"><span
                            class="__cf_email__"
                            data-cfemail="b3c0c4dac0c0d7d6dfdad4dbc7f3c2dcd7d6daddc7d6c1d2d0c7dac5d69dd0dcde">[email&#160;protected]</span></a>
                </p>
            </div>
        </div>
        <div id="swissdelight_core_social_icons_group-6" class="widget widget_swissdelight_core_social_icons_group"
            data-area="side-area">
            <h6 class="qodef-widget-title">Follow Us</h6>
            <div class="qodef-social-icons-group">
                <span class="qodef-shortcode qodef-m  qodef-icon-holder  qodef-layout--normal"
                    data-hover-color="#000000" style="margin: 0px 18px 0px 0px">
                    <a itemprop="url" href="https://www.facebook.com/QodeInteractive/" target="_blank">
                        <span class="qodef-icon-ionicons ion-logo-facebook qodef-icon qodef-e"
                            style="font-size: 17px"></span> </a>
                </span>
                <span class="qodef-shortcode qodef-m  qodef-icon-holder  qodef-layout--normal"
                    data-hover-color="#000000" style="margin: 0px 18px 0px 0px">
                    <a itemprop="url" href="https://twitter.com/QodeInteractive/" target="_blank">
                        <span class="qodef-icon-ionicons ion-logo-twitter qodef-icon qodef-e"
                            style="font-size: 17px"></span> </a>
                </span>
                <span class="qodef-shortcode qodef-m  qodef-icon-holder  qodef-layout--normal"
                    data-hover-color="#000000" style="margin: 0px 18px 0px 0px">
                    <a itemprop="url" href="https://www.pinterest.com/qodeinteractive/" target="_blank">
                        <span class="qodef-icon-ionicons ion-logo-pinterest qodef-icon qodef-e"
                            style="font-size: 17px"></span> </a>
                </span>
                <span class="qodef-shortcode qodef-m  qodef-icon-holder  qodef-layout--normal"
                    data-hover-color="#000000" style="margin: 0px 18px 0px 0px">
                    <a itemprop="url" href="https://www.youtube.com/QodeInteractiveVideos" target="_blank">
                        <span class="qodef-icon-ionicons ion-logo-youtube qodef-icon qodef-e"
                            style="font-size: 17px"></span> </a>
                </span>
                <span class="qodef-shortcode qodef-m  qodef-icon-holder  qodef-layout--normal"
                    data-hover-color="#000000">
                    <a itemprop="url" href="https://www.instagram.com/qodeinteractive/" target="_blank">
                        <span class="qodef-icon-ionicons ion-logo-instagram qodef-icon qodef-e"
                            style="font-size: 17px"></span> </a>
                </span>
            </div>
        </div>
        <div id="media_image-3" class="widget widget_media_image" data-area="side-area"><a
                href="https://swissdelight.qodeinteractive.com/shop"><img width="322" height="253"
                    src="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/02/side-area-img-706x555.jpg"
                    class="image wp-image-5706  attachment-322x253 size-322x253" alt="d"
                    style="max-width: 100%; height: auto;" decoding="async" loading="lazy"
                    srcset="https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/02/side-area-img-706x555.jpg 706w, https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/02/side-area-img-300x236.jpg 300w, https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/02/side-area-img-768x604.jpg 768w, https://swissdelight.qodeinteractive.com/wp-content/uploads/2021/02/side-area-img.jpg 800w"
                    sizes="auto, (max-width: 322px) 100vw, 322px" /></a></div>
    </div>
</div>
<div id="qodef-membership-login-modal">
    <div class="qodef-membership-login-modal-overlay"></div>
    <div class="qodef-membership-login-modal-content">
        <ul class="qodef-membership-login-modal-navigation qodef-m">
            <li class="qodef-m-navigation-item qodef-e qodef--login">
                <a class="qodef-e-link" href="#qodef-membership-login-modal-part">
                    <span class="qodef-e-label">Login</span>
                </a>
            </li>
            <li class="qodef-m-navigation-item qodef-e qodef--register">
                <a class="qodef-e-link" href="#qodef-membership-register-modal-part">
                    <span class="qodef-e-label">Register</span>
                </a>
            </li>
            <li class="qodef-m-navigation-item qodef-e qodef--reset-password">
                <a class="qodef-e-link" href="#qodef-membership-reset-password-modal-part">
                    <span class="qodef-e-label">Reset Password</span>
                </a>
            </li>
        </ul>
        <form id="qodef-membership-login-modal-part" class="qodef-m" method="GET">
            <div class="qodef-m-fields">
                <input type="text" class="qodef-m-user-name" name="user_name" placeholder="Username"
                    value="" required pattern=".{3,}" autocomplete="username" />
                <input type="password" class="qodef-m-user-password" name="user_password" placeholder="Password"
                    required autocomplete="current-password" />
            </div>
            <div class="qodef-m-links">
                <div class="qodef-m-links-remember-me">
                    <input type="checkbox" id="qodef-m-links-remember" class="qodef-m-links-remember"
                        name="remember" value="forever" />
                    <label for="qodef-m-links-remember" class="qodef-m-links-remember-label">Remember me</label>
                </div>
            </div>
            <div class="qodef-m-action">
                <a class="qodef-shortcode qodef-m qodef-m-links-reset-password qodef-button qodef-layout--textual  qodef-html--link  "
                    href="#" target="_self"> <span class="qodef-m-text">Lost Your password? </span></a>
                <button type="submit"
                    class="qodef-shortcode qodef-m qodef-m-action-button qodef-button qodef-layout--outlined    ">
                    <span class="qodef-m-border--top-left"></span> <span
                        class="qodef-m-border--bottom-right"></span> <span class="qodef-btn-text">Login
                    </span></button><span
                    class="qodef-shortcode qodef-m qodef-m-action-spinner fa-spin qodef-icon-holder  qodef-layout--normal">
                    <span class="qodef-icon-font-awesome fa fa-spinner qodef-icon qodef-e" style=""></span>
                </span>
            </div>
            <div class="qodef-m-response"></div> <input type="hidden" class="qodef-m-request-type"
                name="request_type" value="login" />
            <input type="hidden" class="qodef-m-redirect" name="redirect"
                value="https://swissdelight.qodeinteractive.com/user-dashboard/" />
            <input type="hidden" id="swissdelight-membership-ajax-login-nonce"
                name="swissdelight-membership-ajax-login-nonce" value="71867c73e5" /><input type="hidden"
                name="_wp_http_referer" value="/" />
        </form>
        <form id="qodef-membership-register-modal-part" class="qodef-m" method="POST">
            <div class="qodef-m-fields">
                <input type="text" class="qodef-m-user-name" name="user_name" placeholder="Username"
                    value="" required pattern=".{3,}" autocomplete="username" />
                <input type="email" class="qodef-m-user-email" name="user_email" placeholder="Email"
                    value="" required autocomplete="email" />
                <input type="password" class="qodef-m-user-password" name="user_password" placeholder="Password"
                    required pattern=".{5,}" autocomplete="new-password" />
                <input type="password" class="qodef-m-user-confirm-password" name="user_confirm_password"
                    placeholder="Repeat Password" required pattern=".{5,}" autocomplete="new-password" />
            </div>

            <div class="qodef-m-action">
                <button type="submit"
                    class="qodef-shortcode qodef-m qodef-m-action-button qodef-button qodef-layout--outlined    ">
                    <span class="qodef-m-border--top-left"></span> <span
                        class="qodef-m-border--bottom-right"></span> <span class="qodef-btn-text">Register
                    </span></button><span
                    class="qodef-shortcode qodef-m qodef-m-action-spinner fa-spin qodef-icon-holder  qodef-layout--normal">
                    <span class="qodef-icon-font-awesome fa fa-spinner qodef-icon qodef-e" style=""></span>
                </span>
            </div>
            <div class="qodef-m-response"></div> <input type="hidden" class="qodef-m-request-type"
                name="request_type" value="register" />
            <input type="hidden" class="qodef-m-redirect" name="redirect"
                value="https://swissdelight.qodeinteractive.com/user-dashboard/" />
            <input type="hidden" id="swissdelight-membership-ajax-register-nonce"
                name="swissdelight-membership-ajax-register-nonce" value="11f19a2a92" /><input type="hidden"
                name="_wp_http_referer" value="/" />
        </form>
        <form id="qodef-membership-reset-password-modal-part" class="qodef-m" method="POST">
            <div class="qodef-m-fields">
                <label>Lost your password? Please enter your username or email address. You will receive a link to
                    create a new password via email.</label>
                <input type="text" class="qodef-m-user-login" name="user_login"
                    placeholder="Username or email" value="" required />
            </div>
            <div class="qodef-m-action">
                <button type="submit"
                    class="qodef-shortcode qodef-m qodef-m-action-button qodef-button qodef-layout--outlined    ">
                    <span class="qodef-m-border--top-left"></span> <span
                        class="qodef-m-border--bottom-right"></span> <span class="qodef-btn-text">Reset Password
                    </span></button><span
                    class="qodef-shortcode qodef-m qodef-m-action-spinner fa-spin qodef-icon-holder  qodef-layout--normal">
                    <span class="qodef-icon-font-awesome fa fa-spinner qodef-icon qodef-e" style=""></span>
                </span>
            </div>
            <div class="qodef-m-response"></div> <input type="hidden" class="qodef-m-request-type"
                name="request_type" value="reset-password" />
            <input type="hidden" class="qodef-m-redirect" name="redirect"
                value="https://swissdelight.qodeinteractive.com/user-dashboard/" />
            <input type="hidden" id="swissdelight-membership-ajax-reset-password-nonce"
                name="swissdelight-membership-ajax-reset-password-nonce" value="bdc50b5ff0" /><input
                type="hidden" name="_wp_http_referer" value="/" />
        </form>
    </div>
</div>
</div><!-- close #qodef-page-wrapper div from header.php -->
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script type="speculationrules">
{"prefetch":[{"source":"document","where":{"and":[{"href_matches":"\/*"},{"not":{"href_matches":["\/wp-*.php","\/wp-admin\/*","\/wp-content\/uploads\/*","\/wp-content\/*","\/wp-content\/plugins\/*","\/wp-content\/themes\/swissdelight\/*","\/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
</script>
<div class="rbt-toolbar" data-theme="Swiss Delight" data-featured="" data-button-position="70%"
    data-button-horizontal="right" data-button-alt="no"></div>
<!-- GTM Container placement set to footer -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KLJLSX7" height="0" width="0"
        style="display:none;visibility:hidden" aria-hidden="true"></iframe></noscript>
<!-- End Google Tag Manager (noscript) --><!-- Instagram Feed JS -->
<script type="text/javascript">
    var sbiajaxurl = "https://swissdelight.qodeinteractive.com/wp-admin/admin-ajax.php";
</script>
<link href="https://fonts.googleapis.com/css?family=Cormorant:300%7CHeebo:400%7CRoboto:400" rel="stylesheet"
    property="stylesheet" media="all" type="text/css">

<script type="text/javascript">
    (function() {
        var c = document.body.className;
        c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
        document.body.className = c;
    })();
</script>
<script type="text/javascript">
    if (typeof revslider_showDoubleJqueryError === "undefined") {
        function revslider_showDoubleJqueryError(sliderID) {
            var err = "<div class='rs_error_message_box'>";
            err += "<div class='rs_error_message_oops'>Oops...</div>";
            err += "<div class='rs_error_message_content'>";
            err +=
                "You have some jquery.js library include that comes after the Slider Revolution files js inclusion.<br>";
            err +=
                "To fix this, you can:<br>&nbsp;&nbsp;&nbsp; 1. Set 'Module General Options' -> 'Advanced' -> 'jQuery & OutPut Filters' -> 'Put JS to Body' to on";
            err += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jQuery.js inclusion and remove it";
            err += "</div>";
            err += "</div>";
            var slider = document.getElementById(sliderID);
            slider.innerHTML = err;
            slider.style.display = "block";
        }
    }
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.selectBox.min.js?ver=1.2.0"
    id="jquery-selectBox-js"></script>
<script type="text/javascript" id="jquery-yith-wcwl-js-extra">
    /* <![CDATA[ */
    var yith_wcwl_l10n = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "redirect_to_cart": "no",
        "multi_wishlist": "",
        "hide_add_button": "1",
        "enable_ajax_loading": "",
        "ajax_loader_url": "https:\/\/swissdelight.qodeinteractive.com\/wp-content\/plugins\/yith-woocommerce-wishlist\/assets\/images\/ajax-loader-alt.svg",
        "remove_from_wishlist_after_add_to_cart": "1",
        "is_wishlist_responsive": "",
        "time_to_close_prettyphoto": "3000",
        "fragments_index_glue": ".",
        "reload_on_found_variation": "1",
        "mobile_media_query": "768",
        "labels": {
            "cookie_disabled": "We are sorry, but this feature is available only if cookies on your browser are enabled.",
            "added_to_cart_message": "<div class=\"woocommerce-notices-wrapper\"><div class=\"woocommerce-message\" role=\"alert\">Product added to cart successfully<\/div><\/div>"
        },
        "actions": {
            "add_to_wishlist_action": "add_to_wishlist",
            "remove_from_wishlist_action": "remove_from_wishlist",
            "reload_wishlist_and_adding_elem_action": "reload_wishlist_and_adding_elem",
            "load_mobile_action": "load_mobile",
            "delete_item_action": "delete_item",
            "save_title_action": "save_title",
            "save_privacy_action": "save_privacy",
            "load_fragments": "load_fragments"
        }
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl.min.js?ver=3.0.20"
    id="jquery-yith-wcwl-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/contact-form-7/includes/swv/js/index.js?ver=5.9.6"
    id="swv-js"></script>
<script type="text/javascript" id="contact-form-7-js-extra">
    /* <![CDATA[ */
    var wpcf7 = {
        "api": {
            "root": "https:\/\/swissdelight.qodeinteractive.com\/wp-json\/",
            "namespace": "contact-form-7\/v1"
        }
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/contact-form-7/includes/js/index.js?ver=5.9.6"
    id="contact-form-7-js"></script>
<script type="text/javascript" src="https://export.qodethemes.com/_toolbar/assets/js/rbt-modules.js?ver=6.8"
    id="rabbit_js-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70"
    id="jquery-blockui-js"></script>
<script type="text/javascript" id="wc-add-to-cart-js-extra">
    /* <![CDATA[ */
    var wc_add_to_cart_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
        "i18n_view_cart": "View cart",
        "cart_url": "https:\/\/swissdelight.qodeinteractive.com\/cart\/",
        "is_cart": "",
        "cart_redirect_after_add": "no"
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=5.5.4"
    id="wc-add-to-cart-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4"
    id="js-cookie-js"></script>
<script type="text/javascript" id="woocommerce-js-extra">
    /* <![CDATA[ */
    var woocommerce_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=5.5.4"
    id="woocommerce-js"></script>
<script type="text/javascript" id="wc-cart-fragments-js-extra">
    /* <![CDATA[ */
    var wc_cart_fragments_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
        "cart_hash_key": "wc_cart_hash_1dca87b5ff44e1087e628546c083f63b",
        "fragment_name": "wc_fragments_1dca87b5ff44e1087e628546c083f63b",
        "request_timeout": "5000"
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=5.5.4"
    id="wc-cart-fragments-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3"
    id="jquery-ui-core-js"></script>
<script type="text/javascript" id="qi-addons-for-elementor-script-js-extra">
    /* <![CDATA[ */
    var qodefQiAddonsGlobal = {
        "vars": {
            "adminBarHeight": 0,
            "iconArrowLeft": "<svg  xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 34.2 32.3\" xml:space=\"preserve\" style=\"stroke-width: 2;\"><line x1=\"0.5\" y1=\"16\" x2=\"33.5\" y2=\"16\"\/><line x1=\"0.3\" y1=\"16.5\" x2=\"16.2\" y2=\"0.7\"\/><line x1=\"0\" y1=\"15.4\" x2=\"16.2\" y2=\"31.6\"\/><\/svg>",
            "iconArrowRight": "<svg  xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 34.2 32.3\" xml:space=\"preserve\" style=\"stroke-width: 2;\"><line x1=\"0\" y1=\"16\" x2=\"33\" y2=\"16\"\/><line x1=\"17.3\" y1=\"0.7\" x2=\"33.2\" y2=\"16.5\"\/><line x1=\"17.3\" y1=\"31.6\" x2=\"33.5\" y2=\"15.4\"\/><\/svg>",
            "iconClose": "<svg  xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 9.1 9.1\" xml:space=\"preserve\"><g><path d=\"M8.5,0L9,0.6L5.1,4.5L9,8.5L8.5,9L4.5,5.1L0.6,9L0,8.5L4,4.5L0,0.6L0.6,0L4.5,4L8.5,0z\"\/><\/g><\/svg>"
        }
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/qi-addons-for-elementor/assets/js/main.min.js?ver=6.8"
    id="qi-addons-for-elementor-script-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js?ver=6.8"
    id="perfect-scrollbar-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-includes/js/hoverIntent.min.js?ver=1.10.2" id="hoverIntent-js">
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/assets/plugins/jquery/jquery.easing.1.3.js?ver=6.8"
    id="jquery-easing-1.3-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/assets/plugins/jquery/jquery-ui.min.js?ver=6.8"
    id="jquery-ui-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/assets/plugins/modernizr/modernizr.js?ver=6.8"
    id="modernizr-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/assets/plugins/gsap/gsap.min.js?ver=6.8"
    id="gsap-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/qi-addons-for-elementor/inc/shortcodes/parallax-images/assets/js/plugins/jquery.parallax-scroll.js?ver=1"
    id="parallax-scroll-js"></script>
<script type="text/javascript" id="swissdelight-main-js-js-extra">
    /* <![CDATA[ */
    var qodefGlobal = {
        "vars": {
            "adminBarHeight": 0,
            "iconArrowLeft": "<svg  xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\" x=\"0px\" y=\"0px\" width=\"42.25px\" height=\"93.625px\" viewBox=\"0 0 42.25 93.625\" enable-background=\"new 0 0 42.25 93.625\" xml:space=\"preserve\"><line fill=\"none\" stroke=\"#241C10\" stroke-miterlimit=\"10\" x1=\"40.483\" y1=\"1.42\" x2=\"1.267\" y2=\"46.83\"\/><line fill=\"none\" stroke=\"#241C10\" stroke-miterlimit=\"10\" x1=\"40.483\" y1=\"91.91\" x2=\"1.267\" y2=\"46.5\"\/><\/svg>",
            "iconArrowRight": "<svg  xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\" x=\"0px\" y=\"0px\" width=\"42.25px\" height=\"93.625px\" viewBox=\"0 0 42.25 93.625\" enable-background=\"new 0 0 42.25 93.625\" xml:space=\"preserve\"><line fill=\"none\" stroke=\"#241C10\" stroke-miterlimit=\"10\" x1=\"1.267\" y1=\"1.42\" x2=\"40.483\" y2=\"46.83\"\/><line fill=\"none\" stroke=\"#241C10\" stroke-miterlimit=\"10\" x1=\"1.267\" y1=\"91.91\" x2=\"40.483\" y2=\"46.5\"\/><\/svg>",
            "iconClose": "<svg  xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\" width=\"32\" height=\"32\" viewBox=\"0 0 32 32\"><g><path d=\"M 10.050,23.95c 0.39,0.39, 1.024,0.39, 1.414,0L 17,18.414l 5.536,5.536c 0.39,0.39, 1.024,0.39, 1.414,0 c 0.39-0.39, 0.39-1.024,0-1.414L 18.414,17l 5.536-5.536c 0.39-0.39, 0.39-1.024,0-1.414c-0.39-0.39-1.024-0.39-1.414,0 L 17,15.586L 11.464,10.050c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 15.586,17l-5.536,5.536 C 9.66,22.926, 9.66,23.56, 10.050,23.95z\"><\/path><\/g><\/svg>",
            "qodefStickyHeaderScrollAmount": 980,
            "topAreaHeight": 0,
            "restUrl": "https:\/\/swissdelight.qodeinteractive.com\/wp-json\/",
            "restNonce": "da4b651bef",
            "loginModalRestRoute": "swissdelight\/v1\/login-modal",
            "loginModalGetRestRoute": "swissdelight\/v1\/login-modal-get",
            "paginationRestRoute": "swissdelight\/v1\/get-posts",
            "headerHeight": 125,
            "mobileHeaderHeight": 70
        }
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/themes/swissdelight/assets/js/main.min.js?ver=6.8"
    id="swissdelight-main-js-js"></script>
<script type="text/javascript"
    src="//maps.googleapis.com/maps/api/js?key=AIzaSyADW1b2n1VcDKq-pDnbJoj9uMraAMgFsTw&amp;ver=6.8"
    id="google-map-api-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-includes/js/underscore.min.js?ver=1.13.7" id="underscore-js">
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/inc/maps/assets/js/custom-marker.js?ver=6.8"
    id="swissdelight-core-map-custom-marker-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/inc/maps/assets/js/markerclusterer.js?ver=6.8"
    id="markerclusterer-js"></script>
<script type="text/javascript" id="swissdelight-core-google-map-js-extra">
    /* <![CDATA[ */
    var qodefMapsVariables = {
        "global": {
            "mapStyle": [{
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#e9e9e9"
                }, {
                    "lightness": 17
                }]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#f5f5f5"
                }, {
                    "lightness": 20
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 17
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 29
                }, {
                    "weight": 0.200000000000000011102230246251565404236316680908203125
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 18
                }]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 16
                }]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#f5f5f5"
                }, {
                    "lightness": 21
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#dedede"
                }, {
                    "lightness": 21
                }]
            }, {
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "color": "#ffffff"
                }, {
                    "lightness": 16
                }]
            }, {
                "elementType": "labels.text.fill",
                "stylers": [{
                    "saturation": 36
                }, {
                    "color": "#333333"
                }, {
                    "lightness": 40
                }]
            }, {
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#f2f2f2"
                }, {
                    "lightness": 19
                }]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#fefefe"
                }, {
                    "lightness": 20
                }]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#fefefe"
                }, {
                    "lightness": 17
                }, {
                    "weight": 1.1999999999999999555910790149937383830547332763671875
                }]
            }],
            "mapZoom": "11",
            "mapScrollable": false,
            "mapDraggable": true,
            "streetViewControl": true,
            "zoomControl": true,
            "mapTypeControl": true,
            "fullscreenControl": true,
            "geolocationTitle": "Your location is here"
        },
        "multiple": []
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/inc/maps/assets/js/google-map.js?ver=6.8"
    id="swissdelight-core-google-map-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/assets/js/swissdelight-core.min.js?ver=6.8"
    id="swissdelight-core-script-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-includes/js/jquery/ui/tabs.min.js?ver=1.13.3"
    id="jquery-ui-tabs-js"></script>
<script type="text/javascript" id="swissdelight-membership-script-js-extra">
    /* <![CDATA[ */
    var swissdelightMembershipGlobal = [];
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-membership/assets/js/swissdelight-membership.min.js?ver=6.8"
    id="swissdelight-membership-script-js"></script>
<script type="text/javascript"
    src="//swissdelight.qodeinteractive.com/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min.js?ver=3.1.6"
    id="prettyPhoto-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/themes/swissdelight/assets/plugins/waitforimages/jquery.waitforimages.js?ver=6.8"
    id="jquery-waitforimages-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/themes/swissdelight/assets/plugins/appear/jquery.appear.js?ver=6.8"
    id="jquery-appear-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/lib/swiper/swiper.min.js?ver=5.3.6"
    id="swiper-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/themes/swissdelight/assets/plugins/magnific-popup/jquery.magnific-popup.min.js?ver=6.8"
    id="jquery-magnific-popup-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/woocommerce/assets/js/select2/select2.full.min.js?ver=4.0.3"
    id="select2-js"></script>
<script type="text/javascript"
    src="https://static.zdassets.com/ekr/snippet.js?key=af3078fd-a5ae-40da-bee0-e589b98c8603&ver=6.8" id="ze-snippet">
</script>
<script type="text/javascript">
    zE(function() {
        $zopim(function() {
            var isChatEnabled = sessionStorage.getItem("qodeChatEnabled"),
                appearingTime = 15000;

            if (isChatEnabled !== "no") {
                setTimeout(function() {
                    $zopim.livechat.window.show();

                    $zopim.livechat.window.onHide(function() {
                        sessionStorage.setItem("qodeChatEnabled", "no");
                    });
                }, appearingTime);
            }
        });
    });
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/themes/swissdelight/inc/justified-gallery/assets/js/plugins/jquery.justifiedGallery.min.js?ver=1"
    id="jquery-justified-gallery-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/qi-addons-for-elementor/inc/masonry/assets/js/plugins/isotope.pkgd.min.js?ver=6.8"
    id="isotope-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/qi-addons-for-elementor/inc/masonry/assets/js/plugins/packery-mode.pkgd.min.js?ver=6.8"
    id="packery-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.1.4"
    id="elementor-webpack-runtime-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.1.4"
    id="elementor-frontend-modules-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/lib/dialog/dialog.min.js?ver=4.8.1"
    id="elementor-dialog-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2"
    id="elementor-waypoints-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/lib/share-link/share-link.min.js?ver=3.1.4"
    id="share-link-js"></script>
<script type="text/javascript" id="elementor-frontend-js-before">
    /* <![CDATA[ */
    var elementorFrontendConfig = {
        "environmentMode": {
            "edit": false,
            "wpPreview": false,
            "isScriptDebug": false,
            "isImprovedAssetsLoading": false
        },
        "i18n": {
            "shareOnFacebook": "Share on Facebook",
            "shareOnTwitter": "Share on Twitter",
            "pinIt": "Pin it",
            "download": "Download",
            "downloadImage": "Download image",
            "fullscreen": "Fullscreen",
            "zoom": "Zoom",
            "share": "Share",
            "playVideo": "Play Video",
            "previous": "Previous",
            "next": "Next",
            "close": "Close"
        },
        "is_rtl": false,
        "breakpoints": {
            "xs": 0,
            "sm": 480,
            "md": 768,
            "lg": 1025,
            "xl": 1440,
            "xxl": 1600
        },
        "version": "3.1.4",
        "is_static": false,
        "experimentalFeatures": [],
        "urls": {
            "assets": "https:\/\/swissdelight.qodeinteractive.com\/wp-content\/plugins\/elementor\/assets\/"
        },
        "settings": {
            "page": [],
            "editorPreferences": []
        },
        "kit": {
            "lightbox_enable_counter": "yes",
            "lightbox_enable_fullscreen": "yes",
            "lightbox_enable_zoom": "yes",
            "lightbox_enable_share": "yes",
            "lightbox_title_src": "title",
            "lightbox_description_src": "description"
        },
        "post": {
            "id": 60,
            "title": "Swiss%20Delight%20%E2%80%93%20Chocolate%20%26%20Cake%20Shop%20Theme",
            "excerpt": "",
            "featuredImage": false
        }
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.1.4"
    id="elementor-frontend-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/qi-addons-for-elementor/inc/plugins/elementor/assets/js/elementor.js?ver=6.8"
    id="qi-addons-for-elementor-elementor-js"></script>
<script type="text/javascript" id="swissdelight-core-elementor-js-extra">
    /* <![CDATA[ */
    var qodefElementorGlobal = {
        "vars": {
            "elementorSectionHandler": {
                "627911e": [{
                    "offset_type": "offset",
                    "offset_image": {
                        "url": "https:\/\/swissdelight.qodeinteractive.com\/wp-content\/uploads\/2021\/04\/h1-offset-image.png",
                        "id": 9779
                    },
                    "offset_top": "63%",
                    "offset_left": "90%",
                    "offset_appear": "yes",
                    "offset_direction": "right",
                    "offset_float": "yes"
                }],
                "517a9cd": [{
                    "parallax_type": "parallax",
                    "parallax_image": {
                        "url": "https:\/\/swissdelight.qodeinteractive.com\/wp-content\/uploads\/2021\/03\/main-home-video-button.jpg",
                        "id": 9219
                    }
                }]
            }
        }
    };
    /* ]]> */
</script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/swissdelight-core/inc/plugins/elementor/assets/js/elementor.js?ver=6.8"
    id="swissdelight-core-elementor-js"></script>
<script type="text/javascript"
    src="https://swissdelight.qodeinteractive.com/wp-content/plugins/elementor/assets/js/preloaded-elements-handlers.min.js?ver=3.1.4"
    id="preloaded-elements-handlers-js"></script>
</body>

</html>
