@extends('layouts.blog')

@section('content')
<style>
    .section.py-10{
        height: 900px;
    }
</style>
<section class="section py-10" style="background-image: url({{ asset('img/MAG-FR-Oestreicher-Singer-Product-Recommendation-Viral-Marketing-Social-Media-Network-Ecommerce-1200-1200x627.jpg') }})" data-overlay="5">

    <div class="container">
        <h2 class="text-white text-center">{{ __('Register') }}</h2>
        <p class="text-white text-center opacity-70 lead">Start to explore our product absolutely free.</p>
        <br>

        <div class="row">
            <form class="col-11 col-md-6 col-xl-5 mx-auto section-dialog bg-gray p-5 p-md-7" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
                    </div>
                    <input type="text" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope-o fa-fw"></i></span>
                    </div>
                    <input type="text" id="email" class="form-control" placeholder="{{ __('Email Address') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                    <input type="password" id="password" class="form-control" placeholder="{{ __('Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>
                    </div>
                    <input type="password" id="password-confirm" class="form-control" placeholder="{{ __('Confirm Password') }}" class="form-control" name="password_confirmation" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <button class="btn btn-block btn-lg btn-success" type="submit">{{ __('Register') }}</button>
            </form>
        </div>

    </div>
</section>
@endsection