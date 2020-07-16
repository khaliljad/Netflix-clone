<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'nom', 'image', 'imageCategory', 'video',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];

    public function categories() {

        return $this->belongsToMany('App\Category', 'category_movie');
        
    }


    public function profiles() {

        return $this->belongsToMany('App\Profile', 'profile_movie');

    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
