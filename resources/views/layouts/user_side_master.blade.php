{{--include first start--}}
@include("includes/user_side/home/header")
{{--include first end--}}

{{--include header start--}}
@include("includes/user_side/home/navbar_1")
@include("includes/user_side/home/navbar_2")
{{--include header end--}}



@yield("content")

{{--include footer start--}}
@include("includes/user_side/home/footer")
{{--include footer end--}}
