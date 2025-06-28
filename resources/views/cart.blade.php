@extends('layouts.user_side_master')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/cart/head")
@include("components/user_side/cart/cart")


@endsection
