@extends('layouts.app')

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
        <div class="row">
            <div class="content-area content-404 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <section class="error-404 not-found">
                        <div class="images">
                            <img src="{{asset("landing_page/assets/images/403.webp")}}" alt="img">
                        </div>
                        <div class="text-404">
                            <h1 class="page-title">
                                Error 403
                            </h1>
                            <p class="page-content">
                                 You don't have permission to access this page.. <br/>
                                You could return to
                                <a href="{{ route('home') }}" class="hightlight"> Home page</a>

                            </p>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
