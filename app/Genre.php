<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Genre extends Model
{
    protected $fillable = [
      'name',
    ];

    public function movies()
    {
      return $this->belongsToMany('App\Movie')
      ->withPivot('genre_id', 'genre_id')
      ->withPivot('movie_id', 'movie_id')
    	->withTimestamps();
    }

    //Returning a number of movies with specific id of genre
    public function movieByGenreCount($id)
    {
      return DB::table('genre_movie')->where('genre_id', $id)->count();
    }
}
