<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {
    
    Auth::routes(['verify' => true]);
    Route::resource('profiles', 'ProfileController');
    Route::get('video', 'BrowseConroller@addVideo')->name('video');
    Route::post('insert', 'BrowseConroller@insert')->name('insert'); // insert video
    Route ::get('/{id}', 'BrowseConroller@index')->name('browse');
    Route ::get('video/{id?}/{movie}', 'BrowseConroller@showVideo')->name('video.show');
    Route ::get('category/{id?}/{category}', 'BrowseConroller@showCategory')->name('category.show');
    Route ::get('favourit/{id?}', 'BrowseConroller@showFavourit')->name('favourit.show');
    Route::get('mylist/{movieId}/{profile}', 'BrowseConroller@myList')->name('mylist'); // insert to myList
    Route::post('like', 'BrowseConroller@like')->name('like'); // like
    Route::post('dislike', 'BrowseConroller@dislike')->name('dislike'); // like

    
});

// --------------------------------------- video ressource -------------------------------- //



// ---------------------------------------loginFacebookRoute-------------------------------- //
Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');

// ------------------------------------ tests route ---------------------------//

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', 'HomeController@index')->name('home');


