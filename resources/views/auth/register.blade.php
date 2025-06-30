@extends('layouts.app')

@section('content')
<div class="main-content main-content-login" style="background-color: #f8f9fa; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="register-box card"
         style="width: 100%; max-width: 600px; border: 1px solid #ddd; border-radius: 8px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); background-color: #fff;margin:30px">

        <h4 class="text-center mb-4">Register Now</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <!-- First Name -->
                <div class="col-md-6 mb-3">
                    <label for="Fname" class="form-label">{{ __('First Name') }}</label>
                    <input id="Fname" type="text" class="form-control @error('Fname') is-invalid @enderror"
                           name="Fname" value="{{ old('Fname') }}" required autocomplete="Fname" autofocus
                           placeholder="Enter your first name">
                    @error('Fname')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="col-md-6 mb-3">
                    <label for="Lname" class="form-label">{{ __('Last Name') }}</label>
                    <input id="Lname" type="text" class="form-control @error('Lname') is-invalid @enderror"
                           name="Lname" value="{{ old('Lname') }}" required autocomplete="Lname"
                           placeholder="Enter your last name">
                    @error('Lname')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email"
                           placeholder="Enter your email address">
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Mobile -->
                <div class="col-md-6 mb-3">
                    <label for="mobile" class="form-label">{{ __('Mobile') }}</label>
                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                           name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile"
                           placeholder="Enter your mobile number">
                    @error('mobile')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password"
                           placeholder="Create a password">
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6 mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password"
                           class="form-control" name="password_confirmation" required autocomplete="new-password"
                           placeholder="Confirm your password">
                </div>
            </div>

            <!-- Submit button -->
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-success">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
