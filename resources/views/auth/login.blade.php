@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-xl-12" style="padding: 10em">
                <div class="card border-0">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="mb-5">
                                        <h3 class="h4 font-weight-bold">Login</h3>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="email">{{ __('E-Mail Address') }}</label>

                                            {{-- <div class="col-md-6"> --}}
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- </div> --}}
                                        </div>

                                        <div class="form-group">
                                            <label for="password">{{ __('Password') }}</label>

                                            {{-- <div class="col-md-6"> --}}
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- </div> --}}
                                        </div>

                                        <div class="form-group">
                                            {{-- <div class="col-md-6 offset-md-4"> --}}
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="form-group">
                                            {{-- <div class="col-md-8 offset-md-4"> --}}
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>

                                            {{-- @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif --}}
                                            {{-- </div> --}}
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="col-lg-6 d-flex justify-content-center ">
                                <img src="{{ asset('images/login.svg') }}" class="img-fluid d-none d-sm-none d-lg-block"
                                    alt="">
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
