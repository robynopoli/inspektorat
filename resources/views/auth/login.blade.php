@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mt-5 rounded-0">
                    <div class="card-header"></div>
                    <div class="card-body pb-5">

                        @if($msg_error = session()->get('msg_error'))
                            <div class="alert alert-primary">
                                {{ $msg_error }}
                            </div>
                        @endif

                        <h4>{{ __('Login') }}</h4>
                        <p>Silahkan login menggunakan akun <i>Si-Mutiara</i> yang anda miliki</p>
                        <form method="POST" action="{{ route('login.login_action') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror shadow-none" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror shadow-none" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                        <div class="row mb-3">--}}
                            {{--                            <div class="col-md-6 offset-md-4">--}}
                            {{--                                <div class="form-check">--}}
                            {{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                            {{--                                    <label class="form-check-label" for="remember">--}}
                            {{--                                        {{ __('Remember Me') }}--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
