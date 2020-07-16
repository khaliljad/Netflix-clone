<?php

namespace App\Http\Controllers;

use App\Category;
use App\Like;
use App\Movie;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrowseConroller extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index($id) {

        $auth = Auth::id();
        
        $categories = Category::with(['movies' => function($query) {
            $query->select('movies.id', 'nom', 'image', 'video');
        }])->get();

        $popular = Movie::select('id', 'nom', 'imageCategory', 'video')->limit(6)->get();

        
        $profils = Profile::where('user_id', $auth)->get();
        $profil = Profile::findOrFail($id);
        $movies = $profil->movies;

        $arrVid = [];
        foreach ($movies as $movie) {
            $arrVid[] =  $movie->id;
        }

        if ($profil->user_id == $auth) {

            return view('home.browse', [
                'id' => $id,
                'profil' => $profil,
                'profiles' => $profils,
                'categories' => $categories,
                'arrVid' => $arrVid,
                'popular' => $popular
            ]);
        } else {
            return redirect()->route('login');
        }

    }

    public function showVideo($id, $movie) {

        $auth = Auth::id();
        $categories = Category::with(['movies' => function($query) {
            $query->select('movies.id', 'nom', 'image', 'video');
        }])->get();

        $profils = Profile::where('user_id', $auth)->get();
        $profil = Profile::findOrFail($id);

        return view('home.video', [
            'id' => $id,
            'movie' => $movie,
            'categories' => $categories,
            'profiles' => $profils,
            'profil' => $profil,
        ]);
    }


    public function showCategory($id, $category) {

        $auth = Auth::id();
        
        $categories = Category::with(['movies' => function($query) {
            $query->select('movies.id', 'nom', 'image', 'imageCategory', 'video');
        }])->findOrFail($category);
        
        $profils = Profile::where('user_id', $auth)->get();
        $profil = Profile::findOrFail($id);
        
            return view('home.category', [
                'id' => $id,
                'cat' => $category,
                'profil' => $profil,
                'profiles' => $profils,
                'categories' => $categories
            ]);
        
    }

    public function showFavourit($id) {

        $auth = Auth::id();

        //for Categories

        $categories = Category::all();
        
        // for narBar
        $profils = Profile::where('user_id', $auth)->get();
        $profil = Profile::with('movies')->findOrFail($id);
        $movies = $profil->movies;

        $arrVid = [];
        foreach ($movies as $movie) {
            $arrVid[] =  $movie->id;
        }
        
        
            return view('home.mylist', [
                'id' => $id,
                'profil' => $profil,
                'profiles' => $profils,
                'categories' => $categories,
                'arrVid' => $arrVid
            ]);
        
    }

    public function addVideo() {

        
        $categories = Category::all();
        return view('home.addVideos', compact('categories'));

    }

    public function insert(Request $request) {
    
        if($request->hasFile('image')) {
            $pathImage = $request->file('image')->store('image');
        }

        if($request->hasFile('cat-image')) {
            $pathCatImage = $request->file('cat-image')->store('imageCategory');
        }
        
        if($request->hasFile('video')) {
            $pathVideo = $request->file('video')->store('video');
        }
        
        $movie = Movie::create([
            'nom' => $request->nom,
            'image' => $pathImage,
            'imageCategory' => $pathCatImage,
            'video' => $pathVideo,
        ]);

        $categories = $request->category_id; 

        if(!$categories)
            return abort('404');

        $movie->categories()->syncWithoutDetaching($categories);

        return Redirect()->back();  
        
    }

    public function myList($movieId, $profile) {
        
        $profil = Profile::findOrFail($profile);
        $movies = $profil->movies;

        $arr = [];
        foreach ($movies as $movie) {
            $arr[] =  $movie->id;
        }

        if (in_array($movieId, $arr)) {

            $profil->movies()->detach($movieId);

        } else {

            $profil->movies()->syncWithoutDetaching($movieId);

        }


        return Redirect()->back(); 

    }

    public function like(Request $request) {

        $data_like = $request->data_like;
        $movie_id = $request->movie_id;
        $profil_id = $request->profil_id;

        $like = Like::where([
            ['profile_id', $profil_id],
            ['movie_id', $movie_id],
            ])->first();

        if(!$like) {

            $add_like = new Like;
            $add_like->profile_id = $profil_id;
            $add_like->movie_id = $movie_id;
            $add_like->like = 1;
            $add_like->save();

            $is_like = 1;

        } elseif ($like->like == 1) {

            Like::where([
                ['profile_id', $profil_id],
                ['movie_id', $movie_id],
                ])->delete();

                $is_like = 0;

        } elseif ($like->like == 0) {

            Like::where([
                ['profile_id', $profil_id],
                ['movie_id', $movie_id],
                ])->update([
                    'like' => 1
                ]);

                $is_like = 1;

        }

        $response = array(

            'is_like' => $is_like,
        );
        
        
        return response()->json($response, 200);
    }


    public function dislike(Request $request) {

        $data_like = $request->data_like;
        $movie_id = $request->movie_id;
        $profil_id = $request->profil_id;

        $dislike = Like::where([
            ['profile_id', $profil_id],
            ['movie_id', $movie_id],
            ])->first();

        if(!$dislike) {

            $add_like = new Like;
            $add_like->profile_id = $profil_id;
            $add_like->movie_id = $movie_id;
            $add_like->like = 0;
            $add_like->save();

            $is_dislike = 0;

        } elseif ($dislike->like == 0) {

            Like::where([
                ['profile_id', $profil_id],
                ['movie_id', $movie_id],
                ])->delete();

                $is_dislike = 1;

        } elseif ($dislike->like == 1) {

            Like::where([
                ['profile_id', $profil_id],
                ['movie_id', $movie_id],
                ])->update([
                    'like' => 0
                ]);

                $is_dislike = 0;

        }

        $response = array(

            'is_dislike' => $is_dislike,
        );
        
        
        return response()->json($response, 200);
    }

}
