@extends('layouts.header')


@section('header-content')
    
<div class="profiles-container manage">

    <div class="nav-container profiles">
        <header class="nav-header">
            <div class="nav-left-flex">
                <div class="netflixLogo">
                    <a id="logo" href="{{ route('profiles.index') }}"><img src="https://github.com/carlosavilae/Netflix-Clone/blob/master/img/logo.PNG?raw=true"></a>
                </div>
            </div>
        </header>
    </div>

    <form action="{{ route('profiles.update', ['profile' => $profil->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="profiles-main">
            <h1 id="update-title">{{__('profiles.Edite Profil')}}</h1>
            <div class="update-profile-flex">
                <div class="flex-img">
                    <img class="update-profil-img" src="{{ Storage::url($profil->image) }}" alt="edit image">
                    <input type="file" id="type-file" name="useImg">
                    <label class="img-insert-label" for="type-file"></label>
                    <i class="fas fa-pen add"></i>
                    <div class="errors-image">
                        @error('useImg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                    <div class="flex-content">
                        <div class="drop-down-form">
                            <input type="text" name="name" value="{{ $profil->nom }}" autocomplete="off">
                        <div class="lang-dropdown">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="langue-p">{{__('profiles.Language:')}}</p>
                        <div class="drop-down-hover">
                            <div class="dropDown">{{__('profiles.Choose language')}}<i class="fas fa-caret-down"></i></div>
                                <div class="drop-down-lang-content">
                                    <ul>
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="update-manage-middle">
                            <h3>{{__('profiles.Maturity Settings:')}}</h3>
                            <p class="age-box">{{__('profiles.ALL MATURITY RATINGS')}}</p>
                            <p>{{__('profiles.Show titles of all maturity ratings for this profile.')}}</p>
                            <a class="manage-profile" href="#">{{__('profiles.Edit')}}</a>
                        </div>
                    </div>

            </div>

            <div class="update-manage-bottom">
                <input class="manage-profile input" type="submit" name="{{__('profiles.SAVE')}}">
                <a class="manage-profile update" href="{{ route('profiles.index')}}">{{__('profiles.CANCEL')}}</a>
            </div>
            
        </div>
    </form>
    <form action="{{ route('profiles.update', ['profile' => $profil->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="manage-profile input-delete" type="submit" value="{{__('profiles.DELETE PROFILE')}}">
    </form>

 </div>{{-- end container --}}

 @endsection