<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
      'name', 'description', 'time_duration', 'release_date', 'director_id',
    ];

    public function director()
    {
      return $this->belongsTo('App\Director');
    }

    public function genres()
    {
      return $this->belongsToMany('App\Genre')
      ->withPivot('genre_id', 'genre_id')
      ->withPivot('movie_id', 'movie_id')
    	->withTimestamps();
    }
}
