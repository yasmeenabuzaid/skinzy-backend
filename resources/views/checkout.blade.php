@extends('layouts.user_side_master')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/checkout/head")
@include("components/user_side/checkout/orderItem")
@include("components/user_side/checkout/index")



@endsection
