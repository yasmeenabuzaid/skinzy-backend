<div class="qodef-description--fullscreen">
    <div class="woocommerce-tabs wc-tabs-wrapper">
        <ul class="tabs wc-tabs" role="tablist">
            <li class="description_tab" id="tab-title-description" role="tab"
                aria-controls="tab-description">
                <a href="#tab-description">
                    Description </a>
            </li>
            <li class="additional_information_tab"
                id="tab-title-additional_information" role="tab"
                aria-controls="tab-additional_information">
                <a href="#tab-additional_information">
                    Physical data </a>
            </li>
            <li class="reviews_tab" id="tab-title-reviews" role="tab"
                aria-controls="tab-reviews">
                <a href="#tab-reviews">
                    Reviews ({{ $totalFeedbacks }}) </a>
            </li>
        </ul>
        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab"
            id="tab-description" role="tabpanel"
            aria-labelledby="tab-title-description">

            <h2>Description</h2>

            <div data-elementor-type="wp-post" data-elementor-id="4075"
                class="elementor elementor-4075" data-elementor-settings="[]">
                <div class="elementor-inner">
                    <div class="elementor-section-wrap">
                        <section
                            class="elementor-section elementor-top-section elementor-element elementor-element-6e0d895 qodef-elementor-content-grid elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                            data-id="6e0d895" data-element_type="section">
                            <div
                                class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7108bbd"
                                        data-id="7108bbd"
                                        data-element_type="column">
                                        <div
                                            class="elementor-column-wrap elementor-element-populated">
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-element-a96ec36 elementor-widget elementor-widget-text-editor"
                                                    data-id="a96ec36"
                                                    data-element_type="widget"
                                                    data-widget_type="text-editor.default">
                                                    <div
                                                        class="elementor-widget-container">
                                                        <div
                                                            class="elementor-text-editor elementor-clearfix">
                                                            <p>{{ $product->description }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--additional_information panel entry-content wc-tab"
            id="tab-additional_information" role="tabpanel"
            aria-labelledby="tab-title-additional_information">

            <h2>Additional information</h2>

            <table class="woocommerce-product-attributes shop_attributes">
                <tr
                    class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_box-weight">
                    <th class="woocommerce-product-attributes-item__label">Box Weight:
                    </th>
                    <td class="woocommerce-product-attributes-item__value">
                        <p>{{$product_details->weight?? "no details"}}</p>
                    </td>
                </tr>
                <tr
                    class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_box-dimension">
                    <th class="woocommerce-product-attributes-item__label">Box
                        ingredients:</th>
                    <td class="woocommerce-product-attributes-item__value">
                        <p>{{$product_details->ingredients?? "no details"}}</p>
                    </td>
                </tr>
                <tr
                    class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_weight-per-piece">
                    <th class="woocommerce-product-attributes-item__label">Weight per
                        allergens:</th>
                    <td class="woocommerce-product-attributes-item__value">
                        <p>{{$product_details->ingredients ?? "no details"}}</p>
                    </td>
                </tr>
                <tr
                    class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_piece-dimension">
                    <th class="woocommerce-product-attributes-item__label">Piece
                        origin country:</th>
                    <td class="woocommerce-product-attributes-item__value">
                        <p>{{$product_details->ingredients?? "no details"}}</p>
                    </td>
                </tr>
                {{-- <tr
                    class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_piece-dimension">
                    <th class="woocommerce-product-attributes-item__label">Piece
                        organic:</th>
                    <td class="woocommerce-product-attributes-item__value">
                        <p>{{$product_details->is_organic?? "no details"}}</p>
                    </td>
                </tr> --}}
            </table>
        </div>
        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews panel entry-content wc-tab"
            id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
            <div id="reviews" class="woocommerce-Reviews">
                <div id="comments">
                    <h2 class="woocommerce-Reviews-title">
                        {{ $totalFeedbacks }} review for <span>{{ $product->name }}</span> </h2>

                    <ol class="commentlist">
                        @foreach($feedbacks as $feedback)

                        <li class="review even thread-even depth-1"
                            id="li-comment-33">

                            <div id="comment-33" class="comment_container">

                                <img src="/images/profile.jpg"
                                width="25" height="25" alt="image not found"
                                style="width: 80px ; hight:80px" />

                                <div class="comment-text">

                                    <div class="qodef-woo-ratings qodef-m">
                                        <div class="qodef-m-inner">
                                            <div class="qodef-m-star qodef--initial">
                                           @php
                                        $rating = $feedback->rating;
                                        $fullStars = floor($rating);
                                        $halfStar = ($rating - $fullStars) >= 0.5 ? true : false;
                                    @endphp

                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="bi bi-star-fill" style="color: gold;"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="bi bi-star-half" style="color: gold;"></i>
                                    @endif

                                    @for ($i = 0; $i < (5 - ceil($rating)); $i++)
                                        <i class="bi bi-star" style="color: gold;"></i>
                                    @endfor
                                    </div>
                                    <p class="meta">
                                        <strong
                                            class="woocommerce-review__author">{{ optional($feedback->user)->Fname }} {{ optional($feedback->user)->Lname }} </strong>
                                        <span
                                            class="woocommerce-review__dash">&ndash;</span>
                                        <time
                                            class="woocommerce-review__published-date"
                                            datetime="2021-03-19T10:22:45+00:00">{{ optional($feedback->created_at)->format('Y-m-d') ?? '' }}</time>
                                    </p>

                                    <div class="description">
                                        <p>{{ $feedback->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </ol>

                </div>

                <div id="review_form_wrapper">
                    <div id="review_form">
                        <div id="respond" class="comment-respond">
                            <h4 id="reply-title" class="comment-reply-title">Add a
                                review <small><a rel="nofollow"
                                        id="cancel-comment-reply-link"
                                        href="/product/mimosa/#respond"
                                        style="display:none;">Cancel reply</a></small>
                            </h4>
                            <form action="{{ route('feedback.store') }}" method="post" id="commentform" class="qodef-comment-form">
                                @csrf

                                <div class="comment-form-rating">
                                    <label for="rating">Your Rating</label>
                                    <div class="star-rating">
                                        <span class="star" data-value="1">&#9733;</span>
                                        <span class="star" data-value="2">&#9733;</span>
                                        <span class="star" data-value="3">&#9733;</span>
                                        <span class="star" data-value="4">&#9733;</span>
                                        <span class="star" data-value="5">&#9733;</span>
                                    </div>
                                    <input type="hidden" name="rating" id="rating" value="5">
                                </div>

                                <input type="hidden" name="product_id" value="1">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                <p class="comment-form-comment">
                                    <textarea id="comment" name="comment" placeholder="Your Review" cols="45" rows="8" maxlength="65525" required="required"></textarea>
                                </p>

                                <p class="form-submit">
                                    <button name="submit" type="submit" id="submit" class="qodef-button qodef-layout--outlined" value="Submit">
                                        <span class="qodef-m-border--top-left"></span><span class="qodef-m-border--bottom-right"></span><span class="qodef-m-text">Submit</span>
                                    </button>
                                    <input type='hidden' name='comment_post_ID' value='4075' id='comment_post_ID' />
                                    <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                                </p>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const submitButton = document.getElementById('submit');

                                    @if (Auth::guest())
                                        submitButton.addEventListener('click', function(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Login Required',
                                                text: 'You must be logged in to submit a review!',
                                                confirmButtonText: 'Login',
                                                showCancelButton: true,
                                                cancelButtonText: 'Cancel'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = "{{ route('login') }}";
                                                }
                                            });
                                        });
                                    @endif
                                });
                            </script>




                        </div><!-- #respond -->
                    </div>
                </div>


                <div class="clear"></div>
            </div>
        </div>

    </div>

</div>
<style>
    .star-rating {
    font-size: 30px;
    color: #ccc;
    cursor: pointer;
    display: inline-block;
}

.star-rating .star {
    margin-right: 5px;
}

.star-rating .star:hover,
.star-rating .star.hover {
    color: rgb(183, 140, 10);
}

.star-rating .star.selected {
    color: rgb(183, 140, 10);
}

</style>
<script>
    const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('rating');

function updateStars(rating) {
    stars.forEach(star => {
        const value = parseInt(star.getAttribute('data-value'));
        if (value <= rating) {
            star.classList.add('selected');
        } else {
            star.classList.remove('selected');
        }
    });
}

stars.forEach(star => {
    star.addEventListener('mouseover', () => {
        const value = parseInt(star.getAttribute('data-value'));
        updateStars(value);
    });

    star.addEventListener('mouseout', () => {
        const value = parseInt(ratingInput.value);
        updateStars(value);
    });

    star.addEventListener('click', () => {
        const value = parseInt(star.getAttribute('data-value'));
        ratingInput.value = value;
        updateStars(value);
    });
});

updateStars(parseInt(ratingInput.value));

    </script>
