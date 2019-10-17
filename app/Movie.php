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
    	->withTimestamps();
    }

    public function users()
    {
      return $this->belongsToMany('App\User')
      ->withPivot('like', 'like')
      ->withTimestamps();
    }

    public function celebrities()
    {
      return $this->belongsToMany('App\Celebrity')
      ->withTimestamps();
    }

    public function price()
    {
      return $this->hasOne('App\Price');
    }
    //Coma has been fixed. This function shows every celebrity for specific movie with specific profession
    public function professions($id, $profession)
    {
        // $movie = DB::table('movies')->where('id', $id)->first();
        $profession = DB::table('professions')->where('name', $profession)->first();
        $celebrity_movies = DB::table('celebrity_movie')->where('movie_id', $id)->where('profession_id', $profession->id)->get();
        $numItems = count($celebrity_movies);
        $i = 0;
        foreach($celebrity_movies as $celebrity_movie)
        {
          $celebrities = DB::table('celebrities')->where('id', $celebrity_movie->celebrity_id)->get();
          foreach($celebrities as $celebrity)
          {
            if(++$i === $numItems)
            {
              echo $celebrity->first_name;
            }
            else
            {
              echo $celebrity->first_name.", ";
            }
          }
        }
    }
    //FIX THAT COMMA AT THE END OF EVERY FULL NAME, MAKE THIS FUNCTION SIMPLER, OR MAYBE EVEN CHANGE WHOLE FUNCTIONALITY
    //This is a function thah loops through specific movie and celebrity profession to echo a full name of every celebrity thah belong to specific movie
    // public function professions($id, $profession)
    // {
    //   $movie = DB::table('movies')->where('id', $id)->first();
    //   $celebrity_movie_celebrity_id = DB::table('celebrity_movie')->where('movie_id', $movie->id)->get();
    //
    //   $director = DB::table('professions')->where('name', $profession)->first();
    //   $celebrity_profession_celebrity_id = DB::table('celebrity_profession')->where('profession_id', $director->id)->get();
    //
    //   foreach($celebrity_movie_celebrity_id as $celebrity_id)
    //   {
    //     foreach($celebrity_profession_celebrity_id as $celebrity_iddd)
    //     {
    //       if($celebrity_id->celebrity_id == $celebrity_iddd->celebrity_id)
    //       {
    //         $celebrities = DB::table('celebrities')->where('id', $celebrity_id->celebrity_id)->get();
    //         $numItems = count($celebrities);
    //         $i = 0;
    //         foreach($celebrities as $celebrity)
    //         {
    //           if(++$i === $numItems)
    //           {
    //             echo $celebrity->first_name." ".$celebrity->last_name;
    //           }
    //           else
    //           {
    //             echo $celebrity->first_name." ".$celebrity->last_name.", ";
    //           }
    //         }
    //       }
    //     }
    //   }
    // }
}
//
// $numItems = count($arr);
// $i = 0;
// foreach($arr as $key=>$value) {
//   if(++$i === $numItems) {
//     echo "last index!";
//   }
// }
