<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Movie extends Model
{
    protected $fillable = [
      'name', 'description', 'time_duration', 'release_date',
    ];

    // public function director()
    // {
    //   return $this->belongsTo('App\Director');
    // }

    public function genres()
    {
      return $this->belongsToMany('App\Genre')
      ->withPivot('genre_id', 'genre_id')
      ->withPivot('movie_id', 'movie_id')
    	->withTimestamps();
    }

    public function users()
    {
      return $this->belongsToMany('App\User')
      ->withPivot('movie_id)', 'movie_id')
      ->withPivot('user_id', 'user_id')
      ->withPivot('like', 'like')
      ->withTimestamps();
    }

    public function celebrities()
    {
      return $this->belongsToMany('App\Celebrity')
      ->withPivot('celebrity_id', 'celebrity_id')
      ->withPivot('movie_id', 'movie_id')
      ->withTimestamps();
    }

    public function price()
    {
      return $this->hasOne('App\Price');
    }
    //FIX THAT COMMA AT THE END OF EVERY FULL NAME, MAKE THIS FUNCTION SIMPLER, OR MAYBE EVEN CHANGE WHOLE FUNCTIONALITY
    //This is a function thah loops through specific movie and celebrity profession to echo a full name of every celebrity thah belong to specific movie
    public function professions($id, $profession)
    {
      $movie = DB::table('movies')->where('id', $id)->first();
      $celebrity_movie_celebrity_id = DB::table('celebrity_movie')->where('movie_id', $movie->id)->get();

      $director = DB::table('professions')->where('name', $profession)->first();
      $celebrity_profession_celebrity_id = DB::table('celebrity_profession')->where('profession_id', $director->id)->get();

      foreach($celebrity_movie_celebrity_id as $celebrity_id)
      {
        foreach($celebrity_profession_celebrity_id as $celebrity_iddd)
        {
          if($celebrity_id->celebrity_id == $celebrity_iddd->celebrity_id)
          {
            $celebrities = DB::table('celebrities')->where('id', $celebrity_id->celebrity_id)->get();
            $counter = 1;
            $celebrities_count = count($celebrities);
            foreach($celebrities as $celebrity)
            {
              if($celebrities_count == $counter)
              {
                echo $celebrity->first_name." ".$celebrity->last_name.", ";
              }
              else
              {
                echo $celebrity->first_name." ".$celebrity->last_name;
              }
              $counter = $counter + 1;
            }
          }
        }
      }
    }
}
