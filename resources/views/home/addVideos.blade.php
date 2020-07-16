<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7833b23ae0.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Document</title>
    <style>
        label {
            color: #FFF;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('insert') }}" enctype="multipart/form-data">
        @csrf
        <div class="input-name-add">
            <label for="video-name">name</label>
            <input type="text" name="nom" id="video-name">
        </div>

        <div class="input-image-add">
            <label for="video-image">image</label>
            <input type="file" name="image" id="video-image">
        </div>

        <div class="input-image-add">
            <label for="video-image">category image</label>
            <input type="file" name="cat-image" id="video-cat-image">
        </div>

        <div class="input-video-add">
            <label for="video-video">video</label>
            <input type="file" name="video" id="video-video">
        </div>

        <div class="select-cat-add">
            <select name="category_id[]" id="select-cat" multiple>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nom }}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" name="submit">
    </form>
    
</body>
</html>
