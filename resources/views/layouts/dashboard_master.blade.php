<!-- include first start -->
@include("includes/dashboard/first")
<!-- include first end -->


<!-- include nav bar start -->
@include("includes/dashboard/navbar")
<!-- include nav bar end -->

<main id="main" class="main">

<!-- include side bar start -->
@include("includes/dashboard/sidebar")
<!-- include side bar end -->


@yield("content")


</main><!-- End #main -->

<!-- include footer start -->
 @include("includes/dashboard/footer")
<!-- include footer end -->
