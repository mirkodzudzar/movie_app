<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\CelebrityMovie;

class Profession extends Model
{
    protected $fillable = [
      'name',
    ];

    public function celebrityMovies()
    {
      return $this->hasMany('App\CelebrityMovie');
    }

    //Number of specific profession in celebrity_movie table
    public function numberOfCelebrities($id)
    {
        $celebrity_movies = DB::table('celebrity_movie')->where('profession_id', $id)->distinct()->get(['celebrity_id']);
        return $celebrity_movies->count();
    }
}
