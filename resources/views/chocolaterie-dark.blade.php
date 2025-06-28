@extends('layouts.dark-master')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/chocolaterie-dark/hero_section")
@include("components/user_side/chocolaterie-dark/section2")
@include("components/user_side/chocolaterie-dark/section3")
@include("components/user_side/chocolaterie-dark/section4")
@include("components/user_side/chocolaterie-dark/section5")
@include("components/user_side/chocolaterie-dark/section6")
{{-- @include("components/user_side/chocolaterie-dark/section7") --}}
@include("components/user_side/chocolaterie-dark/section8")
@include("components/user_side/chocolaterie-dark/section9")
{{-- @include("components/user_side/home/section10") --}}
{{--include hero_section end--}}

@endsection
