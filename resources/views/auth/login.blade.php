@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="wrapper-login">
        <div class="header">
          <svg viewBox="0 0 512 138" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid">
            <g>
              <path d="M340.657183,0 L340.657183,100.203061 C353.016406,100.778079 365.344207,101.473198 377.637095,102.293306 L377.637095,123.537553 C358.204486,122.242243 338.690182,121.253471 319.094879,120.57923 L319.094879,0 L340.657183,0 Z M512,0.0118710746 L483.922918,65.1060972 L511.993017,137.54371 L511.961595,137.557485 C503.784957,136.3909 495.597845,135.289637 487.386294,134.233936 L471.623048,93.5776798 L455.709676,130.459835 C448.168455,129.627123 440.61676,128.839275 433.047609,128.100899 L460.419447,64.6708546 L435.351871,0.0118710746 L458.677285,0.0118710746 L472.712335,36.1957639 L488.318473,0.0118710746 L512,0.0118710746 Z M245.093161,119.526252 L245.092462,0.0114869428 L305.282574,0.0114869428 L305.282574,21.4467074 L266.654767,21.4467074 L266.654767,49.2277266 L295.881884,49.2277266 L295.881884,70.4719734 L266.654767,70.4719734 L266.654767,119.521329 L245.093161,119.526252 Z M164.580156,21.448488 L164.579458,0.0103695593 L231.270382,0.0103695593 L231.270382,21.4469875 L208.705375,21.4469875 L208.705375,120.107799 C201.508397,120.296154 194.3191,120.519389 187.144466,120.790104 L187.144466,21.448488 L164.580156,21.448488 Z M90.8682168,126.966224 L90.8682168,0.0139657936 L150.758077,0.0139657936 L150.758077,21.4491862 L112.42703,21.4491862 L112.42703,50.4849807 C121.233151,50.3722116 133.754021,50.2444297 141.543822,50.2632828 L141.543822,71.5092753 C131.792954,71.388127 120.786264,71.6429923 112.42703,71.7264345 L112.42703,103.88974 C125.166805,102.887736 137.944984,102.011069 150.758077,101.270912 L150.758077,122.517253 C130.704017,123.672422 110.740031,125.160591 90.8682168,126.966224 Z M48.5710466,77.8540254 L48.5696502,0.0104745953 L70.1319549,0.0104745953 L70.1319549,128.968837 C62.2496338,129.779728 54.3823252,130.642465 46.5286328,131.553346 L21.5609083,59.8244682 L21.5609083,134.625696 C14.3597408,135.563565 7.17323695,136.54141 0,137.562338 L0,0.0118710746 L20.4911722,0.0118710746 L48.5710466,77.8540254 Z M395.425298,124.819071 L395.425298,124.819211 L395.425298,0.0120101224 L416.987603,0.0120101224 L416.987603,126.599777 C409.809478,125.960833 402.624371,125.369895 395.425298,124.819071 Z" fill="#DB202C" fill-rule="nonzero"></path>
            </g>
          </svg>          
        </div>

        <div class="login">
            <form class="signin-form" method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="title">{{__('login.Sign In')}}</h1>
    
              <div class="field">
                <input id="identify" type="text" class="text-input @error('identify') is-invalid @enderror" name="identify" required />
                <span class="floating-label">{{__('login.Email address or phone number')}}</span>
                @error('identify')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
    
              <div class="field">
                <input id="password" type="password" class="text-input @error('password') is-invalid @enderror" name="password" required />
                <span class="floating-label test">{{__('login.Password')}}</span>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
    
              <button class="signin-btn">{{__('login.Sign In')}}</button>
    
              <div class="action-group">
                <label for="remember-me">
                  <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                  {{__('login.Remember me')}}
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-mdp" href="{{ route('password.request') }}">
                        {{__('login.Forgot Your Password?')}}
                    </a>
                @endif
              </div>

              <div class="face-login">
                  <img class="fb-icon" src="https://assets.nflxext.com/ffe/siteui/login/images/FB-f-Logo__blue_57.png" alt="fb-icon">
                  <a href="redirect/facebook"><span class="login-with-fb">{{__('login.Login with Facebook')}}</span></a>
              </div>
    
              <div class="onboarding">
                <p>{{__('login.New to Netflix?')}} <a href="{{ route('register') }}">{{__('login.Sign up now.')}}</a></p>
              </div>
            </form>
          </div>
    
          <div class="footer">
            <p class="questions">{{__('login.Questions? Contact us.')}}</p>
            <div class="terms">
              <a>{{__('login.Gift Card Terms')}}</a>
              <a>{{__('login.Terms of Use')}}</a>
              <a>{{__('login.Privacy Statement')}}</a>
            </div>

            <select onchange="location = this.value;">
                        <option value="#">{{__('login.Choose your language')}}</option>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <option value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </option>
                @endforeach
            </select>
          </div>
    </div>
</div>
@endsection
