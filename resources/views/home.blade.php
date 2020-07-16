@extends('layouts.header')


@section('header-content')
<div class="profiles-container">

    <div class="nav-container profiles">
        <header class="nav-header">
            <div class="nav-left-flex">
                <div class="netflixLogo">
                    <a id="logo" href="{{ route('profiles.index') }}"><img src="https://github.com/carlosavilae/Netflix-Clone/blob/master/img/logo.PNG?raw=true"></a>
                </div>
            </div>
        </header>
    </div>

    <div id="first-section-visibility">
    <div class="wrapper">

        <h1>{{__('profiles.Who\'s watching?')}}</h1>
    
        <div class="profile-wrap">

            @forelse($profiles as $profil)
                <div class="profile">
                    
                    <div class="profile-icon">
                        <a href="{{ route('browse', ['id' => $profil->id]) }}"><img src="{{ Storage::url($profil->image) }}"></a>
                    </div>
                    <div class="profile-name">
                        <p>
                            <p>{{ $profil->nom }}</p>
                        </p>
                    </div>
                </div>
                {{-- <form action="{{ route('profil.login') }}" method="POST">
                    @csrf

                <input id="nom" type="text" class="text-input @error('nom') is-invalid @enderror" name="nom" required />

                <button class="signin-btn">{{__('login.Sign In')}}</button>
                </form> --}}
            @empty
            <h1 id="emty-title">Aucun Profile</h1>
            
            @endforelse
            
        </div>
        <a class="manage-profile" id="change">{{__('profiles.MANAGE PROFILES')}}</a>
    </div>
    </div>

    <div class="visibility-none" id="second-section-visibility">
        <div class="wrapper">
            <h1>{{__('profiles.Manage Profiles:')}}</h1>
        
            <div class="profile-wrap">

                @foreach($profiles as $profil)
                    <div class="profile manage">
                        <div class="profile-icon manage">
                            <a href="{{ route('profiles.edit', ['profile' => $profil->id]) }}">
                                <img src="{{ Storage::url($profil->image) }}">
                                <div class="icone-cercle"></div>
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                        <div class="profile-name">
                            <p>
                                <p>{{ $profil->nom }}</p>
                            </p>
                        </div>
                    </div>
                @endforeach
                {{-- ********* Add Profil ********* --}}
                @if ($profiles->count() < 4 )
                    
                <div class="profile manage">
                    <a href="{{ route('profiles.create')}}">
                    <div class="profile-icon manage">
                            <i class="fas fa-plus-circle fa-5x"></i>
                        </div>
                    </a>
                    <div class="profile-name">
                        <p>Add new Profil</p>
                    </div>
                </div>

                @endif


            </div>  

            <a id="restor" class="manage-profile done" href="#">{{__('profiles.Done')}}</a>
        </div>
    </div>
</div>
@endsection
