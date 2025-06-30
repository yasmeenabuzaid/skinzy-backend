@extends('layouts.app')

@section('content')
<style>
    .centered-404 {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .centered-404 img {
        width: 600px;
        height: 400px;
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
    }

    .centered-404 h1 {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .centered-404 p {
        font-size: 18px;
    }

    .hightlight {
        color: #5cb85c;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .centered-404 h1 {
            font-size: 36px;
        }

        .centered-404 p {
            font-size: 16px;
        }
    }
</style>

<div class="centered-404">
    <h1>Error 404 - Page Not Found</h1>
    <p>
        We're sorry but the page you are looking for does not exist. <br>
        You could return to
        <a href="{{ route('home') }}" class="hightlight">Home page</a>.
    </p>
</div>
@endsection
