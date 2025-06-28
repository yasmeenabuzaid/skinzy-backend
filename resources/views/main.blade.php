@extends('layouts.user_side_master')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/home/hero_section")
@include("components/user_side/home/section2")
@include("components/user_side/home/section3")
@include("components/user_side/home/section6")
{{-- @include("components/user_side/home/section4") --}}
@include("components/user_side/home/section7")
@include("components/user_side/home/section8")
@include("components/user_side/home/section5")
@include("components/user_side/home/section9")
{{-- @include("components/user_side/home/section10") --}}
{{--include hero_section end--}}

@endsection
