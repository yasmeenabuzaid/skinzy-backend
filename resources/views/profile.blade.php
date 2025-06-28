@extends('layouts.user_side_master')

@section('content')

<link rel="stylesheet" href="/styles/styles.css">
<script src="/script/script.js"></script>

{{--include hero_section start--}}
@include("components/user_side/profile/head")
@include("components/user_side/profile/index")
@include("components/user_side/profile/order")
{{-- @include("components/user_side/profile/order_history") --}}

@endsection
