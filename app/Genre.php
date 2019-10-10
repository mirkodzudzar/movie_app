<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
      'name',
    ];

    public function genres()
    {
      return $this->belongsToMany('App\Movies')
      ->withPivot('genre_id', 'genre_id')
      ->withPivot('movie_id', 'movie_id')
    	->withTimestamps();
    }
}
