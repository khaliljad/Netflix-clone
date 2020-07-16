<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'like', 'profile_id', 'movie_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function movie() {

        return $this->belongsTo('App\Movie');

    }

    public function profile() {

        return $this->belongsTo('App\Profile');

    }



}
