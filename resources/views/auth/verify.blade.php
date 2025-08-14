@extends('layouts.app')

@section('content')
<div class="main-content main-content-login">
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class="site-main">

                    <div class="customer_login">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12" style="margin-left: 280px !important; margin-top: 50px !important;">
                                <div class="login-item">
                                    <h5 class="title-login">{{ __('Verify Your Email Address') }}</h5>


                    <form method="POST" action="{{ route('verification.resend') }}" class="login">
                        @csrf

                         @if (session('resent'))
                         <div class="message-box success" style="background-color: #e8f5e9; color: #2e7d32; padding: 15px 20px; border-left: 4px solid #66bb6a; border-radius: 4px; margin-bottom: 25px;">
                           <i class="fa fa-check-circle" aria-hidden="true" style="margin-right: 8px;"></i>
                            {{ __('A fresh verification link has been sent to your email address.') }}
                            <br><br>
                             <strong>{{ __('We sent the verification link to:') }}</strong>
                               {{ Auth::user()->email }}
                            <br>
                             <a href="{{ route('profile') }}" style="color: #2e7d32; text-decoration: underline; font-size: 14px;">
                                 {{ __('Not your email? Click here to update it.') }}
                             </a>
                        </div>
                    @endif

                        <p class="form-row form-row-wide">
                            <label for="email" class="text">
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                 {{ __('If you did not receive the email') }},
                            </label>
                        </p>



                        <p class="form-row">
                                    <button type="submit" class="btn btn-link" >
                                        {{ __('click here to request another') }}
                                    </button>

                         </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
