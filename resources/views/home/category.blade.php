@extends('layouts.nav')

@section('webContent')
        
<div class="category-container">

    <h1 class="category-title">{{$categories->nom }}</h1>

    <div class="box">

            @foreach ($categories->movies as $video)
                
            <div class="position">               
                <a href="{{ route('video.show', ['id' => $id, 'movie' => $video->id]) }}">
                    <div class="category-link"><img class="brows-media_category" src="{{ Storage::url($video->imageCategory) }}" data="http://localhost:8000/storage/{{$video->video}}"></div>
                </a>
            </div>
    
            @endforeach


    </div>

</div>

@endsection