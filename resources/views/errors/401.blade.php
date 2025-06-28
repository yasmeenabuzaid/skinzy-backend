@extends('layouts.user_side_master')

@section('content')

<style>
    .centered-401 {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; 
        flex-direction: column;
        text-align: center;
    }



    .text-404 p {
        font-size: 18px;
    }

    .hightlight {
        color: #5cb85c;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .text-404 h1 {
            font-size: 40px;
        }

        .text-404 p {
            font-size: 16px;
        }

        .centered-401 img {
            width: 90%;
            height: auto;
        }
    }
</style>

<div class="main-content main-content-404 right-sidebar">
    <div class="container">
        <div class="centered-401">
            <div class="text-404">
                <h1 class="page-title">Error 401</h1>
                <p class="page-content">
                    You are not authorized to access this page.<br/>
                    You could return to
                    <a href="{{ route('home') }}" class="hightlight">Home page</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
