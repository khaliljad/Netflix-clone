<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nom'
    ];

    protected $hidden = [
        'created_at', 'updated_at','pivot'
    ];


    public function movies() {
        
        return $this->belongsToMany('App\Movie', 'category_movie');
    }
    
}
