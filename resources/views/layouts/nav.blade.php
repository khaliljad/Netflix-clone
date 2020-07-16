@extends('layouts.header')

@section('header-content')

<div class="nav-container">
    <header class="nav-header">
        <div class="nav-left-flex">
            <div class="netflixLogo">
                <a id="logo" href="{{ route('browse', ['id' => $id ?? '']) }}"><img src="https://github.com/carlosavilae/Netflix-Clone/blob/master/img/logo.PNG?raw=true"></a>
            </div>
    
            <nav class="main-nav">
                <a href="{{ route('browse', ['id' => $id ?? '']) }}">{{__('nav.Home')}}</a>
                {{-- categories drop-down --}}
                <div class="sub-nav drop-down category">
                    <a href="#">{{__('nav.Categories')}}</a>
                    <div class="drop-down-content category">
                    @if ($cat ?? '')
                        <a class="category-name-drop" href="{{ route('category.show', ['id' => $id, 'category' => $categories->id]) }}">{{ $categories->nom }}</a> 
                    @elseif ($movies ?? '')
                        @foreach ($categories as $category)
                            <a class="category-name-drop" href="{{ route('category.show', ['id' => $id, 'category' => $category->id]) }}">{{ $category->nom }}</a>
                        @endforeach
                    @else
                        @foreach ($categories as $category)
                            <a class="category-name-drop" href="{{ route('category.show', ['id' => $id, 'category' => $category->id]) }}">{{ $category->nom }}</a>
                        @endforeach
                    @endif
                    </div>
                </div>

                <a href="{{ route('favourit.show', ['id' => $id]) }}">{{__('nav.My List')}}</a>
                <a href="{{ route('profiles.index') }}">{{__('nav.Profiles')}}</a>
                <a href="{{ route('video', ['id' => $id ?? '']) }}">go</a>
            </nav>
        </div>
            <nav class="sub-nav drop-down">
                <div class="drop-profile-flex"><img class="img" src="{{ Storage::url($profil->image) }}"><i class="fas fa-caret-down"></i></div>
                <div class="drop-down-content">
                    @foreach ($profiles as $profil)

                        <a href="{{ route('browse', ['id' => $profil->id]) }}"><div class="drop-profile-flex plus"><img class="img drop" src="{{ Storage::url($profil->image) }}" alt="profil-img"><p class="profil-name">{{ $profil->nom }}</p></div></a>
                    @endforeach

                    <a href="{{ route('profiles.index') }}" class="manage-text">{{__('nav.Manage Profiles')}}</a>
                    <a class="manage-text" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{__('nav.Sign Out of Netflix')}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </nav>
    </header>
</div> {{----- end nav bar -----}}

{{-- -------------------------------------------------- Content -------------------------------------------------- --}}

<main class="web-content">
    @yield('webContent')
</main> 

</div>
{{-- -------------------------------------------------- footer -------------------------------------------------- --}}
<footer>
    <section class="link">
        <div class="logos">
            <a href="#"><i class="fab fa-facebook-square fa-2x logo"></i></a>
            <a href="#"><i class="fab fa-instagram fa-2x logo"></i></a>
            <a href="#"><i class="fab fa-twitter fa-2x logo"></i></a>
            <a href="#"><i class="fab fa-youtube fa-2x logo"></i></a>
        </div>
        <div class="sub-links">
            <ul>
                <li><a href="#">{{__('nav.Audio and Subtitles')}}</a></li>
                <li><a href="#">{{__('nav.Audio Description')}}</a></li>
                <li><a href="#">{{__('nav.Help Center')}}</a></li>
                <li><a href="#">{{__('nav.Gift Cards')}}</a></li>
                <li><a href="#">{{__('nav.Media Center')}}</a></li>
                <li><a href="#">{{__('nav.Investor Relations')}}</a></li>
                <li><a href="#">{{__('nav.Jobs')}}</a></li>
                <li><a href="#">{{__('nav.Terms of Use')}}</a></li>
                <li><a href="#">{{__('nav.Privacy')}}</a></li>
                <li><a href="#">{{__('nav.Legal Notices')}}</a></li>
                <li><a href="#">{{__('nav.Corporate Information')}}</a></li>
                <li><a href="#">{{__('nav.Contact Us')}}</a></li>
            </ul>
        </div>
    </section>
    <!-- END OF LINKS -->

    <!-- FOOTER -->
    <footer>
        <p>&copy 1997-2018 Netflix, Inc.</p>
        <p>Carlos Avila &copy 2018</p>
    </footer>
</footer> {{------- end footer -------}}

@endsection