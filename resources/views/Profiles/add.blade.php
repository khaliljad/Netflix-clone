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


    <div class="wrapper add">
        <div class="profile-wrap add">
            <form method="POST" action="{{ route('profiles.store')}}" enctype="multipart/form-data" >
                @csrf
                <div class="profile">
                    <div class="profile-icon add">
                        <label for="file-upload" class="custom-file-upload">
                            {{__('profiles.Add file')}}
                        </label>
                        <input id="file-upload" type="file" name="image" value="{{ old('nom') }}" required>
                    </div>

                    <div class="profile-name">
                        <input class="add-input" type="text" name="name" autocomplete="off" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <p class="profile-name-span">{{__('profiles.Add Your Name')}}</p>
                    </div>

                    <input class="manage-profile input" type="submit" value="Done">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection