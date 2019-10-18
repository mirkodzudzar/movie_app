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
    	->withTimestamps();
    }

    //Returning a number of movies with specific id of genre
    public function movieByGenreCount($id)
    {
      return DB::table('genre_movie')->where('genre_id', $id)->count();
    }

    //Improving checkbox functionality when we editing a movie
    public function checking($movie_id, $genre_id)
    {
        $genre_movies = DB::table('genre_movie')->where('movie_id', $movie_id)->where('genre_id', $genre_id)->get();
        foreach($genre_movies as $genre_movie)
        {
          if($genre_movies == null)
          {
            return false;
          }
          else
          {
            return true;
          }
        }
    }
}
