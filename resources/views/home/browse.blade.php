@extends('layouts.nav')

@section('webContent')
<div class="browse-container">

    <div class="wrapper-browse">
        <div class="contenu">
            <h2 class="pitch">Sorry If I Call You Love</h2>
            <h5>Une existence sans médias sociaux? Cette influenceuse va découvrir que profiter de la vie vaut mieux
                que
                publier sa vie.</h5>
            <div class="btn">
            <a href="{{ route('video.show', ['id' => $id, 'movie' => 9]) }}"><button class="join"><i class="fa fa-play"></i>Play</button></a>
                {{-- <a href=""><button class="joine"><i class="fa fa-plus browse"></i>My List</button></a> --}}
            </div>
        </div>
    </div>

<div class="main-browse">
    <div class="location" id="home">


        <div class="popular">

            <h1 class="cat-title">Popular Netflix</h1>
        
            <div class="box">
        
                    @forelse ($popular as $video)
                        
                    <div class="position">               
                        <a href="{{ route('video.show', ['id' => $id, 'movie' => $video->id]) }}">
                            <div class="category-link"><img class="brows-media_category" src="{{ Storage::url($video->imageCategory) }}" data="http://localhost:8000/storage/{{$video->video}}"></div>
                        </a>
                    </div>

                    @empty

                    <h1 id="emty-title">Aucun Movie</h1>
            
                    @endforelse
        
        
            </div>
        
        </div>

        @foreach ($categories as $category)

        <h1 class="cat-title">{{$category->nom }}</h1>

        <div class="box">

            @forelse ($category->movies as $video)

                    <div class="position">               
                        <div class="brows-media-link"><img class="brows-media imgs" src="{{ Storage::url($video->image) }}" data="http://localhost:8000/storage/{{$video->video}}"></div>
                        <div class="brows-media-link">
                            <video class="brows-media vds media-hidden" >
                                <source class="source" src="{{ Storage::url($video->video)}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                        <div class="nav-video">

                            @php
                                $like_status = '';
                                $dislike_status = '';
                            @endphp

                            @foreach ($video->likes as $like) 
                            
                                @php

                                    if ($like->like == 1 && $like->profile_id == $id) {

                                        $like_status = 'like';
                                        
                                    }

                                    if ($like->like == 0 && $like->profile_id == $id) {

                                        $dislike_status = 'dislike';
                                        
                                    }
                                    
                                @endphp

                            @endforeach



                            @if (in_array($video->id, $arrVid))
                                <a class="buttons-vid" href="{{ route('mylist', ['movieId' => $video->id, 'profile' => $id]) }}"><i class="fas fa-check"></i></a>
                            @else
                                <a class="buttons-vid" href="{{ route('mylist', ['movieId' => $video->id, 'profile' => $id]) }}"><i class="fas fa-plus"></i></a>
                            @endif
                                <a class="buttons-vid btn-like" data-profilId="{{ $id }}" data-movieId="{{ $video->id }}_l" data-like="{{ $like_status }}" href=""><i class="fa fa-thumbs-up {{ $like_status }}" icon-movieId="{{ $video->id }}_l"></i></a>
                                <a class="buttons-vid btn-dislike" data-profilId="{{ $id }}" data-movieId="{{ $video->id }}_d" data-like="{{ $dislike_status }}" href=""><i class="fa fa-thumbs-down {{ $dislike_status }}" icon-movieId="{{ $video->id }}_d"></i></a>
                        </div>

                        <div class="play-video">
                            <a class="button-play" href="{{ route('video.show', ['id' => $id, 'movie' => $video->id]) }}"><i class="fas fa-play-circle fa-3x"></i></a>
                            <p class="movie-name">{{ $video->nom }}</p>
                        </div>

                    </div>
                    
                    @empty
                
                <h1 id="emty-title">Aucun Movie</h1>
                
            @endforelse
                </div>
                
        @endforeach
    </div>

</div>

</div>

<script type="text/javascript">

    var url = "{{ route('like') }}";
    var url_dis = "{{ route('dislike') }}";
    var token = "{{ Session::token() }}";
    
</script>
    
@endsection