@extends('layouts.app')

@section('content')
<style>
    body{
        overflow:hidden;
    }
    .py-4 {
        padding-bottom: 2rem!important;
    }
</style>
    <div class="page page-center">
        <div class="container-tight pb-4">
            <div class="text-center mb-3">
                <a href="/"><img src="{{asset('/compnaylogo.jpeg')}}" height="36" alt=""></a>
            </div>
                    <form class="card card-md" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="card-body" style="margin-bottom: 0px !important;">
                            <h2 class="card-title text-center mb-4">Login to your account</h2>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-2">
                                <label class="form-label">
                                    Password
                                    <span class="form-label-description">
                                                   @if (Route::has('password.request'))
                                            <a  href="{{ route('password.request') }}">
                                       I forgot password
                                    </a>
                                        @endif
                                        </span>
                                </label>
                                <div class="input-group input-group-flat">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    <span class="input-group-text toggle-password">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="mb-2">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input"/>
                                    <span class="form-check-label">Remember me on this device</span>
                                </label>
                            </div>
                            <div class="form-footer">
                                <button type="submit"  class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                            </div>
                    </form>

        <div class="text-center text-muted mt-1">
            Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
        </div>
    </div>
</div>
@endsection


