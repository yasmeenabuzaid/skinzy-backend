@extends('layouts.app')

@section('content')
<div class="main-content main-content-login" style="background-color: #f8f9fa; min-height: 90vh; display: flex; justify-content: center; align-items: center;">
    <div class="login-box card"
         style="width: 100%; max-width: 700px; border: 1px solid #ddd; border-radius: 8px; padding: 50px;padding-top:60px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); background-color: #fff;">
        <h4 class="text-center mb-4">Login to Your Account</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    placeholder="Enter your email address">

                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password"
                    placeholder="Enter your password">

                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Submit button -->
            <div class="d-grid mb-7">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>

            <!-- Register link -->
            <div class="text-center">
                <a href="{{ route('register') }}" class="text-decoration-none">
                    {{ __("Don't have an account? Create one") }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
