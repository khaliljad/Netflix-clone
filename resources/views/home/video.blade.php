@extends('layouts.nav')

@section('webContent')

@foreach ($categories as $category)

    @foreach ($category->movies as $videos)

    @if ($videos->id == $movie)
    <div class="video-container">

            <video class="video-tag" controls="controls" poster="{{ asset('storage/' .$videos->image) }}">
                <source src="{{ asset('storage/'.$videos->video) }}">
            </video>

    </div>

    @endif


    @endforeach

@endforeach

@endsection