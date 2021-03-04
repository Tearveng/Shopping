@extends('layouts.blog')

@section('content')
<style>
    .section.py-10 {
        height: 890px;
    }
</style>
<section class="section py-10" style="background-image: url({{ asset('img/MAG-FR-Oestreicher-Singer-Product-Recommendation-Viral-Marketing-Social-Media-Network-Ecommerce-1200-1200x627.jpg') }})" data-overlay="5">

    <div class="container">
        <h2 class="text-white text-center">{{ __('Reset Password') }}</h2>
        <br>

        <div class="row">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form class="col-11 col-md-6 col-xl-5 mx-auto section-dialog bg-gray p-5 p-md-7" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                @csrf

                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope-o fa-fw"></i></span>
                    </div>
                    <input type="text" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}">
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group ">
                    <button class="btn btn-block btn-lg btn-success" type="submit"> {{ __('Send Password Reset Link') }}</button>
                </div>

            </form>

        </div>

    </div>
</section>
@endsection