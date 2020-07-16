@extends('layouts.nav')

@section('webContent')
        
<div class="category-container">

    <h1 class="category-title">My List</h1>

    <div class="box">

            @foreach ($profil->movies as $video)
                
            <div class="position">               
                <div class="brows-media-link"><img class="brows-media imgs" src="{{ Storage::url($video->image) }}" data="http://localhost:8000/storage/{{$video->video}}"></div>
                <div class="brows-media-link">
                    <video class="brows-media vds media-hidden" >
                        <source class="source" src="{{ Storage::url($video->video)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="nav-video">
                @if (in_array($video->id, $arrVid))
                    <a class="buttons-vid" href="{{ route('mylist', ['movieId' => $video->id, 'profile' => $id]) }}"><i class="fas fa-check"></i></a>
                @else
                    <a class="buttons-vid" href="{{ route('mylist', ['movieId' => $video->id, 'profile' => $id]) }}"><i class="fas fa-plus"></i></a>
                @endif
                    <a class="buttons-vid" href=""><i class="fa fa-thumbs-up"></i></a>
                    <a class="buttons-vid" href=""><i class="fa fa-thumbs-down"></i></a>
                </div>

                <div class="play-video">
                    <a class="button-play" href="{{ route('video.show', ['id' => $id, 'movie' => $video->id]) }}"><i class="fas fa-play-circle fa-3x"></i></a>
                    <p class="movie-name">{{ $video->nom }}</p>
                </div>

            </div>
    
            @endforeach


    </div>

</div>

@endsection