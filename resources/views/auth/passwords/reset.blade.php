@extends('layouts.app')

@section('content')
<div class="main-content main-content-login">

    {{-- Background shapes from the login page design --}}
    <div class="shape-bg">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
        <div class="shape shape4"></div>
        <div class="shape shape5"></div>
        <div class="shape shape6"></div>
        <div class="shape shape7"></div>
    </div>

    {{-- Centered container similar to the login page --}}
    <div class="login-container">
        <div class="logo">
            {{-- Logo from the login page --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                 class="bi bi-gear-fill" viewBox="0 0 16 16">
                <path
                    d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311a1.464 1.464 0 0 1-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c-1.4-.413-1.4-2.397 0-2.81l.34-.1a1.464 1.464 0 0 1 .872-2.105l-.17-.31c-.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.858 2.929 2.929 0 0 1 0 5.858z" />
            </svg>
        </div>
        <h4>{{ __('Reset Password') }}</h4>
        <p class="subtitle">Please enter your new password details.</p>

        <form method="POST" action="{{ route('password.update') }}" class="text-start">
            @csrf

            {{-- Hidden token for password reset --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email Input Field --}}
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                       placeholder="your-email@example.com">
                @error('email')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            {{-- Password Input Field --}}
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password" placeholder="••••••••">
                @error('password')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            {{-- Confirm Password Input Field --}}
            <div class="mb-4">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
            </div>

            {{-- Submit Button with styling from login page --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-login"
                        style="background: #FF671F;
                               color: #ffffff;
                               font-weight: 600;
                               font-size: 1rem;
                               padding: 14px;
                               border-radius: 12px;
                               border: none;
                               transition: all 0.3s ease;
                               box-shadow: 0 4px 15px rgba(255, 103, 31, 0.3);">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>

    {{-- Footer from the login page --}}
    <footer class="login-footer">
        © {{ date('Y') }} Skinzy Care. All Rights Reserved.
    </footer>

</div>
@endsection
