<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;

class Movie extends Model
{
    protected $fillable = [
      'name', 'description', 'time_duration', 'release_date',
    ];

    public function images()
    {
      return $this->morphToMany('App\Image', 'imageable');
    }

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
    public function professions($id, $profession_id)
    {
        // $movie = DB::table('movies')->where('id', $id)->first();
        $profession = DB::table('professions')->where('id', $profession_id)->first();
        // if($profession === null)
        // {
        //   echo "<i>profession unavailable</i>";
        // }
        // else
        // {
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
              //LIMIT A NUMBER OF CELEBRITIES PER PROFESSION TO ONE PRESON
              // echo Str::words($celebrity->first_name.' '.$celebrity->last_name, $words = 1, $end = '...');
              echo $celebrity->first_name.' '.$celebrity->last_name;
            }
            else
            {
              echo $celebrity->first_name.' '.$celebrity->last_name.", ";
            }
          // }
          }
        }
    }

    //Function for showing number of likes
    public function likes($id)
    {
      $movie_users = DB::table('movie_user')->where('movie_id', $id)->where('like', 1)->get();
      return $movie_users->count();
    }

    //Function for showing number of dislikes
    public function dislikes($id)
    {
      $movie_users = DB::table('movie_user')->where('movie_id', $id)->where('like', 0)->get();
      return $movie_users->count();
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
