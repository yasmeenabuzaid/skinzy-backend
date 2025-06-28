@extends('layouts.light-master')

@section('content')

{{--include hero_section start--}}
@include("components/user_side/chocolaterie-light/hero_section")
@include("components/user_side/chocolaterie-light/section2")
 @include("components/user_side/chocolaterie-light/section3")
 @include("components/user_side/chocolaterie-light/section4")
 {{-- @include("components/user_side/chocolaterie-light/section5") --}}
 {{-- @include("components/user_side/chocolaterie-light/section6") --}}
{{-- @include("components/user_side/chocolaterie-light/section7") --}}
@include("components/user_side/chocolaterie-light/section8")
@include("components/user_side/chocolaterie-light/section9")
@include("components/user_side/home/section10")
{{--include hero_section end--}}

@endsection
