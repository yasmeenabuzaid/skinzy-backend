@extends('layouts.user_side_master')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/product-by-category/head")
@include("components/user_side/product-by-category/sec1")
@include("components/user_side/product-by-category/products")



@endsection
