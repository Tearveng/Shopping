@extends('layouts.blog')

@section('content')
<style>
    .section.py-10 {
        height: 890px;
    }
</style>
<section class="section py-10" style="background-image: url({{ asset('img/MAG-FR-Oestreicher-Singer-Product-Recommendation-Viral-Marketing-Social-Media-Network-Ecommerce-1200-1200x627.jpg') }})" data-overlay="5">

    <div class="container">
        <h2 class="text-white text-center">{{ __('Login') }}</h2>
        <p class="text-white text-center opacity-70 lead">Start to shopping our product now.</p>
        <br>

        <div class="row">
            <form class="col-11 col-md-6 col-xl-5 mx-auto section-dialog bg-gray p-5 p-md-7" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf

                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope-o fa-fw"></i></span>
                    </div>
                    <input type="text" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('E-Mail Address') }}" >
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{__('Password')}}">
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group ">
                    <div class="input-group-prepend">
                        <div class="form-check ">
                            <input class="form-check-input mt-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <a class="btn btn-link" style="margin-top: -3px;" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div><br>
                    <button class="btn btn-block btn-lg btn-success" type="submit">{{ __('Login') }}</button>
                </div>
                
                <a class="btn btn-link" style="margin-left: 45px" href="{{ route('register') }}">
                    {{ __('Not yet have account? Sign Up') }}
                </a>
            </form>
            
        </div>

    </div>
</section>
@endsection