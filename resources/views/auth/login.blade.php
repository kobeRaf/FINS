@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" >
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px; border-radius: 1rem;">
        <div class="text-center mb-4">
            @if(isset($latest) && $latest->logo)
                <img src="{{ asset('systemlogo/' . $latest->logo) }}" alt="System Logo" class="mb-2" style="max-height: 200px;">
            @endif
            <h2 class="fw-bold">{{ $latest->system_name ?? 'System Name' }}</h2>
            <h4 class="text-muted">{{ $latest->sub_system_name ?? 'Sub System' }}</h4>
        </div>


        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Username') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary fw-bold">
                    {{ __('Login') }}
                </button>
            </div>

            {{-- @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif --}}
        </form>
    </div>
</div>
@endsection
