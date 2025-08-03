@extends('layouts.app')


@section('content')
    <div class="main-content-reset">

        <div class="shape-bg">
            <div class="shape shape1"></div>
            <div class="shape shape2"></div>
            <div class="shape shape3"></div>
            <div class="shape shape4"></div>
            <div class="shape shape5"></div>
            <div class="shape shape6"></div>
            <div class="shape shape7"></div>
        </div>

        <div class="reset-container">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-key-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1.5-1.5-1.5 1.5-1.5-1.5-1.5 1.5-1.5-1.5L4.964 9.5H3.5a3.5 3.5 0 0 1 0 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                </svg>
            </div>
            <h4>{{ __('Forgot Password?') }}</h4>
            <p class="subtitle">No problem! Enter your email and we'll send you a reset link.</p>

            @if (session('status'))
                <div class="alert alert-success-custom" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="text-start">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="you@example.com">

                    @error('email')
                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-reset"
                        style="  background: #FF671F;
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        padding: 14px;
        border-radius: 12px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 103, 31, 0.3);">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>

            <a href="{{ route('login') }}" class="back-to-login">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16" style="vertical-align: -2px;">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                {{ __('Back to Login') }}
            </a>
        </div>

        <footer class="reset-footer">
            © {{ date('Y') }} Skinzy Care. All Rights Reserved.
        </footer>

    </div>
@endsection
