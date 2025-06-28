@extends('layouts.single')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/single-product/head")
@include("components/user_side/single-product/sec1")
@include("components/user_side/single-product/index")
@include("components/user_side/single-product/details")
@include("components/user_side/single-product/products")


@endsection
