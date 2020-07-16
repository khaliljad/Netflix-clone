<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Profile extends Authenticatable
{

    protected $fillable = [
        'nom', 'image', 'password', 'user_id',
    ];

    public $timestamps = false;


    public function user() {

        return $this->belongsTo('App\User');

    }


    public function movies() {
        
        return $this->belongsToMany('App\Movie', 'profile_movie');

    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    protected $guard = "profil";
}
