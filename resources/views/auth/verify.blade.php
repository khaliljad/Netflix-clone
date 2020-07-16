@extends('layouts.app')

@section('content')

<div class="nav-container profiles">
    <header class="nav-header">
        <div class="nav-left-flex">
            <div class="netflixLogo">
                <a id="logo" href="{{ route('profiles.index') }}"><img src="https://github.com/carlosavilae/Netflix-Clone/blob/master/img/logo.PNG?raw=true"></a>
            </div>
        </div>
    </header>
</div>
<div class="container-verify">
    <div class="row justify-content-center">    
        <div class="col-md-8">
            <div class="card-verify">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
