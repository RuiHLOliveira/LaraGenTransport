@extends('layouts.appnoside')

@section('content')

<style>
    .loginContainer {
        display: flex;
        justify-content: center;
        padding-top: 155px;
    }
    .loginContainer form{
        flex-basis: 450px;
        flex-grow: 0;
        flex-shrink: 1;
    }
    .bodyclass {
        background-color: #2d3a4b;
        color: #eeeeee;
    }
    .loginContainer input,
    .loginContainer input:focus {
        color: #eeeeee;
        background-color: #283443;
        border: 1px solid #3e4956;
        box-shadow: none;
    }
    .loginContainer .btn-default {
        color: #eeeeee;
        background-color: #1890ff;
        border: 1px solid #3e4956;
    }
</style>
<div class="loginContainer backgroundcolor">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- linha 1 --}}
        <div class="form-group row">
            <div class="col-md-12 text-center">
                <h4 class="font-weight-bold">Login Form</h4>
            </div>
        </div>

        {{-- linha 2 --}}
        <div class="form-group row">
            <div class="col-md-12">
                <input id="email" placeholder="your e-mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- linha 3 --}}
        <div class="form-group row">
            <div class="col-md-12">
                <input id="password" placeholder="your password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- linha 4 --}}
        {{-- <div class="form-group row">
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div> --}}

        {{-- linha 5 --}}
        <div class="form-group row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-default form-control">
                    {{ __('Login') }}
                </button>
            </div>
        </div>

        @if (Route::has('password.request'))
            <div class="form-group row">
                <div class="col-md-12">
                    <a class="btn btn-default form-control" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            </div>
        @endif

    </form>
</div>
@endsection
