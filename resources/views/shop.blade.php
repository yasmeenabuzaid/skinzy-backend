@extends('layouts.user_side_master')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/shop/head")
@include("components/user_side/shop/title")
@include("components/user_side/shop/categories")
@include("components/user_side/shop/Popular-Products")
@include("components/user_side/shop/products")


@endsection
