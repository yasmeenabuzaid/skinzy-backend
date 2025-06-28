<div id="qodef-page-inner" class="qodef-content-grid">
    <main id="qodef-page-content" class="qodef-grid qodef-layout--template ">
        <div class="qodef-grid-inner clear">
            <div class="qodef-grid-item qodef-page-content-section qodef-col--12">
                <div data-elementor-type="wp-page" data-elementor-id="9011"
                    class="elementor elementor-9011" data-elementor-settings="[]">
                    <div class="elementor-inner">
                        <div class="elementor-section-wrap">
                            <section
                                class="elementor-section elementor-top-section elementor-element elementor-element-9a3179e qodef-elementor-content-grid elementor-reverse-tablet elementor-reverse-mobile elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="9a3179e" data-element_type="section"
                                data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-row">
                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-5889860 qodef-custom-separator-margin"
                                            data-id="5889860" data-element_type="column">
                                            <div
                                                class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                    <div class="elementor-element elementor-element-6242eea elementor-widget elementor-widget-sidebar"
                                                        data-id="6242eea" data-element_type="widget"
                                                        data-widget_type="sidebar.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="widget woocommerce widget_product_search"
                                                                data-area="shop-left-sidebar">
                                                                <form role="search" method="get"
                                                                    class="qodef-search-form qodef-woo-product-search"
                                                                    action="https://swissdelight.qodeinteractive.com/">
                                                                    <label class="screen-reader-text"
                                                                        for="woocommerce-product-search-field-0">Search
                                                                        for:</label>
                                                                    <div
                                                                        class="qodef-search-form-inner clear">
                                                                        <input type="search"
                                                                            id="woocommerce-product-search-field-0"
                                                                            class="qodef-search-form-field"
                                                                            placeholder="Search"
                                                                            value=""
                                                                            name="s" />
                                                                        <button type="submit"
                                                                            class="qodef-search-form-button"><svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                x="0px" y="0px"
                                                                                width="16.116px"
                                                                                height="16.251px"
                                                                                viewBox="0 0 16.116 16.251"
                                                                                enable-background="new 0 0 16.116 16.251"
                                                                                xml:space="preserve">
                                                                                <g>
                                                                                    <path fill="#241C10"
                                                                                        d="M15.952,15.105l-0.943,0.943l-4.635-4.635c-1.122,0.902-2.434,1.354-3.938,1.354 c-1.723,0-3.193-0.608-4.409-1.825C0.811,9.726,0.202,8.256,0.202,6.533s0.608-3.192,1.825-4.409 c1.216-1.216,2.687-1.825,4.409-1.825s3.192,0.609,4.409,1.825c1.216,1.217,1.825,2.687,1.825,4.409 c0,1.477-0.451,2.775-1.354,3.896L15.952,15.105z M2.499,10.512c1.066,1.066,2.379,1.6,3.938,1.6c1.531,0,2.844-0.547,3.938-1.641 c1.093-1.094,1.641-2.406,1.641-3.938c0-1.531-0.547-2.844-1.641-3.938C9.28,1.502,7.968,0.955,6.437,0.955 c-1.532,0-2.844,0.547-3.938,1.641C1.405,3.689,0.858,5.002,0.858,6.533C0.858,8.092,1.405,9.418,2.499,10.512z" />
                                                                                </g>
                                                                            </svg></button>
                                                                    </div>
                                                                    <input type="hidden"
                                                                        name="post_type"
                                                                        value="product" />
                                                                </form>
                                                            </div>
                                                            <div class="widget widget_swissdelight_core_separator"
                                                                data-area="shop-left-sidebar">
                                                                <div
                                                                    class="qodef-shortcode qodef-m  qodef-separator clear ">
                                                                    <div class="qodef-m-line"
                                                                        style="border-bottom-width: 0px;margin-top: 26px">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="widget woocommerce widget_product_categories"
                                                                data-area="shop-left-sidebar">
                                                                <h4 class="qodef-widget-title">Categories
                                                                </h4>
                                                                <ul class="product-categories">
                                                                    @foreach($categories as $category)
                                                                    <li class="cat-item cat-item-{{ $category->id }}">
                                                                        <a href="{{ route('products.byCategory', $category->id) }}">{{ $category->name }}</a>
                                                                    </li>
                                                                @endforeach


                                                                </ul>
                                                            </div>
