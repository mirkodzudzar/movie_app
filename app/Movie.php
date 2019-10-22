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

    //Function for showing first image for every movie, if it exist
    public function showMovieImage($id)
    {
      $imageable = DB::table('imageables')->where('imageable_id', $id)->where('imageable_type', 'App\Movie')->first();
      if($imageable == null)
      {
        return Image::noImage();
      }
      else
      {
        $image = DB::table('images')->where('id', $imageable->image_id)->first();
        return "/images/".$image->file;
      }
    }
}
